

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

<legend>Cadastro de Permissao</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "permissao", "gravar");?>" method="post" accept-charset="utf-8" name="frmPermissao" id="frmPermissao">
    
    <div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='login' id='login' maxlength='8' required >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='nivel' id='nivel' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Cadastro de material</label>
<input type="text" class='form form-control' name='cad_material' id='cad_material' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Pagamento de Material</label>
<input type="text" class='form form-control' name='cad_pagamento' id='cad_pagamento' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Transferencia de Material</label>
<input type="text" class='form form-control' name='cad_transferencia' id='cad_transferencia' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Liberacao de Material</label>
<input type="text" class='form form-control' name='cad_liberacao' id='cad_liberacao' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Ajuda e Suporte ao Sistema</label>
<input type="text" class='form form-control' name='cad_ajuda_suporte' id='cad_ajuda_suporte' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Cadastro de Usuario</label>
<input type="text" class='form form-control' name='cad_usuario' id='cad_usuario' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Cadastro de Configuracao Geral do sistema</label>
<input type="text" class='form form-control' name='cad_conf_ger' id='cad_conf_ger' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Consulta e Relatorios</label>
<input type="text" class='form form-control' name='relatorio' id='relatorio' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Relatorio Saldo Geral de Produtos de Todos os Depositos</label>
<input type="text" class='form form-control' name='rel_saldo_geral' id='rel_saldo_geral' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Relatorios de saldo por Deposito</label>
<input type="text" class='form form-control' name='rel_saldo_p_deposito' id='rel_saldo_p_deposito' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Acesso a relatorio</label>
<input type="text" class='form form-control' name='liberacao' id='liberacao' maxlength='' required >
</div>
<div class='col-md-6'>
<label>2 via liberacao</label>
<input type="text" class='form form-control' name='rel_comp_liberacao' id='rel_comp_liberacao' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Relatorio de Material Liberado</label>
<input type="text" class='form form-control' name='rel_mat_liberado' id='rel_mat_liberado' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Relatorio de Material Pago</label>
<input type="text" class='form form-control' name='rel_mat_pago' id='rel_mat_pago' maxlength='' required >
</div>
<div class='col-md-6'>
<label>2 Via recibo de pgto material</label>
<input type="text" class='form form-control' name='rel_comp_mat_pago' id='rel_comp_mat_pago' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Acesso a menu Transferencia de Material</label>
<input type="text" class='form form-control' name='transferencia' id='transferencia' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Relatorio de Transferencia de Material</label>
<input type="text" class='form form-control' name='rel_mat_transferido' id='rel_mat_transferido' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Relatorio de Material em Transito</label>
<input type="text" class='form form-control' name='rel_mat_transito' id='rel_mat_transito' maxlength='' required >
</div>
<div class='col-md-6'>
<label>acesso ao lembrete de liberacao na tela inicial</label>
<input type="text" class='form form-control' name='lembrete_libera' id='lembrete_libera' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Acesso ao Lembrete de Material em Transito</label>
<input type="text" class='form form-control' name='lembrete_transito' id='lembrete_transito' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Acesso a Pagina inicial do Modulo</label>
<input type="text" class='form form-control' name='inicial' id='inicial' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Acesso ao submenu deposito</label>
<input type="text" class='form form-control' name='cad_deposito' id='cad_deposito' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Acesso relatorio de cadastro de material</label>
<input type="text" class='form form-control' name='rel_cad_mat' id='rel_cad_mat' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Resumo de liberacoes</label>
<input type="text" class='form form-control' name='rel_resumo_liberacao' id='rel_resumo_liberacao' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Pedido Ajuda Humanitária</label>
<input type="text" class='form form-control' name='pedido_ajuda' id='pedido_ajuda' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Acesso ao Controle de Estoque</label>
<input type="text" class='form form-control' name='controle_estoque' id='controle_estoque' maxlength='' required >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='cancLibPaga' id='cancLibPaga' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Acesso TDAP</label>
<input type="text" class='form form-control' name='tdap' id='tdap' maxlength='' required >
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
        $("#frmPermissao").trigger("reset");
    
        
        
        
   
        

    });
</script>
        