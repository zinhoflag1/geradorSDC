

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

<legend>Editar Cadastro Baixa</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "baixa", "edit");?>" method="post" accept-charset="utf-8" name="frmBaixa" id="frmBaixa">
    
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='id_baixa' id='id_baixa' value='<?=$view[0]['id_baixa']?>'  readonly=readonly >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='id_produto' id='id_produto' value='<?=$view[0]['id_produto']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='id_deposito' id='id_deposito' value='<?=$view[0]['id_deposito']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='data' id='data' value='<?=$view[0]['data']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='quantidade' id='quantidade' value='<?=$view[0]['quantidade']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='motivo' id='motivo' value='<?=$view[0]['motivo']?>'  maxlength='69' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "baixa", "index")?>">Voltar</a>
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
    
     /* close focus pesquisa */
        

        
        
        

    });
</script>
        