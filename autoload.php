<?php


define ('ROOT',dirname(__FILE__));
//define ('ROOT',$_SERVER["DOCUMENT_ROOT"]."/namespaces");

define('DS',DIRECTORY_SEPARATOR);

spl_autoload_register('autoload');

function Autoload($class){

$class = ROOT.DS.str_replace("\\",DS, $class).'.php';
if(!file_exists($class)){
	
throw new Exception(" error al cargar  las  clase".$class);
}
//echo "la.." .$class;
 
require_once($class);

}

?>