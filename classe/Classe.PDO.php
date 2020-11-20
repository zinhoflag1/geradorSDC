<?php class Conexao {

    public static $instance;

    private static $host = 'localhost';
    private static $porta = '3306';
    private static $base = 'gestaocedec';
    private static $usuario = 'usuario';
    private static $senha = 'usuario';

    private function __construct() {

        self::$host   = $dados['host'];
        self::$porta  = $dados['porta'];
        self::$base   = $dados['base'];
        self::$usuario= $dados['usuario'];
        self::$senha  = $dados['senha'];

    }

    public static function getInstance() {

        if (!isset(self::$instance)) {

                self::$instance = new PDO('mysql:host='.self::$host.';port='.self::$porta.';dbname='.self::$base.'', self::$usuario, self::$senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));


            self::$instance -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance -> setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        
        return self::$instance;
    }
    
    public function __destruct(){
        
       self::$instance = null;
        
    }

}
?>