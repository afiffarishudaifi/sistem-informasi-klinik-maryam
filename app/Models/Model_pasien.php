<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_pasien extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'nik';

    public function view_data()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        return $builder->get();
    }

    public function add_data($data)
    {
        $query = $this->db->table('pasien')->insert($data);
        return $query;
    }

    public function detail_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->where('nik', $id);
        $builder->join('user','user.id_user = pasien.id_user','right');
        return $builder->get();
    }

    public function update_data($data, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->where('nik', $id);
        $builder->set($data);
        return $builder->update();
    }

    public function delete_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->where('nik', $id);
        return $builder->delete();
    }

    public function cek_email($email)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('id_user');
        $builder->where('email', $email);
        return $builder->get();
    }

    public function cek_nik($nik)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->select('nik');
        $builder->where('nik', $nik);
        return $builder->get();
    }

    public function cek_max_login($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('id_user');
        $builder->where('oauth_id',$id);
        return $builder->get();
    }

    public function cek_data($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pasien');
        $builder->where('pasien.id_user', $id);
        $builder->join('user','user.id_user = pasien.id_user');
        return $builder->get();
    }
}
