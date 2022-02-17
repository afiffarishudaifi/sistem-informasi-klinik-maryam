<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_reseppasien extends Model
{
    protected $table = 'pendaftaran_rawat_jalan';
    protected $primaryKey = 'id_pendaftaran';

    // resep
    public function filter_inap($param)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_inap');
        $builder->select('resep_inap.id_resep_inap, sum(detail_resep_inap.total_biaya) as tagihan_obat, pasien.nama_pasien, dokter.nama_dokter, resep_inap.created_at');
        $builder->join('rekam_medis_inap','rekam_medis_inap.id_rekam_inap = resep_inap.id_rekam_inap');
        $builder->join('dokter','dokter.id_dokter = rekam_medis_inap.id_dokter');
        $builder->join('pasien','rekam_medis_inap.id_pasien = pasien.id_pasien');
        $builder->join('detail_resep_inap', 'resep_inap.id_resep_inap = detail_resep_inap.id_resep_inap', 'left');
        $builder->where('rekam_medis_inap.id_pasien', $param['id_pasien']);
        if ($param['cek_waktu1']) $builder->where('resep_inap.created_at >=', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('resep_inap.created_at <=', $param['cek_waktu2']);
        $builder->groupBy("resep_inap.id_resep_inap");
        return $builder->get();
    }

    public function filter_jalan($param)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_jalan');
        $builder->select('resep_jalan.id_resep, sum(detail_resep.total_biaya) as tagihan_obat, pasien.nama_pasien, dokter.nama_dokter, resep_jalan.created_at');
        $builder->join('rekam_medis_jalan','rekam_medis_jalan.id_pemeriksaan = resep_jalan.id_pemeriksaan');
        $builder->join('pendaftaran_rawat_jalan','pendaftaran_rawat_jalan.id_pendaftaran = rekam_medis_jalan.id_pendaftaran');
        $builder->join('jadwal_dokter','pendaftaran_rawat_jalan.id_jadwal = jadwal_dokter.id_jadwal');
        $builder->join('dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
        $builder->join('detail_resep', 'resep_jalan.id_resep = detail_resep.id_resep', 'left');
        $builder->where('pendaftaran_rawat_jalan.id_pasien', $param['id_pasien']);
        if ($param['cek_waktu1']) $builder->where('resep_jalan.created_at >= ', $param['cek_waktu1']);
        if ($param['cek_waktu2']) $builder->where('resep_jalan.created_at <= ', $param['cek_waktu2']);
        $builder->groupBy("resep_jalan.id_resep");
        return $builder->get();
    }

    public function view_detail_resep_inap($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep_inap');
        $builder->select('detail_resep_inap.id_detail, detail_resep_inap.id_resep_inap, detail_resep_inap.id_obat, obat.nama_obat, detail_resep_inap.jumlah_obat, detail_resep_inap.total_biaya');
        $builder->join('obat','detail_resep_inap.id_obat = obat.id_obat');
        $builder->where('detail_resep_inap.id_resep_inap', $id);
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

    public function harga_obat($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('obat');
        $builder->select('harga_obat, stok_obat');
        $builder->where('id_obat', $id);
        return $builder->get();
    }
}