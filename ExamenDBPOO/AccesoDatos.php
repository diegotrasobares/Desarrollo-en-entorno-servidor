<?php
include_once "controlpedido.php";
include_once "Cliente.php";
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    public function __construct(){
        
        try {
            $dsn = "mysql:host=localhost;dbname=etienda;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }  
    }
    
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    public function getCliente($usuario,$contraseña){
        $sql = "SELECT * FROM Clientes WHERE nombre = :nombre AND clave = :clave";
        $stmt = $this->dbh->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $stmt->execute(['nombre' => $usuario, 'clave' => $contraseña]);
        return $stmt->fetch();
    }


    public function sumarVisitas($id){
        $this->stmt = $this->dbh->prepare("UPDATE productos SET visitas=visitas+1 WHERE id=:id");
        $this->stmt->bindParam(":id", $id);
        $this->stmt->execute();
    }
    public function comprobarPedidos(){
        $this->stmt = $this->dbh->prepare("SELECT * FROM pedidos WHERE cliente_no=:cliente_no");
        $this->stmt->bindParam(":cliente_no", $_SESSION['id']);
        $this->stmt->execute();
        $pedidos = $this->stmt->fetchAll();
        return $pedidos;
    }
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}