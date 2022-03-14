<?php
class M_admin extends CI_Model
{

    function get_users()
    {
        $this->db->select('*');
        $this->db->from('user');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insert_users($data)
    {
        $this->db->insert('user', $data);
        return TRUE;
    }

    function users_del($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }


    function updateUser($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);

        return TRUE;
    }

    function get_user_byid($id)
    {
        $query = $this->db->where('id_user', $id);
        $q = $this->db->get('user');
        $data = $q->result();

        return $data;
    }

    function get_all_soal()
    {
        $this->db->select('*');
        $this->db->from('soal');
        //$this->db->order_by('id_soal', 'desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }


    function get_soal_byid($id, $id_quiz)
    {
        $this->db->where('id_quiz', $id_quiz);
        $this->db->where('no_soal', $id);
        return $this->db->get('soal')->result();
    }

    function updateSoal($id, $data)
    {
        $this->db->where('id_soal', $id);
        $this->db->update('soal', $data);

        return TRUE;
    }

    function get_token_row($token)
    {
        $this->db->where('token', $token);
        return $this->db->get('test')->num_rows();
    }

    function insert_test($data)
    {
        $this->db->insert('test', $data);
        return TRUE;
    }


    function get_all_test()
    {
        $this->db->select('*');
        $this->db->from('test');
        $this->db->order_by('id_test', 'desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function token_login($token)
    {
        $this->db->where('token', $token);
        $this->db->from('test');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    function get_idtest($id_test)
    {
        $this->db->where('id_test', $id_test);
        $this->db->from('test');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function update_test($id, $data)
    {
        $this->db->where('id_test', $id);
        $this->db->update('test', $data);

        return TRUE;
    }


    function hapus_test($id)
    {
        $this->db->where('id_test', $id);
        $this->db->delete('test');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }


    function getkey()
    {
        $query = $this->db->where('id_key', 1);
        $q = $this->db->get('secret_key');
        $data = $q->result();

        return $data;
    }

    public function get($table = '')
    {
        return $this->db->get($table)->result();
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return true;
    }

    public function find($table, $where)
    {
        return $this->db->get_where($table, $where)->row();
    }

    public function update($table, $where, $id, $data)
    {
        $this->db->where($where, $id);
        $this->db->update($table, $data);

        return true;
    }

    public function getWhere($table, $where)
    {
        return $this->db->get_where($table, $where)->result();
    }

    public function delete($table, $where)
    {
        $this->db->delete($table, $where);
        return true;
    }

    public function getNoSoal($id)
    {
        $this->db->select('soal.*');
        $this->db->from('soal');
        $this->db->order_by('no_soal', 'ASC');
        return $this->db->get()->row()->no_soal;
    }

    public function getLastSoal($idquiz)
    {
        $this->db->select('no_soal');
        $this->db->from('soal');
        $this->db->where('id_quiz', $idquiz);
        $this->db->order_by('no_soal', 'DESC');
        return $this->db->get()->row()->no_soal;
    }

    public function getTotalSoal($idquiz)
    {
        $this->db->select('soal.*');
        $this->db->from('soal');
        $this->db->where('id_quiz', $idquiz);
        return $this->db->get()->num_rows();
    }
}
