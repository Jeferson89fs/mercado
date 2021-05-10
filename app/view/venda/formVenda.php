<div class="form-group ml-1">
    <a class=" " href="<?= HTTP_PATH ?>venda/">Voltar</a>
</div>
<?php require(ROOT_PATH . 'app/view/layout/msg.lib.php'); ?>
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
            <?php $acao = ($Venda->getId_venda()) ? 'update' : 'insert' ?>
            <form id="formVenda" method="POST" action="<?= HTTP_PATH ?>venda/<?= $acao ?>">
                <input type="hidden" name="id_venda" value="<?= $Venda->getId_venda() ?>">
                <div class="row">

                    <div class="col-12 col-sm-12  col-md-2 col-lg-2 col-xl-2 ">
                        <div class="form-group">
                            <label>Código</label>
                            <input type="hidden" name="id_produto" id="id_produto">
                            <input type="hidden" name="nr_valor_imposto" id="nr_valor_imposto">
                            <input type="hidden" name="nm_tipo_produto" id="nm_tipo_produto">
                            <input type="hidden" name="id_tipo_produto" id="id_tipo_produto">
                            <input type="text" class="form-control" name="cd_produto" id="cd_produto" title="Código do produto" value="">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12  col-md-4 col-lg-4 col-xl-4 ">
                        <div class="row">
                            <div class="col-10 col-sm-10  col-md-10 col-lg-10 col-xl-10 ">
                                <div class="form-group">
                                    <label>Nome do Produto</label>
                                    <input type="text" class="form-control" name="nm_produto" id="nm_produto" title="Nomer do produto" value="">
                                </div>
                            </div>
                            <!--<div class="col-2 col-sm-2  col-md-2 col-lg-2 col-xl-2 " style="margin-top: 32px;">
                                <button type="button" id="btn-modal-produto" class="btn btn-success"><i class="fa fa-search"></i></button>
                            </div> -->
                        </div>

                    </div>
                    <div class="col-12 col-sm-12  col-md-2 col-lg-2 col-xl-2 ">
                        <div class="form-group">
                            <label>Quantidade</label>
                            <input onkeypress="mascara(this, mValor)" maxlength="16" type="text" class="form-control" name="nr_quantidade" id="nr_quantidade" title="Quantidade" value="<?= 1 ?>">
                        </div>
                    </div>

                    <div class="col-12 col-sm-12  col-md-2 col-lg-2 col-xl-2 ">
                        <div class="form-group">
                            <label>Valor Unit.</label>
                            <input readonly onkeypress="mascara(this, mValor)" maxlength="16" type="text" class="form-control" name="nr_valor" id="nr_valor" title="Valor Unitário" value="<?='0,00' ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12  col-md-2 col-lg-2 col-xl-2 ">
                        <div class="form-group " style="margin-top: 32px;">
                            <button title="Adicionar Item a Lista" type="button" id="btn-adicionar-produto" class="btn btn-success"><i class="fa fa-plus"></i></button>
                            <button title="Limpar Lista de Itens" type="button" id="btn-limpar-lista" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer">
        <form id="formVendaItens" method="POST">
            <table class="table table-bordered d-none">
                <thead>
                    <tr>
                        <th style="width: 200px">Código do Produto</th>
                        <th >Nome do Produto</th>
                        <th class="text-right" style="width: 100px">Quantidade</th>
                        <th class="text-right" style="width: 150px">Valor Unitário</th>
                        <th class="text-right" style="width: 150px">Total Impostos</th>
                        <th class="text-right" style="width: 150px">Total</th>
                        <th style="width: 50px"></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="100%" class="text-right">
                        <button class="btn btn-success" type="button" id="btn-finalizar-compra" >Finalizar Compra</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>