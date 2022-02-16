<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_laporanpenjualanobat extends Model
{
    protected $table = 'detail_resep';
    protected $primaryKey = 'id_inap';

    public function filter_jalan($param)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('detail_resep');
		$builder->select('obat.nama_obat, jumlah_obat, total_biaya, obat.stok_obat, DATE_FORMAT(detail_resep.created_at,"%d %M %Y") as created_at');
		$builder->join('obat','obat.id_obat = detail_resep.id_obat');
        if ($param['cek_waktu1']) $builder->where('detail_resep.created_at >= ', $param['cek_waktu1']);
        if ($param['id_obat']) $builder->where('detail_resep.id_obat', $param['id_obat']);
        return $builder->get();
    }

    public function filter_inap($param)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('detail_resep_inap');
		$builder->select('obat.nama_obat, jumlah_obat, total_biaya, obat.stok_obat, DATE_FORMAT(detail_resep_inap.created_at,"%d %M %Y") as created_at');
		$builder->join('obat','obat.id_obat = detail_resep_inap.id_obat');
        if ($param['cek_waktu1']) $builder->where('detail_resep_inap.created_at >= ', $param['cek_waktu1']);
        if ($param['id_obat']) $builder->where('detail_resep_inap.id_obat', $param['id_obat']);
        return $builder->get();
    }
}