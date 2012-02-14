<?php
class Vote extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        // これ以降にコードを書いていく
    }

    public function index()
    {

        $group_A = range(1,10);
        $group_B = range(1,10);
        $group_C = range(1,10);

        $data = array(
                'title'         => 'My Title',
                'heading'       => 'My Heading',
                );

        $data['movie_list'] = array(
                    'A' => $group_A,
                    'B' => $group_B,
                    'C' => $group_C,
        );

        $this->load->model('Vote_model');

		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->library('form_validation');

        $this->form_validation->set_rules('group_id', 'グループ', 'required|alpha_numeric|xss_clean');
        $this->form_validation->set_rules('movie_id', '動画', 'required|alpha_numeric|xss_clean');

		if ($this->form_validation->run() == FALSE
            || $this->input->cookie('group_'.$this->input->post('group_id')) == true
        ) {
            $this->load->view('voteview', $data);
		} else {

            $RestTimeofDate = (24*60*60) - (time()+9*3600) % (24*60*60);

            $cookie = array(
                'name'   => $this->input->post('group_id'),
                'value'  => '1',
                'expire' => $RestTimeofDate,
                'prefix' => 'group_',
            );

            // dbに登録
            $this->Vote_model->insert_vote();

            $this->input->set_cookie($cookie);
			$this->load->view('success');
		}
    }
}
