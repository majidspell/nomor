<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author majid
 */
class test {

    public function __construct() {
        
    }

    function index() {
        $no = '08573316355700';
        $panjangno = strlen($no)-2;
          $potongnomorcari = substr($no, 1, $panjangno);
          print_r($potongnomorcari);
//        $lastnomorcari = substr($nomorcari, -1, 0);
//        if (preg_match('/7331/', $no)) {
//            print_r('ketemu'.'ddd');
//        } else {
//            print_r('tidak ketemu');
//        }
//        $query = "SELECT product.idproduct, product.nomorproduct, product.statuspasangan,product.hargaproduct, provider.logoprovider,
//                jenisoperator.namajenisoperator, kategori.namakategori FROM product,provider,jenisoperator,kategori WHERE product.nomorproduct LIKE '%$nomor%'
//                AND product.idprovider = provider.idprovider AND provider.idjenisoperator = jenisoperator.idjenisoperator AND
//                product.idkategori = kategori.idkategori";
//        echo str_replace("kategori.idkategori", "Dolly", $query); // outputs Hello Dolly!
    }

}

?>
