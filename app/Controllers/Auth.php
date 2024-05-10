<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        echo "Emrullah Manas ÇETİN";
        return view('Panel/Login_v');
    }

    public function check(){
        echo 'OL ARTIK LÜTFEN!';
    }
}
