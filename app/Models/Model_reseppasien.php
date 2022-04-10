<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_reseppasien extends Model
{
    protected $table = 'antrian';
    protected $primaryKey = 'id_antrian';

    // resep
    public function filter_inap($param)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep');
        $builder->select('resep.id_resep, sum(detail_resep.total_biaya) as tagihan_obat, pasien.nama_pasien, dokter.nama_dokter, resep.tanggal');
        $builder->join('rekam_medis','rekam_medis.id_rekam = resep.id_rekam');
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('pasien','rekam_medis.nik = pasien.nik');
        $builder->join('detail_resep', 'resep.id_resep = detail_resep.id_resep', 'left');
        $builder->where('rekam_medis.nik', $param['nik']);
        if ($param['cek_waktu1']) $builder->where('resep.tanggal >=', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('resep.tanggal <=', $param['cek_waktu2']);
        $builder->groupBy("resep.id_resep");
        return $builder->get();
    }

    public function filter_jalan($param)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep');
        $builder->select('resep.id_resep, sum(detail_resep.total_biaya) as tagihan_obat, pasien.nama_pasien, dokter.nama_dokter, resep.tanggal');
        $builder->join('rekam_medis','rekam_medis.id_rekam = resep.id_rekam');
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('pasien','rekam_medis.nik = pasien.nik');
        $builder->join('detail_resep', 'resep.id_resep = detail_resep.id_resep', 'left');
        $builder->where('rekam_medis.nik', $param['nik']);
        if ($param['cek_waktu1']) $builder->where('resep.tanggal >= ', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('resep.tanggal <= ', $param['cek_waktu2']);
        $builder->groupBy("resep.id_resep");
        return $builder->get();
    }

    public function view_detail_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep');
        $builder->select('detail_resep.id_detail, detail_resep.id_resep, detail_resep.id_obat, obat.nama_obat, detail_resep.jumlah_obat, detail_resep.total_biaya');
        $builder->join('obat','detail_resep.id_obat = obat.id_obat');
        $builder->where('detail_resep.id_resep', $id);
        return $builder->get();
    }

    public function view_detail_resep_jalan($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep');
        $builder->select('detail_resep.id_detail, detail_resep.id_resep, detail_resep.id_obat, obat.nama_obat, detail_resep.jumlah_obat, detail_resep.total_biaya');
        $builder->join('obat','detail_resep.id_obat = obat.id_obat');
        $builder->where('detail_resep.id_resep', $id);
        return $builder->get();
    }

    public function view_detail_resep_inap($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep');
        $builder->select('detail_resep.id_detail, detail_resep.id_resep, detail_resep.id_obat, obat.nama_obat, detail_resep.jumlah_obat, detail_resep.total_biaya');
        $builder->join('obat','detail_resep.id_obat = obat.id_obat');
        $builder->where('detail_resep.id_resep', $id);
        return $builder->get();
    }

    public function harga_obat($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('obat');
        $builder->select('harga_obat, stok_obat');
        $builder->where('id_obat', $id);
        return $builder->get();
    }
}