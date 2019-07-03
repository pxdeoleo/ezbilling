<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index()
    {
        session_start();
        if(isset($_SESSION['user'])){
            $this->load->view('inicio');
        }else{
            redirect('login');
        } 
    }

    public function inicio()
    {
        $this->load->view('inicio');
    }

    public function articulos()
    {
        $this->load->view('new_art');
    }

    public function clientes()
    {
        $this->load->view('new_client');
    }

    public function cerrar_sesion(){
        session_start();
        session_destroy();
        redirect('login');
    }

}

/* End of file Main.php */
