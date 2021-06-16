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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("compdec", "teste", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("compdec", "teste", "cadastro") ?>" title="Novo Registro">+ Novo</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("compdec", "teste", "pesquisa") ?>" title="Busca Registro">Pesquisa</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("compdec", "teste", "exportar") ?>" title="Exportar dados Excel">Exportar Excel</a>
   <br>
<br>

<?php


$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];

$numRegPorPagina = 10;
$pag = new TesteController();
$paginacao= $pag->paginacao($page, $numRegPorPagina);

$no = ($page >1) ? 1: 1;

$nr = 0;

print "<legend>Cadastro Teste</legend>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_teste</th>
<th>data_reg</th>
<th>CodUf</th>
<th>Codmundv</th>
<th>Codmun</th>
<th>NomeMunic</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

foreach ($paginacao[0] as $teste) {

            print "<tr>
                    <td>".$teste['id_teste']."</td>
<td>".$teste['data_reg']."</td>
<td>".$teste['CodUf']."</td>
<td>".$teste['Codmundv']."</td>
<td>".$teste['Codmun']."</td>
<td>".$teste['NomeMunic']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("compdec", "teste", "view", array('id' => $teste['id_teste'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("compdec", "teste", "edit", array('id' => $teste['id_teste'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("compdec", "teste", "delete", array('id' => $teste['id_teste'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
            $nr += $no;
        }
       

        print " </tbody></table></div>";
        
        print "<div class=\"col-md-12 text-center\">";

        print "<ul class=\"pagination\">";

        print "<li><a href=\"" . FuncaoBase::geraLink('compdec', 'teste', 'index', array('page' => '1')) . "\">Primeiro</a></li>";

        for ($p = 1; $p <= $paginacao[1]; $p++) {

            print "<li class=\"" . ($page == $p ? 'active' : '') . "\"><a href=\"" . FuncaoBase::geraLink('compdec', 'teste', 'index', array('page' => $p)) . "\">" . $p . "</a></li>";
        }
        print "<li><a href=\"" . FuncaoBase::geraLink('compdec', 'teste', 'index', array('page' => $paginacao[1])) . "\">Último</a></li>";
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
        