<?php

class JenisOperator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('JenisOperatorModel');
    }

    function index() {
        //        $this->load->view('backend');
        $data['record'] = $this->JenisOperatorModel->selectAll()->result();
        $this->template->load('backend', 'admin/jenisoperator/data', $data);
    }

    function add() {
        $this->template->load('backend', 'admin/jenisoperator/add');
    }

    function insert() {
        $this->form_validation->set_rules('namajenisoperator', 'Namajenisoperator', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'correct' => 'salah',
                'messagenamajenisoperator' => form_error('namajenisoperator')
            );
            echo json_encode($data);
        } else {
            $this->JenisOperatorModel->insert();
        }
    }

    function edit() {
        $idjenisoperator = $this->uri->segment(4);
        $data['jenisoperator'] = $this->db->get_where('jenisoperator', array('idjenisoperator' => $idjenisoperator))->row_array();
        $this->template->load('backend', 'admin/jenisoperator/edit', $data);
    }
    
    function update() {
        $this->form_validation->set_rules('namajenisoperator', 'Namajenisoperator', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'correct' => 'salah',
                'messagenamajenisoperator' => form_error('namajenisoperator')
            );
            echo json_encode($data);
        } else {
            $this->JenisOperatorModel->update();
        }
    }

    function delete() {
        $id = $_GET['idjenisoperator'];
        $this->JenisOperatorModel->delete($id);
    }

}

?>
