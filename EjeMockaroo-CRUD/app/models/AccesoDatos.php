<?php

/*
 * Acceso a datos con BD Usuarios : 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos
{

    private static $modelo = null;
    private $dbh = null;

    public static function getModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }



    // Constructor privado  Patron singleton

    private function __construct()
    {


        $this->dbh = new mysqli(DB_SERVER, DB_USER, DB_PASSWD, DATABASE);

        if ($this->dbh->connect_error) {
            die(" Error en la conexión " . $this->dbh->connect_errno);
        }
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo()
    {
        if (self::$modelo != null) {
            $obj = self::$modelo;
            // Cierro la base de datos
            $obj->dbh->close();
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo cuantos filas tiene la tabla

    public function numClientes(): int
    {
        $result = $this->dbh->query("SELECT id FROM Clientes");
        $num = $result->num_rows;
        return $num;
    }


    // SELECT Devuelvo la lista de Usuarios
    public function getClientes($primero, $cuantos, $campo = "id"): array
    {
        $tuser = [];
        // Crea la sentencia preparada
        // echo "<h1> $primero : $cuantos  </h1>";
        if ($campo) {
            $stmt_usuarios  = $this->dbh->prepare("select * from Clientes  ORDER BY $campo limit $primero,$cuantos");
        } else {
            $stmt_usuarios  = $this->dbh->prepare("select * from Clientes limit $primero,$cuantos");
        }
        // Si falla termina el programa
        if ($stmt_usuarios == false) die(__FILE__ . ':' . __LINE__ . $this->dbh->error);
        // Ejecuto la sentencia
        $stmt_usuarios->execute();
        // Obtengo los resultados
        $result = $stmt_usuarios->get_result();
        // Si hay resultado correctos
        if ($result) {
            // Obtengo cada fila de la respuesta como un objeto de tipo Usuario
            while ($user = $result->fetch_object('Cliente')) {
                $tuser[] = $user;
            }
        }
        // Devuelvo el array de objetos
        return $tuser;
    }
    public function getClientesOrdenados($campo): array
    {
        $tuser = [];
        // Crea la sentencia preparada
        // echo "<h1> $primero : $cuantos  </h1>";
        $stmt_usuarios  = $this->dbh->prepare("select * from Clientes limit $primero,$cuantos ORDER BY $campo");
        // Si falla termina el programa
        if ($stmt_usuarios == false) die(__FILE__ . ':' . __LINE__ . $this->dbh->error);
        // Ejecuto la sentencia
        $stmt_usuarios->execute();
        // Obtengo los resultados
        $result = $stmt_usuarios->get_result();
        // Si hay resultado correctos
        if ($result) {
            // Obtengo cada fila de la respuesta como un objeto de tipo Usuario
            while ($user = $result->fetch_object('Cliente')) {
                $tuser[] = $user;
            }
        }
        // Devuelvo el array de objetos
        return $tuser;
    }


    // SELECT Devuelvo un usuario o false
    public function getCliente(int $id)
    {
        $cli = false;

        $stmt_usuario   = $this->dbh->prepare("select * from Clientes where id =?");
        if ($stmt_usuario == false) die($this->dbh->error);

        // Enlazo $login con el primer ? 
        $stmt_usuario->bind_param("i", $id);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ($result) {
            $cli = $result->fetch_object('Cliente');
        }

        return $cli;
    }

    public function getClienteSiguiente($id)
    {

        $cli = false;

        $stmt_usuario   = $this->dbh->prepare("select * from Clientes where id >? limit 1");
        if ($stmt_usuario == false) die($this->dbh->error);

        // Enlazo $login con el primer ? 
        $stmt_usuario->bind_param("i", $id);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ($result) {
            $cli = $result->fetch_object('Cliente');
        }

        return $cli;
    }

    public function getClienteAnterior($id)
    {

        $cli = false;

        $stmt_usuario   = $this->dbh->prepare("select * from Clientes where id <? order by id DESC limit 1");
        if ($stmt_usuario == false) die($this->dbh->error);

        // Enlazo $login con el primer ? 
        $stmt_usuario->bind_param("i", $id);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ($result) {
            $cli = $result->fetch_object('Cliente');
        }

        return $cli;
    }




    // UPDATE TODO
    public function modCliente($cli): bool
    {

        $stmt_moduser   = $this->dbh->prepare("UPDATE Clientes set first_name=?,last_name=?,email=?," .
            "gender=?, ip_address=?,telefono=? WHERE id=?");
        if ($stmt_moduser == false) die($this->dbh->error);

        $stmt_moduser->bind_param(
            "ssssssi",
            $cli->first_name,
            $cli->last_name,
            $cli->email,
            $cli->gender,
            $cli->ip_address,
            $cli->telefono,
            $cli->id
        );
        $stmt_moduser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }


    //INSERT 
    public function addCliente($cli): bool
    {

        // El id se define automáticamente por autoincremento.
        $stmt_creauser  = $this->dbh->prepare(
            "INSERT INTO `Clientes`( `first_name`, `last_name`, `email`, `gender`, `ip_address`, `telefono`)" .
                "Values(?,?,?,?,?,?)"
        );
        if ($stmt_creauser == false) die($this->dbh->error);

        $stmt_creauser->bind_param(
            "ssssss",
            $cli->first_name,
            $cli->last_name,
            $cli->email,
            $cli->gender,
            $cli->ip_address,
            $cli->telefono
        );
        $stmt_creauser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }


    //DELETE 
    public function borrarCliente(int $id): bool
    {
        $stmt_boruser   = $this->dbh->prepare("delete from Clientes where id =?");
        if ($stmt_boruser == false) die($this->dbh->error);

        $stmt_boruser->bind_param("i", $id);
        $stmt_boruser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }


    // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }

    public function getLastId(){
        $cli = false;

        $stmt_usuario   = $this->dbh->prepare("SELECT AUTO_INCREMENT AS id FROM information_schema.Tables WHERE TABLE_SCHEMA='clientes' AND table_name='clientes'");
        if ($stmt_usuario == false) die($this->dbh->error);

        // Enlazo $login con el primer ? 
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ($result) {
            $cli = $result->fetch_object();
        }

        return $cli->id;
    }

    public function checkEmail($email)
    {
        $stmt_checkemail = $this->dbh->prepare("select * from Clientes where email =?");
        if ($stmt_checkemail == false) die($this->dbh->error);
        $stmt_checkemail->bind_param("s", $email);
        $stmt_checkemail->execute();
        $result = $stmt_checkemail->get_result();
        if ($result) {
            $cli = $result->fetch_object('Cliente');
        }
        return $cli;
    }
    public function checkLogin($login, $password)
    {
       
        $stmt_checklogin = $this->dbh->prepare("select * from login where login =? and password =?");
        if ($stmt_checklogin == false) die($this->dbh->error);
        $stmt_checklogin->bind_param("ss", $login, $password);
        $stmt_checklogin->execute();
        $result = $stmt_checklogin->get_result();
        if ((mysqli_num_rows($result) > 0)) {
            return true;
        }
        return false;
    }
    public function getRol($login)
    {
        
        $stmt_getrol = $this->dbh->prepare("select rol from login where login =?");
        if ($stmt_getrol == false) die($this->dbh->error);
        $stmt_getrol->bind_param("s", $login);
        $stmt_getrol->execute();
        $result = $stmt_getrol->get_result();
        $row = mysqli_fetch_array($result);
        return $row['rol'];
    }
}
