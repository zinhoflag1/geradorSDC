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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "conestoque", "cadgeral") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "permissao", "cadastro") ?>" title="Novo Registro">+ Novo</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "permissao", "pesquisa") ?>" title="Busca Registro">Pesquisa</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "permissao", "exportar") ?>" title="Exportar dados Excel">Exportar Excel</a>
   <br>
<br>

<?php


$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];

$numRegPorPagina = 10;
$pag = new PermissaoController();
$paginacao= $pag->paginacao($page, $numRegPorPagina);

$no = ($page >1) ? 1: 1;

$nr = 0;

print "<legend>Cadastro Permissao</legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_permissao</th>
<th>login</th>
<th>nivel</th>
<th>cad_material</th>
<th>cad_pagamento</th>
<th>cad_transferencia</th>
<th>cad_liberacao</th>
<th>cad_ajuda_suporte</th>
<th>cad_usuario</th>
<th>cad_conf_ger</th>
<th>relatorio</th>
<th>rel_saldo_geral</th>
<th>rel_saldo_p_deposito</th>
<th>liberacao</th>
<th>rel_comp_liberacao</th>
<th>rel_mat_liberado</th>
<th>rel_mat_pago</th>
<th>rel_comp_mat_pago</th>
<th>transferencia</th>
<th>rel_mat_transferido</th>
<th>rel_mat_transito</th>
<th>lembrete_libera</th>
<th>lembrete_transito</th>
<th>inicial</th>
<th>cad_deposito</th>
<th>rel_cad_mat</th>
<th>rel_resumo_liberacao</th>
<th>pedido_ajuda</th>
<th>controle_estoque</th>
<th>cancLibPaga</th>
<th>tdap</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

foreach ($paginacao[0] as $permissao) {

            print "<tr>
                    <td>".$permissao['id_permissao']."</td>
<td>".$permissao['login']."</td>
<td>".$permissao['nivel']."</td>
<td>".$permissao['cad_material']."</td>
<td>".$permissao['cad_pagamento']."</td>
<td>".$permissao['cad_transferencia']."</td>
<td>".$permissao['cad_liberacao']."</td>
<td>".$permissao['cad_ajuda_suporte']."</td>
<td>".$permissao['cad_usuario']."</td>
<td>".$permissao['cad_conf_ger']."</td>
<td>".$permissao['relatorio']."</td>
<td>".$permissao['rel_saldo_geral']."</td>
<td>".$permissao['rel_saldo_p_deposito']."</td>
<td>".$permissao['liberacao']."</td>
<td>".$permissao['rel_comp_liberacao']."</td>
<td>".$permissao['rel_mat_liberado']."</td>
<td>".$permissao['rel_mat_pago']."</td>
<td>".$permissao['rel_comp_mat_pago']."</td>
<td>".$permissao['transferencia']."</td>
<td>".$permissao['rel_mat_transferido']."</td>
<td>".$permissao['rel_mat_transito']."</td>
<td>".$permissao['lembrete_libera']."</td>
<td>".$permissao['lembrete_transito']."</td>
<td>".$permissao['inicial']."</td>
<td>".$permissao['cad_deposito']."</td>
<td>".$permissao['rel_cad_mat']."</td>
<td>".$permissao['rel_resumo_liberacao']."</td>
<td>".$permissao['pedido_ajuda']."</td>
<td>".$permissao['controle_estoque']."</td>
<td>".$permissao['cancLibPaga']."</td>
<td>".$permissao['tdap']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "permissao", "view", array('id' => $permissao['id_permissao'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "permissao", "edit", array('id' => $permissao['id_permissao'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "permissao", "delete", array('id' => $permissao['id_permissao'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
            $nr += $no;
        }
       

        print " </tbody></table></div>";
        
        print "<div class=\"col-md-12 text-center\">";

        print "<ul class=\"pagination\">";

        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'permissao', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

        for ($p = 1; $p <= $paginacao[1]; $p++) {

            print "<li class=\"" . ($page == $p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('ajuda', 'permissao', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
        }
        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'permissao', 'index', array('page' => $paginacao[1])) . "\">Último</a></li>";
        print "</ul>";
        print "</div>";

?>


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
        