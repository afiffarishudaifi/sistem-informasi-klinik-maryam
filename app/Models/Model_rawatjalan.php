<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_rawatjalan extends Model
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

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_rawat_jalan');
        $builder->select("id_pendaftaran, jadwal_dokter.id_jadwal, pasien.id_pasien, pasien.nama_pasien, poliklinik.id_poli, pendaftaran_rawat_jalan.keluhan, pendaftaran_rawat_jalan.umur, pendaftaran_rawat_jalan.status_antrian, DATE_FORMAT(pendaftaran_rawat_jalan.tanggal_daftar, '%Y-%m-%dT%H:%i') as tanggal_daftar, poliklinik.nama_poli, pendaftaran_rawat_jalan.no_antrian, hari.nama_hari, sesi.nama_sesi, dokter.nama_dokter, pendaftaran_rawat_jalan.status_antrian");
        $builder->join('jadwal_dokter','pendaftaran_rawat_jalan.id_jadwal = jadwal_dokter.id_jadwal');
        $builder->join('hari','hari.id_hari = jadwal_dokter.id_hari');
        $builder->join('sesi','sesi.id_sesi = jadwal_dokter.id_sesi');
        $builder->join('dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        $builder->join('poliklinik','pendaftaran_rawat_jalan.id_poli = poliklinik.id_poli');
        $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
        $builder->where('id_pendaftaran', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_rawat_jalan');
        $builder->where('id_pendaftaran', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_rawat_jalan');
        $builder->where('id_pendaftaran', $id);
        return $builder->delete();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_rawat_jalan');
        $builder->join('resep_jalan', 'resep_jalan.id_pendaftaran = pendaftaran_rawat_jalan.id_pendaftaran');
        $builder->where('pendaftaran_rawat_jalan.id_pendaftaran', $id);
        return $builder->countAllResults();
    }

    public function cek_max($params)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_rawat_jalan');
        $builder->selectMax('id_pendaftaran');
        $builder->join('poliklinik','pendaftaran_rawat_jalan.id_poli = poliklinik.id_poli');
        $builder->join('jadwal_dokter','pendaftaran_rawat_jalan.id_jadwal = jadwal_dokter.id_jadwal');
        $builder->where('poliklinik.id_poli',$params['id_poli']);
        $builder->where('jadwal_dokter.id_jadwal', $params['id_jadwal']);
        $builder->where('pendaftaran_rawat_jalan.tanggal_daftar', $params['tanggal_daftar']);
        return $builder->get();
    }

    // rekam medis

    public function view_data_rekam()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_jalan');
        $builder->select('rekam_medis_jalan.id_pemeriksaan, rekam_medis_jalan.hasil_pemeriksaan, rekam_medis_jalan.saran_dokter, rekam_medis_jalan.tensi_darah, rekam_medis_jalan.id_pendaftaran, pasien.nama_pasien, pendaftaran_rawat_jalan.tanggal_daftar, dokter.nama_dokter, poliklinik.nama_poli');
        $builder->join('pendaftaran_rawat_jalan','pendaftaran_rawat_jalan.id_pendaftaran = rekam_medis_jalan.id_pendaftaran');
        $builder->join('jadwal_dokter','pendaftaran_rawat_jalan.id_jadwal = jadwal_dokter.id_jadwal');
        $builder->join('sesi','sesi.id_sesi = jadwal_dokter.id_sesi');
        $builder->join('dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        $builder->join('poliklinik','pendaftaran_rawat_jalan.id_poli = poliklinik.id_poli');
        $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
        return $builder->get();
    }

    public function add_data_rekam($data)
    {
        $query = $this->db->table('rekam_medis_jalan')->insert($data);
        return $query;
    }

    public function detail_data_rekam($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_jalan');
        $builder->select("rekam_medis_jalan.id_pemeriksaan, rekam_medis_jalan.hasil_pemeriksaan, rekam_medis_jalan.saran_dokter, rekam_medis_jalan.tensi_darah, rekam_medis_jalan.id_pendaftaran, pasien.nama_pasien, pendaftaran_rawat_jalan.tanggal_daftar, dokter.nama_dokter, poliklinik.nama_poli");
        $builder->join('pendaftaran_rawat_jalan','pendaftaran_rawat_jalan.id_pendaftaran = rekam_medis_jalan.id_pendaftaran');
        $builder->join('jadwal_dokter','pendaftaran_rawat_jalan.id_jadwal = jadwal_dokter.id_jadwal');
        $builder->join('sesi','sesi.id_sesi = jadwal_dokter.id_sesi');
        $builder->join('dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        $builder->join('poliklinik','pendaftaran_rawat_jalan.id_poli = poliklinik.id_poli');
        $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
        $builder->where('id_pemeriksaan', $id);
        return $builder->get();
    }

    public function update_data_rekam($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_jalan');
        $builder->where('id_pemeriksaan', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data_rekam($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_jalan');
        $builder->where('id_pemeriksaan', $id);
        return $builder->delete();
    }
}