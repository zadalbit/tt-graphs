<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('chart_model');
	}
	
	public function index()
	{
		$this->load->helper('form');
		
		$this->load->view('chart/settings');
	}
	
	public function show()
	{
		$this->load->helper('form');
		
		$lines_arr = $this->chart_model->get_entries_by_date();
		$sorted_arr = array();
		$dc_arr = array();
		$i = 0;
		
		$start = DateTime::createFromFormat('m/d/Y', $this->input->post('startDate'));
		
		$end = DateTime::createFromFormat('m/d/Y', $this->input->post('endDate'));
		$end = $end->modify( '+1 day' ); 

		$interval = new DateInterval('P1D');
		$dateRange = new DatePeriod($start, $interval, $end);

		foreach ($dateRange as $date) {
		  $days[] = $date->format('Y-m-d');
		}

		foreach ($lines_arr as $key => $value) {
			
			if(isset($sorted_arr[$value->dc_id]))
			{
				if(in_array($value->datein, $sorted_arr[$value->dc_id], true))
				{
					$s_key = array_search($value->datein, $sorted_arr[$value->dc_id]);
					$sorted_arr[$value->dc_id][$s_key+1] += intval($value->amount);
				}
				else
				{
					$sorted_arr[$value->dc_id][] = $value->datein;
					$sorted_arr[$value->dc_id][] = intval($value->amount);
				}
			}
			else
			{
				$dc_arr[] = $value->dc_id;
				
				$sorted_arr[$value->dc_id][] = $value->datein;
				$sorted_arr[$value->dc_id][] = intval($value->amount);
			}
		}
		
		$shag = $this->input->post('shag');
		$shagNumber = 0;
		$classic_max = 0;
		
		for ($i = 1; $i <= count($days); $i++) {
			
			$tmp_arr = array();
			
			for ($k = 0; $k < count($dc_arr); $k++) {
				
				if($s_key = array_search($days[$i-1], $sorted_arr[$dc_arr[$k]]))
				{
					$curr_amount = $sorted_arr[$dc_arr[$k]][$s_key+1];
					
					if($classic_max < $curr_amount)
						$classic_max = $curr_amount;
				
					$tmp_arr[] = $curr_amount;
				}
				else
				{
					$tmp_arr[] = 0;
				}
			}
			
			$by_shag[$shagNumber][0] = $days[$i-1];
			$by_shag[$shagNumber][] = $tmp_arr;
			
			if (($i % $shag) == 0)
			{
				$shagNumber++;
			}
		}
		
		foreach ($by_shag as $key => $value) {
			$date = DateTime::createFromFormat('Y-m-d', $value[0]);
			$formated = $date->format('Y,n,j');
			
			$pieces = explode(",", $formated);
			$formated = $pieces[0].','.(intval($pieces[1])-1).','.$pieces[2];
			
			if($key==0)
			{
				$classic_row = "new Date($formated)";
				$row = "[new Date($formated)";
			}
			else
			{
				$classic_row .= ", new Date($formated)";
				$row .= ", [new Date($formated)";
			}
			
			$tmp_arr = array();
			
			for ($k = 0; $k < count($dc_arr); $k++) {
				$tmp_arr[$k] = 0;
			}
			
			foreach ($value as $k => $v) {
				if($k!=0)
				{
					foreach ($v as $id => $am) {
						$tmp_arr[$id] += $am;
					}
				}
			}
			
			for ($i = 0; $i < count($tmp_arr); $i++) {
				$row .= ",".$tmp_arr[$i];
			}
			
			$row .= "]";
		}
		
		$data['classic_mode'] = $classic_row;
		$data['classic_max'] = $classic_max;
		$data['points'] = $row;
		$data['shag'] = $shag;
		$data['dc_arr'] = $dc_arr;
		
		$this->load->view('chart/show', $data);
	}
}

/* End of file chart.php */
/* Location: ./application/controllers/chart.php */