<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\Model_rawatinap;
use CodeIgniter\Model;

class RawatInap extends BaseController
{
    protected $Model_rawatinap;
    public function __construct()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        
        $this->Model_rawatinap = new Model_rawatinap();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }

        $model = new Model_rawatinap();
        $data = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Rawat Inap',
            'data' => $data
        ];
        return view('Karyawan/viewDaftarRawatInap', $data);
    }

    public function add_pendaftaran()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }

        $nik = $this->request->getPost('input_pasien');

        $data = array(
            'nik'     => $this->request->getPost('input_pasien'),
            'id_kamar'     => $this->request->getPost('input_kamar'),
            'waktu_masuk'     => $this->request->getPost('input_masuk'),
            'waktu_keluar'     => $this->request->getPost('input_keluar'),
            'status_inap'     => 'Belum Selesai',
            'total_tagihan_inap'     => $this->request->getPost('input_tagihan')
        );

        $kamar = $this->request->getPost('input_kamar');
        $ubah_kamar = array(
            'status_kamar' => 'Terisi'
        );

        $model = new Model_rawatinap();
        $cek_pasien = $model->cek_pasien($nik)->getRowArray();

        if($cek_pasien['nik'] != 0){
            $session->setFlashdata('gagal', 'Pasien ini masih melakukan perawatan');
            return redirect()->to(base_url('Karyawan/RawatInap'));
        }
        
        $model->add_data($data);
        $model->update_status_kamar($ubah_kamar, $kamar);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Karyawan/RawatInap'));
    }

    public function update_pendaftaran()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        date_default_timezone_set('Asia/Jakarta');
        
        if($this->request->getPost('edit_status') == '') {
            $status = 'Belum Selesai';
        } else {
            $status = 'Selesai';
        }
        $id = $this->request->getPost('id_inap');

        $data = array(
            'waktu_keluar'     => $this->request->getPost('edit_keluar'),
            'total_tagihan_inap'     => $this->request->getPost('edit_tagihan'),
            'status_inap'     => $status
        );

        $kamar = $this->request->getPost('old_kamar');
                
        if ($status == 'Selesai') {
            $ubah_kamar = array(
                'status_kamar' => 'Kosong'
            );
            $model->update_status_kamar($ubah_kamar, $kamar);
        }
        $model->update_data($data, $id);

        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Karyawan/RawatInap'));
    }

    public function delete_pendaftaran()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        $id = $this->request->getPost('id');
        $id_kamar = $this->request->getPost('id_kamar');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');

            $ubah_kamar = array(
                'status_kamar' => 'Kosong'
            );
            $model->update_status_kamar($ubah_kamar, $id_kamar);
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Karyawan/RawatInap');
    }

    public function data_edit($id_inap)
    {
        $model = new Model_rawatinap();
        $datainap = $model->detail_data($id_inap)->getResultArray();
        $respon = json_decode(json_encode($datainap), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_inap'] = $value['id_inap'];
            $isi['nik'] = $value['nik'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['id_kamar'] = $value['id_kamar'];
            $isi['nama_kamar'] = $value['nama_kamar'];
            $isi['biaya_kamar'] = $value['biaya_kamar'];
            $isi['waktu_masuk'] = $value['waktu_masuk'];
            $isi['waktu_keluar'] = $value['waktu_keluar'];
            $isi['status_inap'] = $value['status_inap'];
            $isi['total_tagihan_inap'] = $value['total_tagihan_inap'];
        endforeach;
        echo json_encode($isi);
    }

    public function data_pasien()
    {
        $request = service('request');
        $postData = $request->getPost(); 

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

    public function data_pasien_rekam()
    {
        $request = service('request');
        $postData = $request->getPost(); 

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("pasien");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('pasien.nik, nama_pasien');
            $builder->join('rawat_inap','pasien.nik = rawat_inap.nik');
            $builder->where('rawat_inap.status_inap','Belum Selesai');
            $builder->like('nama_pasien', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {
    
            // Fetch record
            $builder->select('pasien.nik, nama_pasien');
            $builder->join('rawat_inap','pasien.nik = rawat_inap.nik');
            $builder->where('rawat_inap.status_inap','Belum Selesai');
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

    public function data_kamar()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("kamar");

        $kamar = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_kamar, nama_kamar');
            $builder->where('status_kamar','Kosong');
            $builder->like('nama_kamar', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_kamar, nama_kamar');
            $builder->where('status_kamar','Kosong');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $kamar[] = array(
                "id" => $country->id_kamar,
                "text" => $country->nama_kamar,
            );
        }

        $response['data'] = $kamar;

        return $this->response->setJSON($response);
    }

    public function rekamInap()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        $data = $model->view_data_rekam()->getResultArray();

        $data = [
            'judul' => 'Tabel Rekam Medis Rawat Inap',
            'data' => $data
        ];
        return view('Karyawan/viewRekamMedisInap', $data);
    }

    public function add_rekam()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        $waktu_rekam = $this->request->getPost('input_tanggal');

        $data = array(
            'id_inap'     => $this->request->getPost('input_kamar'),
            'nik_dokter'     => $this->request->getPost('input_dokter'),
            'id_penyakit'     => $this->request->getPost('input_penyakit'),
            'hasil_pemeriksaan'     => $this->request->getPost('input_hasil'),
            'saran_dokter'     => $this->request->getPost('input_saran'),
            'tensi_darah'     => $this->request->getPost('input_tensi'),
            'tanggal_rekam'     => $waktu_rekam,
            'status' => 'Inap'
        );

        $model->add_data_rekam($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Karyawan/RawatInap/rekamInap'));
    }

    public function update_rekam()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('id_rekam');
        $waktu_rekam = $this->request->getPost('edit_tanggal');
        
        $data = array(
            'id_inap'     => $this->request->getPost('edit_kamar'),
            'nik_dokter'     => $this->request->getPost('edit_dokter'),
            'id_penyakit'     => $this->request->getPost('edit_penyakit'),
            'hasil_pemeriksaan'     => $this->request->getPost('edit_hasil'),
            'saran_dokter'     => $this->request->getPost('edit_saran'),
            'tensi_darah'     => $this->request->getPost('edit_tensi'),
            'tanggal_rekam'     => $waktu_rekam
        );

        $model->update_data_rekam($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Karyawan/RawatInap/rekamInap'));
    }

    public function delete_inap()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data_rekam($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Karyawan/RawatInap/rekamInap');
    }

    public function data_edit_rekam($id_pemeriksaan)
    {
        $model = new Model_rawatinap();
        $datarekam = $model->detail_data_rekam($id_pemeriksaan)->getResultArray();
        $respon = json_decode(json_encode($datarekam), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_rekam'] = $value['id_rekam'];
            $isi['id_inap'] = $value['id_inap'];
            $isi['nama_kamar'] = $value['nama_kamar'];
            $isi['nik_dokter'] = $value['nik_dokter'];
            $isi['id_penyakit'] = $value['id_penyakit'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['nama_dokter'] = $value['nama_dokter'];
            $isi['nama_penyakit'] = $value['nama_penyakit'];
            $isi['hasil_pemeriksaan'] = $value['hasil_pemeriksaan'];
            $isi['tensi_darah'] = $value['tensi_darah'];
            $isi['saran_dokter'] = $value['saran_dokter'];
            $isi['tanggal_rekam'] = $value['tanggal_rekam'];
        endforeach;
        echo json_encode($isi);
    }

    public function data_pendaftaran()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("rawat_inap");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('rawat_inap.nik, pasien.nama_pasien');
            $builder->join('pasien','rawat_inap.nik = pasien.nik');
            $builder->where('status_inap','Belum Selesai');
            $builder->orderBy('id_inap', 'DESC');
            $builder->like('pasien.nama_pasien', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('rawat_inap.nik, pasien.nama_pasien');
            $builder->join('pasien','rawat_inap.nik = pasien.nik');
            $builder->where('status_inap','Belum Selesai');
            $builder->orderBy('id_inap', 'DESC');
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

    public function data_kamar_rekam()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("rawat_inap");

        $kamar = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('id_inap, nama_kamar');
            $builder->join('kamar','rawat_inap.id_kamar = rawat_inap.id_kamar');
            $builder->where('status_kamar','Terisi');
            $builder->like('nama_kamar', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_inap, nama_kamar');
            $builder->join('kamar','rawat_inap.id_kamar = rawat_inap.id_kamar');
            $builder->where('status_kamar','Terisi');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $kamar[] = array(
                "id" => $country->id_inap,
                "text" => $country->nama_kamar,
            );
        }

        $response['data'] = $kamar;

        return $this->response->setJSON($response);
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

    public function resepInap()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        $data = $model->view_data_resep()->getResultArray();
       
        $data = [
            'judul' => 'Tabel Rekam Medis Resep Rawat Inap',
            'data' => $data
        ];
        return view('Karyawan/viewResepInap', $data);
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
            $builder->join('rawat_inap','rekam_medis.id_inap = rawat_inap.id_inap');
            $builder->join('pasien','rawat_inap.nik = pasien.nik');
            $builder->where('rekam_medis.status','Inap');
            $builder->orderBy('id_rekam', 'DESC');
            $builder->like('date(rekam_medis.tanggal_rekam)', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            $builder->select('id_rekam, pasien.nama_pasien, rekam_medis.tanggal_rekam');
            $builder->join('rawat_inap','rekam_medis.id_inap = rawat_inap.id_inap');
            $builder->join('pasien','rawat_inap.nik = pasien.nik');
            $builder->where('rekam_medis.status','Inap');
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
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        if($this->request->getPost('input_status') == '') {
            $status = 'Belum Lunas';
        } else {
            $status = 'Lunas';
        }

        $data = array(
            'id_rekam'     => $this->request->getPost('input_rekam'),
            'tanggal'     => $this->request->getPost('input_tanggal'),
            'status_bayar'     => $status,
            'status' => 'Inap'
        );

        $model->add_data_resep($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Karyawan/RawatInap/resepInap'));
    }

    public function update_resep()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
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
        return redirect()->to(base_url('Karyawan/RawatInap/resepInap'));
    }

    public function delete_resep()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data_resep($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Karyawan/RawatInap/resepInap');
    }

    public function data_edit_resep($id_rekam_inap)
    {
        $model = new Model_rawatinap();
        $dataresep = $model->detail_data_resep($id_rekam_inap)->getResultArray();
        $respon = json_decode(json_encode($dataresep), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_rekam_inap'] = $value['id_rekam_inap'];
            $isi['id_rekam_inap'] = $value['id_rekam_inap'];
            $isi['created_at'] = $value['created_at'];
            $isi['nama_pasien'] = $value['nama_pasien'];
        endforeach;
        echo json_encode($isi);
    }

    // detail resep
    public function detailResep($id)
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        $data = $model->view_detail_resep($id)->getResultArray();

        $data = [
            'judul' => 'Tabel Detail Resep ' . $id,
            'data' => $data,
            'id_resep' => $id
        ];
        return view('Karyawan/viewDetailResepInap', $data);
    }

    public function harga_obat($id)
    {
        $model = new Model_rawatinap();
        $harga = $model->harga_obat($id)->getRowArray();
        $isi['harga_obat'] = $harga['harga_obat'];
        echo json_encode($isi);
    }

    public function add_detail_resep()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();

        $id_resep = $this->request->getPost('id_resep');
        $id_obat = $this->request->getPost('input_obat');
        $jumlah_obat = $this->request->getPost('input_jumlah');
        $cek_stok = $model->cek_stok_obat($id_obat)->getRowArray();

        if ($cek_stok['stok_obat'] < $jumlah_obat) {
            $session->setFlashdata('gagal', 'Stok obat tidak mencukupi');
            return redirect()->to(base_url('Karyawan/RawatInap/detailResep' . '/' . $id_resep));
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
        return redirect()->to(base_url('Karyawan/RawatInap/detailResep' . '/' . $id_resep));
    }

    public function update_detail_resep()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        
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
            return redirect()->to(base_url('Karyawan/RawatInap/detailResep' . '/' . $id_resep));
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
        return redirect()->to(base_url('Karyawan/RawatInap/detailResep' . '/' . $id_resep));
    }

    public function delete_detail_resep()
    {
        $session = session();
        if (!$session->get('nama_login') || $session->get('status_login') != 'Karyawan') {
            return redirect()->to('Login/loginPegawai');
        }
        $model = new Model_rawatinap();
        $id = $this->request->getPost('id');
        $id_resep = $this->request->getPost('id_resep');
        $model->delete_detail_resep($id);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Karyawan/RawatInap/detailResep' . '/' . $id_resep);
    }

    public function data_edit_detail_resep($id_detail)
    {
        $model = new Model_rawatinap();
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
}
