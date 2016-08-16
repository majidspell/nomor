<?php

class LoginModel extends CI_Model {

    function getIdGroups() {
        $query = "SELECT users.idgroups FROM users";
        return $this->db->query($query);
    }

    function post() {
        $data['username'] = mysql_real_escape_string($this->input->post('username'));
        $data['password'] = md5(mysql_real_escape_string($this->input->post('password')));
        $cekusers = $this->db->get_where('users', array('username' => $data['username'], 'password' => $data['password']));
        if ($cekusers->num_rows() > 0) {
            foreach ($cekusers->result() as $c) {
                $sess_data['logged_in'] = 1;
                $sess_data['username'] = $c->username;
                $sess_data['namalengkap'] = $c->namalengkap;
                $sess_data['idgroups'] = $c->idgroups;
                $this->session->set_userdata($sess_data);
            }
            $pesan = array(
                'message1' => $sess_data
            );
            echo json_encode($pesan);
        } else {
            $pesan = array(
                'correct' => 'tidakada',
                'message1' => 'login gagal'
            );
            echo json_encode($pesan);
        }
    }

}

?>
