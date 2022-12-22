<?php
namespace app\Controllers;

use app\Models\Usuarios;
class UsuariosController
{
    Public static function addUsuarios()
    {
        $ModeloUsuarios = new Usuarios();
        
        $razonsocial = $_POST['razonsocial'];
        $ModeloUsuarios->setRazonsocial($razonsocial);
        $personacontacto = $_POST['personacontacto'];
        $ModeloUsuarios->setPersonacontacto($personacontacto);
        $direccion = $_POST['direccion'];
        $ModeloUsuarios->setDireccion($direccion);
        $telefono = $_POST['telefono'];
        $ModeloUsuarios->setTelefono($telefono);
        $ciudad = $_POST['ciudad'];
        $ModeloUsuarios->setCiudad($ciudad);
        $departamento = $_POST['departamento'];
        $ModeloUsuarios->setDepartamento($departamento);
        $cupootorgado = $_POST['cupootorgado'];
        $ModeloUsuarios->setCupootorgado($cupootorgado);
        $Activo = $_POST['Activo'];
        $ModeloUsuarios->setActivo($Activo);
        $respuesta = "";
        
        
        if ($ModeloUsuarios->addUsuarios() == '1') {
            $respuesta = 'operacion exitosa';
        }
        
        $Response = array(
            'respuesta' => $respuesta
        );
        $json     = json_encode($Response);
        return $json;
    }
    public static function deleteUsuarios()
    {
        $ModeloUsuarios = new Usuarios();
    }
    public static function mostrarUsuarios()
    {
        $ModeloUsuarios = new Usuarios();
       $dta= $ModeloUsuarios->Listar_Usuarios();
       return json_encode($dta);
    }
    public static function editUsuarios()
    {
        $ModeloUsuarios = new Usuarios();
    }
    
    public static function updateUsuarios()
    {
        $ModeloUsuarios = new Usuarios();
        $razonsocial    = $_POST['razonsocial'];
        $ModeloUsuarios->setRazonsocial($razonsocial);
        $personacontacto = $_POST['personacontacto'];
        $ModeloUsuarios->setPersonacontacto($personacontacto);
        $direccion = $_POST['direccion'];
        $ModeloUsuarios->setDireccion($direccion);
        $telefono = $_POST['telefono'];
        $ModeloUsuarios->setTelefono($telefono);
        $ciudad = $_POST['ciudad'];
        $ModeloUsuarios->setCiudad($ciudad);
        $departamento = $_POST['departamento'];
        $ModeloUsuarios->setDepartamento($departamento);
        $cupootorgado = $_POST['cupootorgado'];
        $ModeloUsuarios->setCupootorgado($cupootorgado);
        $Activo = $_POST['Activo'];
        $ModeloUsuarios->setActivo($Activo);
        $identificacion = $_POST['identificacion'];
        $ModeloUsuarios->setidentificacion($identificacion);
        $ModeloUsuarios->updateUsuarios();
    }
    



}