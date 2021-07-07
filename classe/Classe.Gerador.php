               
<?php

//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe Informacoes tabela banco									*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 18/09/2020															*
 * ********************************************************************************** */

class Gerador {
    
    public static function Campos($tabela, $banco = "") {

        $con = Conexao::getInstance();
        
        $dados =  array();

        $sql = "select column_name, column_type, column_comment, column_key, character_maximum_length
                    from information_schema.COLUMNS 
                    where table_name = '{$tabela}' 
                    and table_schema = '{$banco}';";
        $result = $con->query($sql);
               
        while ($linha = $result->fetch(PDO::FETCH_OBJ)) {

            $dados['full'][] = $linha; // todos dados do campo

            if($linha->column_key == "PRI") {
                $dados['id'] = $linha->column_name; // somente id
            }else {
              $dados['campos'][] = $linha->column_name; // somente nome campos sem id  
            }
        }
        return $dados;
    }
    
    #informações da tabela
    public static function Tabela($tabela, $banco) {
        $con = Conexao::getInstance();

        $sql = "SELECT table_name,"
                . "table_comment,"
                . " table_rows "
                . "FROM information_schema.tables"
                . " where table_name = '" . $tabela . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
            $dados['tabela'] = $linha;
        }

        
        $dados['dados'] = self::Campos($tabela, $banco);

        return $dados;
    }

    # informacoes dos campos da tabela

    public function tipoCampo($tipo){
    
        if(substr($tipo, 0, 4) == "int("){
            return "text";
        }elseif (substr($tipo, 0, 7) == "varchar"){
           return "text";
        }elseif(substr($tipo, 0, 4) == "date"){
           return "date";
        }elseif(substr($tipo, 0, 9) == "tinyint(1"){
           return "checkbox";
        }elseif(substr($tipo, 0, 9) == "tinyint(2"){
           return "radio";
        }

    }
    
    public function tamanhoColuna($tamanho) {
        if($tamanho <='26'){
            $result = 2;
        }elseif ($tamanho <='70') {
            $result = 6;
        }else {
            $result = 12;
        }
        
        return $result;
    }


    /* campos texto */

    public function text(stdClass $param) {
        print "<label>{$param->column_comment}</label>";
        print "<input type='text' name='{$param->column_name}' id='{$param->column_name}' value='' required data-mask=''>";
    }

    /* campos select */

    public function select($param) {
        print "<label>{$param['label']}</label>";
        print "<select name='{$param['name']}' name='{$param['id']}'>";
        foreach ($param['options'] as $key => $value) {
            print "<option value='{$key}'>{$value}</option>";
        }
        print "</select>";
    }

    /* campos checkbox */

    public function checkbox($param) {
        print "<label>{$param['label']}</label>";
        print "<input type='checkbox' name='{$param['name']}' id='{$param['id']}' value='{$param['value']}' {$param['options']}>";
    }

    /* campos radio */

    public function radio($param) {
        print "<label>{$param['label']}</label>";
        print "<input type='radio' name='{$param['name']}' id='{$param['id']}' value='{$param['value']}' {$param['options']}>";
    }

    /* campos textarea */

    public function textarea($param) {

        print "<label>{$param['label']}</label>";
        print "<textarea name='{$param['name']}' id='{$param['id']}'></textarea>";
    }

    /* campos file */

    public function file($param) {

        print "<label>{$param['label']}</label>";
        print "<input type='file' name='{$param['name']}' id='{$param['id']}'>";
    }

    /* campo do formularios com coluna */

    public function formField(stdClass $input, $col = 6) {

        $func = $this->tipoCampo($input->column_type);
        
        var_dump($func);

        //$text = "<div class='col-md={$col}'>";
            #  imprimi input tipo
        $text .= $this->{$this->$func}($input);
        var_dump($text);
        //$text .= "</div>";
        return $text;
    }
    
    
    /* pega o nome da tabela forenKey e o id */
    public function getNomeTableFK($id_table, $id_fk) {
        
        $con = Conexao::getInstance();
        
        $dados = array();
        
        $sql = "SELECT k.REFERENCED_TABLE_NAME as tabela, k.REFERENCED_COLUMN_NAME as id_tabela
                FROM information_schema.TABLE_CONSTRAINTS i 
                LEFT JOIN information_schema.KEY_COLUMN_USAGE k ON i.CONSTRAINT_NAME = k.CONSTRAINT_NAME 
                WHERE i.CONSTRAINT_TYPE = 'FOREIGN KEY' 
                AND i.TABLE_SCHEMA = 'gestaocedec' and i.table_name = '{$id_table}'"
                . " AND k.COLUMN_NAME = '{$id_fk}'";
        
            $result = $con->query($sql);
            

            while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
                $dados[] = $linha;
            }

            return $dados;
                
    }
    

}
