
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela aju_dest										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class destController extends Controller {

    private $dest;
    private $dests;
    private $campos;
    public $numPage;

    public function __construct() {
        $this->dest = new DestConEstoqueModel;
        $this->dests = $this->dest->lista();

    }

    # index dest

    public function index() {
        $destModel = $this->dest;
        include_once 'mod_ajuda/backEnd/View/conEstoque/dest/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->dests);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->dest->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
        
    # Exportar dados excel
    public function exportar() {

        $dest = new DestConEstoqueModel;
        
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
        include_once 'mod_ajuda/backEnd/View/conEstoque/dest/cadastro.php';
    }

    # gravar registro

    public function gravar() {

        $dest = new DestConEstoqueModel;

        if ($dest->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "dest", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/dest/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $destModel = $this->dest;
        $view = $this->dest->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/dest/view.php';
    }

    # editar registro

    public function edit() {

        $destModel = new DestConEstoqueModel;

        if ($this->isPost()) {

            $result = $destModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $destModel->view($_POST['id_dest']);
                $param = array('id'=> $_POST['id_dest']);
                $this->redirect("ajuda", "dest", "view", $param);
            }
        } else {

            $view = $destModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/dest/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->dest->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "dest", "index");
        
    }

}