<?php
class ModelSome extends Model {
    public function get_data()
    {
        return $this->db->query("SELECT * FROM `names`");
    }
}