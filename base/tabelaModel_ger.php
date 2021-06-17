<?php include_once 'classe/Classe.PDO.php';
include_once 'classe/Classe.Gerador.php';

$gerador = new Gerador();

$infoTabela = $gerador->Tabela($_POST['tabela']);

$campos = $gerador->Campos($_POST['tabela']);

# normal
$inputs = "";

# select SQL
$inputSel = "";
$innerJoin = "";

# bind insert SQL
$inputInsert = "";

$inputInsertValue ="";

# bind update
$geraBind = "";

$datamask = "";

$funcDadosBusca = "";

# private vars model
$vars = "";

#get set model
$getSet = "";

$getNomeIdFk ="";

//var_dump($campos['full']);

foreach ($campos['full'] as $key => $campo) {

    # vars private
    $vars .= "private \${$campo->column_name} = null;\n";
    
    #get set model
    $getSet = "\n public function get".ucfirst($campo->column_name)."(){
        return \$this->{$campo->column_name};
    }\n
            
    public function set".ucfirst($campo->column_name)."(\${$campo->column_name}){
            \$this->{$campo->column_name} = \${$campo->column_name};
    }";
   

   // var_dump($campo);
    # usar no select SQL
    $inputSel .= $tabela.".".$campo->column_name.",\n";
    
    //var_dump(end($campos['full'])->column_name);
    
    if ($campo->column_key != "PRI") {

        # virgula select SQl de mais de um  campo
        if((count($campos['full']) > 2) && (end($campos['full'])->column_name != $campo->column_name )){
           $separacao = ",\n";
        }else {
            $separacao = " \n";
        }

        //var_dump($campo->column_name. $separacao);
        #usar campos update sql
        $inputs .= $campo->column_name . "= :" . $campo->column_name . $separacao; 
        $inputInsert .= $campo->column_name. $separacao ;
        $inputInsertValue .= ":{$campo->column_name}". $separacao;
        
        # bindValue
        if(strpos($campo->column_name, "data_") === 0){
            //var_dump(strpos($campo->column_name, "data_"));

            $geraBind .= "\$result->bindValue(\":{$campo->column_name}\", DataMysql::dataForm(\$dados['{$campo->column_name}']));\n";    
        }else {
            $geraBind .= "\$result->bindValue(\":{$campo->column_name}\", \$dados['{$campo->column_name}']);\n";    
        }
    }
    
    /* gera funcao busca dados FK*/
    if($campo->column_key == "MUL"){
        
        
        $nomeTableFk = $gerador->getNomeTableFK($tabela, $campo->column_name);
        
        $inputSel .= $nomeTableFk[0]->tabela.".nome as nome_{$nomeTableFk[0]->tabela},\n";
        
        $innerJoin .= "LEFT JOIN {$nomeTableFk[0]->tabela}\n" ;
        $innerJoin .= "ON {$tabela}.{$campo->column_name} = {$nomeTableFk[0]->tabela}.{$campo->column_name}\n";

        $funcDadosBusca .= "#####################  lista autocomplete ######################\n       
     /** lista autocomplete \n
     * \n
     */ \n
    public function lista{$campo->column_name}Autocomplete() {\n
        
        \$con = Conexao::getInstance();

        \$dados = array();

        \$sql = \"SELECT {$campo->column_name}, nome
                              FROM {$nomeTableFk[0]->tabela}\";

        try {

            \$result = \$con->query(\$sql);

            while (\$linha = \$result->fetch(PDO::FETCH_ASSOC)) {
                \$dados[] = \$linha;
            }

            return \$dados;
        } catch (Exception \$e) {
            return \$e->getMessage();
        }
        
    }";
                              
                              
    $getNomeIdFk = "#####################  Busca nome do ID do Fk  ######################\n       
     /** Busca nome do ID Fk \n
     * \n
     */ \n
    public function getNomeIdFk(\$nome_tabela, \$id_tabela, \$id) {\n
    

        if(!is_null(\$id)){
        
            \$con = Conexao::getInstance();

            \$dados = \"\";

            \$sql = \"SELECT nome
                                  FROM {\$nome_tabela}
                                  WHERE {\$id_tabela} = \$id\";

            try {

                \$result = \$con->query(\$sql);

                while (\$linha = \$result->fetch(PDO::FETCH_OBJ)) {
                    \$dados = \$linha;
                }

                return \$dados;
            
        
        
            } catch (Exception \$e) {
                return \$e->getMessage();
            }
        }else {
            \$dados = new \stdClass();
            \$dados->nome = '-';
            return \$dados;
        }
        
    }";
        
    }
    
    
    
    
}
$inputs = substr($inputs, 0, -2);

