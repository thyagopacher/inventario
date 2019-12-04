function salvarLocalCidade() {
    $.ajax({
        url: "../control/SalvarLocalCidade.php",
        type: "POST",
        data: $("#flocalCidade").serialize(),
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if (data.situacao === true) {
                swal("Local cidade salvo", data.mensagem, "success");
                procurarLocalCidade(true);
            } else if (data.situacao === false) {
                swal("Erro", data.mensagem, "error");
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function excluirLocalCidade(codlc) {
    if (typeof (codlc) == "codlc") {//test do parametro opcional
        codlc = $("#codlc").val();
    }
    if (window.confirm("Deseja realmente excluir esse local?")) {
        if (codlc !== null && codlc !== "") {
            $.ajax({
                url: "../control/ExcluirLocalCidade.php",
                type: "POST",
                data: {codlc: codlc},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao === true) {
                        swal("Local cidade excluido", data.mensagem, "success");
                        procurarLocalCidade(true);
                    } else if (data.situacao === false) {
                        swal("Erro ao excluir", data.mensagem, "error");
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                }
            });
        } else {
            swal("Campo em branco", "Por favor escolha o local para excluir!", "error");
        }
    }
}

function procurarLocalCidade(acao) {
    if (document.getElementById("listagemLocalCidade") != null) {
        $.ajax({
            url: "../control/ProcurarLocalCidade.php",
            type: "POST",
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (acao == false && data === "") {
                    swal("Atenção", "Nada encontrado!", "error");
                }
                document.getElementById("listagemLocalCidade").innerHTML = data;
                dataTablePadrao('table_local_cidade');
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
            }
        });
    }
}

function novoLocalCidade() {
    document.flocalCidade.codlocal.value = '';
    document.flocalCidade.nome.value = '';
    $("#btexcluirLocalCidade").hide();
}

function setaEditarLocalCidade(local) {
    document.flocalCidade.codlocal.value = local[0];
    document.flocalCidade.nome.value = local[1];
    $("#btexcluirLocalCidade").show();
    document.flocalCidade.nome.focus();
}

procurarLocalCidade();

