<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_sdgs extends CI_Controller
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
        $data['judul'] = 'SDGs';
        $data['js']= 'assets/assets/js/js/sdgs.js';
        
   
        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_sdgs');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }

    public function get_goal()
    {
        $goal = $this->input->post('goal');
        $url1 = 'https://webapi.bps.go.id/v1/api/list/model/sdgs/goal/'.$goal.'/domain/0000/key/954d935f47f5ee473f310c6410aa304e/';

        $this->curl->create($url1);
        $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
        $api1 = $this->curl->execute();
        $response = json_decode($api1, true);

        $item = $response['data'][0]['page'];
        $jumlah = $response['data'][0]['pages']+1;
        
        $data['tabel'] = [];
        $data_all = array();

        for($i=1;$i<$jumlah;$i++){
            $url = 'https://webapi.bps.go.id/v1/api/list/model/sdgs/goal/'.$goal.'/lang/ind/domain/0000/page/'.$i.'/key/954d935f47f5ee473f310c6410aa304e/';
            
            $this->curl->create($url);
            $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
            $api = $this->curl->execute();
            $response = json_decode($api, true);
            
            if (isset($response['data'][1])) { // Check if the data exists
                $data_raw = $response['data'][1];
                $data_all = array_merge($data_all, $data_raw); // Append the data to the new array
            }
        }

        $html_table = '';
        $html_table .= '<div class="card-box table-responsive">';
        $html_table .= '<table id="tabel_indikator" class="table table-bordered table-striped">';
        $html_table .= '<thead>';
        $html_table .= '<tr>';
        // $html_table .= '<th>No.</th>';
        $html_table .= '<th>Indikator SDGs</th>';
        $html_table .= '<th>Judul</th>';
        $html_table .= '</tr>';
        $html_table .= '</thead>';
        $html_table .= '<body>';
        $id = 1;
        foreach($data_all as $da){
            $html_table .= '<tr>';
            // $html_table .= '<th>'.$id.'</th>'; 
            $html_table .= '<th>'.$da['sdgs_id'].'</th>'; 
            $html_table .= '<th><a href="#" data-id="'.$da['var_id'].'"  class="detail-link"  data-toggle="tab" data-target="#cari-b1">'.$da['title'].'</a></th>'; 
            $id++;
            $html_table .= '</tr>';
        }
        $html_table .= '</body>';
        

        $html_table .= '</table>';
        $html_table .= '</div>';
        
    
        $this->output->set_content_type('application/json')->set_output(json_encode($html_table));
    }

    public function detail_sdgs()
    {
        try{

            $id = $this->input->post('id');
            $uri = '0000';
            
            if($uri=='9999'){
                $uri='0000';
            }

            $keyapi = '954d935f47f5ee473f310c6410aa304e';
            $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/'.$uri.'/var/'.$id.'/key/'.$keyapi;
            // $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/534/turvar/1550/key/954d935f47f5ee473f310c6410aa304e';
            $this->curl->create($url);
            $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
            $api = $this->curl->execute();
    
            $response = json_decode($api, true);
            $html_card = '';
            $html_table = '';

            if($response['data-availability']=="list-not-available"){
                $html_table .= '<div class="card-box table-responsive">';
                $html_table .= '<table id="datatable-buttons" class="table table-striped table-bordered">';
                $html_table .= '<thead>';
                $html_table .= '<tr>';
                $html_table .= '<td>Data Tidak tersedia</td>';
                $html_table .= '</tr">';
                $html_table .= '</thead>';
                $html_table .= '<tbody>';
                $html_table .= '<tr>';
                $html_table .= '<td>Data Tidak tersedia</td>';
                $html_table .= '</tr">';
                $html_table .= '</tbody>';
                $html_table .= '</table>';
                $html_table .= '</div>';
            }else{
                $idvariabel = $response['var'][0]['val'];
                $baris = count($response['vervar']);
                $karakter = count($response['turvar']);
                $tahun = count($response['tahun']);
                $bulan = count($response['turtahun']);
                $title = $response['var'][0]['label'];

                $html_table .= '<div class="card-box table-responsive">';
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
                    $html_table .= '<td>' . htmlspecialchars_decode($response['vervar'][$i]['label']) . '</td>';
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

                $response['var'][0]['note'] = isset($response['var'][0]['note']) ? trim(strip_tags(html_entity_decode($response['var'][0]['note']))) : '';

                $html_table .= $response['var'][0]['note'];
                $html_table .= '<br>';
                $html_table .= '<b>Sumber Data : Badan Pusat Statistik</b>';
                
                $html_table .= '</div>';

                $contain_indonesia = '';
                $html_title = '';
                if($karakter==1){
                    foreach ($response['vervar'] as $item) {
                        if ($item['val'] == 9999) {
                            $contain_indonesia = true;
                            break;
                        }
                    }
                    if($contain_indonesia){
                        if($tahun>1){
                            $html_title .= '<b>'.$title.'</b>';
                            for($i=0; $i<$tahun; $i++){
                                $indo = '9999'.$idvariabel.'0'.$response['tahun'][$i]['val'].'0';
                                $last_indo = ($i > 0) ? '9999' . $idvariabel . '0' . $response['tahun'][$i - 1]['val'] . '0' : null;
                                $set = isset($response['datacontent'][$indo]) ? $response['datacontent'][$indo] : "-";
                                $last_set = isset($response['datacontent'][$last_indo]) ? $response['datacontent'][$last_indo] : "-";
                                if (is_numeric($set) && is_numeric($last_set)) {
                                    if ($set > $last_set) {
                                        $arrow = '<i class="mdi mdi-arrow-up"></i>';
                                    } elseif($set === $last_set) {
                                        $arrow = '<i class="mdi mdi-minus"></i>'; 
                                    }else {
                                        $arrow = '<i class="mdi mdi-arrow-down"></i>';

                                    }
                                } else {
                                    if ($last_set === '-') {
                                        $arrow = '<i class="mdi mdi-minus"></i>'; 
                                    }
                                }
                                
                                $html_card .= '<div class="col-lg-2 col-md-4 col-sm-6">';
                                $html_card .= '<div class="card-box widget-box-one">';
                                $html_card .= '<div class="wigdet-one-content">';
                                $html_card .= '<p class="m-0 text-uppercase font-600 font-secondary text-overflow">'.$response['tahun'][$i]['label'].'</p>';
                                $html_card .= '<h2>'.$set.'<small>'.$arrow.'</small></h2>';
                                $html_card .= '</div>';
                                $html_card .= '</div>';
                                $html_card .= '</div>';
                            }
                        }
                    }
                }   
            }
            $data_encode = [
                'html_table' => $html_table,
                'html_title' => $html_title,
                'html_card' => $html_card,
            ];

            
            $this->output->set_content_type('application/json')->set_output(json_encode($data_encode));
            // $this->output->set_content_type('text/html')->set_output(json_encode($data_encode));
 
        } catch (Exception $e){
            log_message('error: ',$e->getMessage());
            return;
        }        
    }
}
