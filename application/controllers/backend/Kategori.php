<?php

class Kategori extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('KategoriModel');
    }

    function index() {
        //        $this->load->view('backend');
        $data['record'] = $this->KategoriModel->selectAll()->result();
        $this->template->load('backend', 'admin/kategori/data', $data);
    }

    function add() {
        $this->template->load('backend', 'admin/kategori/add');
    }

    function insert() {
        $this->form_validation->set_rules('namakategori', 'Namakategori', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'correct' => 'salah',
                'messagenamakategori' => form_error('namakategori')
            );
            echo json_encode($data);
        } else {
            $this->KategoriModel->insert();
        }
    }

    function edit() {
        $idkategori = $this->uri->segment(4);
        $data['kategori'] = $this->db->get_where('kategori', array('idkategori' => $idkategori))->row_array();
        $this->template->load('backend', 'admin/kategori/edit', $data);
    }
    
    function update() {
        $this->form_validation->set_rules('namakategori', 'Namakategori', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'correct' => 'salah',
                'messagenamakategori' => form_error('namakategori')
            );
            echo json_encode($data);
        } else {
            $this->KategoriModel->update();
        }
    }

    function delete() {
        $id = $_GET['idkategori'];
        $this->KategoriModel->delete($id);
    }

}

?>
