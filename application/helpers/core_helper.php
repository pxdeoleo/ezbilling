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

class core_articulo{
  
        static function guardar($articulo){ 
            $CI =& get_instance();
            
            if(isset($articulo['id_articulo']) && $articulo['id_articulo'] > 0){
                $CI->db->where('id_articulo',$articulo['id_articulo']);
                $CI->db->update('articulos',$articulo);
                
            }else{
                $CI->db->insert('articulos',$articulo);
                
            }
        }

        static function borrar($id){
            $CI =& get_instance();
            $sql = "delete from articulos where id_articulo=?";
            $CI->db->query($sql,[$id]);
            
        }

        static function articulo_x_id($id_articulo){
            $CI =& get_instance();
            $CI->db->where('id_articulo',$id_articulo);
            $rs= $CI->db->get('articulos')->result_array();
            return $rs;
        }

        static function listado_articulos(){
            $CI =& get_instance();
    
            $rs= $CI->db->get('articulos')->result();
            return $rs;
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

        static function listado_cliente(){
            $CI =& get_instance();
    
            $rs= $CI->db->get('clientes')->result();
            return $rs;
        }
    }

    class core_factura{
        static function factura_x_id($id_factura){
            $CI =& get_instance();
            $CI->db->where('id_factura',$id_factura);
            $rs= $CI->db->get('facturas')->result_array();
            return $rs;
        }

        static function listado_factura(){
            $CI =& get_instance();
    
            $rs= $CI->db->get('facturas')->result();
            return $rs;
        }
        
    }

    class core_ventas{
        
    }