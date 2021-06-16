
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "baixa", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "baixa", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaBaixa" id="frmBuscaBaixa">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchBaixaName" id="searcBaixaName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaBaixa" id="btnBuscaBaixa" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaBaixa']) ? $_POST['btnBuscaBaixa'] : null;
$nome = isset($_POST['searchBaixaName']) ? $_POST['searchBaixaName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new BaixaConEstoqueModel();
    $baixas = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Baixa</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_baixa</th>
<th>id_produto</th>
<th>id_deposito</th>
<th>data</th>
<th>quantidade</th>
<th>motivo</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($baixas as $baixa) {

            print "<tr>
                    <td>".$baixa['id_baixa']."</td>
<td>".$baixa['id_produto']."</td>
<td>".$baixa['id_deposito']."</td>
<td>".$baixa['data']."</td>
<td>".$baixa['quantidade']."</td>
<td>".$baixa['motivo']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "baixa", "view", array('id' => $baixa['id_baixa'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "baixa", "edit", array('id' => $baixa['id_baixa'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "baixa", "delete", array('id' => $baixa['id_baixa'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosBaixa); ?>, // array com os dados
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
        $("#searchBaixaName").easyAutocomplete(itens);

    });
</script>
        