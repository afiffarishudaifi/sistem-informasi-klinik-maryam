<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_laporanpenjualanobat extends Model
{
    protected $table = 'detail_resep';
    protected $primaryKey = 'id_inap';

    public function filter($param)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('detail_resep');
		$builder->select('obat.nama_obat, jumlah_obat, total_biaya, obat.stok_obat, DATE_FORMAT(detail_resep.tanggal_resep,"%d %M %Y") as tanggal_resep');
		$builder->join('obat','obat.id_obat = detail_resep.id_obat');
        if ($param['cek_waktu1']) $builder->where('detail_resep.tanggal_resep >= ', $param['cek_waktu1']);
        if ($param['id_obat']) $builder->where('detail_resep.id_obat', $param['id_obat']);
        return $builder->get();
    }
}
