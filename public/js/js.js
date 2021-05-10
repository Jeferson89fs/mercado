$.modalAdminLTE = function () {
    var args = arguments[0] || {};

    if (!$('#div_modal').length > 0) {
        $('<div id="div_modal" ></div>').appendTo('#janela');
    }
    if (!$('#' + args.nm_modal).length > 0) {
        var backdrop = args.fl_backdrop ? 'true' : 'false';
        var keyboard = args.fl_keyboard ? 'true' : 'false';
        var html = $('<div class="modal-dialog modal-xl" id="' + args.nm_modal + '"  tabindex="-1" role="dialog" data-backdrop="' + backdrop + '" data-keyboard="' + keyboard + '" >');
        html.appendTo('#div_modal');
    }
    $.ajax({
        url: args.url,
        data: args.nm_data,
        type: 'POST',
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#' + args.nm_modal).html(data);
        }
    });
    $('#' + args.nm_modal)
            .modal()
            .on('hidden.bs.modal', function (e) {
                $(this).data('modal', null);
                if (args.atualizar) {
                    eval(args.atualizar);
                }
                $('#div_modal').remove();
                $('#' + args.nm_modal).find('form:first').focus();
            })
    return false;
}

function formataValor(valor) {
    valor = valor.replace(new RegExp(/\./g), '');
    return valor = valor.replace(new RegExp(/\,/g), '.');
}

function mostraValor(num, casas) {
    if (!casas) {
        casas = 2;
    }
    x = 0;
    if (num < 0) {
        num = Math.abs(num);
        x = 1;
    }
    if (isNaN(num)) {
        num = "0";
    }
    var potencia = Math.pow(10, casas);
    cents = Math.floor((num * potencia + 0.5) % potencia);
    num = Math.floor((num * potencia + 0.5) / potencia).toString();
    if (cents == 0) {
        cents = '';
    }
    for (var i = casas; i > 0; i--) {
        if (cents < (Math.pow(10, i) / 10)) {
            cents = "0" + cents;
        }
    }
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
    ret = num + ',' + cents;
    if (x == 1)
        ret = '-' + ret;
    return ret;
}