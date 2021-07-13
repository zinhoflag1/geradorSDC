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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_benef", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_benef", "cadastro") ?>" title="Novo Registro">+ Novo</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_benef", "pesquisa") ?>" title="Busca Registro">Pesquisa</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_benef", "exportar") ?>" title="Exportar dados Excel">Exportar Excel</a>
   <br>
<br>

<?php


$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];

$numRegPorPagina = 10;
$pag = new H_pedido_benefController();
$paginacao= $pag->paginacao($page, $numRegPorPagina);

$no = ($page >1) ? 1: 1;

$nr = 0;

print "<legend>Menu </legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id</th>
<th>nome_beneficiario</th>
<th>rg</th>
<th>comunidade</th>
<th>qtd</th>
<th>data_entrega</th>
<th>id_prestservico</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

foreach ($paginacao[0] as $h_pedido_benef) {

            print "<tr>
                    <td>".$h_pedido_benef['id']."</td>
<td>".$h_pedido_benef['nome_beneficiario']."</td>
<td>".$h_pedido_benef['rg']."</td>
<td>".$h_pedido_benef['comunidade']."</td>
<td>".$h_pedido_benef['qtd']."</td>
<td>".$h_pedido_benef['data_entrega']."</td>
<td>".$h_pedido_benef['id_prestservico']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_benef", "view", array('id' => $h_pedido_benef['id'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_benef", "edit", array('id' => $h_pedido_benef['id'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_benef", "delete", array('id' => $h_pedido_benef['id'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
            $nr += $no;
        }
       

        print " </tbody></table></div>";
        
        print "<div class=\"col-md-12 text-center\">";

        print "<ul class=\"pagination\">";

        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_benef', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

        for ($p = 1; $p <= $paginacao[1]; $p++) {

            print "<li class=\"" . ($page == $p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_benef', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
            if(($p > 1) && ($p % 15 == 0)) {
            print "</ul>";
                print "<ul class=\"pagination\">";
            }
        }
        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_benef', 'index', array('page' => $paginacao[1])) . "\">Último</a></li>";
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
        