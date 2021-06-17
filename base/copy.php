<?php

//smalltable

$tabela = isset($_POST['tabela']) ? $_POST['tabela'] : "default";
$tabelaUc = ucfirst($tabela);

$caminho = $_POST['txtBase'] ? $_POST['txtBase'] : "";
$modulo = $_POST['modulo'] ? $_POST['modulo'] : "";
$bacFront = $_POST['bacfront'] ? $_POST['bacfront'] : ""; 
$view = $_POST['view'] ? $_POST['view'] : "";
$controller = $_POST['controller'] ? $_POST['controller'] : "";
$model = $_POST['model'] ? $_POST['model'] : "";
$contexto = $_POST['contexto'] ? $_POST['contexto'] : "";
$smallTable = $_POST['contexto'] ? $_POST['contexto'] : "";

$path = $_SERVER['DOCUMENT_ROOT'];

//var_dump($_SERVER['']);
//
//var_dump($tabela);
//die();

//var_dump($path."/".$caminho."/".$modulo."/Model");

try{
    if(!file_exists($path."/".$caminho."/".$modulo."/Model")){
        mkdir($path."/".$caminho."/".$modulo."/Model");
    }
    

    $pastaContexto = "";
    
    if(strlen($contexto) > 0){
        $pastaContexto = $contexto."/";
        if(!file_exists($path."/".$caminho."/".$modulo."/".$bacFront."/View/".$contexto)){
            mkdir($path."/".$caminho."/".$modulo."/".$bacFront."/View/".$contexto);
        }
        if(!file_exists($path."/".$caminho."/".$modulo."/".$bacFront."/View/".$contexto."/".$tabela)){
            mkdir($path."/".$caminho."/".$modulo."/".$bacFront."/View/".$contexto."/".$tabela);
        }
    }else {
        /* cria pasta contexto se nao existir
        /modulo/backEnd/View/contexto */
        if(!file_exists($path."/".$caminho."/".$modulo."/".$bacFront."/View/".$tabela)){
            mkdir($path."/".$caminho."/".$modulo."/".$bacFront."/View/".$tabela);
        }
    }
    
 /* adicionar o model no \core\include.php*/
    $msg = "include_once PATH . '/{$modulo}/Model/{$tabelaUc}{$contexto}Model.php';";
    $myfile = fopen($path."/".$caminho."/core/include.php", "a");
    fwrite($myfile, $msg."\n");
    fclose($myfile);
    
/*  copia os arquivos para o projeto*/
copy ($path."/geradorsdc/arquivo/model/".$tabelaUc.$contexto."Model.php", $path."/".$caminho."/".$modulo."/Model/{$tabelaUc}{$contexto}Model.php");

copy ($path."/geradorsdc/arquivo/controller/".$tabela."Controller.php", $path."/".$caminho."/".$modulo."/".$bacFront."/Controller/".$tabela."Controller.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/cadastro.php", $path."/".$caminho."/".$modulo."/".$bacFront."/View/".$pastaContexto.$tabela."/cadastro.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/edit.php",     $path."/".$caminho."/".$modulo."/".$bacFront."/View/".$pastaContexto.$tabela."/edit.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/index.php",    $path."/".$caminho."/".$modulo."/".$bacFront."/View/".$pastaContexto.$tabela."/index.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/view.php",     $path."/".$caminho."/".$modulo."/".$bacFront."/View/".$pastaContexto.$tabela."/view.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/pesquisa.php", $path."/".$caminho."/".$modulo."/".$bacFront."/View/".$pastaContexto.$tabela."/pesquisa.php");
/* injetar model include */




return true;

} catch (Exception $e) {
    $e->getMessage();
}