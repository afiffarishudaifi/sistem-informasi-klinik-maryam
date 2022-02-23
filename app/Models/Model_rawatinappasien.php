<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_rawatinappasien extends Model
{
    protected $table = 'pendaftaran_inap';
    protected $primaryKey = 'id_inap';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_inap');
        $builder->select('pendaftaran_inap.id_inap, pendaftaran_inap.id_kamar, pendaftaran_inap.id_pasien, pasien.nama_pasien, kamar.no_kamar, kamar.biaya_kamar, pendaftaran_inap.waktu_masuk, pendaftaran_inap.waktu_keluar, pendaftaran_inap.total_tagihan_inap, pendaftaran_inap.status_inap');
        $builder->join('kamar','pendaftaran_inap.id_kamar = kamar.id_kamar');
        $builder->join('pasien','pendaftaran_inap.id_pasien = pasien.id_pasien');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('pendaftaran_inap')->insert($data);
        return $query;
    }

    public function cek_pasien($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_inap');
        $builder->selectCount('pendaftaran_inap.id_pasien');
        $builder->where('pendaftaran_inap.id_pasien', $id);
        $builder->where('status_inap', 'Belum Selesai');
        return $builder->get();
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_inap');
        $builder->select('pendaftaran_inap.id_inap, pendaftaran_inap.id_kamar, pendaftaran_inap.id_pasien, pasien.nama_pasien, kamar.no_kamar, kamar.biaya_kamar, pendaftaran_inap.waktu_masuk, pendaftaran_inap.waktu_keluar, pendaftaran_inap.total_tagihan_inap, pendaftaran_inap.status_inap');
        $builder->join('kamar','pendaftaran_inap.id_kamar = kamar.id_kamar');
        $builder->join('pasien','pendaftaran_inap.id_pasien = pasien.id_pasien');
        $builder->where('id_inap', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_inap');
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