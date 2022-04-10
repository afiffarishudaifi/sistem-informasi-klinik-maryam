<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_rawatinappasien extends Model
{
    protected $table = 'rawat_inap';
    protected $primaryKey = 'id_inap';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rawat_inap');
        $builder->select('rawat_inap.id_inap, rawat_inap.id_kamar, rawat_inap.nik, pasien.nama_pasien, kamar.no_kamar, kamar.biaya_kamar, rawat_inap.waktu_masuk, rawat_inap.waktu_keluar, rawat_inap.total_tagihan_inap, rawat_inap.status_inap');
        $builder->join('kamar','rawat_inap.id_kamar = kamar.id_kamar');
        $builder->join('pasien','rawat_inap.nik = pasien.nik');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('rawat_inap')->insert($data);
        return $query;
    }

    public function cek_pasien($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rawat_inap');
        $builder->selectCount('rawat_inap.nik');
        $builder->where('rawat_inap.nik', $id);
        $builder->where('status_inap', 'Belum Selesai');
        return $builder->get();
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rawat_inap');
        $builder->select('rawat_inap.id_inap, rawat_inap.id_kamar, rawat_inap.nik, pasien.nama_pasien, kamar.no_kamar, kamar.biaya_kamar, rawat_inap.waktu_masuk, rawat_inap.waktu_keluar, rawat_inap.total_tagihan_inap, rawat_inap.status_inap');
        $builder->join('kamar','rawat_inap.id_kamar = kamar.id_kamar');
        $builder->join('pasien','rawat_inap.nik = pasien.nik');
        $builder->where('id_inap', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rawat_inap');
        $builder->where('id_inap', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function update_status_kamar($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kamar');
        $builder->where('id_kamar', $id);
        $builder->set($data);
        return $builder->update();
    }
}