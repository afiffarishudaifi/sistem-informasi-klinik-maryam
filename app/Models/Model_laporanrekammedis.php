<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_laporanrekammedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_rekam';

   	public function filter_jalan($param)
    {
  //   	$db      = \Config\Database::connect();
  //       $builder = $db->table('rekam_medis');
		// $builder->select('pasien.nama_pasien, dokter.nama_dokter, hasil_pemeriksaan, saran_dokter, tensi_darah, DATE_FORMAT(rekam_medis.tanggal_rekam,"%d %M %Y") as tanggal_rekam');
		// $builder->join('pasien','pasien.nik = rekam_medis.nik');
		// $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
  //       if ($param['cek_waktu1']) $builder->where('rekam_medis.tanggal_rekam >= ', $param['cek_waktu1']);
  //       if ($param['nik']) $builder->where('rekam_medis.nik', $param['nik']);
  //       return $builder->get();
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis');
        $builder->select('pasien.nama_pasien, dokter.nama_dokter, hasil_pemeriksaan, saran_dokter, tensi_darah, DATE_FORMAT(rekam_medis.tanggal_rekam,"%d %M %Y") as tanggal_rekam');
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('pasien','rekam_medis.nik = pasien.nik');
        $builder->join('penyakit','rekam_medis.id_penyakit = penyakit.id_penyakit');
        $builder->where('rekam_medis.status','Jalan');
        if ($param['cek_waktu1']) $builder->where('rekam_medis.tanggal_rekam >= ', $param['cek_waktu1']);
        if ($param['nik']) $builder->where('rekam_medis.nik', $param['nik']);
        return $builder->get();
    }

    public function filter_inap($param)
    {
  //   	$db      = \Config\Database::connect();
  //       $builder = $db->table('rekam_medis');
		// $builder->select('pasien.nama_pasien, dokter.nama_dokter, hasil_pemeriksaan, saran_dokter, DATE_FORMAT(rekam_medis.tanggal_rekam,"%d %M %Y") as tanggal_rekam');
  //       $builder->join('rawat_inap','rawat_inap.id_inap = rekam_medis.id_inap');
		// $builder->join('pasien','rawat_inap.nik = rekam_medis.nik');
		// $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
  //       $builder->where('rekam_medis.status','Inap');
  //       if ($param['cek_waktu1']) $builder->where('rekam_medis.tanggal_rekam >= ', $param['cek_waktu1']);
  //       if ($param['nik']) $builder->where('rawat_inap.nik', $param['nik']);
  //       return $builder->get();
        $db      = \Config\Database::connect();
        $builder = $db->table('rekam_medis');
        $builder->select('nama_pasien, nama_dokter, hasil_pemeriksaan, saran_dokter, DATE_FORMAT(rekam_medis.tanggal_rekam,"%d %M %Y") as tanggal_rekam');
        $builder->join('dokter','dokter.nik_dokter = rekam_medis.nik_dokter');
        $builder->join('rawat_inap','rawat_inap.id_inap = rekam_medis.id_inap');
        $builder->join('pasien','rawat_inap.nik = pasien.nik');
        $builder->join('penyakit','rekam_medis.id_penyakit = penyakit.id_penyakit');
        $builder->where('rekam_medis.status','Inap');
        if ($param['cek_waktu1']) $builder->where('rekam_medis.tanggal_rekam >= ', $param['cek_waktu1']);
        if ($param['nik']) $builder->where('rawat_inap.nik', $param['nik']);
        return $builder->get();
    }
}
