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

function runApp() {
    liff.getProfile().then(profile => {
        document.getElementById("pictureUrl").src = profile.pictureUrl;
        document.getElementById("displayName").innerHTML = '<b>ชื่อผู้แจ้ง:</b> ' + profile.displayName;
        document.getElementsByName("user_name")[0].value = profile.displayName;
        document.getElementsByName("id_user")[0].value = profile.userId;
    }).catch(err => console.error(err));

    liff.init({ liffId: "1656912027-Jx4kkRyB" }, () => {
        if (liff.isLoggedIn()) {
            runApp()
        } else {
            liff.login();
        }
    }, err => console.error(err.code, error.message));
}