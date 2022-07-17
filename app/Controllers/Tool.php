<?php

namespace App\Controllers;

use App\Models\RoomModel;
use App\Controllers\BaseController;
use App\Models\ToolModel;

class Tool extends BaseController
{
    public function toolList()
    {
        $tools = new ToolModel();
        $rooms = new RoomModel();
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
        dd($this->request->getFile('tool_image'));
        if (!$this->validate([
            'tool_name' => 'required|min_length[3]|max_length[255]',
            'tool_description' => 'required|min_length[3]|max_length[255]',
            'room_id' => 'required|min_length[1]|max_length[255]',
            'tool_image' => 'is_image[tool_image]|mime_in[tool_image,image/png,image/jpg]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        if ($image = $this->request->getFile('tool_image')) {
            if ($image->isValid() && !$image->hasMoved()) {
                $data['image'] = $image->getRandomName();
                $image->move(ROOTPATH . 'public/uploads/images/tools', $data['image']);
            }
        }

        $tools = new ToolModel();

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
            'tool_image' => 'is_image[tool_image]|mime_in[tool_image,image/png,image/jpg]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tools = new ToolModel();
        $data = $this->request->getPost();

        if ($image = $this->request->getFile('tool_image')) {
            if ($image->isValid() && !$image->hasMoved()) {
                $data['image'] = $image->getRandomName();
                $image->move(ROOTPATH . 'public/uploads/images/tools', $data['image']);
            }

            $oldTool = $tools->find($data['id']);
            if ($oldTool['image'] != '404.jpg') {
                unlink(ROOTPATH . 'public/uploads/images/tools/' . $oldTool['image']);
            }
        }

        if (!$tools->save($data)) {
            return redirect()->back()->withInput()->with('errors', $tools->errors());
        }

        return redirect()->back()->with('message', 'Tool updated successfully');
    }

    public function deleteTool()
    {
        $tools = new ToolModel();

        if (!$tools->delete($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $tools->errors());
        }

        return redirect()->back()->with('message', 'Tool deleted successfully');
    }
}
