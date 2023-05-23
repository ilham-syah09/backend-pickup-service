<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function getCount($where = null, $table)
    {
        if ($where) {
            $this->db->where($where);
        }

        return $this->db->get($table)->num_rows();
    }

    public function getUser()
    {
        $this->db->where('role_id', 2);
        $this->db->order_by('name', 'asc');

        return $this->db->get('user')->result();
    }

    public function getEkspedisi()
    {
        $this->db->order_by('ekspedisi', 'asc');

        return $this->db->get('ekspedisi')->result();
    }

    public function getPaket($where = null)
    {
        $this->db->select('paket.*, user.name, ekspedisi.ekspedisi');
        $this->db->join('user', 'user.id = paket.idUser', 'inner');
        $this->db->join('ekspedisi', 'ekspedisi.id = paket.idEkspedisi', 'inner');

        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('paket.createdAt', 'desc');

        return $this->db->get('paket')->result();
    }

    public function getProgres($where)
    {
        $this->db->where($where);
        $this->db->order_by('createdAt', 'desc');

        return $this->db->get('progres')->result();
    }
}

/* End of file M_admin.php */
