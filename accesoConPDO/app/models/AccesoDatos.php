<?php
include_once "Cliente.php";
include_once "app/config/configDB.php";
/*
 * Acceso a datos con BD Usuarios : 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt_usuarios = null;
    private $stmt_usuario  = null;
    private $stmt_boruser  = null;
    private $stmt_moduser  = null;
    private $stmt_creauser = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".DB_SERVER.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
         // Construyo las consultas
     $this->stmt_usuarios  = $this->dbh->prepare("select * from Clientes LIMIT :primero,:cuantos");
     $this->stmt_usuario   = $this->dbh->prepare("select * from Clientes where id=:id");
     $this->stmt_boruser   = $this->dbh->prepare("delete from Clientes where id =:id");
     $this->stmt_moduser   = $this->dbh->prepare("UPDATE Clientes set first_name=:nombre,id=:id,last_name=:lastname,email=:email,"."gender=:gender, ip_address=:ip,telefono=:telefono WHERE id=:id");
     $this->stmt_creauser  = $this->dbh->prepare("INSERT INTO `Clientes`( `first_name`, `last_name`, `email`, `gender`, `ip_address`, `telefono`)"."Values(?,?,?,?,?,?)");
    $this->stmt_numUsuarios =$this->dbh->prepare("select id from Clientes");
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->stmt_usuarios = null;
            $obj->stmt_usuario  = null;
            $obj->stmt_boruser  = null;
            $obj->stmt_moduser  = null;
            $obj->stmt_creauser = null;
            $obj->stmt_numUsuarios=null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo cuantos filas tiene la tabla

    public function numClientes ():int {

        if ( $this->stmt_numUsuarios->execute() ){
            $num = $this->stmt_numUsuarios->rowCount();
        }


      return $num;
    } 
    

    // SELECT Devuelvo la lista de Usuarios
    public function getClientes ($primero,$cuantos):array {
        $tuser = [];
        $this->stmt_usuarios->bindValue(':primero',(int) $primero,PDO::PARAM_INT);
        $this->stmt_usuarios->bindValue(':cuantos', (int) $cuantos,PDO::PARAM_INT);
        $this->stmt_usuarios->setFetchMode(PDO::FETCH_CLASS, 'cliente');
        if ( $this->stmt_usuarios->execute() ){
            while ( $user = $this->stmt_usuarios->fetch()){
               $tuser[]= $user;
            }
        }
        return $tuser;


    }
    
      
    // SELECT Devuelvo un usuario o false
    public function getCliente (int $id) {
        $user = false;
        
        $this->stmt_usuario->setFetchMode(PDO::FETCH_CLASS, 'cliente');
        $this->stmt_usuario->bindParam(':id', $id);
        if ( $this->stmt_usuario->execute() ){
             if ( $obj = $this->stmt_usuario->fetch()){
                $user= $obj;
            }
        }
        return $user;
    }
     
    public function getClienteSiguiente($id){

        $cli = false;
        $stmt_usuario   = $this->dbh->prepare("select * from Clientes where id >? limit 1");
        if ( $stmt_usuario == false) die ($this->dbh->error);

        // Enlazo $login con el primer ? 
        $stmt_usuario->bind_param("i",$id);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ( $result ){
            $cli = $result->fetch_object('Cliente');
            }
        
        return $cli;

    }

    public function getClienteAnterior($id){

        $cli = false;
        
        $stmt_usuario   = $this->dbh->prepare("select * from Clientes where id <? order by id DESC limit 1");
        if ( $stmt_usuario == false) die ($this->dbh->error);

        // Enlazo $login con el primer ? 
        $stmt_usuario->bind_param("i",$id);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ( $result ){
            $cli = $result->fetch_object('Cliente');
            }
        
        return $cli;

    }




    // UPDATE TODO
    public function modCliente($cli):bool{
      
        $this->stmt_moduser->bindValue(':nombre',$cli->first_name);
        $this->stmt_moduser->bindValue(':lastname',$cli->last_name);
        $this->stmt_moduser->bindValue(':id',$cli->id);
        $this->stmt_moduser->bindValue(':email',$cli->email);
        $this->stmt_moduser->bindValue(':gender',$cli->gender);
        $this->stmt_moduser->bindValue(':ip',$cli->ip_address);
        $this->stmt_moduser->bindValue(':telefono',$cli->telefono);
        $this->stmt_moduser->execute();
        $resu = ($this->stmt_moduser->rowCount () == 1);
        return $resu;
    }

  
    //INSERT 
    public function addCliente($cli):bool{
        $this->stmt_creauser->execute( [$cli->first_name,$cli->last_name,$cli->email,$cli->gender,$cli->ip_address,$cli->telefono]);
        $resu = ($this->stmt_creauser->rowCount () == 1);
        return $resu;
    }

   
    //DELETE 
    public function borrarCliente(int $id):bool {
        $this->stmt_boruser->bindValue(':id', $id);
        $this->stmt_boruser->execute();
        $resu = ($this->stmt_boruser->rowCount () == 1);
        return $resu;
    }   
    
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }

    
}



