<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_rawatjalan;

class RawatJalan extends BaseController
{
    protected $Model_rawatjalan;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }

        $this->Model_rawatjalan = new Model_rawatjalan();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $data = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Rawat Jalan',
            'data' => $data
        ];
        return view('Admin/viewDaftarRawatJalan', $data);
    }

    public function add_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $poli = $this->request->getPost('input_poli');
        $jadwal = $this->request->getPost('input_jadwal');
        $tanggal_daftar = $this->request->getPost('input_tanggal');
        $params = [
            'id_poli' => $poli,
            'id_jadwal' => $jadwal,
            'tanggal_daftar' => $tanggal_daftar
        ];  
        $max = $model->cek_max($params)->getRowArray()['no_antrian'];
        if ($max == null) {
            $max = 1;
        } else {
            $max = $max + 1;
        }

        $data = array(
            'id_pasien'     => $this->request->getPost('input_pasien'),
            'id_poli'     => $poli,
            'id_jadwal'     => $jadwal,
            'keluhan'     => $this->request->getPost('input_keluhan'),
            'umur'     => $this->request->getPost('input_umur'),
            'tanggal_daftar'     => $tanggal_daftar,
            'no_antrian' => $max,
            'status_antrian' => 'Menunggu'
        );

        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/RawatJalan'));
    }

    public function update_pendaftaran()
    {
        $session = session();
        $model = new Model_rawatjalan();
        
        $id = $this->request->getPost('id_pendaftaran');
        $poli = $this->request->getPost('edit_poli');
        $jadwal = $this->request->getPost('edit_jadwal');
        $tanggal_daftar = $this->request->getPost('edit_tanggal');
        $params = [
            'id_poli' => $poli,
            'id_jadwal' => $jadwal,
            'tanggal_daftar' => $tanggal_daftar
        ];  
        $max = $model->cek_max($params)->getRowArray()['id_pendaftaran'];
        if ($max == null) {
            $max = 1;
        } else {
            $max = $max + 1;
        }

        $data = array(
            'id_pasien'     => $this->request->getPost('edit_pasien'),
            'id_poli'     => $poli,
            'id_jadwal'     => $jadwal,
            'keluhan'     => $this->request->getPost('edit_keluhan'),
            'umur'     => $this->request->getPost('edit_umur'),
            'tanggal_daftar'     => $tanggal_daftar,
            'no_antrian' => $max,
            'status_antrian' => 'Menunggu'
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/RawatJalan'));
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
        return redirect()->to('/Admin/RawatJalan');
    }

    public function data_edit($id_pendaftaran)
    {
        $model = new Model_rawatjalan();
        $datahari = $model->detail_data($id_pendaftaran)->getResultArray();
        $respon = json_decode(json_encode($datahari), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_pendaftaran'] = $value['id_pendaftaran'];
            $isi['id_pasien'] = $value['id_pasien'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['id_poli'] = $value['id_poli'];
            $isi['nama_poli'] = $value['nama_poli'];
            $isi['id_jadwal'] = $value['id_jadwal'];
            $isi['nama_hari'] = $value['nama_hari'];
            $isi['nama_sesi'] = $value['nama_sesi'];
            $isi['nama_dokter'] = $value['nama_dokter'];
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
        $builder = $this->db->table("poliklinik");

        $poli = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_poli, nama_poli');
            $builder->like('nama_poli', $query, 'both');
            $builder->where('status_poli','Aktif');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_poli, nama_poli');
            $builder->where('status_poli','Aktif');
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
            $builder->select('id_pasien, nama_pasien');
            $builder->like('nama_pasien', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_pasien, nama_pasien');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $pasien[] = array(
                "id" => $country->id_pasien,
                "text" => $country->nama_pasien,
            );
        }

        $response['data'] = $pasien;

        return $this->response->setJSON($response);
    }

    public function data_jadwal()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("jadwal_dokter");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_jadwal, id_jadwal, hari.nama_hari, sesi.nama_sesi');
            $builder->join('hari','jadwal_dokter.id_hari = hari.id_hari');
            $builder->join('sesi','jadwal_dokter.id_sesi = sesi.id_sesi');
            $builder->where('status_jadwal','Aktif');
            $builder->like('hari.nama_hari', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_jadwal, id_jadwal, hari.nama_hari, sesi.nama_sesi');
            $builder->join('hari','jadwal_dokter.id_hari = hari.id_hari');
            $builder->join('sesi','jadwal_dokter.id_sesi = sesi.id_sesi');
            $builder->where('status_jadwal','Aktif');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $pasien[] = array(
                "id" => $country->id_jadwal,
                "text" => $country->nama_hari . ', ' . $country->nama_sesi,
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
        return view('Admin/viewRekamMedisJalan', $data);
    }

    public function data_pendaftaran()
    {   
        $session = session();
        $model = new Model_rawatjalan();
        $id_pendaftar = array();

        $pendaftar = $model->data_pendaftar()->getResultArray();
        foreach ($pendaftar as $value) {
            array_push($id_pendaftar, $value['id_pendaftaran']);
        }

        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("pendaftaran_rawat_jalan");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            $builder->select('pendaftaran_rawat_jalan.id_pendaftaran, pasien.nama_pasien, tanggal_daftar');
            $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
            $builder->where('tanggal_daftar', date('Y-m-d'));
            $builder->whereNotIn('pendaftaran_rawat_jalan.id_pendaftaran', $id_pendaftar);
            $builder->like('tanggal_daftar', $query, 'both');
            $builder->orderBy('pendaftaran_rawat_jalan.id_pendaftaran', 'DESC');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            $builder->select('pendaftaran_rawat_jalan.id_pendaftaran, pasien.nama_pasien, tanggal_daftar');
            $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
            $builder->where('tanggal_daftar', date('Y-m-d'));
            $builder->whereNotIn('pendaftaran_rawat_jalan.id_pendaftaran', $id_pendaftar);
            $builder->orderBy('pendaftaran_rawat_jalan.id_pendaftaran', 'DESC');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $pendaftaran) {
            $pasien[] = array(
                "id" => $pendaftaran->id_pendaftaran,
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
            'id_pendaftaran'     => $this->request->getPost('input_pendaftaran'),
            'hasil_pemeriksaan'     => $this->request->getPost('input_hasil'),
            'saran_dokter'     => $this->request->getPost('input_saran'),
            'tensi_darah'     => $this->request->getPost('input_tensi')
        );

        $model->add_data_rekam($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/RawatJalan/rekamJalan'));
    }

    public function update_rekam()
    {
        $session = session();
        $model = new Model_rawatjalan();
        
        $id = $this->request->getPost('id_rekam');
        $data = array(
            'id_pendaftaran'     => $this->request->getPost('edit_pendaftaran'),
            'hasil_pemeriksaan'     => $this->request->getPost('edit_hasil'),
            'saran_dokter'     => $this->request->getPost('edit_saran'),
            'tensi_darah'     => $this->request->getPost('edit_tensi')
        );

        $model->update_data_rekam($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/RawatJalan/rekamJalan'));
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
        return redirect()->to('/Admin/RawatJalan/rekamJalan');
    }

    public function data_edit_rekam($id_pemeriksaan)
    {
        $model = new Model_rawatjalan();
        $datahari = $model->detail_data_rekam($id_pemeriksaan)->getResultArray();
        $respon = json_decode(json_encode($datahari), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_pemeriksaan'] = $value['id_pemeriksaan'];
            $isi['tanggal_daftar'] = $value['tanggal_daftar'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['nama_dokter'] = $value['nama_dokter'];
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
        return view('Admin/viewResepJalan', $data);
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

    public function data_pemeriksaan()
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("rekam_medis_jalan");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            $builder->select('id_pemeriksaan, pasien.nama_pasien, rekam_medis_jalan.created_at');
            $builder->join('pendaftaran_rawat_jalan','pendaftaran_rawat_jalan.id_pendaftaran = rekam_medis_jalan.id_pendaftaran');
            $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
            $builder->orderBy('id_pemeriksaan', 'DESC');
            $builder->like('date(rekam_medis_jalan.created_at)', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            $builder->select('id_pemeriksaan, pasien.nama_pasien, rekam_medis_jalan.created_at');
            $builder->join('pendaftaran_rawat_jalan','pendaftaran_rawat_jalan.id_pendaftaran = rekam_medis_jalan.id_pendaftaran');
            $builder->join('pasien','pendaftaran_rawat_jalan.id_pasien = pasien.id_pasien');
            $builder->orderBy('id_pemeriksaan', 'DESC');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $pendaftaran) {
            $pasien[] = array(
                "id" => $pendaftaran->id_pemeriksaan,
                "text" => $pendaftaran->created_at . ' pasien ' . $pendaftaran->nama_pasien,
            );
        }

        $response['data'] = $pasien;

        return $this->response->setJSON($response);
    }

    public function add_resep()
    {
        $session = session();
        $model = new Model_rawatjalan();

        $data = array(
            'id_pemeriksaan'     => $this->request->getPost('input_pemeriksaan')
        );

        $model->add_data_resep($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/RawatJalan/resepJalan'));
    }

    public function update_resep()
    {
        $session = session();
        $model = new Model_rawatjalan();
        
        $id = $this->request->getPost('id_resep');
        $data = array(
            'id_pemeriksaan'     => $this->request->getPost('input_pemeriksaan')
        );

        $model->update_data_resep($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/RawatJalan/resepJalan'));
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
        return redirect()->to('/Admin/RawatJalan/resepJalan');
    }

    public function data_edit_resep($id_resep)
    {
        $model = new Model_rawatjalan();
        $dataresep = $model->detail_data_resep($id_resep)->getResultArray();
        $respon = json_decode(json_encode($dataresep), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_resep'] = $value['id_resep'];
            $isi['id_pemeriksaan'] = $value['id_pemeriksaan'];
            $isi['created_at'] = $value['created_at'];
            $isi['nama_pasien'] = $value['nama_pasien'];
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
        return view('Admin/viewDetailResepJalan', $data);
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
            return redirect()->to(base_url('Admin/RawatJalan/detailResep' . '/' . $id_resep));
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
        return redirect()->to(base_url('Admin/RawatJalan/detailResep' . '/' . $id_resep));
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
        dd($cek_stok);

        if ($cek_stok['stok_obat'] < $new_jumlah) {
            $session->setFlashdata('gagal', 'Stok obat tidak mencukupi');
            return redirect()->to(base_url('Admin/RawatJalan/detailResep' . '/' . $id_resep));
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
        return redirect()->to(base_url('Admin/RawatJalan/detailResep' . '/' . $id_resep));
    }

    public function delete_detail_resep()
    {
        $session = session();
        $model = new Model_rawatjalan();
        $id = $this->request->getPost('id');
        $id_resep = $this->request->getPost('id_resep');
        $model->delete_detail_resep($id);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Admin/RawatJalan/detailResep' . '/' . $id_resep);
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
}
