
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "transportadora", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "transportadora", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaTransportadora" id="frmBuscaTransportadora">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchTransportadoraName" id="searcTransportadoraName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaTransportadora" id="btnBuscaTransportadora" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaTransportadora']) ? $_POST['btnBuscaTransportadora'] : null;
$nome = isset($_POST['searchTransportadoraName']) ? $_POST['searchTransportadoraName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new TransportadoraConEstoqueModel();
    $transportadoras = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Transportadora</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_transportadora</th>
<th>nome</th>
<th>cnpj</th>
<th>tel</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($transportadoras as $transportadora) {

            print "<tr>
                    <td>".$transportadora['id_transportadora']."</td>
<td>".$transportadora['nome']."</td>
<td>".$transportadora['cnpj']."</td>
<td>".$transportadora['tel']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "transportadora", "view", array('id' => $transportadora['id_transportadora'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "transportadora", "edit", array('id' => $transportadora['id_transportadora'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "transportadora", "delete", array('id' => $transportadora['id_transportadora'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosTransportadora); ?>, // array com os dados
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
        $("#searchTransportadoraName").easyAutocomplete(itens);

    });
</script>
        