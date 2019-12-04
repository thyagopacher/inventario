<?php
    $cores = array('azul', 'verde', 'vermelho', 'marron', 'laranja');
    $sql = "select np.excluir, np.atualizar, np.inserir
    from nivelpagina as np
    where np.codnivel = {$_SESSION["codnivel"]} 
    and   np.codpagina = 100";
    $nivelpAba2 = $conexao->comandoArray($sql);
?>
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
                <form id="fstatus" name="fstatus" method="post" action='../control/SalvarStatusProduto.php'>
                    <input type="hidden" name="codstatus" id="codstatusStatus" value=""/>
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nomeStatusProduto" placeholder="Digite nome" value="">
                        </div>
                    </div>
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Cor</label>
                            <input type="color" class="form-control" name="cor" id="corStatusProduto" value=""/>
                        </div>
                    </div>
                                      
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php 
                            if($nivelpAba2["inserir"] == 1 || $nivelpAba2["atualizar"] == 1){
                                echo '<input type="submit" class="btn btn-primary" value="Salvar"/> ';
                            }
                            if($nivelpAba2["excluir"] == 1){
                                echo '<button style="display: none" class="btn btn-primary" id="btexcluirStatusProduto"   onclick="excluirStatusProduto()">Excluir</button>  ';
                            }
                            echo '<button class="btn btn-primary" id="btNovoStatusProduto"   onclick="novoStatusProduto()">Novo</button>  ';                            
                            ?>
                        </div>                                        
                    </div>                    
                </form>
            </div>
            <div class="row">
                <div id="listagemStatusProduto" class="col-md-12"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>