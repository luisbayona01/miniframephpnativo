<?php 
namespace config;
        //include_once(dirname(__FILE__).'/conf.cnf');
	use mysqli;
        class Main{ 
						public $_servidor='localhost';
						protected $_pass='';
						protected $_bd='prueba';
						public  $_user='root';   
                       protected  $_db;
			
				public function __construct() 
				{
				
		     $this->_db = new mysqli($this->_servidor,$this->_user,$this->_pass,$this->_bd); 
				   if ( $this->_db->connect_errno ) 
					{ 
				 echo "Fallo al conectar a MySQL: ".$this->_db->connect_error; 
						return;     
			   } 
				$this->_db->set_charset('utf-8'); 
				} 
				
				 public   function TrasactcomitStart(){
				  $this->_db->autocommit(FALSE);
                  }
                public  function Commit(){

                	$this->_db->commit();
                }
                    
				public   function dbAbreDatabase($sql){
				$resultado=$this->_db->query($sql)or die($this->_db->error); ; 	
					return $resultado;	
				}
				public   function dbTrareGistro($resultado) 
				{ 
				  return  mysqli_fetch_array($resultado, MYSQLI_ASSOC);
				  $this->_db->set_charset('utf-8');
			   }
				public   function dbnumField($res){
					return mysqli_num_fields($res);	
					}
				public   function numeroDeCampos($res){
				return mysqli_num_rows($res);	
					}
				public   function dbNombreCampo($res){
				 return	mysqli_fetch_field($res);	
				}
				
			
				public  function  __destruct(){
				mysqli_close($this->_db);  
				
				
					}
		

			
	}

 ?>