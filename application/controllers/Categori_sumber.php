<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categori_sumber extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Categori_sumber_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/categori_sumber/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/categori_sumber/index/';
            $config['first_url'] = base_url() . 'index.php/categori_sumber/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Categori_sumber_model->total_rows($q);
        $categori_sumber = $this->Categori_sumber_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'categori_sumber_data' => $categori_sumber,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','categori_sumber/categori_sumber_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Categori_sumber_model->get_by_id($id);
        if ($row) {
            $data = array(
		'categori_sumber_id' => $row->categori_sumber_id,
		'nama_categori_sumber' => $row->nama_categori_sumber,
	    );
            $this->template->load('template','categori_sumber/categori_sumber_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categori_sumber'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('categori_sumber/create_action'),
	    'categori_sumber_id' => set_value('categori_sumber_id'),
	    'nama_categori_sumber' => set_value('nama_categori_sumber'),
	);
        $this->template->load('template','categori_sumber/categori_sumber_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_categori_sumber' => $this->input->post('nama_categori_sumber',TRUE),
	    );

            $this->Categori_sumber_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('categori_sumber'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Categori_sumber_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('categori_sumber/update_action'),
		'categori_sumber_id' => set_value('categori_sumber_id', $row->categori_sumber_id),
		'nama_categori_sumber' => set_value('nama_categori_sumber', $row->nama_categori_sumber),
	    );
            $this->template->load('template','categori_sumber/categori_sumber_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categori_sumber'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('categori_sumber_id', TRUE));
        } else {
            $data = array(
		'nama_categori_sumber' => $this->input->post('nama_categori_sumber',TRUE),
	    );

            $this->Categori_sumber_model->update($this->input->post('categori_sumber_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('categori_sumber'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Categori_sumber_model->get_by_id($id);

        if ($row) {
            $this->Categori_sumber_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('categori_sumber'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categori_sumber'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_categori_sumber', 'nama categori sumber', 'trim|required');

	$this->form_validation->set_rules('categori_sumber_id', 'categori_sumber_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "categori_sumber.xls";
        $judul = "categori_sumber";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Categori Sumber");

	foreach ($this->Categori_sumber_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_categori_sumber);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=categori_sumber.doc");

        $data = array(
            'categori_sumber_data' => $this->Categori_sumber_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('categori_sumber/categori_sumber_doc',$data);
    }

}

/* End of file Categori_sumber.php */
/* Location: ./application/controllers/Categori_sumber.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-12-31 13:35:36 */
/* http://harviacode.com */