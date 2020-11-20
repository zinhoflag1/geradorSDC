<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_permissao										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 13/10/2020															*
 * ********************************************************************************** */

class PermissaoConEstoqueModel extends Model {

    
    private $table = "aju_permissao";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id_permissao = null;
private $login = null;
private $nivel = null;
private $cad_material = null;
private $cad_pagamento = null;
private $cad_transferencia = null;
private $cad_liberacao = null;
private $cad_ajuda_suporte = null;
private $cad_usuario = null;
private $cad_conf_ger = null;
private $relatorio = null;
private $rel_saldo_geral = null;
private $rel_saldo_p_deposito = null;
private $liberacao = null;
private $rel_comp_liberacao = null;
private $rel_mat_liberado = null;
private $rel_mat_pago = null;
private $rel_comp_mat_pago = null;
private $transferencia = null;
private $rel_mat_transferido = null;
private $rel_mat_transito = null;
private $lembrete_libera = null;
private $lembrete_transito = null;
private $inicial = null;
private $cad_deposito = null;
private $rel_cad_mat = null;
private $rel_resumo_liberacao = null;
private $pedido_ajuda = null;
private $controle_estoque = null;
private $cancLibPaga = null;
private $tdap = null;


    
    
 public function getTdap(){
        return $this->tdap;
    }

            
    public function setTdap($tdap){
            $this->tdap = $tdap;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_permissao');

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
        $sql = "INSERT INTO aju_permissao (login,
nivel,
cad_material,
cad_pagamento,
cad_transferencia,
cad_liberacao,
cad_ajuda_suporte,
cad_usuario,
cad_conf_ger,
relatorio,
rel_saldo_geral,
rel_saldo_p_deposito,
liberacao,
rel_comp_liberacao,
rel_mat_liberado,
rel_mat_pago,
rel_comp_mat_pago,
transferencia,
rel_mat_transferido,
rel_mat_transito,
lembrete_libera,
lembrete_transito,
inicial,
cad_deposito,
rel_cad_mat,
rel_resumo_liberacao,
pedido_ajuda,
controle_estoque,
cancLibPaga,
tdap 
) VALUES (:login,
:nivel,
:cad_material,
:cad_pagamento,
:cad_transferencia,
:cad_liberacao,
:cad_ajuda_suporte,
:cad_usuario,
:cad_conf_ger,
:relatorio,
:rel_saldo_geral,
:rel_saldo_p_deposito,
:liberacao,
:rel_comp_liberacao,
:rel_mat_liberado,
:rel_mat_pago,
:rel_comp_mat_pago,
:transferencia,
:rel_mat_transferido,
:rel_mat_transito,
:lembrete_libera,
:lembrete_transito,
:inicial,
:cad_deposito,
:rel_cad_mat,
:rel_resumo_liberacao,
:pedido_ajuda,
:controle_estoque,
:cancLibPaga,
:tdap 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":login", $dados['login']);
$result->bindValue(":nivel", $dados['nivel']);
$result->bindValue(":cad_material", $dados['cad_material']);
$result->bindValue(":cad_pagamento", $dados['cad_pagamento']);
$result->bindValue(":cad_transferencia", $dados['cad_transferencia']);
$result->bindValue(":cad_liberacao", $dados['cad_liberacao']);
$result->bindValue(":cad_ajuda_suporte", $dados['cad_ajuda_suporte']);
$result->bindValue(":cad_usuario", $dados['cad_usuario']);
$result->bindValue(":cad_conf_ger", $dados['cad_conf_ger']);
$result->bindValue(":relatorio", $dados['relatorio']);
$result->bindValue(":rel_saldo_geral", $dados['rel_saldo_geral']);
$result->bindValue(":rel_saldo_p_deposito", $dados['rel_saldo_p_deposito']);
$result->bindValue(":liberacao", $dados['liberacao']);
$result->bindValue(":rel_comp_liberacao", $dados['rel_comp_liberacao']);
$result->bindValue(":rel_mat_liberado", $dados['rel_mat_liberado']);
$result->bindValue(":rel_mat_pago", $dados['rel_mat_pago']);
$result->bindValue(":rel_comp_mat_pago", $dados['rel_comp_mat_pago']);
$result->bindValue(":transferencia", $dados['transferencia']);
$result->bindValue(":rel_mat_transferido", $dados['rel_mat_transferido']);
$result->bindValue(":rel_mat_transito", $dados['rel_mat_transito']);
$result->bindValue(":lembrete_libera", $dados['lembrete_libera']);
$result->bindValue(":lembrete_transito", $dados['lembrete_transito']);
$result->bindValue(":inicial", $dados['inicial']);
$result->bindValue(":cad_deposito", $dados['cad_deposito']);
$result->bindValue(":rel_cad_mat", $dados['rel_cad_mat']);
$result->bindValue(":rel_resumo_liberacao", $dados['rel_resumo_liberacao']);
$result->bindValue(":pedido_ajuda", $dados['pedido_ajuda']);
$result->bindValue(":controle_estoque", $dados['controle_estoque']);
$result->bindValue(":cancLibPaga", $dados['cancLibPaga']);
$result->bindValue(":tdap", $dados['tdap']);

 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados permissao  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_permissao SET 
        login= :login,
nivel= :nivel,
cad_material= :cad_material,
cad_pagamento= :cad_pagamento,
cad_transferencia= :cad_transferencia,
cad_liberacao= :cad_liberacao,
cad_ajuda_suporte= :cad_ajuda_suporte,
cad_usuario= :cad_usuario,
cad_conf_ger= :cad_conf_ger,
relatorio= :relatorio,
rel_saldo_geral= :rel_saldo_geral,
rel_saldo_p_deposito= :rel_saldo_p_deposito,
liberacao= :liberacao,
rel_comp_liberacao= :rel_comp_liberacao,
rel_mat_liberado= :rel_mat_liberado,
rel_mat_pago= :rel_mat_pago,
rel_comp_mat_pago= :rel_comp_mat_pago,
transferencia= :transferencia,
rel_mat_transferido= :rel_mat_transferido,
rel_mat_transito= :rel_mat_transito,
lembrete_libera= :lembrete_libera,
lembrete_transito= :lembrete_transito,
inicial= :inicial,
cad_deposito= :cad_deposito,
rel_cad_mat= :rel_cad_mat,
rel_resumo_liberacao= :rel_resumo_liberacao,
pedido_ajuda= :pedido_ajuda,
controle_estoque= :controle_estoque,
cancLibPaga= :cancLibPaga,
tdap= :tdap
            WHERE id_permissao = :id_permissao";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_permissao", $dados['id_permissao']);
            $result->bindValue(":login", $dados['login']);
