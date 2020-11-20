

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

$aju_marca = new UnidadeConEstoqueModel();
  
                    $dadosMarca = $aju_marca->listaid_marcaAutocomplete();
$aju_categoria = new UnidadeConEstoqueModel();
  
                    $dadosCategoria = $aju_categoria->listaid_categoriaAutocomplete();
$aju_almoxarifado = new UnidadeConEstoqueModel();
  
                    $dadosAlmoxarifado = $aju_almoxarifado->listaid_almoxarifadoAutocomplete();
$aju_fornecedor = new UnidadeConEstoqueModel();
  
                    $dadosFornecedor = $aju_fornecedor->listaid_fornecedorAutocomplete();
$aju_unidade_med = new UnidadeConEstoqueModel();
  
                    $dadosUnidade_med = $aju_unidade_med->listaid_unidade_medAutocomplete();


?>

<legend>Cadastro de Unidade</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "unidade", "gravar");?>" method="post" accept-charset="utf-8" name="frmUnidade" id="frmUnidade">
    
    <div class='col-md-6'>
<label>Nome do Material</label>
<input type="text" class='form form-control' name='nome' id='nome' maxlength='44' required >
</div>
<div class='col-md-6'>
<label>Descrição Material</label>
<input type="text" class='form form-control' name='descricao' id='descricao' maxlength='69' required >
</div>
<div class='col-md-6'>
<label>Valor Material</label>
<input type="text" class='form form-control' name='valor' id='valor' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Validade Material</label>
<input type="text" class='form form-control' name='data_validade' id='data_validade' maxlength='' required >
</div>
<div class='col-md-6'>
<label>Identificador Marca</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeMarca_fk' id='nomeMarca_fk' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_marca">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_marca' id='id_marca' required readonly='readonly'>
</div>
<div class='col-md-6'>
<label>Identificador Categoria</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeCategoria_fk' id='nomeCategoria_fk' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_categoria">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_categoria' id='id_categoria' required readonly='readonly'>
</div>
<div class='col-md-6'>
<label>Identificador Almoxarifado</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeAlmoxarifado_fk' id='nomeAlmoxarifado_fk' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_almoxarifado">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_almoxarifado' id='id_almoxarifado' required readonly='readonly'>
</div>
<div class='col-md-6'>
<label>Identificador do Fornecedor</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeFornecedor_fk' id='nomeFornecedor_fk' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_fornecedor">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_fornecedor' id='id_fornecedor' required readonly='readonly'>
</div>
<div class='col-md-6'>
<label>Unidade de Medida</label>
<div class="input-group">
<input type="text" class='form form-control' name='nomeUnidade_med_fk' id='nomeUnidade_med_fk' required readonly='readonly'>
<span onclick="" class="input-group-addon" id="btnBuscaid_unidade_med">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span> </div><input type="hidden" name='id_unidade_med' id='id_unidade_med' required readonly='readonly'>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "conestoque", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    </div>
</form>
    
    
    <!--######################  MODAL aju_marca ###################-->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_id_marca">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_marca</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_marca" id="searcid_marca">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "marca", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_marca ####################--><!--######################  MODAL aju_categoria ###################-->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_id_categoria">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_categoria</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_categoria" id="searcid_categoria">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "categoria", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_categoria ####################--><!--######################  MODAL aju_almoxarifado ###################-->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_id_almoxarifado">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_almoxarifado</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_almoxarifado" id="searcid_almoxarifado">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "almoxarifado", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_almoxarifado ####################--><!--######################  MODAL aju_fornecedor ###################-->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_id_fornecedor">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_fornecedor</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_fornecedor" id="searcid_fornecedor">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "fornecedor", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_fornecedor ####################--><!--######################  MODAL aju_unidade_med ###################-->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_id_unidade_med">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cadastro aju_unidade_med</h4>
                </div>
                <div class="modal-body">
                  <label>Pesquisa</label>
                          <input type="text" class="form form-control" name="searcid_unidade_med" id="searcid_unidade_med">
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                  <div class="col-md-6 text-left">
                      <a href="<?=FuncaoBase::geraLink("ajuda", "unidade_med", "cadastro");?>" class="btn btn-success text-left" >Cadastrar Novo</a>
                  </div>
                  <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 <!--###################  FIM MODAL aju_unidade_med ####################-->

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
        $("#frmUnidade").trigger("reset");
    
        
        
        
   
    
     /* ###################  fk_aju_marca ####################*/
        $('#btnBuscaid_marca').click(function () {
            $('#modal_id_marca').modal('show');
        });

        var itens = {
            data:
            <?php print json_encode($dadosMarca); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_marca").getSelectedItemData().id_marca;
                    var nome = $("#searcid_marca").getSelectedItemData().nome;
                     
                        $("#nomeMarca_fk").val(nome); // Mudar
                       $("#id_marca").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_marca").easyAutocomplete(itens);
                                
    /*###########################  final aju_marca #####################*/
    
     /* ###################  fk_aju_categoria ####################*/
        $('#btnBuscaid_categoria').click(function () {
            $('#modal_id_categoria').modal('show');
        });

        var itens = {
            data:
            <?php print json_encode($dadosCategoria); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_categoria").getSelectedItemData().id_categoria;
                    var nome = $("#searcid_categoria").getSelectedItemData().nome;
                     
                        $("#nomeCategoria_fk").val(nome); // Mudar
                       $("#id_categoria").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_categoria").easyAutocomplete(itens);
                                
    /*###########################  final aju_categoria #####################*/
    
     /* ###################  fk_aju_almoxarifado ####################*/
        $('#btnBuscaid_almoxarifado').click(function () {
            $('#modal_id_almoxarifado').modal('show');
        });

        var itens = {
            data:
            <?php print json_encode($dadosAlmoxarifado); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_almoxarifado").getSelectedItemData().id_almoxarifado;
                    var nome = $("#searcid_almoxarifado").getSelectedItemData().nome;
                     
                        $("#nomeAlmoxarifado_fk").val(nome); // Mudar
                       $("#id_almoxarifado").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_almoxarifado").easyAutocomplete(itens);
                                
    /*###########################  final aju_almoxarifado #####################*/
    
     /* ###################  fk_aju_fornecedor ####################*/
        $('#btnBuscaid_fornecedor').click(function () {
            $('#modal_id_fornecedor').modal('show');
        });

        var itens = {
            data:
            <?php print json_encode($dadosFornecedor); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_fornecedor").getSelectedItemData().id_fornecedor;
                    var nome = $("#searcid_fornecedor").getSelectedItemData().nome;
                     
                        $("#nomeFornecedor_fk").val(nome); // Mudar
                       $("#id_fornecedor").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_fornecedor").easyAutocomplete(itens);
                                
    /*###########################  final aju_fornecedor #####################*/
    
     /* ###################  fk_aju_unidade_med ####################*/
        $('#btnBuscaid_unidade_med').click(function () {
            $('#modal_id_unidade_med').modal('show');
        });

        var itens = {
            data:
            <?php print json_encode($dadosUnidade_med); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = $("#searcid_unidade_med").getSelectedItemData().id_unidade_med;
                    var nome = $("#searcid_unidade_med").getSelectedItemData().nome;
                     
                        $("#nomeUnidade_med_fk").val(nome); // Mudar
                       $("#id_unidade_med").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searcid_unidade_med").easyAutocomplete(itens);
                                
    /*###########################  final aju_unidade_med #####################*/
        

    });
</script>
        