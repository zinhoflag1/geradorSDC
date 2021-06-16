<?php

include_once 'classe/Classe.PDO.php';
include_once 'classe/Classe.Gerador.php';

$gerador = new Gerador();

$tabela = $gerador->Tabela($_POST['tabela']);

$campos = $gerador->Campos($_POST['tabela']);

$inputs = "";

$datamask = "";

foreach ($campos['full'] as $key => $campo) {

    if ($campo->column_key == "MUL") {
        
        $id_fk = $campo->column_name;
        
        $nomeTableFk = $gerador->getNomeTableFK($tabela['tabela']->table_name, $id_fk);
        
        $inputs .= "<tr>
                <td class=\"col-md-3\">{$campo->column_comment} :</td><td><?=\${$smallTable}Model->getNomeIdFk('{$nomeTableFk[0]->tabela}','{$campo->column_name}', \$view[0]['{$campo->column_name}'])->nome;?></td>
            </tr>";

    $inputs .= "</div>\n\n";
        
    }else {

    $inputs .= "<tr>
                <td class=\"col-md-3\">{$campo->column_comment} :</td><td><?=\$view[0]['{$campo->column_name}'];?></td>
            </tr>";

    $inputs .= "</div>\n\n";
    
    }
}


# local C:\Users\zinhoflag1\Documents\DOWNLOAD\wamp64\www\gestaocedec\mod_ajuda\backEnd\View\conEstoque\marca\view.php

$view = fopen("arquivo/crud/{$smallTable}/view.php", "w") or die("Unable to open file!");


$texto = <<< codPhp

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

<legend><?=\$view[1]['tabela']->TABLE_COMMENT?></legend>
<table class="table table-bordered table-striped">

    {$inputs}

  </table>
<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("{$mod}", "{$smallTable}", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("{$mod}", "{$smallTable}", "edit", array('id'=>\$view[0]['{$campos['full'][0]->column_name}'])) ?>">Editar</a>
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

codPhp;

try {
    fwrite($view, $texto);
    fclose($view);
} catch (Exception $e) {
    print $e->getMessage() . "Erro na geração do arquivo controller";
}
