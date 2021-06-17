<?php include_once("config.ini.php");?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <title>Hello, world!</title>
        <style>

        </style>
    </head>
    <body>
        <nav class="navbar bg-dark" style="color:white">
            <?=VERSAO?><br>
            <?=AUTOR?>
        </nav>

        <div class="col-md-12">
            <br>
            <div class="col-md-3">
                <button type="button" onclick="confirm('Copiar arquivo ?')" name="btnCopiar" id="btnCopiar" class="btn btn-primary">Copiar arquivos </button>
                <button type="button" onclick="history.back();" name="btnVoltar" id="btnVoltar" class="btn btn-success">Voltar</button>
            </div>
            <div class="col-md-9">
                <span class="alert-success" id="msgCopy">Arquivo Copiado com sucesso !</span>
            </div>
            <br>
        </div>

        <div class="col-md-12">
            <div class="col-md-8">

                <?php

                if (!empty($_POST)) {

    #nome Completo tabela 
    $tabela = isset($_POST['tabela']) ? $_POST['tabela'] : "";
    $modulo = isset($_POST['modulo']) ? $_POST['modulo'] : "";
    $caminhoBase = isset($_POST['txtBase']) ? $_POST['txtBase'] : "";
    $bacFront = isset($_POST['bacFront']) ? $_POST['bacFront'] : "";
    $view = isset($_POST['txtView']) ? $_POST['txtView'] : "";
    $controller = isset($_POST['txtController']) ? $_POST['txtController'] : "";
    $model = isset($_POST['txtModel']) ? $_POST['txtModel'] : "";
    $contexto = isset($_POST['contexto']) ? $_POST['contexto'] : "";

    $prefixoMod = substr($tabela, 0, strpos($tabela, "_") + 1);

    # nome modulo sem mod_
    $mod = substr($modulo, (strpos($modulo, "_") + 1));

    #nome tabela sem prefixo
    if(strpos($tabela, "_")){
    $smallTable = substr($tabela, (strpos($tabela, "_") + 1));
    }else {
        $smallTable = $tabela;
    }

    $smallTableCamel = ucfirst($smallTable);

    #nome do arquivo model
    $nomeFileModel = ucfirst($smallTable).$contexto."Model";

    #nome do arquivo controller
    $nomeFileController = $smallTable . "Controller";

    $id_tabela = "id_" . $smallTable;

    $dataAtual = date('d/m/Y');

    $impressao_var = "<table class='table table-bordered table-sm'>
                        <tr>
                            <th>Nome Tabela</th>
                            <th>variavel</th>
                            <th>valor</th>
                        </tr>
                        <tr>
                            <td>Identificador Tabela</td>
                            <td>\$id_tabela</td>
                            <td>{$id_tabela}</td>
                        </tr>
                        <tr>
                            <td>Nome da Tabela</td>
                            <td>\$tabela</td>
                            <td>{$tabela}</td>
                        </tr>
                        <tr>
                            <td>Nome Modulo</td>
                            <td>\$modulo</td>
                            <td>{$modulo}</td>
                        </tr>        
                        <tr>
                            <td>Prefixo</td>
                            <td>\$prefixoMod</td>
                            <td>{$prefixoMod}</td>
                        </tr> 
                        <tr>
                            <td>Nome módulo sem prefixo</td>
                            <td>\$mod</td>
                            <td>{$mod}</td>
                        </tr>     
                        <tr>
                            <td>Nome Contexto (pasta dentro modulo)</td>
                            <td>\$contexto</td>
                            <td>{$contexto}</td>
                        </tr>       
                        <tr>
                            <td>Nome Tabela sem Prefixo</td>
                            <td>\$smallTable</td>
                            <td>{$smallTable}</td>
                        </tr> 
                        <tr>
                            <td>Nome Tabela sem Prefixo CamelCase</td>
                            <td>\$smallTableCamel</td>
                            <td>{$smallTableCamel}</td>
                        </tr> 
                        <tr>
                            <td>Nome do Arquivo Model</td>
                            <td>\$nomeFileModel</td>
                            <td>{$nomeFileModel}</td>
                        </tr>     
                        <tr>
                            <td>Nome do Arquivo Controller</td>
                            <td>\$nomeFileController</td>
                            <td>{$nomeFileController}</td>
                        </tr>     
                    </table>";

                    print $impressao_var;
                    if (!file_exists("arquivo/crud/{$smallTable}")) {
                        mkdir("arquivo/crud/{$smallTable}");
                    }
                    # gerar Model
                    include 'base/tabelaModel_ger.php';
                    require 'base/controle_ger.php';
                    include 'base/cadastro_ger.php';
                    include 'base/edit_ger.php';
                    include 'base/view_ger.php';
                    include 'base/index_ger.php';
                    include 'base/pesquisa_ger.php';
                }
                ?>
            </div>
            <div class="col-md-4"><legend>Busca</legend></div>
        </div>

        <br><br>


        <script src="js/jquery/jquery.js"></script>
        <script>

                    $(document).ready(function () {

                    $("#msgCopy").hide();
                    $("#btnCopiar").click(function () {

                    var contexto = '<?= $smallTable ?>';
                    
                    var form_data = new FormData();
                  
                    form_data.append("tabela", contexto);
                    form_data.append("modulo", "<?=$modulo?>");
                    form_data.append("txtBase" , "<?=$caminhoBase?>");
                    form_data.append("bacfront" , "<?=$bacFront?>");
                    form_data.append("view" , "<?=$view?>");
                    form_data.append("controller", "<?=$controller?>");
                    form_data.append("model" , "<?=$model?>");
                    form_data.append("contexto", "<?=$contexto?>");
                    form_data.append("smallTable", "<?=$smallTable?>");
                
                $.ajax({
                url: "base/copy.php",
                type: "POST",
                data: form_data,
                processData: false,
                contentType: false


                }).done(function (resposta) {
                $("#msgCopy").show();
                console.log(resposta);

                }).fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);

                }).always(function () {
                //console.log("completou");
                });

                });

                });
                </script>


