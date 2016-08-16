<?php

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('ProductModel', 'ProviderModel', 'KategoriModel'));
    }

    function index() {
        //        $this->load->view('backend');
        $data['record'] = $this->ProductModel->selectAll()->result();
        $this->template->load('backend', 'admin/product/data', $data);
    }

    function add() {
        $data['provider'] = $this->ProviderModel->selectIdDanNama()->result();
        $data['kategori'] = $this->KategoriModel->selectAll()->result();
        $this->template->load('backend', 'admin/product/add', $data);
    }

    function insert() {
        $this->form_validation->set_rules('nomorproduct', 'Nomorproduct', 'trim|required|numeric');
        $this->form_validation->set_rules('hargaproduct', 'Hargaproduct', 'trim|required|numeric');
        $this->form_validation->set_rules('idprovider', 'Idprovider', 'trim|required|numeric');
        $this->form_validation->set_rules('idkategori', 'Idkategori', 'trim|required|numeric');
        $this->form_validation->set_rules('statuspasangan', 'Statuspasangan', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'correct' => 'salah',
                'messagenomorproduct' => form_error('nomorproduct'),
                'messagehargaproduct' => form_error('hargaproduct'),
                'messageidprovider' => form_error('idprovider'),
                'messageidkategori' => form_error('idkategori'),
                'messagestatuspasangan' => form_error('statuspasangan')
            );
            echo json_encode($data);
        } else {
            $this->ProductModel->insert();
        }
    }

    function edit() {
        $idproduct = $this->uri->segment(4);
        $data['product'] = $this->db->get_where('product', array('idproduct' => $idproduct))->row_array();
        $data['provider'] = $this->ProviderModel->selectIdDanNama()->result();
        $data['kategori'] = $this->KategoriModel->selectAll()->result();
        $this->template->load('backend', 'admin/product/edit', $data);
    }

    function update() {
        $this->form_validation->set_rules('nomorproduct', 'Nomorproduct', 'trim|required|numeric');
        $this->form_validation->set_rules('hargaproduct', 'Hargaproduct', 'trim|required|numeric');
        $this->form_validation->set_rules('idprovider', 'Idprovider', 'trim|required|numeric');
        $this->form_validation->set_rules('idkategori', 'Idkategori', 'trim|required|numeric');
        $this->form_validation->set_rules('statuspasangan', 'Statuspasangan', 'trim|required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'correct' => 'salah',
                'messagenomorproduct' => form_error('nomorproduct'),
                'messagehargaproduct' => form_error('hargaproduct'),
                'messageidprovider' => form_error('idprovider'),
                'messageidkategori' => form_error('idkategori'),
                'messagestatuspasangan' => form_error('statuspasangan')
            );
            echo json_encode($data);
        } else {
            $this->ProductModel->update();
        }
    }

    function delete() {
        $id = $_GET['idproduct'];
        $this->ProductModel->delete($id);
    }

}

?>
