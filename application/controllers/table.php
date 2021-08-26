<?php
defined('BASEPATH') or exit('No direct script access allowed');
class table extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('table');
    }
    public function index()
    {
        $this->load->view('table_vw');
    }
}
