<?php

/* 
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */

include("./gera_excel/PHPExcel.php");
$objPHPExcel = new PHPExcel();

// Definimos o estilo da fonte
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

session_start();
include '../model/Conexao.php';
$conexao = new Conexao();

// Criamos as colunas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Dt. Cadastro' )
            ->setCellValue('B1', "Categoria")
            ->setCellValue('C1', "Departamento")
            ->setCellValue("D1", "Patrimônio")
            ->setCellValue("E1", "Serial / TAG")
            ->setCellValue("F1", "Dt. Compra")
            ->setCellValue("G1", "Uso");

$resatributo = $conexao->comando("select nome 
    from atributo 
where codatributo not in(2, 3, 15, 25) 
and tipo <> 'file' 
and codatributo in(select codatributo from valorproduto)
order by nome");
$qtdatributo = $conexao->qtdResultado($resatributo);
if($qtdatributo > 0){
    $letra = chr(ord('H'));
    while($atributo = $conexao->resultadoArray($resatributo)){
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.'1', ucfirst($atributo["nome"]));
        $letra = chr(ord($letra) + 1);
    }
}

// Podemos configurar diferentes larguras paras as colunas como padrão
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);

// Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);


$and     = "";

if (isset($_POST["nome"]) && $_POST["nome"] != NULL && $_POST["nome"] != "") {
    $and .= " and produto.nome like '%".$conexao->trataString($_POST["nome"])."%'";
}

//dt cadastro
if (isset($_POST["data1"]) && $_POST["data1"] != NULL && $_POST["data1"] != "") {
    if (strpos($_POST["data1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data1"])));
    } else {
        $data1 = $_POST["data1"];
    }
    $and .= " and produto.dtcadastro >= '{$data1} 00:00:00'";
}
if (isset($_POST["data2"]) && $_POST["data2"] != NULL && $_POST["data2"] != "") {
    if (strpos($_POST["data2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data2"])));
    } else {
        $data1 = $_POST["data2"];
    }
    $and .= " and produto.dtcadastro <= '{$data1} 23:59:59'";
}

