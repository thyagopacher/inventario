function salvarCidade() {
    if ($("#nome").val() !== null && $("#nome").val() !== "") {
        $.ajax({
            url: "../control/SalvarCidade.php",
            type: "POST",
            data: $("#fcidade").serialize(),
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.situacao === true) {
                    swal("Cidade salva", data.mensagem, "success");
                    procurarCidade(true);
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

function excluirCidade(codcidade) {
    if (typeof (codcidade) == "codcidade") {//test do parametro opcional
        codcidade = $("#codcidade").val();
    }
    if (window.confirm("Deseja realmente excluir esse cidade?")) {
        if (codcidade !== null && codcidade !== "") {
            $.ajax({
                url: "../control/ExcluirCidade.php",
                type: "POST",
                data: {codcidade: codcidade},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao === true) {
                        swal("Cidade excluida", data.mensagem, "success");
                        procurarCidade(true);
                    } else if (data.situacao === false) {
                        swal("Erro ao excluir", data.mensagem, "error");
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                }
            });
        } else {
            swal("Campo em branco", "Por favor escolha o cidade para excluir!", "error");
        }
    }
}

function procurarCidade(acao) {
    if (document.getElementById("listagemCidade") != null) {
        $.ajax({
            url: "../control/ProcurarCidade.php",
            type: "POST",
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (acao == false && data === "") {
                    swal("Atenção", "Nada encontrado!", "error");
                }
                document.getElementById("listagemCidade").innerHTML = data;
                dataTablePadrao('table_cidade');
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
            }
        });
    }
}

function novoCidade() {
    document.getElementById("codcidade").value = '';
    document.getElementById("nome").value = '';
    document.getElementById("codestado").value = '';
    $("#btexcluirCidade").hide();
}

function setaEditarCidade(cidade) {
    document.getElementById("codcidade").value = cidade[0];
    document.getElementById("nome").value = cidade[1];
    document.getElementById("codestado").value = cidade[2];
    $("#btexcluirCidade").show();
    document.getElementById("nome").focus();
}

procurarCidade();
