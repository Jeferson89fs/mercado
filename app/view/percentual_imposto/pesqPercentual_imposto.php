<div class="form-group ml-1">
    <a class=" " href="<?=HTTP_PATH?>tipo_produto/index">Voltar</a>
    &nbsp;
    <a class=" " href="<?=HTTP_PATH?>percentual_imposto/novo/<?=$Tipo_produto->getId_tipo_produto()?>">Cadastrar</a>    
</div>
<?php
 $msg_success = $_SESSION['msg_success'];
 unset($_SESSION['msg_success']);
 require(ROOT_PATH.'app/view/layout/msg.lib.php');
 ?>
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Percentual de  Imposto do Tipo de Produto ( <?=$Tipo_produto->getNm_tipo_produto()?>) </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">      
            <form id="pesqPercentual_imposto" method="POST" action="<?= HTTP_PATH ?>percentual_imposto/index/<?=$Tipo_produto->getId_tipo_produto()?>">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pencentual de Imposto</label>
                            <input onkeypress="mascara(this, mValorPercentual,2)" maxlength="18" type="text" class="form-control" name="nr_valor_imposto" id="nr_valor_imposto" title="Valor do Imposto" value="<?=$Percentual_imposto->getNr_valor_imposto()?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                            <button type="button" onclick="ctrlPercentual_imposto.limpar('pesqPercentual_imposto')" class="btn btn-primary">Limpar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">        
        </div>
    </div>
</div>