//dt de compra
if (isset($_POST["dataCompra1"]) && $_POST["dataCompra1"] != NULL && $_POST["dataCompra1"] != "") {
    if (strpos($_POST["dataCompra1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["dataCompra1"])));
    } else {
        $data1 = $_POST["dataCompra1"];
    }
    $and .= " and produto.codproduto in(select codproduto from valorproduto where codatributo = 15 and valor >= '{$data1}')";
}
if (isset($_POST["dataCompra2"]) && $_POST["dataCompra2"] != NULL && $_POST["dataCompra2"] != "") {
    if (strpos($_POST["dataCompra2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["dataCompra2"])));
    } else {
        $data1 = $_POST["dataCompra2"];
    }
    $and .= " and produto.codproduto in(select codproduto from valorproduto where codatributo = 15 and valor <= '{$data1}')";
}

if (isset($_POST["codatributo"]) && $_POST["codatributo"] != NULL && $_POST["codatributo"] != "") {
    $and .= " and produto.codproduto in(select codproduto from valorproduto where codatributo = {$_POST["codatributo"]})";
}

if (isset($_POST["codcategoria"]) && $_POST["codcategoria"] != NULL && $_POST["codcategoria"] != "") {
    $and .= " and produto.codcategoria = '{$_POST["codcategoria"]}'";
}
if (isset($_POST["coddepartamento"]) && $_POST["coddepartamento"] != NULL && $_POST["coddepartamento"] != "") {
    $and .= " and departamento.coddepartamento = '{$_POST["coddepartamento"]}'";
}
if (isset($_POST["coddiretoria"]) && $_POST["coddiretoria"] != NULL && $_POST["coddiretoria"] != "") {
    $and .= " and diretoria.coddiretoria = '{$_POST["coddiretoria"]}'";
}
if (isset($_POST["codstatus"]) && $_POST["codstatus"] != NULL && $_POST["codstatus"] != "") {
    $and .= " and produto.codstatus = '{$_POST["codstatus"]}'";
}
if (isset($_POST["procurar_menu"]) && $_POST["procurar_menu"] != NULL && $_POST["procurar_menu"] != "") {
    $and .= " and (status.nome    like '%{$_POST["procurar_menu"]}%' 
             or diretoria.nome    like '%{$_POST["procurar_menu"]}%' 
             or categoria.nome    like '%{$_POST["procurar_menu"]}%'    
             or produto.nome      like '%{$_POST["procurar_menu"]}%'    
             or departamento.nome like '%{$_POST["procurar_menu"]}%')";
}

$sql = 'select produto.codproduto, produto.nome, produto.codcategoria, status.nome as status,
    DATE_FORMAT(produto.dtcadastro, "%d/%m/%Y") as dtcadastro2, categoria.nome as categoria,
    status.cor, departamento.nome as departamento,
    (select valor from valorproduto where codatributo = 5 and codproduto = produto.codproduto) as utilizador,
    (select valor from valorproduto where codatributo = 1 and codproduto = produto.codproduto) as nome,
    (select valor from valorproduto where codatributo = 15 and codproduto = produto.codproduto) as dtcompra,
    (select valor from valorproduto where codatributo = 3 and codproduto = produto.codproduto) as serialtag,
    (select valor from valorproduto where codatributo = 17 and codproduto = produto.codproduto) as statusgarantia,
    (select valor from valorproduto where codatributo = 2 and codproduto = produto.codproduto) as patrimonio
    from produto 
    inner join categoriaproduto as categoria on categoria.codcategoria = produto.codcategoria 
    inner join departamento on departamento.coddepartamento = produto.coddepartamento
    inner join diretoria on diretoria.coddiretoria = departamento.coddiretoria
    inner join statusproduto as status on status.codstatus = produto.codstatus
    where 1 = 1 ' . $and . ' order by produto.nome';
$res = $conexao->comando($sql)or die('Erro no comando: <pre>' . $sql . '</pre>');
$qtd = $conexao->qtdResultado($res);
if($qtd > 0){
    $linha = 2;
    while($produto = $conexao->resultadoArray($res)){
        $tempoUso = strtotime(date("Y-m-d")) - strtotime($produto["dtcompra"]);
        $dias = (int) floor($tempoUso / (60 * 60 * 24)); // 225 dias
        if ($dias > 30 && $dias < 365) {
            $dias = $dias / 30;
        } elseif ($dias > 365) {
            $dias = $dias / 30 / 12;
        } elseif ($dias < 30) {
            $dias = 0;
        }

        if (isset($produto["statusgarantia"]) && $produto["statusgarantia"] != NULL) {
            if (strtotime($produto["statusgarantia"]) > strtotime(date("Y-m-d"))) {
                $corVGarantia = 'color: green';
                $statusGarantia = 'V';
            } else {
                $corVGarantia = 'color: red';
                $statusGarantia = 'X';
            }
        }
        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $linha, $produto["dtcadastro2"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $linha, $produto["categoria"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $linha, $produto["departamento"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $linha, $produto["patrimonio"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $linha, $produto["serialtag"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $linha, date("d/m/Y", strtotime($produto["dtcompra"])));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $linha, number_format($dias, 1, ',', ''));
        
        $coluna = 7;
        $resatributo = $conexao->comando("select atributo.nome, vp.valor 
        from atributo 
        left join valorproduto as vp on vp.codatributo = atributo.codatributo and vp.codproduto = {$produto["codproduto"]}
        where atributo.codatributo not in(2, 3, 15, 25) 
        and atributo.tipo <> 'file' 
        and atributo.codatributo in(select codatributo from valorproduto)
        order by atributo.nome");     
        $qtdatributo = $conexao->qtdResultado($resatributo);
        if($qtdatributo > 0){
            while($atributo = $conexao->resultadoArray($resatributo)){
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $atributo["valor"]);
                $coluna++;
            }
        }
        $linha++;
    }
}

// Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
$objPHPExcel->getActiveSheet()->setTitle('Relatório de Ativos');

// Cabeçalho do arquivo para ele baixar
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="procurar_ativos_'.date("YmdHis").'.xls"');
header('Cache-Control: max-age=0');
// Se for o IE9, isso talvez seja necessário
header('Cache-Control: max-age=1');

// Acessamos o 'Writer' para poder salvar o arquivo
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
$objWriter->save('php://output'); 

exit;

?>
