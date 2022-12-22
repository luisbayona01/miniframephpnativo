<?php
namespace run;
use config\Main;
define("Rootpath", dirname(__DIR__));



class Installer
{
    public function traertablas()
    { 
      $Main         = new Main(); 
      $sql          ="show TABLES";
      $query        = $Main->dbAbreDatabase($sql);
      $tablas       = array();
      while ($resultado = $Main->dbTrareGistro($query)) {
          $tablas[]=$resultado['Tables_in_prueba'];  //  colocar  aqui  si es  tables  in nombre de la bd  en mysql  
          
           
        }
      $tablas;
     } 
    
    public function lecturatabla($table)
    {
        $Main         = new Main();
        //$table = "empresa";
        $sql          = "describe " . $table;
        $query        = $Main->dbAbreDatabase($sql);
        $primary      = "";
        $camposupdate = "";
        $camposinsert = "";
        while ($resultado = $Main->dbTrareGistro($query)) {
            
            //print_r($resultado);
            if ($resultado['Key'] !== 'PRI') {
                $camposinsert .= $resultado["Field"] . ",";
            }
            if ($resultado['Key'] == 'PRI') {
                $primary .= $resultado["Field"];
            }
            $camposupdate .= $resultado["Field"] . ",";
        }
        
        $this->modelos($table, $camposinsert, $primary);
        $this->Controladores($table, $camposinsert, $primary);
        $this->listarvista($table, $camposupdate);
        $this->updatevista($table, $camposupdate);
    }
    public function escribirdirectorio($directorio, $contenido)
    {
        
        $fp = fopen($directorio, "w");
        //exit();
        fwrite($fp, $contenido);
        fclose($fp);
    }
    
    
    public function updatevista($table, $camposupdate)
    {   $tabla          = ucwords($table); 
        $directorioupdate = Rootpath . "/app/views/update" . $tabla . ".php";
        $html             = '

                        <div class="container">
                          <h2> update' . $table . '</h2><form>';
        
        $campos   = explode(",", substr($camposupdate, 0, -1));
        $formbody = "";
        foreach ($campos as $update) {
            
            $formbody .= '<div class="form-group">
                              <label for="email">' . $update . ':</label>
                              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                            </div>';
        }
        
        $htmlf = '<button type="button" class="btn btn-default">Submit</button>
                         </form>
                        </div>';
        
        $contenido = $html . $formbody . $htmlf;
        $this->escribirdirectorio($directorioupdate, $contenido);
    }
    
    public function listarvista($table, $camposupdate)
    {
        $tabla  = ucwords($table);
        $html   = '<html lang="en">
                        <head>
                          <title>Bootstrap Example</title>
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1">
                          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
                          <script src="./public/js/angular.min.js"></script>
                          <script src="./public/js/main.js"></script>
                        </head>
                        <body ng-app="myApp" ng-controller="myCtrl">';
        $campos = explode(",", substr($camposupdate, 0, -1));
        
        $tableresponsiveini = '<div class="container">
                           <h2>listar' . $tabla . '</h2>
                           <div class="table-responsive">
                            <table class="table">';
        $cabezerastable     = '<thead><tr>';
        $thini              = "";
        foreach ($campos as $e) {
            
            $thini .= '<th>' . $e . '</th>';
        }
        $cabezerastablefin = '</tr>
                         </thead>';
        $tbodyini          = '<tbody>
                  <tr>';
        $cuerpo            = '';
        foreach ($campos as $ex) {
            $cuerpo .= '<td>' . $ex . '</td>';
        }
        $tbodyfin = "</tr>
            </tbody>";
        
        
        $fntable = '</table>
                </div>';
        
        $htmlf = '<div id="myModalinsert" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">insert' . $tabla . ' </h4>
         </div>
       <div class="modal-body">
       <form>';
        //$this->escribirdirectorio($directoriovinser,$html);
        
        $formbody = "";
        foreach ($campos as $insert) {
            
            $formbody .= '<div class="form-group">
                           <label for="' . $insert . '">' . $insert . ':</label>
                <input type="text" class="form-control" id="' . $insert . '" placeholder="Enter ' . $insert . '" name="' . $insert . '">
                            </div>';
           
        }
        
        $formbody .= '</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>';
        
        
        
        $htmlfin = $formbody . '</div>
                        </body>
                        </html>';
        
        $contenido      = $html . $tableresponsiveini . $cabezerastable . $thini . $cabezerastablefin . $tbodyini . $cuerpo . $tbodyfin . $fntable . $htmlf . $htmlfin;
        $directoriolist = Rootpath . "/app/Views/" . $tabla . ".php";
        $this->escribirdirectorio($directoriolist, $contenido);
    }
    
