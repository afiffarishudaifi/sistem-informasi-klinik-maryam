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
        $builder->selectMax('no_antrian');
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

    public function data_pendaftar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis_jalan');
        $builder->select('id_pendaftaran');
        return $builder->get();
    }

    // resep
    public function view_data_resep()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_jalan');
        $builder->select('resep_jalan.id_resep, rekam_medis_jalan.id_pemeriksaan, sum(detail_resep.total_biaya) as tagihan_obat, pasien.nama_pasien, dokter.nama_dokter, rekam_medis_jalan.created_at');
        $builder->join('rekam_medis_jalan','rekam_medis_jalan.id_pemeriksaan = resep_jalan.id_pemeriksaan');
        $builder->join('pendaftaran_rawat_jalan','pendaftaran_rawat_jalan.id_pendaftaran = rekam_medis_jalan.id_pendaftaran');
        $builder->join('jadwal_dokter','pendaftaran_rawat_jalan.id_jadwal = jadwal_dokter.id_jadwal');
        $builder->join('dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
        $builder->join('detail_resep', 'resep_jalan.id_resep = detail_resep.id_resep', 'left');
        $builder->groupBy("resep_jalan.id_resep");
        return $builder->get();
    }

    public function add_data_resep($data)
    {
        $query = $this->db->table('resep_jalan')->insert($data);
        return $query;
    }

    public function detail_data_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_jalan');
        $builder->select('resep_jalan.id_resep, resep_jalan.tagihan_obat, pasien.nama_pasien, dokter.nama_dokter, rekam_medis_jalan.id_pemeriksaan, rekam_medis_jalan.created_at');
        $builder->join('rekam_medis_jalan','rekam_medis_jalan.id_pemeriksaan = resep_jalan.id_pemeriksaan');
        $builder->join('pendaftaran_rawat_jalan','pendaftaran_rawat_jalan.id_pendaftaran = rekam_medis_jalan.id_pendaftaran');
        $builder->join('jadwal_dokter','pendaftaran_rawat_jalan.id_jadwal = jadwal_dokter.id_jadwal');
        $builder->join('sesi','sesi.id_sesi = jadwal_dokter.id_sesi');
        $builder->join('dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        $builder->join('poliklinik','pendaftaran_rawat_jalan.id_poli = poliklinik.id_poli');
        $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
        $builder->where('id_resep', $id);
        return $builder->get();
    }

    public function update_data_resep($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_jalan');
        $builder->where('id_resep', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_jalan');
        $builder->where('id_resep', $id);
        return $builder->delete();
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

    public function harga_obat($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('obat');
        $builder->select('harga_obat, stok_obat');
        $builder->where('id_obat', $id);
        return $builder->get();
    }

    public function add_detail_resep($data)
    {
        $query = $this->db->table('detail_resep')->insert($data);
        return $query;
    }

    public function detail_data_detail_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep');
        $builder->select('id_detail, detail_resep.id_obat, obat.nama_obat, detail_resep.jumlah_obat, total_biaya, id_resep');
        $builder->join('obat','obat.id_obat = detail_resep.id_obat');
        $builder->where('id_detail', $id);
        return $builder->get();
    }

    public function update_detail_resep($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep');
        $builder->where('id_detail', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_detail_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep');
        $builder->where('id_detail', $id);
        return $builder->delete();
    }

    public function cek_stok_obat($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('obat');
        $builder->select('stok_obat');
        $builder->where('id_obat', $id);
        return $builder->get();
    }

    public function update_stok_obat($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('obat');
        $builder->where('id_obat', $id);
        $builder->set($data);
        return $builder->update();
    }
}