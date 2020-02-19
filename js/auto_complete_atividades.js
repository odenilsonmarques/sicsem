
$(function () {
    $("#descricao_atividade").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "auto_complete.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            $('#descricao_atividade').val(ui.item.label); // display the selected text
            $('#selectuser_id').val(ui.item.value); // save selected id to input

            return false;
        }
    });
});
