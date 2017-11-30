<?php
class Chart_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_entries_by_date()
    {
		$start = $this->input->post('startDate'); 
		list($day, $month, $year) = sscanf($start, "%02d/%02d/%04d"); 
		$start="$year-$month-$day"; 
		
		$end = $this->input->post('endDate'); 
		list($day, $month, $year) = sscanf($end, "%02d/%02d/%04d"); 
		$end="$year-$month-$day"; 
		
		return $this->db->select('*')->where('datein >=', $start)->where('datein <=', $end)->get('reservations')->result();
    }
}

/* End of file chart.php */
/* Location: ./application/models/chart.php */