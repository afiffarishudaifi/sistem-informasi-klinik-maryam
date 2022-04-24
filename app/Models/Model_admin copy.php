<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('admin');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('admin')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('admin');
        $builder->select('id_admin, admin.id_user, nama_admin, alamat_admin, no_telp_admin, username');
        $builder->join('user','user.id_user = admin.id_user');
        $builder->where('id_admin', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('admin');
        $builder->where('id_admin', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('admin');
        $builder->where('id_admin', $id);
        return $builder->delete();
    }

    public function cek_username($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('admin');
        $builder->select('id_admin');
        $builder->where('username_admin', $username);
        return $builder->get();
    }
}
