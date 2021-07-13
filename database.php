<?php

include_once ("classe/Classe.PDO.php");

class Database {

    function __construct() {     
       
    }

    public static function getDatabase() {
        $con = Conexao::getInstance();
        $sql = "SHOW DATABASES";
        $dados = array();
        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
            $dados[] = $linha;
        }
        return $dados;
    }

    public static function getTabelas($baseDados) {

        $con = Conexao::getInstance();

        $sql = "select table_name, table_comment
                from information_schema.tables
                where table_type = 'BASE TABLE'
                        and table_schema = '" . $baseDados . "'";
        $dados = array();
        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
            $dados[] = $linha;
        }
        
        return $dados;
    }
    
    public static function getTabela($baseDados, $tabela) {

        $con = Conexao::getInstance();

        $sql = "select table_name, table_comment
                from information_schema.tables
                where table_type = 'BASE TABLE'
                        and table_schema = '" . $baseDados . "' 
                        and table_name = '" .$tabela ."'";
        $dados = array();
        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
            $dados = $linha;
        }
        
        return $dados;
    }

}

$action = isset($_POST['action']) ? $_POST['action'] : "";

if($action == "database") {
    $option = "";
    $dados = Database::getTabelas($_POST['database']);
    foreach ($dados as $key => $value) {
        $option .= "<option>".$value->table_name."</option>";
    }
    print $option;
    
}
