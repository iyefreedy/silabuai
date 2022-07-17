<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $user->username = 'admin';
        $user->setPassword('apadongbgsd');
        $user->email = 'iye.fredickson@gmail.com';
        $user->active = 1;

        $userModel = new UserModel();
        $userModel->save($user);
    }
}
