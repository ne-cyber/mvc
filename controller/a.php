<?php
class ControllerA extends Controller{
    public function index()
    {
        $this->load->model('a');

        $r = $this->model_a->get_otdeli();

        if(isset($_REQUEST['doGo']))
        {
            $this->model_a->save_sotrudniki();
        }

        $data = array();
        foreach ($r->rows as $a)
            $data['otdeli'][] = $a;

        require DIR_APPLICATION . 'view/' . $this->language->dir . 'a.php';
    }
}


?>