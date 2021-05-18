<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela teste										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 18/05/2021															*
 * ********************************************************************************** */

class EsteConEstoqueModel extends Model {

    
    private $table = "teste";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $idteste = null;
private $data = null;
private $CodUf = null;
private $Codmundv = null;
private $Codmun = null;
private $NomeMunic = null;


    
    
 public function getNomeMunic(){
        return $this->NomeMunic;
    }

            
    public function setNomeMunic($NomeMunic){
            $this->NomeMunic = $NomeMunic;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('teste');

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
        $sql = "INSERT INTO teste (data,
CodUf,
Codmundv,
Codmun,
NomeMunic 
) VALUES (:data,
:CodUf,
:Codmundv,
:Codmun,
:NomeMunic 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":data", $dados['data']);
$result->bindValue(":CodUf", $dados['CodUf']);
$result->bindValue(":Codmundv", $dados['Codmundv']);
$result->bindValue(":Codmun", $dados['Codmun']);
$result->bindValue(":NomeMunic", $dados['NomeMunic']);

 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados este  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE teste SET 
        data= :data,
CodUf= :CodUf,
Codmundv= :Codmundv,
Codmun= :Codmun,
NomeMunic= :NomeMunic
            WHERE idteste = :idteste";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":idteste", $dados['idteste']);
            $result->bindValue(":data", $dados['data']);
$result->bindValue(":CodUf", $dados['CodUf']);
$result->bindValue(":Codmundv", $dados['Codmundv']);
$result->bindValue(":Codmun", $dados['Codmun']);
$result->bindValue(":NomeMunic", $dados['NomeMunic']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Este : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_este) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT teste.idteste,
teste.data,
teste.CodUf,
teste.Codmundv,
teste.Codmun,
teste.NomeMunic
                              FROM teste
                              
                              WHERE id_este = " . $id_este;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $este = $linha;
            }

           $model = self::$model;
            return array($este, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Este";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT teste.idteste,
teste.data,
teste.CodUf,
teste.Codmundv,
teste.Codmun,
teste.NomeMunic
                                FROM teste
                                
                                ORDER By id_este DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o este

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM teste WHERE id_este = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Este !";
        }
    }
            
     


     
     



    /**
     * Lista este
     */
    public function listaestes() {

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
