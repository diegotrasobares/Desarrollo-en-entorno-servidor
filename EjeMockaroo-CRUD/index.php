<?php
session_start();
define ('FPAG',10); // Número de filas por página
if (!isset($_SESSION['intentos'])){
    $_SESSION['intentos'] = 0;
}
if (!isset($_SESSION['login'])){
    $_SESSION['login'] = false;
}
if (!isset($_SESSION['campo'])){
    $_SESSION['campo'] = "id";
}

require_once 'app/helpers/util.php';
require_once 'app/config/configDB.php';
require_once 'app/models/Cliente.php';
require_once 'app/models/AccesoDatos.php';
require_once 'app/controllers/crudclientes.php';

//---- PAGINACIÓN ----
$midb = AccesoDatos::getModelo();
$totalfilas = $midb->numClientes();
if ( $totalfilas % FPAG == 0){
    $posfin = $totalfilas - FPAG;
} else {
    $posfin = $totalfilas - $totalfilas % FPAG;
}

if ( !isset($_SESSION['posini']) ){
  $_SESSION['posini'] = 0;
}
$posAux = $_SESSION['posini'];
//------------



ob_start(); // La salida se guarda en el bufer

if ($_SESSION['intentos']<3 && $_SESSION['login']==true){
    if ($_SERVER['REQUEST_METHOD'] == "GET" ){
        if (isset($_GET['sort'])){
             switch ($_GET['sort']) {
                 case "name"       : crudOrdenar("first_name"); break;
                 case "email": crudOrdenar("email"); break;
                 case "gender": crudOrdenar("gender"); break;
                 case "ip"    : crudOrdenar("ip_address"); break;
             }
        } 
        
        
        
        
         // Proceso las ordenes de navegación
         if ( isset($_GET['nav'])) {
             switch ( $_GET['nav']) {
                 case "Primero"  : $posAux = 0; break;
                 case "Siguiente": $posAux +=FPAG; if ($posAux > $posfin) $posAux=$posfin; break;
                 case "Anterior" : $posAux -=FPAG; if ($posAux < 0) $posAux =0; break;
                 case "Ultimo"   : $posAux = $posfin;
             }
             $_SESSION['posini'] = $posAux;
         }
      
         
     
          // Proceso las ordenes de navegación en detalles
         if ( isset($_GET['nav-detalles']) && isset($_GET['id']) ) {
          switch ( $_GET['nav-detalles']) {
             case "Siguiente": crudDetallesSiguiente($_GET['id']); break;
             case "Anterior" : crudDetallesAnterior($_GET['id']); break;
             case "Generar PDF": include("app/views/plantillaPDF.php"); break;
         }
          }
     
         // Proceso de ordenes de CRUD clientes
         if ( isset($_GET['orden'])){
             switch ($_GET['orden']) {
                 case "Nuevo"    : crudAlta(); break;
                 case "Borrar"   : crudBorrar   ($_GET['id']); break;
                 case "Modificar": crudModificar($_GET['id']); break;
                 case "Detalles" : crudDetalles ($_GET['id']);break;
                 case "Terminar" : crudTerminar(); break;
             }
         }
     } 
     // POST Formulario de alta o de modificación
     else {
         if (  isset($_POST['orden'])){
              switch($_POST['orden']) {
                  case "Nuevo"    : crudPostAlta(); break;
                  case "Modificar": crudPostModificar(); break;
                  case "Generar PDF" : crearPDF(); break;
                  case "Detalles":; // No hago nada
              }
         }
     }
     
     // Si no hay nada en la buffer 
     // Cargo genero la vista con la lista por defecto
     if ( ob_get_length() == 0){
         $db = AccesoDatos::getModelo();
         $posini = $_SESSION['posini'];
         $tvalores = $db->getClientes($posini,FPAG,$_SESSION['campo']);
         require_once "app/views/list.php";    
     }
} else {
    while ($_SESSION['login']==false){
        if ($_SERVER['REQUEST_METHOD'] == "POST" ){
                if (comprobarLogin($_POST['usuario'],$_POST['password'])){
                    $_SESSION['login']=true;
                    header("Location: index.php");
                } else {
                    $_SESSION['intentos']++;
                    
            }
            
        }
        break;
    }
    if ($_SESSION['intentos']>=3){
        echo "<H2>INTENTOS SUPERADOS,CIERRA EL NAVEGADOR :)</H2>";
    } else {
        include_once "app/views/login.php";
    }
    

    
    
}
$contenido = ob_get_clean();

// Muestro la página principal con el contenido generado
require_once "app/views/principal.php";



