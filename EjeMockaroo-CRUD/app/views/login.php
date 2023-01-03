<html>
<form action="" method='POST'>

    <br><br>
    
    <br><br>
    
    <table>
        <tr>
            <td><label for="login">Usuario:</label>    
                <input type="text" name="usuario" >
            </td>
            </tr>
            <tr>
            <td><label for="password">Contraseña:</label> 
                <input type="password" name="password">
            </td>
            </tr>
            <tr> 
            <td><input type="submit" name="login"value="Iniciar sesión">
            </td>
        </tr> 
    </table>
    <p><?= print "INTENTOS:".$_SESSION['intentos']?></p>
</form>
</html>
