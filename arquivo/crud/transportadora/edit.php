

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

<legend>Editar Cadastro Transportadora</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "transportadora", "edit");?>" method="post" accept-charset="utf-8" name="frmTransportadora" id="frmTransportadora">
    
<div class='col-md-6'>
<label>Identificador</label>
<input type="text" class='form form-control' name='id_transportadora' id='id_transportadora' value='<?=$view[0]['id_transportadora']?>'  readonly=readonly >
</div>
<div class='col-md-6'>
<label>Nome Transportadora</label>
<input type="text" class='form form-control' name='nome' id='nome' value='<?=$view[0]['nome']?>'  maxlength='99' required>
</div>
<div class='col-md-6'>
<label>Cnpj Transportadora</label>
<input type="text" class='form form-control' name='cnpj' id='cnpj' value='<?=$view[0]['cnpj']?>'  maxlength='44' required>
</div>
<div class='col-md-6'>
<label>Telefone</label>
<input type="text" class='form form-control' name='tel' id='tel' value='<?=$view[0]['tel']?>'  maxlength='19' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "transportadora", "index")?>">Voltar</a>
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
        