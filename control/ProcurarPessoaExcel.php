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
            ->setCellValue('B1', "Nome")
            ->setCellValue('C1', "Nivel")
            ->setCellValue("D1", "Status");

// Podemos configurar diferentes larguras paras as colunas como padrão
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);

// Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);
$and     = "";
if (isset($_POST["nome"]) && $_POST["nome"] != NULL && $_POST["nome"] != "") {
    $and .= " and pessoa.nome like '%".$conexao->trataString($_POST["nome"])."%'";
}
if (isset($_POST["email"]) && $_POST["email"] != NULL && $_POST["email"] != "") {
    $and .= " and pessoa.email like '%".$conexao->trataString($_POST["email"])."%'";
}

//dt cadastro
if (isset($_POST["data1"]) && $_POST["data1"] != NULL && $_POST["data1"] != "") {
    if (strpos($_POST["data1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data1"])));
    } else {
        $data1 = $_POST["data1"];
    }
    $and .= " and pessoa.dtcadastro >= '{$data1} 00:00:00'";
}
if (isset($_POST["data2"]) && $_POST["data2"] != NULL && $_POST["data2"] != "") {
    if (strpos($_POST["data2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data2"])));
    } else {
        $data1 = $_POST["data2"];
    }
    $and .= " and pessoa.dtcadastro <= '{$data1} 23:59:59'";
}

$sql = 'select pessoa.codpessoa, pessoa.nome, pessoa.cpf, 
    pessoa.email, DATE_FORMAT(pessoa.dtcadastro, "%d/%m/%Y") as data, pessoa.senha, pessoa.status,
    nivel.nome as nivel
    from pessoa 
    inner join nivel on nivel.codnivel = pessoa.codnivel 
    where 1 = 1 ' . $and . $orderby;
$res = $conexao->comando($sql)or die('Erro no comando: <pre>' . $sql . '</pre>');
$qtd = $conexao->qtdResultado($res);
if($qtd > 0){
    $linha = 2;
    while($pessoa = $conexao->resultadoArray($res)){
        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $linha, $pessoa["data"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $linha, $pessoa["nome"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $linha, $pessoa["nivel"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $linha, $pessoa["status"]);

        $linha++;
    }
}

// Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
$objPHPExcel->getActiveSheet()->setTitle('Relatório de Pessoas');

// Cabeçalho do arquivo para ele baixar
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="procurar_pessoas_'.date("YmdHis").'.xls"');
header('Cache-Control: max-age=0');
// Se for o IE9, isso talvez seja necessário
header('Cache-Control: max-age=1');

// Acessamos o 'Writer' para poder salvar o arquivo
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
$objWriter->save('php://output'); 

exit;

?>
