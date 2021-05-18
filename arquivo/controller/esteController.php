
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela teste										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 18/05/2021															*
 * ********************************************************************************** */

class esteController extends Controller {

    private $este;
    private $estes;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->este = new EsteConEstoqueModel;
        $this->estes = $this->este->lista();

    }

    # index este

    public function index() {
        $esteModel = $this->este;
        include_once 'mod_ajuda/backEnd/View/conEstoque/este/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->estes);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->este->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $este = new EsteConEstoqueModel;
        
        $dados = $este->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/este/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $este = new EsteConEstoqueModel;

        if ($este->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "este", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/este/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $esteModel = $this->este;
        $view = $this->este->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/este/view.php';
    }

    # editar registro

    public function edit() {

        $esteModel = new EsteConEstoqueModel;

        if ($this->isPost()) {

            $result = $esteModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $esteModel->view($_POST['id_este']);
                $param = array('id'=> $_POST['id_este']);
                $this->redirect("ajuda", "este", "view", $param);
            }
        } else {

            $view = $esteModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/este/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->este->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "este", "index");
        
    }

}