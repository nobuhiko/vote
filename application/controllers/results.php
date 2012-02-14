<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Results extends CI_Controller {

	public function index()
	{
        $this->load->model('Vote_model');

        $this->load->library('table');
        $data['query'] = $this->Vote_model->results_vote();

		$this->load->view('resultsview', $data);
	}
}
