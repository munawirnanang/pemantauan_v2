<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_apbd extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
        if (!$this->session->userdata('userid')) {
            redirect('');
        }
    }
    public function index()
    {

        $data['js']= 'assets/assets/js/js/apbd.js';
        $data['wilayah'] = $this->db->query('SELECT * FROM wilayah WHERE id NOT IN (1000, 9999)')->result_array();
        $data['tahun'] = $this->db->query('SELECT DISTINCT(tahun) FROM `nilaianggaran_apbd` ORDER BY tahun DESC')->result_array();
        $list_standar_utama = $this->db->query("SELECT * FROM standarutama_apbd")->result_array();

        $list_apbd = array();

        foreach ($list_standar_utama as $utama) {
            $list_apbd[] = ['kode' => $utama['kode'], 'nama' => $utama['nama']];

            $list_standar_kelompok = $this->db->query("SELECT * FROM standarkelompok_apbd WHERE standarutama_APBD_id = ?", $utama['kode'])->result_array();
            
            foreach ($list_standar_kelompok as $kelompok) {
                $list_apbd[] = ['kode' => $kelompok['kode'], 'nama' => $kelompok['nama']];

                $list_standar_jenis = $this->db->query("SELECT * FROM standarjenis_apbd WHERE standarkelompok_APBD_id = ?", $kelompok['kode'])->result_array();

                foreach ($list_standar_jenis as $jenis) {
                    $list_apbd[] = ['kode' => $jenis['kode'], 'nama' => $jenis['nama']];
                }
            }
        }
        $data['list_apbd'] = $list_apbd;

        

        $data['judul'] = 'APBD';
        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar_V2');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_apbd');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }

    public function overview()
    {
        // $item_apbd=['4','41','4101','4102','4103','4104','42','4201','4202','43','4301','4302','4303']; //PAD
        // $item_apbd=['5','51','5101','5102','5103','5104','5105','5106','52','5201','5202','5203','5204','5205','5206','53','5301','54','5401','5402']; //Belanja Daerah
        // $item_apbd=['6','61','6101','6102','6103','6104','6105','6106','62','6201','6202','6203','6104','6205'];//pembiayan daerah
        $item_apbd=['4','41','4101','4102','4103','4104','42','4201','4202','43','4301','4302','4303','5','51','5101','5102','5103','5104','5105','5106','52','5201','5202','5203','5204','5205','5206','53','5301','54','5401','5402','6','61','6101','6102','6103','6104','6105','6106','62','6201','6202','6203','6104','6205'];
        $max_wil = implode(",",['3100','3201','3578']);
        // $max_wil = implode(",",['3100']);
        $tahun = '2023';
        $result=[];

        foreach($item_apbd as $item){
            $kode_item_data = $this->db->query("
                SELECT * FROM (
                    SELECT su.nama AS nama, su.kode AS kode FROM `standarutama_apbd` su 
                    UNION 
                    SELECT sk.nama AS nama, sk.kode AS kode FROM standarkelompok_apbd sk 
                    UNION 
                    SELECT sj.nama AS nama, sj.kode AS kode FROM standarjenis_apbd sj
                ) a 
                WHERE a.kode = '$item'")->row_array();

            $list_data = $this->db->query("
                SELECT na.wilayah, wil.nama_wilayah, na.tahun, SUM(na.nilai) AS jumlah 
                FROM nilaianggaran_apbd na
                JOIN standarjenis_apbd sj ON na.standarjenis_APBD_id = sj.kode 
                JOIN standarkelompok_apbd sk ON sj.standarkelompok_APBD_id = sk.kode 
                JOIN standarutama_apbd su ON sk.standarutama_APBD_id = su.kode
                JOIN wilayah wil ON na.wilayah = wil.id
                WHERE na.standarjenis_APBD_id LIKE '$item%'
                AND na.wilayah IN ($max_wil)
                AND na.tahun IN ($tahun)
                AND na.versi = (
                    SELECT MAX(na_sub.versi)
                    FROM nilaianggaran_apbd na_sub
                    WHERE na_sub.standarjenis_APBD_id = na.standarjenis_APBD_id
                    AND na_sub.wilayah = na.wilayah
                    AND na_sub.tahun = na.tahun
                )
                GROUP BY na.wilayah, wil.nama_wilayah, na.tahun
                ORDER BY na.standarjenis_APBD_id ASC")->result_array();

            foreach ($list_data as &$data) {
                $data['kode_item'] = $kode_item_data['kode'];
                $data['nama_item'] = $kode_item_data['nama'];
            }

            $result = array_merge($result, $list_data);
        }

        $json = [
            'data' => $result,
        ];
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
        
    }

    public function show_data_apbd()
    {
        $wilayah = $this->input->post('wilayah');
        $item = $this->input->post('item');
        $tahun = $this->input->post('tahun');
        $query_wilayah = (implode(",",$wilayah));
        $query_item = (implode(",",$item));
        $query_tahun = (implode(",",$tahun));

        $resultarray=[];

        for ($o = 0; $o < count($item); $o++) {
            $kode_item_data = $this->db->query("
                SELECT * FROM (
                    SELECT su.nama AS nama, su.kode AS kode FROM `standarutama_apbd` su 
                    UNION 
                    SELECT sk.nama AS nama, sk.kode AS kode FROM standarkelompok_apbd sk 
                    UNION 
                    SELECT sj.nama AS nama, sj.kode AS kode FROM standarjenis_apbd sj
                ) a 
                WHERE a.kode = '$item[$o]'")->row_array();

            $list_data = $this->db->query("
                SELECT na.wilayah, wil.nama_wilayah, na.tahun, SUM(na.nilai) AS jumlah 
                FROM nilaianggaran_apbd na
                JOIN standarjenis_apbd sj ON na.standarjenis_APBD_id = sj.kode 
                JOIN standarkelompok_apbd sk ON sj.standarkelompok_APBD_id = sk.kode 
                JOIN standarutama_apbd su ON sk.standarutama_APBD_id = su.kode
                JOIN wilayah wil ON na.wilayah = wil.id
                WHERE na.standarjenis_APBD_id LIKE '$item[$o]%'
                AND na.wilayah IN ($query_wilayah)
                AND na.tahun IN ($query_tahun)
                AND na.versi = (
                    SELECT MAX(na_sub.versi)
                    FROM nilaianggaran_apbd na_sub
                    WHERE na_sub.standarjenis_APBD_id = na.standarjenis_APBD_id
                    AND na_sub.wilayah = na.wilayah
                    AND na_sub.tahun = na.tahun
                )
                GROUP BY na.wilayah, wil.nama_wilayah, na.tahun
                ORDER BY na.standarjenis_APBD_id ASC")->result_array();

            foreach ($list_data as &$data) {
                $data['kode_item'] = $kode_item_data['kode'];
                $data['nama_item'] = $kode_item_data['nama'];
            }

            $resultarray = array_merge($resultarray, $list_data);
        }

        //tabel
        $wil = [];
        $years = [];
        $items = [];
        foreach ($resultarray as $row) {
            $wil[$row['wilayah']] = $row['nama_wilayah'];
            $years[$row['tahun']] = $row['tahun'];
            $items[$row['kode_item']] = $row['nama_item'];
        }

        $tabel_html ='';
        $tabel_html .= '<div class="card-box table-responsive m-t-15">';
        $tabel_html .= '<table id="tabel_indikator" class="table table-bordered table-striped"><thead>';
        $tabel_html .= '<thead>';
        $tabel_html .= '<tr>';
        $tabel_html .= '<th rowspan="3"><center>Kode</center></th>';
        $tabel_html .= '<th rowspan="3"><center>Nama</center></th>';
            foreach($wil as $kode=>$nama)
            {
                $tabel_html .= '<th colspan="'.count($tahun).'"><center>'.$kode.'</center></th>';
            }
        $tabel_html .= '</tr>';
        $tabel_html .= '<tr>';
            foreach($wil as $nama)
            {
                $tabel_html .= '<th colspan="'.count($tahun).'"><center>'.$nama.'</center></th>';
            }
        $tabel_html .= '</tr>';
        $tabel_html .= '<tr>';
            foreach ($wil as $name) {
                foreach ($years as $year) {
                    $tabel_html .= '<th><center>' . $year . '</center></th>';
                }
            }
        $tabel_html .= '</tr>';
        $tabel_html .= '</thead>';
        $tabel_html .= '<body>';
        foreach($items as $kode_item => $nama_item)
        {
            $tabel_html .= '<tr>';
            $tabel_html .= '<td>'.$kode_item.'</td><td>'.$nama_item.'</td>';
            foreach($wil as $kode_wil=>$nama)
            {
                foreach($tahun as $t)
                {
                    $jumlah = '-';
                    foreach($resultarray as $row)
                    {
                        if($row['kode_item']==$kode_item && $row['wilayah'] == $kode_wil && $row['tahun']==$t )
                        {
                            $jumlah = number_format($row['jumlah'], 0, ',', '.');
                            break;
                        }
                    }
                    $tabel_html .= '<td><p align="right">'.$jumlah.'</p></td>';
                }
            }
            $tabel_html .= '<tr>';
        }
        $tabel_html .= '</body>';
        $tabel_html .= '</table>';


        //sunburst
        $sunburst_html = '';
        
        $json = [
            'data' => $resultarray,
            'tabel_html'=>$tabel_html
        ];
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}
