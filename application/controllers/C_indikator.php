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
        $data['menu'] = 'Indikator';

        $keyapi = '954d935f47f5ee473f310c6410aa304e';
        // tpt = '543'
        $indikator = '543';
        $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/' . $indikator . '/key/' . $keyapi;

        $this->curl->create($url);
        $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
        $api = $this->curl->execute();

        $data['api'] = json_decode($api, true);
        $response = json_decode($api, true);

        $idvariabel = $response['var'][0]['val'];
        $baris = count($response['vervar']);
        $karakter = count($response['turvar']);
        $tahun = count($response['tahun']);
        $periode = count($response['turtahun']);

        // for ($i = 0; $i < $baris; $i++) {
        //     for ($j = 0; $j < $karakter; $j++) {
        //         for ($k = 0; $k < $tahun; $k++) {
        //             for ($l = 0; $l < $periode; $l++) {
        //                 $id_data = $response['vervar'][$i]['val'] . $idvariabel . $response['turvar'][$j]['val'] . $response['tahun'][$k]['val'] . $response['turtahun'][$l]['val'];

        //                 $push = [
        //                     'wilayah' => $response['vervar'][$i]['val'],
        //                     'api_id' => $idvariabel,
        //                     'tahun' => $response['tahun'][$k]['label'],
        //                     'periode' => $response['turtahun'][$l]['label'],
        //                     'datacontent' => $id_data,
        //                     'nilai' => isset($response['datacontent'][$id_data]) ? $response['datacontent'][$id_data] : null
        //                 ];
        //                 $this->db->insert('nilai_indikator', $push);

        //                 $existing_record = $this->db->get_where('nilai_indikator', ['datacontent' => $id_data])->row();

        //                 if (!$existing_record) {
        //                     $this->db->insert('nilai_indikator', $push);
        //                 }
        //             }
        //         }
        //     }
        // }

        $this->load->view('admin/inc/v_header', $data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_table');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }
}
