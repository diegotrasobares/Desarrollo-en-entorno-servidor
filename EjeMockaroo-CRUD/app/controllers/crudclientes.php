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
    $acceso=true;
    if ($db->checkEmail($cli->email)){
        echo "El email ya existe, no se puede dar de alta <br>";
        $acceso=false;
    }
        else if (!validarIP($cli->ip_address)){
            echo "La ip no es correcta, no se puede dar de alta <br>";
            $acceso=false;

            
        } 
        else if (!validarTelefono($cli->telefono)){
            echo "El telefono no es correcto, no se puede dar de alta <br>";
            $acceso=false;
        }
    if ($acceso) {
        $db->addCliente($cli);
    } else {
        $orden= "Nuevo";
        include_once "app/views/formulario.php";
    }

    
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
    $acceso=true;

    if (!validarIP($cli->ip_address)){
            echo "La ip no es correcta, no se puede dar de alta <br>";
            $acceso=false;

            
        } 
        else if (!validarTelefono($cli->telefono)){
            echo "El telefono no es correcto, no se puede dar de alta <br>";
            $acceso=false;
        }
    if ($acceso) {
        $db->modCliente($cli);
    } else {
        $orden= "Nuevo";
        include_once "app/views/formulario.php";
    }
    
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
function validarIP($ip){ 
        $ip = explode(".", $ip);
        $validada=true;

    if (count($ip) < 3) {
        $validada=false;

    }
    foreach ($ip as $octeto) {
        strval($octeto);
        if (!is_numeric($octeto)) {
            $validada=false;

        }
        if ($octeto < 0 || $octeto > 255) {
            $validada=false;

        }
    }
        return $validada;    
}
function validarTelefono($telefono){
    $validada=true;
    
    $formato = "/^[0-9]{3}-[0-9]{3}-[0-9]{3,4}$/";
    

    if (!preg_match($formato, $telefono)) {
        $validada=false;
    }
    return $validada;   
}

function comprobarFotoPerfil($id){
    $aux=0;

    $aux=str_pad($aux, 7, "0", STR_PAD_LEFT);
    $aux=substr($aux, 0, 8-strlen($id)).$id;
    $fichero2="app/uploads/".$aux.".jpg";
    $fichero="uploads/".$aux.".jpg";
    if (file_exists($fichero)) {
        return "<img src='$fichero' width='20' alt='Foto almacenada'>";
    }
    return "<img src='https://robohash.org/$id' width='20' alt='Foto perfil robot'>";
    
}
?>


