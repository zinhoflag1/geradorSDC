

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

<legend>Editar Cadastro Permissao</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "permissao", "edit");?>" method="post" accept-charset="utf-8" name="frmPermissao" id="frmPermissao">
    
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='id_permissao' id='id_permissao' value='<?=$view[0]['id_permissao']?>'  readonly=readonly >
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='login' id='login' value='<?=$view[0]['login']?>'  maxlength='8' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='nivel' id='nivel' value='<?=$view[0]['nivel']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Cadastro de material</label>
<input type="text" class='form form-control' name='cad_material' id='cad_material' value='<?=$view[0]['cad_material']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Pagamento de Material</label>
<input type="text" class='form form-control' name='cad_pagamento' id='cad_pagamento' value='<?=$view[0]['cad_pagamento']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Transferencia de Material</label>
<input type="text" class='form form-control' name='cad_transferencia' id='cad_transferencia' value='<?=$view[0]['cad_transferencia']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Liberacao de Material</label>
<input type="text" class='form form-control' name='cad_liberacao' id='cad_liberacao' value='<?=$view[0]['cad_liberacao']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Ajuda e Suporte ao Sistema</label>
<input type="text" class='form form-control' name='cad_ajuda_suporte' id='cad_ajuda_suporte' value='<?=$view[0]['cad_ajuda_suporte']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Cadastro de Usuario</label>
<input type="text" class='form form-control' name='cad_usuario' id='cad_usuario' value='<?=$view[0]['cad_usuario']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Cadastro de Configuracao Geral do sistema</label>
<input type="text" class='form form-control' name='cad_conf_ger' id='cad_conf_ger' value='<?=$view[0]['cad_conf_ger']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Consulta e Relatorios</label>
<input type="text" class='form form-control' name='relatorio' id='relatorio' value='<?=$view[0]['relatorio']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Relatorio Saldo Geral de Produtos de Todos os Depositos</label>
<input type="text" class='form form-control' name='rel_saldo_geral' id='rel_saldo_geral' value='<?=$view[0]['rel_saldo_geral']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Relatorios de saldo por Deposito</label>
<input type="text" class='form form-control' name='rel_saldo_p_deposito' id='rel_saldo_p_deposito' value='<?=$view[0]['rel_saldo_p_deposito']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Acesso a relatorio</label>
<input type="text" class='form form-control' name='liberacao' id='liberacao' value='<?=$view[0]['liberacao']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>2 via liberacao</label>
<input type="text" class='form form-control' name='rel_comp_liberacao' id='rel_comp_liberacao' value='<?=$view[0]['rel_comp_liberacao']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Relatorio de Material Liberado</label>
<input type="text" class='form form-control' name='rel_mat_liberado' id='rel_mat_liberado' value='<?=$view[0]['rel_mat_liberado']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Relatorio de Material Pago</label>
<input type="text" class='form form-control' name='rel_mat_pago' id='rel_mat_pago' value='<?=$view[0]['rel_mat_pago']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>2 Via recibo de pgto material</label>
<input type="text" class='form form-control' name='rel_comp_mat_pago' id='rel_comp_mat_pago' value='<?=$view[0]['rel_comp_mat_pago']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Acesso a menu Transferencia de Material</label>
<input type="text" class='form form-control' name='transferencia' id='transferencia' value='<?=$view[0]['transferencia']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Relatorio de Transferencia de Material</label>
<input type="text" class='form form-control' name='rel_mat_transferido' id='rel_mat_transferido' value='<?=$view[0]['rel_mat_transferido']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Relatorio de Material em Transito</label>
<input type="text" class='form form-control' name='rel_mat_transito' id='rel_mat_transito' value='<?=$view[0]['rel_mat_transito']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>acesso ao lembrete de liberacao na tela inicial</label>
<input type="text" class='form form-control' name='lembrete_libera' id='lembrete_libera' value='<?=$view[0]['lembrete_libera']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Acesso ao Lembrete de Material em Transito</label>
<input type="text" class='form form-control' name='lembrete_transito' id='lembrete_transito' value='<?=$view[0]['lembrete_transito']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Acesso a Pagina inicial do Modulo</label>
<input type="text" class='form form-control' name='inicial' id='inicial' value='<?=$view[0]['inicial']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Acesso ao submenu deposito</label>
<input type="text" class='form form-control' name='cad_deposito' id='cad_deposito' value='<?=$view[0]['cad_deposito']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Acesso relatorio de cadastro de material</label>
<input type="text" class='form form-control' name='rel_cad_mat' id='rel_cad_mat' value='<?=$view[0]['rel_cad_mat']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Resumo de liberacoes</label>
<input type="text" class='form form-control' name='rel_resumo_liberacao' id='rel_resumo_liberacao' value='<?=$view[0]['rel_resumo_liberacao']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Pedido Ajuda Humanitária</label>
<input type="text" class='form form-control' name='pedido_ajuda' id='pedido_ajuda' value='<?=$view[0]['pedido_ajuda']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Acesso ao Controle de Estoque</label>
<input type="text" class='form form-control' name='controle_estoque' id='controle_estoque' value='<?=$view[0]['controle_estoque']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='cancLibPaga' id='cancLibPaga' value='<?=$view[0]['cancLibPaga']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Acesso TDAP</label>
<input type="text" class='form form-control' name='tdap' id='tdap' value='<?=$view[0]['tdap']?>'  maxlength='-1' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "permissao", "index")?>">Voltar</a>
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
        