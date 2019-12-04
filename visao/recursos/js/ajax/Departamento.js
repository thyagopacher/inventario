function salvarDepartamento() {
    $.ajax({
        url: "../control/SalvarDepartamento.php",
        type: "POST",
        data: $("#fdepartamento").serialize(),
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if (data.situacao === true) {
                swal("Departamento salvo", data.mensagem, "success");
                procurarDepartamento(true);
            } else if (data.situacao === false) {
                swal("Erro", data.mensagem, "error");
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function excluirDepartamento(coddepartamento) {
    if (typeof (coddepartamento) == "coddepartamento") {//test do parametro opcional
        coddepartamento = $("#coddepartamento").val();
    }
    if (window.confirm("Deseja realmente excluir esse departamento?")) {
        if (coddepartamento != null && coddepartamento != "") {
            $.ajax({
                url: "../control/ExcluirDepartamento.php",
                type: "POST",
                data: {coddepartamento: coddepartamento},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao === true) {
                        swal("Departamento excluido", data.mensagem, "success");
                        procurarDepartamento(true);
                    } else if (data.situacao === false) {
                        swal("Erro ao excluir", data.mensagem, "error");
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                }
            });
        } else {
            swal("Campo em branco", "Por favor escolha o departamento para excluir!", "error");
        }
    }
}

function procurarDepartamento(acao) {
    if (document.getElementById("listagemDepartamento") != null) {
        $.ajax({
            url: "../control/ProcurarDepartamento.php",
            type: "POST",
            data: $("#fProcurarDepartamento").serialize(),
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (acao == false && data === "") {
                    swal("Atenção", "Nada encontrado!", "error");
                }
                document.getElementById("listagemDepartamento").innerHTML = data;
                dataTablePadrao('table_departamento');
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
            }
        });
    }
}

function btNovo() {
    document.getElementById("coddepartamento").value = '';
    document.fdepartamento.nome.value = '';
    document.getElementById("coddiretoria").value = '';
    $("#btexcluirDepartamento").hide();
}

function setaEditarDepartamento(departamento) {
    document.getElementById("coddepartamento").value = departamento[0];
    document.fdepartamento.nome.value = departamento[1];
    document.getElementById("coddiretoriaDepartamento").value = departamento[2];
    $("#btexcluirDepartamento").show();
    document.fdepartamento.nome.focus();
}

procurarDepartamento();
