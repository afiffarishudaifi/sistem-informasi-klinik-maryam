<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_user extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('user')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->where('id_user', $id);
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->where('id_user', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->where('id_user', $id);
        return $builder->delete();
    }

    public function cek_username($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('id_user');
        $builder->where('username', $username);
        return $builder->get();
    }

    public function max_id()
    {
    	$db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->selectMax('id_user');
        return $builder->get();
    }
}
