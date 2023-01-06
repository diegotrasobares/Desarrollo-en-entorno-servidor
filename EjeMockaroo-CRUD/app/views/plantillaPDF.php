<?php

require_once "vendor/autoload.php";
require_once "app/controllers/crudclientes.php";

$html = "<!DOCTYPE html>
<html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Informe $cli->first_name</title>
        <style>
            body{
                font-family: Lucida Sans Unicode, Lucida Grande, sans-serif;
                font-size: 20px;
            }
            h1{
                color: black;
            }
            b {
                color: red;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
            }
            th {
                text-align: left;
            }
        </style>
    </head>
    <body>
        <h1>Informe <b>$cli->first_name $cli->last_name</b></h1>
        <table>
            <tr>
                <td>ID</td>
                <td>$cli->id</td>

            </tr>
            <tr>
                <th>NOMBRE</th>
                <td>$cli->first_name</td>
            </tr>
            <tr>
                <th>APELLIDO:</th>
                <td>$cli->last_name</td>
            </tr>
            <tr>
                <th>EMAIL</th>
                <td>$cli->email</td>
            </tr>
            <tr>
                <th>GÉNERO</th>
                <td>$cli->gender</td>
            </tr>
            <tr>
                <th>IP</th>
                <td>$cli->ip_address</td>
            </tr>
            <tr>
                <th>TELÉFONO</th>
                <td>$cli->telefono</td>
            </tr>
            </table>
    </body>
</html>";

$mpdf = new \Mpdf\Mpdf;
$mpdf->WriteHTML($html);
$mpdf->Output();
