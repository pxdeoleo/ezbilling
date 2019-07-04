<?php
    class core_sesion{
        static function verificar($usr, $psw){
            $CI =& get_instance();
            $rs = $CI->db
            ->get_where('usuarios', array(
                'usuario'=>$usr,
                'contrasena'=>$psw
            ))
            ->result_array();
            if($rs){
                return true;
            } else {
                return false;
            }
        }
        static function sesion(){
            if(!isset($_SESSION['user'])) {
                redirect('login');
              }
        }
    }

    class core_articulos{
        static function listado(){
            $CI =& get_instance();

            $rs = $CI->db->get('articulos')->result();

            return $rs;
        }
    }



?>