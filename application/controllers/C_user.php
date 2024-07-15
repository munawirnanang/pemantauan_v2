<?php
defined('BASEPATH') or exit('No direct script access allowed');

class c_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        $id_role = $this->session->userdata('role');

        $fitur = $this->db->query("SELECT RF.id_fitur FROM role_fitur RF JOIN user U ON RF.id_role=U.role WHERE U.role='$id_role'")->result_array();
        foreach ($fitur as $f) {
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
        if ($this->session->userdata("id") != null) {

            $data['judul'] = 'User';
            $data['js'] = 'assets/assets/js/js/user.js';

            $data['user'] = $this->db->query("SELECT * FROM user")->result_array();
            $data['role'] = $this->db->query("SELECT * FROM role")->result_array();

            $this->load->view('admin/inc/v_header', $data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_user');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        } else {
            redirect(base_url(''));
        }
    }

    public function list_user()
    {
        if ($this->session->userdata("id") != null) {
            $data['user'] = $this->db->query("SELECT u.*, r.nama_role FROM user u JOIN role r ON u.role = r.id ORDER BY u.id DESC")->result_array();
            $data['role'] = $this->db->query("SELECT * FROM role")->result_array();

            $id = array();
            $userid = array();
            $nama = array();
            $email = array();
            $role = array();
            $last_access = array();
            $action = array();
            $number = array();
            $no = 0;
            foreach ($data['user'] as $user) {
                $no++;
                array_push($number, '<center>' . $no . '</center>');
                array_push($id, $user['id']);
                array_push($userid, $user['userid']);
                array_push($nama, $user['nama']);
                array_push($email, $user['email']);
                array_push($role, '<center>' . $user['nama_role'] . '</center>');
                array_push($last_access, $user['last_access']);
                // $html = '';
                // $html .= '<center>';
                // $html .= '<button class="btn btn-sm btn-warning waves-effect waves-light edit-btn" style="border-radius: 0px; margin: 2px;" data-toggle="modal" data-target="#modal-edit" data-edit="'.$user["id"].'" data-userid="'.$user["userid"].'" data-email="'.$user["email"].'" data-nama="'$user["nama"]'" data-role="'.$user["role"].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>';
                // $html .= '<button class="btn btn-sm btn-danger waves-effect waves-light" style="border-radius: 0px; margin: 2px;" id="hapus" name="hapus" nama-hapus="'.$user['userid'].'" id-hapus="'.$user['id'].'" action="hapus_user"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>';
                // $html .= '</center>';
                $html = '';
                $html .= '<center>';
                $html .= '<button class="btn btn-sm btn-warning waves-effect waves-light edit-btn" style="border-radius: 0px; margin: 2px;" data-toggle="modal" data-target="#modal-edit" data-edit="' . $user['id'] . '" data-userid="' . $user['userid'] . '" data-email="' . $user['email'] . '" data-nama="' . $user['nama'] . '" data-role="' . $user['role'] . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>';
                $html .= '<button class="btn btn-sm btn-danger waves-effect waves-light hapus-btn" style="border-radius: 0px; margin: 2px;" data-hapus="' . $user['nama'] . '" data-idhapus="' . $user['id'] . '"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>';
                $html .= '</center>';
                array_push($action, $html);
            }

            // $map_user = array_map(null, $number, $id, $userid, $nama, $email, $role, $last_access);
            $map_user = array_map(null, $number, $id, $userid, $nama, $email, $role, $last_access, $action);

            echo json_encode($map_user);
        } else {
            redirect(base_url(''));
        }
    }

    public function get_user()
    {
        if ($this->session->userdata("id") != null) {
            $data['leftside'] = $this->db->query("SELECT * FROM user WHERE id=" . $this->session->userdata("id"))->result_array();
            $data_role = $this->db->query('SELECT * FROM role_fitur WHERE id_role = "' . $data['leftside'][0]['role'] . '"')->result_array();
            $data['fitur'] = array();
            foreach ($data_role as $role) {
                $data_fitur = $this->db->query('SELECT nama_fitur FROM fitur WHERE id = "' . $role['id_fitur'] . '"')->result_array();
                array_push($data['fitur'], $data_fitur[0]['nama_fitur']);
            }
            echo json_encode($data);
        } else {
            redirect(base_url(''));
        }
    }

    public function tambah_user()
    {
        if ($this->session->userdata("id") != null) {

            $this->form_validation->set_rules('userid', 'User ID', 'required|min_length[5]|max_length[12]|is_unique[user.userid]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
            $this->form_validation->set_rules('role', 'Role', 'required|trim');

            if ($this->form_validation->run() == false) {
                $return['status'] = 'error';
                $return['desc'] = array();
                if (form_error('userid') == true) {
                    $desc['id'] = 'userid';
                    $desc['message'] = form_error('userid', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('email') == true) {
                    $desc['id'] = 'email';
                    $desc['message'] = form_error('email', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('nama') == true) {
                    $desc['id'] = 'nama';
                    $desc['message'] = form_error('nama', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('role') == true) {
                    $desc['id'] = 'role';
                    $desc['message'] = form_error('role', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                echo json_encode($return);
            } else {
                $data = [
                    'userid' => htmlspecialchars($this->input->post('userid')),
                    'email' => htmlspecialchars($this->input->post('email')),
                    'nama' => htmlspecialchars($this->input->post('nama')),
                    'password' => password_hash('pancasila', PASSWORD_DEFAULT),
                    'active' => 'N',
                    'role' => htmlspecialchars($this->input->post('role')),
                ];
                $add_user = $this->db->insert('user', $data);
                if ($add_user == 1) {
                    $return['status'] = 'sukses';
                } else {
                    $return['status'] = 'error';
                }
                echo json_encode($return);
            }
        } else {
            redirect(base_url(''));
        }
    }

    public function ubah_user()
    {
        if ($this->session->userdata("id") != null) {
            $this->form_validation->set_rules('editid', 'ID', 'required|trim');
            $this->form_validation->set_rules('edituserid', 'User ID', 'required|min_length[5]|max_length[15]');
            $this->form_validation->set_rules('editemail', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('editnama', 'Nama', 'required|trim');
            $this->form_validation->set_rules('editrole', 'Role', 'required|trim');

            if ($this->form_validation->run() == false) {
                $return['status'] = 'error';
                $return['desc'] = array();
                if (form_error('edituserid') == true) {
                    $desc['id'] = 'edituserid';
                    $desc['message'] = form_error('edituserid', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('editemail') == true) {
                    $desc['id'] = 'editemail';
                    $desc['message'] = form_error('editemail', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('editnama') == true) {
                    $desc['id'] = 'editnama';
                    $desc['message'] = form_error('editnama', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('editrole') == true) {
                    $desc['id'] = 'editrole';
                    $desc['message'] = form_error('editrole', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                echo json_encode($return);
            } else {
                $update_data = [
                    'email' => htmlspecialchars($this->input->post('editemail')),
                    'nama' => htmlspecialchars($this->input->post('editnama')),
                    'role' => htmlspecialchars($this->input->post('editrole')),
                ];
                $update_user = $this->db->where('id', htmlspecialchars($this->input->post('editid')))->update('user', $update_data);
                if ($update_user == true) {
                    $setdata = $this->db->get_where('user', array('id' => htmlspecialchars($this->input->post('editid'))))->result_array();
                    $data = [
                        'id' => $setdata[0]['id'],
                        'userid' => $setdata[0]['userid'],
                        'email' => $setdata[0]['email'],
                        'nama' => $setdata[0]['nama'],
                        'role' => $setdata[0]['role'],
                    ];
                    $this->session->set_userdata($data);
                    $return['status'] = 'sukses';
                    $return['profil'] = $setdata[0]['nama'];
                } else {
                    $return['status'] = 'error';
                }
                echo json_encode($return);
            }
        } else {
            redirect(base_url(''));
        }
    }

    public function ubah_pass()
    {
        if ($this->session->userdata("id") != null) {
            $this->form_validation->set_rules('editpassid', 'ID', 'required|trim');
            $this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim');
            $this->form_validation->set_rules('newpassword', 'New Password', 'required|trim');
            $this->form_validation->set_rules('repeatnewpassword', 'Cofirm New Password', 'required|trim|matches[newpassword]');

            if ($this->form_validation->run() == false) {
                $return['status'] = 'error';
                $return['desc'] = array();
                if (form_error('editpassid') == true) {
                    $desc['id'] = 'editpassid';
                    $desc['message'] = form_error('editpassid', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('currentpassword') == true) {
                    $desc['id'] = 'currentpassword';
                    $desc['message'] = form_error('currentpassword', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('newpassword') == true) {
                    $desc['id'] = 'newpassword';
                    $desc['message'] = form_error('newpassword', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('repeatnewpassword') == true) {
                    $desc['id'] = 'repeatnewpassword';
                    $desc['message'] = form_error('repeatnewpassword', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                echo json_encode($return);
            } else {

                $user = $this->db->get_where('user', ['id' => $this->input->post('editpassid')])->row_array();
                if ($user) {
                    if (password_verify($this->input->post('currentpassword'), $user['password'])) {
                        $update_data = [
                            'password' => password_hash($this->input->post('newpassword'), PASSWORD_DEFAULT),
                        ];
                        $update_user = $this->db->where('id', htmlspecialchars($this->input->post('editpassid')))->update('user', $update_data);
                        if ($update_user == true) {
                            $return['status'] = 'sukses';
                        } else {
                            $return['status'] = 'error2';
                        }
                        echo json_encode($return);
                    } else {
                        $return['status'] = 'error';
                        $return['desc'] = array();
                        $desc['id'] = 'currentpassword';
                        $desc['message'] = '<small class="text-danger pl-3">Current Password salah</small>';
                        array_push($return['desc'], $desc);

                        echo json_encode($return);
                    }
                }
            }
        } else {
            redirect(base_url(''));
        }
    }

    public function hapus_user()
    {
        if ($this->session->userdata("id") != null) {
            $id = $this->input->post('id');
            $delete_user = $this->db->query('DELETE FROM USER WHERE id=' . $id);
            if ($delete_user == true) {
                $return['status'] = 'sukses';
            } else {
                $return['status'] = 'error';
            }
            echo json_encode($return);
        } else {
            redirect(base_url(''));
        }
    }
}
