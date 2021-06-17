<?php
include_once ("classe/Classe.PDO.php");
include_once("database.php");
include_once("config.ini.php");

$dados = Database::getDatabase();
$tabelas = Database::getTabelas('gestaocedec');
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Hello, world!</title>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark" style="color:white">
             <?=VERSAO?><br>
            <?=AUTOR?>
        </nav>
        <div class="col-md-12">

        </div>


        <div class="col-md-12">
            <p class="text-center"><legend>Gerador de Código</legend></p>
    </div>


    <!--<form action="#" method="post" accept-charset="utf-8">
            <label>
                    host:
                    <input type="text" name="host" id="host" value="http://localhost" >
            </label>
            <label>
                    porta:
                    <input type="text" name="porta" id="porta" value="3306" >
            </label>
            <label>
                    usuario:
                    <input type="text" name="usuario" id="usuario" value="usuario" >
            </label>
            <label>
                    senha:
                    <input type="text" name="senha" id="senha" value="usuario" >
            </label>

            <button type="submit" name="envia">Conexão</button>
    </form>-->
    <div class="container">
        <form action="gerador.php" method="post" name="frmGerar" id="frmGerar">
            <div class="row">

                <div class="col-6">

                    <label>Diretorio Base :</label><span style="font-style: italic"> obs pasta apos root apache ex: gestaocedec</span>
                    <input class="form form-control" type="text" id="txtBase" name='txtBase' value="teste"><br>
                    <label>Banco de Dados :</label>
                    <select class="form form-control" id="selBanco" name="selBanco">
                        <option>gestaocedec</option>
                        <?php
                        foreach ($dados as $key => $value) {
                            print "<option>" . $value->Database . "</option>";
                        }
                        ?>
                    </select>
                    <br>


                    <label>Nome Tabela (Nome da Tabela no Banco de Dados) :</label><br>
                    <select name="tabela" id="tabela"  class="form form-control" >
                        <option>Escolha a Tabela</option>                      
                    </select>
                    <br>

                    <label>Nome Modulo ( Nome completo do Modulo ex. mod_aju :</label><br>
                    <select name="modulo" id="modulo"  class="form form-control" >
                        <option>mod_ajuda</option>
                        <option>mod_cce</option>
                        <option>mod_compdec</option>
                        <option>mod_pipa</option>
                        <option>mod_cedec</option>
                        <option>mod_admin</option>
                    </select>
                    <br>

                    <label>BackEnd/FrontEnd :</label><br>
                    <select name="bacFront" id="bacFront"  class="form form-control" >
                        <option>backEnd</option>
                        <option>frontEnd</option>

                    </select>
                    <br>

                    <label>Contexto ( separação dentro de um modulo ex conEstoque :</label><br>
                    <input type="text"  class="form form-control" name="contexto" id="contexto" >
                    <br>
                    <button type="button" class="btn btn-primary" name="btnPreview" id="btnPreview">Preview</button>
                    <button type="button" class="btn btn-primary" name="btnGerar" id="btnGerar">Gerar</button>



                </div>
                <div class="col" id="path">

                    <label>Caminho Model :</label>
                    <input class="form form-control" type="text" name="txtModel" id='txtModel' >
                    </span>

                    <br>

                    <label>Caminho Controller :</label>
                    <input class="form form-control" type="text" name="txtController" id='txtController' >
                    </span>

                    <br>

                    <label>Caminho Views :</label>
                    <input class="form form-control" type="text" name="txtView" id='txtView' >
                    </span>


                </div>
        </form>
    </div>
</div>

<script src="js/jquery/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $("#path").hide();
        $("#btnGerar").hide();

        var banco = "gestaocedec";
        buscaTabela(banco);

        $("#selBanco").change(function () {

            banco = $("#selBanco").val();
            buscaTabela(banco);
        });

        $("#btnPreview").click(function () {

            $("#btnPreview").hide();
            $("#btnGerar").show();

            var contexto = $("#tabela").val();

            if ($("#contexto").val().length > 0) {
                contexto = $("#contexto").val();
            }


            $("#path").show();

            $("#txtModel").val("");
            $("#txtController").val("");
            $("#txtView").val("");

            $("#txtModel").val($("#txtModel").val() + "" + "\\" + $("#modulo").val() + "\\" + $("#bacFront").val() + "\\Model");
            $("#txtController").val($("#txtController").val() + "\\" + $("#modulo").val() + "\\" + $("#bacFront").val() + "\\Controller");
            $("#txtView").val($("#txtView").val() + "\\" + $("#modulo").val() + "\\" + $("#bacFront").val() + "\\View\\" + contexto);
        });

        /* gerar */
        $("#btnGerar").click(function () {
            $("#frmGerar").submit();
        });




    });

    function buscaTabela(banco) {

        var form_data = new FormData();

        form_data.append("database", banco);
        form_data.append("action", "database");
        $.ajax({
            type: 'POST',
            url: 'database.php',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                $("#tabela").empty();
                $("#tabela").append(response);
                //console.log(JSON.stringify(response));

            },
            error: function (e) {
                //console.log(JSON.stringify(form_data));
                //console.log(JSON.stringify(response));
                alert("Ocorreu um Erro !");
            }

        });
    }





</script>
</body>
</html>