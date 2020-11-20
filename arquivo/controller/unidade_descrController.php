
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_unidade_descr										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 28/09/2020															*
 * ********************************************************************************** */

class unidade_descrController extends Controller {

    private $unidade_descr;
    private $unidade_descrs;
    private $campos;
    public $numPage;

    public function __construct() {
        $this->unidade_descr = new Unidade_descrConEstoqueModel;
        $this->unidade_descrs = $this->unidade_descr->lista();

    }

    # index unidade_descr

    public function index() {
        $unidade_descrModel = $this->unidade_descr;
        include_once 'mod_ajuda/backEnd/View/conEstoque/unidade_descr/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->unidade_descrs);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->unidade_descr->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
        
    # Exportar dados excel
    public function exportar() {

        $unidade_descr = new Unidade_descrConEstoqueModel;
        
        $dados = $unidade->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/unidade_descr/cadastro.php';
    }

    # gravar registro

    public function gravar() {

        $unidade_descr = new Unidade_descrConEstoqueModel;

        if ($unidade_descr->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "unidade_descr", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/unidade_descr/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $unidade_descrModel = $this->unidade_descr;
        $view = $this->unidade_descr->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/unidade_descr/view.php';
    }

    # editar registro

    public function edit() {

        $unidade_descrModel = new Unidade_descrConEstoqueModel;

        if ($this->isPost()) {

            $result = $unidade_descrModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $unidade_descrModel->view($_POST['id_unidade_descr']);
                $param = array('id'=> $_POST['id_unidade_descr']);
                $this->redirect("ajuda", "unidade_descr", "view", $param);
            }
        } else {

            $view = $unidade_descrModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/unidade_descr/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->unidade_descr->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "unidade_descr", "index");
        
    }

}