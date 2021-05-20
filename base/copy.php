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

$path = $_SERVER['DOCUMENT_ROOT'];

if (!file_exists($caminho."/".$modulo."/".$bacFront."/".$view."/".$contexto."/".$tabela."/")) {
                mkdir($caminho."/".$modulo."/".bacFront."/".$view."/".$contexto."/".$tabela."/");
            }

try{

copy ($path."/geradorsdc/arquivo/model/".$tabelaUc.$contexto.".php", $caminho."\gestaocedec/mod_ajuda/Model/{$tabelaUc}ConEstoqueModel.php");
/*
copy ($path."/geradorsdc/arquivo/controller/".$tabela."Controller.php", $caminho."\mod_ajuda\backEnd\Controller/{$tabela}Controller.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/cadastro.php", $caminho."/mod_ajuda/backEnd/View/conEstoque/$tabela/cadastro.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/edit.php",     $caminho."/mod_ajuda/backEnd/View/conEstoque/$tabela/edit.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/index.php",    $caminho."/mod_ajuda/backEnd/View/conEstoque/$tabela/index.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/view.php",     $caminho."/mod_ajuda/backEnd/View/conEstoque/$tabela/view.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/pesquisa.php",     $caminho."/mod_ajuda/backEnd/View/conEstoque/$tabela/pesquisa.php");
/*
/* injetar model include */




return true;

} catch (Exception $e) {
    $e->getMessage();
}