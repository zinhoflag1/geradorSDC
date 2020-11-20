
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
                <td class="col-md-3">Identificador :</td><td><?=$view[0]['id_transportadora'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome Transportadora :</td><td><?=$view[0]['nome'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Cnpj Transportadora :</td><td><?=$view[0]['cnpj'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Telefone :</td><td><?=$view[0]['tel'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "transportadora", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "transportadora", "edit", array('id'=>$view[0]['id_transportadora'])) ?>">Editar</a>
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
