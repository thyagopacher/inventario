function salvarDiretoria() {
    if ($("#nome").val() !== null && $("#nome").val() !== "") {
        $.ajax({
            url: "../control/SalvarDiretoria.php",
            type: "POST",
            data: $("#fdiretoria").serialize(),
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.situacao === true) {
                    swal("Diretoria salvo", data.mensagem, "success");
                    procurarDiretoria(true);
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

function excluirDiretoria(coddiretoria) {
    if (typeof (coddiretoria) == "coddiretoria") {//test do parametro opcional
        coddiretoria = $("#coddiretoria").val();
    }
    if (window.confirm("Deseja realmente excluir esse diretoria?")) {
        if (coddiretoria !== null && coddiretoria !== "") {
            $.ajax({
                url: "../control/ExcluirDiretoria.php",
                type: "POST",
                data: {coddiretoria: coddiretoria},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao === true) {
                        swal("Diretoria excluido", data.mensagem, "success");
                        procurarDiretoria(true);
                    } else if (data.situacao === false) {
                        swal("Erro ao excluir", data.mensagem, "error");
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                }
            });
        } else {
            swal("Campo em branco", "Por favor escolha o diretoria para excluir!", "error");
        }
    }
}

function procurarDiretoria(acao) {
    if (document.getElementById("listagemDiretoria") != null) {
        $.ajax({
            url: "../control/ProcurarDiretoria.php",
            type: "POST",
            data: $("#fProcurarDiretoria").serialize(),
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (acao == false && data === "") {
                    swal("Atenção", "Nada encontrado!", "error");
                }
                document.getElementById("listagemDiretoria").innerHTML = data;
                dataTablePadrao('table_diretoria');
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
            }
        });
    }
}

function btNovo() {
    document.getElementById("coddiretoria").value = '';
    document.getElementById("nome").value = '';
    $("#btexcluirDiretoria").hide();
}

function setaEditarDiretoria(diretoria) {
    document.getElementById("coddiretoria").value = diretoria[0];
    document.getElementById("nome").value = diretoria[1];
    $("#btexcluirDiretoria").show();
    document.getElementById("nome").focus();
}

procurarDiretoria();

