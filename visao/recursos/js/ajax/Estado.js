function salvarEstado() {
    if ($("#nome").val() !== null && $("#nome").val() !== "") {
        $.ajax({
            url: "../control/SalvarEstado.php",
            type: "POST",
            data: $("#festado").serialize(),
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.situacao === true) {
                    swal("Estado salvo", data.mensagem, "success");
                    procurarEstado(true);
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

function excluirEstado(codestado) {
    if (typeof (codestado) == "codestado") {//test do parametro opcional
        codestado = $("#codestado").val();
    }
    if (window.confirm("Deseja realmente excluir esse estado?")) {
        if (codestado !== null && codestado !== "") {
            $.ajax({
                url: "../control/ExcluirEstado.php",
                type: "POST",
                data: {codestado: codestado},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao === true) {
                        swal("Estado excluido", data.mensagem, "success");
                        procurarEstado(true);
                    } else if (data.situacao === false) {
                        swal("Erro ao excluir", data.mensagem, "error");
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                }
            });
        } else {
            swal("Campo em branco", "Por favor escolha o estado para excluir!", "error");
        }
    }
}

function procurarEstado(acao) {
    if (document.getElementById("listagemEstado") != null) {
        $.ajax({
            url: "../control/ProcurarEstado.php",
            type: "POST",
            data: $("#fProcurarEstado").serialize(),
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (acao == false && data === "") {
                    swal("Atenção", "Nada encontrado!", "error");
                }
                document.getElementById("listagemEstado").innerHTML = data;
                dataTablePadrao('table_estado');
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
            }
        });
    }
}

function btNovo() {
    document.getElementById("codestado").value = '';
    document.getElementById("nome").value = '';
    $("#btexcluirEstado").hide();
}

function setaEditarEstado(estado) {
    document.festado.codestado.value = estado[0];
    document.festado.nome.value      = estado[1];
    document.festado.sigla.value = estado[2];
    $("#btexcluirEstado").show();
    document.festado.nome.focus();
}

procurarEstado();