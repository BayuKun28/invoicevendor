<?php
class Vendors_model extends CI_Model{
	
	var $tablevendors = 'vendors';
	var $column_search_cicil = array('id'); 
	var $tablelog = 'tbl_log';
	var $column_search_vendors = array('nama'); 
	var $order = array('id' => 'desc'); // default order 
	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		//add custom filter here
		if($this->input->post('nama'))
		{
			$this->db->like('nama', $this->input->post('nama'));
		}
		
		$this->db->from($this->tablevendors);
		$i = 0;
		foreach ($this->column_search_vendors as $item) 
		{
			if($_POST['search']['value']) 
			{
				if($i===0) 
				{	
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search_vendors) - 1 == $i) 
					$this->db->group_end(); 
			}
			$column_search_stock[$i] = $item; // set column array variable to order processing
			$i++;
		}
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_search_stock[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
		
		
	}

    function insert_vendor($data){
		$insert = $this->db->insert($this->tablevendors, $data);
		if($insert){
			return true;
		}
	}

    function insert_log_vendor($data2){
		$insert = $this->db->insert($this->tablelog, $data2);
		if($insert){
			return true;
		}
	}
	function get_datatables(){
		$this->db->order_by('id', 'desc');
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function count_all()
	{
		$this->db->from($this->tablevendors);
		return $this->db->count_all_results();
	}

    function get_new_id_ven(){
        
        $query = $this->db->query("SELECT max(id) as maxKode FROM vendors");

        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $result[] = $data;
            }
            return $result;
        }
                            
    }
    public function get_by_id($id_vendors)
	{
		$this->db->from($this->tablevendors);
		$this->db->where('id',$id_vendors);
		$query = $this->db->get();
		return $query->row();
	}
	public function update_entry($id, $data)
    {
        return $this->db->update('vendors', $data, array('id' => $id));
    }
	public function single_entry($id_vendors)
    {
        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->where('id', $id_vendors);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    public function update_lock($id_vendors, $data)
    {
        return $this->db->update('vendors', $data, array('id' => $id_vendors));
    }
    function delete_entry($id_vendors)
    {
        return $this->db->delete('vendors', array('id' => $id_vendors));
        
    }
    function import($data){
		$insert = $this->db->insert_batch('vendors', $data);
		if($insert){
			return true;
		}
	}
}

	
