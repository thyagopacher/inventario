function salvarAtributoCategoria() {
    $.ajax({
        url: "../control/SalvarAtributoCategoria.php",
        type: "POST",
        data: $("#fatributocategoria").serialize(),
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if (data.situacao === true) {
                swal("Atributo categoria salvo", data.mensagem, "success");
                procurarAtributoCategoria(true);
            } else if (data.situacao === false) {
                swal("Erro", data.mensagem, "error");
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function excluirAtributoCategoria(codac) {
    if (codac == undefined) {//test do parametro opcional
        codac = $("#codatributo").val();
    }
    if (window.confirm("Deseja excluir esse atributo de categoria?")) {
        if (codac != null && codac != "") {
            $.ajax({
                url: "../control/ExcluirAtributoCategoria.php",
                type: "POST",
                data: {codac: codac},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao === true) {
                        swal("Atributo categoria excluido", data.mensagem, "success");
                        procurarAtributoCategoria(true);
                    } else if (data.situacao === false) {
                        swal("Erro ao excluir", data.mensagem, "error");
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                }
            });
        } else {
            swal("Campo em branco", "Por favor escolha o atributo para excluir!", "error");
        }
    }
}

function procurarAtributoCategoria() {
    if (document.getElementById("listagemAtributoCategoria") != null) {
        var variaveis = null;
        if($("#codAtributoCategoria").val() == ""){
            variaveis = {codatributo: $("#codatributoAtrCat").val()};
        }else{
            variaveis = {codcategoria: $("#codAtributoCategoria").val()};
        }
        $.ajax({
            url: "../control/ProcurarAtributoCategoria.php",
            type: "POST",
            data: variaveis,
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                $("#listagemAtributoCategoria").html(data);
                dataTablePadrao('table_atributo_categoria');
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });
    }
}

function btNovoAtributoCategoria() {
    document.getElementById("codacCategoria").value = '';
    document.getElementById("codatributoAtrCat").value = '';
    document.getElementById("adicionarcategorias").value = '';
    document.getElementById("codAtributoCategoria").value = '';
    document.getElementById("obrigatorio").value = '';
    $("#btexcluirAtributoCategoria").hide();
}

function setaEditarAtributoCategoria(atributo) {
    document.getElementById("codacCategoria").value = atributo[0];
    document.getElementById("codatributoAtrCat").value = atributo[1];
    document.getElementById("codAtributoCategoria").value = atributo[2];
    document.getElementById("obrigatorio").value = atributo[3];
    document.getElementById("adicionarcategorias").value = '';
    $("#btexcluirAtributoCategoria").show();
    document.getElementById("codAtributoCategoria").focus();
}

$(function () {
    $("#codAtributoCategoria, #codatributoAtrCat").change(function () {
        procurarAtributoCategoria();
    });
});

