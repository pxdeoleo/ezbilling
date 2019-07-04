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

?>