function salvarAtributo() {
    $.ajax({
        url: "../control/SalvarAtributo.php",
        type: "POST",
        data: $("#fatributo").serialize(),
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if (data.situacao === true) {
                swal("Atributo salvo", data.mensagem, "success");
                procurarAtributo(true);
            } else if (data.situacao === false) {
                swal("Erro", data.mensagem, "error");
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function excluirAtributo(codatributo) {
    if (typeof (codatributo) == "codatributo") {//test do parametro opcional
        codatributo = $("#codatributo").val();
    }
    if (window.confirm("Deseja realmente excluir esse atributo?")) {
        if (codatributo != null && codatributo != "") {
            $.ajax({
                url: "../control/ExcluirAtributo.php",
                type: "POST",
                data: {codatributo: codatributo},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    if (data.situacao === true) {
                        swal("Atributo excluido", data.mensagem, "success");
                        procurarAtributo(true);
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

function procurarAtributo(acao) {
    if (document.getElementById("listagemAtributo") != null) {
        $.ajax({
            url: "../control/ProcurarAtributo.php",
            type: "POST",
            data: {codpagina: $("#codpagina").val()},
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (acao == false && data === "") {
                    swal("Atenção", "Nada encontrado!", "error");
                }
                document.getElementById("listagemAtributo").innerHTML = data;
                dataTablePadrao('table_atributo');
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
            }
        });
    }
}

function novoAtributo() {
    document.getElementById("codatributo").value = '';
    document.getElementById("nome").value = '';
    document.getElementById("tipo").value = '';
    document.getElementById("tamanho").value = '';
    document.getElementById("lista").value = '';
    document.getElementById("mascara").value = '';
    document.getElementById("ordem").value = '';
    $("#btexcluirAtributo").hide();
}

function setaEditarAtributo(atributo) {
    document.getElementById("codatributo").value = atributo[0];
    document.getElementById("nome").value = atributo[1];
    document.getElementById("tipo").value = atributo[2];
    document.getElementById("tamanho").value = atributo[3];
    document.getElementById("lista").value = atributo[4];
    document.getElementById("mascara").value = atributo[5];
    document.getElementById("ordem").value = atributo[6];
    if (atributo[2] == "varchar" || atributo[2] == "int" || atributo[2] == "date") {
        $("#div_mascara").show();
    } else {
        $("#div_mascara").hide();
    }
    if (atributo[2] == "select") {
        $("#div_listagem_select").show();
    } else {
        $("#div_listagem_select").hide();
    }
    $("#btexcluirAtributo").show();
    document.getElementById("nome").focus();
}

procurarAtributo();

$(function () {
    $("#tipo").change(function () {
        if ($("#tipo").val() == "select") {
            $("#div_listagem_select").show();
            $("#div_mascara").hide();
        } else {
            if ($("#tipo").val() == "varchar" || $("#tipo").val() == "int" || $("#tipo").val() == "date" || $("#tipo").val() == "text") {
                if($("#tipo").val() == "date" || $("#tipo").val() == "int"){
                    $(".div_min_max").show();
                }
                if($("#tipo").val() == "date"){
                    $("#min").remove();
                    $("#max").remove();
                    
                    var option  = '<option>--Selecione--</option>';
                    option     += '<option>hoje</option>';
                    for(var i = 1; i <= 30; i++){
                        option += '<option>hoje + ' + i + 'd</option>';
                    }
                    $("#div_min_valor").append('<select class="form-control" name="min" id="min">' + option + '</select>');
                    $("#div_max_valor").append('<select class="form-control" name="max" id="max">' + option + '</select>');
                }else if($("#tipo").val() == "int"){
                    $("#min").remove();
                    $("#max").remove();
                    
                    $("#div_min_valor").append('<input type="number" class="form-control" name="min" id="min" placeholder="Digite minimo do valor" value="">');
                    $("#div_max_valor").append('<input type="number" class="form-control" name="max" id="max" placeholder="Digite maximo do valor" value="">');                    
                }
                $("#div_mascara").show();
            } else {
                $("#div_mascara").hide();
            }
            $("#div_listagem_select").hide();
        }
    });
    $("#codAtributoCategoria").change(function(){
        if($("#codAtributoCategoria").val() != ""){
            $("#adicionarcategorias").val("n");
        }
    });
});