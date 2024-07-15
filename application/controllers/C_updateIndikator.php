<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_updateIndikator extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
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
        $data['judul'] = 'Upload Indikator';
        $data['id_bps'] = $this->db->get('data_bps')->result_array();
        $data['js']= 'assets/assets/js/js/updateindikator.js';

        // $data['indikator'] = $this->db->get('indikator')->result_array();
        $data['indikator'] = $this->db->query('SELECT I.*,COUNT(DISTINCT(NI.tahun)) AS jumlah_tahun, COUNT(DISTINCT(NI.wilayah)) AS jumlah_wilayah, COUNT(DISTINCT(NI.periode)) AS jumlah_periode, COUNT(NI.id) AS jumlah_data, min(NI.tahun) AS tahunawal, max(NI.tahun) AS tahunakhir FROM indikator I LEFT JOIN nilai_indikator NI ON I.id=NI.id_indikator GROUP BY I.id')->result_array();
        

        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_updateIndikator');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }

    public function tambah_indikator()
    {
        $id=$this->input->post('id');
        $id_api=$this->input->post('id_bps');
        $group_id=$this->input->post('group_id');
        $nama_indikator=$this->input->post('nama_indikator');
        $nama_tabel=$this->input->post('nama_tabel');
        $jenis=$this->input->post('jenis');
        $chart=$this->input->post('chart');
        $link=$this->input->post('link');
        $satuan=$this->input->post('satuan');
        $urutan=$this->input->post('urutan');
        $ppd=$this->input->post('ppd');
        $deskripsi=$this->input->post('deskripsi');

        $data['judul'] = 'Upload Indikator';
        $data['id_bps'] = $this->db->get('data_bps')->result_array();
        $data['indikator'] = $this->db->query('SELECT I.*,COUNT(DISTINCT(NI.tahun)) AS jumlah_tahun, COUNT(DISTINCT(NI.wilayah)) AS jumlah_wilayah, COUNT(DISTINCT(NI.periode)) AS jumlah_periode, COUNT(NI.id) AS jumlah_data, min(NI.tahun) AS tahunawal, max(NI.tahun) AS tahunakhir FROM indikator I LEFT JOIN nilai_indikator NI ON I.id=NI.id_indikator GROUP BY I.id')->result_array();
        // $data['indikator'] = $this->db->get('indikator')->result_array();

        $this->form_validation->set_rules('id','ID','required|is_unique[indikator.id]|trim');

        if($this->form_validation->run()==false){
            $this->load->view('admin/inc/v_header',$data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_updateIndikator');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        }else{
            $data_indikator=[
                'id' => $id,
                'id_api' => $id_api,
                'group_id' => $group_id,
                'nama_indikator' => $nama_indikator,
                'nama_tabel' => $nama_tabel,
                'jenis' => $jenis,
                'chart' => $chart,
                'link' => $link,
                'satuan' => $satuan,
                'urutan' => $urutan,
                'ppd' => $ppd,
                'deskripsi' => $deskripsi,
            ];
            $this->db->insert('indikator',$data_indikator);
            
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('update_indikator');
        }
    }

    public function update_all_data_makro()
    {
        $keyapi = '954d935f47f5ee473f310c6410aa304e';
        $list_indikator = $this->db->query('SELECT * FROM indikator i')->result_array();

        $countdata = $this->db->get('nilai_indikator')->result_array();
        $countdata = count($countdata);
        if($countdata){
            $this->db->truncate('nilai_indikator');
        }
        
        foreach($list_indikator as $key){
            if($key['id_api']=='98'){
                $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$key['id_api'].'/turvar/191/key/'.$keyapi;
            }elseif($key['id_api']=='534'){
                $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$key['id_api'].'/turth/35/turvar/1550/key/'.$keyapi;
            }elseif($key['id_api']=='533'){
                $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$key['id_api'].'/turth/35/turvar/1550/key/'.$keyapi;
            }elseif($key['id_api']=='192'){
                $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$key['id_api'].'/turvar/434/key/'.$keyapi;
            }else{
                $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$key['id_api'].'/key/'.$keyapi;
            }
            $id_indikator = $key['id'];

            $this->curl->create($url);
            $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
            $api = $this->curl->execute();

            $data['api'] = json_decode($api, true);
            $response = json_decode($api, true);

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
                            // $replace_str=['0'=>'Tahun','1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni','7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];

                            
                            
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
        $this->session->set_flashdata('flash', 'diperbaharui');
    }
    public function update_data_makro($id)
    {
        $keyapi = '954d935f47f5ee473f310c6410aa304e';
        $id_indikator = $this->db->query("SELECT id FROM indikator i WHERE i.id_api=$id")->row_array();
        
        if($id=='98'){
            $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$id.'/turvar/191/key/'.$keyapi;
        }elseif($id=='534'){
            $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$id.'/turth/35/turvar/1550/key/'.$keyapi;
        }elseif($id=='533'){
            $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$id.'/turth/35/turvar/1550/key/'.$keyapi;
        }elseif($id=='192'){
            $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$id.'/turvar/434/key/'.$keyapi;
        }else{
            $url = 'https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/'.$id.'/key/'.$keyapi;
        }
        $id_indikator = $id_indikator['id'];

        $this->curl->create($url);
        $this->curl->option(CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds
        $api = $this->curl->execute();

        $data['api'] = json_decode($api, true);
        $response = json_decode($api, true);

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
        $countdata = $this->db->get('nilai_indikator')->result_array();
        $countdata = count($countdata);
        
        if($countdata){
            $this->db->where('id_indikator',$id_indikator);
            $this->db->delete('nilai_indikator');
        }   

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
        $this->session->set_flashdata('flash', 'diperbaharui');
    }
    public function hapus_indikator()
    {
        $id_indikator = $this->input->post('id');
        $this->db->where('id',$id_indikator);
        $this->db->delete('indikator');
    }

    public function edit_indikator($id)
    {
        $new_id=$this->input->post('id_edit');
        $id_api=$this->input->post('id_bps_edit');
        $group_id=$this->input->post('group_id_edit');
        $nama_indikator=$this->input->post('nama_indikator_edit');
        $nama_tabel=$this->input->post('nama_tabel_edit');
        $jenis=$this->input->post('jenis_edit');
        $chart=$this->input->post('chart_edit');
        $link=$this->input->post('link_edit');
        $satuan=$this->input->post('satuan_edit');
        $urutan=$this->input->post('urutan_edit');
        $ppd=$this->input->post('ppd_edit');
        $deskripsi=$this->input->post('deskripsi_edit');
        
        $data['judul'] = 'Upload Indikator';
        $data['id_bps'] = $this->db->get('data_bps')->result_array();
        $data['indikator'] = $this->db->query('SELECT I.*,COUNT(DISTINCT(NI.tahun)) AS jumlah_tahun, COUNT(DISTINCT(NI.wilayah)) AS jumlah_wilayah, COUNT(DISTINCT(NI.periode)) AS jumlah_periode, COUNT(NI.id) AS jumlah_data, min(NI.tahun) AS tahunawal, max(NI.tahun) AS tahunakhir FROM indikator I LEFT JOIN nilai_indikator NI ON I.id=NI.id_indikator GROUP BY I.id')->result_array();
        // $data['indikator'] = $this->db->get('indikator')->result_array();

        if($new_id!=$id)
        {
            $this->form_validation->set_rules('id_edit','id_edit','required|is_unique[indikator.id]|trim');
        }else{
            $this->form_validation->set_rules('id_edit','id_edit','required|trim');
            
        }

        if($this->form_validation->run()==false){
            $this->session->set_flashdata('flashgagal', 'gagal');
            redirect('update_indikator');
        }else{
            if($new_id!=$id)
            {
                $this->db->set('id',$new_id);
            }
            $this->db->set('group_id',$group_id);
            $this->db->set('nama_indikator',$nama_indikator);
            $this->db->set('nama_tabel',$nama_tabel);
            $this->db->set('jenis',$jenis);
            $this->db->set('chart',$chart);
            $this->db->set('link',$link);
            $this->db->set('satuan',$satuan);
            $this->db->set('urutan',$urutan);
            $this->db->set('ppd',$ppd);
            $this->db->set('deskripsi',$deskripsi);
            $this->db->where('id',$id);
            $this->db->update('indikator');
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('update_indikator');
        }
    }
}
