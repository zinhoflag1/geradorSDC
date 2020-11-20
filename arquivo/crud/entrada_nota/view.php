
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

<legend><?=$view[1]['tabela']->table_comment?></legend>
<table class="table table-bordered table-striped">

    <tr>
                <td class="col-md-3">Identificador Entrada Nota :</td><td><?=$view[0]['id_entrada_nota'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Fornecedor :</td><td><?=$entrada_notaModel->getNomeIdFk('aju_fornecedor','id_fornecedor', $view[0]['id_fornecedor'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data Emissao :</td><td><?=$view[0]['data_emissao'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data Entrega :</td><td><?=$view[0]['data_entrega'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Natureza :</td><td><?=$entrada_notaModel->getNomeIdFk('aju_natureza','id_natureza', $view[0]['id_natureza'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Itens notas :</td><td><?=$entrada_notaModel->getNomeIdFk('aju_itens_nota','id_itens_nota', $view[0]['id_itens_nota'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Almoxarifado :</td><td><?=$entrada_notaModel->getNomeIdFk('aju_almoxarifado','id_almoxarifado', $view[0]['id_almoxarifado'])->nome;?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "entrada_nota", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "entrada_nota", "edit", array('id'=>$view[0]['id_entrada_nota'])) ?>">Editar</a>
<br>
<br>

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
