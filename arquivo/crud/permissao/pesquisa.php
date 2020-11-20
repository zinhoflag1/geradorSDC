
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "permissao", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "permissao", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaPermissao" id="frmBuscaPermissao">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchPermissaoName" id="searcPermissaoName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaPermissao" id="btnBuscaPermissao" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaPermissao']) ? $_POST['btnBuscaPermissao'] : null;
$nome = isset($_POST['searchPermissaoName']) ? $_POST['searchPermissaoName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new PermissaoConEstoqueModel();
    $permissaos = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Permissao</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_permissao</th>
<th>login</th>
<th>nivel</th>
<th>cad_material</th>
<th>cad_pagamento</th>
<th>cad_transferencia</th>
<th>cad_liberacao</th>
<th>cad_ajuda_suporte</th>
<th>cad_usuario</th>
<th>cad_conf_ger</th>
<th>relatorio</th>
<th>rel_saldo_geral</th>
<th>rel_saldo_p_deposito</th>
<th>liberacao</th>
<th>rel_comp_liberacao</th>
<th>rel_mat_liberado</th>
<th>rel_mat_pago</th>
<th>rel_comp_mat_pago</th>
<th>transferencia</th>
<th>rel_mat_transferido</th>
<th>rel_mat_transito</th>
<th>lembrete_libera</th>
<th>lembrete_transito</th>
<th>inicial</th>
<th>cad_deposito</th>
<th>rel_cad_mat</th>
<th>rel_resumo_liberacao</th>
<th>pedido_ajuda</th>
<th>controle_estoque</th>
<th>cancLibPaga</th>
<th>tdap</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($permissaos as $permissao) {

            print "<tr>
                    <td>".$permissao['id_permissao']."</td>
<td>".$permissao['login']."</td>
<td>".$permissao['nivel']."</td>
<td>".$permissao['cad_material']."</td>
<td>".$permissao['cad_pagamento']."</td>
<td>".$permissao['cad_transferencia']."</td>
<td>".$permissao['cad_liberacao']."</td>
<td>".$permissao['cad_ajuda_suporte']."</td>
<td>".$permissao['cad_usuario']."</td>
<td>".$permissao['cad_conf_ger']."</td>
<td>".$permissao['relatorio']."</td>
<td>".$permissao['rel_saldo_geral']."</td>
<td>".$permissao['rel_saldo_p_deposito']."</td>
<td>".$permissao['liberacao']."</td>
<td>".$permissao['rel_comp_liberacao']."</td>
<td>".$permissao['rel_mat_liberado']."</td>
<td>".$permissao['rel_mat_pago']."</td>
<td>".$permissao['rel_comp_mat_pago']."</td>
<td>".$permissao['transferencia']."</td>
<td>".$permissao['rel_mat_transferido']."</td>
<td>".$permissao['rel_mat_transito']."</td>
<td>".$permissao['lembrete_libera']."</td>
<td>".$permissao['lembrete_transito']."</td>
<td>".$permissao['inicial']."</td>
<td>".$permissao['cad_deposito']."</td>
<td>".$permissao['rel_cad_mat']."</td>
<td>".$permissao['rel_resumo_liberacao']."</td>
<td>".$permissao['pedido_ajuda']."</td>
<td>".$permissao['controle_estoque']."</td>
<td>".$permissao['cancLibPaga']."</td>
<td>".$permissao['tdap']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "permissao", "view", array('id' => $permissao['id_permissao'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "permissao", "edit", array('id' => $permissao['id_permissao'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "permissao", "delete", array('id' => $permissao['id_permissao'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosPermissao); ?>, // array com os dados
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
        $("#searchPermissaoName").easyAutocomplete(itens);

    });
</script>
        