<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class C_uploadIndikator extends CI_Controller
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
        date_default_timezone_set("Asia/Bangkok");
    }
    
     public function index()
    {
        $data['judul'] = 'Upload Indikator';
        $data['js']= 'assets/assets/js/js/uploadindikator.js';

        $data['indikator'] = $this->db->query('SELECT I.*,COUNT(DISTINCT(NI.tahun)) AS jumlah_tahun, COUNT(DISTINCT(NI.wilayah)) AS jumlah_wilayah, COUNT(DISTINCT(NI.periode)) AS jumlah_periode, COUNT(NI.id) AS jumlah_data, min(NI.tahun) AS tahunawal, max(NI.tahun) AS tahunakhir FROM indikator I LEFT JOIN nilai_indikator NI ON I.id=NI.id_indikator WHERE I.bps="0" GROUP BY I.id')->result_array();
        
        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_uploadindikator');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }

    public function tambah_indikator()
    {
        $id=$this->input->post('id');
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
        $data['indikator'] = $this->db->query('SELECT I.*,COUNT(DISTINCT(NI.tahun)) AS jumlah_tahun, COUNT(DISTINCT(NI.wilayah)) AS jumlah_wilayah, COUNT(DISTINCT(NI.periode)) AS jumlah_periode, COUNT(NI.id) AS jumlah_data, min(NI.tahun) AS tahunawal, max(NI.tahun) AS tahunakhir FROM indikator I LEFT JOIN nilai_indikator NI ON I.id=NI.id_indikator WHERE I.bps="0" GROUP BY I.id')->result_array();
        // $data['indikator'] = $this->db->get('indikator')->result_array();

        $this->form_validation->set_rules('id','ID','required|is_unique[indikator.id]|trim');

        if($this->form_validation->run()==false){
            $this->load->view('admin/inc/v_header',$data);
            $this->load->view('admin/inc/v_topbar');
            $this->load->view('admin/inc/v_leftside');
            $this->load->view('admin/main/v_uploadindikator');
            $this->load->view('admin/inc/v_rightside');
            $this->load->view('admin/inc/v_footer');
        }else{
            $data_indikator=[
                'id' => $id,
                'id_api' => '0',
                'id_turvar' => '0',
                'group_id' => $group_id,
                'nama_indikator' => $nama_indikator,
                'nama_tabel' => $nama_tabel,
                'jenis' => $jenis,
                'chart' => $chart,
                'link' => $link,
                'satuan' => $satuan,
                'urutan' => $urutan,
                'ppd' => $ppd,
                'bps' => '0',
                'deskripsi' => $deskripsi,
            ];
            $this->db->insert('indikator',$data_indikator);
            
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('upload_indikator');
        }
    }

    public function edit_indikator($id)
    {
        $new_id=$this->input->post('id_edit');;
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
        $data['indikator'] = $this->db->query('SELECT I.*,COUNT(DISTINCT(NI.tahun)) AS jumlah_tahun, COUNT(DISTINCT(NI.wilayah)) AS jumlah_wilayah, COUNT(DISTINCT(NI.periode)) AS jumlah_periode, COUNT(NI.id) AS jumlah_data, min(NI.tahun) AS tahunawal, max(NI.tahun) AS tahunakhir FROM indikator I LEFT JOIN nilai_indikator NI ON I.id=NI.id_indikator WHERE I.bps="0" GROUP BY I.id')->result_array();
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
            $this->db->set('bps','0');
            $this->db->set('deskripsi',$deskripsi);
            $this->db->where('id',$id);
            $this->db->update('indikator');
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('upload_indikator');
        }
    }
    public function reset_indikator($id)
    {
        $data = $this->db->get_where('nilai_indikator',['id_indikator'=>$id])->result_array();
        $countdata = count($data);
        
        if($countdata){
            $this->db->where('id_indikator',$id);
            $this->db->delete('nilai_indikator');
        }
    }
    public function upload($id)
    {
        $data['judul'] = 'Upload Indikator';
        $data['js']= 'assets/assets/js/js/uploadindikator.js';
        $data['id_indikator']=$id;

        $data['indikator'] = $this->db->query("SELECT * FROM indikator WHERE id='$id'")->row_array();

        $data['file'] = $this->db->query("SELECT * FROM file_indikator WHERE id_indikator='$id' ORDER BY up_dt DESC")->result_array();

        $data['count_data'] = $this->db->query("SELECT I.*,COUNT(DISTINCT(NI.tahun)) AS jumlah_tahun, COUNT(DISTINCT(NI.wilayah)) AS jumlah_wilayah, COUNT(DISTINCT(NI.periode)) AS jumlah_periode, COUNT(NI.id) AS jumlah_data, min(NI.tahun) AS tahunawal, max(NI.tahun) AS tahunakhir FROM indikator I LEFT JOIN nilai_indikator NI ON I.id=NI.id_indikator WHERE I.bps='0' AND I.id='$id' GROUP BY I.id")->row_array();
        

        
        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_upload');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }
    public function input_upload() {
        $id_indikator = $this->input->post('id_indikator');
    
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size'] = 2048; // 2MB

        $this->load->library('upload', $config);


        if (!$this->upload->do_upload('files')) {
            $error = array('error' => $this->upload->display_errors());
            $message= ['status'=> 'error',
                                'message' => $error];
                        
            header('Content-Type: application/json');
            echo json_encode($message);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $file_name = $data['upload_data']['raw_name'];
            $file_ext = $data['upload_data']['file_ext'];
            $time = date("Y-m-d H:i:s");

            $hashed_file_name = hash('sha256', $file_name.$time) . $file_ext;

            rename($data['upload_data']['full_path'], $data['upload_data']['file_path'] . $hashed_file_name);

            $push = [
                'id_indikator' => $id_indikator,
                'file_name' => $data['upload_data']['raw_name'],
                'file' => $hashed_file_name,
                'file_size' => $data['upload_data']['file_size'],
                'up_dt' => date("Y-m-d H:i:s"),
                'up_by' => $this->session->userdata('userid'),
            ];
            $this->db->insert('file_indikator',$push);
            $push['id'] = $this->db->insert_id();
            header('Content-Type: application/json');
            echo json_encode(['data' => $data, 'item' => $push]);
        }
    }

    public function import()
    {
        $path = $this->input->post('path');
        $id = $this->input->post('id');
        $uploaded_id_indikator = $this->input->post('uploaded_id_indikator');

        $import_file = FCPATH . ('uploads/').$path;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $file = $reader->load($import_file);
        $sheet = $file->getActiveSheet()->toArray(null, true, true, true);

        if($sheet[1]['A']==='Id Indikator' && $sheet[2]['A']==='Nama Indikator' && $sheet[3]['A']==='Satuan' && $sheet[4]['A']==='Sumber')
        {
            $id_indikator = $sheet[1]['B'];
            $satuan = isset($sheet[3]['B']) ? $sheet[3]['B'] : "";
            $sumber = $sheet[4]['B'];
            $row_data =$sheet[7]['A'];
            $versi = date("Y-m-d H:i:s");
            $nama_indikator ="";
            $keterangan ="";

            if (!$id_indikator || !$sumber || !$row_data) {
                $filePath = FCPATH . 'uploads/' . $path;
                if (file_exists($filePath)) {
                    unlink($filePath);
                    $this->db->delete('file_indikator',['id'=>$id]);
                    $message= ['status'=> 'error',
                                'message' => 'Format excel terdapat field kosong'];
                    header('Content-Type: application/json');
                    echo json_encode($message);
                    die;
                } else {
                    echo "File does not exist.";
                }
            }       
            
            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 6) {
                    if($row['A']){

                        $data = [
                            'wilayah' => $row['A'],
                            'tahun' => $row['B'],
                            'periode' => $row['C'],
                            'idperiode' => $row['B'] . $row['C'],
                            'nilai' => $row['D'],
                            'nasional' => $row['E'],
                            'target' => $row['F'],
                            't_m_rpjmn' => $row['G'],
                            't_rkpd' => $row['H'],
                            't_k_rkp' => $row['I'],
                            'versi' => $versi,
                            'satuan' => $satuan,
                            'sumber' => $sumber,
                            'id_indikator' => $id_indikator,
                            'nama_indikator' => $nama_indikator,
                            'keterangan' => $keterangan
                        ];
        
                        $this->db->where('wilayah', $data['wilayah']);
                        $this->db->where('tahun', $data['tahun']);
                        $this->db->where('periode', $data['periode']);
                        $this->db->where('id_indikator', $data['id_indikator']);
                        $query = $this->db->get('nilai_indikator');
        
                        if ($query->num_rows() > 0) {
                            $this->db->where('wilayah', $data['wilayah']);
                            $this->db->where('tahun', $data['tahun']);
                            $this->db->where('periode', $data['periode']);
                            $this->db->where('id_indikator', $data['id_indikator']);
                            $this->db->update('nilai_indikator', $data);
                        } else {
                            $this->db->insert('nilai_indikator', $data);
                        }
                        
                    }
                }
                $numrow++;
            }
        }else{
            $filePath = FCPATH . 'uploads/' . $path;
            if (file_exists($filePath)) {
                unlink($filePath);
                $this->db->delete('file_indikator',['id'=>$id]);
                $message= ['status'=> 'error',
                            'message' => 'Format excel tidak sesuai'];
                header('Content-Type: application/json');
                echo json_encode($message);
                die;
            } else {
                echo "File does not exist.";
            }
        }
    }

    public function hapus_upload() {
        $id = $this->input->post('id');
        $file = $this->db->query("SELECT file FROM file_indikator WHERE id='$id'")->row_array();
        $this->db->delete('file_indikator',['id'=>$id]);
        $filepath = './uploads/' . $file['file'];
        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }
    public function export_template($id)
    {
        $data_indikator = $this->db->query("SELECT * FROM indikator WHERE id=$id")->row_array();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $allborder = [
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        $warna_col = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
            ],
        ];

        $warna_kuning = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFF00',
                ],
            ],
        ];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        
        $sheet->setCellValue('A1','Id Indikator');
        $sheet->setCellValue('A2','Nama Indikator');
        $sheet->setCellValue('A3','Satuan');
        $sheet->setCellValue('A4','Sumber');
        
        $sheet->setCellValue('B1',$data_indikator['id']);
        $sheet->setCellValue('B2',$data_indikator['nama_indikator']);
        $sheet->setCellValue('B3',$data_indikator['satuan']);
        
        $sheet->getStyle('A1:B4')->applyFromArray($style_row);
        $sheet->getStyle('A1:B4')->applyFromArray($warna_col);
        $sheet->getStyle('A1:B4')->applyFromArray($allborder);
        $sheet->getStyle('B4:B4')->applyFromArray($warna_kuning);
        
        $sheet->setCellValue('A6','Wilayah');
        $sheet->setCellValue('B6','Tahun');
        $sheet->setCellValue('C6','Periode');
        $sheet->setCellValue('D6','Nilai Capaian');
        $sheet->setCellValue('E6','Capaian Nasional');
        $sheet->setCellValue('F6','Target');
        $sheet->setCellValue('G6','Target RPJMN');
        $sheet->setCellValue('H6','Target RKPD');
        $sheet->setCellValue('I6','Target Kewilayahan RKPD');
        $sheet->getStyle('A6:I6')->applyFromArray($style_col);
        $sheet->getStyle('A6:I6')->applyFromArray($warna_col);
        $sheet->getStyle('A7:I300')->applyFromArray($allborder);
        $sheet->getStyle('A7:I300')->applyFromArray($warna_kuning);
        
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

        $sheet->getStyle('C')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
        $sheet->getStyle('C6:C300')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        
        $sheet->setTitle($data_indikator['nama_indikator']); // nama sheet
        $filename = $data_indikator['nama_indikator'].'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"'); //nama file
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        
    }
    
}
