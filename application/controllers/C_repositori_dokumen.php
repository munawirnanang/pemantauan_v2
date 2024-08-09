<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_repositori_dokumen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        if ($this->session->userdata("id") != null) {
            $data['judul'] = 'Repositori Dokumen';
            $data['js'] = 'assets/assets/js/js/repositori_dokumen.js';

            $jenis = $this->db->query("SELECT URD.nama FROM (SELECT * FROM peppd_ppd2022.tbl_jenis_doc UNION SELECT * FROM peppd_ppd2023.tbl_jenis_doc UNION SELECT * FROM peppd_ppd2024.tbl_jenis_doc) AS URD GROUP BY URD.nama ORDER BY URD.nama ASC")->result();

            $count_of_jenis = count($jenis);
            $new_array_jenis = array();
            $rep1 = 0;
            while ($rep1 < $count_of_jenis) {
                $rep2 = 0;
                while ($rep2 < $count_of_jenis) {
                    if ($jenis[$rep1]->nama . "_(Murni)" != $jenis[$rep2]->nama) {
                        $rep2++;
                    } else {
                        $rep2 = $count_of_jenis;
                        $rep1++;
                    }
                }
                array_push($new_array_jenis, $jenis[$rep1]->nama);
                $rep1++;
            }
            $data['jenis'] = $new_array_jenis;

            $change_jenis = preg_replace('/[\[\]]/', '', json_encode($new_array_jenis));

            $data['change_jenis'] = $change_jenis;


            $data_doc = $this->db->query(
                "SELECT UDP.*
                FROM
                (
                    SELECT doc_prov.*, j.nama, prov.nama_provinsi
                    FROM peppd_ppd2022.t_doc_prov doc_prov
                    JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2022.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_prov.*, j.nama, prov.nama_provinsi
                    FROM peppd_ppd2023.t_doc_prov doc_prov
                    JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2023.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_prov.*, j.nama, prov.nama_provinsi
                    FROM peppd_ppd2024.t_doc_prov doc_prov
                    JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2024.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_kabkot.*, j.nama, kabkot.nama_kabupaten
                    FROM peppd_ppd2022.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2022.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    UNION
                    SELECT doc_kabkot.*, j.nama, kabkot.nama_kabupaten
                    FROM peppd_ppd2023.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2023.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    UNION
                    SELECT doc_kabkot.*, j.nama, kabkot.nama_kabupaten
                    FROM peppd_ppd2024.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2024.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                ) AS UDP
                WHERE UDP.nama IN (" . $change_jenis . ")
                GROUP BY UDP.judul DESC
                ORDER BY UDP.judul ASC"
            )->result();

            $data['data_doc'] = $data_doc;

            $this->load->view('admin/inc/v_header', $data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_repositori_dokumen');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        } else {
            redirect(base_url(''));
        }
    }

    public function show_doc()
    {
        if ($this->session->userdata("id") != null) {
            $jenis_with_apbd_rkpd = $this->db->query("SELECT URD.nama FROM (SELECT * FROM peppd_ppd2022.tbl_jenis_doc WHERE nama LIKE 'APBD%' OR nama LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2023.tbl_jenis_doc WHERE nama LIKE 'APBD%' OR nama LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2024.tbl_jenis_doc WHERE nama LIKE 'APBD%' OR nama LIKE 'RKPD%') AS URD GROUP BY URD.nama ORDER BY `URD`.`nama`  DESC")->result();
            $jenis_without_apbd_rkpd = $this->db->query("SELECT URD.nama FROM (SELECT * FROM peppd_ppd2022.tbl_jenis_doc WHERE nama NOT LIKE 'APBD%' AND nama NOT LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2023.tbl_jenis_doc WHERE nama NOT LIKE 'APBD%' AND nama NOT LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2024.tbl_jenis_doc WHERE nama NOT LIKE 'APBD%' AND nama NOT LIKE 'RKPD%') AS URD ORDER BY URD.nama ASC")->result();

            $count_of_jenis = count($jenis_with_apbd_rkpd);
            $new_array_jenis = array();
            $rep1 = 0;
            while ($rep1 < $count_of_jenis) {
                $rep2 = 0;
                while ($rep2 < $count_of_jenis) {
                    if ($jenis_with_apbd_rkpd[$rep1]->nama . "_(Murni)" != $jenis_with_apbd_rkpd[$rep2]->nama) {
                        $rep2++;
                    } else {
                        $rep2 = $count_of_jenis;
                        $rep1++;
                    }
                }
                array_push($new_array_jenis, $jenis_with_apbd_rkpd[$rep1]->nama);
                $rep1++;
            }
            $data['jenis_with_apbd_rkpd'] = $new_array_jenis;

            $new_array_jenis_2 = array();
            foreach ($jenis_without_apbd_rkpd as $without) {
                array_push($new_array_jenis_2, $without->nama);
            }
            $data['jenis_without_apbd_rkpd'] = $new_array_jenis_2;

            $change_jenis_with_apbd_rkpd = preg_replace('/[\[\]]/', '', json_encode($new_array_jenis));
            $change_jenis_without_apbd_rkpd = preg_replace('/[\[\]]/', '', json_encode($new_array_jenis_2));

            $data['change_jenis_with_apbd_rkpd'] = $change_jenis_with_apbd_rkpd;
            $data['change_jenis_without_apbd_rkpd'] = $change_jenis_without_apbd_rkpd;


            $data_doc_with_apbd_rkpd = $this->db->query(
                "SELECT UDP.*
                FROM
                (
                    SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi
                    FROM peppd_ppd2022.t_doc_prov doc_prov
                    JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2022.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi
                    FROM peppd_ppd2023.t_doc_prov doc_prov
                    JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2023.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi
                    FROM peppd_ppd2024.t_doc_prov doc_prov
                    JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2024.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten
                    FROM peppd_ppd2022.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2022.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    UNION
                    SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten
                    FROM peppd_ppd2023.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2023.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    UNION
                    SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten
                    FROM peppd_ppd2024.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2024.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    ORDER BY cr_dt DESC
                ) AS UDP
                WHERE UDP.nama IN (" . $change_jenis_with_apbd_rkpd . ")
                GROUP BY UDP.judul DESC
                ORDER BY UDP.judul ASC"
            )->result();

            $data_doc_without_apbd_rkpd = $this->db->query(
                "SELECT UDP.*
                FROM
                (
                    SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi
                    FROM peppd_ppd2022.t_doc_prov doc_prov
                    JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2022.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi
                    FROM peppd_ppd2023.t_doc_prov doc_prov
                    JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2023.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi
                    FROM peppd_ppd2024.t_doc_prov doc_prov
                    JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2024.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten
                    FROM peppd_ppd2022.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2022.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    UNION
                    SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten
                    FROM peppd_ppd2023.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2023.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    UNION
                    SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten
                    FROM peppd_ppd2024.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2024.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    ORDER BY cr_dt DESC
                ) AS UDP
                WHERE UDP.nama IN (" . $change_jenis_without_apbd_rkpd . ")
                ORDER BY UDP.judul ASC"
            )->result();

            $id = 1;
            $new_array_doc = array();
            foreach ($data_doc_with_apbd_rkpd as $ddoc) {
                $data = [
                    'id' => $id,
                    'Nama Dokumen' => str_replace("_", " ", $ddoc->judul),
                    'DokName' => $ddoc->judul,
                    'Jenis' => str_replace("_", " ", $ddoc->nama),
                    'Tahun' => str_replace("_", " ", $ddoc->cr_dt),
                    'Diupload Oleh' => str_replace("_", " ", $ddoc->nama_provinsi),
                    'Alias' => '-',
                    'File' => str_replace("_", " ", $ddoc->tautan),
                    'Deskripsi' => '-',
                    'link' => $ddoc->link,
                    'Aksi' => '<a class="btn btn-xs btn-info btn-bordered waves-effect waves-light m-b-5" target="_blank" href="' . $ddoc->link . '">Unduh Langsung</a> <a class="btn btn-xs btn-inverse btn-bordered waves-effect waves-light m-b-5 addFile" id="download-' . $id . '" onclick="addToFolder(' . $id . ')">Tambah Ke Folder</a>',
                ];
                array_push($new_array_doc, $data);
                $id++;
            }

            foreach ($data_doc_without_apbd_rkpd as $dwdoc) {
                $data = [
                    'id' => $id,
                    'Nama Dokumen' => str_replace("_", " ", $dwdoc->judul),
                    'DokName' => $dwdoc->judul,
                    'Jenis' => str_replace("_", " ", $dwdoc->nama),
                    'Tahun' => str_replace("_", " ", $dwdoc->cr_dt),
                    'Diupload Oleh' => str_replace("_", " ", $dwdoc->nama_provinsi),
                    'Alias' => '-',
                    'File' => str_replace("_", " ", $dwdoc->tautan),
                    'Deskripsi' => '-',
                    'link' => $dwdoc->link,
                    'Aksi' => '<a class="btn btn-xs btn-info btn-bordered waves-effect waves-light m-b-5" target="_blank" href="' . $dwdoc->link . '">Unduh Langsung</a> <a class="btn btn-xs btn-inverse btn-bordered waves-effect waves-light m-b-5 addFile" id="download-' . $id . '" onclick="addToFolder(' . $id . ')">Tambah Ke Folder</a>',
                ];
                array_push($new_array_doc, $data);
                $id++;
            }

            echo json_encode($new_array_doc);
        } else {
            redirect(base_url(''));
        }
    }

    public function count_doc_by_jenis()
    {
        if ($this->session->userdata("id") != null) {
            $jenis_with_apbd_rkpd = $this->db->query("SELECT URD.nama FROM (SELECT * FROM peppd_ppd2022.tbl_jenis_doc WHERE nama LIKE 'APBD%' OR nama LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2023.tbl_jenis_doc WHERE nama LIKE 'APBD%' OR nama LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2024.tbl_jenis_doc WHERE nama LIKE 'APBD%' OR nama LIKE 'RKPD%') AS URD GROUP BY URD.nama ORDER BY `URD`.`nama`  DESC")->result();
            $jenis_without_apbd_rkpd = $this->db->query("SELECT URD.nama FROM (SELECT * FROM peppd_ppd2022.tbl_jenis_doc WHERE nama NOT LIKE 'APBD%' AND nama NOT LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2023.tbl_jenis_doc WHERE nama NOT LIKE 'APBD%' AND nama NOT LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2024.tbl_jenis_doc WHERE nama NOT LIKE 'APBD%' AND nama NOT LIKE 'RKPD%') AS URD ORDER BY URD.nama ASC")->result();

            $count_of_jenis = count($jenis_with_apbd_rkpd);
            $new_array_jenis = array();
            $rep1 = 0;
            while ($rep1 < $count_of_jenis) {
                $rep2 = 0;
                while ($rep2 < $count_of_jenis) {
                    if ($jenis_with_apbd_rkpd[$rep1]->nama . "_(Murni)" != $jenis_with_apbd_rkpd[$rep2]->nama) {
                        $rep2++;
                    } else {
                        $rep2 = $count_of_jenis;
                        $rep1++;
                    }
                }
                array_push($new_array_jenis, $jenis_with_apbd_rkpd[$rep1]->nama);
                $rep1++;
            }
            $data['jenis_with_apbd_rkpd'] = $new_array_jenis;

            $count_of_jenis_2 = count($jenis_without_apbd_rkpd);
            $new_array_jenis_2 = array();
            array_push($new_array_jenis_2, $jenis_without_apbd_rkpd[0]->nama);
            $rep3 = 0;
            while ($rep3 < $count_of_jenis_2) {
                $rep4 = 0;
                $sum_of_rep = 0;
                while ($rep4 < count($new_array_jenis_2)) {
                    if ($jenis_without_apbd_rkpd[$rep3]->nama == $new_array_jenis_2[$rep4]) {
                        $sum_of_rep += 1;
                    }
                    $rep4++;
                }
                if ($sum_of_rep == 0) {
                    array_push($new_array_jenis_2, $jenis_without_apbd_rkpd[$rep3]->nama);
                }
                $rep3++;
            }
            $data['jenis_without_apbd_rkpd'] = $new_array_jenis_2;

            $change_jenis_with_apbd_rkpd = preg_replace('/[\[\]]/', '', json_encode($new_array_jenis));
            $change_jenis_without_apbd_rkpd = preg_replace('/[\[\]]/', '', json_encode($new_array_jenis_2));

            $data['change_jenis_with_apbd_rkpd'] = $change_jenis_with_apbd_rkpd;
            $data['change_jenis_without_apbd_rkpd'] = $change_jenis_without_apbd_rkpd;

            $dokumen = array("RKPD", "APBD");

            $data_sum_apbd_rkpd = array();

            foreach ($dokumen as $doc) {
                $data_doc_with_apbd_rkpd = $this->db->query(
                    "SELECT UDP2.nama, SUM(UDP2.jumlah_dokumen_by_jenis) AS jumlah_dokumen_by_jenis
                    FROM (
                        SELECT UDP.*, COUNT(nama) AS jumlah_dokumen_by_jenis
                        FROM
                        (
                            SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                            FROM peppd_ppd2022.t_doc_prov doc_prov
                            JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                            JOIN peppd_ppd2022.provinsi prov ON doc_prov.provid = prov.id
                            UNION
                            SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                            FROM peppd_ppd2023.t_doc_prov doc_prov
                            JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                            JOIN peppd_ppd2023.provinsi prov ON doc_prov.provid = prov.id
                            UNION
                            SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                            FROM peppd_ppd2024.t_doc_prov doc_prov
                            JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                            JOIN peppd_ppd2024.provinsi prov ON doc_prov.provid = prov.id
                            UNION
                            SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                            FROM peppd_ppd2022.t_doc_kab doc_kabkot
                            JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                            JOIN peppd_ppd2022.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                            JOIN peppd_ppd2022.provinsi prov ON kabkot.prov_id = prov.id_kode
                            UNION
                            SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                            FROM peppd_ppd2023.t_doc_kab doc_kabkot
                            JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                            JOIN peppd_ppd2023.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                            JOIN peppd_ppd2023.provinsi prov ON kabkot.prov_id = prov.id_kode
                            UNION
                            SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                            FROM peppd_ppd2024.t_doc_kab doc_kabkot
                            JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                            JOIN peppd_ppd2024.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                            JOIN peppd_ppd2024.provinsi prov ON kabkot.prov_id = prov.id_kode
                            ORDER BY cr_dt DESC
                        ) AS UDP
                        WHERE UDP.nama IN (" . $change_jenis_with_apbd_rkpd . ")
                        GROUP BY UDP.nama  
                    ORDER BY `UDP`.`nama` ASC) AS UDP2
                    WHERE UDP2.nama LIKE '" . $doc . "%'"
                )->result();

                $data = [
                    'name' => $doc,
                    'y' => (int)$data_doc_with_apbd_rkpd[0]->jumlah_dokumen_by_jenis,
                ];
                array_push($data_sum_apbd_rkpd, $data);
            }

            $data_doc_without_apbd_rkpd = $this->db->query(
                "SELECT UDP.nama AS name, COUNT(nama) AS y
                FROM
                (
                    SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                    FROM peppd_ppd2022.t_doc_prov doc_prov
                    JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2022.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                    FROM peppd_ppd2023.t_doc_prov doc_prov
                    JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2023.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                    FROM peppd_ppd2024.t_doc_prov doc_prov
                    JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_prov.jenisid = j.id
                    JOIN peppd_ppd2024.provinsi prov ON doc_prov.provid = prov.id
                    UNION
                    SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                    FROM peppd_ppd2022.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2022.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    JOIN peppd_ppd2022.provinsi prov ON kabkot.prov_id = prov.id_kode
                    UNION
                    SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                    FROM peppd_ppd2023.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2023.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    JOIN peppd_ppd2023.provinsi prov ON kabkot.prov_id = prov.id_kode
                    UNION
                    SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
                    FROM peppd_ppd2024.t_doc_kab doc_kabkot
                    JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
                    JOIN peppd_ppd2024.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
                    JOIN peppd_ppd2024.provinsi prov ON kabkot.prov_id = prov.id_kode
                    ORDER BY cr_dt DESC
                ) AS UDP
                WHERE UDP.nama IN (" . $change_jenis_without_apbd_rkpd . ")
                GROUP BY UDP.nama
                ORDER BY UDP.judul ASC"
            )->result();

            foreach ($data_doc_without_apbd_rkpd as $doc_without_apbd_rkpd) {
                $data2 = [
                    'name' => $doc_without_apbd_rkpd->name,
                    'y' => (int)$doc_without_apbd_rkpd->y,
                ];
                array_push($data_sum_apbd_rkpd, $data2);
            }
            echo json_encode($data_sum_apbd_rkpd);
        } else {
            redirect(base_url(''));
        }
    }

    // public function count_doc_by_wilayah()
    // {
    //     if ($this->session->userdata("id") != null) {
    //         $jenis_with_apbd_rkpd = $this->db->query("SELECT URD.nama FROM (SELECT * FROM peppd_ppd2022.tbl_jenis_doc WHERE nama LIKE 'APBD%' OR nama LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2023.tbl_jenis_doc WHERE nama LIKE 'APBD%' OR nama LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2024.tbl_jenis_doc WHERE nama LIKE 'APBD%' OR nama LIKE 'RKPD%') AS URD GROUP BY URD.nama ORDER BY `URD`.`nama`  DESC")->result();
    //         $jenis_without_apbd_rkpd = $this->db->query("SELECT URD.nama FROM (SELECT * FROM peppd_ppd2022.tbl_jenis_doc WHERE nama NOT LIKE 'APBD%' AND nama NOT LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2023.tbl_jenis_doc WHERE nama NOT LIKE 'APBD%' AND nama NOT LIKE 'RKPD%' UNION SELECT * FROM peppd_ppd2024.tbl_jenis_doc WHERE nama NOT LIKE 'APBD%' AND nama NOT LIKE 'RKPD%') AS URD ORDER BY URD.nama ASC")->result();

    //         $count_of_jenis = count($jenis_with_apbd_rkpd);
    //         $new_array_jenis = array();
    //         $rep1 = 0;
    //         while ($rep1 < $count_of_jenis) {
    //             $rep2 = 0;
    //             while ($rep2 < $count_of_jenis) {
    //                 if ($jenis_with_apbd_rkpd[$rep1]->nama . "_(Murni)" != $jenis_with_apbd_rkpd[$rep2]->nama) {
    //                     $rep2++;
    //                 } else {
    //                     $rep2 = $count_of_jenis;
    //                     $rep1++;
    //                 }
    //             }
    //             array_push($new_array_jenis, $jenis_with_apbd_rkpd[$rep1]->nama);
    //             $rep1++;
    //         }
    //         $data['jenis_with_apbd_rkpd'] = $new_array_jenis;

    //         $new_array_jenis_2 = array();
    //         foreach ($jenis_without_apbd_rkpd as $without) {
    //             array_push($new_array_jenis_2, $without->nama);
    //         }
    //         $data['jenis_without_apbd_rkpd'] = $new_array_jenis_2;

    //         $change_jenis_with_apbd_rkpd = preg_replace('/[\[\]]/', '', json_encode($new_array_jenis));
    //         $change_jenis_without_apbd_rkpd = preg_replace('/[\[\]]/', '', json_encode($new_array_jenis_2));

    //         $data['change_jenis_with_apbd_rkpd'] = $change_jenis_with_apbd_rkpd;
    //         $data['change_jenis_without_apbd_rkpd'] = $change_jenis_without_apbd_rkpd;

    //         $wilayah = $this->db->query("SELECT kab.id_kab AS id_wilayah, nama_kabupaten AS nama_wilayah FROM peppd_ppd2024.kabupaten kab UNION SELECT prov.id_kode AS id_wilayah, nama_provinsi AS nama_wilayah FROM peppd_ppd2024.provinsi prov ORDER BY id_wilayah");

    //         foreach ($wilayah as $wil) {
    //             $data_doc_with_apbd_rkpd = $this->db->query(
    //                 "SELECT UDP.*, COUNT(nama_wilayah) AS jumlah_dokumen
    //                 FROM
    //                 (
    //                     SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2022.t_doc_prov doc_prov
    //                     JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_prov.jenisid = j.id
    //                     JOIN peppd_ppd2022.provinsi prov ON doc_prov.provid = prov.id
    //                     UNION
    //                     SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2023.t_doc_prov doc_prov
    //                     JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_prov.jenisid = j.id
    //                     JOIN peppd_ppd2023.provinsi prov ON doc_prov.provid = prov.id
    //                     UNION
    //                     SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2024.t_doc_prov doc_prov
    //                     JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_prov.jenisid = j.id
    //                     JOIN peppd_ppd2024.provinsi prov ON doc_prov.provid = prov.id
    //                     UNION
    //                     SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2022.t_doc_kab doc_kabkot
    //                     JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
    //                     JOIN peppd_ppd2022.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
    //                     JOIN peppd_ppd2022.provinsi prov ON kabkot.prov_id = prov.id_kode
    //                     UNION
    //                     SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2023.t_doc_kab doc_kabkot
    //                     JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
    //                     JOIN peppd_ppd2023.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
    //                     JOIN peppd_ppd2023.provinsi prov ON kabkot.prov_id = prov.id_kode
    //                     UNION
    //                     SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2024.t_doc_kab doc_kabkot
    //                     JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
    //                     JOIN peppd_ppd2024.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
    //                     JOIN peppd_ppd2024.provinsi prov ON kabkot.prov_id = prov.id_kode
    //                     ORDER BY cr_dt DESC
    //                 ) AS UDP
    //                 WHERE UDP.nama IN (" . $change_jenis_with_apbd_rkpd . ") AND nama_wilayah = 'Kota Bandung'
    //                 GROUP BY UDP.judul, nama_wilayah DESC
    //                 ORDER BY UDP.judul ASC"
    //             )->result();

    //             $data_doc_without_apbd_rkpd = $this->db->query(
    //                 "SELECT UDP.*, COUNT(nama_wilayah) AS jumlah_dokumen
    //                 FROM
    //                 (
    //                     SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2022.t_doc_prov doc_prov
    //                     JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_prov.jenisid = j.id
    //                     JOIN peppd_ppd2022.provinsi prov ON doc_prov.provid = prov.id
    //                     UNION
    //                     SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2023.t_doc_prov doc_prov
    //                     JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_prov.jenisid = j.id
    //                     JOIN peppd_ppd2023.provinsi prov ON doc_prov.provid = prov.id
    //                     UNION
    //                     SELECT doc_prov.provid, doc_prov.jenisid, doc_prov.judul, doc_prov.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/provinsi/', doc_prov.tautan) AS link, doc_prov.isactive, doc_prov.cr_dt, doc_prov.cr_by, doc_prov.up_dt, doc_prov.up_by, j.nama, prov.nama_provinsi AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2024.t_doc_prov doc_prov
    //                     JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_prov.jenisid = j.id
    //                     JOIN peppd_ppd2024.provinsi prov ON doc_prov.provid = prov.id
    //                     UNION
    //                     SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2022/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2022.t_doc_kab doc_kabkot
    //                     JOIN peppd_ppd2022.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
    //                     JOIN peppd_ppd2022.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
    //                     JOIN peppd_ppd2022.provinsi prov ON kabkot.prov_id = prov.id_kode
    //                     UNION
    //                     SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2023/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2023.t_doc_kab doc_kabkot
    //                     JOIN peppd_ppd2023.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
    //                     JOIN peppd_ppd2023.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
    //                     JOIN peppd_ppd2023.provinsi prov ON kabkot.prov_id = prov.id_kode
    //                     UNION
    //                     SELECT doc_kabkot.kabid, doc_kabkot.jenisid, doc_kabkot.judul, doc_kabkot.tautan, CONCAT('https://peppd.bappenas.go.id/ppd2024/attachments/kabkota/', doc_kabkot.tautan) AS link, doc_kabkot.isactive, doc_kabkot.cr_dt, doc_kabkot.cr_by, doc_kabkot.up_dt, doc_kabkot.up_by, j.nama, kabkot.nama_kabupaten AS nama_wilayah, prov.nama_provinsi AS nama_provinsi
    //                     FROM peppd_ppd2024.t_doc_kab doc_kabkot
    //                     JOIN peppd_ppd2024.tbl_jenis_doc j ON doc_kabkot.jenisid = j.id
    //                     JOIN peppd_ppd2024.kabupaten kabkot ON doc_kabkot.kabid = kabkot.id
    //                     JOIN peppd_ppd2024.provinsi prov ON kabkot.prov_id = prov.id_kode
    //                     ORDER BY cr_dt DESC
    //                 ) AS UDP
    //                 WHERE UDP.nama IN (" . $change_jenis_without_apbd_rkpd . ") AND nama_wilayah = 'Kota Bandung'
    //                 ORDER BY UDP.judul ASC"
    //             )->result();
    //         }


    //         // Initialize an associative array to aggregate data
    //         $aggregated_data = array();

    //         // Function to add data to the aggregated array
    //         function add_to_aggregated_data($data, &$aggregated_data)
    //         {
    //             $key = $data['nama_wilayah'];
    //             if (!isset($aggregated_data[$key])) {
    //                 // Initialize if not set
    //                 $aggregated_data[$key] = [
    //                     'nama_wilayah' => str_replace("_", " ", $data['nama_wilayah']),
    //                     'nama_provinsi' => str_replace("_", " ", $data['nama_provinsi']),
    //                     'jumlah_dokumen' => 0
    //                 ];
    //             }
    //             // Sum up jumlah_dokumen
    //             $aggregated_data[$key]['jumlah_dokumen'] += intval($data['jumlah_dokumen']);
    //         }

    //         $data = [
    //             'nama_wilayah' => $data_doc_with_apbd_rkpd[0]->nama_wilayah,
    //             'nama_provinsi' => $data_doc_with_apbd_rkpd[0]->nama_provinsi,
    //             'jumlah_dokumen' => count($data_doc_with_apbd_rkpd),
    //         ];
    //         add_to_aggregated_data($data, $aggregated_data);

    //         // Process without_apbd_rkpd data
    //         foreach ($data_doc_without_apbd_rkpd as $dwdoc) {
    //             $data = [
    //                 'nama_wilayah' => $dwdoc->nama_wilayah,
    //                 'nama_provinsi' => $dwdoc->nama_provinsi,
    //                 'jumlah_dokumen' => $dwdoc->jumlah_dokumen
    //             ];
    //             add_to_aggregated_data($data, $aggregated_data);
    //         }

    //         // Convert aggregated data to a numeric array
    //         $new_array_doc = array_values($aggregated_data);

    //         // Sort the array by 'nama_wilayah' (or by 'jumlah_dokumen' if needed)
    //         usort($new_array_doc, function ($a, $b) {
    //             return strcmp($a['nama_wilayah'], $b['nama_wilayah']);
    //         });

    //         // Output the final result
    //         // For example, you can print or return $new_array_doc
    //         echo json_encode($new_array_doc);
    //     } else {
    //         redirect(base_url(''));
    //     }
    // }

    public function zipDok()
    {
        // Retrieve the JSON data
        $dokumenArrayJson = $this->input->post('dokumenArray');
        $dokumenArray = json_decode($dokumenArrayJson, true);

        // Process the array to generate and send the ZIP file
        $this->load->library('zip');

        foreach ($dokumenArray as $dokumen) {
            $file_url = $dokumen['link'];
            $file_content = file_get_contents($file_url);

            if ($file_content !== FALSE) {
                $filename = basename($file_url);
                $fileInfo = pathinfo($filename);
                $fileExtension = $fileInfo['extension'];
                $newName = $dokumen['dokName'] . '.' . $fileExtension;
                $this->zip->add_data($newName, $file_content);
            }
        }

        // Download the ZIP file
        $this->zip->download('repo_dokumen.zip');
    }
}
