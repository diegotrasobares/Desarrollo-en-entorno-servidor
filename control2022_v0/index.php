<?php
$_SESSION['fallos'] = 0;

session_start();

include_once('app/funciones.php');

if ($_SESSION['fallos'] >= 5) {
  header('Location: error.php');
  session_destroy();
} else {
  if (!empty($_GET['login']) && !empty($_GET['clave'])) {
    if (userOk($_GET['login'], $_GET['clave'])) {
      if (getUserRol($_GET['login']) == ROL_PROFESOR) {
        $contenido = verNotaTodas($_GET['login']);
      } else {
        $contenido = verNotasAlumno($_GET['login']);
      }
      include_once('app/resultado.php');
    }
    // userOK falso
    else {
      $_SESSION['fallos']++;
      $contenido = "El número de usuario y la contraseña no son válidos";

      include_once('app/acceso.php');
    }
  } else {
    $_SESSION['fallos']++;
    $contenido = " Introduzca su número de usuario y su contraseña";
    include_once('app/acceso.php');
  }
}