    public function modelos($table, $camposinsert, $primary)
    {
        $tabla            = ucwords($table);
        $camposM          = explode(",", substr($camposinsert, 0, -1));
        $simbolo          = '$';
        $campoPOSt        = "";
        $campoThis        = "";
        $camposupdate     = "";
        $directoriomodelo = Rootpath . "/app/Models/" . $tabla . '.php';
      
        $phpM = "<?php 
         namespace app\Models;
         use config\Main;    
         class " . $tabla . "{  
         ";
            $phpM .= "protected " . $simbolo . $primary . ";\n";
         foreach ($camposM as $values) {
            
            
            $phpM .= "public " . $simbolo . $values . ";\n";

            
            }


        foreach ($camposM as $value) {
         $campo = ucwords($value);
            
            $phpM .= "public function  set" . $campo . "(" . $simbolo . $value . "){
          " . $simbolo . "this->" . $value . "=" . $simbolo . $value . ";

         }\n";
            $varthis = $simbolo . 'this->' . $value;
            $campoPOSt .= $value . ",";
            $campoThis .= '/".' . $varthis . '."/,';
            $camposupdate .= $value . "=" . '/".' . $varthis . '."/,';
        }
        
        $campothis    = substr($campoThis, 0, -1);
        $camposUpdate = substr($camposupdate, 0, -1);
        $campoP       = ucwords($primary);
        $varthisP     = $simbolo . 'this->' . $primary;
        $primaryKey   = '/".' . $varthisP . '."/';
        $sqlInsert    = $simbolo . 'sql="insert into'.$table.'(' . $campoPOSt . ') values(' . $campothis . ')"';
        $sqlUpdate    = $simbolo . 'sql="update set '.$camposUpdate.'where ' . $primary . '=' . $primaryKey . '"';
        $sqldelete    = $simbolo . 'sql=" delete  from '.$table.'where ' . $primary . '=' . $primaryKey . '"';
        $sqlbuscar    = $simbolo . 'sql=" select * from ' . $table . ' where ' . $primary . '=' . $primaryKey . '"';
        $phpM .= "
         public function set" . $campoP . "(" . $simbolo . $primary . "){
         " . $simbolo . "this->" . $primary . "= " . $simbolo . $primary . ";
        }  
        public function add" . $tabla . "(){
            " . $simbolo . "Main=new main();
            " . $sqlInsert . "; 
            " . $simbolo . "Query= " . $simbolo . "Main->dbAbreDatabase(" . $simbolo . "sql); 
             if(" . $simbolo . "Query){
               return true;    
             } else{
               return false;
             }
           }

        public function update" . $tabla . "(){
            " . $simbolo . "Main=new main();
            " . $sqlUpdate . "; 
            " . $simbolo . "Query= " . $simbolo . "Main->dbAbreDatabase(" . $simbolo . "sql); 
             if(" . $simbolo . "Query){
               return 1;    
             } else{
               return 0;
             }
           }
           public function delete" . $tabla . "(){
            " . $simbolo . "Main=new main();
            " . $sqldelete . "; 
            " . $simbolo . "Query= " . $simbolo . "Main->dbAbreDatabase(" . $simbolo . "sql); 
             if(" . $simbolo . "Query){
               return 1;    
             } else{
               return 0;
             }
           } 
           public function edit" . $tabla . "(){
            " . $simbolo . "Main=new main();
            " . $sqlbuscar . "; 
            " . $simbolo . "Query= " . $simbolo . "Main->dbAbreDatabase(" . $simbolo . "sql); 
             " . $simbolo . "rows=" . $simbolo . "Main->dbTrareGistro(" . $simbolo . "Query);
             return" . $simbolo . "rows;  
           } 

           public  function Listar_" . $tabla . "(){
           " . $simbolo . "Main=new main();
           " . $simbolo . "sql='SELECT * FROM " . $table . "';
          " . $simbolo . "Query=" . $simbolo . "Main->dbAbreDatabase(" . $simbolo . "sql);
           " . $simbolo . "data=array();
           while(" . $simbolo . "rows=" . $simbolo . "Main->dbTrareGistro(" . $simbolo . "Query)){
           " . $simbolo . "data[]=" . $simbolo . "rows;
          
           }
          
            return " . $simbolo . "data;
           }    


       }";
        
        
        $phpM = str_replace("/", "'", $phpM);
       
        
        $this->escribirdirectorio($directoriomodelo, $phpM);
    }
      public   function   Controladores($table, $camposinsert, $primary){
        $simbolo          = '$';
        $tabla            = ucwords($table);
        $camposM          = explode(",", substr($camposinsert, 0, -1));
        $namespaces='app\Models\ '.$tabla;
        $eliminadoespacio= trim($namespaces);
        $modelo=$simbolo."Modelo".$tabla."="."new ".$tabla."();"; 

          $phpController="<?php 
                      namespace app\Controllers;\n
                      use ".$eliminadoespacio."\n;
                      class ".$tabla."Controller {
                       ";

          $phpController.="Public   static function add".$tabla."(){
           ".$modelo."\n
            ";
           

          foreach ($camposM as $post) {
                $campo = ucwords($post);
                $phpController.=$simbolo.$post."=".$simbolo.'_POST'."["."'".$post."'"."]; "."\n"; 
                $phpController.=$simbolo."Modelo".$tabla."->set".$campo."(".$simbolo.$post.");"."\n";  
             }

           $phpController.=$simbolo."respuesta;"."\n";  
           $phpController.="
            
           if(".$simbolo."Modelo".$tabla."->add".$tabla ."()== '1'){
                  ".$simbolo."respuesta='operacion exitosa';
                 }   

           ".$simbolo."Response=array('respuesta'=>".$simbolo."respuesta);
           ".$simbolo."json=json_encode(".$simbolo."Response);
          return ".$simbolo."json;
                 " 

                 ;

          $phpController.="}";              
          $phpController.= "public  static  function delete".$tabla."(){  ".$modelo.""."\n";
               
          $phpController.="}";   
          $phpController.=" public  static function  mostrar".$tabla."(){ \n ".$modelo.""."\n";
          $phpController.=$simbolo."Modelo".$tabla."->Listar_".$tabla ."();"."\n";
          $phpController.="}";   
          $phpController.="public  static function  edit".$tabla."(){\n ".$modelo."\n"; 
                        
          $phpController.="}";   

          $phpController.= "public  static function  update".$tabla."(){  ".$modelo."";
              foreach ($camposM as $post) {
                $campo = ucwords($post);
                $phpController.=$simbolo.$post."=".$simbolo.'_POST'."["."'".$post."'"."];\n"; 
                $phpController.=$simbolo."Modelo".$tabla."->set".$campo."(".$simbolo.$post.");\n";  
             }  
             $phpController.=$simbolo."Modelo".$tabla."->set".$primary."(".$simbolo.$primary.");\n";
             $phpController.=$simbolo."Modelo".$tabla."->update".$tabla ."();\n";   

          $phpController.="}";         
                      
          $phpController.="}";

           $directorioC = Rootpath . "/app/Controllers/" . $tabla .'Controller.php';    
           $this->escribirdirectorio($directorioC, $phpController);                     
      }
     

 

}
