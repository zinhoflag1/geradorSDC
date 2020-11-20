               
<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_entrada_nota										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class Entrada_notaConEstoqueModel extends Model {

    
    private $table = "aju_entrada_nota";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id_entrada_nota = null;
private $id_fornecedor = null;
private $data_emissao = null;
private $data_entrega = null;
private $id_natureza = null;
private $id_itens_nota = null;
private $id_almoxarifado = null;


    
    
 public function getId_almoxarifado(){
        return $this->id_almoxarifado;
    }

            
    public function setId_almoxarifado($id_almoxarifado){
            $this->id_almoxarifado = $id_almoxarifado;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_entrada_nota');

         self::$mod = "aju";
         
         self::$con = Conexao::getInstance();
     }
   
    #################  LISTA  ##################
   # lista {$model}
  
    public static function lista($id = null) {
         
         $dados = "";
 
        $sql = "SELECT";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($id)) {

            $sql .= " FROM ".self::$model['tabela']->table_name." ORDER By ".self::$model['dados']['id'];

            $result =  self::$con->query($sql);
        } else {

            $sql .= " FROM ".self::$model['tabela']."  
                            WHERE ".self::$model['campos'][0]." = :id
                            ORDER BY nome";
            $result = self::$con->prepare($sql);
            $result->bindValue(":id", $id);
            $result->execute();
        }

        try {
         
            while($linha = $result->fetch(PDO::FETCH_ASSOC)){
         
                $dados[] = $linha;
            }

            return $dados;

        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }
         
         
    #####################  Busca nome do ID do Fk  ######################
       
     /** Busca nome do ID Fk 

     * 

     */ 

    public function getNomeIdFk($nome_tabela, $id_tabela, $id) {

    

        if(!is_null($id)){
        
            $con = Conexao::getInstance();

            $dados = "";

            $sql = "SELECT nome
                                  FROM {$nome_tabela}
                                  WHERE {$id_tabela} = $id";

            try {

                $result = $con->query($sql);

                while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
                    $dados = $linha;
                }

                return $dados;
            
        
        
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }else {
            $dados = new \stdClass();
            $dados->nome = '-';
            return $dados;
        }
        
    }
    
    #################  LISTA NOME ##################
    # lista nome {$model}
  
    public static function listaNome($nome = null) {
         
         try {
         
         $dados = array();
 
        $sql = "SELECT";
        $sql .= " ".self::$model['dados']['id'].", ";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($nome)) {

            $sql .= " FROM ".self::$model['tabela']->table_name." ORDER By ".self::$model['dados']['id'];

            $result =  self::$con->query($sql);
        } else {

            $sql .= " FROM ".self::$model['tabela']->table_name."  
                            WHERE ".self::$model['dados']['campos'][0]." LIKE :nome
                            ORDER BY nome";
            $result = self::$con->prepare($sql);
            $result->bindValue(":nome", '%'.$nome.'%');
            $result->execute();
        }
         
         while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
                $dados[] = $linha;
            }

        

            return $dados;

        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }

    #################  GRAVAR  ##################
    # @ grava {$model} em banco

    public static function gravar(array $dados) {


        var_dump(self::$model);
        $sql = "INSERT INTO aju_entrada_nota (id_fornecedor,
data_emissao,
data_entrega,
id_natureza,
id_itens_nota,
id_almoxarifado 
) VALUES (:id_fornecedor,
:data_emissao,
:data_entrega,
:id_natureza,
:id_itens_nota,
:id_almoxarifado 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":id_fornecedor", $dados['id_fornecedor']);
$result->bindValue(":data_emissao", DataMysql::dataForm($dados['data_emissao']));
$result->bindValue(":data_entrega", DataMysql::dataForm($dados['data_entrega']));
$result->bindValue(":id_natureza", $dados['id_natureza']);
$result->bindValue(":id_itens_nota", $dados['id_itens_nota']);
$result->bindValue(":id_almoxarifado", $dados['id_almoxarifado']);

 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados entrada_nota  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_entrada_nota SET 
        id_fornecedor= :id_fornecedor,
data_emissao= :data_emissao,
data_entrega= :data_entrega,
id_natureza= :id_natureza,
id_itens_nota= :id_itens_nota,
id_almoxarifado= :id_almoxarifado
            WHERE id_entrada_nota = :id_entrada_nota";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_entrada_nota", $dados['id_entrada_nota']);
            $result->bindValue(":id_fornecedor", $dados['id_fornecedor']);
$result->bindValue(":data_emissao", DataMysql::dataForm($dados['data_emissao']));
$result->bindValue(":data_entrega", DataMysql::dataForm($dados['data_entrega']));
$result->bindValue(":id_natureza", $dados['id_natureza']);
$result->bindValue(":id_itens_nota", $dados['id_itens_nota']);
$result->bindValue(":id_almoxarifado", $dados['id_almoxarifado']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Entrada_nota : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_entrada_nota) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_entrada_nota.id_entrada_nota,
aju_entrada_nota.id_fornecedor,
aju_fornecedor.nome as nome_aju_fornecedor,
aju_entrada_nota.data_emissao,
aju_entrada_nota.data_entrega,
aju_entrada_nota.id_natureza,
aju_natureza.nome as nome_aju_natureza,
aju_entrada_nota.id_itens_nota,
aju_itens_nota.nome as nome_aju_itens_nota,
aju_entrada_nota.id_almoxarifado,
aju_almoxarifado.nome as nome_aju_almoxarifado
                              FROM aju_entrada_nota
                              LEFT JOIN aju_fornecedor
