
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_permissao										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 13/10/2020															*
 * ********************************************************************************** */

class permissaoController extends Controller {

    private $permissao;
    private $permissaos;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->permissao = new PermissaoConEstoqueModel;
        $this->permissaos = $this->permissao->lista();

    }

    # index permissao

    public function index() {
        $permissaoModel = $this->permissao;
        include_once 'mod_ajuda/backEnd/View/conEstoque/permissao/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->permissaos);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->permissao->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $permissao = new PermissaoConEstoqueModel;
        
        $dados = $permissao->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/permissao/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $permissao = new PermissaoConEstoqueModel;

        if ($permissao->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "permissao", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/permissao/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $permissaoModel = $this->permissao;
        $view = $this->permissao->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/permissao/view.php';
    }

    # editar registro

    public function edit() {

        $permissaoModel = new PermissaoConEstoqueModel;

        if ($this->isPost()) {

            $result = $permissaoModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $permissaoModel->view($_POST['id_permissao']);
                $param = array('id'=> $_POST['id_permissao']);
                $this->redirect("ajuda", "permissao", "view", $param);
            }
        } else {

            $view = $permissaoModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/permissao/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->permissao->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "permissao", "index");
        
    }

}