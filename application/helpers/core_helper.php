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

    class core_usuario{
        static function guardar($usuario){
            $CI =& get_instance();
            if(isset($usuario['id_usuario']) && $usuario['id_usuario'] >0){
                $CI->db->where('id_usuario',$usuario['id_usuario']);
                $CI->db->update('usuarios', $usuario);
            }else{
            $CI->db->insert('usuarios',$usuario);
            }
        }

        static function borrar($id){
            $CI =& get_instance();
            $sql = "delete from usuarios where id_usuario=?";
            $CI->db->query($sql,[$id]);
            
        }

        static function usuario_x_id($id_usuario){
            $CI =& get_instance();
            $CI->db->where('id_usuario',$id_usuario);
            $rs= $CI->db->get('usuarios')->result_array();
            return $rs;
        }

        static function listado_usuario(){
            $CI =& get_instance();
    
            $rs= $CI->db->get('usuarios')->result();
            return $rs;
        }
    }

    class core_cliente{
        static function guardar($cliente){
            $CI =& get_instance();
            if(isset($cliente['id_cliente']) && $cliente['id_cliente'] >0){
                $CI->db->where('id_cliente',$cliente['id_cliente']);
                $CI->db->update('clientes', $cliente);
            }else{
            $CI->db->insert('clientes',$cliente);
            }
        }

        static function borrar($id){
            $CI =& get_instance();
            $sql = "delete from clientes where id_cliente=?";
            $CI->db->query($sql,[$id]);
            
        }

        static function cliente_x_id($id_cliente){
            $CI =& get_instance();
            $CI->db->where('id_cliente',$id_cliente);
            $rs= $CI->db->get('clientes')->result_array();
            return $rs;
        }

        static function listado_usuario(){
            $CI =& get_instance();
    
            $rs= $CI->db->get('clientes')->result();
            return $rs;
        }

    }



?>