

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

<legend>Editar Cadastro Dest</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "dest", "edit");?>" method="post" accept-charset="utf-8" name="frmDest" id="frmDest">
    
<div class='col-md-6'>
<label>Id Destinatario</label>
<input type="text" class='form form-control' name='id_dest' id='id_dest' value='<?=$view[0]['id_dest']?>'  readonly=readonly >
</div>
<div class='col-md-6'>
<label>Nome do Destinatario</label>
<input type="text" class='form form-control' name='nome' id='nome' value='<?=$view[0]['nome']?>'  maxlength='69' required>
</div>
<div class='col-md-6'>
<label>CNPJ</label>
<input type="text" class='form form-control' name='cnpj' id='cnpj' value='<?=$view[0]['cnpj']?>'  maxlength='44' required>
</div>
<div class='col-md-6'>
<label>Endereço</label>
<input type="text" class='form form-control' name='endereco' id='endereco' value='<?=$view[0]['endereco']?>'  maxlength='44' required>
</div>
<div class='col-md-6'>
<label>Municipio</label>
<input type="text" class='form form-control' name='municipio' id='municipio' value='<?=$view[0]['municipio']?>'  maxlength='44' required>
</div>
<div class='col-md-6'>
<label>Estado</label>
<input type="text" class='form form-control' name='estado' id='estado' value='<?=$view[0]['estado']?>'  maxlength='44' required>
</div>
<div class='col-md-6'>
<label>Cep</label>
<input type="text" class='form form-control' name='cep' id='cep' value='<?=$view[0]['cep']?>'  maxlength='44' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "dest", "index")?>">Voltar</a>
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
        