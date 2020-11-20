<?php

//smalltable

$tabela = isset($_POST['tabela']) ? $_POST['tabela'] : "default";
$tabelaUc = ucfirst($tabela);

try{

copy ($_SERVER['DOCUMENT_ROOT']."/geradorsdc/arquivo/model/{$tabelaUc}ConEstoqueModel.php", "C:/Users\zinhoflag1/Documents/DOWNLOAD/wamp64/www/gestaocedec/mod_ajuda/Model/ ");
die();
copy ($_SERVER['DOCUMENT_ROOT']."/geradorsdc/arquivo/controller/{$tabela}Controller.php", "C:\Users\zinhoflag1\Documents\DOWNLOAD\wamp64\www\gestaocedec\mod_ajuda\backEnd\Controller\ ");
copy ($_SERVER['DOCUMENT_ROOT']."/geradorsdc/arquivo/crud/{$tabela}/cadastro.php", "C:\Users\zinhoflag1\Documents\DOWNLOAD\wamp64\www\gestaocedec\mod_ajuda\backEnd\View\conEstoque\{$tabela}\ ");
copy ($_SERVER['DOCUMENT_ROOT']."/geradorsdc/arquivo/crud/{$tabela}/edit.php", " C:\Users\zinhoflag1\Documents\DOWNLOAD\wamp64\www\gestaocedec\mod_ajuda\backEnd\View\conEstoque\{$tabela}\ ");
copy ($_SERVER['DOCUMENT_ROOT']."/geradorsdc/arquivo/crud/{$tabela}/index.php", " C:\Users\zinhoflag1\Documents\DOWNLOAD\wamp64\www\gestaocedec\mod_ajuda\backEnd\View\conEstoque\{$tabela}\ ");

} catch (Exception $e) {
    $e->getMessage();
}