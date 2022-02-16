<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_laporanrawatinap extends Model
{
    protected $table = 'pendaftaran_inap';
    protected $primaryKey = 'id_inap';

    public function filter($param)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_inap');
		$builder->select('id_inap, pasien.nama_pasien, waktu_masuk, waktu_keluar, total_tagihan_inap, status_inap');
		$builder->join('pasien','pasien.id_pasien = pendaftaran_inap.id_pasien');
        if ($param['cek_waktu1']) $builder->where('waktu_masuk >= ', $param['cek_waktu1']);
        if ($param['status_inap']) $builder->where('status_inap', $param['status_inap']);
        return $builder->get();
    }
}