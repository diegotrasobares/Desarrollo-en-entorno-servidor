<?php

function crudBorrar ($id){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarCliente($id);
}

function crudTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
}
 
function crudAlta(){
    $cli = new Cliente();
    $orden= "Nuevo";
    include_once "app/views/formulario.php";
}

function crudDetalles($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    include_once "app/views/detalles.php";
}

function crudDetallesSiguiente($id){
    $id+=1;
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    include_once "app/views/detalles.php";
}

function crudDetallesAnterior($id){
    //comprobar que id es superior a 1
    if ($id>1){
        $id-=1;
    }

    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    include_once "app/views/detalles.php";
}


function crudModificar($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $orden="Modificar";
    include_once "app/views/formulario.php";
}

function crudPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $cli = new Cliente();
    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    $db = AccesoDatos::getModelo();
    $db->addCliente($cli);
    
}

function crudPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $cli = new Cliente();

    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    $db = AccesoDatos::getModelo();
    $db->modCliente($cli);
    
}

function crudOrdenar($campo){
    $_SESSION['campo']=$campo;
    $db = AccesoDatos::getModelo();
    $tvalores = $db->getClientes($_SESSION['posini'],FPAG,$_SESSION['campo']);
    include_once "app/views/list.php";
}

function mostrarBandera($ip){

    $pais=file_get_contents('http://ip-api.com/json/'.$ip.'?fields=countryCode');
    //coger solo el codigo del pais de $pais
    $pais=substr($pais,16,2);
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if($ipdat->geoplugin_countryCode == null) {
      echo "<img src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/Pirate_Flag.svg/2560px-Pirate_Flag.svg.png' width='20' alt='No hay bandera'>";
    } else {
        $codigo=$ipdat->geoplugin_countryCode;
        echo "<img src='https://flagcdn.com/".strtolower($codigo).".svg' width='10' alt='Bandera pais'>";
    }

}
    ?>


