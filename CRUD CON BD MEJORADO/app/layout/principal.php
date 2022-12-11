<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>MIS CLIENTES</title>
    <link rel="stylesheet" href="web/default.css">
    <script type="text/javascript" src="web/js/funciones.js"></script>
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>MIS CLIENTES CRUD versión 1.0 </h1>
        </div>
        <div id="content">
            <form>
                <input type="submit" name="orden" value="Cliente Nuevo">
            </form>
            <br>
            <table>
                <tr>
                    <th>ID</th>
                    <th>First_name</th>
                    <th>Email</th>
                    <th>gender</th>
                    <th>ip_address</th>
                    <th>telefono</th>
                </tr>
                <?php foreach ($tvalores as $user) : ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->first_name ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->gender ?></td>
                        <td><?= $user->ip_address ?></td>
                        <td><?= $user->telefono ?></td>
                        <td><a href="?orden=Borrar&id=<?= $user->id ?>" onclick="confirmarBorrar(<?= $user->id ?>)">Borrar</a></td>
                        <td><a href="?orden=Modificar&id=<?= $user->id ?>">Modificar</a></td>
                        <td><a href="?orden=Detalles&id=<?= $user->id ?>">Detalles</a></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <br>
            <form>
                <input type="submit" name="nav" value="<<">
                <input type="submit" name="nav" value="<">
                <input type="submit" name="nav" value=">">
                <input type="submit" name="nav" value=">>">
            </form>
        </div>
    </div>
</body>

</html>