<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_auth extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function index()
    {
        $this->load->view('admin/auth/v_login');
    }

    public function login()
    {
        $id_user = $this->input->post('userid');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user',['userid' => $id_user])->row_array();

        if($user)
        {
            if(password_verify($password,$user['password']))
            {
                $data = [
                    'id' => $user['id'],
                    'userid' => $user['userid'],
                    'nama' => $user['nama'],
                    'role' => $user['role'],
                ];
                $this->session->set_userdata($data);
                $this->db->query("UPDATE user SET last_access=now() WHERE userid='$id_user'");
                redirect('beranda');
            }else{
                echo 'blok 2';
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('userid');
        redirect('');
    }
}
