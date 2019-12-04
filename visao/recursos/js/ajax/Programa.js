function salvarPrograma() {
    if ($("#nome").val() !== null && $("#nome").val() !== "") {
        $.ajax({
            url: "../control/SalvarPrograma.php",
            type: "POST",
            data: $("#fprograma").serialize(),
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.situacao === true) {
                    swal("Programa salvo", data.mensagem, "success");
                    procurarPrograma(true);
                } else if (data.situacao === false) {
                    swal("Erro", data.mensagem, "error");
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });
    } else if ($("#nome").val() === null || $("#nome").val() === "") {
        swal("Campo em branco", "Por favor defina um nome para o nível!", "error");
    }
}

function excluirPrograma(codprograma) {
    if (typeof (codprograma) == "codprograma") {//test do parametro opcional
        codprograma = $("#codprograma").val();
    }
    if (window.confirm("Deseja realmente excluir esse programa?")) {
        if (document.getElementById("codprograma").value !== null && document.getElementById("codprograma").value !== "") {
            $.ajax({
                url: "../control/ExcluirPrograma.php",
                type: "POST",
                data: {codprograma: document.getElementById("codprograma").value},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao === true) {
                        swal("Programa excluido", data.mensagem, "success");
                        procurarPrograma(true);
                    } else if (data.situacao === false) {
                        swal("Erro ao excluir", data.mensagem, "error");
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                }
            });
        } else {
            swal("Campo em branco", "Por favor escolha o programa para excluir!", "error");
        }
    }
}

function procurarPrograma(acao) {
    if (document.getElementById("listagemPrograma") != null) {
        $.ajax({
            url: "../control/ProcurarPrograma.php",
            type: "POST",
            data: $("#fProcurarPrograma").serialize(),
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (acao == false && data === "") {
                    swal("Atenção", "Nada encontrado!", "error");
                }
                document.getElementById("listagemPrograma").innerHTML = data;
                dataTablePadrao('table_programa');
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
            }
        });
    }
}

function btNovo() {
    document.getElementById("codprograma").value = '';
    document.getElementById("nome").value = '';
    $("#btexcluirPrograma").hide();
}

function setaPrograma(programa) {
    document.getElementById("codprograma").value = programa[0];
    document.getElementById("nome").value = programa[1];
    $("#btexcluirPrograma").show();
    document.getElementById("nome").focus();
}


