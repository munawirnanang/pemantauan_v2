<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_role extends CI_Controller
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
        
        $data['js']= 'assets/assets/js/js/role.js';
        $data['menu'] = 'Role';

        $data['fitur'] = $this->db->query("SELECT * FROM fitur")->result_array();
        $data['data_tabel'] = $this->db->get("role")->result_array();
        $data['role_fitur'] = $this->db->get("role_fitur")->result_array();     

        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_role');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }

    public function tambah_role()
    {
        $data['fitur'] = $this->db->query("SELECT * FROM fitur")->result_array();
        
        $this->form_validation->set_rules('nama','Nama','required|trim');

        if($this->form_validation->run()==false){
            $this->load->view('admin/inc/v_header',$data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_role');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        }else{
            $data_role=[
                'nama_role' => htmlspecialchars($this->input->post('nama')),
            ];
            $fitur = $this->input->post('fitur');
            $this->db->insert('role',$data_role);
            $id = $this->db->insert_id();
            foreach($fitur as $f){
                $data_fitur=[
                    'id_fitur' => $f,
                    'id_role' => $id
                ];
                $this->db->insert('role_fitur',$data_fitur);
            }
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('role');
        }
    }
    
    public function update_role()
    {
        $fitur = $this->input->post('fitur');
        $role = $this->input->post('role');
        $ceklis = $this->input->post('ceklis');
        
        
        if($ceklis == "true"){
            $data_role=[
                'id_role' => $role,
                'id_fitur' => $fitur
            ];
            $this->db->insert('role_fitur',$data_role);
        }else{
            $this->db->where('id_role',$role);
            $this->db->where('id_fitur',$fitur);
            $this->db->delete('role_fitur');
        }
    }

    public function hapus_role()
    {
        $id_role = $this->input->post('id');
        $this->db->where('id',$id_role);
        $this->db->delete('role');
    }

    public function edit_role($id)
    {
        $data['fitur'] = $this->db->query("SELECT * FROM fitur")->result_array();
        
        $this->form_validation->set_rules('editnama','Nama','required|trim');

        if($this->form_validation->run()==false){
            $this->load->view('admin/inc/v_header',$data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_role');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        }else{
            $data = htmlspecialchars($this->input->post('editnama'));
            $this->db->set('nama_role',$data);
            $this->db->where('id',$id);
            $this->db->update('role');
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('role');
        }
    }

}
