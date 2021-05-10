<div class="form-group ml-1">
    <a class=" " href="<?= HTTP_PATH ?>produto/">Voltar</a>
</div>
<?php require(ROOT_PATH . 'app/view/layout/msg.lib.php'); ?>
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Produtos</h3>
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
            <?php $acao = ($Produto->getId_produto()) ? 'update' : 'insert' ?>
            <form id="formProduto" method="POST" action="<?= HTTP_PATH ?>produto/<?= $acao ?>">
                <input type="hidden" name="id_produto" value="<?= $Produto->getId_produto() ?>">
                <input type="hidden" name="fl_ativo" value="<?= $Produto->getFl_ativo() ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo Produto</label>
                            <select class="form-control" required name="id_tipo_produto" id="id_tipo_produto" title="Tipo do Produto">
                                <option value="">--todos</option>
                                <?php foreach ($arrTipo_produto as $obj) { ?>
                                    <option <?= $obj->getId_tipo_produto() == $Produto->getId_tipo_produto() ? ' selected ' : '' ?> value="<?= $obj->getId_tipo_produto() ?>"><?= $obj->getNm_tipo_produto() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Código Produto</label>
                            <input class="form-control"  maxlength="6" required name="cd_produto" id="cd_produto" title="Código do Produto" value="<?=$Produto->getCd_produto()?>">                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome Produto</label>
                            <input class="form-control" maxlength="150" required name="nm_produto" id="nm_produto" title="Nome do Produto" value="<?=$Produto->getNm_produto()?>">                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Valor</label>
                            <input class="form-control"  onkeypress="mascara(this, mValor)"   maxlength="16" required name="nr_valor" id="nr_valor" title="Valor do Produto" value="<?=$Produto->getNr_valor()?>">                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea class="form-control" name="ds_produto" id="ds_produto"><?=$Produto->getDs_produto()?></textarea>                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" onclick="ctrlProduto.limpar('formProduto')" class="btn btn-primary">Limpar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>