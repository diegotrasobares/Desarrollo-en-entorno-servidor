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
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteSiguiente($id);
    include_once "app/views/detalles.php";
}

function crudDetallesAnterior($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteAnterior($id);
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
        cambiarFotoPerfil($cli->id);
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
        cambiarFotoPerfil($cli->id);
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
function generarPDF($id) {
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    include_once "app/views/plantillaPDF.php";
}

function mostrarBandera($ip){

    $pais=file_get_contents('http://ip-api.com/json/'.$ip.'?fields=countryCode');
    
    $pais=substr($pais,16,2);
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if($ipdat->geoplugin_countryCode == null) {
        echo "<img src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/Pirate_Flag.svg/2560px-Pirate_Flag.svg.png' width='20' alt='No hay bandera'>";
    } else {
        $codigo=$ipdat->geoplugin_countryCode;
        echo "<img src='https://flagcdn.com/".strtolower($codigo).".svg' width='10' alt='Bandera pais'>";
    }
    
}

function obtenerLatLon($ip){
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if($ipdat->geoplugin_latitude == null) {
        echo "No hay latitud";
    } else {
        $lat=$ipdat->geoplugin_latitude;
        $lon=$ipdat->geoplugin_longitude;
        return "lat:$lat,lon:$lon";
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
function buscarFotoPerfil($id){
    $aux=0;
    $aux=str_pad($aux, 7, "0", STR_PAD_LEFT);
    $aux=substr($aux, 0, 8-strlen($id)).$id;
    $fichero=$aux.".jpg";
    return $fichero;
}

function comprobarFotoPerfil($id){
    $fichero=buscarFotoPerfil($id);
    $fichero="app/uploads/".$fichero;
    if (file_exists($fichero)) {
        return "<img src='$fichero' width='20' alt='Foto almacenada'>";
    }
    return "<img src='https://robohash.org/$id' width='20' alt='Foto perfil robot'>";
}
function cambiarFotoPerfil($id){
    $fichero="app/uploads/".buscarFotoPerfil($id);
    $nombre_imagen=$_FILES['foto']['name'];
       $tipo_imagen=$_FILES['foto']['type'];
        $tam_imagen=$_FILES['foto']['size'];
        move_uploaded_file($_FILES['foto']['tmp_name'],$fichero);
   }
//COMPRUEBO LOGIN
   function comprobarLogin($usuario,$password){
            $md5password= md5($password) ;
            $db = AccesoDatos::getModelo();
            if ($db->checkLogin($usuario,$md5password)){
                echo "Usuario y contraseña correctos";
                comprobarRol($usuario);
                return true;
            } else {
                echo "Usuario y contraseña INCORRECTOS";
                return false;
            }
        }
    

   function comprobarRol($usuario){
            $db = AccesoDatos::getModelo();
            $rol=$db->getRol($usuario);
            if ($rol==1){
                $_SESSION['rol']=1;
            } else {
                $_SESSION['rol']=0;
            }
            
        }
   


?>


