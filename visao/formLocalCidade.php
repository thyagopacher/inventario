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
                <form id="flocalCidade" name="flocalCidade" method="post" onsubmit="return false;">
                    <input type="hidden" name="codlc" id="codlc" value=""/>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Cidade</label>
                            <select class="form-control" name="codcidade" id="codcidade">
                                <?php
                                $rescidade = $conexao->comando('select codcidade, nome from cidade order by nome');
                                $qtdcidade = $conexao->qtdResultado($rescidade);
                                if ($qtdcidade > 0) {
                                    $comboCidade .= '<option value="">--Selecione--</option>';
                                    while ($cidade = $conexao->resultadoArray($rescidade)) {
                                        $comboCidade .= '<option value="'. $cidade["codcidade"]. '">'. ($cidade["nome"]). '</option>';
                                    }
                                } else {
                                    $comboCidade .= '<option value="">--Nada encontrado--</option>';
                                }
                                echo $comboCidade;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="codlocal">Local</label>
                            <select class="form-control" name="codlocal" id="codlocal">
                                <?php
                                $reslocal = $conexao->comando('select codlocal, nome from local order by nome');
                                $qtdlocal = $conexao->qtdResultado($reslocal);
                                if ($qtdlocal > 0) {
                                    $comboLocal .= '<option value="">--Selecione--</option>';
                                    while ($local = $conexao->resultadoArray($reslocal)) {
                                        $comboLocal .= '<option value="'. $local["codlocal"]. '">'. ($local["nome"]). '</option>';
                                    }
                                } else {
                                    $comboLocal .= '<option value="">--Nada encontrado--</option>';
                                }
                                echo $comboLocal;
                                ?>
                            </select>
                        </div>
                    </div>
                            
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php 
                            if ($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1) {
                                echo '<input type="button" class="btn btn-primary" value="Salvar" onclick="salvarLocalCidade()"/> ';
                            }
                            if($nivelp["excluir"] == 1){
                                echo '<button style="display: none" class="btn btn-primary" id="btexcluirLocalCidade"   onclick="excluirLocalCidade()">Excluir</button>  ';
                            }
                            echo '<button class="btn btn-primary" id="btNovoLocalCidade"   onclick="novoLocalCidade()">Novo</button>  ';                            
                            ?>
                        </div>                                        
                    </div>                    
                </form>
            </div>
            <div class="row">
                <div id="listagemLocalCidade" class="col-md-12"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>