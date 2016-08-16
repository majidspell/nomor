<?php

class KategoriModel extends CI_Model {

    function selectAll() {
        return $this->db->get('kategori');
    }

    function insert() {
        $data['namakategori'] = $this->input->post('namakategori');
        $query = $this->db->get_where('kategori', array('namakategori' => $data['namakategori']));
        if ($query->num_rows() > 0) {
//            $this->db->where('namakategori', $data['namakategori']);
//            $this->db->update('kategori', $data);
            $pesan = array(
                'message1' => 'data tersebut sudah ada didalam database'
            );
            echo json_encode($pesan);
        } else {
            $this->db->insert('kategori', $data);
            $pesan = array(
                'message1' => 'data berhasil disimpan'
            );
            echo json_encode($pesan);
        }
    }
    
    function update() {
        $data['idkategori'] = $this->input->post('idkategori');
        $data['namakategori'] = $this->input->post('namakategori');

        $this->db->where('idkategori', $data['idkategori']);
        $this->db->update('kategori', $data);

        $pesan = array(
                'message1' => 'data berhasil diupdate'
        );
        echo json_encode($pesan);       
    }
    
     function delete($id) {
        $this->db->where('idkategori', $id);
        $this->db->delete('kategori');
    }

}

?>
