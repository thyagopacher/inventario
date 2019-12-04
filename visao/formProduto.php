<div class="row">
    <div class="box box-default">
        <div class="box-header with-border">


            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <form action="../control/SalvarProduto.php" id="fproduto" name="fproduto" method="post" novalidate>
                    <input type="hidden" name="codproduto" id="codproduto" value="<?php if(isset($produtop["codproduto"])){echo $produtop["codproduto"];}?>"/>
                    <div class="col-md-2">                         
                        <div class="form-group">
                            <label for="nome">Estado</label>
                            <select class="form-control" name="codestado" id="codestado" required>
                                <?php
                                    $resestado = $conexao->comando('select codestado, nome from estado order by nome');
                                    $qtdestado = $conexao->qtdResultado($resestado);
                                    if($qtdestado > 0){
                                        echo '<option value="">--Selecione--</option>';
                                        while($estado = $conexao->resultadoArray($resestado)){
                                            if(isset($produtop["codestado"]) && $produtop["codestado"] != NULL && $produtop["codestado"] == $estado["codestado"]){
                                                echo '<option selected value="',$estado["codestado"],'">',  ($estado["nome"]),'</option>';
                                            }else{
                                                echo '<option value="',$estado["codestado"],'">',  ($estado["nome"]),'</option>';
                                            }
                                        }
                                    }else{
                                        echo '<option value="">--Nada encontrado--</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-2">                         
                        <div class="form-group">
                            <label for="nome">Cidade</label>
                            <select class="form-control" name="codcidade" id="codcidade" required>
                                <?php
                                    $rescidade = $conexao->comando('select codcidade, nome from cidade order by nome');
                                    $qtdcidade = $conexao->qtdResultado($rescidade);
                                    if($qtdcidade > 0){
                                        echo '<option value="">--Selecione--</option>';
                                        while($cidade = $conexao->resultadoArray($rescidade)){
                                            if(isset($produtop["codcidade"]) && $produtop["codcidade"] != NULL && $produtop["codcidade"] == $cidade["codcidade"]){
                                                echo '<option selected value="',$cidade["codcidade"],'">',  ($cidade["nome"]),'</option>';
                                            }else{
                                                echo '<option value="',$cidade["codcidade"],'">',  ($cidade["nome"]),'</option>';
                                            }
                                        }
                                    }else{
                                        echo '<option value="">--Nada encontrado--</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-2">                         
                        <div class="form-group">
                            <label for="nome">Local</label>
                            <select class="form-control" name="codlocal" id="codlocal" required>
                                <?php
                                    $reslocal = $conexao->comando('select codlocal, nome from local order by nome');
                                    $qtdlocal = $conexao->qtdResultado($reslocal);
                                    if($qtdlocal > 0){
                                        echo '<option value="">--Selecione--</option>';
                                        while($local = $conexao->resultadoArray($reslocal)){
                                            if(isset($produtop["codlocal"]) && $produtop["codlocal"] != NULL && $produtop["codlocal"] == $local["codlocal"]){
                                                echo '<option selected value="',$local["codlocal"],'">',  ($local["nome"]),'</option>';
                                            }else{
                                                echo '<option value="',$local["codlocal"],'">',  ($local["nome"]),'</option>';
                                            }
                                        }
                                    }else{
                                        echo '<option value="">--Nada encontrado--</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-2">                         
                        <div class="form-group">
                            <label for="nome">Departamento</label>
                            <select class="form-control" name="coddepartamento" id="coddepartamento">
                                <?php
                                    $resdepartamento = $conexao->comando('select coddepartamento, nome from departamento order by nome');
                                    $qtddepartamento = $conexao->qtdResultado($resdepartamento);
                                    if($qtddepartamento > 0){
                                        echo '<option value="">--Selecione--</option>';
                                        while($departamento = $conexao->resultadoArray($resdepartamento)){
                                            if(isset($produtop["coddepartamento"]) && $produtop["coddepartamento"] != NULL && $produtop["coddepartamento"] == $departamento["coddepartamento"]){
                                                echo '<option selected value="',$departamento["coddepartamento"],'">',  ($departamento["nome"]),'</option>';
                                            }else{
                                                echo '<option value="',$departamento["coddepartamento"],'">',  ($departamento["nome"]),'</option>';
                                            }
                                        }
                                    }else{
                                        echo '<option value="">--Nada encontrado--</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-2">                         
                        <div class="form-group">
                            <label for="nome">Categoria</label>
                            <select class="form-control" name="codcategoria" id="codcategoriaProduto" required>
                                <?php
                                    $rescategoria = $conexao->comando('select codcategoria, nome from categoriaproduto as categoria order by nome');
                                    $qtdcategoria = $conexao->qtdResultado($rescategoria);
                                    if($qtdcategoria > 0){
                                        echo '<option value="">--Selecione--</option>';
                                        while($categoria = $conexao->resultadoArray($rescategoria)){
                                            if(isset($produtop["codcategoria"]) && $produtop["codcategoria"] != NULL && $produtop["codcategoria"] == $categoria["codcategoria"]){
                                                echo '<option selected value="',$categoria["codcategoria"],'">',  ($categoria["nome"]),'</option>';
                                            }else{
                                                echo '<option value="',$categoria["codcategoria"],'">',  ($categoria["nome"]),'</option>';
                                            }
                                        }
                                    }else{
                                        echo '<option value="">--Nada encontrado--</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <?php if(isset($_GET["codproduto"])){?>
                    <div class="col-md-2">                         
                        <div class="form-group">
                            <label for="nome">Status</label>
                            <select class="form-control" name="codstatus" id="codstatusProduto" required>
                                <?php
                                    $resstatus = $conexao->comando('select codstatus, nome from statusproduto as status order by nome');
                                    $qtdstatus = $conexao->qtdResultado($resstatus);
                                    if($qtdstatus > 0){
                                        echo '<option value="">--Selecione--</option>';
                                        while($status = $conexao->resultadoArray($resstatus)){
                                            if(isset($produtop["codstatus"]) && $produtop["codstatus"] != NULL && $produtop["codstatus"] == $status["codstatus"]){
                                                echo '<option selected value="',$status["codstatus"],'">',  ($status["nome"]),'</option>';
                                            }else{
                                                echo '<option value="',$status["codstatus"],'">',  ($status["nome"]),'</option>';
                                            }
                                        }
                                    }else{
                                        echo '<option value="">--Nada encontrado--</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <?php }?>
                    <?php 
                        $resatributo = $conexao->comando('select codatributo, nome, tipo, tamanho, lista, mascara, min, max from atributo order by ordem');
                        $qtdatributo = $conexao->qtdResultado($resatributo);
                        if($qtdatributo > 0){
                            while($atributo = $conexao->resultadoArray($resatributo)){
                                $display_div = "";
                                if(isset($produtop["codproduto"]) && $produtop["codproduto"] != NULL && $produtop["codproduto"] != ""){
                                    $atributocp = $conexao->comandoArray('select codatributo, obrigatorio 
                                    from atributocategoria 
                                    where codcategoria = '.$produtop["codcategoria"].' 
                                    and codatributo = '.$atributo["codatributo"].' 
                                    order by codatributo');
                                    if(isset($atributocp["codatributo"]) && $atributocp["codatributo"] != NULL && $atributocp["codatributo"] != ""){
                                        if($atributocp["obrigatorio"] == "s"){
                                            $required_campo = "required";
                                        }else{
                                            $required_campo = "";
                                        }
                                        $display_div    = '';
                                    }else{
                                        $required_campo = 'required';
                                        $display_div    = 'display: none;';
                                    }
                                    
                                    $valorp = $conexao->comandoArray('select codvalor, valor 
                                    from valorproduto 
                                    where codproduto = '. $produtop["codproduto"]. ' 
                                    and codatributo = '. $atributo["codatributo"]);
                                }else{
                                    $required_campo = '';
                                    $display_div    = 'display: none;';
                                }
                                if($atributo["tipo"] == "text"){
                                    $colunasDiv = 12;
                                }else{
                                    $colunasDiv = 2;
                                }
                                echo '<div style="',$display_div,'" id="div_campo_produto',$atributo["codatributo"],'" class="col-md-',$colunasDiv,' campo_produto">';
                                echo '<div class="form-group">';
                                echo '<label for="campo_produto',$atributo["codatributo"],'">',$atributo["nome"],'</label>';
                                if($atributo["tipo"] == "varchar"){
                                    echo '<input ',$required_campo,' type="text" class="form-control ',$atributo["mascara"],'" maxlength="',$atributo["tamanho"],'" name="campo_produto',$atributo["codatributo"],'" id="campo_produto',$atributo["codatributo"],'" placeholder="Digite ',$atributo["nome"],'" value="',$valorp["valor"],'"/>';
                                }elseif($atributo["tipo"] == "int"){
                                    echo '<input ',$required_campo,' type="number" min="',$atributo["min"],'" max="',$atributo["max"],'" class="form-control ',$atributo["mascara"],'" maxlength="',$atributo["tamanho"],'" name="campo_produto',$atributo["codatributo"],'" id="campo_produto',$atributo["codatributo"],'" placeholder="Digite ',$atributo["nome"],'" value="',$valorp["valor"],'"/>';
                                }elseif($atributo["tipo"] == "text"){
                                    echo '<textarea ',$required_campo,' class="form-control ',$atributo["mascara"],'" name="campo_produto',$atributo["codatributo"],'" id="campo_produto',$atributo["codatributo"],'">',$valorp["valor"],'</textarea>';
                                }elseif($atributo["tipo"] == "date"){
                                    echo '<input ',$required_campo,' type="text" min="'.  trocaMinMax($atributo["min"]).'" max="'.  trocaMinMax($atributo["max"]).'" class="form-control ',$atributo["mascara"],'" maxlength="',$atributo["tamanho"],'" name="campo_produto',$atributo["codatributo"],'" id="campo_produto',$atributo["codatributo"],'" value="',date("d/m/Y", strtotime($valorp["valor"])),'"/>';
                                }elseif($atributo["tipo"] == "file"){
                                    if(isset($valorp["valor"]) && $valorp["valor"] != NULL && $valorp["valor"] != ""){
                                        $disabledFile   = " disabled ";
                                        $required_campo = '';
                                    }else{
                                        $disabledFile = " ";
                                    }
                                    echo '<input ',$disabledFile,$required_campo,' type="file" class="form-control" name="campo_produto',$atributo["codatributo"],'" id="campo_produto',$atributo["codatributo"],'" value="',$valorp["valor"],'"/>';
                                    if(isset($valorp["valor"]) && $valorp["valor"] != NULL && $valorp["valor"] != ""){
                                        echo '<a title="Clique para visualizar arquivo" target="_blank" href="../arquivos/',$valorp["valor"],'">';
                                        echo '<img style="width: 25px;" alt="botão lupa" src="./recursos/img/lupa.png"/>';
                                        echo '</a> ';
                                        if($nivelp["excluir"] == 1){
                                            echo '<a title="Clique para excluir arquivo" href="javascript: excluirArquivo(',$valorp["codvalor"],')">';
                                            echo '<img alt="botão excluir" src="./recursos/img/excluir.png"/>';
                                            echo '</a>';
                                        }
                                    } 
                                }elseif($atributo["tipo"] == "select"){
                                    echo '<select ',$required_campo,' class="form-control" name="campo_produto',$atributo["codatributo"],'" id="campo_produto',$atributo["codatributo"],'">';
                                    echo '<option value="">--Selecione--</option>';
                                    $opcoesLista = explode(',', $atributo["lista"]);
                                    foreach ($opcoesLista as $key => $opcao) {
                                        $opcao = trim($opcao);
                                        if(isset($valorp["valor"]) && $valorp["valor"] != NULL && $valorp["valor"] == $opcao){
                                            echo '<option selected>',$opcao,'</option>';
                                        }else{
                                            echo '<option>',$opcao,'</option>';
                                        }
                                    }
                                    echo '</select>';
                                }
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                    ?>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php if ($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1) { ?>
                                <input type="submit" name="btSalvar" class="btn btn-primary" value="Salvar"/>
                                <?php
                            }
                            if (isset($nivelp["excluir"]) && $nivelp["excluir"] != NULL && $nivelp["excluir"] == 1) {
                                ?>
                                <button class="btn btn-primary" id="btexcluirProduto" onclick="excluirProduto()">Excluir</button>  
                            <?php } ?>
                        </div>                                        
                    </div>                    
                </form>
            </div>

        </div>
    </div>
    <!--/.col (right) -->
</div>

<?php

function trocaMinMax($valor){
    $valorMinMax  = '';
    $separa_valor = explode('+', $valor);
    if(trim($separa_valor[0]) == "hoje"){
        $quantidade  = str_replace('d', '', $separa_valor[1]);
        $valorMinMax = date('Y-m-d', strtotime('+'.$quantidade.' days'));
    }
    return $valorMinMax;
}