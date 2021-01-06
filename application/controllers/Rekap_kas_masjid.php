<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekap_kas_masjid extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rekap_kas_masjid_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/rekap_kas_masjid/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/rekap_kas_masjid/index/';
            $config['first_url'] = base_url() . 'index.php/rekap_kas_masjid/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Rekap_kas_masjid_model->total_rows($q);
        $rekap_kas_masjid = $this->Rekap_kas_masjid_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'rekap_kas_masjid_data' => $rekap_kas_masjid,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','rekap_kas_masjid/kas_masjid_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Rekap_kas_masjid_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_km' => $row->id_km,
		'tgl_km' => $row->tgl_km,
		'uraian_km' => $row->uraian_km,
		'masuk' => $row->masuk,
		'keluar' => $row->keluar,
		'jenis' => $row->jenis,
	    );
            $this->template->load('template','rekap_kas_masjid/kas_masjid_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekap_kas_masjid'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('rekap_kas_masjid/create_action'),
	    'id_km' => set_value('id_km'),
	    'tgl_km' => set_value('tgl_km'),
	    'uraian_km' => set_value('uraian_km'),
	    'masuk' => set_value('masuk'),
	    'keluar' => set_value('keluar'),
	    'jenis' => set_value('jenis'),
	);
        $this->template->load('template','rekap_kas_masjid/kas_masjid_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tgl_km' => $this->input->post('tgl_km',TRUE),
		'uraian_km' => $this->input->post('uraian_km',TRUE),
		'masuk' => $this->input->post('masuk',TRUE),
		'keluar' => $this->input->post('keluar',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
	    );

            $this->Rekap_kas_masjid_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('rekap_kas_masjid'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Rekap_kas_masjid_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('rekap_kas_masjid/update_action'),
		'id_km' => set_value('id_km', $row->id_km),
		'tgl_km' => set_value('tgl_km', $row->tgl_km),
		'uraian_km' => set_value('uraian_km', $row->uraian_km),
		'masuk' => set_value('masuk', $row->masuk),
		'keluar' => set_value('keluar', $row->keluar),
		'jenis' => set_value('jenis', $row->jenis),
	    );
            $this->template->load('template','rekap_kas_masjid/kas_masjid_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekap_kas_masjid'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_km', TRUE));
        } else {
            $data = array(
		'tgl_km' => $this->input->post('tgl_km',TRUE),
		'uraian_km' => $this->input->post('uraian_km',TRUE),
		'masuk' => $this->input->post('masuk',TRUE),
		'keluar' => $this->input->post('keluar',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
	    );

            $this->Rekap_kas_masjid_model->update($this->input->post('id_km', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('rekap_kas_masjid'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Rekap_kas_masjid_model->get_by_id($id);

        if ($row) {
            $this->Rekap_kas_masjid_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('rekap_kas_masjid'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekap_kas_masjid'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_km', 'tgl km', 'trim|required');
	$this->form_validation->set_rules('uraian_km', 'uraian km', 'trim|required');
	$this->form_validation->set_rules('masuk', 'masuk', 'trim|required');
	$this->form_validation->set_rules('keluar', 'keluar', 'trim|required');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');

	$this->form_validation->set_rules('id_km', 'id_km', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kas_masjid.xls";
        $judul = "kas_masjid";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Km");
    xlsWriteLabel($tablehead, $kolomhead++, "Sumber Kas");
    xlsWriteLabel($tablehead, $kolomhead++, "Tujuan Pengeluaran Kas");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Keluar");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis");

	foreach ($this->Rekap_kas_masjid_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_km);
        xlsWriteLabel($tablebody, $kolombody++, $data->nama_categori_sumber);
        xlsWriteLabel($tablebody, $kolombody++, $data->nama_categori_tujuan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->uraian_km);
	    xlsWriteNumber($tablebody, $kolombody++, $data->masuk);
	    xlsWriteNumber($tablebody, $kolombody++, $data->keluar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kas_masjid.doc");

        $data = array(
            'rekap_kas_masjid_data' => $this->Rekap_kas_masjid_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('rekap_kas_masjid/kas_masjid_doc',$data);
    }

}

/* End of file Rekap_kas_masjid.php */
/* Location: ./application/controllers/Rekap_kas_masjid.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-22 18:44:56 */
/* http://harviacode.com */