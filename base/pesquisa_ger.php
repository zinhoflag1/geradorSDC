<?php include_once 'classe/Classe.PDO.php';
include_once 'classe/Classe.Gerador.php';

$gerador = new Gerador();

$tabela = $gerador->Tabela($_POST['tabela'], $_POST['selBanco']);

$campos = $gerador->Campos($_POST['tabela'], $_POST['selBanco']);

$inputs = "";

$inputsHead = "";

foreach ($campos['full'] as $key=>$campo) {
        $inputsHead .= "<th>{$campo->column_name}</th>\n";
        
        $inputs .= "<td>\".\${$smallTable}['{$campo->column_name}'].\"</td>\n";
     
}

$inputsHead .="<th>Opções</th>";

//var_dump($inputs);

# local C:\Users\zinhoflag1\Documents\DOWNLOAD\wamp64\www\gestaocedec\mod_ajuda\backEnd\View\conEstoque\marca\edit.php

$pesquisa = fopen("arquivo/crud/{$smallTable}/pesquisa.php", "w") or die("Unable to open file!");


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

<br>
<br>

<form method="post" action="#" name="frmBusca{$smallTableCamel}" id="frmBusca{$smallTableCamel}">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="search{$smallTableCamel}Name" id="searc{$smallTableCamel}Name">

    <br>

    <input type="submit" class="btn btn-info" name="btnBusca{$smallTableCamel}" id="btnBusca{$smallTableCamel}" value="Pesquisar">

</form>

<?php


\$btn = isset(\$_POST['btnBusca{$smallTableCamel}']) ? \$_POST['btnBusca{$smallTableCamel}'] : null;
\$nome = isset(\$_POST['search{$smallTableCamel}Name']) ? \$_POST['search{$smallTableCamel}Name'] : null;

if (\$btn == 'Pesquisar') {

    \$busca = new {$smallTableCamel}{$contexto}Model();
    \${$smallTable}s = \$busca->listaNome(\$nome);
    
    //var_dump(\$unidades);

    print "<legend>Pesquisa {$smallTableCamel}</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                {$inputsHead}
            </tr>
</thead>
<tbody>";

    foreach (\${$smallTable}s as \${$smallTable}) {

            print "<tr>
                    {$inputs}";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("{$mod}", "{$smallTable}", "view", array('id' => \${$smallTable}['{$campos['id']}'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("{$mod}", "{$smallTable}", "edit", array('id' => \${$smallTable}['{$campos['id']}'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("{$mod}", "{$smallTable}", "delete", array('id' => \${$smallTable}['{$campos['id']}'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
        }
       

    print " </tbody></table></div>";
}
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

        var itens = {
            data:
<?php print json_encode(\$dados{$smallTableCamel}); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    //var id = $("#searcid_marca").getSelectedItemData().id_marca;
                    //var nome = $("#searcid_marca").getSelectedItemData().nome;

                    // $("#nomeMarca_fk").val(nome); // Mudar
                    //$("#id_marca").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#search{$smallTableCamel}Name").easyAutocomplete(itens);

    });
</script>
        
codPhp;

try{
fwrite($pesquisa, $texto);
fclose($pesquisa);

} catch (Exception $e) {
    print $e->getMessage()."Erro na geração do arquivo pesquisa";
}


