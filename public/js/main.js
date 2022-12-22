



var app = angular.module("myApp", []);

app.controller("myCtrl", function($scope,$http) {


  $scope.Guardar=function(){

var url=" "; // url o ruta 
var  parametros=$("").serialize();  // seraliza form 
$http({
  method  : 'POST',
  url     : url,
  data    : parametros,  // pass in data as strings
  headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
 
   }).success(function(response){
           
		  //alert(response);
  
  $scope.listar();
		  //$scope.supervisor=response;
		   
        });





  }



$scope.listuser=function(){
var url="http://localhost/axitys/index.php/usuarios/listardata/";
   $http({
   method  : 'POST',
    url     : url,
   }).success(function(response){
           
    $scope.usuarios=response;

      //$scope.supervisor=response;
       
        });




}
$scope.Save=function(){

var url="http://localhost/axitys/index.php/inventarios/update";
var  parametros=$(".updateinventarios").serialize();
$http({
  method  : 'POST',
  url     : url,
  data    : parametros,  // pass in data as strings
  headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
 
   }).success(function(response){
           
      alert(response);
  
  $scope.listar();
      //$scope.supervisor=response;
       
        });

  
}
$scope.Editar=function(idinventarios){




//$("").
//alert(idinventarios);
var url="http://localhost/axitys/index.php/inventarios/listedit";
var  parametros=$.param({'idinventarios':idinventarios});
$http({
  method  : 'POST',
  url     : url,
  data    : parametros,  // pass in data as strings
  headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
 
   }).success(function(response){
           
      //alert(response);

$("#myModal2").modal();
 $(".contenido").html(response); 
  //$scope.listar();
      //$scope.supervisor=response;
       
        });

  
}


$scope.Eliminar=function(idinventarios){

var url="http://localhost/axitys/index.php/inventarios/delete";
var  parametros=$.param({'idinventarios':idinventarios});
$http({
  method  : 'POST',
  url     : url,
  data    : parametros,  // pass in data as strings
  headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
 
   }).success(function(response){
           
      alert(response);
  
  $scope.listar();
      //$scope.supervisor=response;
       
        });


}


$scope.editarU=function(idusuarios){
var url="http://localhost/axitys/index.php/usuarios/listdateedit";
var  parametros=$.param({'idusuarios':idusuarios});
$http({
  method  : 'POST',
  url     : url,
  data    : parametros,  // pass in data as strings
  headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
 
   }).success(function(response){
           
      //alert(response);

$("#myModal2").modal();
 $(".contenido").html(response); 
  //$scope.listar();
      //$scope.supervisor=response;
       
        });


}

$scope.savecambios=function(){ 
var url="http://localhost/axitys/index.php/usuarios/update";
var  parametros=$(".updateusuarios").serialize();
$http({
  method  : 'POST',
  url     : url,
  data    : parametros,  // pass in data as strings
  headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
 
   }).success(function(response){
           
      alert(response);
  
  $scope.listuser();
      //$scope.supervisor=response;
       
        });

}

$scope.guardarUsuario=function(){
var url="http://localhost/axitys/index.php/usuarios/insert";
var  parametros=$(".registrarusuarios").serialize();
$http({
  method  : 'POST',
  url     : url,
  data    : parametros,  // pass in data as strings
  headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
 
   }).success(function(response){
           
      alert(response);
  
  $scope.listuser();
      //$scope.supervisor=response;
       
        });



}
$scope.listar=function(){

var url="http://localhost/axitys/index.php/inventarios/listar";

$http({
  method  : 'POST',
  url     : url,
   }).success(function(response){
           
    $scope.inventario=response;

      //$scope.supervisor=response;
       
        });



}

$(".cuentas").change(function() {
var archivos=document.getElementById('cuentas');
 
 
$(".form-control.namearchivo").val(archivos.files[0].name)

});
$(".btn.btn-info.cargar").click(function() {
var formData = new FormData();
var archivos=document.getElementById('cuentas');
formData.append('fiiles',archivos.files[0]);


 $.ajax({
            url: 'http://localhost/axitys/index.php/inventarios/uploadinventario/',  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
           beforeSend: function() {//FunciÃ³n que se ejecuta antes de enviar los datos
    
   },
            //una vez finalizado correctamente
            success: function(data){
         
         alert(data);
         
         /*.fadeOut(10000)*/;
               
         
            },
            //si ha ocurrido un error
            error: function(){
               
            }
        });



});
	
	$scope.listar();

	$scope.listuser();

	


})




