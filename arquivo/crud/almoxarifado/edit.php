

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

<?php



?>

<legend>Editar Cadastro Almoxarifado</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "almoxarifado", "edit");?>" method="post" accept-charset="utf-8" name="frmAlmoxarifado" id="frmAlmoxarifado">
    
<div class='col-md-6'>
<label>Identificador Almoxarifado</label>
<input type="text" class='form form-control' name='id_almoxarifado' id='id_almoxarifado' value='<?=$view[0]['id_almoxarifado']?>'  readonly=readonly >
</div>
<div class='col-md-6'>
<label>Nome Almoxarifado</label>
<input type="text" class='form form-control' name='nome' id='nome' value='<?=$view[0]['nome']?>'  maxlength='69' required>
</div>
<div class='col-md-6'>
<label>Endereço Almoxarifado</label>
<input type="text" class='form form-control' name='endereco' id='endereco' value='<?=$view[0]['endereco']?>'  maxlength='69' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "almoxarifado", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Atualizar">
    </div>
</form>
        
    

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
        