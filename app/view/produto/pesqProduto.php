<div class="form-group ml-1">
    <a class=" " href="<?= HTTP_PATH ?>produto/index">Voltar</a> &nbsp;
    <a class=" " href="<?= HTTP_PATH ?>produto/novo">Cadastrar</a>
</div>
<?php
$msg_success = $_SESSION['msg_success'];
unset($_SESSION['msg_success']);
require(ROOT_PATH . 'app/view/layout/msg.lib.php');
?>
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
            <form id="pesqProduto" method="POST" action="<?= HTTP_PATH ?>produto">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo Produto</label>
                            <select class="form-control"  name="id_tipo_produto" id="id_tipo_produto" title="Tipo do Produto">
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
                            <input class="form-control" maxlength="6"  name="cd_produto" id="cd_produto" title="Código do Produto" value="<?= $Produto->getCd_produto() ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome Produto</label>
                            <input class="form-control" maxlength="150" name="nm_produto" id="nm_produto" title="Nome do Produto" value="<?= $Produto->getNm_produto() ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                            <button type="button" onclick="ctrlProduto.limpar('pesqProduto')" class="btn btn-primary">Limpar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>