<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Si ya entró, al dashboard, si no, al login
        if (session()->get('is_logged')) {
            return redirect()->to(base_url('dashboard'));
        }
        return redirect()->to(base_url('login'));
    }
}