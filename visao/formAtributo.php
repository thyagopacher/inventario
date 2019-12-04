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
                <form id="fatributo" name="fatributo" method="post" onsubmit="return false;">
                    <input type="hidden" name="codatributo" id="codatributo" value=""/>
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nome" placeholder="Digite nome" value="">
                        </div>
                    </div>
                    <div class="col-md-2">                        
                        <div class="form-group">
                            <label for="nome">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">--Selecione--</option>
                                <option value="varchar">Varchar</option>
                                <option value="text">Texto livre</option>
                                <option value="int">Inteiro</option>
                                <option value="date">Date</option>
                                <option value="select">Combo</option>
                                <option value="file">Upload Arq.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">                        
                        <div class="form-group">
                            <label for="nome">Tamanho</label>
                            <input type='number' min="1" max="99999" class="form-control" name="tamanho" id="tamanho" placeholder="Digite tamanho" value="">
                        </div>
                    </div>                    
                    <div class="col-md-2">                        
                        <div class="form-group">
                            <label for="nome">Ordem</label>
                            <input type='number' min="0" max="999" class="form-control" name="ordem" id="ordem" placeholder="Digite ordem" value="">
                        </div>
                    </div>                    
                    <div style="display: none" class="col-md-2 div_min_max">                        
                        <div id="div_min_valor" class="form-group">
                            <label for="min">Min</label>
                            <input type='text' class="form-control" name="min" id="min" placeholder="Digite minimo do valor" value="">
                        </div>
                    </div>                    
                    <div style="display: none" class="col-md-2 div_min_max">                        
                        <div id="div_max_valor" class="form-group">
                            <label for="max">Max</label>
                            <input type='text' class="form-control" name="max" id="max" placeholder="Digite máximo do valor" value="">
                        </div>
                    </div>                    
                    <div id="div_mascara" style="display: none" class="col-md-2">                        
                        <div class="form-group">
                            <label for="nome">Máscara</label>
                            <select class="form-control" name="mascara" id="mascara">
                                <option value="">--Selecione--</option>
                                <option value="cep">CEP</option>
                                <option value="porcentagem">Porcentagem</option>
                                <option value="inteiro">Inteiro</option>
                                <option value="enderecoip">Endereço IP</option>
                                <option value="cpf">CPF</option>
                                <option value="placa">Placa</option>
                                <option value="telefone">Telefone</option>
                                <option value="data">Data</option>
                                <option value="texto" title="para colocar um editor personalizado no texto">Texto</option>
                            </select>
                        </div>
                    </div>                    
                    <div id="div_listagem_select" style="display: none" class="col-md-6">                        
                        <div class="form-group">
                            <label for="nome">Lista</label>
                            <textarea class="form-control" name="lista" id="lista" placeholder="Digite lista separado por virgula ou ponto e virgula"></textarea>
                        </div>
                    </div>                    
                                       
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php 
                            if($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1){
                                echo '<input type="button" class="btn btn-primary" value="Salvar" onclick="salvarAtributo()"/> ';
                            }
                            if($nivelp["excluir"] == 1){
                                echo '<button style="display: none" class="btn btn-primary" id="btexcluirAtributo"   onclick="excluirAtributo()">Excluir</button>  ';
                            }
                            echo '<button class="btn btn-primary" id="btNovoAtributo"   onclick="novoAtributo()">Novo</button>  ';                            
                            ?>
                        </div>                                        
                    </div>                    
                </form>
            </div>
            <div class="row">
                <div id="listagemAtributo" class="col-md-12"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>