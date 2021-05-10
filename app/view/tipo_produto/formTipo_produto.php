<div class="form-group ml-1">
    <a class=" " href="<?=HTTP_PATH?>tipo_produto/">Voltar</a>
</div>
<?php require(ROOT_PATH.'app/view/layout/msg.lib.php');?>
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Tipo de Produto</h3>
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
            <?php $acao=($Tipo_produto->getId_tipo_produto()) ? 'update': 'insert' ?>
            <form id="formTipo_produto" method="POST" action="<?= HTTP_PATH ?>tipo_produto/<?=$acao?>">
            <input type="hidden" name="id_tipo_produto" value="<?=$Tipo_produto->getId_tipo_produto()?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo</label>
                            <input maxlength="100" type="text" class="form-control" required name="nm_tipo_produto" id="nm_tipo_produto" title="Nome do Produto" value="<?=$Tipo_produto->getNm_tipo_produto()?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" onclick="ctrlTipo_produto.limpar('formTipo_produto')" class="btn btn-primary">Limpar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">        
        </div>
    </div>
</div>