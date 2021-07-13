<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_h_pedido_benef										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 12/07/2021															*
 * ********************************************************************************** */

class H_pedido_benefajuda_hModel extends Model {

    
    private $table = "aju_h_pedido_benef";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id = null;
private $nome_beneficiario = null;
private $rg = null;
private $comunidade = null;
private $qtd = null;
private $data_entrega = null;
private $id_prestservico = null;


    
    
 public function getId_prestservico(){
        return $this->id_prestservico;
    }

            
    public function setId_prestservico($id_prestservico){
            $this->id_prestservico = $id_prestservico;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_h_pedido_benef');

         self::$mod = "aju";
         
         self::$con = Conexao::getInstance();
     }
   
    #################  LISTA  ##################
   # lista {$model}
  
    public static function lista($id = null) {
         
         $dados = array();
 
        $sql = "SELECT";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($id)) {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME." ORDER By ".self::$model['dados']['id'];

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
         
         
    
    
    #################  LISTA NOME ##################
    # lista nome {$model}
  
    public static function listaNome($nome = null) {
         
         try {
         
         $dados = array();
 
        $sql = "SELECT";
        $sql .= " ".self::$model['dados']['id'].", ";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($nome)) {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME." ORDER By ".self::$model['dados']['id'];

            $result =  self::$con->query($sql);
        } else {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME."  
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
        $sql = "INSERT INTO aju_h_pedido_benef (nome_beneficiario,
rg,
comunidade,
qtd,
data_entrega,
id_prestservico 
) VALUES (:nome_beneficiario,
:rg,
:comunidade,
:qtd,
:data_entrega,
:id_prestservico 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":nome_beneficiario", $dados['nome_beneficiario']);
$result->bindValue(":rg", $dados['rg']);
$result->bindValue(":comunidade", $dados['comunidade']);
$result->bindValue(":qtd", $dados['qtd']);
$result->bindValue(":data_entrega", DataMysql::dataForm($dados['data_entrega']));
$result->bindValue(":id_prestservico", $dados['id_prestservico']);

 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados h_pedido_benef  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_h_pedido_benef SET 
        nome_beneficiario= :nome_beneficiario,
rg= :rg,
comunidade= :comunidade,
qtd= :qtd,
data_entrega= :data_entrega,
id_prestservico= :id_prestservico
            WHERE id = :id";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id", $dados['id']);
            $result->bindValue(":nome_beneficiario", $dados['nome_beneficiario']);
$result->bindValue(":rg", $dados['rg']);
$result->bindValue(":comunidade", $dados['comunidade']);
$result->bindValue(":qtd", $dados['qtd']);
$result->bindValue(":data_entrega", DataMysql::dataForm($dados['data_entrega']));
$result->bindValue(":id_prestservico", $dados['id_prestservico']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de H_pedido_benef : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_h_pedido_benef) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_h_pedido_benef.id,
aju_h_pedido_benef.nome_beneficiario,
aju_h_pedido_benef.rg,
aju_h_pedido_benef.comunidade,
aju_h_pedido_benef.qtd,
aju_h_pedido_benef.data_entrega,
aju_h_pedido_benef.id_prestservico
                              FROM aju_h_pedido_benef
                              
                              WHERE id_h_pedido_benef = " . $id_h_pedido_benef;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $h_pedido_benef = $linha;
            }

           $model = self::$model;
            return array($h_pedido_benef, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir H_pedido_benef";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_h_pedido_benef.id,
aju_h_pedido_benef.nome_beneficiario,
aju_h_pedido_benef.rg,
aju_h_pedido_benef.comunidade,
aju_h_pedido_benef.qtd,
aju_h_pedido_benef.data_entrega,
aju_h_pedido_benef.id_prestservico
                                FROM aju_h_pedido_benef
                                
                                ORDER By id_h_pedido_benef DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o h_pedido_benef

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_h_pedido_benef WHERE id_h_pedido_benef = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar H_pedido_benef !";
        }
    }
            
     


     
     



    /**
     * Lista h_pedido_benef
     */
    public function listah_pedido_benefs() {

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
