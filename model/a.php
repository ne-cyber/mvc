<?php
class ModelA extends Model {
    public function get_otdeli()
    {
        return $this->db->query("SELECT * FROM `otdeli`");
    }

    public function save_sotrudniki()
    {
        $this->db->query("INSERT INTO `sotrudniki` (`email`, `name`, `adress`, `telefon`, `coment`, `otdel`) VALUES (
                '{$_REQUEST['email']}', '{$_REQUEST['name']}', '{$_REQUEST['adress']}', '{$_REQUEST['telefon']}', '{$_REQUEST['coment']}', '{$_REQUEST['otdl']}'  )");

    }
}
?>