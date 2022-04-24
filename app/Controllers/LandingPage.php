<?php

namespace App\Controllers;
use App\Models\Model_poli;

class LandingPage extends BaseController
{
    public function index()
    {
        $model = new Model_poli();
        $poli = $model->view_data()->getResultArray();
        $data = [
            'poli' => $poli
        ];
        
        return view('home', $data);
    }
}