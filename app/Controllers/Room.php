<?php

namespace App\Controllers;

use App\Models\RoomModel;

class Room extends BaseController
{
    public function roomList()
    {
        $rooms = new RoomModel();

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
            'room_description' => 'required|min_length[3]|max_length[255]',
            'room_image' => 'is_image[room_image]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        if ($image = $this->request->getFile('room_image')) {
            if ($image->isValid() && !$image->hasMoved()) {
                $data['image'] = $image->getRandomName();
                $image->move(ROOTPATH . 'public/uploads/images/rooms', $data['image']);
            }
        }

        $rooms = new RoomModel();

        if (!$rooms->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $rooms->errors());
        }

        return redirect()->back()->with('message', 'Room created successfully');
    }

    public function editRoom()
    {
        if (!$this->validate([
            'room_name' => 'required|min_length[3]|max_length[255]',
            'room_description' => 'required|min_length[3]|max_length[255]',
            'room_image' => 'is_image[room_image]|mime_in[room_image,image/png,image/jpg]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        $room = new RoomModel();

        if ($image = $this->request->getFile('room_image')) {
            if ($image->isValid() && !$image->hasMoved()) {
                $data['image'] = $image->getRandomName();
                $image->move(ROOTPATH . 'public/uploads/images/rooms', $data['image']);
            }

            $oldRoom = $room->find($data['id']);
            if ($oldRoom['image'] != '404.jpg') {
                unlink(ROOTPATH . 'public/uploads/images/rooms/' . $oldRoom['image']);
            }
        }


        if (!$room->save($data)) {
            return redirect()->back()->withInput()->with('errors', $room->errors());
        }

        return redirect()->back()->with('message', 'Room updated successfully');
    }

    public function deleteRoom()
    {
        $room = new RoomModel();
        $data = $this->request->getPost();
        if (!$room->delete($data)) {
            return redirect()->back()->withInput()->with('errors', $room->errors());
        }

        unlink(ROOTPATH . 'public/uploads/images/rooms/' . $data['image']);
        return redirect()->back()->with('message', 'Room deleted successfully');
    }
}
