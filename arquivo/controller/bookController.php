
<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela simple_book										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 01/07/2021															*
 * ********************************************************************************** */

class bookController extends Controller {

    private $book;
    private $books;
    private $campos;
    public $numPage;
    
    public function __construct() {
        $this->book = new BookModel;
        $this->books = $this->book->lista();

    }

    # index book

    public function index() {
        $bookModel = $this->book;
        include_once 'mod_ajuda/backEnd/View/book/index.php';
    }

    /* paginacao */

    public function paginacao($page, $numPage) {
        
        $this->numPage = $numPage;

        $totalRegistro = count($this->books);
        $regPorPagina = $numPage;
        
        $totPag = ceil($totalRegistro / $numPage);

        $start = ($page - 1) * $regPorPagina;

        $paginacao = $this->book->paginacao($start, $regPorPagina);
       
        return [$paginacao, $totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        $book = new BookModel;
        
        $dados = $book->lista();
        
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
        include_once 'mod_ajuda/backEnd/View/book/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        $book = new BookModel;

        if ($book->gravar($_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            $this->redirect("ajuda", "book", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/book/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         $bookModel = $this->book;
        $view = $this->book->view($_GET['id']);
        include_once 'mod_ajuda/backEnd/View/book/view.php';
    }

    # editar registro

    public function edit() {

        $bookModel = new BookModel;

        if ($this->isPost()) {

            $result = $bookModel->edit($_POST);
            
            //var_dump($result);
            if (!empty($result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                $view = $bookModel->view($_POST['id_book']);
                $param = array('id'=> $_POST['id_book']);
                $this->redirect("ajuda", "book", "view", $param);
            }
        } else {

            $view = $bookModel->view($_GET['id']);
            include_once 'mod_ajuda/backEnd/View/book/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if($this->book->delete($_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            $this->redirect("ajuda", "book", "index");
        
    }

}