class License_model extends CI_Model {

    var $date_issued    = '';
    var $date_expiration = '';
    var $industry_type = '';
    var $fish_type = '';
    var $location = '';
    var $fishing_gear = '';
    var $payment_id_number = '';
    var $boat_registration_id = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    
    /*
    function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
    */

}