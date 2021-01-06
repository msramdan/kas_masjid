<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categori_tujuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Categori_tujuan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','categori_tujuan/categori_tujuan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Categori_tujuan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Categori_tujuan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'categori_tujuan_id' => $row->categori_tujuan_id,
		'nama_categori_tujuan' => $row->nama_categori_tujuan,
	    );
            $this->template->load('template','categori_tujuan/categori_tujuan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categori_tujuan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('categori_tujuan/create_action'),
	    'categori_tujuan_id' => set_value('categori_tujuan_id'),
	    'nama_categori_tujuan' => set_value('nama_categori_tujuan'),
	);
        $this->template->load('template','categori_tujuan/categori_tujuan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_categori_tujuan' => $this->input->post('nama_categori_tujuan',TRUE),
	    );

            $this->Categori_tujuan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('categori_tujuan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Categori_tujuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('categori_tujuan/update_action'),
		'categori_tujuan_id' => set_value('categori_tujuan_id', $row->categori_tujuan_id),
		'nama_categori_tujuan' => set_value('nama_categori_tujuan', $row->nama_categori_tujuan),
	    );
            $this->template->load('template','categori_tujuan/categori_tujuan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categori_tujuan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('categori_tujuan_id', TRUE));
        } else {
            $data = array(
		'nama_categori_tujuan' => $this->input->post('nama_categori_tujuan',TRUE),
	    );

            $this->Categori_tujuan_model->update($this->input->post('categori_tujuan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('categori_tujuan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Categori_tujuan_model->get_by_id($id);

        if ($row) {
            $this->Categori_tujuan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('categori_tujuan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categori_tujuan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_categori_tujuan', 'nama categori tujuan', 'trim|required');

	$this->form_validation->set_rules('categori_tujuan_id', 'categori_tujuan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "categori_tujuan.xls";
        $judul = "categori_tujuan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Categori Tujuan");

	foreach ($this->Categori_tujuan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_categori_tujuan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=categori_tujuan.doc");

        $data = array(
            'categori_tujuan_data' => $this->Categori_tujuan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('categori_tujuan/categori_tujuan_doc',$data);
    }

}

/* End of file Categori_tujuan.php */
/* Location: ./application/controllers/Categori_tujuan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-12-31 13:42:21 */
/* http://harviacode.com */