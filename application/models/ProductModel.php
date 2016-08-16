<?php

class ProductModel extends CI_Model {

    function searchRefresh() {
        $nomorcari = $this->input->post('nomorcari');
        $posisicari = $this->input->post('posisicari');
        $operatorcari = $this->input->post('operatorcari');
        $kategoricari = $this->input->post('kategoricari');
        $hargacari1 = $this->input->post('hargacari1');
        $hargacari2 = $this->input->post('hargacari2');

        if ($posisicari == 0) {
            $query1 = "SELECT product.idproduct, product.nomorproduct, product.statuspasangan,product.hargaproduct, provider.logoprovider,
                jenisoperator.namajenisoperator, kategori.namakategori FROM product,provider,jenisoperator,kategori WHERE product.nomorproduct LIKE '%$nomorcari%'
                AND product.idprovider = provider.idprovider AND provider.idjenisoperator = jenisoperator.idjenisoperator AND
                product.idkategori = kategori.idkategori";
        } elseif ($posisicari == 1) {
            $query1 = "SELECT product.idproduct, product.nomorproduct, product.statuspasangan,product.hargaproduct, provider.logoprovider,
                jenisoperator.namajenisoperator, kategori.namakategori FROM product,provider,jenisoperator,kategori WHERE product.nomorproduct LIKE '$nomorcari%'
                AND product.idprovider = provider.idprovider AND provider.idjenisoperator = jenisoperator.idjenisoperator AND
                product.idkategori = kategori.idkategori";
        } elseif ($posisicari == 2) {
            $query1 = "SELECT product.idproduct, product.nomorproduct, product.statuspasangan,product.hargaproduct, provider.logoprovider,
                jenisoperator.namajenisoperator, kategori.namakategori FROM product,provider,jenisoperator,kategori WHERE product.potongnomorproduct LIKE '%$nomorcari%'
                AND product.idprovider = provider.idprovider AND provider.idjenisoperator = jenisoperator.idjenisoperator AND
                product.idkategori = kategori.idkategori";
        } elseif ($posisicari == 3) {
            $query1 = "SELECT product.idproduct, product.nomorproduct, product.statuspasangan,product.hargaproduct, provider.logoprovider,
                jenisoperator.namajenisoperator, kategori.namakategori FROM product,provider,jenisoperator,kategori WHERE product.nomorproduct LIKE '%$nomorcari'
                AND product.idprovider = provider.idprovider AND provider.idjenisoperator = jenisoperator.idjenisoperator AND
                product.idkategori = kategori.idkategori";
        }

        ////////////////////////////////////////////////////////////////////////

        if ($operatorcari == 0) {
            $query2 = $query1;
        } else {
            $replacequery1 = str_replace("jenisoperator.idjenisoperator", $operatorcari, $query1);
            $query2 = $replacequery1;
        }

        ////////////////////////////////////////////////////////////////////////

        if ($kategoricari == 0) {
            $query3 = $query2;
        } else {
            $replacequery2 = str_replace("kategori.idkategori", $kategoricari, $query2);
            $query3 = $replacequery2;
        }

        ////////////////////////////////////////////////////////////////////////

        if ($hargacari1 == 0 && $hargacari2 == 0) {
            $queryFinal = $query3 . " ORDER BY product.nomorproduct ASC";
        } elseif ($hargacari1 > 0 && $hargacari2 == 0) {
            $queryFinal = $query3 . " BETWEEN 0 AND $hargacari1 ORDER BY product.nomorproduct ASC";
        } elseif ($hargacari1 == 0 && $hargacari2 > 0) {
            $queryFinal = $query3 . " BETWEEN 0 AND $hargacari2 ORDER BY product.nomorproduct ASC";
        } elseif ($hargacari1 > 0 && $hargacari2 > 0) {
            $queryFinal = $query3 . " BETWEEN $hargacari1 AND $hargacari2 ORDER BY product.nomorproduct ASC";
        }
        return $this->db->query($queryFinal);
    }

