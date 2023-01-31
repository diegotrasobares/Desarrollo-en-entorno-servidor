<?php
    include_once "AccesoDatos.php";
    
   //if the request method is post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!empty($_POST['usuario']) && !empty($_POST['contraseña'])) {
                    if (!empty(checkLogin($_POST['usuario'], $_POST['contraseña']))){
                        echo ($cliente->nombre);
                        //header("Location: vistapedidos.php");
                    } else {
                        header("Location: vistaerror.php");
                    }
                   

                } else {
                    echo "Introduce un usuario y contraseña";
                }
            }
        

        if (isset($_SESSION['usuario'])) {
            header("Location: vistapedidos.php");
        } 
    function checkLogin($usuario, $contraseña) {
        $db = new AccesoDatos();
        $cliente = $db->getCliente($usuario, $contraseña);
        return $cliente;
        
    }
    include_once 'acceso.html';
