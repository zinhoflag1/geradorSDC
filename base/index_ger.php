<?php include_once 'classe/Classe.PDO.php';
include_once 'classe/Classe.Gerador.php';

$gerador = new Gerador();

$tabela = $gerador->Tabela($_POST['tabela'], $_POST['selBanco']);

$campos = $gerador->Campos($_POST['tabela'], $_POST['selBanco']);

$inputs = "";

$inputsHead = "";


$datamask = "";

foreach ($campos['full'] as $key=>$campo) {
        $inputsHead .= "<th>{$campo->column_name}</th>\n";
        
        $id_fk = $campo->column_name;
            
        #nome da tabela FK
        $nomeTableFk = $gerador->getNomeTableFK($tabela['tabela']->table_name, $id_fk);
        
        if($campo->column_key == "MUL"){
            $inputs .= "<td>\".\${$smallTable}Model->getNomeIdFk('{$nomeTableFk[0]->tabela}','{$campo->column_name}', \${$smallTable}['{$campo->column_name}'])->nome.\"</td>\n";
        }else {
            $inputs .= "<td>\".\${$smallTable}['{$campo->column_name}'].\"</td>\n";   
        }
}

$inputsHead .="<th>Opções</th>";

# local C:\Users\zinhoflag1\Documents\DOWNLOAD\wamp64\www\gestaocedec\mod_ajuda\backEnd\View\conEstoque\marca\edit.php

$index = fopen("arquivo/crud/{$smallTable}/index.php", "w") or die("Unable to open file!");


$texto = <<< codPhp
<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("{$mod}", "{$smallTable}", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("{$mod}", "{$smallTable}", "cadastro") ?>" title="Novo Registro">+ Novo</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("{$mod}", "{$smallTable}", "pesquisa") ?>" title="Busca Registro">Pesquisa</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("{$mod}", "{$smallTable}", "exportar") ?>" title="Exportar dados Excel">Exportar Excel</a>
   <br>
<br>

<?php


\$page = (!isset(\$_GET['page'])) ? 1 : \$_GET['page'];

\$numRegPorPagina = 10;
\$pag = new {$smallTableCamel}Controller();
\$paginacao= \$pag->paginacao(\$page, \$numRegPorPagina);

\$no = (\$page >1) ? 1: 1;

\$nr = 0;

print "<legend>Menu </legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                {$inputsHead}
            </tr>
</thead>
<tbody>";

foreach (\$paginacao[0] as \${$smallTable}) {

            print "<tr>
                    {$inputs}";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("{$mod}", "{$smallTable}", "view", array('id' => \${$smallTable}['{$campos['id']}'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("{$mod}", "{$smallTable}", "edit", array('id' => \${$smallTable}['{$campos['id']}'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("{$mod}", "{$smallTable}", "delete", array('id' => \${$smallTable}['{$campos['id']}'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
            \$nr += \$no;
        }
       

        print " </tbody></table></div>";
        
        print "<div class=\"col-md-12 text-center\">";

        print "<ul class=\"pagination\">";

        print "<li><a href=\"" . FuncaoBase::geraLink('{$mod}', '{$smallTable}', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

        for (\$p = 1; \$p <= \$paginacao[1]; \$p++) {

            print "<li class=\"" . (\$page == \$p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('{$mod}', '{$smallTable}', 'index', array('page' => \$p)) . "\">" . \$p . "</a></li>";
            if((\$p > 1) && (\$p % 15 == 0)) {
            print "</ul>";
                print "<ul class=\"pagination\">";
            }
        }
        print "<li><a href=\"" . FuncaoBase::geraLink('{$mod}', '{$smallTable}', 'index', array('page' => \$paginacao[1])) . "\">Último</a></li>";
        print "</ul>";
        print "</div>";

?>


<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {

    });
</script>
        
codPhp;

try{
fwrite($index, $texto);
fclose($index);

} catch (Exception $e) {
    print $e->getMessage()."Erro na geração do arquivo controller";
}



