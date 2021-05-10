<table class="table table-bordered">
    <thead>
        <tr>            
            <th style="width: 100px">Código</th>
            <th>Tipo de Produto</th>
            <th>Produto</th>
            <th>Valor</th>
            <th style="width: 40px">Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($arrProduto as $obj){ ?>
        <tr>
            <td><?=$obj->getCd_produto()?></td>
            <td><?=$obj->getTipo_produto()->getNm_tipo_produto()?></td>
            <td><?=$obj->getNm_produto()?></td>
            <td><?=$obj->getNr_valor()?></td>
            <td  nowrap>
                <a class="btn_acao" href="<?=HTTP_PATH.'produto/edit/'.$obj->getId_produto() ?>" title="Editar"><i class="fa fa-edit"></i></a>
                <a class="btn_acao" href="<?=HTTP_PATH.'produto/delete/'.$obj->getId_produto() ?>" title="Excluir"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
        
    </tbody>
</table>