ON aju_entrada_nota.id_fornecedor = aju_fornecedor.id_fornecedor
LEFT JOIN aju_natureza
ON aju_entrada_nota.id_natureza = aju_natureza.id_natureza
LEFT JOIN aju_itens_nota
ON aju_entrada_nota.id_itens_nota = aju_itens_nota.id_itens_nota
LEFT JOIN aju_almoxarifado
ON aju_entrada_nota.id_almoxarifado = aju_almoxarifado.id_almoxarifado

                              WHERE id_entrada_nota = " . $id_entrada_nota;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $entrada_nota = $linha;
            }

           $model = self::$model;
            return array($entrada_nota, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Entrada_nota";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_entrada_nota.id_entrada_nota,
aju_entrada_nota.id_fornecedor,
aju_fornecedor.nome as nome_aju_fornecedor,
aju_entrada_nota.data_emissao,
aju_entrada_nota.data_entrega,
aju_entrada_nota.id_natureza,
aju_natureza.nome as nome_aju_natureza,
aju_entrada_nota.id_itens_nota,
aju_itens_nota.nome as nome_aju_itens_nota,
aju_entrada_nota.id_almoxarifado,
aju_almoxarifado.nome as nome_aju_almoxarifado
                                FROM aju_entrada_nota
                                LEFT JOIN aju_fornecedor
ON aju_entrada_nota.id_fornecedor = aju_fornecedor.id_fornecedor
LEFT JOIN aju_natureza
ON aju_entrada_nota.id_natureza = aju_natureza.id_natureza
LEFT JOIN aju_itens_nota
ON aju_entrada_nota.id_itens_nota = aju_itens_nota.id_itens_nota
LEFT JOIN aju_almoxarifado
ON aju_entrada_nota.id_almoxarifado = aju_almoxarifado.id_almoxarifado

                                ORDER By id_entrada_nota DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o entrada_nota

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_entrada_nota WHERE id_entrada_nota = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Entrada_nota !";
        }
    }
            
     


     #####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_fornecedorAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_fornecedor, nome
                              FROM aju_fornecedor";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }#####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_naturezaAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_natureza, nome
                              FROM aju_natureza";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }#####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_itens_notaAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_itens_nota, nome
                              FROM aju_itens_nota";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }#####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_almoxarifadoAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_almoxarifado, nome
                              FROM aju_almoxarifado";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }
     



    /**
     * Lista entrada_nota
     */
    public function listaentrada_notas() {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT pip_fornecedor.id,
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

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    /**
     * Lista Fornecedoress
     */
    public static function listaFornecedor($id) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT pip_fornecedor.id,
                        pip_fornecedor.nome,
                        pip_fornecedor.cpfcnpj,
                        pip_fornecedor.tel, 
                        pip_fornecedor.cel
                              FROM pip_fornecedor
                              WHERE id =" . $id;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    

    /**
     * Cadastro Dispositivos
     */
    public static function cDispositivo(array $dados) {


        $con = Conexao::getInstance();
        $sql = "INSERT INTO pip_dispositivo (cel,
                                                fornecedor_id)
                                    		      VALUES (:cel,
                                                    	  :fornecedor_id)";

        try {

            $result = $con->prepare($sql);
            $result->bindValue(":cel", $dados['cel']);
            $result->bindValue(":fornecedor_id", $dados['fornecedor_id']);
            $result->execute();

            Log::GravaLog("Cadastro de Dispositivo: " . $dados['cel'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    /**
     * Cadastro Dispositivos
     */
    public static function qrCode(array $dados) {


        $con = Conexao::getInstance();
        $sql = "INSERT INTO pip_dispositivo (telefone,
                                                fornecedor_id,
                                                hash,
                                                dt_leitura)
                                    		      VALUES (:telefone,
                                                    	  :fornecedor_id,
                                                    	  :hash,
                                                          :dt_leitura)";

        try {

            $result = $con->prepare($sql);
            $result->bindValue(":telefone", $dados['telefone']);
            $result->bindValue(":fornecedor_id", $dados['fornecedor']);
            $result->bindValue(":hash", $dados['hash']);
            $result->bindValue(":dt_leitura", $dados['dt_leitura']);
            $result->execute();

            Log::GravaLog("Cadastro de Dispositivo: " . $dados['telefone'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    /**
     * Get nome fornecedor
     */
    public static function getFornecedorNome($id) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT nome"
                . " FROM pip_fornecedor"
                . " WHERE id = " . $id;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha['nome'];
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

}