//var_dump($inputs);
$inputSel = substr($inputSel, 0, -2);

    $model = fopen("arquivo/model/$nomeFileModel.php", "w") or die("Unable to open file!");

$texto = <<< codPhp
<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela {$_POST['tabela']}										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : {$dataAtual}															*
 * ********************************************************************************** */

class $nomeFileModel extends Model {

    
    private \$table = "{$tabela}";
    public static \$model;
    private static \$mod;
    private \$marca;
    private static \$con;
    
    
    {$vars}

    
    {$getSet}
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::\$model = \$this->Tabela('{$tabela}');

         self::\$mod = "aju";
         
         self::\$con = Conexao::getInstance();
     }
   
    #################  LISTA  ##################
   # lista {\$model}
  
    public static function lista(\$id = null) {
         
         \$dados = array();
 
        \$sql = "SELECT";
        \$sql .= " ".implode(", ",self::\$model['dados']['campos'])."";
        
        if (empty(\$id)) {

            \$sql .= " FROM ".self::\$model['tabela']->TABLE_NAME." ORDER By ".self::\$model['dados']['id'];

            \$result =  self::\$con->query(\$sql);
        } else {

            \$sql .= " FROM ".self::\$model['tabela']."  
                            WHERE ".self::\$model['campos'][0]." = :id
                            ORDER BY nome";
            \$result = self::\$con->prepare(\$sql);
            \$result->bindValue(":id", \$id);
            \$result->execute();
        }

        try {
         
            while(\$linha = \$result->fetch(PDO::FETCH_ASSOC)){
         
                \$dados[] = \$linha;
            }

            return \$dados;

        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro lista registros";
        }
    }
         
         
    {$getNomeIdFk}
    
    #################  LISTA NOME ##################
    # lista nome {\$model}
  
    public static function listaNome(\$nome = null) {
         
         try {
         
         \$dados = array();
 
        \$sql = "SELECT";
        \$sql .= " ".self::\$model['dados']['id'].", ";
        \$sql .= " ".implode(", ",self::\$model['dados']['campos'])."";
        
        if (empty(\$nome)) {

            \$sql .= " FROM ".self::\$model['tabela']->TABLE_NAME." ORDER By ".self::\$model['dados']['id'];

            \$result =  self::\$con->query(\$sql);
        } else {

            \$sql .= " FROM ".self::\$model['tabela']->TABLE_NAME."  
                            WHERE ".self::\$model['dados']['campos'][0]." LIKE :nome
                            ORDER BY nome";
            \$result = self::\$con->prepare(\$sql);
            \$result->bindValue(":nome", '%'.\$nome.'%');
            \$result->execute();
        }
         
         while (\$linha = \$result->fetch(PDO::FETCH_ASSOC)){
                \$dados[] = \$linha;
            }

        

            return \$dados;

        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro lista registros";
        }
    }

    #################  GRAVAR  ##################
    # @ grava {\$model} em banco

    public static function gravar(array \$dados) {


        var_dump(self::\$model);
        \$sql = "INSERT INTO {$tabela} ({$inputInsert}) VALUES ({$inputInsertValue})";

        try {

            \$result = self::\$con->prepare(\$sql);

            {$geraBind}
 
            \$result->execute();

            #Log::GravaLog("Cadastro de marca : " . \$dados['nome'] . " " . \$_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados {$smallTable}  ###################

    public static function edit(array \$dados) {
        
 

        \$con = Conexao::getInstance();

        \$sql = "UPDATE {$tabela} SET 
        {$inputs}
            WHERE {$campos['full'][0]->column_name} = :{$campos['full'][0]->column_name}";

        try {

            \$result = \$con->prepare(\$sql);
            
            \$result->bindValue(":{$campos['full'][0]->column_name}", \$dados['{$campos['full'][0]->column_name}']);
            {$geraBind}
            
            \$result->execute();

            #Log::GravaLog("Atualizar Cadastro de {$smallTableCamel} : " . \$dados['nome'] . " " . \$_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view(\${$id_tabela}) {

        \$con = Conexao::getInstance();

        \$fornecedor = "";

        \$sql = "SELECT {$inputSel}
                              FROM {$tabela}
                              {$innerJoin}
                              WHERE {$id_tabela} = " . \${$id_tabela};

        try {

            \$result = \$con->query(\$sql);

            while (\$linha = \$result->fetch(PDO::FETCH_ASSOC)) {
                \${$smallTable} = \$linha;
            }

           \$model = self::\$model;
            return array(\${$smallTable}, \$model);
        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro ao inserir {$smallTableCamel}";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao(\$start, \$regPorPagina){
        \$con = Conexao::getInstance();

            \$stmt = \$con->prepare("SELECT {$inputSel}
                                FROM {$tabela}
                                {$innerJoin}
                                ORDER By {$id_tabela} DESC LIMIT \$start, \$regPorPagina");
            \$stmt->execute();

            \$result = \$stmt->fetchAll();
            
            return \$result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o {$smallTable}

    public static function delete(\$id) {

        \$con = Conexao::getInstance();

        \$sql = "DELETE FROM {$tabela} WHERE {$id_tabela} = " . \$id;

        try {

            \$con->query(\$sql);

            return true;
        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro Deletar {$smallTableCamel} !";
        }
    }
            
     \n\n
     {$funcDadosBusca}
     \n\n

    /**
     * Lista {$smallTable}
     */
    public function lista{$smallTable}s() {

        \$con = Conexao::getInstance();

        \$dados = array();

        \$sql = "SELECT pip_fornecedor.id,
                        pip_fornecedor.nome, 
                        pip_fornecedor.tel, 
                        pip_fornecedor.cel,
                         count(pip_dispositivo.id) as qtd
                              FROM pip_fornecedor
                              left JOIN pip_dispositivo
                              ON pip_fornecedor.id = pip_dispositivo.fornecedor_id
                              group BY pip_fornecedor.nome
                              ORDER BY pip_fornecedor.nome";

        try {

            \$result = \$con->query(\$sql);

            while (\$linha = \$result->fetch(PDO::FETCH_ASSOC)) {
                \$dados[] = \$linha;
            }

            return \$dados;
        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    /**
     * Lista Fornecedoress
     */
    public static function listaFornecedor(\$id) {

        \$con = Conexao::getInstance();

        \$dados = array();

        \$sql = "SELECT pip_fornecedor.id,
                        pip_fornecedor.nome,
                        pip_fornecedor.cpfcnpj,
                        pip_fornecedor.tel, 
                        pip_fornecedor.cel
                              FROM pip_fornecedor
                              WHERE id =" . \$id;

        try {

            \$result = \$con->query(\$sql);

            while (\$linha = \$result->fetch(PDO::FETCH_ASSOC)) {
                \$dados = \$linha;
            }

            return \$dados;
        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    

    /**
     * Cadastro Dispositivos
     */
    public static function cDispositivo(array \$dados) {


        \$con = Conexao::getInstance();
        \$sql = "INSERT INTO pip_dispositivo (cel,
                                                fornecedor_id)
                                    		      VALUES (:cel,
                                                    	  :fornecedor_id)";

        try {

            \$result = \$con->prepare(\$sql);
            \$result->bindValue(":cel", \$dados['cel']);
            \$result->bindValue(":fornecedor_id", \$dados['fornecedor_id']);
            \$result->execute();

            Log::GravaLog("Cadastro de Dispositivo: " . \$dados['cel'] . " " . \$_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    /**
     * Cadastro Dispositivos
     */
    public static function qrCode(array \$dados) {


        \$con = Conexao::getInstance();
        \$sql = "INSERT INTO pip_dispositivo (telefone,
                                                fornecedor_id,
                                                hash,
                                                dt_leitura)
                                    		      VALUES (:telefone,
                                                    	  :fornecedor_id,
                                                    	  :hash,
                                                          :dt_leitura)";

        try {

            \$result = \$con->prepare(\$sql);
            \$result->bindValue(":telefone", \$dados['telefone']);
            \$result->bindValue(":fornecedor_id", \$dados['fornecedor']);
            \$result->bindValue(":hash", \$dados['hash']);
            \$result->bindValue(":dt_leitura", \$dados['dt_leitura']);
            \$result->execute();

            Log::GravaLog("Cadastro de Dispositivo: " . \$dados['telefone'] . " " . \$_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    /**
     * Get nome fornecedor
     */
    public static function getFornecedorNome(\$id) {

        \$con = Conexao::getInstance();

        \$dados = array();

        \$sql = "SELECT nome"
                . " FROM pip_fornecedor"
                . " WHERE id = " . \$id;

        try {

            \$result = \$con->query(\$sql);

            while (\$linha = \$result->fetch(PDO::FETCH_ASSOC)) {
                \$dados = \$linha['nome'];
            }

            return \$dados;
        } catch (Exception \$e) {
            return \$e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

}

codPhp;

try {
    fwrite($model, $texto);
    fclose($model);
} catch (Exception $e) {
    print $e->getMessage() . "Erro na geração do arquivo Model";
}