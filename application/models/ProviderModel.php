<?php

class ProviderModel extends CI_Model {

    function selectIdDanNama() {
        $sql = "SELECT provider.idprovider, provider.namaprovider
            FROM provider";
        return $this->db->query($sql);
    }

    function selectProviderById($idupload) {
        return $this->db->get_where('provider', array('idprovider' => $idupload));
        ;
    }

    function selectAll() {
        return $this->db->get('provider');
    }

    function insert($picture) {
        $data['namaprovider'] = $this->input->post('namaprovider');
        $data['logoprovider'] = $picture['file_name'];
        $data['idgrupprovider'] = $this->input->post('idgrupprovider');
        $data['idjenisoperator'] = $this->input->post('idjenisoperator');
        $query = $this->db->get_where('provider', array('namaprovider' => $data['namaprovider']));
        if ($query->num_rows() > 0) {
            $pesan = array(
                'message1' => 'data tersebut sudah ada didalam database'
            );
            echo json_encode($pesan);
        } else {
            $this->db->insert('provider', $data);
            $pesan = array(
                'message1' => 'data berhasil disimpan'
            );
            echo json_encode($pesan);
        }
    }

    function update() {
        $data['idprovider'] = $this->input->post('idprovider');
        $data['namaprovider'] = $this->input->post('namaprovider');
        $data['idgrupprovider'] = $this->input->post('idgrupprovider');
        $data['idjenisoperator'] = $this->input->post('idjenisoperator');


        $this->db->where('idprovider', $data['idprovider']);
        $this->db->update('provider', $data);

        $pesan = array(
            'message1' => 'data berhasil diupdate'
        );
        echo json_encode($pesan);
    }
    
    function upload($hasil, $idprovider) {
        $newlogoprovider = $hasil['file_name'];
        $query = $this->db->get_where('provider', array('idprovider' => $idprovider));
        foreach ($query->result() as $row) {
            $oldlogoprovider = $row->logoprovider;
            unlink('./pictures/' . $oldlogoprovider);
            $query = "UPDATE provider SET logoprovider = '$newlogoprovider' WHERE idprovider = '$idprovider' ";
            $this->db->query($query);
            echo 'data berhasil diupdate';
        }
    }

    function delete($idprovider) {

        $provider = $this->db->query("SELECT provider.logoprovider FROM provider WHERE provider.idprovider = $idprovider")->result();
        foreach ($provider as $p) {
            unlink('./pictures/' . $p->logoprovider);
        }

        $this->db->where('idprovider', $idprovider);
        $this->db->delete('provider');
    }

}

?>
