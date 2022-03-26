<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_rawatjalan extends Model
{
    protected $table = 'antrian';
    protected $primaryKey = 'id_antrian';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->select('id_antrian, pasien.nik, pasien.nama_pasien, poli.nama_poli, antrian.no_antrian, antrian.status_antrian');
        $builder->join('poli','antrian.id_poli = poli.id_poli');
        $builder->join('pasien','antrian.nik = pasien.nik');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('antrian')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->select("id_antrian, pasien.nik, pasien.nama_pasien, pasien.nik, poli.id_poli, antrian.keluhan, antrian.umur, antrian.status_antrian, DATE_FORMAT(antrian.tanggal_daftar, '%Y-%m-%dT%H:%i') as tanggal_daftar, poli.nama_poli, antrian.no_antrian, antrian.status_antrian");
        $builder->join('poli','antrian.id_poli = poli.id_poli');
        $builder->join('pasien','antrian.nik = pasien.nik');
        $builder->where('id_antrian', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->where('id_antrian', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->where('id_antrian', $id);
        return $builder->delete();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->join('resep_jalan', 'resep_jalan.id_antrian = antrian.id_antrian');
        $builder->where('antrian.id_antrian', $id);
        return $builder->countAllResults();
    }

    public function cek_max($params)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->selectMax('no_antrian');
        $builder->join('poli','antrian.id_poli = poli.id_poli');
        $builder->where('poli.id_poli',$params['id_poli']);
        $builder->where('antrian.tanggal_daftar', $params['tanggal_daftar']);
        return $builder->get();
    }

    // rekam medis

    public function view_data_rekam()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis');
        $builder->select('id_rekam, pasien.nama_pasien, dokter.nama_dokter, rekam_medis.hasil_pemeriksaan, penyakit.nama_penyakit, saran_dokter, tensi_darah');
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('pasien','rekam_medis.nik = pasien.nik');
        $builder->join('penyakit','rekam_medis.id_penyakit = penyakit.id_penyakit');
        return $builder->get();
    }

    public function add_data_rekam($data)
    {
        $query = $this->db->table('rekam_medis')->insert($data);
        return $query;
    }

    public function detail_data_rekam($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis');
        $builder->select("rekam_medis.id_rekam, rekam_medis.hasil_pemeriksaan, rekam_medis.saran_dokter, rekam_medis.tensi_darah, rekam_medis.id_rekam, pasien.nama_pasien, rekam_medis.tanggal_rekam, dokter.nama_dokter, penyakit.nama_penyakit, pasien.nik, dokter.nik_dokter, penyakit.id_penyakit");
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('penyakit','rekam_medis.id_penyakit = penyakit.id_penyakit');
        $builder->join('pasien','rekam_medis.nik = pasien.nik');
        $builder->where('id_rekam', $id);
        return $builder->get();
    }

    public function update_data_rekam($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis');
        $builder->where('id_rekam', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function data_pendaftar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->select('id_antrian');
        return $builder->get();
    }

    // resep
    public function view_data_resep()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep');
        $builder->select('resep.id_resep, sum(detail_resep.total_biaya) as tagihan_obat, pasien.nama_pasien, dokter.nama_dokter');
        $builder->join('rekam_medis','rekam_medis.id_rekam = rekam_medis.id_rekam');
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('pasien','rekam_medis.nik = pasien.nik');
        $builder->join('detail_resep', 'resep.id_resep = detail_resep.id_resep', 'left');
        $builder->groupBy("resep.id_resep");
        return $builder->get();
    }

    public function detail_data_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_jalan');
        $builder->select('resep_jalan.id_resep, resep_jalan.tagihan_obat, pasien.nama_pasien, dokter.nama_dokter, rekam_medis_jalan.id_pemeriksaan, rekam_medis_jalan.created_at');
        $builder->join('rekam_medis_jalan','rekam_medis_jalan.id_pemeriksaan = resep_jalan.id_pemeriksaan');
        $builder->join('antrian','antrian.id_antrian = rekam_medis_jalan.id_antrian');
        $builder->join('jadwal_dokter','antrian.id_jadwal = jadwal_dokter.id_jadwal');
        $builder->join('dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
        $builder->join('poli','antrian.id_poli = poli.id_poli');
        $builder->join('pasien','antrian.id_pasien = pasien.id_pasien');
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
        $builder->select('detail_resep.id_detail, detail_resep.id_antrian, detail_resep.id_obat, obat.nama_obat, detail_resep.jumlah_obat, detail_resep.total_biaya');
        $builder->join('obat','detail_resep.id_obat = obat.id_obat');
        $builder->where('detail_resep.id_antrian', $id);
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
        $builder->select('id_detail, detail_resep.id_obat, obat.nama_obat, detail_resep.jumlah_obat, total_biaya, id_antrian');
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

    // pasien
    public function view_data_pasien($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->select('id_pasien');
        $builder->where('id_pasien', $id);
        $builder->where('status_antrian =', 'Menunggu');
        return $builder->get();
    }

    public function antrian($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('antrian');
        $builder->select('no_antrian');
        $builder->where('id_pasien', $id);
        $builder->where('status_antrian =', 'Menunggu');
        return $builder->get();
    }
}
