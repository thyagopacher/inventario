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
                <form id="fatributocategoria" name="fatributocategoria" method="post" onsubmit="return false;">
                    <input type="hidden" name="codac" id="codacCategoria" value=""/>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Categoria</label>
                            <select class="form-control" name="codcategoria" id="codAtributoCategoria">
                                <?php
                                $rescategoria = $conexao->comando('select codcategoria, nome from categoriaproduto order by nome');
                                $qtdcategoria = $conexao->qtdResultado($rescategoria);
                                if ($qtdcategoria > 0) {
                                    $comboCategoria .= '<option value="">--Selecione--</option>';
                                    while ($categoria = $conexao->resultadoArray($rescategoria)) {
                                        $comboCategoria .= '<option value="'. $categoria["codcategoria"]. '">'. ($categoria["nome"]). '</option>';
                                    }
                                } else {
                                    $comboCategoria .= '<option value="">--Nada encontrado--</option>';
                                }
                                echo $comboCategoria;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Atributo</label>
                            <select class="form-control" name="codatributo" id="codatributoAtrCat">
                                <?php
                                $resatributo = $conexao->comando('select codatributo, nome from atributo order by nome');
                                $qtdatributo = $conexao->qtdResultado($resatributo);
                                if ($qtdatributo > 0) {
                                    $comboAtributo .= '<option value="">--Selecione--</option>';
                                    while ($atributo = $conexao->resultadoArray($resatributo)) {
                                        $comboAtributo .= '<option value="'. $atributo["codatributo"]. '">'. ($atributo["nome"]). '</option>';
                                    }
                                } else {
                                    $comboAtributo .= '<option value="">--Nada encontrado--</option>';
                                }
                                echo $comboAtributo;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Obrigatório</label>
                            <select class="form-control" name="obrigatorio" id="obrigatorio" title="Atributo será obrigatório?">
                                <option value="">--Selecione--</option>
                                <option value="s">Sim</option>
                                <option value="n">Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Adicionar em todos</label>
                            <select class="form-control" name="adicionarcategorias" id="adicionarcategorias" title="Adicionar em todas as categorias">
                                <option value="">--Selecione--</option>
                                <option value="s">Sim</option>
                                <option value="n">Não</option>
                            </select>
                        </div>
                    </div>
                                      
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php 
                            echo '<input type="button" class="btn btn-primary" value="Salvar" onclick="salvarAtributoCategoria()"/> ';
                            echo '<button style="display: none" class="btn btn-primary" id="btexcluirCategoriaProduto"   onclick="excluirCategoriaProduto()">Excluir</button>  ';
                            echo '<button class="btn btn-primary" id="btNovoCategoriaProduto"   onclick="novoCategoriaProduto()">Novo</button>  ';                            
                            ?>
                        </div>                                        
                    </div>                    
                </form>
            </div>
            <div class="row">
                <div id="listagemAtributoCategoria" class="col-md-12"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>