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

    public function borrar_cliente($id=0)
    {
        core_cliente::borrar($id);
        redirect('main/clientes');
    }

    public function editar_cliente($id=0)
    {
        $this->load->view('edit_client',['id_cliente'=>$id]);      
    }

    public function usuarios()
    {
        $this->load->view('new_user');
    }

    public function borrar_usuario($id=0)
    {
        core_usuario::borrar($id);
        redirect('main/usuarios');
    }

    public function editar_usuario($id=0)
    {
        $this->load->view('edit_user',['id_usuario'=>$id]);      
    }


    public function cerrar_sesion(){
        session_start();
        session_destroy();
        redirect('login');
    }

}

/* End of file Main.php */
