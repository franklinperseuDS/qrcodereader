function ListarContatos() {
    url = 'listar.php';

    var table_Contatos = $('#tbContatos').dataTable({
        "ajax": url,
        "columns": [
            {"data": "nome"},
            {"data": "telefone"},
            {"data": "ramal"},
            {"data": "email"},
            {"data": "departamento"},
            {"data": "empresa"}
        ],
        
        "lengthMenu": [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"]],
        "pageLength": 10,
        "oLanguage": {
            "oPaginate": {
                "sFirst": " ",
                "sPrevious": " ",
                "sNext": " ",
                "sLast": " ",
            },
            "sLengthMenu": "Registros por p&aacute;gina: _MENU_",
            "sInfo": "Total de _TOTAL_ registros (exibindo _START_ at&eacute; _END_)",
            "sInfoFiltered": "(Filtrado por _MAX_ total registros)",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sEmptyTable": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
        }
    });
		$('.dataTables_filter input').first().focus();
}
;