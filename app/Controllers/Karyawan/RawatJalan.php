<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\Model_rawatjalan;

class RawatJalan extends BaseController
{
    protected $Model_rawatjalan;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }

        $this->Model_rawatjalan = new Model_rawatjalan();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_rawatjalan();

        // $tanggal = Date();
        // var_dump($tanggal);
        $data = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Rawat Jalan',
            'data' => $data
        ];
        return view('Karyawan/viewDaftarRawatJalan', $data);
    }

    public function add_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $poli = $this->request->getPost('input_poli');
        $tanggal_daftar = $this->request->getPost('input_tanggal');
        $params = [
            'id_poli' => $poli,
            'tanggal_daftar' => $tanggal_daftar
        ];  
        $max = $model->cek_max($params)->getRowArray()['no_antrian'];
        if ($max == null) {
            $max = 1;
        } else {
            $max = $max + 1;
        }

        $data = array(
            'nik'     => $this->request->getPost('input_pasien'),
            'id_poli'     => $poli,
            'keluhan'     => $this->request->getPost('input_keluhan'),
            'umur'     => $this->request->getPost('input_umur'),
            'tanggal_daftar'     => $tanggal_daftar,
            'no_antrian' => $max,
            'status_antrian' => 'Menunggu'
        );

        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Karyawan/RawatJalan'));
    }

    public function update_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatjalan();
        
        $id = $this->request->getPost('id_antrian');
        $poli = $this->request->getPost('edit_poli');
        $tanggal_daftar = $this->request->getPost('edit_tanggal');
        $params = [
            'id_poli' => $poli,
            'tanggal_daftar' => $tanggal_daftar
        ];  
        $max = $model->cek_max($params)->getRowArray()['id_antrian'];
        if ($max == null) {
            $max = 1;
        } else {
            $max = $max + 1;
        }

        $data = array(
            'nik'     => $this->request->getPost('edit_pasien'),
            'id_poli'     => $poli,
            'keluhan'     => $this->request->getPost('edit_keluhan'),
            'umur'     => $this->request->getPost('edit_umur'),
            'tanggal_daftar'     => $tanggal_daftar,
            'no_antrian' => $max,
            'status_antrian' => 'Menunggu'
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Karyawan/RawatJalan'));
    }

    public function delete_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Karyawan/RawatJalan');
    }

    public function data_edit($id_antrian)
    {
        $model = new Model_rawatjalan();
        $datahari = $model->detail_data($id_antrian)->getResultArray();
        $respon = json_decode(json_encode($datahari), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_antrian'] = $value['id_antrian'];
            $isi['nik'] = $value['nik'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['id_poli'] = $value['id_poli'];
            $isi['nama_poli'] = $value['nama_poli'];
            $isi['keluhan'] = $value['keluhan'];
            $isi['umur'] = $value['umur'];
            $isi['status_antrian'] = $value['status_antrian'];
            $isi['tanggal_daftar'] = $value['tanggal_daftar'];
        endforeach;
        echo json_encode($isi);
    }

    public function data_poli()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("poli");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_poli, nama_poli');
            $builder->like('nama_poli', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_poli, nama_poli');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $poli[] = array(
                "id" => $country->id_poli,
                "text" => $country->nama_poli,
            );
        }

        $response['data'] = $poli;

        return $this->response->setJSON($response);
    }

    public function data_pasien()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("pasien");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('nik, nama_pasien');
            $builder->like('nama_pasien', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('nik, nama_pasien');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $pasien[] = array(
                "id" => $country->nik,
                "text" => $country->nama_pasien,
            );
        }

        $response['data'] = $pasien;

        return $this->response->setJSON($response);
    }

    public function rekamJalan()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $data = $model->view_data_rekam()->getResultArray();

        $data = [
            'judul' => 'Tabel Rekam Medis Rawat Jalan',
            'data' => $data
        ];
        return view('Karyawan/viewRekamMedisJalan', $data);
    }

    public function data_pendaftaran()
    {   
        $session = session();
        $model = new Model_rawatjalan();
        $id_pendaftar = array();

        $pendaftar = $model->data_pendaftar()->getResultArray();
        foreach ($pendaftar as $value) {
            array_push($id_pendaftar, $value['id_antrian']);
        }

        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("antrian");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            $builder->select('antrian.id_antrian, pasien.nama_pasien, tanggal_daftar');
            $builder->join('pasien','antrian.nik = pasien.nik');
            $builder->where('tanggal_daftar', date('Y-m-d'));
            $builder->whereNotIn('antrian.id_antrian', $id_pendaftar);
            $builder->like('tanggal_daftar', $query, 'both');
            $builder->orderBy('antrian.id_antrian', 'DESC');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            $builder->select('antrian.id_antrian, pasien.nama_pasien, tanggal_daftar');
            $builder->join('pasien','antrian.nik = pasien.nik');
            $builder->where('tanggal_daftar', date('Y-m-d'));
            $builder->whereNotIn('antrian.id_antrian', $id_pendaftar);
            $builder->orderBy('antrian.id_antrian', 'DESC');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $pendaftaran) {
            $pasien[] = array(
                "id" => $pendaftaran->id_antrian,
                "text" => $pendaftaran->tanggal_daftar . ' pasien ' . $pendaftaran->nama_pasien,
            );
        }

        $response['data'] = $pasien;

        return $this->response->setJSON($response);
    }

    public function add_rekam()
    {
        $session = session();
        $model = new Model_rawatjalan();

        $data = array(
            'id_penyakit'     => $this->request->getPost('input_penyakit'),
            'nik'     => $this->request->getPost('input_pasien'),
            'nik_dokter'     => $this->request->getPost('input_dokter'),
            'hasil_pemeriksaan'     => $this->request->getPost('input_hasil'),
            'saran_dokter'     => $this->request->getPost('input_saran'),
            'tensi_darah'     => $this->request->getPost('input_tensi')
        );

        $model->add_data_rekam($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Karyawan/RawatJalan/rekamJalan'));
    }

    public function update_rekam()
    {
        $session = session();
        $model = new Model_rawatjalan();
        
        $id = $this->request->getPost('id_rekam');
        $data = array(
            'id_penyakit'     => $this->request->getPost('edit_penyakit'),
            'nik'     => $this->request->getPost('edit_pasien'),
            'nik_dokter'     => $this->request->getPost('edit_dokter'),
            'hasil_pemeriksaan'     => $this->request->getPost('edit_hasil'),
            'saran_dokter'     => $this->request->getPost('edit_saran'),
            'tensi_darah'     => $this->request->getPost('edit_tensi')
        );

        $model->update_data_rekam($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Karyawan/RawatJalan/rekamJalan'));
    }

    public function delete_rekam()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data_rekam($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Karyawan/RawatJalan/rekamJalan');
    }

    public function data_edit_rekam($id_rekam)
    {
        $model = new Model_rawatjalan();
        $datahari = $model->detail_data_rekam($id_rekam)->getResultArray();
        $respon = json_decode(json_encode($datahari), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_rekam'] = $value['id_rekam'];
            $isi['tanggal_rekam'] = $value['tanggal_rekam'];
            $isi['nik'] = $value['nik'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['nik_dokter'] = $value['nik_dokter'];
            $isi['nama_dokter'] = $value['nama_dokter'];
            $isi['id_penyakit'] = $value['id_penyakit'];
            $isi['nama_penyakit'] = $value['nama_penyakit'];
            $isi['hasil_pemeriksaan'] = $value['hasil_pemeriksaan'];
            $isi['tensi_darah'] = $value['tensi_darah'];
            $isi['saran_dokter'] = $value['saran_dokter'];
        endforeach;
        echo json_encode($isi);
    }

    public function resepJalan()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $data = $model->view_data_resep()->getResultArray();

        $data = [
            'judul' => 'Tabel Resep Rawat Jalan',
            'data' => $data
        ];
        return view('Karyawan/viewResepJalan', $data);
    }

    public function data_obat()
    {
        $this->db = db_connect();
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("obat");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_obat, nama_obat');
            $builder->like('nama_obat', $query, 'both');
            $builder->where('stok_obat !=',0);
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_obat, nama_obat');
            $builder->where('stok_obat !=',0);
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $poli[] = array(
                "id" => $country->id_obat,
                "text" => $country->nama_obat,
            );
        }

        $response['data'] = $poli;

        return $this->response->setJSON($response);
    }

    public function data_rekam()
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("rekam_medis");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            $builder->select('id_rekam, pasien.nama_pasien, rekam_medis.tanggal_rekam');
            $builder->join('pasien','rekam_medis.nik = pasien.nik');
            $builder->where('rekam_medis.status','Jalan');
            $builder->orderBy('id_rekam', 'DESC');
            $builder->like('date(rekam_medis.tanggal_rekam)', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            $builder->select('id_rekam, pasien.nama_pasien, rekam_medis.tanggal_rekam');
            $builder->join('pasien','rekam_medis.nik = pasien.nik');
            $builder->where('rekam_medis.status','Jalan');
            $builder->orderBy('id_rekam', 'DESC');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $data_rekam) {
            $pasien[] = array(
                "id" => $data_rekam->id_rekam,
                "text" => $data_rekam->tanggal_rekam . ' pasien ' . $data_rekam->nama_pasien,
            );
        }

        $response['data'] = $pasien;

        return $this->response->setJSON($response);
    }

    public function add_resep()
    {
        $session = session();
        $model = new Model_rawatjalan();
        if($this->request->getPost('input_status') == '') {
            $status = 'Belum Lunas';
        } else {
            $status = 'Lunas';
        }

        $data = array(
            'id_rekam'     => $this->request->getPost('input_rekam'),
            'tanggal'     => $this->request->getPost('input_tanggal'),
            'status_bayar'     => $status
        );

        $model->add_data_resep($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Karyawan/RawatJalan/resepJalan'));
    }

    public function update_resep()
    {
        $session = session();
        $model = new Model_rawatjalan();
        if($this->request->getPost('edit_status') == '') {
            $status = 'Belum Lunas';
        } else {
            $status = 'Lunas';
        }
        
        $id = $this->request->getPost('id_resep');
        $data = array(
            'id_rekam'     => $this->request->getPost('edit_rekam'),
            'tanggal'     => $this->request->getPost('edit_tanggal'),
            'status_bayar'     => $status
        );

        $model->update_data_resep($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Karyawan/RawatJalan/resepJalan'));
    }

    public function delete_resep()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data_resep($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Karyawan/RawatJalan/resepJalan');
    }

    public function data_edit_resep($id_resep)
    {
        $model = new Model_rawatjalan();
        $dataresep = $model->detail_data_resep($id_resep)->getResultArray();
        $respon = json_decode(json_encode($dataresep), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_resep'] = $value['id_resep'];
            $isi['id_rekam'] = $value['id_rekam'];
            // $isi['tanggal_rekam'] = $value['tanggal_rekam'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['tanggal'] = $value['tanggal'];
            $isi['status_bayar'] = $value['status_bayar'];
        endforeach;
        echo json_encode($isi);
    }

    // detail resep
    public function detailResep($id)
    {
        $session = session();
        $model = new Model_rawatjalan();
        $data = $model->view_detail_resep($id)->getResultArray();

        $data = [
            'judul' => 'Tabel Detail Resep ' . $id,
            'data' => $data,
            'id_resep' => $id
        ];
        return view('Karyawan/viewDetailResepJalan', $data);
    }

    public function harga_obat($id)
    {
        $model = new Model_rawatjalan();
        $harga = $model->harga_obat($id)->getRowArray();
        $isi['harga_obat'] = $harga['harga_obat'];
        echo json_encode($isi);
    }

    public function add_detail_resep()
    {
        $session = session();
        $model = new Model_rawatjalan();

        $id_resep = $this->request->getPost('id_resep');
        $id_obat = $this->request->getPost('input_obat');
        $jumlah_obat = $this->request->getPost('input_jumlah');
        $cek_stok = $model->cek_stok_obat($id_obat)->getRowArray();

        if ($cek_stok['stok_obat'] < $jumlah_obat) {
            $session->setFlashdata('gagal', 'Stok obat tidak mencukupi');
            return redirect()->to(base_url('Karyawan/RawatJalan/detailResep' . '/' . $id_resep));
        }

        $stok_baru = $cek_stok['stok_obat'] - $jumlah_obat;

        $data = array(
            'stok_obat' => $stok_baru
        );

        $model->update_stok_obat($data, $id_obat);

        $data = array(
            'id_obat'     => $id_obat,
            'jumlah_obat' => $jumlah_obat,
            'total_biaya' => $this->request->getPost('input_total'),
            'id_resep'     => $id_resep
        );

        $model->add_detail_resep($data);

        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Karyawan/RawatJalan/detailResep' . '/' . $id_resep));
    }

    public function update_detail_resep()
    {
        $session = session();
        $model = new Model_rawatjalan();
        
        $id = $this->request->getPost('id_detail');
        $id_resep = $this->request->getPost('edit_resep');
        $id_obat = $this->request->getPost('edit_obat');
        $old_jumlah = $this->request->getPost('old_jumlah');
        $new_jumlah = $this->request->getPost('edit_jumlah');

        $data = array(
            'id_obat'     => $id_obat,
            'jumlah_obat' => $new_jumlah,
            'total_biaya' => $this->request->getPost('edit_total')
        );

        $cek_stok = $model->cek_stok_obat($id_obat)->getRowArray();

        if ($cek_stok['stok_obat'] < $new_jumlah) {
            $session->setFlashdata('gagal', 'Stok obat tidak mencukupi');
            return redirect()->to(base_url('Karyawan/RawatJalan/detailResep' . '/' . $id_resep));
        }

        if ($old_jumlah < $new_jumlah) {
            $selisih = $new_jumlah - $old_jumlah;
            $stok_baru = $cek_stok['stok_obat'] - $selisih;
        } else {
            $selisih = $old_jumlah - $new_jumlah;
            $stok_baru = $cek_stok['stok_obat'] + $selisih;
        }

        $data_obat = array(
            'stok_obat' => $stok_baru
        );

        $model->update_stok_obat($data_obat, $id_obat);

        $model->update_detail_resep($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Karyawan/RawatJalan/detailResep' . '/' . $id_resep));
    }

    public function delete_detail_resep()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $id = $this->request->getPost('id');
        $id_resep = $this->request->getPost('id_resep');
        $model->delete_detail_resep($id);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Karyawan/RawatJalan/detailResep' . '/' . $id_resep);
    }

    public function data_edit_detail_resep($id_detail)
    {
        $model = new Model_rawatjalan();
        $dataresep = $model->detail_data_detail_resep($id_detail)->getResultArray();
        $respon = json_decode(json_encode($dataresep), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_detail'] = $value['id_detail'];
            $isi['id_resep'] = $value['id_resep'];
            $isi['id_obat'] = $value['id_obat'];
            $isi['nama_obat'] = $value['nama_obat'];
            $isi['jumlah_obat'] = $value['jumlah_obat'];
            $isi['total_biaya'] = $value['total_biaya'];
        endforeach;
        echo json_encode($isi);
    }

    public function data_dokter()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("dokter");

        $dokter = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('dokter.nik_dokter, dokter.nama_dokter');
            $builder->like('nama_dokter', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('dokter.nik_dokter, dokter.nama_dokter');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $data_dokter) {
            $dokter[] = array(
                "id" => $data_dokter->nik_dokter,
                "text" => $data_dokter->nama_dokter,
            );
        }

        $response['data'] = $dokter;

        return $this->response->setJSON($response);
    }

    public function data_penyakit()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("penyakit");

        $dokter = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_penyakit, nama_penyakit');
            $builder->like('nama_penyakit', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_penyakit, nama_penyakit');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $data_penyakit) {
            $dokter[] = array(
                "id" => $data_penyakit->id_penyakit,
                "text" => $data_penyakit->nama_penyakit,
            );
        }

        $response['data'] = $dokter;

        return $this->response->setJSON($response);
    }

    public function SelesaiAntrian($id)
    {
        $session = session();
        $model = new Model_rawatjalan();

        $data = array(
            'status_antrian' => 'Sudah Dipanggil'
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Karyawan/RawatJalan'));   
    }
}
