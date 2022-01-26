<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Model_obat;

class Obat extends BaseController
{
    protected $Model_obat;
    public function __construct()
    {
        $this->Model_obat = new Model_obat();
        helper(['form', 'url']);
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
            'nama_obat'     => $this->request->getPost('edit_nama'),
            'stok_obat'     => $this->request->getPost('edit_stok'),
            'harga_obat'     => $this->request->getPost('edit_harga'),
            'id_obat'     => $this->request->getPost('id_obat'),
            'updated_at' => date('Y-m-d H:i:s')
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
        //     session()->setFlashdata('sukses', 'Data ini dipakai di tabel lain dan tidak bisa dihapus');
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
        endforeach;
        echo json_encode($isi);
    }

}
