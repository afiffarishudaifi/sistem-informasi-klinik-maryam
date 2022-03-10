<?php

namespace App\Controllers\Apoteker;

use App\Controllers\BaseController;
use App\Models\Model_rawatinap;
use CodeIgniter\Model;

class RawatInap extends BaseController
{
    protected $Model_rawatinap;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Apoteker') {
            return redirect()->to('Login');
        }

        $this->Model_rawatinap = new Model_rawatinap();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_rawatinap();
        $data = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Rawat Inap',
            'data' => $data
        ];
        return view('Apoteker/viewDaftarRawatInap', $data);
    }

    public function add_pendaftaran()
    {
        $session = session(); 

        $id_pasien = $this->request->getPost('input_pasien');

        $data = array(
            'id_pasien'     => $this->request->getPost('input_pasien'),
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
        $cek_pasien = $model->cek_pasien($id_pasien)->getRowArray();

        if($cek_pasien['id_pasien'] != 0){
            $session->setFlashdata('gagal', 'Pasien ini masih melakukan perawatan');
            return redirect()->to(base_url('Apoteker/RawatInap'));
        }
        
        $model->add_data($data);
        $model->update_status_kamar($ubah_kamar, $kamar);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Apoteker/RawatInap'));
    }

    public function update_pendaftaran()
    {
        $session = session();
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
            'status_inap'     => $status,
            'updated_at' => date('Y-m-d H:i:s')
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
        return redirect()->to(base_url('Apoteker/RawatInap'));
    }

    public function delete_pendaftaran()
    {
        $session = session();
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
        return redirect()->to('/Apoteker/RawatInap');
    }

    public function data_edit($id_inap)
    {
        $model = new Model_rawatinap();
        $datainap = $model->detail_data($id_inap)->getResultArray();
        $respon = json_decode(json_encode($datainap), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_inap'] = $value['id_inap'];
            $isi['id_pasien'] = $value['id_pasien'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['id_kamar'] = $value['id_kamar'];
            $isi['no_kamar'] = $value['no_kamar'];
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
            $builder->select('pasien.id_pasien, nama_pasien');
            $builder->join('pendaftaran_inap','pasien.id_pasien = pendaftaran_inap.id_pasien');
            $builder->where('pendaftaran_inap.status_inap','Belum Selesai');
            $builder->like('nama_pasien', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {
    
            // Fetch record
            $builder->select('pasien.id_pasien, nama_pasien');
            $builder->join('pendaftaran_inap','pasien.id_pasien = pendaftaran_inap.id_pasien');
            $builder->where('pendaftaran_inap.status_inap','Belum Selesai');
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
            $builder->select('id_kamar, no_kamar');
            $builder->where('status_kamar','Kosong');
            $builder->like('no_kamar', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('id_kamar, no_kamar');
            $builder->where('status_kamar','Kosong');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $kamar[] = array(
                "id" => $country->id_kamar,
                "text" => $country->no_kamar,
            );
        }

        $response['data'] = $kamar;

        return $this->response->setJSON($response);
    }

    public function rekamInap()
    {
        $session = session();
        $model = new Model_rawatinap();
        $data = $model->view_data_rekam()->getResultArray();

        $data = [
            'judul' => 'Tabel Rekam Medis Rawat Inap',
            'data' => $data
        ];
        return view('Apoteker/viewRekamMedisInap', $data);
    }

    public function add_rekam()
    {
        $session = session();
        $model = new Model_rawatinap();
        $waktu_rekam = $this->request->getPost('input_tanggal');

        $data = array(
            'id_pasien'     => $this->request->getPost('input_pasien'),
            'id_dokter'     => $this->request->getPost('input_dokter'),
            'hasil_pemeriksaan'     => $this->request->getPost('input_hasil'),
            'saran_dokter'     => $this->request->getPost('input_saran'),
            'tensi'     => $this->request->getPost('input_tensi'),
            'waktu_rekam'     => $waktu_rekam
        );

        $model->add_data_rekam($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Apoteker/RawatInap/rekamInap'));
    }

    public function update_rekam()
    {
        $session = session();
        $model = new Model_rawatinap();
        date_default_timezone_set('Asia/Jakarta');
        $id = $this->request->getPost('id_rekam_inap');
        $waktu_rekam = $this->request->getPost('edit_tanggal');
        
        $data = array(
            'id_pasien'     => $this->request->getPost('edit_pasien'),
            'id_dokter'     => $this->request->getPost('edit_dokter'),
            'hasil_pemeriksaan'     => $this->request->getPost('edit_hasil'),
            'saran_dokter'     => $this->request->getPost('edit_saran'),
            'tensi'     => $this->request->getPost('edit_tensi'),
            'waktu_rekam'     => $waktu_rekam,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $model->update_data_rekam($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Apoteker/RawatInap/rekamInap'));
    }

    public function delete_inap()
    {
        $session = session();
        $model = new Model_rawatinap();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data_rekam($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Apoteker/RawatInap/rekamInap');
    }

    public function data_edit_rekam($id_pemeriksaan)
    {
        $model = new Model_rawatinap();
        $datarekam = $model->detail_data_rekam($id_pemeriksaan)->getResultArray();
        $respon = json_decode(json_encode($datarekam), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_rekam_inap'] = $value['id_rekam_inap'];
            $isi['id_pasien'] = $value['id_pasien'];
            $isi['id_dokter'] = $value['id_dokter'];
            $isi['nama_pasien'] = $value['nama_pasien'];
            $isi['nama_dokter'] = $value['nama_dokter'];
            $isi['nama_poli'] = $value['nama_poli'];
            $isi['hasil_pemeriksaan'] = $value['hasil_pemeriksaan'];
            $isi['tensi'] = $value['tensi'];
            $isi['saran_dokter'] = $value['saran_dokter'];
            $isi['waktu_rekam'] = $value['waktu_rekam'];
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
        $builder = $this->db->table("pendaftaran_inap");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('pendaftaran_inap.id_pasien, pasien.nama_pasien');
            $builder->join('pasien','pendaftaran_inap.id_pasien = pasien.id_pasien');
            $builder->where('status_inap','Belum Selesai');
            $builder->orderBy('id_inap', 'DESC');
            $builder->like('pasien.nama_pasien', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('pendaftaran_inap.id_pasien, pasien.nama_pasien');
            $builder->join('pasien','pendaftaran_inap.id_pasien = pasien.id_pasien');
            $builder->where('status_inap','Belum Selesai');
            $builder->orderBy('id_inap', 'DESC');
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
            $builder->select('dokter.id_dokter, dokter.nama_dokter, dokter.id_poli, poli.nama_poli');
            $builder->join('poli','poli.id_poli = dokter.id_poli');
            $builder->like('nama_dokter', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('dokter.id_dokter, dokter.nama_dokter, dokter.id_poli, poli.nama_poli');
            $builder->join('poli','poli.id_poli = dokter.id_poli');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $dokter[] = array(
                "id" => $country->id_dokter,
                "text" => $country->nama_dokter. ' ' . $country->nama_poli,
            );
        }

        $response['data'] = $dokter;

        return $this->response->setJSON($response);
    }

    public function resepInap()
    {
        $session = session();
        $model = new Model_rawatinap();
        $data = $model->view_data_resep()->getResultArray();
       
        $data = [
            'judul' => 'Tabel Rekam Medis Resep Rawat Inap',
            'data' => $data
        ];
        return view('Apoteker/viewResepInap', $data);
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
        $builder = $this->db->table("rekam_medis_inap");

        $pasien = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            $builder->select('rekam_medis_inap.id_rekam_inap, pasien.nama_pasien, rekam_medis_inap.created_at');
            $builder->join('pasien','rekam_medis_inap.id_pasien = pasien.id_pasien');
            $builder->orderBy('rekam_medis_inap.id_rekam_inap', 'DESC');
            $builder->like('date(rekam_medis_inap.created_at)', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            $builder->select('rekam_medis_inap.id_rekam_inap, pasien.nama_pasien, rekam_medis_inap.created_at');
            $builder->join('pasien','rekam_medis_inap.id_pasien = pasien.id_pasien');
            $builder->orderBy('rekam_medis_inap.id_rekam_inap', 'DESC');
            $query = $builder->get();
            $data = $query->getResult();
        }
        
        foreach ($data as $pendaftaran) {
            $pasien[] = array(
                "id" => $pendaftaran->id_rekam_inap,
                "text" => $pendaftaran->created_at . ' pasien ' . $pendaftaran->nama_pasien,
            );
        }

        $response['data'] = $pasien;

        return $this->response->setJSON($response);
    }

    public function add_resep()
    {
        $session = session();
        $model = new Model_rawatinap();

        $data = array(
            'id_rekam_inap'     => $this->request->getPost('input_rekam_inap')
        );

        $model->add_data_resep($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Apoteker/RawatInap/resepInap'));
    }

    public function update_resep()
    {
        $session = session();
        $model = new Model_rawatinap();
        
        $id = $this->request->getPost('id_rekam_inap');
        $data = array(
            'id_rekam_inap'     => $this->request->getPost('edit_rekam_inap')
        );

        $model->update_data_resep($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Apoteker/RawatInap/resepInap'));
    }

    public function delete_resep()
    {
        $session = session();
        $model = new Model_rawatinap();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data_resep($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Apoteker/RawatInap/resepInap');
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
        $model = new Model_rawatinap();
        $data = $model->view_detail_resep($id)->getResultArray();

        $data = [
            'judul' => 'Tabel Detail Resep ' . $id,
            'data' => $data,
            'id_rekam_inap' => $id
        ];
        return view('Apoteker/viewDetailResepInap', $data);
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
        $model = new Model_rawatinap();

        $id_rekam_inap = $this->request->getPost('id_rekam_inap');
        $id_obat = $this->request->getPost('input_obat');
        $jumlah_obat = $this->request->getPost('input_jumlah');
        $cek_stok = $model->cek_stok_obat($id_obat)->getRowArray();

        if ($cek_stok['stok_obat'] < $jumlah_obat) {
            $session->setFlashdata('gagal', 'Stok obat tidak mencukupi');
            return redirect()->to(base_url('Apoteker/RawatInap/detailResep' . '/' . $id_rekam_inap));
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
            'id_rekam_inap'     => $id_rekam_inap
        );

        $model->add_detail_resep($data);

        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Apoteker/RawatInap/detailResep' . '/' . $id_rekam_inap));
    }

    public function update_detail_resep()
    {
        $session = session();
        $model = new Model_rawatinap();
        
        $id = $this->request->getPost('id_detail');
        $id_rekam_inap = $this->request->getPost('edit_rekam_inap');
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
            return redirect()->to(base_url('Apoteker/RawatInap/detailResep' . '/' . $id_rekam_inap));
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
        return redirect()->to(base_url('Apoteker/RawatInap/detailResep' . '/' . $id_rekam_inap));
    }

    public function delete_detail_resep()
    {
        $session = session();
        $model = new Model_rawatinap();
        $id = $this->request->getPost('id');
        $id_rekam_inap = $this->request->getPost('id_rekam_inap');
        $model->delete_detail_resep($id);
        session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        return redirect()->to('/Apoteker/RawatInap/detailResep' . '/' . $id_rekam_inap);
    }

    public function data_edit_detail_resep($id_detail)
    {
        $model = new Model_rawatinap();
        $dataresep = $model->detail_data_detail_resep($id_detail)->getResultArray();
        $respon = json_decode(json_encode($dataresep), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_detail'] = $value['id_detail'];
            $isi['id_rekam_inap'] = $value['id_rekam_inap'];
            $isi['id_obat'] = $value['id_obat'];
            $isi['nama_obat'] = $value['nama_obat'];
            $isi['jumlah_obat'] = $value['jumlah_obat'];
            $isi['total_biaya'] = $value['total_biaya'];
        endforeach;
        echo json_encode($isi);
    }
}
