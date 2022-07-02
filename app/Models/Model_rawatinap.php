<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_rawatinap extends Model
{
    protected $table = 'rawat_inap';
    protected $primaryKey = 'id_inap';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rawat_inap');
        $builder->select('rawat_inap.id_inap, rawat_inap.id_kamar, rawat_inap.nik, pasien.nama_pasien, kamar.nama_kamar, kamar.biaya_kamar, rawat_inap.waktu_masuk, rawat_inap.waktu_keluar, rawat_inap.total_tagihan_inap, rawat_inap.status_inap');
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
        $builder->select("rawat_inap.id_inap, rawat_inap.id_kamar, rawat_inap.nik, pasien.nama_pasien, kamar.nama_kamar, kamar.biaya_kamar, DATE_FORMAT(rawat_inap.waktu_masuk, '%Y-%m-%dT%H:%i') as waktu_masuk, DATE_FORMAT(rawat_inap.waktu_keluar, '%Y-%m-%dT%H:%i') as waktu_keluar, rawat_inap.total_tagihan_inap, rawat_inap.status_inap");
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

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rawat_inap');
        $builder->where('id_inap', $id);
        return $builder->delete();
    }

    public function cek_foreign($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rawat_inap');
        $builder->join('resep_inap', 'resep_inap.id_inap = rawat_inap.id_inap');
        $builder->where('rawat_inap.id_inap', $id);
        return $builder->countAllResults();
    }

    //rekam medis

    public function view_data_rekam($bulan_ini, $tahun_ini)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis');
        $builder->select('rekam_medis.id_rekam, rekam_medis.hasil_pemeriksaan, rekam_medis.saran_dokter, rekam_medis.tensi_darah, rekam_medis.tanggal_rekam, rekam_medis.nik, rekam_medis.nik_dokter, kamar.nama_kamar, dokter.nama_dokter, nama_penyakit');
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('rawat_inap','rekam_medis.id_inap = rawat_inap.id_inap');
        $builder->join('kamar','rawat_inap.id_kamar = kamar.id_kamar');
        // $builder->join('pasien','rekam_medis.nik = pasien.nik');
        $builder->join('penyakit','rekam_medis.id_penyakit = penyakit.id_penyakit');
        $builder->where('rekam_medis.status','Inap');
        $builder->where('month(tanggal_rekam)', $bulan_ini);
        $builder->where('year(tanggal_rekam)', $tahun_ini);
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
        $builder->select("rekam_medis.id_rekam, rawat_inap.id_inap, nama_kamar, rekam_medis.hasil_pemeriksaan, rekam_medis.saran_dokter, rekam_medis.tensi_darah, DATE_FORMAT(rekam_medis.tanggal_rekam, '%Y-%m-%dT%H:%i') as tanggal_rekam, rekam_medis.nik, rekam_medis.nik_dokter, pasien.nama_pasien, dokter.nama_dokter, penyakit.id_penyakit, nama_penyakit, tensi_darah");
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('rawat_inap','rekam_medis.id_inap = rawat_inap.id_inap');
        $builder->join('kamar','rawat_inap.id_kamar = kamar.id_kamar');
        $builder->join('pasien','rawat_inap.nik = pasien.nik');
        $builder->join('penyakit','rekam_medis.id_penyakit = penyakit.id_penyakit');
        $builder->where('rekam_medis.id_rekam', $id);
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

    public function delete_data_rekam($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis');
        $builder->where('id_rekam', $id);
        return $builder->delete();
    }

    //resep

    public function view_data_resep()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep');
        $builder->select('resep.id_resep, sum(detail_resep.total_biaya) as tagihan_obat, pasien.nama_pasien, dokter.nama_dokter, tanggal');
        $builder->join('rekam_medis','rekam_medis.id_rekam = rekam_medis.id_rekam');
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('pasien','rekam_medis.nik = pasien.nik');
        $builder->join('detail_resep', 'resep.id_resep = detail_resep.id_resep', 'left');
        $builder->groupBy("resep.id_resep");
        $builder->where('resep.status','Inap');
        return $builder->get();
    }

    public function add_data_resep($data)
    {
        $query = $this->db->table('resep')->insert($data);
        return $query;
    }

    public function detail_data_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep');
        $builder->select("resep.id_resep, resep.tagihan_obat, pasien.nama_pasien, dokter.nama_dokter, rekam_medis.id_rekam, rekam_medis.tanggal_rekam, DATE_FORMAT(resep.tanggal, '%Y-%m-%d') as tanggal, status_bayar");
        $builder->join('rekam_medis','rekam_medis.id_rekam = resep.id_rekam');
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('pasien','rekam_medis.nik = pasien.nik');
        $builder->where('id_resep', $id);
        return $builder->get();
    }

    public function update_data_resep($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep');
        $builder->where('id_resep', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data_resep($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('resep');
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
        $builder->select('id_detail, detail_resep.id_obat, resep.id_resep, obat.nama_obat, detail_resep.jumlah_obat, total_biaya, id_rekam');
        $builder->join('resep','resep.id_resep = detail_resep.id_resep');
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
