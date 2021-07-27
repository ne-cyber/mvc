<?php

class Session {
    public $data = array();
    public $expire = array();

    public $session_id;

    public function __construct($registry)
    {
        $this->db = $registry->get('db');
        register_shutdown_function('session_write_close');
        $this->expire = ini_get('session.gc_maxlifetime');
    }

    public function getId()
    {
        return $this->session_id;
    }

    public function start($session_id = '')
    {
        if(!$session_id)
        {
            if(function_exists('random_bytes'))
                $session_id = substr(bin2hex(random_bytes(26)), 0, 26);
            else
                $session_id = substr(bin2hex(openssl_random_pseudo_bytes(26)), 0, 26);
        }

        if(preg_match('/^[a-zA-Z0-9,\-]{22,52}$/', $session_id))
            $this->session_id = $session_id;
        else
            exit('Error: Invalid session ID!');

        $this->data = $this->read($session_id);

        return $session_id;
    }

    public function close()
    {
        $this->write($this->session_id, $this->data);
    }

    public function __destruct()
    {
        $this->write($this->session_id, $this->data);
    }

    public function __destory()
    {
        $this->destory($this->session_id);
    }


    public function read($session_id)
    {
        $query = $this->db->query("SELECT `data` FROM `" . "session` WHERE session_id = '" . $this->db->escape($session_id) . "' AND expire > " . (int)time());

        if($query->num_rows)
            return unserialize($query->row['data']);
        else
            return false;
    }

    public function write($session_id, $data)
    {
        $this->db->query("REPLACE INTO `session` SET `data` = '" . $this->db->escape(serialize($data)) . "', expire = '" . $this->db->escape(date('Y-m-d H:i:s', time() + $this->expire)) . "', session_id = '" . $this->db->escape($session_id) . "' ");
        return true;
    }

    public function destory($session_id)
    {
        $this->db->query("DELETE FROM `" . "session` WHERE session_id = '" . $this->db->escape($session_id) . "'");
        return true;
    }

    public function gc($expire)
    {
        $this->db->query("DELETE FROM `" . "session` WHERE expire < " . ((int)time() + $expire));
    }

}

?>