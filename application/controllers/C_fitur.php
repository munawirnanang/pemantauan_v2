<?php
defined('BASEPATH') or exit('No direct script access allowed');

class c_fitur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata("id") != null) {

            $data['judul'] = 'Fitur';
            $data['js'] = 'assets/assets/js/js/fitur.js';

            $data['fitur'] = $this->db->query("SELECT * FROM fitur")->result_array();

            $this->load->view('admin/inc/v_header', $data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_fitur');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        } else {
            redirect(base_url(''));
        }
    }

    public function list_fitur()
    {
        if ($this->session->userdata("id") != null) {
            $data['fitur'] = $this->db->query("SELECT * FROM fitur")->result_array();

            $id = array();
            $nama_fitur = array();
            $parent_fitur = array();
            $action = array();
            $number = array();
            $no = 0;
            foreach ($data['fitur'] as $fitur) {
                $no++;
                array_push($number, '<center>' . $no . '</center>');
                array_push($id, $fitur['id']);
                array_push($nama_fitur, $fitur['nama_fitur']);
                $nama_parent_fitur = $this->db->query("SELECT nama_fitur FROM fitur WHERE id='" . $fitur['parent_fitur'] . "'")->result_array();
                if ($nama_parent_fitur) {
                    array_push($parent_fitur, $nama_parent_fitur[0]['nama_fitur']);
                } else {
                    array_push($parent_fitur, null);
                }
                $html = '';
                $html .= '<center>';

                $html .= '<button class="btn btn-sm btn-warning waves-effect waves-light edit-btn" style="border-radius: 0px; margin: 2px;" data-toggle="modal" data-target="#modal-edit" data-edit="' . $fitur['nama_fitur'] . '" data-id="' . $fitur['id'] . '" data-fitur="' . $fitur['parent_fitur'] . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>';
                $html .= '<button class="btn btn-sm btn-danger waves-effect waves-light hapus-btn" style="border-radius: 0px; margin: 2px;" name="hapus" data-hapus="' . $fitur['nama_fitur'] . '" data-idhapus="' . $fitur['id'] . '"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>';

                $html .= '</center>';
                array_push($action, $html);
            }

            $map_fitur = array_map(null, $number, $id, $nama_fitur, $parent_fitur, $action);

            echo json_encode($map_fitur);
        } else {
            redirect(base_url(''));
        }
    }

    public function tambah_fitur()
    {

        if ($this->session->userdata("id") != null) {
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[fitur.nama_fitur]');

            if ($this->form_validation->run() == false) {
                $return['status'] = 'error';
                $return['desc'] = array();
                if (form_error('nama') == true) {
                    $desc['id'] = 'nama';
                    $desc['message'] = form_error('nama', '<small class="text-danger pl-3">', '</small>');
                    array_push($return['desc'], $desc);
                }
                echo json_encode($return);
            } else {
                $data_fitur = [
                    'nama_fitur' => htmlspecialchars($this->input->post('nama')),
                    'parent_fitur' => (htmlspecialchars($this->input->post('fitur')) == '' ? null : htmlspecialchars($this->input->post('fitur'))),
                ];
                $add_fitur = $this->db->insert('fitur', $data_fitur);

                if ($add_fitur == 1) {
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

    public function hapus_fitur()
    {
        if ($this->session->userdata("id") != null) {
            $id = $this->input->post('id');
            $delete_fitur = $this->db->query('DELETE FROM fitur WHERE id=' . $id);
            if ($delete_fitur == true) {
                $return['status'] = 'sukses';
            } else {
                $return['status'] = 'error';
            }
            echo json_encode($return);
        } else {
            redirect(base_url(''));
        }
    }

    public function edit_fitur($id)
    {
        if ($this->session->userdata("id") != null) {

            $data['fitur'] = $this->db->query("SELECT * FROM fitur")->result_array();

            $this->form_validation->set_rules('editnama', 'Nama', 'required|trim');

            if ($this->form_validation->run() == false) {
                $this->load->view('admin/inc/v_header', $data);
                $this->load->view('admin/inc/v_topbar');
                $this->load->view('admin/inc/v_leftside');
                $this->load->view('admin/main/v_fitur');
                $this->load->view('admin/inc/v_rightside');
                $this->load->view('admin/inc/v_footer');
            } else {
                $nama = $this->input->post('editnama');

                $this->db->set('nama_fitur', $nama);
                $this->db->where('id', $id);
                $this->db->update('fitur');
                $this->session->set_flashdata('flash', 'Diedit');
                redirect('fitur');
            }
        } else {
            redirect(base_url(''));
        }
    }

    public function ubah_fitur()
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
                $update_fitur = [
                    'nama_fitur' => htmlspecialchars($this->input->post('editnama')),
                    'parent_fitur' => htmlspecialchars($this->input->post('editfitur')),
                ];
                $update_fitur = $this->db->where('id', htmlspecialchars($this->input->post('editid')))->update('fitur', $update_fitur);
                if ($update_fitur == true) {
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
}
