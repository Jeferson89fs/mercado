<div class="form-group ml-1">
    <a   href="<?= HTTP_PATH ?>">Voltar</a> &nbsp;
    <a class=" " href="<?=HTTP_PATH?>venda/novo">Nova Venda</a>
</div>
<?php
 $msg_success = $_SESSION['msg_success'];
 unset($_SESSION['msg_success']);
 require(ROOT_PATH.'app/view/layout/msg.lib.php');
 ?>
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Venda</h3>
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
            <form id="pesqVenda" method="POST" action="<?= HTTP_PATH ?>venda">
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Código da Venda</label>
                            <input type="text" class="form-control" name="id_venda" id="id_venda" title="Código da Venda" value="<?=$Venda->getId_venda()?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data da Venda</label>
                            <input type="text" class="form-control" name="dt_cadastro" id="dt_cadastro" title="Data da venda" value="<?=$Venda->getDt_cadastro()?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                            <button type="button" onclick="ctrlVenda.limpar('pesqVenda')" class="btn btn-primary">Limpar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">        
        </div>
    </div>
</div>