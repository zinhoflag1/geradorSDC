

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

<legend>Editar Cadastro Este</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "este", "edit");?>" method="post" accept-charset="utf-8" name="frmEste" id="frmEste">
    
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='idteste' id='idteste' value='<?=$view[0]['idteste']?>'  readonly=readonly >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='data' id='data' value='<?=$view[0]['data']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='CodUf' id='CodUf' value='<?=$view[0]['CodUf']?>'  maxlength='49' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='Codmundv' id='Codmundv' value='<?=$view[0]['Codmundv']?>'  maxlength='49' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='Codmun' id='Codmun' value='<?=$view[0]['Codmun']?>'  maxlength='49' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='NomeMunic' id='NomeMunic' value='<?=$view[0]['NomeMunic']?>'  maxlength='69' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "este", "index")?>">Voltar</a>
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
        