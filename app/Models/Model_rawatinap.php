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
        $builder->where('status_inap', 'Belum Selesai');
        return $builder->get();
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pendaftaran_inap');
        $builder->select("pendaftaran_inap.id_inap, pendaftaran_inap.id_kamar, pendaftaran_inap.id_pasien, pasien.nama_pasien, kamar.no_kamar, kamar.biaya_kamar, DATE_FORMAT(pendaftaran_inap.waktu_masuk, '%Y-%m-%dT%H:%i') as waktu_masuk, DATE_FORMAT(pendaftaran_inap.waktu_keluar, '%Y-%m-%dT%H:%i') as waktu_keluar, pendaftaran_inap.total_tagihan_inap, pendaftaran_inap.status_inap");
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
        $builder->select("rekam_medis_inap.id_rekam_inap, rekam_medis_inap.hasil_pemeriksaan, rekam_medis_inap.saran_dokter, rekam_medis_inap.tensi, rekam_medis_inap.id_pasien, rekam_medis_inap.id_dokter, DATE_FORMAT(rekam_medis_inap.waktu_rekam, '%Y-%m-%dT%H:%i') as waktu_rekam, pasien.nama_pasien, dokter.nama_dokter, poliklinik.nama_poli");
        $builder->join('dokter','dokter.id_dokter = rekam_medis_inap.id_dokter');
        $builder->join('jadwal_dokter','dokter.id_dokter = jadwal_dokter.id_dokter');
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

    //resep

    public function view_data_resep()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_inap');
        $builder->select('resep_inap.id_resep_inap, rekam_medis_inap.id_pasien, resep_inap.id_rekam_inap, rekam_medis_inap.id_dokter, pasien.nama_pasien, dokter.nama_dokter, rekam_medis_inap.created_at, sum(detail_resep_inap.total_biaya) as tagihan_obat');
        $builder->join('rekam_medis_inap','rekam_medis_inap.id_rekam_inap =resep_inap.id_rekam_inap');
        $builder->join('pasien','rekam_medis_inap.id_pasien = pasien.id_pasien');
        $builder->join('dokter','rekam_medis_inap.id_dokter = dokter.id_dokter');
        $builder->join('detail_resep_inap', 'resep_inap.id_resep_inap = detail_resep_inap.id_resep_inap','left');
        $builder->groupBy("resep_inap.id_resep_inap");
        return $builder->get();
    }

    public function add_data_resep($data)
    {
        $query = $this->db->table('resep_inap')->insert($data);
        return $query;
    }

    public function detail_data_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_inap');
        $builder->select('resep_inap.id_resep_inap, rekam_medis_inap.id_pasien, resep_inap.id_rekam_inap, rekam_medis_inap.id_dokter, pasien.nama_pasien, dokter.nama_dokter, rekam_medis_inap.created_at');
        $builder->join('rekam_medis_inap','rekam_medis_inap.id_rekam_inap =resep_inap.id_rekam_inap');
        $builder->join('pasien','rekam_medis_inap.id_pasien = pasien.id_pasien');
        $builder->join('dokter','rekam_medis_inap.id_dokter = dokter.id_dokter');
        $builder->join('poliklinik','dokter.id_poli = poliklinik.id_poli');
        $builder->where('id_resep_inap', $id);
        return $builder->get();
    }

    public function update_data_resep($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_inap');
        $builder->where('id_resep_inap', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep_inap');
        $builder->where('id_resep_inap', $id);
        return $builder->delete();
    }

    public function view_detail_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep_inap');
        $builder->select('detail_resep_inap.id_detail, detail_resep_inap.id_resep_inap, detail_resep_inap.id_obat, obat.nama_obat, detail_resep_inap.jumlah_obat, detail_resep_inap.total_biaya');
        $builder->join('obat','detail_resep_inap.id_obat = obat.id_obat');
        $builder->where('detail_resep_inap.id_resep_inap', $id);
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
        $query = $this->db->table('detail_resep_inap')->insert($data);
        return $query;
    }

    public function detail_data_detail_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep_inap');
        $builder->select('id_detail, detail_resep_inap.id_obat, obat.nama_obat, detail_resep_inap.jumlah_obat, total_biaya, id_resep_inap');
        $builder->join('obat','obat.id_obat = detail_resep_inap.id_obat');
        $builder->where('id_detail', $id);
        return $builder->get();
    }

    public function update_detail_resep($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep_inap');
        $builder->where('id_detail', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_detail_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_resep_inap');
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
