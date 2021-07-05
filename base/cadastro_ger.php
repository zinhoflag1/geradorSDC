<?php

include_once 'classe/Classe.PDO.php';
include_once 'classe/Classe.Gerador.php';

$gerador = new Gerador();

$tabela = $gerador->Tabela($_POST['tabela'], $_POST['selBanco']);

$campos = $gerador->Campos($_POST['tabela'],$_POST['selBanco']);

$inputs = "";

$datamask = "";

$obj_fk = "";

$searchModal = "";

$dados_fk = "";

$close_focus_pesquisa = "";

$radio_button_padrao ="";

foreach ($campos['full'] as $key => $campo) {
    
     var_dump($campo);

    # campos normais ( sem chave primaria)
    if (empty($campo->column_key)) {
        $maxlen = (is_null($campo->character_maximum_length)) ? "" : ($campo->character_maximum_length - 1);

        
        if($gerador->tipoCampo($campo->column_type) == "rb_ck") {
            
            # radio button
            if(substr($campo->column_name, 0, 3) == "rb_"){
                
                $radio_button_padrao .= "\n\$(\"#".$campo->column_name."_nao\").attr(\"checked\",true);\n";
                $inputs .= "<div class='col-md-6'>\n";
                $inputs .= "<div class='radio'>\n";
                $inputs .= "<label>\n";
                $inputs .= "<input type='radio' name='".$campo->column_name."' id='".$campo->column_name."_sim' value='1'>\n";
                $inputs .= "Sim\n";
                $inputs .= "</label>\n";
                $inputs .= "</div>\n";
                $inputs .= "<div class='radio'>\n";
                $inputs .= "<label>\n";
                $inputs .= "<input type='radio' name='".$campo->column_name."' id='".$campo->column_name."_nao' value='0'>\n";
                $inputs .= "Não\n";
                $inputs .= "</label>\n";
                $inputs .= "</div>\n";
                $inputs .= "</div>\n";

            $inputs .= "<div class='col-md-6'>\n";
            $inputs .= "<label>" . $campo->column_comment . "</label>\n";
            $inputs .= "<input type=\"" . $gerador->tipoCampo($campo->column_type) . "\" class='form form-control' name='" . $campo->column_name . "' id='" . $campo->column_name . "' maxlength='" . $maxlen . "' required >\n";
            $inputs .= "</div>\n";
                
             
            # checkbox
            }elseif(substr($campo->column_name, 0, 3) == "ck_"){
                print "checkbox";
            }
            
            
            
        }else {
            $inputs .= "<div class='col-md-6'>\n";
            $inputs .= "<label>" . $campo->column_comment . "</label>\n";
            $inputs .= "<input type=\"" . $gerador->tipoCampo($campo->column_type) . "\" class='form form-control' name='" . $campo->column_name . "' id='" . $campo->column_name . "' maxlength='" . $maxlen . "' required >\n";
            $inputs .= "</div>\n";
        }
        
      
        
    
    # chave estrangeira (campo com pesquisa modal
    }elseif ($campo->column_key == "MUL"){
        #nome da tabela FK
        $nomeTableFk = $gerador->getNomeTableFK($tabela['tabela']->table_name, $id_fk = $campo->column_name);
        
        $nomeTblFkCamel = ucfirst(substr($nomeTableFk[0]->tabela, (strpos($nomeTableFk[0]->tabela, "_")+1)));
        
        $smallTableFk = strtolower($nomeTblFkCamel);
        
         # identificador da tabela FK
        $id_fk = $campo->column_name;
        
        # instancias dados para busca FK
        $obj_fk .= "\n\${$nomeTableFk[0]->tabela} = new {$smallTableCamel}ConEstoqueModel();\n  
                    \$dados{$nomeTblFkCamel} = \${$nomeTableFk[0]->tabela}->lista{$id_fk}Autocomplete();\n";
        
        
        
        #nome do campos da tabela FK
        $nomeFk = "nome{$nomeTblFkCamel}"; // Alterar nome mostrado na pesquisa
        
         $close_focus_pesquisa .= " /* clic form campo FK fornecedor */
        $(\"#{$nomeFk}\").click(function(){
            $(\"#modal_{$id_fk}\").modal({backdrop: 'static', keyboard: false});   
        });
        /* focus no campo pesquisa fornecedor */
        $('#modal_{$id_fk}').on('shown.bs.modal', function (e) {
            $(\"#searc{$id_fk}\").focus();
        });\n";
        
        # input e label para pesquisa de dados
        $inputs .= "<div class='col-md-6'>\n";
        $inputs .= "<label>" . $campo->column_comment . "</label>\n";
        $inputs .= "<div class=\"input-group\">\n";
        $inputs .= "<input type=\"text\" class='form form-control' name='{$nomeFk}_fk' id='{$nomeFk}_fk' required readonly='readonly'>\n";
        $inputs .= "<span onclick=\"\" class=\"input-group-addon\" id=\"btnBusca{$id_fk}\">
                <span class=\"glyphicon glyphicon-search\" aria-hidden=\"true\"></span>
            </span> </div>"; 
        $inputs .= "<input type=\"hidden\" name='" . $campo->column_name . "' id='" . $campo->column_name . "' required readonly='readonly'>\n";
           
        $inputs .= "</div>\n";
        
        
        # modal para pesquisa 
        $searchModal .= "<!--######################  MODAL {$nomeTableFk[0]->tabela} ###################-->\n\n"
                . "<div class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" id=\"modal_{$campo->column_name}\">
            <div class=\"modal-dialog\" role=\"document\">
              <div class=\"modal-content\">
                <div class=\"modal-header\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                  <h4 class=\"modal-title\">Cadastro {$nomeTableFk[0]->tabela}</h4>
                </div>
                <div class=\"modal-body\">
                  <label>Pesquisa</label>
                          <input type=\"text\" class=\"form form-control\" name=\"searc{$campo->column_name}\" id=\"searc{$campo->column_name}\">
                </div>
                <div class=\"modal-footer\">
                  <!--<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>-->
                  <div class=\"col-md-6 text-left\">
                      <a href=\"<?=FuncaoBase::geraLink(\"{$mod}\", \"{$smallTableFk}\", \"cadastro\");?>\" class=\"btn btn-success text-left\" >Cadastrar Novo</a>
                  </div>
                  <div class=\"col-md-6 text-right\">
                      <button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Fechar</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->\n\n <!--###################  FIM MODAL {$nomeTableFk[0]->tabela} ####################-->";
                      
                      
    # array para "injetar easyautocomplete no form           
    $dados_fk .= "
    
     /* ###################  fk_{$nomeTableFk[0]->tabela} ####################*/
        $('#btnBusca{$id_fk}').click(function () {
            $('#modal_{$id_fk}').modal({backdrop: 'static', keyboard: false});
        });

        var itens = {
            data:
            <?php print json_encode(\$dados{$nomeTblFkCamel}); ?>, // array com os dados
            getValue: \"nome\", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    var id = \$(\"#searc{$id_fk}\").getSelectedItemData().{$id_fk};
                    var nome = \$(\"#searc{$id_fk}\").getSelectedItemData().nome;
                     
                        \$(\"#{$nomeFk}_fk\").val(nome); // Mudar
                       \$(\"#{$id_fk}\").val(id);
                },
                onClickEvent:function(){
                    $('#modal_{$id_fk}').modal('hide');
                }
            }
        };
        /*********** autocomplete ***********/
        \$(\"#searc{$id_fk}\").easyAutocomplete(itens);
                                
    /*###########################  final {$nomeTableFk[0]->tabela} #####################*/";
        
    }
}



$cadastro = fopen("arquivo/crud/{$smallTable}/cadastro.php", "w") or die("Unable to open file!");


$texto = <<< codPhp


<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "{$modulo}/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php

{$obj_fk}

?>

<legend>Cadastro de {$smallTableCamel}</legend>
<form action="<?=FuncaoBase::geraLink("{$mod}", "{$smallTable}", "gravar");?>" method="post" accept-charset="utf-8" name="frm{$smallTableCamel}" id="frm{$smallTableCamel}">
    
    {$inputs}
    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("{$mod}", "{$smallTable}", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    </div>
</form>
    
    
    {$searchModal }

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
    
    
        /* radio button padrao */
        {$radio_button_padrao}
    
        /* close focus pesquisa */
        {$close_focus_pesquisa}
    
        $("#frm{$smallTableCamel}").trigger("reset");
        
    
        {$datamask}
        
        
   {$dados_fk}
        

    });
</script>
        
codPhp;

try {
    fwrite($cadastro, $texto);
    fclose($cadastro);
} catch (Exception $e) {
    print $e->getMessage() . "Erro na geração do arquivo cadastro";
}


