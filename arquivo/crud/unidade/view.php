
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
                <td class="col-md-3">Identificador :</td><td><?=$view[0]['id_unidade'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Nome do Material :</td><td><?=$view[0]['nome'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Descrição Material :</td><td><?=$view[0]['descricao'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Valor Material :</td><td><?=$view[0]['valor'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Validade Material :</td><td><?=$view[0]['data_validade'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador Marca :</td><td><?=$unidadeModel->getNomeIdFk('aju_marca','id_marca', $view[0]['id_marca'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador Categoria :</td><td><?=$unidadeModel->getNomeIdFk('aju_categoria','id_categoria', $view[0]['id_categoria'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador Almoxarifado :</td><td><?=$unidadeModel->getNomeIdFk('aju_almoxarifado','id_almoxarifado', $view[0]['id_almoxarifado'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Identificador do Fornecedor :</td><td><?=$unidadeModel->getNomeIdFk('aju_fornecedor','id_fornecedor', $view[0]['id_fornecedor'])->nome;?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Unidade de Medida :</td><td><?=$unidadeModel->getNomeIdFk('aju_unidade_med','id_unidade_med', $view[0]['id_unidade_med'])->nome;?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "unidade", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "unidade", "edit", array('id'=>$view[0]['id_unidade'])) ?>">Editar</a>
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
