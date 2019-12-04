function reenviarLogin(codpessoa) {
    $.ajax({
        url: "../control/ReenviarLogin.php",
        type: "POST",
        data: {codpessoa: codpessoa},
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if (data.situacao === true) {
                swal("Login enviado", data.mensagem, "success");
                procurarPessoa(true);
            } else if (data.situacao === false) {
                swal("Erro ao enviar", data.mensagem, "error");
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro ao enviar", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function excluirPessoa(codpessoa) {
    if (typeof (codpessoa) == "codatributo") {//test do parametro opcional
        codpessoa = $("#codatributo").val();
    }    
    if (window.confirm("Deseja realmente excluir esse pessoa?")) {
        if (codpessoa != null && codpessoa != "") {
            $.ajax({
                url: "../control/ExcluirPessoa.php",
                type: "POST",
                data: {codpessoa: codpessoa},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao === true) {
                        swal("Pessoa excluida", data.mensagem, "success");
                        procurarPessoa(true);
                    } else if (data.situacao === false) {
                        swal("Erro ao excluir", data.mensagem, "error");
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                }
            });
        } else {
            swal("Campo em branco", "Por favor escolha a pessoa para excluir!", "error");
        }
    }
}

function excluirFoto(codpessoa) {
    swal({
        title: "Confirma exclusão?",
        text: "Você não poderá mais visualizar a imagem dessa pessoa!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, exclua ele!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            if (codpessoa !== null && codpessoa !== "") {
                $.ajax({
                    url: "../control/ExcluirImgPessoa.php",
                    type: "POST",
                    data: {codpessoa: codpessoa},
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        if (data.situacao === true) {
                            swal("Imagem Pessoa excluida", data.mensagem, "success");

                            $("#imagemCarregada").html("");
                        } else if (data.situacao === false) {
                            swal("Erro ao excluir", data.mensagem, "error");
                        }
                    }, error: function (jqXHR, textStatus, errorThrown) {
                        swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                    }
                });
            } else {
                swal("Campo em branco", "Por favor escolha a imagem pessoa para excluir!", "error");
            }
        }
    });
}

function abreTiraFoto(codpessoa) {
    var oWin = window.open("TirarFoto.php?codpessoa=" + codpessoa, "Tirar Foto", "width=1250, height=550");
    if (oWin === null || typeof (oWin) === "undefined") {
        swal("Erro ao visualizar", "O Bloqueador de Pop-up esta ativado, desbloquei-o por favor!", "error");
    } else {
        window.close();
    }
}

function setaEditarPessoa(pessoa) {
    document.getElementById("codpessoa").value = pessoa[0];
    document.getElementById("nome").value = pessoa[1];
    document.getElementById("telefone").value = pessoa[2];
    document.getElementById("email").value = pessoa[3];
    document.getElementById("senha").value = pessoa[4];
    document.getElementById("celular").value = pessoa[5];
    document.getElementById("imagemCarregada").innerHTML = "<img src='../arquivos/" + pessoa[6] + "' alt='Imagem da pessoa' title='Imagem da pessoa'/>";
    $("#btatualizarPessoa").css("display", "");
    $("#btexcluirPessoa").css("display", "");
    $("#btnovoPessoa").css("display", "");
    $("#btinserirPessoa").css("display", "none");
    $("#codnivel option[value='" + pessoa[7] + "']").attr("selected", true);
    document.getElementById("nome").focus();
}

function procurarPessoa(acao) {
    $.ajax({
        url: '../control/ProcurarPessoa.php',
        type: "POST",
        data: $("#fPpessoa").serialize(),
        dataType: 'text',
        success: function (data, textStatus, jqXHR) {
            if (acao === false && data === "") {
                swal("Atenção", "Nada encontrado de pessoas!", "error");
            }
            document.getElementById("listagemPessoa").innerHTML = data;
            dataTablePadrao('table_usuario');
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function abreRelatorioPessoa() {
    document.getElementById("tipo").value = "pdf";
    document.getElementById("fPpessoa").action = '../control/ProcurarPessoaRelatorio.php';
    document.getElementById("fPpessoa").submit(); 
}

function abreRelatorioPessoa2() {
    document.getElementById("tipo").value = "xls";
    document.getElementById("fPpessoa").action = '../control/ProcurarPessoaExcel.php';
    document.getElementById("fPpessoa").submit();
}

$(function () {
    $("#fpessoa").submit(function () {
        $(".progress").css("visibility", "visible");
    });

    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');

    $('#fpessoa').ajaxForm({
        beforeSend: function () {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function () {
            var percentVal = '100%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function (xhr) {
            var data = JSON.parse(xhr.responseText);
            if (data.situacao === true) {
                if ($("#codpessoa").val() !== null && $("#codpessoa").val() !== "") {
                    swal("Alteração", data.mensagem, "success");
                    if (data.imagem !== null && data.imagem !== "") {
                        $("#imagemCarregada").html("<img width='150' src='../arquivos/" + data.imagem + "'  alt='Imagem usuário'/>");
                    }

                } else {
                    swal("Cadastro", data.mensagem, "success");
                }
                procurarPessoa(true);
            } else if (data.situacao === false) {
                swal("Erro", data.mensagem, "error");
            }
        }
    });
});
