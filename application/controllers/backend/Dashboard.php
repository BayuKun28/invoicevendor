<?php
class Dashboard extends CI_Controller{
/**
* Description of Controller
*
* @author https://aethershin.com
*/
	function __construct(){
		parent::__construct();
		error_reporting(0);
		if($this->session->userdata('logged') !=TRUE){
            $url=base_url('login_user');
            redirect($url);
        };
		$this->load->model('backend/Dashboard_model', 'dashboard_model');
		$this->load->model('Site_model','site_model');
		$this->load->helper('text');
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->library('upload');
	}
	function index(){

		$site = $this->site_model->get_site_data()->row_array();
        $data['site_title'] = $site['site_title'];
        $data['site_favicon'] = $site['site_favicon'];
        $data['images'] = $site['images'];
        $data['title'] = 'Dashboard';
        
		if($this->session->userdata('access')=='1') {
			if($this->session->userdata('access') != "1"){
				$url=base_url('login_user');
	            redirect($url);
			};
				$this->load->view('backend/menu',$data);
        		$this->load->view('backend/_partials/templatejs');
			$this->load->view('backend/v_dashboard',$data);
		} else {
	        $data['title'] = 'Dashboard';
	        	$this->load->view('backend/menu',$data);
        		$this->load->view('backend/_partials/templatejs');
			$this->load->view('backend/v_dashboard_karyawan',$data);
		}
	}
}