
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
                <td class="col-md-3">Identificador Montagem Carga :</td><td><?=$view[0]['id_montagem'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Data Montagem Carga :</td><td><?=$view[0]['data_montagem'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome Motorista :</td><td><?=$view[0]['motorista'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">placa do veículo :</td><td><?=$view[0]['placa'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3"> :</td><td><?=$montagemModel->getNomeIdFk('aju_transportadora','id_transportadora', $view[0]['id_transportadora'])->nome;?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "montagem", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "montagem", "edit", array('id'=>$view[0]['id_montagem'])) ?>">Editar</a>
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
