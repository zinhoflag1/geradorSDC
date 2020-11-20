
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_pedido										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 05/10/2020															*
 * ********************************************************************************** */

class pedidoController extends Controller {

    private $pedido;
    private $pedidos;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->pedido = new PedidoConEstoqueModel;
        $this->pedidos = $this->pedido->lista();

    }

    # index pedido

    public function index() {
        $pedidoModel = $this->pedido;
        include_once 'mod_ajuda/backEnd/View/conEstoque/pedido/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->pedidos);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->pedido->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $pedido = new PedidoConEstoqueModel;
        
        $dados = $pedido->lista();
        
        $coluna = array_keys($dados[0]);
        
        $data = array();
        
        array_push($data, $coluna);
        
        foreach ($dados as $key => $dado) {
            $data[] = $dado; 
        }

        $nomeFileExcel = sys_get_temp_dir()."/Cadastro".ucfirst($_GET['controller'])."_".date("dmY_his").".xlsx";

        $writer = new XLSXWriter();
        $writer->writeSheet($data);
        $writer->writeToFile($nomeFileExcel);

        header('Content-Description: File Transfer');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"" . basename($nomeFileExcel) . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Length: ' . filesize($nomeFileExcel)); //Remove
        ob_clean();
        flush();
        readfile($nomeFileExcel);
    }
        

    # formulario cadastro
    public function cadastro() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/pedido/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $pedido = new PedidoConEstoqueModel;

        if ($pedido->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "pedido", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/pedido/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $pedidoModel = $this->pedido;
        $view = $this->pedido->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/pedido/view.php';
    }

    # editar registro

    public function edit() {

        $pedidoModel = new PedidoConEstoqueModel;

        if ($this->isPost()) {

            $result = $pedidoModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $pedidoModel->view($_POST['id_pedido']);
                $param = array('id'=> $_POST['id_pedido']);
                $this->redirect("ajuda", "pedido", "view", $param);
            }
        } else {

            $view = $pedidoModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/pedido/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->pedido->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "pedido", "index");
        
    }

}