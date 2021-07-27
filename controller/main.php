<?php
class ControllerMain extends Controller{
    public function index()
    {
        $this->load->model('some');

        $r = $this->model_some->get_data();

        //var_dump($r);
        $data = array();
        foreach ($r->rows as $a)
            $data['data'][] = $a;//echo '<br>'. $a['idName'] . ' : ' . $a['vcName'];

        $this->session->data['my'] = 'my';

        require DIR_APPLICATION . 'view/' . $this->language->dir . 'main.php';
    }
}