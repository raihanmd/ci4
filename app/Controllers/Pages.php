<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Lynx'
        ];
        return view('pages/home', $data);
    }

    public function about(){
        $data = [
            'title' => 'About Me | Lynx'
        ];
        return view('pages/about', $data);
    }

    public function contact(){
        $data = [
            'title' => 'Contact | Lynx',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'JL. Samarinda No. 732',
                    'kota' => 'Bandung'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'JL. Haji No. 732',
                    'kota' => 'Jakarta'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
