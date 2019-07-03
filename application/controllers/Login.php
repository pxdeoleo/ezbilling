<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        session_start();
        if(isset($_SESSION['user'])){
            redirect('main');
        }else{
            $this->load->view('login');
        } 
    }

    /* public function cerrar(){
        
    } */

}

/* End of file Main.php */
