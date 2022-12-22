<?php

require_once 'autoload.php';

require_once __DIR__.'/router.php';

  use run\Installer;
use app\Controllers\UsuariosController;
/*llamar  vista php */
//get('/', 'installer/installer.php');
/*enviar data por get ala  vista */
get('/user', '/app/views/user.php');

/**/
get('/user/$name/$last_name', 'views/full_name.php');


get('/product/$type/color/$color', 'product.php');

// A route with a callback
get('/generarcrud', function(){

$installer=new Installer();
$table ="usuarios";
$installer->lecturatabla($table);
});


get('/callback', function(){
$usuari=  new UsuariosController();

echo $usuari->mostrarUsuarios();

});


get('/callback/$name/$last_name', function($name, $last_name){
  echo "Callback executed. The full name is $name $last_name";
});


any('/404','views/404.php');
