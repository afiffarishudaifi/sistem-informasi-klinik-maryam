<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_rawatinap extends Model
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
        $builder->where('status_inap !=', 'Belum Selesai');
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


    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_inap');
        $builder->where('id_inap', $id);
        return $builder->delete();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_inap');
        $builder->join('resep_inap', 'resep_inap.id_inap = pendaftaran_inap.id_inap');
        $builder->where('pendaftaran_inap.id_inap', $id);
        return $builder->countAllResults();
    }

    //rekam medis

    public function view_data_rekam()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_inap');
        $builder->select('rekam_medis_inap.id_rekam_inap, rekam_medis_inap.hasil_pemeriksaan, rekam_medis_inap.saran_dokter, rekam_medis_inap.tensi, rekam_medis_inap.waktu_rekam, rekam_medis_inap.id_pasien, rekam_medis_inap.id_dokter, pasien.nama_pasien, dokter.nama_dokter');
        $builder->join('dokter','dokter.id_dokter = rekam_medis_inap.id_dokter');
        $builder->join('jadwal_dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        $builder->join('sesi','sesi.id_sesi = jadwal_dokter.id_sesi');
        $builder->join('pasien','rekam_medis_inap.id_pasien = pasien.id_pasien');
        return $builder->get();
    }

    public function add_data_rekam($data)
    {
        $query = $this->db->table('rekam_medis_inap')->insert($data);
        return $query;
    }

    public function detail_data_rekam($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_inap');
        $builder->select('rekam_medis_inap.id_rekam_inap, rekam_medis_inap.hasil_pemeriksaan, rekam_medis_inap.saran_dokter, rekam_medis_inap.tensi, rekam_medis_inap.id_pasien, rekam_medis_inap.id_dokter, rekam_medis_inap.waktu_rekam, pasien.nama_pasien, dokter.nama_dokter, poliklinik.nama_poli');
        $builder->join('dokter','dokter.id_dokter = rekam_medis_inap.id_dokter');
        $builder->join('jadwal_dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        $builder->join('sesi','sesi.id_sesi = jadwal_dokter.id_sesi');
        $builder->join('pasien','rekam_medis_inap.id_pasien = pasien.id_pasien');
        $builder->join('poliklinik','poliklinik.id_poli = dokter.id_poli');
        $builder->where('id_rekam_inap', $id);
        return $builder->get();
    }

    public function update_data_rekam($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_inap');
        $builder->where('id_rekam_inap', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data_rekam($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_inap');
        $builder->where('id_rekam_inap', $id);
        return $builder->delete();
    }




}