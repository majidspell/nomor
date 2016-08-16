<?php

class Provider extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('ProviderModel', 'GrupProviderModel', 'JenisOperatorModel'));
    }

    function index() {
        //        $this->load->view('backend');
        $data['record'] = $this->ProviderModel->selectAll()->result();
        $this->template->load('backend', 'admin/provider/data', $data);
    }

    function add() {
        $data['grupprovider'] = $this->GrupProviderModel->selectAll()->result();
        $data['jenisoperator'] = $this->JenisOperatorModel->selectAll()->result();
        $this->template->load('backend', 'admin/provider/add', $data);
    }

    function insert() {
        $this->form_validation->set_rules('namaprovider', 'Namaprovider', 'trim|required');
        $this->form_validation->set_rules('idgrupprovider', 'Idgrupprovider', 'trim|required|numeric');
        $this->form_validation->set_rules('idjenisoperator', 'Idjenisoperator', 'trim|required|numeric');

        $config = array(
            'upload_path' => './pictures/',
            'allowed_types' => 'gif|jpg|png', // Jenis file yang di ijinkan
            'file_name' => 'file_' . date('dmYHis'), // Codeigniter otomatis akan merename file
            'file_ext_tolower' => TRUE, // mengubah extensi menjadi huruf kecil
            'overwrite' => TRUE, // Jika bernilai TRUE maka file dengan nama yang sama akan ditimpa
            'max_size' => 3000, // Maksimal ukuran file dalam Kilobyte, jika di isi 0 maka tidak terhingga
            'max_width' => 3000, // maksimal panjang gambar dalam ukuran pixel
            'max_height' => 3000, // maksimal lebar gambar dalam ukuran pixel  
            'min_width' => 10, // minimal panjang gambar dalam ukuran pixel  
            'min_height' => 7, // minimal lebar gambar dalam ukuran pixel      
            'remove_spaces' => TRUE
        );
        $this->upload->initialize($config);
        if ($this->form_validation->run() == TRUE && $this->upload->do_upload("logoprovider")) {
            $hasil = $this->upload->data(); //Menampilkan pesan sukses  
            $this->ProviderModel->insert($hasil);
        } else {
            $hasil = $this->upload->display_errors(); //Menampilkan pesan error
            $data = array(
                'correct' => 'salah',
                'messagenamaprovider' => form_error('namaprovider'),
                'messageidgrupprovider' => form_error('idgrupprovider'),
                'messageidjenisoperator' => form_error('idjenisoperator'),
                'messagelogoprovider' => $hasil
            );
            echo json_encode($data);
        }
    }

    function edit() {
        $idprovider = $this->uri->segment(4);
        $data['provider'] = $this->db->get_where('provider', array('idprovider' => $idprovider))->row_array();
        $data['grupprovider'] = $this->GrupProviderModel->selectAll()->result();
        $data['jenisoperator'] = $this->JenisOperatorModel->selectAll()->result();
        $this->template->load('backend', 'admin/provider/edit', $data);
    }
    
     function refresh() {
        $idupload = $this->input->post('idupload');
        $provider = $this->ProviderModel->selectProviderById($idupload);
        foreach ($provider->result() as $p) {
            echo "<img src='" . base_url() . "pictures/" . $p->logoprovider . "' width='50px' height='50px' alt='no image found' class ='img-rounded'/>";
        }
    }


    function update() {
        $this->form_validation->set_rules('namaprovider', 'Namaprovider', 'trim|required');
        $this->form_validation->set_rules('idgrupprovider', 'Idgrupprovider', 'trim|required|numeric');
        $this->form_validation->set_rules('idjenisoperator', 'Idjenisoperator', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'correct' => 'salah',
                'messagenamaprovider' => form_error('namaprovider'),
                'messageidgrupprovider' => form_error('idgrupprovider'),
                'messageidjenisoperator' => form_error('idjenisoperator')
            );
            echo json_encode($data);
        } else {
            $this->ProviderModel->update();
        }
    }
    
    function upload() {
        $config = array(
            'upload_path' => './pictures/',
            'allowed_types' => 'gif|jpg|png', // Jenis file yang di ijinkan
            'file_name' => 'file_' . date('dmYHis'), // Codeigniter otomatis akan merename file
            'file_ext_tolower' => TRUE, // mengubah extensi menjadi huruf kecil
            'overwrite' => TRUE, // Jika bernilai TRUE maka file dengan nama yang sama akan ditimpa
            'max_size' => 3000, // Maksimal ukuran file dalam Kilobyte, jika di isi 0 maka tidak terhingga
            'max_width' => 3000, // maksimal panjang gambar dalam ukuran pixel
            'max_height' => 3000, // maksimal lebar gambar dalam ukuran pixel  
            'min_width' => 10, // minimal panjang gambar dalam ukuran pixel  
            'min_height' => 7, // minimal lebar gambar dalam ukuran pixel      
            'remove_spaces' => TRUE
        );
        $this->upload->initialize($config);
        $idprovider = $this->input->post('idprovider');
        if ($this->upload->do_upload("logoprovider")) {
            $hasil = $this->upload->data(); //Menampilkan pesan sukses  
            $this->ProviderModel->upload($hasil, $idprovider);
        } else {
            $hasil = $this->upload->display_errors(); //Menampilkan pesan error
            echo $hasil;
        }
    }

    function delete() {
        $idprovider = $_GET['idprovider'];
        $this->ProviderModel->delete($idprovider);
    }

}

?>
