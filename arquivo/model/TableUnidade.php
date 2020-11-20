<?php include_once 'classe/Classe.PDO.php';
include_once 'classe/Classe.Gerador.php';

$gerador = new Gerador();

$infoTabela = $gerador->Tabela($_POST['tabela']);

$campos = $gerador->Campos($_POST['tabela']);

# private vars model
$vars = "";

#get set model
$getSet = "";


foreach ($campos['full'] as $key => $campo) {
    
    # vars private
    $vars .= "private \${$campo->column_name} = null;\n";
    
    #get set model
    $getSet .= "\n public function get".ucfirst($campo->column_name)."(){
        return \$this->{$campo->column_name};
    }\n
            
    public function set".ucfirst($campo->column_name)."(\${$campo->column_name}){
            \$this->{$campo->column_name} = \${$campo->column_name};
    }";

}


class TableUnidade {
    
    
//{$vars}
//{$getSet}

    function __construct() {
        
        
        
    }
    
    

}