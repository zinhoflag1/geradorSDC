               
<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_pedido										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 05/10/2020															*
 * ********************************************************************************** */

class PedidoConEstoqueModel extends Model {

    
    private $table = "aju_pedido";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id_pedido = null;
private $id_tp_pedido = null;
private $data_emissao = null;
private $data_entrega = null;
private $id_almoxarifado = null;
private $id_transportadora = null;
private $id_destinatario = null;
private $id_destinatario_final = null;
private $nome_destinatario_final = null;
private $obs = null;


    
    
 public function getObs(){
        return $this->obs;
    }

            
    public function setObs($obs){
            $this->obs = $obs;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_pedido');

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
        $sql = "INSERT INTO aju_pedido (id_tp_pedido,
data_emissao,
data_entrega,
id_almoxarifado,
id_transportadora,
id_destinatario,
id_destinatario_final,
nome_destinatario_final,
obs 
) VALUES (:id_tp_pedido,
:data_emissao,
:data_entrega,
:id_almoxarifado,
:id_transportadora,
:id_destinatario,
:id_destinatario_final,
:nome_destinatario_final,
:obs 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":id_tp_pedido", $dados['id_tp_pedido']);
$result->bindValue(":data_emissao", DataMysql::dataForm($dados['data_emissao']));
$result->bindValue(":data_entrega", DataMysql::dataForm($dados['data_entrega']));
$result->bindValue(":id_almoxarifado", $dados['id_almoxarifado']);
$result->bindValue(":id_transportadora", $dados['id_transportadora']);
$result->bindValue(":id_destinatario", $dados['id_destinatario']);
$result->bindValue(":id_destinatario_final", $dados['id_destinatario_final']);
$result->bindValue(":nome_destinatario_final", $dados['nome_destinatario_final']);
$result->bindValue(":obs", $dados['obs']);

 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados pedido  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_pedido SET 
        id_tp_pedido= :id_tp_pedido,
data_emissao= :data_emissao,
data_entrega= :data_entrega,
id_almoxarifado= :id_almoxarifado,
id_transportadora= :id_transportadora,
id_destinatario= :id_destinatario,
id_destinatario_final= :id_destinatario_final,
nome_destinatario_final= :nome_destinatario_final,
obs= :obs
            WHERE id_pedido = :id_pedido";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_pedido", $dados['id_pedido']);
            $result->bindValue(":id_tp_pedido", $dados['id_tp_pedido']);
$result->bindValue(":data_emissao", DataMysql::dataForm($dados['data_emissao']));
$result->bindValue(":data_entrega", DataMysql::dataForm($dados['data_entrega']));
$result->bindValue(":id_almoxarifado", $dados['id_almoxarifado']);
$result->bindValue(":id_transportadora", $dados['id_transportadora']);
$result->bindValue(":id_destinatario", $dados['id_destinatario']);
$result->bindValue(":id_destinatario_final", $dados['id_destinatario_final']);
$result->bindValue(":nome_destinatario_final", $dados['nome_destinatario_final']);
$result->bindValue(":obs", $dados['obs']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Pedido : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_pedido) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_pedido.id_pedido,
aju_pedido.id_tp_pedido,
aju_tp_pedido.nome as nome_aju_tp_pedido,
aju_pedido.data_emissao,
aju_pedido.data_entrega,
aju_pedido.id_almoxarifado,
aju_almoxarifado.nome as nome_aju_almoxarifado,
aju_pedido.id_transportadora,
aju_transportadora.nome as nome_aju_transportadora,
aju_pedido.id_destinatario,
aju_destinatario.nome as nome_aju_destinatario,
aju_pedido.id_destinatario_final,
aju_destinatario_final.nome as nome_aju_destinatario_final,
aju_pedido.nome_destinatario_final,
aju_pedido.obs
                              FROM aju_pedido
                              LEFT JOIN aju_tp_pedido
ON aju_pedido.id_tp_pedido = aju_tp_pedido.id_tp_pedido
LEFT JOIN aju_almoxarifado
ON aju_pedido.id_almoxarifado = aju_almoxarifado.id_almoxarifado
LEFT JOIN aju_transportadora
ON aju_pedido.id_transportadora = aju_transportadora.id_transportadora
LEFT JOIN aju_destinatario
ON aju_pedido.id_destinatario = aju_destinatario.id_destinatario
LEFT JOIN aju_destinatario_final
ON aju_pedido.id_destinatario_final = aju_destinatario_final.id_destinatario_final

                              WHERE id_pedido = " . $id_pedido;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $pedido = $linha;
            }

           $model = self::$model;
            return array($pedido, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Pedido";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_pedido.id_pedido,
aju_pedido.id_tp_pedido,
aju_tp_pedido.nome as nome_aju_tp_pedido,
aju_pedido.data_emissao,
aju_pedido.data_entrega,
aju_pedido.id_almoxarifado,
aju_almoxarifado.nome as nome_aju_almoxarifado,
aju_pedido.id_transportadora,
aju_transportadora.nome as nome_aju_transportadora,
aju_pedido.id_destinatario,
aju_destinatario.nome as nome_aju_destinatario,
aju_pedido.id_destinatario_final,
aju_destinatario_final.nome as nome_aju_destinatario_final,
aju_pedido.nome_destinatario_final,
aju_pedido.obs
                                FROM aju_pedido
                                LEFT JOIN aju_tp_pedido
ON aju_pedido.id_tp_pedido = aju_tp_pedido.id_tp_pedido
LEFT JOIN aju_almoxarifado
ON aju_pedido.id_almoxarifado = aju_almoxarifado.id_almoxarifado
LEFT JOIN aju_transportadora
ON aju_pedido.id_transportadora = aju_transportadora.id_transportadora
LEFT JOIN aju_destinatario
ON aju_pedido.id_destinatario = aju_destinatario.id_destinatario
LEFT JOIN aju_destinatario_final
ON aju_pedido.id_destinatario_final = aju_destinatario_final.id_destinatario_final

                                ORDER By id_pedido DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o pedido

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_pedido WHERE id_pedido = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Pedido !";
        }
    }
            
     


     #####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_tp_pedidoAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_tp_pedido, nome
                              FROM aju_tp_pedido";

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
        
    }#####################  lista autocomplete ######################
       
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
        
    }#####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_destinatarioAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_destinatario, nome
                              FROM aju_destinatario";

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

    public function listaid_destinatario_finalAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_destinatario_final, nome
                              FROM aju_destinatario_final";

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
     * Lista pedido
     */
    public function listapedidos() {

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
