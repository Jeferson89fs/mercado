<div class="row">
    <div class="col-md-12 mb-2" >
        <a   href="<?= HTTP_PATH ?>venda">Voltar</a>
    </div>
</div>
<br />
<h3>Informações sobre a Venda</h3>
<table class="table table-bordered">
    <tr>
        <th width="20%" class="text-rigth">Código da Venda</th>
        <td class="text-left"><?= str_pad($Venda->getId_venda(), 5, '0', STR_PAD_LEFT) ?></td>
    </tr>
    <tr>
        <th class="text-rigth">Total de Itens</th>
        <td class="text-left" nowrap><?= $Venda->getTotal_itens() ?></td>
    </tr>
    <tr>
        <th class="text-rigth">Valor Total</th>
        <td class="text-left" nowrap><?= $Venda->getNr_valor_venda() ?></td>
    </tr>
    <tr>
        <th class="text-rigth">Data</th>
        <td class="text-left"><?= $Venda->getDt_cadastro_br() ?></td>
    </tr>
</table>
<br />
<h3>Itens da Venda</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 200px">Código do produto</th>
            <th>Nome do Produto</th>
            <th style="width: 200px" class="text-right">Quantidade</th>
            <th style="width: 200px">Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($arrVenda_item  as $obj) { ?>
            <tr>
                <td><?= $obj->getProduto()->getCd_produto() ?></td>
                <td><?= $obj->getProduto()->getNm_produto() ?></td>
                <td class="text-right"><?= $obj->getNr_quantidade() ?></td>
                <td class="text-right"><?= $obj->getNr_valor() ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>