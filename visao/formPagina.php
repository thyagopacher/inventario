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
                <form action="<?= $action ?>" id="fpagina" name="fpagina" method="post">
                    <input type="hidden" name="codnivel" id="codnivel" value="<?=$_GET["codnivel"]?>"/>
                    <input type="hidden" name="codpagina" id="codpaginaPagina" value=""/>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sexo">Módulo</label>
                            <select class='form-control' name="codmodulo" id="codmodulo" required title="Selecione aqui o módulo ao qual pertence a funcionalidade">
                                <?php
                                $res = $conexao->comando("select * from modulo order by nome");
                                $qtd = $conexao->qtdResultado($res);
                                if($qtd > 0){
                                    echo '<option value="">--Selecione--</option>';
                                    while($pagina = $conexao->resultadoArray($res)){
                                        echo '<option value="',$pagina["codmodulo"],'">',($pagina["nome"]),'</option>';
                                    }
                                }else{
                                    echo '<option value="">Nada encontrado</option>';
                                }
                                ?>
                            </select>                        
                        </div>                        
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nomePagina" placeholder="Digite nome" value="<?php if(isset($pagina["nome"]) && $pagina["nome"] != NULL && $pagina["nome"] != ""){echo $pagina["nome"];}?>">
                        </div>
                                        

                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Titulo</label>
                            <input type='text' class="form-control" name="titulo" id="titulo" placeholder="Digite titulo" value="<?php if(isset($pagina["titulo"]) && $pagina["titulo"] != NULL && $pagina["titulo"] != ""){echo ($pagina["titulo"]);}?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Link</label>
                            <input type='url' class="form-control" name="link" id="link" placeholder="Digite link" value="<?php if(isset($pagina["link"]) && $pagina["link"] != NULL && $pagina["link"] != ""){echo $pagina["link"];}?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="icone">Icone</label>
                            <input type='text' class="form-control" name="icone" id="icone" placeholder="Digite icone" value="<?php if(isset($pagina["icone"]) && $pagina["icone"] != NULL && $pagina["icone"] != ""){echo $pagina["icone"];}?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="nome">Abre ao lado</label>
                            <select class='form-control' name="abreaolado" id="abreaolado" required title="Selecione aqui se abre em janela ao lado">
                                <option value="n" <?php if(isset($pagina["abreaolado"]) && $pagina["abreaolado"] != NULL && $pagina["abreaolado"] == "n"){echo "selected";}?>>Não</option>
                                <option value="s" <?php if(isset($pagina["abreaolado"]) && $pagina["abreaolado"] != NULL && $pagina["abreaolado"] == "s"){echo "selected";}?>>Sim</option>
                            </select>                             
                        </div>
                    </div>
                    <div class="col-md-2">                         
                        <div class="form-group">
                            <label for="nome">Pai</label>
                            <select class="form-control" name="codpai" id="codpai">
                                <?php
                                    $respagina = $conexao->comando('select codpagina, nome from pagina order by nome');
                                    $qtdpagina = $conexao->qtdResultado($respagina);
                                    if($qtdpagina > 0){
                                        echo '<option value="">--Selecione--</option>';
                                        while($pagina = $conexao->resultadoArray($respagina)){
                                            echo '<option value="',$pagina["codpagina"],'">',$pagina["nome"],'</option>';
                                        }
                                    }else{
                                        echo '<option value="">--Nada encontrado--</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>                    
                </form>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                        if ($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1) {
                            echo '<button class="btn btn-primary" onclick="salvarPagina()">Cadastrar</button> ';
                        }
                        if($nivelp["excluir"] == 1){
                            echo '<button class="btn btn-primary" '.$display.' id="btexcluirPagina" onclick="excluirPagina()">Excluir</button> ';
                        }
                        ?> 
                    </div>                                        
                </div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>