<?php 
class Master_model extends CI_Model {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function insert_record($table_name,$data_array)             //insert data
	{
		$this->db->insert($table_name, $data_array); 
		$insert_id = $this->db->insert_id();
		return  $insert_id;		
	}
	function delete_record($table_name,$condition)             //delete data
	{
		$this->db->delete($table_name,$condition); 
	}
	function update_record($table_name,$data_array,$condition)  //update data
	{
		$this->db->update($table_name, $data_array, $condition);
	}
	function checkQuote_no($quote_no) {
		// echo 'quote_no '.$quote_no;
		$this->db->where('quote_no', $quote_no);
		$this->db->from('customer');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		}
		return false; 
	} 
	function insert($data)
	{
		$this->db->insert_batch('customer_details', $data);
	}
	
	function getEmployees($postData=null){

		 $response = array();

		 ## Read value
		 $draw = $postData['draw'];
		 $start = $postData['start'];
		 $rowperpage = $postData['length']; // Rows display per page
		 $columnIndex = $postData['order'][0]['column']; // Column index
		 $columnName = $postData['columns'][$columnIndex]['data']; // Column name
		 $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		 $searchValue = $postData['search']['value']; // Search value

		 ## Search 
		 $searchQuery = "";
		 if($searchValue != ''){
			$searchQuery = " (employee_name like '%".$searchValue."%' or email like '%".$searchValue."%' ) ";
		 }
		  ## Total number of records without filtering
		 $this->db->select('count(*) as allcount');
		 $records = $this->db->get('customer_details')->result();
		 $totalRecords = $records[0]->allcount;

		 ## Total number of record with filtering
		 $this->db->select('count(*) as allcount');
		 if($searchQuery != '')
			$this->db->where($searchQuery);
		 $records = $this->db->get('customer_details')->result();
		 $totalRecordwithFilter = $records[0]->allcount;

		 ## Fetch records
		 $this->db->select('*');
		 if($searchQuery != '')
			$this->db->where($searchQuery);
		 $this->db->order_by($columnName, $columnSortOrder);
		 $this->db->limit($rowperpage, $start);
		 $records = $this->db->get('customer_details')->result();

		 $data = array();

		 foreach($records as $record ){

			// $data[] = array( 
			   // "employee_name"=>$record->employee_name,
			   // "email"=>$record->email,
			   // "gender"=>$record->gender,
			   // "employee_id"=>$record->employee_id,
			   
			// );
			$data[] = array(
				$record->employee_id,			
			   $record->employee_name,
			   $record->relation,
			   $record->date_of_joining,
			   $record->date_of_birth,
			   $record->gender,
			   $record->age,
			   $record->email,
			   $record->mobile
			  
			   
			);	
		 }

		 ## Response
		 $response = array(
			"draw" => intval($draw),
			"recordsTotal" => $totalRecords,
			"recordsFiltered" => $totalRecordwithFilter,
			"data" => $data
		 );

		 return $response; 
   
	}
	
}	
?>