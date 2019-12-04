function excluirProduto(codproduto) {
    if (typeof (codproduto) == "undefined") {//test do parametro opcional
        codproduto = $("#codproduto").val();
    }
    swal({
        title: "Confirma exclusão?",
        text: "Você não poderá mais visualizar as informações dessa produto!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, exclua ele!",
        cancelButtonText: "Não",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            if (codproduto !== null && codproduto !== "") {
                $.ajax({
                    url: "../control/ExcluirProduto.php",
                    type: "POST",
                    data: {codproduto: codproduto},
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        if (data.situacao === true) {
                            swal("Produto excluida", data.mensagem, "success");
                            procurarProduto(true);
                        } else if (data.situacao === false) {
                            swal("Erro ao excluir", data.mensagem, "error");
                        }
                    }, error: function (jqXHR, textStatus, errorThrown) {
                        swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                    }
                });
            } else {
                swal("Campo em branco", "Por favor escolha a produto para excluir!", "error");
            }
        } 
    });
}

function procurarProduto(acao) {
    $("#carregando").show();
    $.ajax({
        url: "../control/ProcurarProduto.php",
        type: "POST",
        data: $("#fPproduto").serialize(),
        dataType: 'text',
        success: function (data, textStatus, jqXHR) {
            if (acao == false && data === "") {
                swal("Atenção", "Nada encontrado de produtos!", "error");
            }
            document.getElementById("listagemProduto").innerHTML = data;
            dataTablePadrao('table_produto');
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
        }
    });
    $("#carregando").hide();
}

function abreRelatorioProduto() {
    document.getElementById("fPproduto").action = "../control/ProcurarProdutoRelatorio.php";
    document.getElementById("tipo").value = "pdf";
    document.getElementById("fPproduto").submit();
}

function abreRelatorioProduto2() {
    document.getElementById("fPproduto").action = "../control/ProcurarProdutoExcel.php";
    document.getElementById("tipo").value = "xls";
    document.getElementById("fPproduto").submit();
}

function aparecesiteBuscar(componente) {
    var id = componente.prop("id").replace('aparecesite', '');
    $.ajax({
        url: "../control/SalvarProduto.php",
        type: "POST",
        data: {COD_PRODUTO: id, aparecesite: componente.val()},
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if (data.situacao === true) {
                swal("Produto salvo", data.mensagem, "success");
                procurarProduto(true);
            } else if (data.situacao === false) {
                swal("Erro", data.mensagem, "error");
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function ativoBuscar(componente) {
    var id = componente.prop("id").replace('IND_ATIVO', '');
    $.ajax({
        url: "../control/SalvarProduto.php",
        type: "POST",
        data: {COD_PRODUTO: id, IND_ATIVO: componente.val()},
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if (data.situacao === true) {
                swal("Produto salvo", data.mensagem, "success");
                procurarProduto(true);
            } else if (data.situacao === false) {
                swal("Erro", data.mensagem, "error");
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function excluirArquivo(codigo) {
    $.ajax({
        url: "../control/ExcluirArquivoProduto.php",
        type: "POST",
        data: {codvalor: codigo},
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if (data.situacao === true) {
                swal("Arquivo excluido", data.mensagem, "success");
            } else if (data.situacao === false) {
                swal("Erro", data.mensagem, "error");
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

$(function () {

    $("#codestado").change(function () {
        $.ajax({
            url: "../control/OptionCidades.php",
            type: "POST",
            data: {codestado: $("#codestado").val()},
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                document.getElementById("codcidade").innerHTML = data;
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });
    });

    $("#codcidade").change(function () {
        $.ajax({
            url: "../control/OptionLocal.php",
            type: "POST",
            data: {codcidade: $("#codcidade").val()},
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                document.getElementById("codlocal").innerHTML = data;
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });
    });

    $("#codcategoriaProduto").change(function () {
        $.ajax({
            url: "../control/MostraCampos.php",
            type: "POST",
            data: {codcategoria: $("#codcategoriaProduto").val()},
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (data.situacao == undefined) {
                    var campos = JSON.parse(data);
                    $(".campo_produto").hide();
                    for (var i = 0; i < campos.length; i++) {
                        $("#div_campo_produto" + campos[i]['codatributo']).show();
                        if(campos[i]['obrigatorio'] == "s"){
                            $("#campo_produto").prop("required", true);
                        }else{
                            $("#campo_produto").prop("required", false);
                        }
                    }
                } else {
                    swal("Erro", data.mensagem, "error");
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });

    });

    $("#fproduto").submit(function () {
        $(".progress").css("visibility", "visible");
    });

    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');

    $('#fproduto').ajaxForm({
        beforeSend: function () {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        success: function () {
            var percentVal = '100%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        complete: function (xhr) {
            var data = JSON.parse(xhr.responseText);
            if (data.situacao === true) {
                if ($("#codproduto").val() !== null && $("#codproduto").val() !== "") {
                    swal("Alteração", data.mensagem, "success");
                    if (data.imagem !== null && data.imagem !== "") {
                        $("#imagemCarregada").html("<img width='150' src='../arquivos/" + data.imagem + "'  alt='Imagem usuário'/>");
                    }
                } else {
                    swal("Cadastro", data.mensagem, "success");
                }          
                setTimeout('location.href="Produto.php";', 1500);
            } else if (data.situacao === false) {
                swal("Erro", data.mensagem, "error");
            } 
        }
    });
});
