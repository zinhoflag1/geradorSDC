
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "unidade_descr", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "unidade_descr", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaUnidade_descr" id="frmBuscaUnidade_descr">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchUnidade_descrName" id="searcUnidade_descrName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaUnidade_descr" id="btnBuscaUnidade_descr" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaUnidade_descr']) ? $_POST['btnBuscaUnidade_descr'] : null;
$nome = isset($_POST['searchUnidade_descrName']) ? $_POST['searchUnidade_descrName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new Unidade_descrConEstoqueModel();
    $unidade_descrs = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Unidade_descr</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_unid_descr</th>
<th>id_produto</th>
<th>nome</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($unidade_descrs as $unidade_descr) {

            print "<tr>
                    <td>".$unidade_descr['id_unid_descr']."</td>
<td>".$unidade_descr['id_produto']."</td>
<td>".$unidade_descr['nome']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "unidade_descr", "view", array('id' => $unidade_descr['id_unid_descr'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "unidade_descr", "edit", array('id' => $unidade_descr['id_unid_descr'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "unidade_descr", "delete", array('id' => $unidade_descr['id_unid_descr'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosUnidade_descr); ?>, // array com os dados
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
        $("#searchUnidade_descrName").easyAutocomplete(itens);

    });
</script>
        