<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if ($this->session->userdata("id") != null) {
            $data['judul'] = 'Role';
            $data['js'] = 'assets/assets/js/js/role.js';

            $data['fitur'] = $this->db->query("SELECT * FROM fitur")->result_array();
            $data['data_tabel'] = $this->db->get("role")->result_array();
            $data['role_fitur'] = $this->db->get("role_fitur")->result_array();

            $this->load->view('admin/inc/v_header', $data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_role');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        } else {
            redirect(base_url(''));
        }
    }

    public function list_role()
    {
        if ($this->session->userdata("id") != null) {
            $data['fitur'] = $this->db->query("SELECT * FROM fitur")->result_array();
            $data['data_tabel'] = $this->db->get("role")->result_array();
            $data['role_fitur'] = $this->db->get("role_fitur")->result_array();

            $id = array();
            $nama_role = array();
            $nama_fitur = array();
            $action = array();
            $number = array();
            $no = 0;
            foreach ($data['data_tabel'] as $role) {
                $role_fitur_by_akun = array();
                $no++;
                array_push($number, '<center>' . $no . '</center>');
                array_push($id, $role['id']);
                array_push($nama_role, $role['nama_role']);
                $fitur = '';
                $number_wrap = 0;
                foreach ($data['fitur'] as $f) {
                    foreach ($data['role_fitur'] as $rf) {
                        if ($rf['id_role'] == $role['id'] && $rf['id_fitur'] == $f['id']) {
                            array_push($role_fitur_by_akun, (int)$f['id']);
                            $fitur .= '<span class="label label-default" style="margin: 2px; margin-top:2px;">' . $f['nama_fitur'] . '</span>';
                            $number_wrap++;
                            if ($number_wrap == 4) {
                                $fitur .= '<br/>';
                                $number_wrap = 0;
                            }
                        }
                    }
                }
                array_push($nama_fitur, $fitur);
                $html = '';
                $html .= '<center>';
                $html .= '<button class="btn btn-sm btn-warning waves-effect waves-light edit-btn" style="border-radius: 0px; margin: 2px;" data-toggle="modal" data-target="#modal-edit" id="edit" name="edit" data-edit="' . $role['nama_role'] . '" data-id="' . $role['id'] . '"data-fitur="' . json_encode($role_fitur_by_akun) . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>';
                $html .= '<button class="btn btn-sm btn-danger waves-effect waves-light hapus-btn" style="border-radius: 0px; margin: 2px;" name="hapus" data-hapus="' . $role['nama_role'] . '" data-idhapus="' . $role['id'] . '" action="hapus_role"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>';
                // $html .= '<button class="btn btn-sm btn-danger waves-effect waves-light hapus-btn" style="border-radius: 0px; margin: 2px;" id="hapus" name="hapus" data-hapus="' . $role['nama_role'] . '" data-idhapus="' . $role['id'] . '" action="hapus_role"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>';
                $html .= '</center>';
                array_push($action, $html);
            }

            $map_role = array_map(null, $number, $id, $nama_role, $nama_fitur, $action);

            echo json_encode($map_role);
        } else {
            redirect(base_url(''));
        }
    }

    public function tambah_role()
    {
        if ($this->session->userdata("id") != null) {

            $this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[role.nama_role]');
            $this->form_validation->set_rules('fitur[]', 'Fitur', 'required|trim');

            if ($this->form_validation->run() == false) {
                $return['status'] = 'error';
                $return['desc'] = array();
                if (form_error('nama') == true) {
                    $desc['id'] = 'nama';
                    $desc['message'] = form_error('nama', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('fitur') == true) {
                    $desc['id'] = 'fitur';
                    $desc['message'] = form_error('fitur', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if ($this->input->post('fitur') == null) {
                    $desc['id'] = 'fitur';
                    $desc['message'] = '<small class="text-danger pl-3">The Fitur field is required.</small>';
                    array_push($return['desc'], $desc);
                }
                echo json_encode($return);
            } else {
                $data_role = [
                    'nama_role' => htmlspecialchars($this->input->post('nama')),
                ];
                $fitur = $this->input->post('fitur');
                $add_role = $this->db->insert('role', $data_role);
                $id = $this->db->insert_id();
                foreach ($fitur as $f) {
                    $data_fitur = [
                        'id_fitur' => $f,
                        'id_role' => $id
                    ];
                    $this->db->insert('role_fitur', $data_fitur);
                }

                if ($add_role == 1) {
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

    public function update_role()
    {
        if ($this->session->userdata("id") != null) {
            $fitur = $this->input->post('fitur');
            $role = $this->input->post('role');
            $ceklis = $this->input->post('ceklis');


            if ($ceklis == "true") {
                $data_role = [
                    'id_role' => $role,
                    'id_fitur' => $fitur
                ];
                $this->db->insert('role_fitur', $data_role);
            } else {
                $this->db->where('id_role', $role);
                $this->db->where('id_fitur', $fitur);
                $this->db->delete('role_fitur');
            }
        } else {
            redirect(base_url(''));
        }
    }


    public function hapus_role()
    {
        if ($this->session->userdata("id") != null) {
            $id = $this->input->post('id');
            $delete_user = $this->db->query('DELETE FROM role WHERE id=' . $id);
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

    public function edit_role($id)
    {
        if ($this->session->userdata("id") != null) {
            $data['fitur'] = $this->db->query("SELECT * FROM fitur")->result_array();

            $this->form_validation->set_rules('editnama', 'Nama', 'required|trim');

            if ($this->form_validation->run() == false) {
                $this->load->view('admin/inc/v_header', $data);
                $this->load->view('admin/inc/v_topbar');
                $this->load->view('admin/inc/v_leftside');
                $this->load->view('admin/main/v_role');
                $this->load->view('admin/inc/v_rightside');
                $this->load->view('admin/inc/v_footer');
            } else {
                $data = htmlspecialchars($this->input->post('editnama'));
                $this->db->set('nama_role', $data);
                $this->db->where('id', $id);
                $this->db->update('role');
                $this->session->set_flashdata('flash', 'Diedit');
                redirect('role');
            }
        } else {
            redirect(base_url(''));
        }
    }

    public function ubah_role()
    {
        if ($this->session->userdata("id") != null) {
            $this->form_validation->set_rules('editid', 'ID', 'required|trim');
            $this->form_validation->set_rules('editnama', 'Nama', 'required|trim');

            if ($this->form_validation->run() == false) {
                $return['status'] = 'error';
                $return['desc'] = array();
                if (form_error('editid') == true) {
                    $desc['id'] = 'editid';
                    $desc['message'] = form_error('editid', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                if (form_error('editnama') == true) {
                    $desc['id'] = 'editnama';
                    $desc['message'] = form_error('editnama', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                echo json_encode($return);
            } else {
                $update_data = [
                    'nama_role' => htmlspecialchars($this->input->post('editnama')),
                ];
                $update_role = $this->db->where('id', htmlspecialchars($this->input->post('editid')))->update('role', $update_data);

                $fitur = $this->input->post('editfitur');
                $id = htmlspecialchars($this->input->post('editid'));
                if ($fitur != null) {
                    $this->db->query('DELETE FROM role_fitur WHERE id_role =' . $id);
                    foreach ($fitur as $f) {
                        $select_role_fitur = $this->db->query('SELECT * FROM role_fitur WHERE id_fitur = "' . $f . '" AND id_role = "' . $id . '"')->result_array();
                        if ($select_role_fitur == null) {
                            $data_fitur = [
                                'id_fitur' => $f,
                                'id_role' => $id
                            ];
                            $add_role_fitur = $this->db->insert('role_fitur', $data_fitur);
                        }
                    }
                }
                if ($fitur == null) {
                    if ($update_role == true) {
                        $return['status'] = 'sukses';
                    } else {
                        $return['status'] = 'error';
                    }
                } else {
                    if ($add_role_fitur == 1) {
                        $return['status'] = 'sukses';
                    } else {
                        $return['status'] = 'error';
                    }
                }
                echo json_encode($return);
            }
        } else {
            redirect(base_url(''));
        }
    }
}
