<?php
class CekInvoice_model extends CI_Model{


	var $tableinvoice = 'invoice';
	var $column_search_invoice = array('invoice.id','invoice.kwitansi','invoice.nominal','invoice.tgl_pembayaran','invoice.status','invoice.id_vendor');


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		//add custom filter here
		if($this->input->post('kwitansi'))
		{
			$this->db->like('kwitansi', $this->input->post('kwitansi'));
		}
		if($this->input->post('status_pembayaran'))
		{
			$this->db->like('status', $this->input->post('status_pembayaran'));
		}
		$this->db->select('*,invoice.id as kode,invoice.status as status_pembayaran');
		$this->db->from('invoice');
		$i = 0;
		foreach ($this->column_search_invoice as $item)
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

				if(count($this->column_search_invoice) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}


	}
	function get_datatables(){

		$this->db->join( 'vendors', 'invoice.id_vendor = vendors.id' , 'left' );
		$this->db->order_by('invoice.id', 'desc');
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		// $this->db->last_query();
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
		$this->db->from($this->tableinvoice);
		return $this->db->count_all_results();
	}
	function get_all_vendors(){
		$this->db->select('vendors.*');
		$this->db->from('vendors');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query;
	}
	public function single_entry($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    public function get_by_id($id_invoice)
	{
		$this->db->select('invoice.*,vendors.nama as namavendor');
		$this->db->from('invoice');
		$this->db->join( 'vendors', 'invoice.id_vendor = vendors.id' , 'left' );
		$this->db->where('invoice.id',$id_invoice);
		$query = $this->db->get();
		return $query->row();
	}
	function insert_invoice($arraysql){
		$insert = $this->db->insert($this->tableinvoice, $arraysql);
		if($insert){
			return true;
		}
	}
   	public function update_entry($invoiceid, $ajax_data)
    {
        return $this->db->update('invoice', $ajax_data, array('id' => $invoiceid));
    }
	public function delete_entry($id)
    {
        return $this->db->delete('invoice', array('id' => $id));
    }

	function get_all_bukti(){

		$this->db->select('invoice.*');
		$this->db->from('invoice');
		$query = $this->db->get();
		return $query;
	}

}