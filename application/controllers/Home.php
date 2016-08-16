<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('KategoriModel');
        $this->load->model('ProviderModel');
        $this->load->library('Ajax_pagination');
    }

    function index() {
        $start_row = $this->uri->segment(3);
        $per_page = 12;
        if (trim($start_row) == '') {
            $start_row = 0;
        }

        $configNoCan = array(
            'div' => 'postList',
            'base_url' => site_url() . 'home/show',
            'total_rows' => $this->ProductModel->getAllNoCan()->num_rows(),
            'per_page' => $per_page,
        );

        $this->ajax_pagination->initialize($configNoCan);

        $datanocan = array(
            'nocan' => $this->ProductModel->getAllNoCanLimited($start_row, $per_page),
            'nocanall' => $this->ProductModel->getAllNoCan(),
            'perpage' => $per_page
        );

        ///////////////////////////////////////////////////
        $datanopas['statusnopas'] = $this->ProductModel->getDistinctStatusNoPas();
        ///////////////////////////////////////////////////
        ///////////////////////////////////////////////////
        $datakategori['kategori'] = $this->KategoriModel->selectAll();
        ///////////////////////////////////////////////////

        $this->load->view('senyumcell/staticpage/header', $datakategori);
        $this->load->view('senyumcell/staticpage/slider');
        $this->load->view('senyumcell/home/contentnocan', $datanocan);
        $this->load->view('senyumcell/home/contentnopas', $datanopas);
        $this->load->view('senyumcell/staticpage/joinuswhatwedo');
        $this->load->view('senyumcell/staticpage/footer');
    }

    function show() {
        $start_row = $this->uri->segment(3);
        $per_page = 12;
        if (trim($start_row) == '') {
            $start_row = 0;
        }
        $configNoCan = array(
            'div' => 'postList',
            'base_url' => site_url() . 'home/show',
            'total_rows' => $this->ProductModel->getAllNoCan()->num_rows(),
            'per_page' => $per_page,
        );

        $this->ajax_pagination->initialize($configNoCan);

        $datanocan = array(
            'nocan' => $this->ProductModel->getAllNoCanLimited($start_row, $per_page),
            'nocanall' => $this->ProductModel->getAllNoCan(),
            'perpage' => $per_page
        );

        $this->load->view('senyumcell/home/contentnocanreload', $datanocan, false);
    }

    function search() {
        $datakategori['kategori'] = $this->KategoriModel->selectAll();
        $datasearch['product'] = $this->ProductModel->search();
        $datasearch['operator'] = $this->ProviderModel->selectIdDanNama();

        $this->session->set_flashdata('nomorcari', $this->input->post('nomor'));
        $this->load->view('senyumcell/staticpage/header', $datakategori);
        $this->load->view('senyumcell/search/detailsearch', $datasearch);
        $this->load->view('senyumcell/staticpage/footer');
    }

    function searchRefresh() {
        $this->form_validation->set_message('required', 'Inputan tidak boleh kosong !!!... ');
        $this->form_validation->set_message('numeric', 'Inputan harus berupa angka !!!... ');
        $this->form_validation->set_message('less_than', 'Harga minimal harus lebih kecil dari harga maksimal');
        $this->form_validation->set_message('greater_than', 'Harga maksimal harus lebih besar dari harga minimal');

        $this->form_validation->set_rules('nomorcari', 'Nomorcari', 'trim|required|numeric');
        $this->form_validation->set_rules('hargacari1', 'Hargacari1', 'trim|numeric|less_than[hargacari2]');
        $this->form_validation->set_rules('hargacari2', 'Hargacari2', 'trim|numeric|greater_than[hargacari1]');
        if ($this->form_validation->run() == FALSE) {
            $noCarHalf = trim(str_replace("<p>", "", form_error('nomorcari')));
            $noCarComplete = trim(str_replace("</p>", "", $noCarHalf));

            $hargaCari1Half = trim(str_replace("<p>", "", form_error('hargacari1')));
            $hargaCari1Complete = trim(str_replace("</p>", "", $hargaCari1Half));

            $hargaCari2Half = trim(str_replace("<p>", "", form_error('hargacari2')));
            $hargaCari2Complete = trim(str_replace("</p>", "", $hargaCari2Half));
            $data = array(
                'correct' => 'salah',
                'messagenomorcari' => $noCarComplete,
                'messagehargacari1' => $hargaCari1Complete,
                'messagehargacari2' => $hargaCari2Complete
            );
            echo json_encode($data);
        } else {
//            $this->ProductModel->searchRefresh();
        }
    }

    function searchRefreshShow() {
        $productsort = $this->ProductModel->searchRefresh();
        $no = 1;
                        foreach ($productsort->result() as $ps) {
                         echo" <tr class = 'dataproduct$ps->idproduct'>
                        <td class = 'text-center senyumcell-table-center' width = '5px'>$no</td>
                        <td width = '50px'><img width = '50px' height = '40px' class = 'media-object' src = " . base_url() . "pictures/" . $ps->logoprovider . " alt = 'logo operator'></td>
                        <td class = 'text-center senyumcell-table-center'>$ps->nomorproduct</td>
                        <td class = 'text-center senyumcell-table-center'>$ps->namakategori</td>
                        <td width = '50px' class = 'text-center senyumcell-table-center'>$ps->namajenisoperator</td>
                        <td class = 'text-right senyumcell-table-center'>$ps->hargaproduct</td>
                        <td class = 'text-center senyumcell-table-center'><button type = 'button' class = 'btn btn-primary btn-sm'>Beli</button></td>
                        </tr >
                                ";
                            $no++;
                        }
    }

}
