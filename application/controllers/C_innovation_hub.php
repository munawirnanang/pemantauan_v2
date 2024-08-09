<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_innovation_hub extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        if ($this->session->userdata("id") != null) {

            $data['judul'] = 'Innovation Hub';
            $data['js'] = 'assets/assets/js/js/innovation_hub.js';

            $this->load->view('admin/inc/v_header', $data);
            $this->load->view('admin/inc/v_topbar_v2');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_innovationHub');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        } else {
            redirect(base_url(''));
        }
    }

    public function show_innovation_doc()
    {
        if ($this->session->userdata("id") != null) {
            $data_doc_inovasi = $this->db->query(
                "SELECT UDP.*
                FROM
                (
                    SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi, inovP.nama_inovasi, inovP.deskripsi, inovP.input, inovP.proses, inovP.output, inovP.outcome, inovP.tag
                    FROM peppd_ppd2024.t_doc_prov doc_prov
                    JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2024.provinsi prov ON doc_prov.provid = prov.id
                    JOIN peppd_ppd2024.t_doc_prov_inov inovP ON doc_prov.id = inovP.id_doc_prov
                    UNION
                    SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten, inovK.nama_inovasi, inovK.deskripsi, inovK.input, inovK.proses, inovK.output, inovK.outcome, inovK.tag
                    FROM peppd_ppd2024.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2024.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    JOIN peppd_ppd2024.t_doc_kab_inov inovK ON doc_kabkot.id = inovK.id_doc_kab
                    ORDER BY cr_dt DESC
                ) AS UDP
                WHERE UDP.nama IN ('Dokumen_Inovasi')
                GROUP BY UDP.judul DESC  
                ORDER BY `UDP`.`provid` ASC"
            )->result();

            $id = 1;
            $new_array_doc = array();
            foreach ($data_doc_inovasi as $ddoc) {
                $data = [
                    'id' => $id,
                    'Nama Dokumen' => str_replace("_", " ", $ddoc->judul),
                    'Judul' => $ddoc->nama_inovasi,
                    'Tag' => str_replace("_", " ", $ddoc->tag),
                    'Tahun' => str_replace("_", " ", $ddoc->cr_dt),
                    'Instansi' => str_replace("_", " ", $ddoc->nama_provinsi),
                    'Deskripsi' => $ddoc->deskripsi,
                    'Input' => $ddoc->input,
                    'Proses' => $ddoc->proses,
                    'Output' => $ddoc->output,
                    'Outcome' => $ddoc->outcome,
                    'Aksi' => '<a class="btn btn-xs btn-info btn-bordered waves-effect waves-light m-b-5" target="_blank" href="' . $ddoc->link . '">Lihat Dokumen</a> <a class="btn btn-xs btn-inverse btn-bordered waves-effect waves-light m-b-5 addFile" id="download-' . $id . '" onclick="addToFolder(' . $id . ')">Ajukan Replikasi</a>',
                ];
                array_push($new_array_doc, $data);
                $id++;
            }

            echo json_encode($new_array_doc);
        } else {
            redirect(base_url(''));
        }
    }
}
