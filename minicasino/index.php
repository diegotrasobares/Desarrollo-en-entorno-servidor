<?php

session_start();
if (isset($_COOKIE['visitas'])){
    setcookie('visitas',$_COOKIE['visitas']+1,time()+3600*24);
} else {
    setcookie('visitas',1,time()+3600*24);
}
include_once "funciones.php";
if (isset($_SESSION['dinero'])){
    
        if(isset($_POST['apuesta'])&& $_POST['apostar']){
            if ($_POST['apuesta'] <= $_SESSION['dinero'] && $_POST['tipo-apuesta']){
                $numerorandom=generarNumero();
                $tipoapuesta=$_POST['tipo-apuesta'];
                print("EL RESULTADO DE LA APUESTA HA SIDO: ". $numerorandom)."<br>";
                if ($numerorandom==$tipoapuesta){
                    $_SESSION['dinero']+=$_POST['apuesta'];
                    print("HAS GANADO, FELICIDADES");
                } else {
                    print("HAS PERDIDO, LO SIENTO");
                    $_SESSION['dinero']-=$_POST['apuesta'];
                }
                
                } else {
                    print("ERROR: REVISA LOS CAMPOS");
                 }
        include_once "apostar.php";
    
    } else {
        header("Location: despedida.php");
        session_destroy();
    }
}else {
    if (isset($_POST['dinero'])){
        $_SESSION['dinero']=$_POST['dinero'];
        include_once("apostar.php");
    } else {
        include_once "bienvenida.php";
    }
    
}
