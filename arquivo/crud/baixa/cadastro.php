

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

<legend>Cadastro de Baixa</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "baixa", "gravar");?>" method="post" accept-charset="utf-8" name="frmBaixa" id="frmBaixa">
    
    <div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='id_produto' id='id_produto' maxlength='' required >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='id_deposito' id='id_deposito' maxlength='' required >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='data' id='data' maxlength='' required >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='quantidade' id='quantidade' maxlength='' required >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='motivo' id='motivo' maxlength='69' required >
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "conestoque", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
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
        
    
        $("#frmBaixa").trigger("reset");
    
        
        
        
   
        

    });
</script>
        