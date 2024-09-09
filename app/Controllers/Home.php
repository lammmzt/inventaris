<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'main_menu' => 'Dashboard',
            'title' => 'Dashboard',
            'active' => 'Dashboard',
        ];
        return view('Admin/Dashboard', $data);
    }
}
