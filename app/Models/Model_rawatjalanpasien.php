<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_rawatjalanpasien extends Model
{
    protected $table = 'pendaftaran_rawat_jalan';
    protected $primaryKey = 'id_pendaftaran';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_rawat_jalan');
        $builder->select('id_pendaftaran, jadwal_dokter.id_jadwal, pasien.nama_pasien, poliklinik.nama_poli, pendaftaran_rawat_jalan.no_antrian, hari.nama_hari, sesi.nama_sesi, dokter.nama_dokter, pendaftaran_rawat_jalan.status_antrian');
        $builder->join('jadwal_dokter','pendaftaran_rawat_jalan.id_jadwal = jadwal_dokter.id_jadwal');
        $builder->join('hari','hari.id_hari = jadwal_dokter.id_hari');
        $builder->join('sesi','sesi.id_sesi = jadwal_dokter.id_sesi');
        $builder->join('dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        $builder->join('poliklinik','pendaftaran_rawat_jalan.id_poli = poliklinik.id_poli');
        $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('pendaftaran_rawat_jalan')->insert($data);
        return $query;
    }

    public function cek_max($params)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_rawat_jalan');
        $builder->selectMax('no_antrian');
        $builder->join('poliklinik','pendaftaran_rawat_jalan.id_poli = poliklinik.id_poli');
        $builder->join('jadwal_dokter','pendaftaran_rawat_jalan.id_jadwal = jadwal_dokter.id_jadwal');
        $builder->where('poliklinik.id_poli',$params['id_poli']);
        $builder->where('jadwal_dokter.id_jadwal', $params['id_jadwal']);
        $builder->where('pendaftaran_rawat_jalan.tanggal_daftar', $params['tanggal_daftar']);
        return $builder->get();
    }

    public function cek_pasien($id)
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_rawat_jalan');
        $builder->select('id_pendaftaran');
        $builder->where('id_pasien', $id);
        $builder->where('status_antrian =', 'Menunggu');
        return $builder->get();
    }

    public function antrian($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_rawat_jalan');
        $builder->select('no_antrian');
        $builder->where('id_pasien', $id);
        $builder->where('status_antrian =', 'Menunggu');
        return $builder->get();
    }
}