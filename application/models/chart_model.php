<?php
class Chart_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_entries_by_date()
    {
		$date = DateTime::createFromFormat('m/d/Y', $this->input->post('startDate'));
		$start = $date->format('Y-m-d');
		
		$date = DateTime::createFromFormat('m/d/Y', $this->input->post('endDate'));
		$end = $date->format('Y-m-d');
		
		return $this->db->select('*')->where('datein >=', $start)->where('datein <=', $end)->get('reservations')->result();
    }
}

/* End of file chart.php */
/* Location: ./application/models/chart.php */