$result->bindValue(":nivel", $dados['nivel']);
$result->bindValue(":cad_material", $dados['cad_material']);
$result->bindValue(":cad_pagamento", $dados['cad_pagamento']);
$result->bindValue(":cad_transferencia", $dados['cad_transferencia']);
$result->bindValue(":cad_liberacao", $dados['cad_liberacao']);
$result->bindValue(":cad_ajuda_suporte", $dados['cad_ajuda_suporte']);
$result->bindValue(":cad_usuario", $dados['cad_usuario']);
$result->bindValue(":cad_conf_ger", $dados['cad_conf_ger']);
$result->bindValue(":relatorio", $dados['relatorio']);
$result->bindValue(":rel_saldo_geral", $dados['rel_saldo_geral']);
$result->bindValue(":rel_saldo_p_deposito", $dados['rel_saldo_p_deposito']);
$result->bindValue(":liberacao", $dados['liberacao']);
$result->bindValue(":rel_comp_liberacao", $dados['rel_comp_liberacao']);
$result->bindValue(":rel_mat_liberado", $dados['rel_mat_liberado']);
$result->bindValue(":rel_mat_pago", $dados['rel_mat_pago']);
$result->bindValue(":rel_comp_mat_pago", $dados['rel_comp_mat_pago']);
$result->bindValue(":transferencia", $dados['transferencia']);
$result->bindValue(":rel_mat_transferido", $dados['rel_mat_transferido']);
$result->bindValue(":rel_mat_transito", $dados['rel_mat_transito']);
$result->bindValue(":lembrete_libera", $dados['lembrete_libera']);
$result->bindValue(":lembrete_transito", $dados['lembrete_transito']);
$result->bindValue(":inicial", $dados['inicial']);
$result->bindValue(":cad_deposito", $dados['cad_deposito']);
$result->bindValue(":rel_cad_mat", $dados['rel_cad_mat']);
$result->bindValue(":rel_resumo_liberacao", $dados['rel_resumo_liberacao']);
$result->bindValue(":pedido_ajuda", $dados['pedido_ajuda']);
$result->bindValue(":controle_estoque", $dados['controle_estoque']);
$result->bindValue(":cancLibPaga", $dados['cancLibPaga']);
$result->bindValue(":tdap", $dados['tdap']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Permissao : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_permissao) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_permissao.id_permissao,
aju_permissao.login,
aju_permissao.nivel,
aju_permissao.cad_material,
aju_permissao.cad_pagamento,
aju_permissao.cad_transferencia,
aju_permissao.cad_liberacao,
aju_permissao.cad_ajuda_suporte,
aju_permissao.cad_usuario,
aju_permissao.cad_conf_ger,
aju_permissao.relatorio,
aju_permissao.rel_saldo_geral,
aju_permissao.rel_saldo_p_deposito,
aju_permissao.liberacao,
aju_permissao.rel_comp_liberacao,
aju_permissao.rel_mat_liberado,
aju_permissao.rel_mat_pago,
aju_permissao.rel_comp_mat_pago,
aju_permissao.transferencia,
aju_permissao.rel_mat_transferido,
aju_permissao.rel_mat_transito,
aju_permissao.lembrete_libera,
aju_permissao.lembrete_transito,
aju_permissao.inicial,
aju_permissao.cad_deposito,
aju_permissao.rel_cad_mat,
aju_permissao.rel_resumo_liberacao,
aju_permissao.pedido_ajuda,
aju_permissao.controle_estoque,
aju_permissao.cancLibPaga,
aju_permissao.tdap
                              FROM aju_permissao
                              
                              WHERE id_permissao = " . $id_permissao;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $permissao = $linha;
            }

           $model = self::$model;
            return array($permissao, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Permissao";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_permissao.id_permissao,
aju_permissao.login,
aju_permissao.nivel,
aju_permissao.cad_material,
aju_permissao.cad_pagamento,
aju_permissao.cad_transferencia,
aju_permissao.cad_liberacao,
aju_permissao.cad_ajuda_suporte,
aju_permissao.cad_usuario,
aju_permissao.cad_conf_ger,
aju_permissao.relatorio,
aju_permissao.rel_saldo_geral,
aju_permissao.rel_saldo_p_deposito,
aju_permissao.liberacao,
aju_permissao.rel_comp_liberacao,
aju_permissao.rel_mat_liberado,
aju_permissao.rel_mat_pago,
aju_permissao.rel_comp_mat_pago,
aju_permissao.transferencia,
aju_permissao.rel_mat_transferido,
aju_permissao.rel_mat_transito,
aju_permissao.lembrete_libera,
aju_permissao.lembrete_transito,
aju_permissao.inicial,
aju_permissao.cad_deposito,
aju_permissao.rel_cad_mat,
aju_permissao.rel_resumo_liberacao,
aju_permissao.pedido_ajuda,
aju_permissao.controle_estoque,
aju_permissao.cancLibPaga,
aju_permissao.tdap
                                FROM aju_permissao
                                
                                ORDER By id_permissao DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o permissao

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_permissao WHERE id_permissao = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Permissao !";
        }
    }
            
     


     
     



    /**
     * Lista permissao
     */
    public function listapermissaos() {

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
