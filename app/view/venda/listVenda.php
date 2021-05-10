<table class="table table-bordered">
    <thead>
        <tr>            
            <th style="width: 200px">Código da venda</th>
            <th style="width: 200px">Data da venda</th>
            <th class="text-right" style="width: 200px">Total de Itens</th>
            <th class="text-right">Valor Total</th>
            <th style="width: 40px">Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($arrVenda  as $obj){ ?>
        <tr>
            <td ><?=str_pad($obj->getId_venda(), 5,'0', STR_PAD_LEFT)?></td>            
            <td ><?=$obj->getDt_cadastro_br()?></td>            
            <td class="text-right" nowrap ><?=$obj->getTotal_itens()?></td>            
            <td class="text-right" nowrap ><?=$obj->getNr_valor_venda()?></td>        
            <td> <a class="btn_acao" href="<?=HTTP_PATH?>venda_item/index/<?=$obj->getId_venda()?>"><i class="fa fa-info"></i></a>
            </td>    
        </tr>
    <?php } ?>        
    </tbody>
</table>