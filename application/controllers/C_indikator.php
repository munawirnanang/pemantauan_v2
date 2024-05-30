<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_indikator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('curl');
        if (!$this->session->userdata('userid')) {
            redirect('');
        }
    }
    public function index()
    {
        $data['js']= 'assets/assets/js/js/indikator.js';
        $data['judul'] = 'Indikator';
        $data['wilayah'] = $this->db->get('wilayah')->result_array();
        $data['indikator'] = $this->db->get('indikator')->result_array();
        $data['tahun'] = $this->db->query('SELECT DISTINCT T.tahun FROM nilai_indikator T ORDER BY tahun ASC')->result_array();
        // var_dump($data['wilayah']);
        
        
        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar_v2');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_table');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');

    }

    public function show_data()
    {
        
        $wilayah = $this->input->post('wilayah');
        $indikator = $this->input->post('indikator');
        $tahun = $this->input->post('tahun');
        if(!$wilayah || !$indikator || !$tahun){
            echo 'isi form';
            die;
        }

        if (!isset($_SESSION['cached_data'])) {
            $_SESSION['cached_data'] = array();
        }

        $resultArray = array();
        
        
        for ($i = 0; $i < count($indikator); $i++) {
            for ($w = 0; $w < count($wilayah); $w++) {
                for ($t = 0; $t < count($tahun); $t++) {
                    $cache_key = $indikator[$i] . '_' . $wilayah[$w] . '_' . $tahun[$t];

                    if (isset($_SESSION['cached_data'][$cache_key])) {
                        $dataindikator = $_SESSION['cached_data'][$cache_key];
                        // var_dump($_SESSION['cached_data'][$cache_key]);
                    } else {
                        $dataindikator = $this->db->query(
                            "SELECT NI.wilayah,NI.tahun,NI.periode,NI.id_indikator,NI.nilai,I.nama_indikator,W.nama_wilayah
                            FROM nilai_indikator NI 
                            JOIN indikator I ON NI.id_indikator=I.id
                            JOIN wilayah W ON NI.wilayah=W.id
                            WHERE NI.versi = (SELECT MAX(versi) FROM nilai_indikator)
                            AND NI.id_indikator=$indikator[$i]
                            AND NI.wilayah='$wilayah[$w]'
                            AND NI.tahun='$tahun[$t]'")->result_array();    

                        if (!$dataindikator) {
                            $nama_indikator = $this->db->query(
                                "SELECT nama_indikator FROM indikator WHERE id = $indikator[$i]")->row()->nama_indikator;
                            $nama_wilayah = $this->db->query(
                                "SELECT nama_wilayah FROM wilayah WHERE id = '$wilayah[$w]'")->row()->nama_wilayah;

                            $dataindikator[0] = [
                                'wilayah' => $wilayah[$w],
                                'tahun' => $tahun[$t],
                                'periode' => '00',
                                'id_indikator' => $indikator[$i],
                                'nilai' => null,
                                'nama_indikator' => $nama_indikator,
                                'nama_wilayah' => $nama_wilayah     
                            ];
                        }
                        $_SESSION['cached_data'][$cache_key] = $dataindikator;
                    }
                    foreach($dataindikator as $data){
                        $resultArray[] = $data;
                    }
                }
            }
        }
        $periodNames = [
            '00' => 'Tahunan',
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
        $tabel_html ='';
        $unique_indicators = array_unique(array_column($resultArray, 'nama_indikator'));
        $unique_years = array_unique(array_column($resultArray, 'tahun'));
        $unique_periods = array_unique(array_column($resultArray, 'periode'));
        
        sort($unique_years);
        sort($unique_periods);
        
        $tabel_html = '<table id="tabel_indikator" class="table table-bordered table-striped"><thead>';
        $tabel_html .= '<tr>';
        $tabel_html .= '<th rowspan="3">Provinsi/Kabupaten/Kota</th>';
        
        foreach ($unique_indicators as $indicator) {
            $colspan = 0;
            foreach ($unique_years as $year) {
                $count_periods = count(array_unique(array_filter(array_column(array_filter($resultArray, function ($item) use ($indicator, $year) {
                    return $item['nama_indikator'] == $indicator && $item['tahun'] == $year;
                }), 'periode'))));
                $colspan += $count_periods;
            }
            $tabel_html .= '<th colspan="'.$colspan.'">'.$indicator.'</th>';
        }
        
        $tabel_html .= '</tr><tr>';
        
        $indicator_period_count = [];
        
        foreach ($unique_indicators as $indicator) {
            $indicator_period_count[$indicator] = [];
            foreach ($unique_years as $year) {
                $periods = array_unique(array_filter(array_column(array_filter($resultArray, function ($item) use ($indicator, $year) {
                    return $item['nama_indikator'] == $indicator && $item['tahun'] == $year;
                }), 'periode')));
                $indicator_period_count[$indicator][$year] = $periods;
        
                if (count($periods) == 1) {
                    $tabel_html .= '<th rowspan="2">'.$year.'</th>';
                } else {
                    $tabel_html .= '<th colspan="'.count($periods).'">'.$year.'</th>';
                }
            }
        }
        
        $tabel_html .= '</tr>';
        
        $tabel_html .= '<tr>';
        foreach ($unique_indicators as $indicator) {
            foreach ($unique_years as $year) {
                $periods = $indicator_period_count[$indicator][$year];
                if (count($periods) > 1) {
                    foreach ($periods as $period) {
                        $tabel_html .= '<th>'.$periodNames[$period].'</th>';
                    }
                }
            }
        }
        $tabel_html .= '</tr>';
        
        $tabel_html .= '</thead><tbody>';
        
        $unique_wilayahs = array_unique(array_column($resultArray, 'nama_wilayah'));
        
        foreach ($unique_wilayahs as $wilayah) {
            $tabel_html .= '<tr>';
            $tabel_html .= '<td>'.$wilayah.'</td>';
        
            foreach ($unique_indicators as $indicator) {
                foreach ($unique_years as $year) {
                    $periods = $indicator_period_count[$indicator][$year];
                    foreach ($periods as $period) {
                        $value = '-';
                        foreach ($resultArray as $data) {
                            if ($data['nama_wilayah'] == $wilayah && $data['nama_indikator'] == $indicator && $data['tahun'] == $year && $data['periode'] == $period) {
                                $value = $data['nilai'] !== null ? $data['nilai'] : '-';
                                break;
                            }
                        }
                        $tabel_html .= '<td>'.$value.'</td>';
                    }
                }
            }
        
            $tabel_html .= '</tr>';
        }
        
        $tabel_html .= '</tbody></table>';
        

        $this->output->set_content_type('text/html')->set_output($tabel_html);
        // echo '<pre>';
        // var_dump($resultArray);
        // echo '<pre>';
        // echo json_encode($resultArray);

        
    }

    public function insert_indikator()
    {
        $url1 = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/0000/page/40/key/954d935f47f5ee473f310c6410aa304e/';

        $this->curl->create($url1);
        $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
        $api1 = $this->curl->execute();
        $response = json_decode($api1, true);

        $item = $response['data'][0]['page'];
        $jumlah = $response['data'][0]['pages']+1;

        echo '<pre>';
        var_dump($response['data'][1]);
        echo '</pre>';

    }
    public function update_data_makro()
    {
        $keyapi = '954d935f47f5ee473f310c6410aa304e';
        $list_indikator = $this->db->query('SELECT * FROM indikator i')->result_array();
        // $list_indikator = ['LPE'=>'291',
        //                   'IPM'=>'2205',
        //                   'TPT'=>'543',
        //                   'TK'=>'192',
        //                   'GINI'=>'98'];

        foreach($list_indikator as $key){
            if($key['id_api']=='98'){
                $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$key['id_api'].'/turvar/191/key/'.$keyapi;
            }else{
                $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$key['id_api'].'/key/'.$keyapi;
            }
            $id_indikator = $key['id'];

            $this->curl->create($url);
            $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
            $api = $this->curl->execute();

            $data['api'] = json_decode($api, true);
            $response = json_decode($api, true);

            // echo '<pre>';
            // var_dump($response);
            // echo '</pre>';
            
            $idvariabel = $response['var'][0]['val'];
            $satuan = strtolower($response['var'][0]['unit']);
            $keterangan = $response['var'][0]['note'];

            if($satuan=='persen'){
                $satuan='%';
            }


            $baris = count($response['vervar']);
            $karakter = count($response['turvar']);
            $tahun = count($response['tahun']);
            $periode = count($response['turtahun']);
            $array_push = [];

            for ($i = 0; $i < $baris; $i++) {
                for ($j = 0; $j < $karakter; $j++) {
                    for ($k = 0; $k < $tahun; $k++) {
                        for ($l = 0; $l < $periode; $l++) {

                            $id_data = $response['vervar'][$i]['val'] . $idvariabel . $response['turvar'][$j]['val'] . $response['tahun'][$k]['val'] . $response['turtahun'][$l]['val'];
                            $nasional = 9999 . $idvariabel . $response['turvar'][$j]['val'] . $response['tahun'][$k]['val'] . $response['turtahun'][$l]['val'];
                            
                            $lower_str = strtolower($response['turtahun'][$l]['label']);
                            $replace_str=['tahun'=>'00','januari'=>'01','februari'=>'02','maret'=>'03','april'=>'04','mei'=>'05','juni'=>'06','juli'=>'07','agustus'=>'08','september'=>'09','oktober'=>'10','november'=>'11','desember'=>'12'];

                            
                            
                            $idperiode = 'invalid';
                            foreach ($replace_str as $key => $value) {
                                if (strpos($lower_str, $key) !== false) {
                                    $idperiode = $value;
                                    break;
                                }
                            }                            
                        
                            $push = [
                                'wilayah' => $response['vervar'][$i]['val'],
                                'id_indikator' => $id_indikator,
                                'tahun' => $response['tahun'][$k]['label'],
                                'periode' => $idperiode,
                                'satuan' => $satuan,
                                'idperiode' => $response['tahun'][$k]['label'].$idperiode,
                                'versi' => date("Y-m-d"),
                                'keterangan' => $keterangan,
                                'nasional' => isset($response['datacontent'][$nasional]) ? $response['datacontent'][$nasional] : null,
                                'nilai' => isset($response['datacontent'][$id_data]) ? $response['datacontent'][$id_data] : null
                                
                            ];
                            $this->db->replace('nilai_indikator',$push);
                        }
                    }
                }
            }
        }
        echo 'sukses';
        die;
    }

    public function data_bps()
    {
        $data['js']= 'assets/assets/js/js/indikator.js';
        $data['judul'] = 'Indikator';
        
        $data['tabel'] = $this->db->get('data_bps')->result_array();

        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_data');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }

    public function update_data_bps()
    {
        $url1 = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/0000/page/1/key/954d935f47f5ee473f310c6410aa304e/';

        $this->curl->create($url1);
        $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
        $api1 = $this->curl->execute();
        $response = json_decode($api1, true);

        $item = $response['data'][0]['page'];
        $jumlah = $response['data'][0]['pages']+1;

        $data['tabel'] = [];
        
        for($i=1;$i<$jumlah;$i++){
            $url = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/0000/page/'.$i.'/key/954d935f47f5ee473f310c6410aa304e/';
            $this->curl->create($url);
            $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
            $api = $this->curl->execute();
            $response = json_decode($api, true);
            // $data['tabel'] = array_merge($data['tabel'], $response['data'][1]);
            $data_raw = $response['data'][1];
            foreach($data_raw as $data){
                $push = [
                    'id_api' => $data['var_id'],
                    'judul' => $data['title'],
                    'kategori' => $data['sub_name'],
                    'sub_kategori' => $data['subcsa_name']
                ];
                $this->db->replace('data_bps', $push);
            }
        }
    }
    
    public function detail_data()
    {
        try{

            $id = $this->input->post('id');
            
            $keyapi = '954d935f47f5ee473f310c6410aa304e';
            $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$id.'/key/'.$keyapi;
            // $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/534/turvar/1550/key/954d935f47f5ee473f310c6410aa304e';
            $this->curl->create($url);
            $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
            $api = $this->curl->execute();
    
            $response = json_decode($api, true);

            $idvariabel = $response['var'][0]['val'];
            $baris = count($response['vervar']);
            $karakter = count($response['turvar']);
            $tahun = count($response['tahun']);
            $bulan = count($response['turtahun']);
            $title = $response['var'][0]['label'];

            $html_table = '<div class="card-box table-responsive">';
            $html_table .= '<table id="datatable-buttons" class="table table-striped table-bordered">';
            $html_table .= '<thead>';
                if($bulan==1 && $karakter==1){
                    $html_table .= '<tr><th rowspan="3">' . $response['labelvervar'] . '</th></tr>';
                    $html_table .= '<tr><th colspan="'.$tahun.'">'.$response['var'][0]['label'].'</th></tr>';
                    $html_table .= '<tr>';
                    for ($i = 0; $i < $tahun; $i++) {
                        $html_table .= '<th>' . $response['tahun'][$i]['label'] . '</th>';
                    }
                    $html_table .= '</tr>';
                }elseif($bulan>1&&$karakter==1){
                    $html_table .= '<tr><th rowspan="4">' . $response['labelvervar'] . '</th></tr>';
                    $html_table .= '<tr><th colspan="' . ($tahun * $bulan) . '">' . $response['var'][0]['label'] . '</th></tr>';
                    $html_table .= '<tr>';
                    for ($i = 0; $i < $tahun; $i++) {
                        $html_table .= '<th colspan="' . $bulan . '">' . $response['tahun'][$i]['label'] . '</th>';
                    }
                    $html_table .= '</tr>';
                    $html_table .= '<tr>';
                    for ($i = 0; $i < $tahun; $i++) {
                        for ($j = 0; $j < $bulan; $j++) {
                            $html_table .= '<th>' . $response['turtahun'][$j]['label'] . '</th>';
                        }
                    }
                    $html_table .= '</tr>';
                }elseif($bulan==1&&$karakter>1){
                    $html_table .= '<tr><th rowspan="4">' . $response['labelvervar'] . '</th></tr>';
                    $html_table .= '<tr><th colspan="' . ($karakter * $tahun) . '">' . $response['var'][0]['label'] . '</th></tr>';
                    $html_table .= '<tr>';
                    for ($i = 0; $i < $karakter; $i++) {
                        $html_table .= '<th colspan="' . $tahun . '">' . $response['turvar'][$i]['label'] . '</th>';
                    }
                    $html_table .= '</tr>';
                    $html_table .= '<tr>';
                    for ($i = 0; $i < $karakter; $i++) {
                        for ($j = 0; $j < $tahun; $j++) {
                            $html_table .= '<th>' . $response['tahun'][$j]['label'] . '</th>';
                        }
                    }
                    $html_table .= '</tr>';
                }elseif($bulan>1&&$karakter>1){
                    $html_table .= '<tr><th rowspan="5">' . $response['labelvervar'] . '</th></tr>';
                    $html_table .= '<tr><th colspan="' . ($karakter * $tahun * $bulan) . '">' . $response['var'][0]['label'] . '</th></tr>';
                    $html_table .= '<tr>';
                    for ($i = 0; $i < $karakter; $i++) {
                        $html_table .= '<th colspan="' . ($bulan * $tahun) . '">' . $response['turvar'][$i]['label'] . '</th>';
                    }
                    $html_table .= '</tr>';
                    $html_table .= '<tr>';
                    for ($i = 0; $i < $karakter; $i++) {
                        for ($j = 0; $j < $tahun; $j++) {
                            $html_table .= '<th colspan="' . $bulan . '">' . $response['tahun'][$j]['label'] . '</th>';
                        }
                    }
                    $html_table .= '</tr>';
                    $html_table .= '<tr>';
                    for ($i = 0; $i < $karakter; $i++) {
                        for ($j = 0; $j < $tahun; $j++) {
                            for ($k = 0; $k < $bulan; $k++) {
                                $html_table .= '<th>' . $response['turtahun'][$k]['label'] . '</th>';
                            }
                        }
                    }
                    $html_table .= '</tr>';
                }
            $html_table .= '</thead>';
            $html_table .= '<tbody>';
            for ($i = 0; $i < $baris; $i++) {
                $html_table .= '<tr>';
                $html_table .= '<td>' . $response['vervar'][$i]['label'] . '</td>';
                for ($j = 0; $j < $karakter; $j++) {
                    for ($k = 0; $k < $tahun; $k++) {
                        for ($l = 0; $l < $bulan; $l++) {
                            $id_data = $response['vervar'][$i]['val'] .
                                $idvariabel .
                                $response['turvar'][$j]['val'] .
                                $response['tahun'][$k]['val'] .
                                $response['turtahun'][$l]['val'];
                            $data = isset($response['datacontent'][$id_data]) ? $response['datacontent'][$id_data] : "-";
                            $html_table .= '<td>' . $data . '</td>';
                        }
                    }
                }
                $html_table .= '</tr>';
            }
            $html_table .= '</tbody>';

            $html_table .= '</table>';

            $html_table .= '<b>Sumber Data : Badan Pusat Statistik</b>';

            $html_table .= '</div>';

            $this->output->set_content_type('text/html')->set_output($html_table);
 
        } catch (Exception $e){
            log_message('error: ',$e->getMessage());
            return;
        }        
    }
}
