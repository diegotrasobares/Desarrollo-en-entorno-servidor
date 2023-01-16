
<hr>
<form enctype="multipart/form-data" method="post"  action="">
<table>
<tr><td>id:</td> 
<?php      ?>
    <?php if($orden=="Modificar"){?>
        <td><input type="number" name="id" value="<?=$cli->id ?>"  readonly > </td>
        <td rowspan="7"><img src="<?=comprobarFotoPerfil($cli->id) ?>" alt=""></td>
        <?php } else {
            ?>
             <td><input type="number" name="id" value="<?=checkLastId() ?>"  readonly > </td>
        <?php } ?>
</tr>
 <tr><td>first_name:</td> 
 <td><input type="text" name="first_name" value="<?=$cli->first_name ?>" autofocus  ></td></tr>
 </tr>
 <tr><td>last_name:</td> 
 <td><input type="text" name="last_name" value="<?=$cli->last_name ?>"  ></td></tr>
 </tr>
 <tr><td>email:</td> 
 <td><input type="email" name="email" value="<?=$cli->email ?>"  ></td></tr>
 </tr>
 <tr><td>gender</td> 
 <td><input type="text" name="gender" value="<?=$cli->gender ?>"  ></td></tr>
 </tr>
 <tr><td>ip_address:</td> 
 <td><input type="text" name="ip_address" value="<?=$cli->ip_address ?>"  ></td></tr>
 </tr>
 <tr><td>telefono:</td> 
 <td><input type="tel" name="telefono" value="<?=$cli->telefono ?>"  ></td></tr>
 </tr>
 <tr>
<label for="foto">Cambiar foto de perfil:</label>
<input type="file" name="foto">
</tr>
</table>
<input type="submit"	 name="orden" 	value="<?=$orden?>">
<input type="submit"	 name="orden" 	value="Volver">
<input type="submit"	 name="pdf" 	value="Generar PDF">
</form> 

