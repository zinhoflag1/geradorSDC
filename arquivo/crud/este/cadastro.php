

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

<legend>Cadastro de Este</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "este", "gravar");?>" method="post" accept-charset="utf-8" name="frmEste" id="frmEste">
    
    <div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='data' id='data' maxlength='' required >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='CodUf' id='CodUf' maxlength='49' required >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='Codmundv' id='Codmundv' maxlength='49' required >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='Codmun' id='Codmun' maxlength='49' required >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='NomeMunic' id='NomeMunic' maxlength='69' required >
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
        
    
        $("#frmEste").trigger("reset");
    
        
        
        
   
        

    });
</script>
        