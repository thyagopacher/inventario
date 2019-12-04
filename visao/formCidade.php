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
                <form id="fcidade" name="fcidade" method="post" onsubmit="return false;">
                    <input type="hidden" name="codcidade" id="codcidade" value=""/>
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nome" placeholder="Digite nome" value="">
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="nome">Estado</label>
                            <select class="form-control" name="codestado" id="codestado">
                                <?php
                                $resestado = $conexao->comando('select codestado, nome from estado order by nome');
                                $qtdestado = $conexao->qtdResultado($resestado);
                                if ($qtdestado > 0) {
                                    $comboEstado .= '<option value="">--Selecione--</option>';
                                    while ($estado = $conexao->resultadoArray($resestado)) {
                                        $comboEstado .= '<option value="'. $estado["codestado"]. '">'. ($estado["nome"]). '</option>';
                                    }
                                } else {
                                    $comboEstado .= '<option value="">--Nada encontrado--</option>';
                                }
                                echo $comboEstado;
                                ?>
                            </select>
                        </div>
                    </div>
                      
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php 
                            echo '<input type="button" class="btn btn-primary" value="Salvar" onclick="salvarCidade()"/> ';
                            echo '<button style="display: none" class="btn btn-primary" id="btexcluirCidade"   onclick="excluirCidade()">Excluir</button>  ';
                            echo '<button class="btn btn-primary" id="btNovoCidade"   onclick="novoCidade()">Novo</button>  ';                            
                            ?>
                        </div>                                        
                    </div>                    
                </form>
            </div>
            <div class="row">
                <div id="listagemCidade" class="col-md-12"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>