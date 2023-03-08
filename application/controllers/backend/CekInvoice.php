<?php
class CekInvoice extends CI_Controller{
	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model('backend/CekInvoice_model','cekinvoice_model');
		$this->load->model('backend/Stock_model','stock_model');
		$this->load->model('backend/Absensi_model','absensi_model');
		$this->load->model('Site_model','site_model');
		$this->load->helper('text');
		$this->load->helper('url');
		$this->load->helper('tanggal');
		$this->load->library('upload');
		$this->load->helper('form');
	}

	public function index(){
		// echo "hello";
		$site = $this->site_model->get_site_data()->row_array();
        $x['site_title'] = $site['site_title'];
        $x['site_favicon'] = $site['site_favicon'];
        $x['images'] = $site['images'];
		$x['title'] = 'Cek Invoice Vendors';
		$this->load->view('backend/menu',$x);
		$this->load->view('backend/_partials/templatejs');
		$this->load->view('backend/v_CekInvoice',$x);
	}
	public function get_ajax_list()
	{
		$idvendor = $this->session->userdata('vendor');
		$list = $this->cekinvoice_model->get_datatables($idvendor);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $no;
            $row[] = $d->nama;
			$row[] = $d->kwitansi;
			$row[] = "Rp " . number_format($d->nominal, 0, "", ",");
			$row[] = format_indo(date($d->tgl_pembayaran));
			$row[] = $d->status;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->cekinvoice_model->count_all($idvendor),
						"recordsFiltered" => $this->cekinvoice_model->count_filtered($idvendor),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_edit($id_invoice)
	{
		$data = $this->cekinvoice_model->get_by_id($id_invoice);
		echo json_encode($data);
	}

	function add(){
		$nominal = $this->input->post('nominal',TRUE);
		$nominalshow = "Rp " . number_format($nominal, 0, "", ",");
		$users = $this->session->userdata('id');
		$id_vendor = $this->input->post('vendor',TRUE);
		$arraysql = array(
			"id_vendor" => $id_vendor,
			"kwitansi" => $this->input->post('kwitansi',TRUE),
			"nominal" => $this->input->post('nominal',TRUE),
			"tgl_pembayaran" => $this->input->post('tgl_pembayaran',TRUE),
			"status" => $this->input->post('kwitansi',TRUE)
		);
		$insert = $this->cekinvoice_model->insert_invoice($arraysql);

		if($insert){
			// INSERT LOG

			$nama_users = $this->session->userdata('name');
			$b = '<b>'.$nama_users.'</b> Menambah Invoice Sebesar <b>'.$nominalshow.'</b> Untuk Vendor '.$id_vendor;
			$data2 = array(
				'ket' => $b,
			);
			$this->stock_model->insert_log_stock($data2);
			// INSERT LOG
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}

    }


    function edit() {
    	$invoiceid=$this->input->post('id',TRUE);
		// $this->_validate_edit();

				$id = $this->input->post('id',TRUE);
	    		$nominal = $this->input->post('nominal',TRUE);
				$nominalshow = "Rp " . number_format($nominal, 0, "", ",");

				$post = $this->cekinvoice_model->single_entry($id);
				$nominal_lama = $post->nominal;
				$nominal_lama_show = "Rp " . number_format($nominal_lama, 0, "", ",");

				// INSERT LOG
				$nama_users = $this->session->userdata('name');
				$b = '<b>'.$nama_users.'</b> Mengubah Nominal Sebesar <b>'.$nominal_lama_show.' Menjadi '.$nominalshow.'</b> ';
				$data2 = array(
					'ket' => $b,
				);
				$this->stock_model->insert_log_stock($data2);
				// INSERT LOG


				$users = $this->session->userdata('id');

				$ajax_data['id_vendor'] = $this->input->post('vendor',TRUE);
				$ajax_data['kwitansi'] = $this->input->post('kwitansi',TRUE);
				$ajax_data['nominal'] = $this->input->post('nominal',TRUE);
				$ajax_data['status'] = $this->input->post('status',TRUE);
				$ajax_data['tgl_pembayaran'] = $this->input->post('tgl_pembayaran',TRUE);

				if ($this->cekinvoice_model->update_entry($invoiceid, $ajax_data)) {

					echo json_encode(array("status" => TRUE));
				} else {
					echo json_encode(array("status" => FALSE));
				}

    }
    public function delete() {
    	if ($this->input->is_ajax_request()) {

			$idkon = $this->input->post('idkon');


				if ($this->cekinvoice_model->delete_entry($idkon)) {

					$data = array('res' => "success", 'message' => "Proses berhasil dilakukan");
				} else {
					$data = array('res' => "error", 'message' => "Proses gagal dilakukan");
				}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
    }

    private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		$allowed_image_extension = array(
	        "png",
	        "jpg",
	        "jpeg",
	        "webp",
	    );
	    $file_extension_picture_1 = pathinfo($_FILES["picture_1"]["name"], PATHINFO_EXTENSION);
	    $ket = $this->input->post('ket');
		if($this->input->post('ket') == '')
		{
			$data['inputerror'][] = 'ket';
			$data['error_string'][] = 'Form Keterangan harus berisi';
			$data['status'] = FALSE;
		}
		$ketlength= strlen($ket);
		if($ketlength < 3)
		{
			$data['inputerror'][] = 'ket';
			$data['error_string'][] = 'Keterangan Minimal 3 karakter';
			$data['status'] = FALSE;
		}
		if($this->input->post('biaya') == '')
		{
			$data['inputerror'][] = 'biaya';
			$data['error_string'][] = 'Form Biaya harus berisi';
			$data['status'] = FALSE;
		}
		if (empty($_FILES['picture_1']['name'])) {
			$data['inputerror'][] = 'picture_1';
			$data['error_string'][] = 'Form Upload Bukti harus berisi';
			$data['status'] = FALSE;
		}
		if (($_FILES["picture_1"]["size"] > 5000000)) {
			$data['inputerror'][] = 'picture_1';
			$data['error_string'][] = 'Image size maksimal 5MB';
			$data['status'] = FALSE;
	    }
	    if (!in_array($file_extension_picture_1, $allowed_image_extension)) {
	        $data['inputerror'][] = 'picture_1';
			$data['error_string'][] = 'Format File *jpg,png,jpeg,webp';
			$data['status'] = FALSE;
	    }
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_edit()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		$allowed_image_extension = array(
	        "png",
	        "jpg",
	        "jpeg",
	        "webp",
	        "",
	    );
	    $file_extension_picture_1 = pathinfo($_FILES["picture_1"]["name"], PATHINFO_EXTENSION);
    	$ket = $this->input->post('ket');
		if($this->input->post('ket') == '')
		{
			$data['inputerror'][] = 'ket';
			$data['error_string'][] = 'Form Keterangan harus berisi';
			$data['status'] = FALSE;
		}
		$ketlength= strlen($ket);
		if($ketlength < 3)
		{
			$data['inputerror'][] = 'ket';
			$data['error_string'][] = 'Keterangan Minimal 3 karakter';
			$data['status'] = FALSE;
		}
		if($this->input->post('biaya') == '')
		{
			$data['inputerror'][] = 'biaya';
			$data['error_string'][] = 'Form Biaya harus berisi';
			$data['status'] = FALSE;
		}

		if (($_FILES["picture_1"]["size"] > 5000000)) {
			$data['inputerror'][] = 'picture_1';
			$data['error_string'][] = 'Image size maksimal 5MB';
			$data['status'] = FALSE;
	    }
	    if (!in_array($file_extension_picture_1, $allowed_image_extension)) {
	        $data['inputerror'][] = 'picture_1';
			$data['error_string'][] = 'Format File *jpg,png,jpeg,webp';
			$data['status'] = FALSE;
	    }
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}



}
