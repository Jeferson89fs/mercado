<table class="table table-bordered">
    <thead>
        <tr>            
            <th style="width: 100px">Id</th>
            <th>Tipo de Produto</th>
            <th style="width: 40px">Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($arrTipo_produto as $obj){ ?>
        <tr>
            <td><?=$obj->getId_tipo_produto()?></td>
            <td><?=$obj->getNm_tipo_produto()?></td>
            <td nowrap>
                <a class="btn_acao" href="<?=HTTP_PATH.'percentual_imposto/index/'.$obj->getId_tipo_produto() ?>" title="Percentual de Imposto do Tipo de Produto"><i class="fa fa-percent"></i></a>
                <a class="btn_acao" href="<?=HTTP_PATH.'tipo_produto/edit/'.$obj->getId_tipo_produto() ?>" title="Editar"><i class="fa fa-edit"></i></a>
                <a class="btn_acao" href="<?=HTTP_PATH.'tipo_produto/delete/'.$obj->getId_tipo_produto() ?>" title="Excluir"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
        
    </tbody>
</table>