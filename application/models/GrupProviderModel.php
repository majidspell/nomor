<?php

class GrupProviderModel extends CI_Model {

    function selectAll() {
        return $this->db->get('grupprovider');
    }

    function insert() {
        $data['namagrupprovider'] = $this->input->post('namagrupprovider');
        $query = $this->db->get_where('grupprovider', array('namagrupprovider' => $data['namagrupprovider']));
        if ($query->num_rows() > 0) {
            $pesan = array(
                'message1' => 'data tersebut sudah ada didalam database'
            );
            echo json_encode($pesan);
        } else {
            $this->db->insert('grupprovider', $data);
            $pesan = array(
                'message1' => 'data berhasil disimpan'
            );
            echo json_encode($pesan);
        }
    }
    
    function update() {
        $data['idgrupprovider'] = $this->input->post('idgrupprovider');
        $data['namagrupprovider'] = $this->input->post('namagrupprovider');

        $this->db->where('idgrupprovider', $data['idgrupprovider']);
        $this->db->update('grupprovider', $data);

        $pesan = array(
                'message1' => 'data berhasil diupdate'
        );
        echo json_encode($pesan);       
    }
    
     function delete($id) {
        $this->db->where('idgrupprovider', $id);
        $this->db->delete('grupprovider');
    }

}

?>
