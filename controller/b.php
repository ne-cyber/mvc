<?php
class ControllerB extends Controller{
    public function index()
    {
        $this->load->model('b');

        if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')
        {
            $this->model_b->delete();
        }

        if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add')
        {
            $this->model_b->add();
        }

        $r = $this->model_b->get_otdeli();

        $data = array();
        $data['otdeli'] = array();
        foreach ($r->rows as $a)
            $data['otdeli'][] = $a;



        require DIR_APPLICATION . 'view/' . $this->language->dir . 'b.php';
    }
}

