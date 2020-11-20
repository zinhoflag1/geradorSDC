
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
                <td class="col-md-3"> :</td><td><?=$view[0]['id_permissao'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3"> :</td><td><?=$view[0]['login'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3"> :</td><td><?=$view[0]['nivel'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Cadastro de material :</td><td><?=$view[0]['cad_material'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Pagamento de Material :</td><td><?=$view[0]['cad_pagamento'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Transferencia de Material :</td><td><?=$view[0]['cad_transferencia'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Liberacao de Material :</td><td><?=$view[0]['cad_liberacao'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Ajuda e Suporte ao Sistema :</td><td><?=$view[0]['cad_ajuda_suporte'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Cadastro de Usuario :</td><td><?=$view[0]['cad_usuario'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Cadastro de Configuracao Geral do sistema :</td><td><?=$view[0]['cad_conf_ger'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Consulta e Relatorios :</td><td><?=$view[0]['relatorio'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Relatorio Saldo Geral de Produtos de Todos os Depositos :</td><td><?=$view[0]['rel_saldo_geral'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Relatorios de saldo por Deposito :</td><td><?=$view[0]['rel_saldo_p_deposito'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Acesso a relatorio :</td><td><?=$view[0]['liberacao'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">2 via liberacao :</td><td><?=$view[0]['rel_comp_liberacao'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Relatorio de Material Liberado :</td><td><?=$view[0]['rel_mat_liberado'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Relatorio de Material Pago :</td><td><?=$view[0]['rel_mat_pago'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">2 Via recibo de pgto material :</td><td><?=$view[0]['rel_comp_mat_pago'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Acesso a menu Transferencia de Material :</td><td><?=$view[0]['transferencia'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Relatorio de Transferencia de Material :</td><td><?=$view[0]['rel_mat_transferido'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Relatorio de Material em Transito :</td><td><?=$view[0]['rel_mat_transito'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">acesso ao lembrete de liberacao na tela inicial :</td><td><?=$view[0]['lembrete_libera'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Acesso ao Lembrete de Material em Transito :</td><td><?=$view[0]['lembrete_transito'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Acesso a Pagina inicial do Modulo :</td><td><?=$view[0]['inicial'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Acesso ao submenu deposito :</td><td><?=$view[0]['cad_deposito'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Acesso relatorio de cadastro de material :</td><td><?=$view[0]['rel_cad_mat'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Resumo de liberacoes :</td><td><?=$view[0]['rel_resumo_liberacao'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Pedido Ajuda Humanitária :</td><td><?=$view[0]['pedido_ajuda'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Acesso ao Controle de Estoque :</td><td><?=$view[0]['controle_estoque'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3"> :</td><td><?=$view[0]['cancLibPaga'];?></td>
            </tr></div>

<tr>
                <td class="col-md-3">Acesso TDAP :</td><td><?=$view[0]['tdap'];?></td>
            </tr></div>



  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "permissao", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "permissao", "edit", array('id'=>$view[0]['id_permissao'])) ?>">Editar</a>
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
