
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "dest", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "dest", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaDest" id="frmBuscaDest">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchDestName" id="searcDestName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaDest" id="btnBuscaDest" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaDest']) ? $_POST['btnBuscaDest'] : null;
$nome = isset($_POST['searchDestName']) ? $_POST['searchDestName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new DestConEstoqueModel();
    $dests = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Dest</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_dest</th>
<th>nome</th>
<th>cnpj</th>
<th>endereco</th>
<th>municipio</th>
<th>estado</th>
<th>cep</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($dests as $dest) {

            print "<tr>
                    <td>".$dest['id_dest']."</td>
<td>".$dest['nome']."</td>
<td>".$dest['cnpj']."</td>
<td>".$dest['endereco']."</td>
<td>".$dest['municipio']."</td>
<td>".$dest['estado']."</td>
<td>".$dest['cep']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "dest", "view", array('id' => $dest['id_dest'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "dest", "edit", array('id' => $dest['id_dest'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "dest", "delete", array('id' => $dest['id_dest'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosDest); ?>, // array com os dados
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
        $("#searchDestName").easyAutocomplete(itens);

    });
</script>
        