
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_baixa										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 23/05/2021															*
 * ********************************************************************************** */

class baixaController extends Controller {

    private $baixa;
    private $baixas;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->baixa = new BaixaModel;
        $this->baixas = $this->baixa->lista();

    }

    # index baixa

    public function index() {
        $baixaModel = $this->baixa;
        include_once 'mod_ajuda/backEnd/View/conEstoque/baixa/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->baixas);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->baixa->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $baixa = new BaixaConEstoqueModel;
        
        $dados = $baixa->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/baixa/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $baixa = new BaixaModel;

        if ($baixa->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "baixa", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/baixa/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $baixaModel = $this->baixa;
        $view = $this->baixa->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/baixa/view.php';
    }

    # editar registro

    public function edit() {

        $baixaModel = new BaixaConEstoqueModel;

        if ($this->isPost()) {

            $result = $baixaModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $baixaModel->view($_POST['id_baixa']);
                $param = array('id'=> $_POST['id_baixa']);
                $this->redirect("ajuda", "baixa", "view", $param);
            }
        } else {

            $view = $baixaModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/baixa/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->baixa->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "baixa", "index");
        
    }

}