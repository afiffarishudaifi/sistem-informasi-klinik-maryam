<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_obat;

class Obat extends BaseController
{
    protected $Model_obat;
    public function __construct()
    {
        $session = session();

        if (!$session->get('nama_login') || $session->get('status_login') != 'Admin') {
            return redirect()->to('Login/loginAdmin');
        }

        $this->Model_obat = new Model_obat();
        helper(['form', 'url']);
        $this->db = db_connect();
    }

    public function index()
    {
        $session = session();
        $model = new Model_obat();
        $obat = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Obat',
            'obat' => $obat
        ];
        return view('Admin/viewTObat', $data);
    }

    public function add_obat()
    {
        $session = session();
        $data = array(
            'id_kategori' => $this->request->getPost('input_kategori'),
            'nama_obat'     => $this->request->getPost('input_nama'),
            'stok_obat'     => $this->request->getPost('input_stok'),
            'harga_obat'     => $this->request->getPost('input_harga')
        );
        $model = new Model_obat();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Obat'));
    }

    public function update_obat()
    {
        $session = session();
        $model = new Model_obat();
        date_default_timezone_set('Asia/Jakarta');
        
        $id = $this->request->getPost('id_obat');
        $data = array(
            'id_kategori' => $this->request->getPost('edit_kategori'),
            'nama_obat'     => $this->request->getPost('edit_nama'),
            'stok_obat'     => $this->request->getPost('edit_stok'),
            'harga_obat'     => $this->request->getPost('edit_harga'),
            'id_obat'     => $this->request->getPost('id_obat')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Obat'));
    }

    public function delete_obat()
    {
        $session = session();
        $model = new Model_obat();
        $id = $this->request->getPost('id');
        // $foreign = $model->cek_foreign($id);
        // if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        // } else {
        //     session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        // }
        return redirect()->to('/Admin/Obat');
    }

    public function cek_nama($nama)
    {
        $model = new Model_obat();
        $cek_nama = $model->cek_nama($nama)->getResultArray();
        $respon = json_decode(json_encode($cek_nama), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_obat)
    {
        $model = new Model_obat();
        $datahari = $model->detail_data($id_obat)->getResultArray();
        $respon = json_decode(json_encode($datahari), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_obat'] = $value['id_obat'];
            $isi['nama_obat'] = $value['nama_obat'];
            $isi['stok_obat'] = $value['stok_obat'];
            $isi['harga_obat'] = $value['harga_obat'];
            $isi['id_kategori'] = $value['id_kategori'];
            $isi['nama_kategori'] = $value['nama_kategori'];
        endforeach;
        echo json_encode($isi);
    }

    public function data_kategori()
    {
        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $db      = \Config\Database::connect();
        $builder = $this->db->table("kategori_obat");

        $kategori = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            $builder->select('id_kategori, nama_kategori');
            $builder->like('nama_kategori', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            $builder->select('id_kategori, nama_kategori');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $data_kategori) {
            $kategori[] = array(
                "id" => $data_kategori->id_kategori,
                "text" => $data_kategori->nama_kategori,
            );
        }

        $response['data'] = $kategori;

        return $this->response->setJSON($response);
    }

}
