
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "destinatario", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "destinatario", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaDestinatario" id="frmBuscaDestinatario">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchDestinatarioName" id="searcDestinatarioName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaDestinatario" id="btnBuscaDestinatario" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaDestinatario']) ? $_POST['btnBuscaDestinatario'] : null;
$nome = isset($_POST['searchDestinatarioName']) ? $_POST['searchDestinatarioName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new DestinatarioConEstoqueModel();
    $destinatarios = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Destinatario</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_destinatario</th>
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

    foreach ($destinatarios as $destinatario) {

            print "<tr>
                    <td>".$destinatario['id_destinatario']."</td>
<td>".$destinatario['nome']."</td>
<td>".$destinatario['cnpj']."</td>
<td>".$destinatario['endereco']."</td>
<td>".$destinatario['municipio']."</td>
<td>".$destinatario['estado']."</td>
<td>".$destinatario['cep']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "destinatario", "view", array('id' => $destinatario['id_destinatario'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "destinatario", "edit", array('id' => $destinatario['id_destinatario'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "destinatario", "delete", array('id' => $destinatario['id_destinatario'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosDestinatario); ?>, // array com os dados
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
        $("#searchDestinatarioName").easyAutocomplete(itens);

    });
</script>
        