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
var_dump($tabela);
//die();

var_dump($path."/".$caminho."/".$modulo."/Model");

try{
    if(!file_exists($path."/".$caminho."/".$modulo."/Model")){
        mkdir($path."/".$caminho."/".$modulo."/Model");
    }
    
    /* cria pasta contexto se nao existir
    /modulo/backEnd/View/contexto */
    if(!file_exists($path."/".$caminho."/".$modulo."/".$bacFront."/View/".$tabela)){
        mkdir($path."/".$caminho."/".$modulo."/".$bacFront."/View/".$tabela);
    }
    

copy ($path."/geradorsdc/arquivo/model/".$tabelaUc."Model.php", $path."/".$caminho."/".$modulo."/Model/{$tabelaUc}Model.php");

copy ($path."/geradorsdc/arquivo/controller/".$tabela."Controller.php", $path."/".$caminho."/".$modulo."/".$bacFront."/Controller/".$tabela."Controller.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/cadastro.php", $path."/".$caminho."/".$modulo."/".$bacFront."/View/".$tabela."/cadastro.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/edit.php",     $path."/".$caminho."/".$modulo."/".$bacFront."/View/".$tabela."/edit.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/index.php",    $path."/".$caminho."/".$modulo."/".$bacFront."/View/".$tabela."/index.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/view.php",     $path."/".$caminho."/".$modulo."/".$bacFront."/View/".$tabela."/view.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/pesquisa.php", $path."/".$caminho."/".$modulo."/".$bacFront."/View/".$tabela."/pesquisa.php");
/* injetar model include */




return true;

} catch (Exception $e) {
    $e->getMessage();
}