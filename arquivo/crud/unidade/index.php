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
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "unidade", "cadastro") ?>" title="Novo Registro">+ Novo</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "unidade", "pesquisa") ?>" title="Busca Registro">Pesquisa</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "unidade", "exportar") ?>" title="Exportar dados Excel">Exportar Excel</a>
   <br>
<br>

<?php


$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];

$numRegPorPagina = 10;
$pag = new UnidadeController();
$paginacao= $pag->paginacao($page, $numRegPorPagina);

$no = ($page >1) ? 1: 1;

$nr = 0;

print "<legend>Cadastro Unidade</legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_unidade</th>
<th>nome</th>
<th>descricao</th>
<th>valor</th>
<th>data_validade</th>
<th>id_marca</th>
<th>id_categoria</th>
<th>id_almoxarifado</th>
<th>id_fornecedor</th>
<th>id_unidade_med</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

foreach ($paginacao[0] as $unidade) {

            print "<tr>
                    <td>".$unidade['id_unidade']."</td>
<td>".$unidade['nome']."</td>
<td>".$unidade['descricao']."</td>
<td>".$unidade['valor']."</td>
<td>".$unidade['data_validade']."</td>
<td>".$unidadeModel->getNomeIdFk('aju_marca','id_marca', $unidade['id_marca'])->nome."</td>
<td>".$unidadeModel->getNomeIdFk('aju_categoria','id_categoria', $unidade['id_categoria'])->nome."</td>
<td>".$unidadeModel->getNomeIdFk('aju_almoxarifado','id_almoxarifado', $unidade['id_almoxarifado'])->nome."</td>
<td>".$unidadeModel->getNomeIdFk('aju_fornecedor','id_fornecedor', $unidade['id_fornecedor'])->nome."</td>
<td>".$unidadeModel->getNomeIdFk('aju_unidade_med','id_unidade_med', $unidade['id_unidade_med'])->nome."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "unidade", "view", array('id' => $unidade['id_unidade'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "unidade", "edit", array('id' => $unidade['id_unidade'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "unidade", "delete", array('id' => $unidade['id_unidade'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
            $nr += $no;
        }
       

        print " </tbody></table></div>";
        
        print "<div class=\"col-md-12 text-center\">";

        print "<ul class=\"pagination\">";

        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'unidade', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

        for ($p = 1; $p <= $paginacao[1]; $p++) {

            print "<li class=\"" . ($page == $p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('ajuda', 'unidade', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
        }
        print "<li><a href=\"" . FuncaoBase::geraLink('ajuda', 'unidade', 'index', array('page' => $paginacao[1])) . "\">Último</a></li>";
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
        