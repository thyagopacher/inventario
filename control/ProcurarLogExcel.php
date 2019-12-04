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
            ->setCellValue('B1', "Observação")
            ->setCellValue('C1', "Funcionário");

// Podemos configurar diferentes larguras paras as colunas como padrão
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);

// Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);


$and = "";

if (isset($_POST["coddepartamento"]) && $_POST["coddepartamento"] != NULL && $_POST["coddepartamento"] != "") {
    $and .= " and log.coddepartamento = ".$_POST["coddepartamento"];
}
if (isset($_POST["codlog"]) && $_POST["codlog"] != NULL && $_POST["codlog"] != "") {
    $and .= " and log.codlog = {$_POST["codlog"]}";
}
if (isset($_POST["observacao"]) && $_POST["observacao"] != NULL && $_POST["observacao"] != "") {
    $and .= " and log.observacao like '%".$conexao->trataString($_POST["observacao"])."%'";
}
if (isset($_POST["data1"]) && $_POST["data1"] != NULL && $_POST["data1"] != "") {
    if (strpos($_POST["data1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data1"])));
    } else {
        $data1 = $_POST["data1"];
    }
    $and .= " and log.dtcadastro >= '{$data1}'";
}
if (isset($_POST["data2"]) && $_POST["data2"] != NULL && $_POST["data2"] != "") {
    if (strpos($_POST["data2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data2"])));
    } else {
        $data1 = $_POST["data2"];
    }
    $and .= " and log.dtcadastro <= '{$data1}'";
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
if (isset($_POST["codstatus"]) && $_POST["codstatus"] != NULL && $_POST["codstatus"] != "") {
    $and .= " and produto.codstatus = '{$_POST["codstatus"]}'";
}
$sql = 'select log.codlog, log.observacao, pessoa.nome as funcionario, 
    DATE_FORMAT(log.dtcadastro, "%d/%m/%Y") as dtcadastro2, log.dtcadastro
    from log 
    inner join pessoa  on pessoa.codpessoa   = log.codfuncionario
    left  join produto on produto.codproduto = log.codproduto
    where 1 = 1 ' . $and . ' order by log.dtcadastro';

$res = $conexao->comando($sql);
$qtd = $conexao->qtdResultado($res);

if($qtd > 0){
    $linha = 2;
    while($log = $conexao->resultadoArray($res)){
        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $linha, $log["dtcadastro2"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $linha, $log["observacao"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $linha, $log["funcionario"]);
        
        $linha++;
    }
}

// Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
$objPHPExcel->getActiveSheet()->setTitle('Relatório de Histórico');

// Cabeçalho do arquivo para ele baixar
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="procurar_log_'.date("YmdHis").'.xls"');
header('Cache-Control: max-age=0');
// Se for o IE9, isso talvez seja necessário
header('Cache-Control: max-age=1');

// Acessamos o 'Writer' para poder salvar o arquivo
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
$objWriter->save('php://output'); 

exit;

?>
