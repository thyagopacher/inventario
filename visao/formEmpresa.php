<div class="row">

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">

        </div><!-- /.box-header -->
        <!-- form start -->
        <form id="fempresa" action="../control/SalvarEmpresa.php" method="post">
            <input type="hidden" name="codempresa" id="codempresa" value="<?= $empresaf["codempresa"] ?>"/>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Razão</label>
                        <input type='text' class="form-control" name="razao" id="razao" placeholder="Digite razão social"  value='<?php if (isset($empresaf["razao"])) {echo ($empresaf["razao"]);} ?>'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="localnascimento">CEP</label>
                        <input type='text' class="form-control" name="cep" id="cep" maxlength="8" placeholder="Digite cep ele busca endereço" value='<?php if (isset($empresaf["cep"])) {
                                echo $empresaf["cep"];
                            } ?>'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="localnascimento">Tip. Logradouro</label>
                        <input type='text' class="form-control" name="tipologradouro" id="tipologradouro" maxlength="8" placeholder="Digite tipo logradouro" value='<?php if (isset($empresaf["tipologradouro"])) {
                                echo $empresaf["tipologradouro"];
                            } ?>'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="localnascimento">Logradouro</label>
                        <input type='text' class="form-control" name="logradouro" id="logradouro" placeholder="Digite logradouro" value='<?php if (isset($empresaf["logradouro"])) {
                                echo $empresaf["logradouro"];
                            } ?>'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type='text' class="form-control" name="numero" id="numero" placeholder="Digite numero" value='<?php if (isset($empresaf["numero"])) {
                                echo $empresaf["numero"];
                            } ?>'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type='text' class="form-control" name="bairro" id="bairro" placeholder="Digite bairro" value='<?php if (isset($empresaf["bairro"])) {
                                echo $empresaf["bairro"];
                            } ?>'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type='text' class="form-control" name="cidade" id="cidade" placeholder="Digite cidade" value='<?php if (isset($empresaf["cidade"])) {
                                echo $empresaf["cidade"];
                            } ?>'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type='text' class="form-control" name="estado" id="estado" placeholder="Digite estado" value='<?php if (isset($empresaf["estado"])) {
                                echo $empresaf["estado"];
                            } ?>'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estadocivil">Telefone</label>
                        <input type='text' class="form-control telefone" name="telefone" id="telefone" placeholder="Digite telefone fixo" value='<?php if (isset($empresaf["telefone"])) {echo $empresaf["telefone"];} ?>'>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name='email' id="email" placeholder="Digite e-mail" value='<?php if (isset($empresaf["email"])) {echo $empresaf["email"];} ?>'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputFile">Logo</label>
                        <input type="file" id="logo" name="logo">
                        
                        <?php
                            if(isset($empresaf["logo"]) && $empresaf["logo"] != NULL && $empresaf["logo"] != ""){
                                echo '<a target="_blank" href="../arquivos/',$empresaf["logo"],'">Link logo</a>';
                            }else{
                                echo '<p class="help-block">Escolha uma imagem aqui para a Logo</p>';
                            }
                        ?>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <?php
                    if ($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1) {
                        echo '<button type="submit"  class="btn btn-primary">Salvar</button> ';
                    }
                ?>
                
            </div>
        </form>
    </div><!-- /.box -->
    <!--/.col (right) -->
</div>   <!-- /.row -->