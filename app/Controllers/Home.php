<?php

namespace App\Controllers;

use App\Models\Room;
use App\Models\Tool;
use App\Models\LoanTool;
use App\Models\LoanModel;
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

    public function roomList()
    {
        $rooms = new Room();

        return view('room_list', [
            'current_user' => user(),
            'rooms' => $rooms->findAll(),
            'active' => 'room-list',
        ]);
    }

    public function insertRoom()
    {
        if (!$this->validate([
            'room_name' => 'required|min_length[3]|max_length[255]',
            'room_description' => 'required|min_length[3]|max_length[255]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $rooms = new Room();
        $data = $this->request->getPost();
        $data['room_slug'] = slug($data['room_name']);

        if (!$rooms->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $rooms->errors());
        }

        return redirect()->back()->with('message', 'Room created successfully');
    }

    public function editRoom()
    {
        if (!$this->validate([
            'room_name' => 'required|min_length[3]|max_length[255]',
            'room_description' => 'required|min_length[3]|max_length[255]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $room = new Room();
        $data = $this->request->getPost();

        if (!$room->save($data)) {
            return redirect()->back()->withInput()->with('errors', $room->errors());
        }

        return redirect()->back()->with('message', 'Room updated successfully');
    }

    public function deleteRoom()
    {
        $room = new Room();
        if (!$room->delete($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $room->errors());
        }

        return redirect()->back()->with('message', 'Room deleted successfully');
    }

    public function toolList()
    {
        $tools = new Tool();
        $rooms = new Room();
        // dd($tools->rooms()->findAll());

        return view('tool_list', [
            'current_user' => user(),
            'tools' => $tools->rooms()->findAll(),
            'rooms' => $rooms->findAll(),
            'active' => 'tool-list',
        ]);
    }

    public function insertTool()
    {
        if (!$this->validate([
            'tool_name' => 'required|min_length[3]|max_length[255]',
            'tool_description' => 'required|min_length[3]|max_length[255]',
            'room_id' => 'required|min_length[1]|max_length[255]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tools = new Tool();
        $data = $this->request->getPost();

        // Create slug from room name
        // $data['tool_slug'] = slug($data['tool_name']);

        if (!$tools->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $tools->errors());
        }

        return redirect()->back()->with('message', 'Tool created successfully');
    }

    public function editTool()
    {

        if (!$this->validate([
            'tool_name' => 'required|min_length[3]|max_length[255]',
            'tool_description' => 'required|min_length[3]|max_length[255]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $tools = new Tool();
        $data = $this->request->getPost();

        if (!$tools->save($data)) {
            return redirect()->back()->withInput()->with('errors', $tools->errors());
        }
        return redirect()->back()->with('message', 'Tool updated successfully');
    }

    public function deleteTool()
    {
        $tools = new Tool();

        if (!$tools->delete($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $tools->errors());
        }

        return redirect()->back()->with('message', 'Tool deleted successfully');
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
        $rooms = new Room();
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
            'tool_id.*' => 'required|min_length[1]|max_length[255]',
            'tool_quantity.*' => 'required|numeric',
            'room_id' => 'required|min_length[1]|max_length[255]',
            'start_time' => 'required|min_length[1]|max_length[255]',
            'end_time' => 'required|min_length[1]|max_length[255]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        // Transpose multidimensional array to single dimensional array
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

        $loans = new LoanModel();
        $data = $this->request->getPost();

        if (!$loans->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $loans->errors());
        }



        foreach ($toolArr as $prop) {
            // Insert loan tool
            $prop['loan_id'] = $loans->getInsertID();
            $loanTool = new LoanTool();
            $loanTool->insert($prop);

            // Update tool quantity
            $tools = new Tool();
            $tool = $tools->where('id', $prop['tool_id'])->first();
            $tools->update($tool['id'], [
                'tool_quantity' => $tool['tool_quantity'] - $prop['tool_quantity']
            ]);
        }



        return redirect()->back()->with('message', 'Loan submitted successfully');
    }
}
