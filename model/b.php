<?php
class ModelB extends Model {
    public function delete()
    {
        return $this->db->query("DELETE FROM `otdeli` WHERE id = '". $_REQUEST['id'] ."'");
    }

    public function add()
    {
        $this->db->query("INSERT INTO `otdeli` (`otdel`) VALUES ('". $_REQUEST['otdl'] . "')");
    }

    public function get_otdeli()
    {
        return $this->db->query("SELECT * FROM `otdeli`");
    }
}
?>