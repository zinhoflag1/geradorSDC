
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela evento										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 23/10/2020															*
 * ********************************************************************************** */

class ventoController extends Controller {

    private $vento;
    private $ventos;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->vento = new VentoModel;
        $this->ventos = $this->vento->lista();

    }

    # index vento

    public function index() {
        $ventoModel = $this->vento;
        include_once 'mod_ajuda/backEnd/View/conEstoque/vento/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->ventos);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->vento->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $vento = new VentoConEstoqueModel;
        
        $dados = $vento->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/vento/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $vento = new VentoModel;

        if ($vento->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "vento", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/vento/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $ventoModel = $this->vento;
        $view = $this->vento->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/vento/view.php';
    }

    # editar registro

    public function edit() {

        $ventoModel = new VentoConEstoqueModel;

        if ($this->isPost()) {

            $result = $ventoModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $ventoModel->view($_POST['id_vento']);
                $param = array('id'=> $_POST['id_vento']);
                $this->redirect("", "vento", "view", $param);
            }
        } else {

            $view = $ventoModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/vento/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->vento->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("", "vento", "index");
        
    }

}