$('#add').click(function(){
    var valor = $('#referencia').val();
    $.ajax({
        'type': 'post',
        'dataType': 'json',
        'url': 'index.php?r=ajax/consultar-referencias',
        'data': {
            'id': valor, 
            _csrf: yii.getCsrfToken()
        },
        'success': function (data, textStatus) {
            addReferencia(data);
        },
        'beforeSend': function () {
            $('#loading').show();
        },
        'complete': function () {
            $('#loading').hide();
        }
    });
});

function addTombo(response) {
    if (response['success'] != false) {
        var codigo = response['codigo'];
        var referencia = response['descricao'];
        var referencias = $('#referencias').find('tr');
        var tamanho = referencias.length;
        var repetido = false;
        var i = 0;

        for (i = 0; i < tamanho; i++) {
            var celula = $(referencias[i]).find('td :hidden');

            if ($(celula).val() === codigo) {
                repetido = true;
                break;
            }
        }

        if (!repetido) {
            var campoHidden = "<input type='hidden' value='" + codigo + "' name='Referencia[]'>";
            var campoCodigo = "<td>" + codigo + campoHidden + "</td>";
            var campoReferencia = "<td>" + referencia + "</td>";
            var campoBotao = "<td><a id='remove'><span class='glyphicon glyphicon-trash'></span></a></td>";
            var linha = "<tr>" + campoCodigo + campoReferencia + campoBotao + "</tr>";
            $('#referencias tr:last').after(linha);

            /*
             * caso a referencia estivesse marcado como removido
             * ele será desmarcado do campo hidden
             */
            var deletados = $('#deletados').val();
            deletados = deletados.replace(codigo + ';', '');
            $('#deletados').val(deletados);
        } else {
            alert('Referencia já adicionado');
        }
    } else {
        alert('O código da referencia informado não existe');
    }
}


