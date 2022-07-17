<?php

namespace App\Controllers;

use App\Models\LoanTool;
use App\Models\LoanModel;
use App\Models\RoomModel;
use App\Models\ToolModel;
use Myth\Auth\Models\UserModel;

class Home extends BaseController
{

    public function __construct()
    {
        helper('slug');
        $auth = service('authentication');
        if (!$auth->check()) {
            return redirect()->to('/login');
        }
    }

    public function test()
    {
        dd(in_groups('admin'));
        dd(slug('Hello World'));
    }

    public function index()
    {
        return view('index', [
            'current_user' => user(),
            'active' => 'home',
        ]);
    }

    public function userList()
    {
        $users = new UserModel();

        return view('user_list', [
            'users' => $users->asArray()->findAll(),
            'current_user' => user(),
            'active' => 'user-list',
        ]);
    }

    public function room($slug)
    {
        $rooms = new RoomModel();
        $room = $rooms->where('room_slug', $slug)->first();
        // dd($rooms->tools()->where('room_id', $room['id'])->findAll());
        return view('room', [
            'active' => '',
            'current_user' => user(),
            'room' => $room,
            'tools' => $rooms->tools()->where('room_id', $room['id'])->findAll(),
        ]);
    }

    public function insertLoan()
    {
        if (!$this->validate([
            // 'tool_id.*' => 'required|min_length[1]|max_length[255]',
            // 'tool_quantity.*' => 'required|numeric',
            'room_id' => 'required|min_length[1]|max_length[255]',
            'start_time' => 'required|min_length[1]|max_length[255]|is_unique[loans.start_time]',
            'end_time' => 'required|min_length[1]|max_length[255]|is_unique[loans.end_time]'
        ])) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        // Transpose multidimensional array to single dimensional array
        if (isset($data['tool_id'])) {

            $toolArr = [];
            for ($i = 0; $i < count($data['tool_id']); $i++) {
                $toolArr[$i] = array(
                    'tool_id' => $data['tool_id'][$i],
                    'tool_quantity' => $data['tool_quantity'][$i]
                );
            }

            // unset tool_id and tool_quantity from data array
            unset($data['tool_id']);
            unset($data['tool_quantity']);
        }

        $loans = new LoanModel();
        $data = $this->request->getPost();

        if (!$loans->insert($data)) {
            return redirect()->back()->with('error', 'Failed to submit data');
        }

        if (isset($data['tool_id'])) {
            foreach ($toolArr as $prop) {
                // Insert loan tool
                $prop['loan_id'] = $loans->getInsertID();
                $loanTool = new LoanTool();
                $loanTool->insert($prop);

                // Update tool quantity
                $tools = new ToolModel();
                $tool = $tools->where('id', $prop['tool_id'])->first();
                $tools->update($tool['id'], [
                    'tool_quantity' => $tool['tool_quantity'] - $prop['tool_quantity']
                ]);
            }
        }

        return redirect()->back()->with('message', 'Loan submitted successfully');
    }

    public function loanList()
    {
        $loanModel = new LoanModel();

        return view('loan_list', [
            'loans' => $loanModel->findAll()
        ]);
    }
}
