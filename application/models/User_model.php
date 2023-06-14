<?php
class User_model extends CI_Model
{
    public function cekEmail($email){
        return $this->db->where('email', $email)->get('user')->row();
    }

    public function addUser($email, $nama, $password, $foto){

        $this->db->trans_begin();

        $data =[
            'email' => $email,
            'nama' => $nama,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'photo' => $foto,
        ];
        $this->db->insert('user', $data);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function cekUser($email, $password){

        $user = $this->cekEmail($email);
        if(password_verify($password, $user->password)) {
            $data = [
                'nama'=> $user->nama,
                'email'=> $user->email,
                'foto'=> $user->photo,
            ];
            $this->session->set_userdata($data);
            return true;
        }else {
            return false;
        }
    }
    public function cekUserByID($id){
        return $this->db->where('id', $id)->get('user')->row();
    }
    
    public function insertToken($user_id)
    {

        $this->db->trans_begin();
        $token = substr(sha1(rand()), 0, 30);

        $string = array(
            'token' => $token,
            'user_id' => $user_id,
            'created' => date('Y-m-d')
        );
        $query = $this->db->insert_string('tokens', $string);
        $this->db->query($query);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return $token . $user_id;
        }
    }

    public function isTokenValid($token)
    {
        $tkn = substr($token, 0, 30);
        $uid = substr($token, 30);

        $q = $this->db->get_where('tokens', array(
            'token' => $tkn,
            'user_id' => $uid,
        ), 1);

        if ($this->db->affected_rows() > 0) {
            $row = $q->row();

            $created = $row->created;
            $createdTS = strtotime($created);
            $today = date('Y-m-d');
            $todayTS = strtotime($today);

            if ($createdTS != $todayTS) {
                return false;
            }

            $user_info = $this->cekUserByID($row->user_id);
            return $user_info;
        } else {
            return false;
        }
    } 

    public function updatePassword($email, $password){

        $this->db->trans_begin();

        $data =[
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        $this->db->where('email', $email);
        $this->db->update('user', $data);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}