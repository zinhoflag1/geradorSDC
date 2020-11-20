<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_montagem										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 15/10/2020															*
 * ********************************************************************************** */

class MontagemConEstoqueModel extends Model {

    
    private $table = "aju_montagem";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id_montagem = null;
private $data_montagem = null;
private $motorista = null;
private $placa = null;
private $id_transportadora = null;


    
    
 public function getId_transportadora(){
        return $this->id_transportadora;
    }

            
    public function setId_transportadora($id_transportadora){
            $this->id_transportadora = $id_transportadora;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_montagem');

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
        $sql = "INSERT INTO aju_montagem (data_montagem,
motorista,
placa,
id_transportadora 
) VALUES (:data_montagem,
:motorista,
:placa,
:id_transportadora 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":data_montagem", DataMysql::dataForm($dados['data_montagem']));
$result->bindValue(":motorista", $dados['motorista']);
$result->bindValue(":placa", $dados['placa']);
$result->bindValue(":id_transportadora", $dados['id_transportadora']);

 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados montagem  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_montagem SET 
        data_montagem= :data_montagem,
motorista= :motorista,
placa= :placa,
id_transportadora= :id_transportadora
            WHERE id_montagem = :id_montagem";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_montagem", $dados['id_montagem']);
            $result->bindValue(":data_montagem", DataMysql::dataForm($dados['data_montagem']));
$result->bindValue(":motorista", $dados['motorista']);
$result->bindValue(":placa", $dados['placa']);
$result->bindValue(":id_transportadora", $dados['id_transportadora']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Montagem : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_montagem) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_montagem.id_montagem,
aju_montagem.data_montagem,
aju_montagem.motorista,
aju_montagem.placa,
aju_montagem.id_transportadora,
aju_transportadora.nome as nome_aju_transportadora
                              FROM aju_montagem
                              LEFT JOIN aju_transportadora
ON aju_montagem.id_transportadora = aju_transportadora.id_transportadora

                              WHERE id_montagem = " . $id_montagem;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $montagem = $linha;
            }

           $model = self::$model;
            return array($montagem, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Montagem";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_montagem.id_montagem,
aju_montagem.data_montagem,
aju_montagem.motorista,
aju_montagem.placa,
aju_montagem.id_transportadora,
aju_transportadora.nome as nome_aju_transportadora
                                FROM aju_montagem
                                LEFT JOIN aju_transportadora
ON aju_montagem.id_transportadora = aju_transportadora.id_transportadora

                                ORDER By id_montagem DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o montagem

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_montagem WHERE id_montagem = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Montagem !";
        }
    }
            
     


     #####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_transportadoraAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_transportadora, nome
                              FROM aju_transportadora";

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
     * Lista montagem
     */
    public function listamontagems() {

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
