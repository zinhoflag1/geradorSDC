<?php


//var_dump(get_defined_vars());

# local C:\Users\zinhoflag1\Documents\DOWNLOAD\wamp64\www\gestaocedec\mod_ajuda\backEnd\Controller\marcaController.php

$controller = fopen("arquivo/controller/{$smallTable}Controller.php", "w") or die("Unable to open file!");

$texto = <<< codPhp

<?php
include_once('core/Controller/Controller.php');
        
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *      Gerado de Código : 1.0
 * 	Controller tabela {$tabela}										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : {$dataAtual}															*
 * ********************************************************************************** */

class $nomeFileController extends Controller {

    private \${$smallTable};
    private \${$smallTable}s;
    private \$campos;
    public \$numPage;
    
    public function __construct() {
        \$this->$smallTable = new $nomeFileModel;
        \$this->{$smallTable}s = \$this->{$smallTable}->lista();

    }

    # index $smallTable

    public function index() {
        \${$smallTable}Model = \$this->{$smallTable};
        include_once 'mod_ajuda/backEnd/View/conEstoque/{$smallTable}/index.php';
    }

    /* paginacao */

    public function paginacao(\$page, \$numPage) {
        
        \$this->numPage = \$numPage;

        \$totalRegistro = count(\$this->{$smallTable}s);
        \$regPorPagina = \$numPage;
        
        \$totPag = ceil(\$totalRegistro / \$numPage);

        \$start = (\$page - 1) * \$regPorPagina;

        \$paginacao = \$this->{$smallTable}->paginacao(\$start, \$regPorPagina);
       
        return [\$paginacao, \$totPag];
       
    }
        
    ################  EXPORTAR ##################    
    # Exportar dados excel
    public function exportar() {

        \${$smallTable} = new {$smallTableCamel}ConEstoqueModel;
        
        \$dados = \${$smallTable}->lista();
        
        \$coluna = array_keys(\$dados[0]);
        
        \$data = array();
        
        array_push(\$data, \$coluna);
        
        foreach (\$dados as \$key => \$dado) {
            \$data[] = \$dado; 
        }

        \$nomeFileExcel = sys_get_temp_dir()."/Cadastro".ucfirst(\$_GET['controller'])."_".date("dmY_his").".xlsx";

        \$writer = new XLSXWriter();
        \$writer->writeSheet(\$data);
        \$writer->writeToFile(\$nomeFileExcel);

        header('Content-Description: File Transfer');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"" . basename(\$nomeFileExcel) . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Length: ' . filesize(\$nomeFileExcel)); //Remove
        ob_clean();
        flush();
        readfile(\$nomeFileExcel);
    }
        

    # formulario cadastro
    public function cadastro() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/{$smallTable}/cadastro.php';
    }

    ################  GRAVAR ##################    
    # gravar registro

    public function gravar() {

        \${$smallTable} = new $nomeFileModel;

        if (\${$smallTable}->gravar(\$_POST)) {
            FuncaoBase::alert("Registro Gravado com Sucesso !");
            \$this->redirect("ajuda", "{$smallTable}", "index");
        }
    }
            
    # pesquisa registro

    public function pesquisa() {

            include_once 'mod_ajuda/backEnd/View/conEstoque/{$smallTable}/pesquisa.php';
    }
    

    #visualizar registro

    public function view() {
         \${$smallTable}Model = \$this->{$smallTable};
        \$view = \$this->{$smallTable}->view(\$_GET['id']);
        include_once 'mod_ajuda/backEnd/View/conEstoque/{$smallTable}/view.php';
    }

    # editar registro

    public function edit() {

        \${$smallTable}Model = new {$smallTableCamel}ConEstoqueModel;

        if (\$this->isPost()) {

            \$result = \${$smallTable}Model->edit(\$_POST);
            
            //var_dump(\$result);
            if (!empty(\$result)) {
                FuncaoBase::alert("Registro Atualizado com Sucesso !");
                \$view = \${$smallTable}Model->view(\$_POST['{$id_tabela}']);
                \$param = array('id'=> \$_POST['{$id_tabela}']);
                \$this->redirect("{$mod}", "{$smallTable}", "view", \$param);
            }
        } else {

            \$view = \${$smallTable}Model->view(\$_GET['id']);
            include_once 'mod_ajuda/backEnd/View/conEstoque/{$smallTable}/edit.php';
        }
    }
    
    /*  deletar registro */
    public function delete() {
        
       if(\$this->{$smallTable}->delete(\$_GET['id'])){
           FuncaoBase::alert("Registro Apagado com Sucesso !");
       }

            \$this->redirect("{$mod}", "{$smallTable}", "index");
        
    }

}
codPhp;

try{
fwrite($controller, $texto);
fclose($controller);

} catch (Exception $e) {
    print $e->getMessage()."Erro na geração do arquivo controller";
}