<?php 
         namespace app\Models;
         use config\Main;    
         class Usuarios{  
         protected $identificacion;
public $razonsocial;
public $personacontacto;
public $direccion;
public $telefono;
public $ciudad;
public $departamento;
public $cupootorgado;
public $Activo;
public function  setRazonsocial($razonsocial){
          $this->razonsocial=$razonsocial;

         }
public function  setPersonacontacto($personacontacto){
          $this->personacontacto=$personacontacto;

         }
public function  setDireccion($direccion){
          $this->direccion=$direccion;

         }
public function  setTelefono($telefono){
          $this->telefono=$telefono;

         }
public function  setCiudad($ciudad){
          $this->ciudad=$ciudad;

         }
public function  setDepartamento($departamento){
          $this->departamento=$departamento;

         }
public function  setCupootorgado($cupootorgado){
          $this->cupootorgado=$cupootorgado;

         }
public function  setActivo($Activo){
          $this->Activo=$Activo;

         }

         public function setIdentificacion($identificacion){
         $this->identificacion= $identificacion;
        }  
        public function addUsuarios(){
            $Main=new main();
            $sql="insert intousuarios(razonsocial,personacontacto,direccion,telefono,ciudad,departamento,cupootorgado,Activo,) values('".$this->razonsocial."','".$this->personacontacto."','".$this->direccion."','".$this->telefono."','".$this->ciudad."','".$this->departamento."','".$this->cupootorgado."','".$this->Activo."')"; 
            $Query= $Main->dbAbreDatabase($sql); 
             if($Query){
               return true;    
             } else{
               return false;
             }
           }

        public function updateUsuarios(){
            $Main=new main();
            $sql="update set razonsocial='".$this->razonsocial."',personacontacto='".$this->personacontacto."',direccion='".$this->direccion."',telefono='".$this->telefono."',ciudad='".$this->ciudad."',departamento='".$this->departamento."',cupootorgado='".$this->cupootorgado."',Activo='".$this->Activo."'where identificacion='".$this->identificacion."'"; 
            $Query= $Main->dbAbreDatabase($sql); 
             if($Query){
               return 1;    
             } else{
               return 0;
             }
           }
           public function deleteUsuarios(){
            $Main=new main();
            $sql=" delete  from usuarioswhere identificacion='".$this->identificacion."'"; 
            $Query= $Main->dbAbreDatabase($sql); 
             if($Query){
               return 1;    
             } else{
               return 0;
             }
           } 
           public function editUsuarios(){
            $Main=new main();
            $sql=" select * from usuarios where identificacion='".$this->identificacion."'"; 
            $Query= $Main->dbAbreDatabase($sql); 
             $rows=$Main->dbTrareGistro($Query);
             return$rows;  
           } 

           public  function Listar_Usuarios(){
           $Main=new main();
           $sql='SELECT * FROM usuarios';
          $Query=$Main->dbAbreDatabase($sql);
           $data=array();
           while($rows=$Main->dbTrareGistro($Query)){
           $data[]=$rows;
          
           }
          
            return $data;
           }    


       }