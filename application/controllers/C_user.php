<?php
defined('BASEPATH') or exit('No direct script access allowed');

class c_user extends CI_Controller
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
        // elseif(!in_array("4",$array_fitur)){
        //     redirect('beranda');
        // }
    }

    public function index()
    {
        
        $data['judul'] = 'User';
        $data['js']= 'assets/assets/js/js/user.js';

        $data['user']= $this->db->query("SELECT * FROM user")->result_array();
        $data['role']= $this->db->query("SELECT * FROM role")->result_array();


        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_user');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }

    public function tambah_user()
    {
        $this->form_validation->set_rules('userid','User ID','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim');
        $this->form_validation->set_rules('nama','Nama','required|trim');

        if($this->form_validation->run()==false)
        {
            $this->load->view('admin/inc/v_header');
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_user');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        }else{
            $data=[
                'userid' => htmlspecialchars($this->input->post('userid')),
                'email' => htmlspecialchars($this->input->post('email')),
                'nama' => htmlspecialchars($this->input->post('nama')),
                'password' => password_hash('pancasila',PASSWORD_DEFAULT),
                'active' => 'N',
                'role' => htmlspecialchars($this->input->post('role')),
            ];
            $this->db->insert('user',$data);
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('user');
        }
    }

    public function hapus_user()
    {
        $id_user = $this->input->post('id');
        $this->db->where('id',$id_user);
        $this->db->delete('user');
    }

    public function edit_user($id)
    {

        $data['user']= $this->db->query("SELECT * FROM user")->result_array();
        $data['role']= $this->db->query("SELECT * FROM role")->result_array();


        $this->form_validation->set_rules('edituserid','User ID','required|trim');
        $this->form_validation->set_rules('editemail','Email','required|trim');
        $this->form_validation->set_rules('editnama','Nama','required|trim');

        if($this->form_validation->run()==false)
        {
            $this->load->view('admin/inc/v_header',$data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_user');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        }else{
            $userid = $this->input->post('edituserid');
            $email = $this->input->post('editemail');
            $nama = $this->input->post('editnama');
            $role = $this->input->post('editrole');
    
            $this->db->set('email',$email);
            $this->db->set('nama',$nama);
            $this->db->set('role',$role);
            $this->db->where('id',$id);
            $this->db->update('user');
            $this->session->set_flashdata('flash', 'Diedit');
            redirect('user');
        }

        
    
    }
}
