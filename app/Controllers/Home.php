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

    public function ka_tu(): string
    {
        $data = [
            'main_menu' => 'Dashboard',
            'title' => 'Dashboard',
            'active' => 'Dashboard',
        ];
        return view('KaTU/Dashboard', $data);
    }

    public function petugas_bos(): string
    {
        $data = [
            'main_menu' => 'Dashboard',
            'title' => 'Dashboard',
            'active' => 'Dashboard',
        ];
        return view('PetugasBos/Dashboard', $data);
    }
    public function Kepsek(): string
    {
        $data = [
            'main_menu' => 'Dashboard',
            'title' => 'Dashboard',
            'active' => 'Dashboard',
        ];
        return view('Kepsek/Dashboard', $data);
    }
    public function Pegawai(): string
    {
        $data = [
            'main_menu' => 'Dashboard',
            'title' => 'Dashboard',
            'active' => 'Dashboard',
        ];
        return view('Pegawai/Dashboard', $data);
    }
}