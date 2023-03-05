<?php
class Master_vendor extends CI_Controller{

	function __construct(){
		parent::__construct();
		error_reporting(0);
		if($this->session->userdata('access') != "3" && $this->session->userdata('access') != "1"){
			$url=base_url('/');
            redirect($url);
		};
		$this->load->model('backend/Vendors_model','vendors_model');
		$this->load->model('Site_model','site_model');
		$this->load->library('upload');
		$this->load->helper('text');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('download');
		$this->load->helper('tanggal');
		$this->load->library(array('excel','session'));
	}

	public function index(){
		$site = $this->site_model->get_site_data()->row_array();
        $data['site_title'] = $site['site_title'];
        $data['site_favicon'] = $site['site_favicon'];
        $data['images'] = $site['images'];
		$data['title'] = 'Master Vendors';

        $this->load->view('backend/menu',$data);
		
		$this->load->view('backend/modal/vendors_modal');
		$this->load->view('backend/_partials/templatejs');
		$this->load->view('backend/v_vendors', $data);
	}
	public function get_ajax_list()
	{
		$list = $this->vendors_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $d->id;
			$row[] = $d->nama;
				$row[] = '<div class="btn-group mb-1"><div class="dropdown"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opsi</button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
				<a class="dropdown-item" href="javascript:void()" title="Edit" onclick="edit_vendor('."'".$d->id."'".')"><i class="bi bi-pen-fill"></i> Edit</a><a class="dropdown-item" href="javascript:void()" title="Hapus" id="deletevendor" value="'.$d->id.'"><i class="bi bi-trash"></i> Hapus</a></div></div></div>';
			$data[] = $row;
		}
			
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->vendors_model->count_all(),
						"recordsFiltered" => $this->vendors_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
			
		echo json_encode($output);
	}
  	function download(){
		$path="assets/files/FormatVendors.xlsx";
		$data =  file_get_contents($path);
		$name = 'FormatVendors.xlsx';
		force_download($name, $data); 
		redirect('backend/Master_vendor');
	}
	public function ajax_edit($id_vendor)
	{
		$data = $this->vendors_model->get_by_id($id_vendor);
		echo json_encode($data);
	}
	function add(){
		$this->_validate();
		
		
		$users = $this->session->userdata('id');
		$nama_users = $this->session->userdata('name');
				$data = array(
					'nama' => $this->input->post('nama')
				);
				$insert = $this->vendors_model->insert_vendor($data);
				
				if($insert){
					// INSERT LOG
					
					$j = $this->input->post('nama');
					$b = '<b>'.$nama_users.'</b> Melakukan Tambah Vendor <b>'.$j.'</b>';
					$data2 = array(
						'ket' => $b,
					);
					$this->vendors_model->insert_log_vendor($data2);
					// INSERT LOG
					echo json_encode(array("status" => TRUE));
				}else{
					echo json_encode(array("status" => FALSE));
				}
			
		
	}



	function edit(){
		$id=$this->input->post('id',TRUE);
		$this->_validate_edit();
					$users = $this->session->userdata('id');
					$ajax_data['nama'] = $this->input->post('nama');

					if ($this->vendors_model->update_entry($id, $ajax_data)) {
						// INSERT LOG
						$nama_users = $this->session->userdata('name');

						$j = $this->input->post('nama');
						$b = '<b>'.$nama_users.'</b> Melakukan Edit Vendors <b>'.$j.'</b>';
						$data2 = array(
							'ket' => $b,
						);
						$this->vendors_model->insert_log_vendor($data2);
						// INSERT LOG
						echo json_encode(array("status" => TRUE));
					} else {
						echo json_encode(array("status" => FALSE));
					}
	}

	
	public function deletevendor()
	{
		if ($this->input->is_ajax_request()) {

			$id_vendor = $this->input->post('idkon');

			
			
				if ($this->vendors_model->delete_entry($id_vendor)) {
					
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
		$nama = $this->input->post('nama');

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Form Nama harus berisi';
			$data['status'] = FALSE;
		}

		$namalength= strlen($nama);
		if($namalength < 3)
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Miminal 3 Karakter';
			$data['status'] = FALSE;
		}
		if($namalength > 25)
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Maksimal 25 Karakter';
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

		$nama = $this->input->post('nama');
		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Form Nama harus berisi';
			$data['status'] = FALSE;
		}

		$namalength= strlen($nama);
		if($namalength < 3)
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Miminal 3 Karakter';
			$data['status'] = FALSE;
		}
		if($namalength > 25)
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Maksimal 25 Karakter';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	function import(){
		$allowed_excel_extension = array(
	        "xls",
	        "xlsx",
	    );
	    $file_extension_excel_1 = pathinfo($_FILES["fileExcel"]["name"], PATHINFO_EXTENSION);
		if (!in_array($file_extension_excel_1, $allowed_excel_extension)) {
	        echo $this->session->set_flashdata('msg','falied-import-ekstensi');
			redirect('backend/Master_vendor');
	    } else {


					// BATAS IMPORT MYSQL
					if (isset($_FILES["fileExcel"]["name"])) {
						$path = $_FILES["fileExcel"]["tmp_name"];
						$object = PHPExcel_IOFactory::load($path);
							
						foreach($object->getWorksheetIterator() as $worksheet)
						{
							// GET NEW ID
							$get_new_id = $this->vendors_model->get_new_id_ven();
					        foreach($get_new_id as $result){
					            $kode_New_id =  $result->maxKode;
					        }
					        $noUrut = (int) substr($kode_New_id, 4, 12);
					        $noUrut++;
					        $char = "CST-";
					        $NewID = $char.str_pad($noUrut, 12, '0', STR_PAD_LEFT);
							// GET NEW ID
							$highestRow = $worksheet->getHighestRow();
							$highestColumn = $worksheet->getHighestColumn();	
							for($row=2; $row<=$highestRow; $row++)
							{
								
								
								$nama = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
								
								$user_level = 1;
								
								$id_users = $this->session->userdata('id');
								$temp_data[] = array(
									'id'	=> $NewID++,
									'nama'	=> $nama
								); 
									
							}
						}
							$this->load->model('backend/Vendors_model');
							$insert = $this->vendors_model->import($temp_data);
						if($insert){
							echo $this->session->set_flashdata('msg','success-import');
							redirect('backend/Master_vendor');
						}else{
							echo $this->session->set_flashdata('msg','falied-import-mysql');
							redirect('backend/Master_vendor');
						}
					}else{
						echo $this->session->set_flashdata('msg','falied-import-mysql');
						redirect('backend/Master_vendor');
					}
					// BATAS IMPORT MYSQL
		}
				
    }

}