    function search() {
        $nomor = $this->input->post('nomor');
        $kategori = $this->input->post('kategori');
        if ($kategori == 0) {
            $query = "SELECT product.idproduct, product.nomorproduct, product.statuspasangan,product.hargaproduct, provider.logoprovider,
                jenisoperator.namajenisoperator, kategori.namakategori FROM product,provider,jenisoperator,kategori WHERE product.nomorproduct LIKE '%$nomor%'
                AND product.idprovider = provider.idprovider AND provider.idjenisoperator = jenisoperator.idjenisoperator AND
                product.idkategori = kategori.idkategori ORDER BY product.nomorproduct ASC";
        } else {
            $query = "SELECT product.idproduct, product.nomorproduct, product.statuspasangan,product.hargaproduct, provider.logoprovider,
                jenisoperator.namajenisoperator, kategori.namakategori FROM product,provider,jenisoperator,kategori WHERE product.nomorproduct LIKE '%$nomor%'
                AND product.idkategori = $kategori AND product.idprovider = provider.idprovider AND provider.idjenisoperator = jenisoperator.idjenisoperator AND
                product.idkategori = kategori.idkategori ORDER BY product.nomorproduct ASC";
        }
        return $this->db->query($query);
    }

    function selectAll() {
        return $this->db->get('product');
    }

    function getAllNoCan() {
        $query = "SELECT * FROM product WHERE product.statuspasangan = 0";
        return $this->db->query($query);
    }

    function getAllNoCanLimited($start_row, $per_page) {
        $query = "SELECT product.idproduct, product.nomorproduct, product.hargaproduct, provider.logoprovider 
        FROM product, provider WHERE product.idprovider = provider.idprovider AND product.statuspasangan = 0
        ORDER BY product.nomorproduct ASC LIMIT $start_row, $per_page";
        return $this->db->query($query);
    }

    function getDistinctStatusNoPas() {
        $query = "SELECT DISTINCT product.statuspasangan FROM product WHERE product.statuspasangan != 0";
        return $this->db->query($query);
    }

    function getHargaTotalByStatus($status) {
        $query = "SELECT SUM(product.hargaproduct) as hargatotal FROM product WHERE product.statuspasangan = $status";
        return $this->db->query($query);
    }

    function getNoPasByStatus($status) {
        $query = "SELECT product.idproduct, product.nomorproduct, product.hargaproduct, product.statuspasangan, provider.namaprovider 
            FROM product, provider WHERE product.statuspasangan = $status AND product.idprovider=provider.idprovider 
            ORDER BY product.nomorproduct ASC";
        return $this->db->query($query);
    }

    function insert() {
        $data['nomorproduct'] = $this->input->post('nomorproduct');
        $data['potongnomorproduct'] = substr($this->input->post('nomorproduct'), 1, strlen($this->input->post('nomorproduct')) - 2);
        $data['hargaproduct'] = $this->input->post('hargaproduct');
        $data['idprovider'] = $this->input->post('idprovider');
        $data['idkategori'] = $this->input->post('idkategori');
        $data['statuspasangan'] = $this->input->post('statuspasangan');
        $query = $this->db->get_where('product', array('nomorproduct' => $data['nomorproduct']));
        if ($query->num_rows() > 0) {
            $pesan = array(
                'message1' => 'data tersebut sudah ada didalam database'
            );
            echo json_encode($pesan);
        } else {
            $this->db->insert('product', $data);
            $pesan = array(
                'message1' => 'data berhasil disimpan'
            );
            echo json_encode($pesan);
        }
    }

    function update() {
        $data['idproduct'] = $this->input->post('idproduct');
        $data['nomorproduct'] = $this->input->post('nomorproduct');
        $data['potongnomorproduct'] = substr($this->input->post('nomorproduct'), 1, strlen($this->input->post('nomorproduct')) - 2);
        $data['hargaproduct'] = $this->input->post('hargaproduct');
        $data['idprovider'] = $this->input->post('idprovider');
        $data['idkategori'] = $this->input->post('idkategori');
        $data['statuspasangan'] = $this->input->post('statuspasangan');

        $this->db->where('idproduct', $data['idproduct']);
        $this->db->update('product', $data);

        $pesan = array(
            'message1' => 'data berhasil diupdate'
        );
        echo json_encode($pesan);
    }

    function delete($id) {
        $this->db->where('idproduct', $id);
        $this->db->delete('product');
    }

}

?>
