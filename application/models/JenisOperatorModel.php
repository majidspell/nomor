<?php

class JenisOperatorModel extends CI_Model {

    function selectAll() {
        return $this->db->get('jenisoperator');
    }

    function insert() {
        $data['namajenisoperator'] = $this->input->post('namajenisoperator');
        $query = $this->db->get_where('jenisoperator', array('namajenisoperator' => $data['namajenisoperator']));
        if ($query->num_rows() > 0) {
//            $this->db->where('namajenisoperator', $data['namajenisoperator']);
//            $this->db->update('jenisoperator', $data);
            $pesan = array(
                'message1' => 'data tersebut sudah ada didalam database'
            );
            echo json_encode($pesan);
        } else {
            $this->db->insert('jenisoperator', $data);
            $pesan = array(
                'message1' => 'data berhasil disimpan'
            );
            echo json_encode($pesan);
        }
    }
    
    function update() {
        $data['idjenisoperator'] = $this->input->post('idjenisoperator');
        $data['namajenisoperator'] = $this->input->post('namajenisoperator');

        $this->db->where('idjenisoperator', $data['idjenisoperator']);
        $this->db->update('jenisoperator', $data);

        $pesan = array(
                'message1' => 'data berhasil diupdate'
        );
        echo json_encode($pesan);       
    }
    
     function delete($id) {
        $this->db->where('idjenisoperator', $id);
        $this->db->delete('jenisoperator');
    }

}

?>
