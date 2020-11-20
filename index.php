<?php include_once ("classe/Classe.PDO.php"); 
    include_once("database.php");
    
    $dados = Database::getDatabase();
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
        <nav class="navbar navbar-dark bg-dark">
            Gerador Código 1.0
            Autor: Demetrio Silva Passos
        </nav>
        <div class="col-md-12">

        </div>


        <div class="container">

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

            <form action="gerador.php" method="post" name="frmGerar" id="frmGerar">
                <div class="col-md-6">
                    <label>Banco de Dados :</label>
                    <select class="form form-control" id="selBanco" name="selBanco">
                        <option>gestaocedec</option>
                        <?php foreach ($dados as $key => $value) {
                          print "<option>".$value->Database."</option>";  
                        }
                        ?>
                    </select>
                    <br>
                </div>
                <div class="col-md-6">
                    <label>Nome Tabela (Nome da Tabela no Banco de Dados) :</label><br>
                    <select name="tabela" id="tabela"  class="form form-control" >
                        <option>Escolha a Tabela</option>
                        
                    </select>
                    <br>
                </div>
                <div class="col-md-6">
                    <label>Nome Modulo ( Nome completo do Modulo ex. mod_aju :</label><br>
                    <select name="modulo" id="modulo"  class="form form-control" >
                        <option>mod_ajuda</option>
                        <option>mod_cce</option>
                        <option>mod_compdec</option>
                        <option>mod_pipa</option>
                    </select>
                    <br>
                </div>
                <div class="col-md-6">
                    <label>BackEnd/FrontEnd :</label><br>
                    <select name="bacFront" id="bacFront"  class="form form-control" >
                        <option>backEnd</option>
                        <option>frontEnd</option>

                    </select>
                    <br>
                </div>
                <div class="col-md-6">
                    <label>Contexto ( separação dentro de um modulo ex conEstoque :</label><br>
                    <input type="text"  class="form form-control" name="contexto" id="contexto" value="conEstoque">
                    <br>
                </div>

                <button type="submit" class="btn btn-primary" name="btnPreview" id="btnPreview">Preview</button>

                <br><br>
                <span id='pathModel'>Model<br>
                    Caminho : C:\Users\zinhoflag1\Documents\DOWNLOAD\wamp64\www\gestaocedec\mod_ajuda\Model\MarcaEstoqueModel.php
                </span>
                
            </form>

        </div>
        
        <script src="js/jquery/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script type="text/javascript">

            $(document).ready(function () {
                
                $("#selBanco").change(function(){
                    
                    var form_data = new FormData();
                    
                    form_data.append("database", $("#selBanco").val());
                    form_data.append("action", "database");
                   $.ajax({
				type: 'POST',
				url: 'database.php',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				success: function(response) {
                                        $("#tabela").empty();
                                        $("#tabela").append(response);
                                        console.log(JSON.stringify(response));
                                        
				},
				error: function(e){
					console.log(JSON.stringify(form_data));
					console.log(JSON.stringify(response));
					alert("Ocorreu um Erro !");
				}
				
			});
                    
                });

                $("#pathModel").hide();

                $("#btnPreview").click(function () {

                    $("#pathModel").show();

                })

            });


        </script>
    </body>
</html>


<?php
?>


<?php
$post = isset($_POST) ? $_POST : null;

$btnEnvia = isset($_POST['envia']) ? true : false;

if ($btnEnvia) {

    $con = Conexao::getinstance();
}
?>