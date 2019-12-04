function salvarStatusProduto() {
    if ($("#nomeStatusProduto").val() !== null && $("#nomeStatusProduto").val() !== "") {
        $.ajax({
            url: "../control/SalvarStatusProduto.php",
            type: "POST",
            data: $("#fstatus").serialize(),
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.situacao === true) {
                    swal("Status salvo", data.mensagem, "success");
                    window.localStorage.removeItem('optionStatusProduto');
                    window.localStorage.removeItem('listagemStatusProduto');
                    procurarStatusProduto(true);
                    optionStatusProduto();
                } else if (data.situacao === false) {
                    swal("Erro", data.mensagem, "error");
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });
    } else if ($("#nomeStatusProduto").val() === null || $("#nomeStatusProduto").val() === "") {
        swal("Campo em branco", "Por favor escolha um nome!", "error");
    }
}

function excluirStatusProduto(codstatus) {
    if (typeof (codstatus) == "codstatus") {//test do parametro opcional
        codstatus = $("#codstatusStatus").val();
    }
    swal({
        title: "Confirma exclusão?",
        text: "Você não poderá mais visualizar as informações dessa status!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, exclua ele!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            if (codstatus !== null && codstatus !== "") {
                $.ajax({
                    url: "../control/ExcluirStatusProduto.php",
                    type: "POST",
                    data: {codstatus: codstatus},
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        if (data.situacao === true) {
                            swal("Status produto excluido", data.mensagem, "success");
                            window.localStorage.removeItem('optionStatusProduto');
                            window.localStorage.removeItem('listagemStatusProduto');
                            procurarStatusProduto(true);
                            optionStatusProduto();

                        } else if (data.situacao === false) {
                            swal("Erro", data.mensagem, "error");
                        }
                    }, error: function (jqXHR, textStatus, errorThrown) {
                        swal("Erro", "Erro causado por:" + errorThrown, "error");
                    }
                });
            } else {
                swal("Campo em branco", "Por favor escolha o status para excluir!", "error");
            }
        }
    });

}

function excluirStatusProdutos() {
    swal({
        title: "Confirma exclusão?",
        text: "Você não poderá mais visualizar as informações dessa cat. produto!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, exclua ele!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: "../control/ExcluirStatusProduto.php",
                type: "POST",
                data: $("#fProcurarNivel").serialize(),
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao == true) {
                        swal("Status Produto excluido", data.mensagem, "success");
                        procurarStatusProduto(true);
                        window.localStorage.removeItem('optionStatusProduto');
                        window.localStorage.removeItem('listagemStatusProduto');
                    } else if (data.situacao == false) {
                        swal("Erro ao excluir", data.mensagem, "error");
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                }
            });
        }
    });
}

function setaEditarStatusProduto(status) {
    document.getElementById("codstatusStatus").value = status[0];
    document.getElementById("nomeStatusProduto").value = status[1];
    document.getElementById("corStatusProduto").value = status[2];
    $("#btexcluirStatusProduto").css("display", "");
    document.getElementById("nomeStatusProduto").focus();
}

function novoStatusProduto() {
    document.getElementById("codstatusStatus").value = '';
    document.getElementById("nomeStatusProduto").value = '';
    document.getElementById("corStatusProduto").value = '';
    $("#btexcluirStatusProduto").css("display", "none");
}

function procurarStatusProduto(acao) {
    if (window.localStorage.getItem("listagemStatusProduto") == null || window.localStorage.getItem("listagemStatusProduto") == "") {
        $.ajax({
            url: "../control/ProcurarStatusProduto.php",
            type: "POST",
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (acao == false && data == "") {
                    swal("Atenção", "Nada encontrado!", "error");
                }
                document.getElementById("listagemStatusProduto").innerHTML = data;
                window.localStorage.setItem('listagemStatusProduto', data);
                dataTablePadrao('table_status');
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
            }
        });
    } else {
        document.getElementById("listagemStatusProduto").innerHTML = window.localStorage.getItem("listagemStatusProduto");
        dataTablePadrao('table_status');
    }
}

function marcarTudoStatusProduto() {
    if ($(".checkbox_pagina").prop("checked") == true) {
        $(".checkbox_pagina").prop("checked", false);
    } else {
        $(".checkbox_pagina").prop("checked", true);
    }
}

$(document).ready(function () {
    procurarStatusProduto();

    $("#fstatus").submit(function () {
        $(".progress").css("visibility", "visible");
    });

    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');

    $('#fstatus').ajaxForm({
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
                swal("Salvar", data.mensagem, "success");
                window.localStorage.removeItem('listagemStatusProduto');
                procurarStatusProduto();
            } else if (data.situacao === false) {
                swal("Erro", data.mensagem, "error");
            }
        }
    });
});