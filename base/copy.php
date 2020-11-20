<?php

//smalltable

$tabela = isset($_POST['tabela']) ? $_POST['tabela'] : "default";
$tabelaUc = ucfirst($tabela);

$path = $_SERVER['DOCUMENT_ROOT'];

if (!file_exists("C:/Users/zinhoflag1/Documents/DOWNLOAD/wamp64/www/gestaocedec/mod_ajuda/backEnd/View/conEstoque/{$tabela}/")) {
                mkdir("C:/Users/zinhoflag1/Documents/DOWNLOAD/wamp64/www/gestaocedec/mod_ajuda/backEnd/View/conEstoque/{$tabela}/");
            }

try{

copy ($path."/geradorsdc/arquivo/model/".$tabelaUc."ConEstoqueModel.php", "C:/Users\zinhoflag1/Documents/DOWNLOAD/wamp64/www/gestaocedec/mod_ajuda/Model/{$tabelaUc}ConEstoqueModel.php");

copy ($path."/geradorsdc/arquivo/controller/".$tabela."Controller.php", "C:\Users\zinhoflag1\Documents\DOWNLOAD\wamp64\www\gestaocedec\mod_ajuda\backEnd\Controller/{$tabela}Controller.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/cadastro.php", "C:/Users/zinhoflag1/Documents/DOWNLOAD/wamp64/www/gestaocedec/mod_ajuda/backEnd/View/conEstoque/$tabela/cadastro.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/edit.php",     "C:/Users/zinhoflag1/Documents/DOWNLOAD/wamp64/www/gestaocedec/mod_ajuda/backEnd/View/conEstoque/$tabela/edit.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/index.php",    "C:/Users/zinhoflag1/Documents/DOWNLOAD/wamp64/www/gestaocedec/mod_ajuda/backEnd/View/conEstoque/$tabela/index.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/view.php",     "C:/Users/zinhoflag1/Documents/DOWNLOAD/wamp64/www/gestaocedec/mod_ajuda/backEnd/View/conEstoque/$tabela/view.php");
copy ($path."/geradorsdc/arquivo/crud/".$tabela."/pesquisa.php",     "C:/Users/zinhoflag1/Documents/DOWNLOAD/wamp64/www/gestaocedec/mod_ajuda/backEnd/View/conEstoque/$tabela/pesquisa.php");

/* injetar model include */




return true;

} catch (Exception $e) {
    $e->getMessage();
}