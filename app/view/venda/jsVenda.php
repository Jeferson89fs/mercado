<script>
    var ctrlVenda = ({

        limpar: function(form) {
            $('#' + form).find(":input").not(':hidden').val('');

        },

        addProdutoLista: function() {
            let id_produto = document.querySelector('#formVenda #id_produto').value;
            let cd_produto = document.querySelector('#formVenda #cd_produto').value;
            let nm_produto = document.querySelector('#formVenda #nm_produto').value;
            let nr_quantidade = document.querySelector('#formVenda #nr_quantidade').value;
            let nr_valor = document.querySelector('#formVenda #nr_valor').value;
            let nr_valor_imposto = document.querySelector('#formVenda #nr_valor_imposto').value;
            let nm_tipo_produto = document.querySelector('#formVenda #nm_tipo_produto').value;
            let id_tipo_produto = document.querySelector('#formVenda #id_tipo_produto').value;

            let qtd = formataValor(nr_quantidade);
            let valor = formataValor(nr_valor);
            let imposto = formataValor(nr_valor_imposto);
            let valor_impsoto_uni = ((valor * imposto / 100));

            let valor_total = ((parseFloat(valor) + parseFloat(valor_impsoto_uni)) * parseInt(qtd));
            let valor_total_impostos = (valor_impsoto_uni * qtd);

            let itens = [];
            let x = JSON.parse(sessionStorage.getItem('vendas_itens'));

            if (x) {
                itens = x;
            }

            itens.push({
                'id_produto': id_produto,
                'cd_produto': cd_produto,
                'nm_produto': nm_produto,
                'nr_quantidade': nr_quantidade,
                'nr_valor': nr_valor,
                'nr_valor_imposto': nr_valor_imposto,
                'nm_tipo_produto': nm_tipo_produto,
                'id_tipo_produto': id_tipo_produto,
                'valor_total': valor_total,
                'valor_total_impostos': valor_total_impostos
            });

            sessionStorage.removeItem('vendas_itens');
            sessionStorage.setItem('vendas_itens', JSON.stringify(itens));

            ctrlVenda.montaListaItens();
            document.querySelector('#formVenda').reset();

        },

        excluirItem: function(item_excluir) {
            let itens = JSON.parse(sessionStorage.getItem('vendas_itens'));
            let novoArray = [];
            itens.forEach((item, x) => {
                if (item_excluir != x) {
                    novoArray.push(item);
                }
            })
            sessionStorage.removeItem('vendas_itens');
            sessionStorage.setItem('vendas_itens', JSON.stringify(novoArray));
            ctrlVenda.montaListaItens();

        },

        montaListaItens: function() {
            let itens = JSON.parse(sessionStorage.getItem('vendas_itens'));
            var total_valor_total = 0;
            var total_valor_total_impostos = 0;

            var tr = [];
            if (!itens) {
                document.querySelector('#formVendaItens tbody').innerHTML = '';
                document.querySelector('#formVendaItens table').classList.add('d-none');
                return false;
            }

            itens.forEach((item, i) => {

                total_valor_total += (item.valor_total);
                total_valor_total_impostos += (item.valor_total_impostos);

                tr.push(`<tr>
                             <td>${item.cd_produto}</td>
                             <td>${item.nm_produto}</td>
                             <td class="text-right">${item.nr_quantidade}</td>
                             <td class="text-right">${item.nr_valor}</td>                             
                             <td class="text-right">${mostraValor(item.valor_total_impostos)}</td>
                             <td class="text-right" >${mostraValor(item.valor_total)}</td>
                             <td>
                                <input type="hidden" name="id_produto[]" value="${item.id_produto}" />
                                <input type="hidden" name="cd_produto[]" value="${item.cd_produto}" />
                                <input type="hidden" name="nm_produto[]" value="${item.nm_produto}" v>
                                <input type="hidden" name="nr_quantidade[]" value="${item.nr_quantidade}" />
                                <input type="hidden" name="nr_valor[]" value="${item.nr_valor}" />
                                <input type="hidden" name="valor_total_impostos[]" value="${item.valor_total_impostos}" />
                                <input type="hidden" name="valor_total[]" value="${item.valor_total}" />
                                <a href="javascript:void(0)" onclick="ctrlVenda.excluirItem(${i})" title="Excluir Item"><i class="fa fa-trash"></i></a>
                             </td>
                       </tr>`);
            });

            tr.push(`<tr>
                             <td></td>
                             <td></td>
                             <td class="text-right"></td>
                             <td class="text-right">Total:</td>                             
                             <td class="text-right"><b>${mostraValor(total_valor_total_impostos)}</b></td>
                             <td class="text-right"><b>${mostraValor(total_valor_total)}</b></td>
                             <td></td>
                    </tr>`);

            document.querySelector('#formVendaItens tbody').innerHTML = '';
            document.querySelector('#formVendaItens table').classList.remove('d-none');
            document.querySelector('#formVendaItens tbody').insertAdjacentHTML('beforeend', tr.join(''));
        },

        pesquisarProdutoPorCodigo: function(cd_produto) {

            fetch('<?= HTTP_PATH ?>produto/search_produto_codigo/' + cd_produto, {
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    method: 'POST',
                    body: JSON.stringify({
                        cd_produto
                    })
                })
                .then((response) => {
                    return response.json();
                }).then((json) => {
                    if (json.error == true) {
                        document.querySelector('#formVenda #cd_produto').value = '';
                        alert(json.msg_error);
                    } else {
                        document.querySelector('#formVenda #id_produto').value = json.id_produto;
                        document.querySelector('#formVenda #cd_produto').value = json.cd_produto;
                        document.querySelector('#formVenda #nm_produto').value = json.nm_produto;
                        document.querySelector('#formVenda #nr_valor').value = json.nr_valor;
                        document.querySelector('#formVenda #nr_valor_imposto').value = json.nr_valor_imposto;
                        document.querySelector('#formVenda #nm_tipo_produto').value = json.nm_tipo_produto;
                        document.querySelector('#formVenda #id_tipo_produto').value = json.id_tipo_produto;
                    }

                });
        },
        finalizarVenda: function() {
            var data = new FormData(document.querySelector('#formVendaItens'));

            fetch('<?= HTTP_PATH ?>venda/finalizar_venda', {                    
                    method: 'POST',
                    body: data
                })
                .then((response) => {
                    return response.json();
                }).then((json) => {
                    if (json.error == true) {                        
                        alert(json.msg_retorno);
                        return false;
                    } else {
                        alert(json.msg_retorno);
                        sessionStorage.removeItem('vendas_itens');                        
                        window.location.href = '<?=HTTP_PATH?>venda';
                    }

                });
        }

    });

    document.querySelector('#formVenda #cd_produto').addEventListener('blur', function() {
        ctrlVenda.pesquisarProdutoPorCodigo(this.value);
    });
    document.querySelector('#btn-adicionar-produto').addEventListener('click', function() {
        if(document.querySelector('#formVenda #nr_quantidade').value > 0){
            ctrlVenda.addProdutoLista(this.value);
        }else{
            alert("Informe a Quantidade Desejada");
        }
        
    });
    document.querySelector('#btn-limpar-lista').addEventListener('click', function() {
        sessionStorage.removeItem('vendas_itens');
        ctrlVenda.montaListaItens();
    });
    document.querySelector('#btn-finalizar-compra').addEventListener('click', function() {
        ctrlVenda.finalizarVenda();
    });

    ctrlVenda.montaListaItens();
</script>