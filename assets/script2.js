$(function() {
    var plantecoObject = $('#planteco');
    var data_pest_epicObject = $('#data_pest_epic');
    // on change planteco
    plantecoObject.on('change', function() {
        var plantecoId = $(this).val();
        data_pest_epicObject.html('<option value=""></option>');
        $.get('get_datapests.php?plantecopest_id=' + plantecoId, function(data) {
            var result = JSON.parse(data);
            $.each(result, function(_index, item) {
                data_pest_epicObject.append(
                    $('<option></option>').val(item.id).html(item.name_th)
                );
            });
        });
    });
});