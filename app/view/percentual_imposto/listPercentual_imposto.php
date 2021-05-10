<table class="table table-bordered">
    <thead>
        <tr>            
            <th>Tipo de Produto</th>
            <th>Porcentagem Imposto</th>
            <th>Situação</th>
            <th style="width: 40px">Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($arrPercentual_imposto as $obj){ ?>
        <tr>
            <td><?=$obj->getTipo_produto()->getNm_tipo_produto()?></td>
            <td><?=$obj->getNr_valor_imposto()?></td>
            <td><?=$obj->getSituacao()?></td>
            <td nowrap>                
                <a class="btn_acao" href="<?=HTTP_PATH.'percentual_imposto/edit/'.$obj->getId_tipo_produto().'/'.$obj->getId_percentual_imposto() ?>" title="Editar"><i class="fa fa-edit"></i></a>
                <a class="btn_acao" href="<?=HTTP_PATH.'percentual_imposto/delete/'.$obj->getId_tipo_produto().'/'.$obj->getId_percentual_imposto() ?>" title="Excluir"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
        
    </tbody>
</table>