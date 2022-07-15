<?php

namespace App\Controllers\Pendaftaran;

use App\Controllers\BaseController;
use App\Models\Model_pasien;
use App\Models\Model_poli;
use App\Models\Model_rawatinappasien;
use App\Models\Model_rawatjalanpasien;

class Coba extends BaseController
{

    public function __construct()
    {
        $session = session();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        // ini_set('memory_limit', '1M');
        $session = session();
        // return view('Pendaftaran/index');
        $model_pasien = new Model_pasien();
        $data_pasien = $model_pasien->detail_data(3520080900600004)->getRowArray();

        $model_poli = new Model_poli();
        $data_poli = $model_poli->detail_data(1)->getRowArray();
        $data = [
            'data_pasien' => $data_pasien,
            'antrian' =>1,
            'tanggal_daftar' => '2022-08-09',
            'poli' => $data_poli['nama_poli'],
            'foto' => 'data:image/jpg;base64,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'
        ];
        

        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('pdf-view-baru', $data));
        $dompdf->setPaper('A8', 'portrait');
        $dompdf->render();
        $dompdf->stream("pendaftaran".".pdf");
    }
    
    public function encode_img_base64(){
        $img_path = './docs/img/logo.jpg';
        $img_type = 'jpg';
            //convert image into Binary data
        $img_data = fopen ($img_path,'rb');
        
        $img_size = filesize ($img_path);
        $binary_image = fread ( $img_data, $img_size );
        fclose ( $img_data );

        //Build the src string to place inside your img tag
        $img_src = "data:image/".$img_type.";base64,".str_replace ("\n", "", base64_encode($binary_image));

        return $img_src;
    }
}
