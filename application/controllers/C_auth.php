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
    function __construct()
    {
        parent::__construct();
    }



    public function index()
    {
        $this->load->helper('captcha');

        $original_string = array_merge(range(1, 9), range('A', 'Z'));
        $original_string = implode("", $original_string);
        $captcha = substr(str_shuffle($original_string), 0, 5);
        $vals = array(
            'word'          => $captcha,
            'img_path'      => './captcha/',
            'img_url'       => base_url() . 'captcha/',
            'font_path'     => FCPATH . 'system/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,

            // White background and border, black text and red grid
            'colors'        => array(
                'background'    => array(255, 255, 255),
                'border'        => array(255, 255, 255),
                'text'          => array(0, 0, 0),
                'grid'          => array(255, 255, 100)
            )
        );

        $cap = create_captcha($vals);
        $this->session->set_userdata("captchaword", $cap["word"]);
        session_write_close();
        $cap['image'];

        $this->load->view('admin/auth/v_login', $cap);
    }

    public function forget_pass()
    {
        $this->load->helper('captcha');

        $original_string = array_merge(range(1, 9), range('A', 'Z'));
        $original_string = implode("", $original_string);
        $captcha = substr(str_shuffle($original_string), 0, 5);
        $vals = array(
            'word'          => $captcha,
            'img_path'      => './captcha/',
            'img_url'       => base_url() . 'captcha/',
            'font_path'     => FCPATH . 'system/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,

            // White background and border, black text and red grid
            'colors'        => array(
                'background'    => array(255, 255, 255),
                'border'        => array(255, 255, 255),
                'text'          => array(0, 0, 0),
                'grid'          => array(255, 255, 100)
            )
        );

        $cap = create_captcha($vals);
        $this->session->set_userdata("captchaword", $cap["word"]);
        session_write_close();
        $cap['image'];

        $this->load->view('admin/auth/v_forget_password', $cap);
    }

    public function login()
    {
        $id_user = $this->input->post('userid');
        $password = $this->input->post('password');
        $captcha = $this->input->post('captcha');

        $this->form_validation->set_rules('userid', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('captcha', 'Chapcha', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/auth/v_login');
        } else {
            $user = $this->db->get_where('user', ['userid' => $id_user])->row_array();
            $data_role = $this->db->query('SELECT * FROM role_fitur WHERE id_role = "' . $user['role'] . '"')->result_array();
            $fitur = array();
            foreach ($data_role as $role) {
                $data_fitur = $this->db->query('SELECT nama_fitur FROM fitur WHERE id = "' . $role['id_fitur'] . '"')->result_array();
                array_push($fitur, $data_fitur[0]['nama_fitur']);
            }

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    if ($this->session->userdata("captchaword") !== $this->input->post("captcha")) {
                        $this->session->set_flashdata('message', 'Captcha salah');
                        redirect(base_url(''));
                    } else {
                        $data = [
                            'id' => $user['id'],
                            'userid' => $user['userid'],
                            'email' => $user['email'],
                            'nama' => $user['nama'],
                            'role' => $user['role'],
                            'fitur' => $fitur,
                        ];
                        $this->session->set_userdata($data);
                        $this->db->query("UPDATE user SET last_access=now() WHERE userid='$id_user'");
                        redirect('beranda');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Username atau password yang di masukan tidak sesuai');
                    redirect(base_url(''));
                }
            }
            $this->session->set_flashdata('message', 'Username atau password yang di masukan tidak sesuai');
            redirect(base_url(''));
        }
    }

    public function forget()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('captcha', 'Chapcha', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->helper('captcha');

            $original_string = array_merge(range(1, 9), range('A', 'Z'));
            $original_string = implode("", $original_string);
            $captcha = substr(str_shuffle($original_string), 0, 5);
            $vals = array(
                'word'          => $captcha,
                'img_path'      => './captcha/',
                'img_url'       => base_url() . 'captcha/',
                'font_path'     => FCPATH . 'system/fonts/texb.ttf',
                'img_width'     => '150',
                'img_height'    => 30,
                'expiration'    => 7200,

                // White background and border, black text and red grid
                'colors'        => array(
                    'background'    => array(255, 255, 255),
                    'border'        => array(255, 255, 255),
                    'text'          => array(0, 0, 0),
                    'grid'          => array(255, 255, 100)
                )
            );

            $cap = create_captcha($vals);
            $this->session->set_userdata("captchaword", $cap["word"]);
            session_write_close();
            $cap['image'];

            $this->load->view('admin/auth/v_forget_password', $cap);
        } else {
            if ($this->session->userdata("captchaword") !== $this->input->post("captcha")) {
                $this->session->set_flashdata('message', 'Captcha salah');
                redirect(base_url('forget_pass'));
            } else {
                echo 'sukses';
                die();
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(''));
    }
}
