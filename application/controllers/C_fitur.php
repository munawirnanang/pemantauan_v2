<?php
defined('BASEPATH') or exit('No direct script access allowed');

class c_fitur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        $id_role=$this->session->userdata('role');

        $fitur = $this->db->query("SELECT RF.id_fitur FROM role_fitur RF JOIN user U ON RF.id_role=U.role WHERE U.role='$id_role'")->result_array();
        foreach($fitur as $f){
            $array_fitur[] = $f['id_fitur']; 
        };
        
        if (!$this->session->userdata('userid')) {
            redirect('');
        }
    }

    public function index()
    {
        

        $data['js']= 'assets/assets/js/js/fitur.js';

        $data['fitur']= $this->db->query("SELECT * FROM fitur")->result_array();

        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_fitur');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }

    public function tambah_fitur()
    {
        $this->form_validation->set_rules('nama','Nama','required|trim');

        if($this->form_validation->run()==false)
        {
            $this->load->view('admin/inc/v_header');
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_fitur');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        }else{
            $data=[
                'nama_fitur' => htmlspecialchars($this->input->post('nama')),
            ];
            $this->db->insert('fitur',$data);
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('fitur');
        }
    }

    public function hapus_fitur()
    {
        $id_fitur = $this->input->post('id');
        $this->db->where('id',$id_fitur);
        $this->db->delete('fitur');
    }

    public function edit_fitur($id)
    {

        $data['fitur']= $this->db->query("SELECT * FROM fitur")->result_array();

        $this->form_validation->set_rules('editnama','Nama','required|trim');

        if($this->form_validation->run()==false)
        {
            $this->load->view('admin/inc/v_header',$data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_fitur');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        }else{
            $nama = $this->input->post('editnama');
    
            $this->db->set('nama_fitur',$nama);
            $this->db->where('id',$id);
            $this->db->update('fitur');
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('fitur');
        }

        
    
    }
}
