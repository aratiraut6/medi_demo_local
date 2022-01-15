<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	 public function __construct()
	{
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->model('master_model');
			$this->load->database();
	}
	public function index()
	{
		 // echo CI_VERSION;
		$this->load->view('customer_data');
		// echo 'Welcome CI3';
	}
	
	public function listing()
	{
		 // echo CI_VERSION;
		$this->load->view('customer_listing');
		// echo 'Welcome CI3';
	}
	
	public function do_upload()
	{
		$this->form_validation->set_rules('file_name', 'FileName', 'trim|required');
		$this->form_validation->set_rules('quote_no', 'Quote Number', 'trim|required|callback_Quote_no_exists');
		// $this->form_validation->set_rules('quote_no', 'Quote Number', 'trim|required');
		if (empty($_FILES['userfile']['name']))
		{
			$this->form_validation->set_rules('userfile', 'Document', 'required');
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->_page_data['quote_no'] =$this->input->post('quote_no');
			$this->_page_data['file_name'] =$this->input->post('file_name');
			$this->_page_data['userfile'] =$this->input->post('userfile');
			$this->load->view('customer_data',$this->_page_data);
			
		}else
		{
			// echo '<pre>'; print_r($_FILES);echo '</pre>';
			
			

			$filename=$_FILES['userfile']['name'];
			if($filename!='' && $_FILES["userfile"]["size"] > 0)
			{
				
				$data=array(
						'quote_no'=>$this->input->post('quote_no'),
						'file_name'=>$this->input->post('file_name'),
						'upload_file'=>$filename
												
					);
					//echo '<pre>'; print_r($data); echo '</pre>';exit;
					
				$table_name='customer';
				$last_insert_id = $this->master_model->insert_record($table_name,$data);
				
				$attachment_allowed_extensions='csv';
				$extension=	explode(',',$attachment_allowed_extensions);
				$userfile_extn = explode(".", strtolower($_FILES['userfile']['name']));	
				$upload_path = 'assets/uploads/';
				
				$config['upload_path']          = $upload_path;
				$config['allowed_types']        = implode('|',$extension);
				$config['max_size']             = '1048576';
				$config['max_width']  = 'NONE';
				$config['max_height']  = 'NONE';

				$config['file_name'] = $userfile_extn[0]."_".time().".".$userfile_extn[1];
					
				$member_file_name = $config['file_name'];
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				$member_file_path = $upload_path.$member_file_name;
				// echo '<br> member_file_path '.$member_file_path;
				move_uploaded_file($_FILES['userfile']['tmp_name'], $member_file_path);
				
				$filename=$member_file_path;
				
				$file = fopen($filename, "r");
				$row=1;
				while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
				{
					if($row == 1){ 
						$row++; continue; 
					}
					else
					{
						$gender = $importdata[5] =='Male' ? 'm' : 'f';
						$data = array(
							'customer_id' =>$last_insert_id,
							'employee_id' =>$importdata[0],
							'employee_name' =>$importdata[1],
							'relation' =>$importdata[2],
							'date_of_joining' =>date('Y-m-d', strtotime( $importdata[3] ) ),
							'date_of_birth' =>date('Y-m-d', strtotime( $importdata[4] ) ),
							'gender' =>$gender,
							'age' =>$importdata[6],
							'email' =>$importdata[7],
							'mobile' =>$importdata[8],

						);
						$message_data[] = $data;
					}	
					
				}
				$this->master_model->insert($message_data);
				$this->load->view('customer_listing');
			}
		
		}
	}
	
	 public function empList(){
     
     // POST data
     $postData = $this->input->post();
	 // echo "<pre>";
	 // print_r($postData);
	 // echo "</pre>";
     // Get data
     $data = $this->master_model->getEmployees($postData);

     echo json_encode($data);
  }
	
	
   
	function Quote_no_exists($quote_no){
		// echo 'quote_no '.$quote_no;
	  if ($this->master_model->checkQuote_no($quote_no) == false) {
		return true;
	  } else {
		// echo "quote already exist";  
		$this->form_validation->set_message('Quote_no_exists', 'This Quote Number already exist!');
		return false;
	  }
	}
}
