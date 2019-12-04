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
                <form id="fdepartamento" name="fdepartamento" method="post" onsubmit="return false;">
                    <input type="hidden" name="coddepartamento" id="coddepartamento" value=""/>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nome" placeholder="Digite nome" value="">
                        </div>
                    </div>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Diretoria</label>
                            <select class="form-control" name="coddiretoria" id="coddiretoriaDepartamento">
                                <?php
                                $resdiretoria = $conexao->comando('select coddiretoria, nome from diretoria order by nome');
                                $qtddiretoria = $conexao->qtdResultado($resdiretoria);
                                if ($qtddiretoria > 0) {
                                    $comboDiretoria .= '<option value="">--Selecione--</option>';
                                    while ($diretoria = $conexao->resultadoArray($resdiretoria)) {
                                        $comboDiretoria .= '<option value="' . $diretoria["coddiretoria"] . '">' . ($diretoria["nome"]) . '</option>';
                                    }
                                } else {
                                    $comboDiretoria .= '<option value="">--Nada encontrado--</option>';
                                }
                                echo $comboDiretoria;
                                ?>
                            </select>                            
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                            if($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1){
                                echo '<input type="button" class="btn btn-primary" value="Salvar" onclick="salvarDepartamento()"/> ';
                            }
                            if($nivelp["excluir"] == 1){
                                echo '<button style="display: none" class="btn btn-primary" id="btexcluirDepartamento"   onclick="excluirDepartamento()">Excluir</button>  ';
                            }
                            echo '<button class="btn btn-primary" id="btNovoDepartamento"   onclick="novoDepartamento()">Novo</button>  ';
                            ?>
                        </div>                                        
                    </div>                    
                </form>
            </div>
            <div class="row">
                <div id="listagemDepartamento" class="col-md-12"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>