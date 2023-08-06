<?php

class Inquiries{
//-----------------------------------------------------------
    public function index() {
        include('admin/views/head.php');
        include('admin/views/inquiries.php');
        include('admin/views/foot.php');
    }
//-----------------------------------------------------------
    public function get_inquiries() 
    {
        include('models/Inquiries_m.php');
        $inq = new Inquiries_m();
        $re = $inq->get_inquiries();
        echo json_encode($re);
    }
//-----------------------------------------------------------
}

?>