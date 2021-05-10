<div class="form-group ml-1">
    <a class=" " href="<?=HTTP_PATH?>percentual_imposto/index/<?=$Tipo_produto->getId_tipo_produto()?>">Voltar</a>
</div>
<?php require(ROOT_PATH.'app/view/layout/msg.lib.php');?>
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
            <?php if($Percentual_imposto->getId_percentual_imposto()){ ?>
                    <form id="formPercentual_imposto" method="POST" action="<?= HTTP_PATH ?>percentual_imposto/update/<?=$Percentual_imposto->getId_tipo_produto()?>/<?=$Percentual_imposto->getId_percentual_imposto()?>">
            <?php }else{ ?>
                    <form id="formPercentual_imposto" method="POST" action="<?= HTTP_PATH ?>percentual_imposto/insert/<?=$Percentual_imposto->getId_tipo_produto()?>">
            <?php } ?>

            <input type="hidden" name="id_percentual_imposto" value="<?=$Percentual_imposto->getId_percentual_imposto()?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Percentual de Imposto</label>
                            <input  onkeypress="mascara(this, mValorPercentual,2)"  maxlength="18" type="text" class="form-control" required name="nr_valor_imposto" id="nr_valor_imposto" title="Percentual Imposto" value="<?=$Percentual_imposto->getNr_valor_imposto()?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" onclick="ctrlPercentual_imposto.limpar('formPercentual_imposto')" class="btn btn-primary">Limpar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">        
        </div>
    </div>
</div>