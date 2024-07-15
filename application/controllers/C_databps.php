<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_databps extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('userid')) {
            redirect('');
        }
    }
    public function index($id)
    {
        $data['js'] = 'assets/assets/js/js/bps.js';
        $data['judul'] = 'Data BPS';
        $data['uri'] = $this->uri->segment(2);

        $data['prov'] = $this->db->query("SELECT DISTINCT id_prov FROM `wilayah` WHERE id NOT LIKE '9%'")->result_array();
        $data['wilayah'] = $this->db->query("SELECT * FROM `wilayah` WHERE id NOT LIKE '9%'")->result_array();
        $data['wilayah'] = array_filter($data['wilayah'], function ($item) {
            return $item['id'] !== "9999";
        });
        foreach ($data['wilayah'] as &$item) {
            if ($item['id'] === "1000") {
                $item['id'] = "9999";
            }
        }
        $data['dropdown'] = 'enabled';

        if ($id == '9999') {
            $id = '0000';
        }

        $url1 = 'https://webapi.bps.go.id/v1/api/list/model/subject/domain/' . $id . '/key/954d935f47f5ee473f310c6410aa304e/';

        $this->curl->create($url1);
        $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
        $api1 = $this->curl->execute();
        $response = json_decode($api1, true);
        if ($response['data'] != null) {

            $item = $response['data'][0]['page'];
            $jumlah = $response['data'][0]['pages'] + 1;

            $data['categories'] = [];

            for ($i = 1; $i < $jumlah; $i++) {
                $url = 'https://webapi.bps.go.id/v1/api/list/model/subject/domain/' . $id . '/page/' . $i . '/key/954d935f47f5ee473f310c6410aa304e/';
                $this->curl->create($url);
                $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
                $api = $this->curl->execute();
                $response = json_decode($api, true);
                $data['categories'] = array_merge($data['categories'], $response['data'][1]);
                // $data_raw = $response['data'][1];
            }

            $unique_subcats = [];
            foreach ($data['categories'] as $entry) {
                $subcat_id = $entry['subcat_id'];
                if (!isset($unique_subcats[$subcat_id])) {
                    $unique_subcats[$subcat_id] = [
                        'subcat_id' => $entry['subcat_id'],
                        'subcat' => $entry['subcat']
                    ];
                }
            }

            $data['unique'] = array_values($unique_subcats);
            $data['card'] = ['panel panel-color panel-primary', 'panel panel-color panel-warning', 'panel panel-color panel-success', 'panel panel-color panel-info', 'panel panel-color panel-info', 'panel panel-color panel-info'];

            $this->load->view('admin/inc/v_header', $data);
            $this->load->view('admin/inc/v_topbar_bps');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_databps');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        } else {
            $data['uri'] = '9999';
            $this->load->view('admin/inc/v_header', $data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('errors/v_notavaible');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        }
    }

    public function data_kategori($id)
    {
        $data['js'] = 'assets/assets/js/js/bps.js';
        $data['judul'] = 'Data BPS';

        $data['wilayah'] = $this->db->get('wilayah')->result_array();
        $data['wilayah'] = array_filter($data['wilayah'], function ($item) {
            return $item['id'] !== "9999";
        });
        foreach ($data['wilayah'] as &$item) {
            if ($item['id'] === "1000") {
                $item['id'] = "9999";
            }
        }
        $data['dropdown'] = 'disabled';
        $data['uri'] = $this->input->get('uri');
        $uri = $this->input->get('uri');

        if ($uri == '9999') {
            $uri = '0000';
        }

        if ($id == '1000') {
            $url1 = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/' . $uri . '/page/1/key/954d935f47f5ee473f310c6410aa304e/';
        } else {
            $url1 = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/' . $uri . '/subject/' . $id . '/page/1/key/954d935f47f5ee473f310c6410aa304e/';
        }
        $this->curl->create($url1);
        $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
        $api1 = $this->curl->execute();
        $response = json_decode($api1, true);

        if ($response['data'] != null) {
            $item = $response['data'][0]['page'];
            $jumlah = $response['data'][0]['pages'] + 1;

            $data['tabel'] = [];
            $data_all = array();

            for ($i = 1; $i < $jumlah; $i++) {
                if ($id == '1000') {
                    $url = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/' . $uri . '/page/' . $i . '/key/954d935f47f5ee473f310c6410aa304e/';
                } else {
                    $url = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/' . $uri . '/subject/' . $id . '/page/' . $i . '/key/954d935f47f5ee473f310c6410aa304e/';
                }
                $this->curl->create($url);
                $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
                $api = $this->curl->execute();
                $response = json_decode($api, true);

                if (isset($response['data'][1])) { // Check if the data exists
                    $data_raw = $response['data'][1];
                    $data_all = array_merge($data_all, $data_raw); // Append the data to the new array
                }
            }
            $data['indikator'] = $data_all[0]['sub_name'];

            $data['tabel'] = $data_all;

            $this->load->view('admin/inc/v_header', $data);
            $this->load->view('admin/inc/v_topbar_bps');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_data');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        } else {
            $this->load->view('admin/inc/v_header', $data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('errors/v_notavaible');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        }
    }

    public function detail_data()
    {
        try {

            $id = $this->input->post('id');
            $uri = $this->input->post('uri');

            if ($uri == '9999') {
                $uri = '0000';
            }


            $keyapi = '954d935f47f5ee473f310c6410aa304e';
            $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/' . $uri . '/var/' . $id . '/key/' . $keyapi;
            // $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/534/turvar/1550/key/954d935f47f5ee473f310c6410aa304e';
            $this->curl->create($url);
            $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
            $api = $this->curl->execute();

            $response = json_decode($api, true);
            $html_table = '';

            if ($response['data-availability'] == "list-not-available") {
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
            } else {
                $idvariabel = $response['var'][0]['val'];
                $baris = count($response['vervar']);
                $karakter = count($response['turvar']);
                $tahun = count($response['tahun']);
                $bulan = count($response['turtahun']);
                $title = $response['var'][0]['label'];

                $html_table .= '<div class="card-box table-responsive">';
                $html_table .= '<table id="datatable-buttons" class="table table-striped table-bordered">';
                $html_table .= '<thead>';
                if ($bulan == 1 && $karakter == 1) {
                    $html_table .= '<tr><th rowspan="3">' . $response['labelvervar'] . '</th></tr>';
                    $html_table .= '<tr><th colspan="' . $tahun . '">' . $response['var'][0]['label'] . '</th></tr>';
                    $html_table .= '<tr>';
                    for ($i = 0; $i < $tahun; $i++) {
                        $html_table .= '<th>' . $response['tahun'][$i]['label'] . '</th>';
                    }
                    $html_table .= '</tr>';
                } elseif ($bulan > 1 && $karakter == 1) {
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
                } elseif ($bulan == 1 && $karakter > 1) {
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
                } elseif ($bulan > 1 && $karakter > 1) {
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
            }

            $this->output->set_content_type('text/html')->set_output($html_table);
        } catch (Exception $e) {
            log_message('error: ', $e->getMessage());
            return;
        }
    }
    public function fetch_domain_bps()
    {
        $domain = 3277;
        $url1 = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/' . $domain . '/page/1/key/954d935f47f5ee473f310c6410aa304e/';

        $this->curl->create($url1);
        $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
        $api1 = $this->curl->execute();
        $response = json_decode($api1, true);

        $item = $response['data'][0]['page'];
        $jumlah = $response['data'][0]['pages'] + 1;

        $data['tabel'] = [];
        $data_all = array();

        for ($i = 1; $i < $jumlah; $i++) {
            $url = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/' . $domain . '/page/' . $i . '/key/954d935f47f5ee473f310c6410aa304e/';
            $this->curl->create($url);
            $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
            $api = $this->curl->execute();
            $response = json_decode($api, true);

            if (isset($response['data'][1])) { // Check if the data exists
                $data_raw = $response['data'][1];
                $data_all = array_merge($data_all, $data_raw); // Append the data to the new array
            }
        }
        $data['domain'] = $data_all;
        $data['judul'] = 'Indikator';

        $this->load->view('admin/inc/v_header', $data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_domainbps');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }

    public function update_data_bps()
    {
        $datawilayah = $this->db->query("SELECT id FROM wilayah WHERE id <> 1000 AND id LIKE '3300%'")->result_array();
        foreach ($datawilayah as $i) {
            $wilayah = $i['id'];
            // $wilayah = '0000';
            // $wil = '9999';
            $url1 = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/' . $wilayah . '/page/1/key/954d935f47f5ee473f310c6410aa304e/';

            $this->curl->create($url1);
            $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
            $api1 = $this->curl->execute();
            $response = json_decode($api1, true);

            $item = $response['data'][0]['page'];
            $jumlah = $response['data'][0]['pages'] + 1;

            $data['tabel'] = [];

            for ($i = 1; $i < $jumlah; $i++) {
                $url = 'https://webapi.bps.go.id/v1/api/list/model/var/lang/ind/domain/' . $wilayah . '/page/' . $i . '/key/954d935f47f5ee473f310c6410aa304e/';
                $this->curl->create($url);
                $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
                $api = $this->curl->execute();
                $response = json_decode($api, true);
                // $data['tabel'] = array_merge($data['tabel'], $response['data'][1]);
                $data_raw = $response['data'][1];
                foreach ($data_raw as $data) {
                    $push = [
                        'id_api' => $data['var_id'],
                        'id_kategori' => $data['sub_id'],
                        'judul' => $data['title'],
                        'id_wilayah' => $wilayah,
                    ];
                    $this->db->insert('data_bps', $push);
                }
            }
            echo '<pre>';
            echo 'sukses ' . $wilayah;
            echo '</pre>';
        }
        echo 'Uhuyyy';
    }
    public function kategori_bps()
    {
        // $wilayah = '0000';
        // $foriegn = '9999';
        $datawilayah = $this->db->query("SELECT id FROM wilayah WHERE id <> 1000 AND id LIKE '8%'")->result_array();
        foreach ($datawilayah as $wilayah) {
            $url1 = 'https://webapi.bps.go.id/v1/api/list/model/subject/domain/' . $wilayah['id'] . '/key/954d935f47f5ee473f310c6410aa304e/';

            $this->curl->create($url1);
            $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
            $api1 = $this->curl->execute();
            $response = json_decode($api1, true);

            $item = $response['data'][0]['page'];
            $jumlah = $response['data'][0]['pages'] + 1;

            $data['tabel'] = [];

            for ($i = 1; $i < $jumlah; $i++) {
                $url = 'https://webapi.bps.go.id/v1/api/list/model/subject/domain/' . $wilayah['id'] . '/page/' . $i . '/key/954d935f47f5ee473f310c6410aa304e/';
                $this->curl->create($url);
                $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
                $api = $this->curl->execute();
                $response = json_decode($api, true);
                // $data['tabel'] = array_merge($data['tabel'], $response['data'][1]);
                $data_raw = $response['data'][1];
                foreach ($data_raw as $data) {
                    // Check if the record with the given primary key already exists
                    $this->db->where('id', $data['sub_id']);
                    $query = $this->db->get('kategori_bps');

                    // If the record does not exist, insert the new data
                    if ($query->num_rows() == 0) {
                        $push = [
                            'id' => $data['sub_id'],
                            'nama_kategori' => $data['title'],
                            'id_sub_kategori' => $data['subcat_id'],
                            'nama_sub_kategori' => $data['subcat'],
                            'wilayah' => $wilayah['id'],
                        ];
                        $this->db->insert('kategori_bps', $push);
                    }
                }
            }
            echo '<pre>';
            echo 'sukses' . $wilayah['id'];
            echo '</pre>';
        }
        echo 'Uhuyy';
    }
}
