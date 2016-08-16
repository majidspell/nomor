<?php

class GrupProvider extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('GrupProviderModel');
    }

    function index() {
        //        $this->load->view('backend');
        $data['record'] = $this->GrupProviderModel->selectAll()->result();
        $this->template->load('backend', 'admin/grupprovider/data', $data);
    }

    function add() {
        $this->template->load('backend', 'admin/grupprovider/add');
    }

    function insert() {
        $this->form_validation->set_rules('namagrupprovider', 'Namagrupprovider', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'correct' => 'salah',
                'messagenamagrupprovider' => form_error('namagrupprovider')
            );
            echo json_encode($data);
        } else {
            $this->GrupProviderModel->insert();
        }
    }

    function edit() {
        $idgrupprovider = $this->uri->segment(4);
        $data['grupprovider'] = $this->db->get_where('grupprovider', array('idgrupprovider' => $idgrupprovider))->row_array();
        $this->template->load('backend', 'admin/grupprovider/edit', $data);
    }
    
    function update() {
        $this->form_validation->set_rules('namagrupprovider', 'Namagrupprovider', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'correct' => 'salah',
                'messagenamagrupprovider' => form_error('namagrupprovider')
            );
            echo json_encode($data);
        } else {
            $this->GrupProviderModel->update();
        }
    }

    function delete() {
        $id = $_GET['idgrupprovider'];
        $this->GrupProviderModel->delete($id);
    }

}

?>
