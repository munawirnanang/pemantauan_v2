<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_indikator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('curl');

        $this->load->helper("prov");
        $this->load->helper("coordinat");
        $this->load->helper("jawa");
        $this->load->helper("blntbntt");
        $this->load->helper("kalimantan");
        $this->load->helper("sulawesi");
        $this->load->helper("malpa");
        
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
        $data['tahun'] = $this->db->query('SELECT DISTINCT T.tahun FROM nilai_indikator T ORDER BY tahun DESC')->result_array();
        $data['max_overview'] = $this->db->query("SELECT
                                                    NI.wilayah,NI.tahun, NI.periode, NI.id_indikator,NI.nilai, NI.nasional,NI.satuan,I.jenis, I.nama_indikator,W.nama_wilayah
                                                FROM nilai_indikator NI
                                                JOIN indikator I ON NI.id_indikator = I.id
                                                JOIN wilayah W ON NI.wilayah = W.id
                                                JOIN (SELECT NI1.id_indikator, MAX(NI1.tahun) AS max_tahun, MAX(NI1.periode) AS max_periode FROM nilai_indikator NI1 WHERE NI1.versi = (SELECT MAX(versi) FROM nilai_indikator) AND NI1.wilayah = '9999'AND NI1.nilai IS NOT NULL AND NI1.nasional IS NOT NULL GROUP BY NI1.id_indikator) max_data ON NI.id_indikator = max_data.id_indikator AND NI.tahun = max_data.max_tahun AND NI.periode = (SELECT MAX(NI2.periode) FROM nilai_indikator NI2 WHERE NI2.id_indikator = NI.id_indikator AND NI2.tahun = max_data.max_tahun AND NI2.nilai IS NOT NULL AND NI2.nasional IS NOT NULL)
                                                WHERE
                                                    NI.versi = (SELECT MAX(versi) FROM nilai_indikator)
                                                    AND NI.wilayah = '9999'
                                                    AND NI.nilai IS NOT NULL
                                                    AND NI.nasional IS NOT NULL")->result_array();
        $data['min_overview'] = $this->db->query("SELECT
                                                    NI.wilayah,NI.tahun, NI.periode, NI.id_indikator,NI.nilai, NI.nasional,NI.satuan,I.jenis, I.nama_indikator,W.nama_wilayah
                                                FROM nilai_indikator NI
                                                JOIN indikator I ON NI.id_indikator = I.id
                                                JOIN wilayah W ON NI.wilayah = W.id
                                                JOIN (SELECT NI1.id_indikator, MAX(NI1.tahun) - 1 AS max_tahun, MAX(NI1.periode) AS max_periode FROM nilai_indikator NI1 WHERE NI1.versi = (SELECT MAX(versi) FROM nilai_indikator) AND NI1.wilayah = '9999'AND NI1.nilai IS NOT NULL AND NI1.nasional IS NOT NULL GROUP BY NI1.id_indikator) max_data ON NI.id_indikator = max_data.id_indikator AND NI.tahun = max_data.max_tahun AND NI.periode = (SELECT MAX(NI2.periode) FROM nilai_indikator NI2 WHERE NI2.id_indikator = NI.id_indikator AND NI2.tahun = max_data.max_tahun AND NI2.nilai IS NOT NULL AND NI2.nasional IS NOT NULL)
                                                WHERE
                                                    NI.versi = (SELECT MAX(versi) FROM nilai_indikator)
                                                    AND NI.wilayah = '9999'
                                                    AND NI.nilai IS NOT NULL
                                                    AND NI.nasional IS NOT NULL")->result_array();
                                                
        $combinedData = array_merge($data['max_overview'],$data['min_overview']);
        $combinedArray = [];

        function getCombinedKey($item) {
        return $item['wilayah'] . '_' . $item['id_indikator'];
        }

        // Iterate over the combined data
        foreach ($combinedData as $item) {
            $key = getCombinedKey($item);
            if (!isset($combinedArray[$key])) {
                $combinedArray[$key] = [
                    "wilayah" => $item['wilayah'],
                    "id_indikator" => $item['id_indikator'],
                    "satuan" => $item['satuan'],
                    "jenis" => $item['jenis'],
                    "nama_indikator" => $item['nama_indikator'],
                    "nama_wilayah" => $item['nama_wilayah'],
                ];
            }
            // Add values dynamically based on year and periode
            $tahun = $item['tahun'];
            $periode = $item['periode'];

            if (!isset($combinedArray[$key]['min_year']) || $tahun < $combinedArray[$key]['min_year']) {
                $combinedArray[$key]['min_year'] = $tahun;
                $combinedArray[$key]['periode_min_year'] = $periode;
                $combinedArray[$key]["nilai_min_year"] = $item['nilai'];
                $combinedArray[$key]["nasional_min_year"] = $item['nasional'];
            } elseif ($tahun == $combinedArray[$key]['min_year']) {
                $combinedArray[$key]['periode_min_year'] = $periode;
                $combinedArray[$key]["nilai_min_year"] = $item['nilai'];
                $combinedArray[$key]["nasional_min_year"] = $item['nasional'];
            }

            if (!isset($combinedArray[$key]['max_year']) || $tahun > $combinedArray[$key]['max_year']) {
                $combinedArray[$key]['max_year'] = $tahun;
                $combinedArray[$key]['periode_max_year'] = $periode;
                $combinedArray[$key]["nilai_max_year"] = $item['nilai'];
                $combinedArray[$key]["nasional_max_year"] = $item['nasional'];
            } elseif ($tahun == $combinedArray[$key]['max_year']) {
                $combinedArray[$key]['periode_max_year'] = $periode;
                $combinedArray[$key]["nilai_max_year"] = $item['nilai'];
                $combinedArray[$key]["nasional_max_year"] = $item['nasional'];
            }
        }

        $combinedArray = array_values($combinedArray);

        $data['html_card'] = '';

        foreach($combinedArray as $item){
            if($item['jenis']=='positif'){
                if($item['nasional_max_year']>=$item['nasional_min_year']){
                    $warna = '<div class="card-box widget-box-two widget-two-success">';
                    $arrow = '<i class="mdi mdi-arrow-up text-success"></i>';
                }else{
                    $warna = '<div class="card-box widget-box-two widget-two-danger">';
                    $arrow = '<i class="mdi mdi-arrow-down text-danger"></i>';
                }
            }else{
                if($item['nasional_max_year']<=$item['nasional_min_year']){
                    $warna = '<div class="card-box widget-box-two widget-two-success">';
                    $arrow = '<i class="mdi mdi-arrow-down text-success"></i>';
                }else{
                    $warna = '<div class="card-box widget-box-two widget-two-danger">';
                    $arrow = '<i class="mdi mdi-arrow-up text-danger"></i>';
                }
            }
            $data['html_card'] .= '<div class="col-lg-6 col-md-6">';
            $data['html_card'] .= $warna; 
            // $data['html_card'] .= '<i class="mdi mdi-chart-areaspline widget-two-icon"></i>'; 
            $data['html_card'] .= '<i class="widget-two-icon"><img src="'. base_url('assets').'/icon/'.strtolower(str_replace(' ', '_', $item['nama_indikator'])).'.png" alt="user-img" class="img-circle user-img" width="100%" height="100%"></i>'; 
            $data['html_card'] .= '<div class="wigdet-two-content">'; 
            $data['html_card'] .= '<p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">'.$item['nama_indikator'].'</p>'; 
            $data['html_card'] .= '<h4>'.$item['nama_wilayah'].' ('.$item['max_year'].') : '.number_format((float)$item['nasional_max_year'],2,'.',',').'<small>'.$arrow.'</small></h4>'; 
            $data['html_card'] .= '<p class="text-muted m-0"><b>'.$item['nama_wilayah'].' ('.$item['min_year'].') : '.number_format((float)$item['nasional_min_year'],2,'.',',').'</b></p>'; 
            $data['html_card'] .= '</div>'; 
            $data['html_card'] .= '</div>'; 
            $data['html_card'] .= '</div>'; 
        }
    
        
        // Print the combined array
        // echo '<pre>';
        // print_r($combinedArray);
        // echo '</pre>';
        
        // die;
        
        
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
        sort($tahun);
        
        
        if(!$wilayah || !$indikator || !$tahun){
            echo 'isi form';
            die;
        }
        array_unshift($wilayah,'9999');
            
        $resultArray = array();
        
        
        for ($i = 0; $i < count($indikator); $i++) {
            for ($w = 0; $w < count($wilayah); $w++) {
                for ($t = 0; $t < count($tahun); $t++) {

                        $dataindikator = $this->db->query(
                            "SELECT NI.wilayah,NI.tahun,NI.periode,NI.id_indikator,NI.nilai,NI.nasional,NI.satuan, I.jenis,NI.nilai,I.nama_indikator,W.nama_wilayah
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
                    
                    foreach($dataindikator as $data){
                        $resultArray[] = $data;
                    }
                }
            }
        }
        
        foreach ($resultArray as $key => $value) {
            if ($value['wilayah'] === '1000') {
                unset($resultArray[$key]);
            }
        }
        $jenis = '';
        $query_tahun = (implode(",",$tahun));
        $query_indikator = (implode(",",$indikator));

        $onlyprovinsi = array_filter($resultArray, function($item) {
            return substr($item['wilayah'], -2) === "00";
        });

        $onlyprovinsi = array_values($onlyprovinsi);
        
        
        if($wilayah[0]==='9999' && $wilayah[1]==='1000'){
            $dataproperties = $this->db->query("SELECT NI.wilayah,NI.tahun,NI.periode,NI.id_indikator,NI.nilai,NI.nasional,NI.satuan, I.jenis,I.nama_indikator,W.nama_wilayah
                            FROM nilai_indikator NI 
                            JOIN indikator I ON NI.id_indikator=I.id
                            JOIN wilayah W ON NI.wilayah=W.id
                            WHERE NI.versi = (SELECT MAX(versi) FROM nilai_indikator)
                            AND NI.wilayah LIKE '%00%'
                            AND NI.id_indikator IN ($query_indikator)
                            AND NI.tahun IN ($query_tahun)
                            AND NI.nilai IS NOT NULL
                            AND NI.nasional IS NOT NULL")->result_array();

            foreach ($dataproperties as $item) {
                $key = "properties_{$item['id_indikator']}_{$item['tahun']}";
                if (!isset($properties[$key])) {
                    $properties[$key] = array();
                }
                $properties[$key][] = $item;
            }
        }else{
                foreach ($onlyprovinsi as $item) {
                $key = "properties_{$item['id_indikator']}_{$item['tahun']}";
                if (!isset($properties[$key])) {
                    $properties[$key] = array();
                }
                $properties[$key][] = $item;
            }
        }
            foreach($properties as $key => $item){
                for($o=0; $o<count($item);$o++){
                    $lt = nama_provinsi($item[$o]['wilayah']);
                    if ($item[$o]['wilayah'] == '3100' || $item[$o]['wilayah'] == '3400') {
                        $jenis = 'Polygon';
                    } else {
                        $jenis = 'MultiPolygon';
                    }
                    $peta[$key][]=[
                        "type" => "Feature",
                        "id" => $item[$o]['wilayah'],
                        "geometry" => array(
                            "type" => $jenis,
                            "coordinates" => $lt,
                        ),
                        "properties" => array(
                            "kode"=> $item[$o]['wilayah'],
                            "nama_wilayah" => $item[$o]['nama_wilayah'],
                            "nama_indikator" => $item[$o]['nama_indikator'],
                            "jenis" => $item[$o]['jenis'],
                            "tahun" => $item[$o]['tahun'],
                            "periode" => $item[$o]['periode'],
                            "satuan" => $item[$o]['satuan'],
                            "nasional" => (float) $item[$o]['nasional'],
                            "nilai" => (float) $item[$o]['nilai'],
                            "short_description" =>
                                "<strong style='padding: 0px;'>" . $item[$o]['nama_indikator'] . "</strong> (Periode : " .$item[$o]['periode']."-". $item[$o]['tahun'] . ")<hr style='margin: 2px;'/><b>Capaian " . $item[$o]['nama_wilayah'] . "</b> : " . number_format((float)$item[$o]['nilai'],2,'.',',')."<hr style='margin: 2px;'/><b>Capaian Nasional</b> : " . number_format((float)$item[$o]['nasional'],2,'.',','),
                            "description" =>
                                "<table>
                                    <tr>
                                        <td colspan='2'>
                                            <div id='nama_periode_provinsi'><strong>".$item[$o]['nama_wilayah']." Periode(". $item[$o]['tahun'].")</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class='text' style='font-size: 14px;'><strong>Capaian :</strong></div> 
                                        </td>
                                        <td>
                                                <div class='text' style='font-size: 14px;'>".number_format((float)$item[$o]['nilai'],2,'.',',')."</div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class='text' style='font-size: 14px;'><strong>Capaian Nasional:</strong></div> 
                                        </td>
                                        <td>
                                                <div class='text' style='font-size: 14px;'>".number_format((float)$item[$o]['nasional'],2,'.',',')."</div> 
                                        </td>
                                    </tr>
                                </table>"
                        ),
                    ];
                    $nilai_peta[$key]=$peta[$key];
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
        $tabel_html = '<thead>';
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
        
        $tabel_html .= '</tr>';
        $tabel_html .= '<tr>';
        
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
        
        $tabel_html .= '</thead>';
        $tabel_html .= '<tbody>';
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
                        $tabel_html .= '<td>'.number_format((float)$value,2,'.',',').'</td>';
                    }
                }
            }
        
            $tabel_html .= '</tr>';
        }
        $tabel_html .= '</tbody>';
        $tabel_html .= '</table>';

        foreach($unique_years as $ui){
            foreach($unique_periods as $up){
                $categories[] = $up.'-'.$ui;
            }
        }   

        // $geometry = nama_jawa($idwill);

        $data2=[
            'data' => $resultArray,
            'categories' => $categories,
            'nilai_data' => $nilai_peta,
            'unique_indikator' => $unique_indicators,
            'html_tabel' => $tabel_html
        ];
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data2));

        
    }
}
