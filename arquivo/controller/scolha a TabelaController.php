
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela Escolha a Tabela										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 18/05/2021															*
 * ********************************************************************************** */

class scolha a TabelaController extends Controller {

    private $scolha a Tabela;
    private $scolha a Tabelas;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->scolha a Tabela = new Scolha a TabelaConEstoqueModel;
        $this->scolha a Tabelas = $this->scolha a Tabela->lista();

    }

    # index scolha a Tabela

    public function index() {
        $scolha a TabelaModel = $this->scolha a Tabela;
        include_once 'mod_ajuda/backEnd/View/conEstoque/scolha a Tabela/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->scolha a Tabelas);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->scolha a Tabela->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $scolha a Tabela = new Scolha a TabelaConEstoqueModel;
        
        $dados = $scolha a Tabela->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/scolha a Tabela/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $scolha a Tabela = new Scolha a TabelaConEstoqueModel;

        if ($scolha a Tabela->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "scolha a Tabela", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/scolha a Tabela/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $scolha a TabelaModel = $this->scolha a Tabela;
        $view = $this->scolha a Tabela->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/scolha a Tabela/view.php';
    }

    # editar registro

    public function edit() {

        $scolha a TabelaModel = new Scolha a TabelaConEstoqueModel;

        if ($this->isPost()) {

            $result = $scolha a TabelaModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $scolha a TabelaModel->view($_POST['id_scolha a Tabela']);
                $param = array('id'=> $_POST['id_scolha a Tabela']);
                $this->redirect("ajuda", "scolha a Tabela", "view", $param);
            }
        } else {

            $view = $scolha a TabelaModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/scolha a Tabela/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->scolha a Tabela->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "scolha a Tabela", "index");
        
    }

}