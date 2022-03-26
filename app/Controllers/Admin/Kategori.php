<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_kategori;

class Kategori extends BaseController
{
    protected $Model_kategori;
    public function __construct()
    {
        $this->Model_kategori = new Model_kategori();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        $model = new Model_kategori();
        $kategori = $model->view_data()->getResultArray();

        $data = [
            'judul' => 'Tabel Kategori Obat',
            'kategori' => $kategori
        ];
        return view('Admin/viewTKategoriObat', $data);
    }

    public function add_kategori()
    {
        $session = session();
        $data = array(
            'nama_kategori'     => $this->request->getPost('input_nama')
        );
        $model = new Model_kategori();
        $model->add_data($data);
        $session->setFlashdata('sukses', 'Data sudah berhasil ditambah');
        return redirect()->to(base_url('Admin/Kategori'));
    }

    public function update_kategori()
    {
        $session = session();
        $model = new Model_kategori();
        date_default_timezone_set('Asia/Jakarta');
        
        $id = $this->request->getPost('id_kategori');
        $data = array(
            'id_kategori'     => $this->request->getPost('id_kategori'),
            'nama_kategori'     => $this->request->getPost('edit_nama')
        );

        $model->update_data($data, $id);
        $session->setFlashdata('sukses', 'Data sudah berhasil diubah');
        return redirect()->to(base_url('Admin/Kategori'));
    }

    public function delete_kategori()
    {
        $session = session();
        $model = new Model_kategori();
        $id = $this->request->getPost('id');
        $session = session();
        $foreign = $model->cek_foreign($id);
        if ($foreign == 0) {
            $model->delete_data($id);
            session()->setFlashdata('sukses', 'Data sudah berhasil dihapus');
        } else {
            session()->setFlashdata('gagal', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
        }
        return redirect()->to('/Admin/Kategori');
    }

    public function cek_nama($nama)
    {
        $model = new Model_kategori();
        $cek_nama = $model->cek_nama($nama)->getResultArray();
        $respon = json_decode(json_encode($cek_nama), true);
        $data['results'] = count($respon);
        echo json_encode($data);
    }

    public function data_edit($id_kategori)
    {
        $model = new Model_kategori();
        $datakategori = $model->detail_data($id_kategori)->getResultArray();
        $respon = json_decode(json_encode($datakategori), true);
        $data['results'] = array();
        foreach ($respon as $value) :
            $isi['id_kategori'] = $value['id_kategori'];
            $isi['nama_kategori'] = $value['nama_kategori'];
        endforeach;
        echo json_encode($isi);
    }
}
