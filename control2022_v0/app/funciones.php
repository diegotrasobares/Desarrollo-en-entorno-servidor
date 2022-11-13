<?php
require_once('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */
function userOk($login, $clave): bool
{
    global $usuarios;
    if (isset($usuarios[$login]) && $usuarios[$login][1] == $clave) {
        return true;
    }
    $_SESSION['fallos']++;
    return false;
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login)
{

    global $usuarios;
    return $usuarios[$login][2];
}


/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo): String
{
    $msg = "";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    $msg .= " Bienvenido/a alumno/a: " . $usuarios[$codigo][0] . "<br>" . "<hr>";
    $msg .= "<table>";
    $msg .= "<tr><th>Módulo</th><th>Nota</th></tr>";
    //Imprimo Nombre de modulos y las notas correspondientes
    for ($i = 0; $i < count($nombreModulos); $i++) {
        $msg .= "<tr><td>" . $nombreModulos[$i] . "</td><td>" . $notas[$codigo][$i] . "</td></tr>";
    }

    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas($codigo): String
{
    $msg = "";
    global $nombreModulos;
    global $notas;
    global $usuarios;
    //Almeceno todo en $msg para imprimirlo
    $msg .= " Bienvenido Profesor: " . $usuarios[$codigo][0] . "<br>" . "<hr>";
    $msg .= "<table>";
    $msg .= "<tr><th>Nombre</th>";
    //Imprimo solo nombres de la asignatura (sin los alumnos ni las notas)
    for ($i = 0; $i < count($nombreModulos); $i++) {
        $msg .= "<th>" . $nombreModulos[$i] . "</th>";
    }
    $msg .= "</tr>";
    //Imprimo los alumnos con sus respectivas notas
    foreach ($notas as $clave => $valor) {
        $msg .= "<tr>";
        $msg .= "<td>" . $usuarios[$clave][0] . "</td>";
        for ($i = 0; $i < count($nombreModulos); $i++) {
            $msg .= "<td>" . $notas[$clave][$i] . "</td>";
        }
        $msg .= "</tr>";
    }

    $msg .= "</table>";
    return $msg;
}
