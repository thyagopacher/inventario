function salvarLocal() {
    if (document.flocal.nome.value != null && document.flocal.nome.value != "") {
        $.ajax({
            url: "../control/SalvarLocal.php",
            type: "POST",
            data: $("#flocal").serialize(),
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.situacao === true) {
                    swal("Local salvo", data.mensagem, "success");
                    procurarLocal(true);
                } else if (data.situacao === false) {
                    swal("Erro", data.mensagem, "error");
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });
    } else if (document.flocal.nome.value == null || document.flocal.nome.value == "") {
        swal("Campo em branco", "Por favor defina um nome!", "error");
    }
}

function excluirLocal(codlocal) {
    if (typeof (codlocal) == "codlocal") {//test do parametro opcional
        codlocal = $("#codlocal").val();
    }
    if (window.confirm("Deseja realmente excluir esse local?")) {
        if (codlocal !== null && codlocal !== "") {
            $.ajax({
                url: "../control/ExcluirLocal.php",
                type: "POST",
                data: {codlocal: codlocal},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao === true) {
                        swal("Local excluido", data.mensagem, "success");
                        procurarLocal(true);
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

function procurarLocal(acao) {
    if (document.getElementById("listagemLocal") != null) {
        $.ajax({
            url: "../control/ProcurarLocal.php",
            type: "POST",
            data: $("#fProcurarLocal").serialize(),
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (acao == false && data === "") {
                    swal("Atenção", "Nada encontrado!", "error");
                }
                document.getElementById("listagemLocal").innerHTML = data;
                dataTablePadrao('table_local');
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
            }
        });
    }
}

function novoLocal() {
    document.flocal.codlocal.value = '';
    document.flocal.nome.value = '';
    $("#btexcluirLocal").hide();
}

function setaEditarLocal(local) {
    document.flocal.codlocal.value = local[0];
    document.flocal.nome.value = local[1];
    $("#btexcluirLocal").show();
    document.flocal.nome.focus();
}

procurarLocal();

