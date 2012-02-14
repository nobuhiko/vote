<?
class Vote_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Model クラスのコンストラクタを呼び出す
        parent::__construct();

        $this->load->database();

        if (!$this->db->table_exists('vote')) {
            $this->load->dbforge();

            $fields = array(
                    'id' => array(
                        'type' => 'INTEGER',
                        'auto_increment' => TRUE
                        ),
                    'group_id' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100',
                        ),
                    'movie_id' => array(
                        'type' =>'INTEGER',
                        'constraint' => '8',
                        ),
                    'date' => array(
                        'type'  => 'DATE',
                        'NULL'  => false
                        ),
                    'create_date' => array(
                        'type'  => 'DATETIME',
                        'NULL'  => false
                        ),
                    );

            $this->dbforge->add_field($fields);
            $this->dbforge->create_table('vote', true);
        }
    }


    function insert_vote()
    {
        $data = array(
            'group_id'     => $this->input->post('group_id'),
            'movie_id'     => $this->input->post('movie_id'),
            'date'         => date('Y-m-d'),
            'create_date'  => date('Y-m-d H:i:s'),
        );

        $this->db->insert('vote', $data);
    }

    function results_vote()
    {
        $this->db->order_by("date, group_id, movie_id ");
        $this->db->group_by(array("date", "group_id", "movie_id"));

        $this->db->select('count(movie_id) as cnt, group_id, movie_id, date' );
        $this->db->from('vote');
        $query = $this->db->get();
        return $query;
    }
}
