<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
    }
    
     public function index()
    {
        $data['judul'] = 'Upload Indikator';
        $data['js']= 'assets/assets/js/js/updateindikator.js';

        $data['indikator'] = $this->db->query('SELECT I.*,COUNT(DISTINCT(NI.tahun)) AS jumlah_tahun, COUNT(DISTINCT(NI.wilayah)) AS jumlah_wilayah, COUNT(DISTINCT(NI.periode)) AS jumlah_periode, COUNT(NI.id) AS jumlah_data, min(NI.tahun) AS tahunawal, max(NI.tahun) AS tahunakhir FROM indikator I LEFT JOIN nilai_indikator NI ON I.id=NI.id_indikator WHERE I.bps="0" GROUP BY I.id')->result_array();
        
        $this->load->view('admin/inc/v_header',$data);
        $this->load->view('admin/inc/v_topbar');
        $this->load->view('admin/inc/v_leftside');
        $this->load->view('admin/main/v_uploadindikator');
        $this->load->view('admin/inc/v_rightside');
        $this->load->view('admin/inc/v_footer');
    }

    public function import()
    {
        $test = FCPATH . ('assets/test.xlsx');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $file = $reader->load($test);
        $sheet = $file->getActiveSheet()->toArray(null, true, true, true);

        echo '<pre>';
        var_dump($sheet);
        echo '</pre>';
    }
}
