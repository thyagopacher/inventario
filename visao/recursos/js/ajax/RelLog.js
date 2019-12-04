function procurarLog(acao) {
    $.ajax({
        url: "../control/ProcurarLog.php",
        type: "POST",
        data: $("#flog").serialize(),
        dataType: 'text',
        success: function (data, textStatus, jqXHR) {
            if (acao == false && data == "") {
                swal("Atenção", "Nada encontrado!", "error");
            }
            $("#listagemLog").html(data);
            dataTablePadrao('table_log');
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function abreRelatorioLog() {
    document.getElementById("tipo").value = "pdf";
    document.getElementById("flog").action = "../control/ProcurarLogRelatorio.php";
    document.getElementById("flog").submit();
}

function abreRelatorioLog2() {
    document.getElementById("tipo").value = "xls";
    document.getElementById("flog").action = "../control/ProcurarLogExcel.php";
    document.getElementById("flog").submit();
}