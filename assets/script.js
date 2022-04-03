//Get_GPS
// window.onload = function() {
//         var lat, lon = null;

//         if (navigator.geolocation) {
//             navigator.geolocation.getCurrentPosition((position) => {
//                 lat = position.coords.latitude;
//                 lon = position.coords.longitude;
//                 document.getElementsByName("lat")[0].value = lat;
//                 document.getElementsByName("lon")[0].value = lon;
//                 var elem = document.querySelector('.loading');
//                 elem.parentNode.removeChild(elem);
//             });
//         }
// ไลน์ login & liff

// function runApp() {
//     liff.getProfile().then(profile => {
//         document.getElementById("pictureUrl").src = profile.pictureUrl;
//         document.getElementById("displayName").innerHTML = '<b>ชื่อผู้แจ้ง:</b> ' + profile.displayName;
//         document.getElementsByName("pname")[0].value = profile.displayName;
//     }).catch(err => console.error(err));
// }
// liff.init({ liffId: "1656912027-kL299Wg7" }, () => {
//     if (liff.isLoggedIn()) {
//         runApp()
//     } else {
//         liff.login();
//     }
// }, err => console.error(err.code, error.message));

// }
// $(function() {
//     var pest_epicObject = $('#pest_epic');
//     var plantecoObject = $('#planteco');
//     var data_pest_epicObject = $('#data_pest_epic');
//     // on change pest_epic
//     pest_epicObject.on('change', function() {
//         var pest_epicId = $(this).val();
//         plantecoObject.html('<option value=""></option>');
//         data_pest_epicObject.html('<option value=""></option>');
//         $.get('get_planteco.php?pest_epic_id=' + pest_epicId, function(data) {
//             var result = JSON.parse(data);
//             $.each(result, function(index, item) {
//                 plantecoObject.append(
//                     $('<option></option>').val(item.id).html(item.name_th)
//                 );
//             });
//         });
//     });
//     // on change planteco
//     plantecoObject.on('change', function() {
//         var plantecoId = $(this).val();
//         data_pest_epicObject.html('<option value=""></option>');
//         $.get('get_data_pest_epic.php?planteco_id=' + plantecoId, function(data) {
//             var result = JSON.parse(data);
//             $.each(result, function(index, item) {
//                 data_pest_epicObject.append(
//                     $('<option></option>').val(item.id).html(item.name_th)
//                 );
//             });
//         });
//     });
// });
$(function() {
    var plantecoObject = $('#planteco');
    var data_pest_epicObject = $('#data_pest_epic');
    // on change planteco
    plantecoObject.on('change', function() {
        var plantecoId = $(this).val();
        data_pest_epicObject.html('<option value=""></option>');
        $.get('get_dataepidemics.php?plantecoepidemic_id=' + plantecoId, function(data) {
            var result = JSON.parse(data);
            $.each(result, function(_index, item) {
                data_pest_epicObject.append(
                    $('<option></option>').val(item.id).html(item.name_th)
                );
            });
        });
    });
});

// function runApp() {
//     liff.getProfile().then(profile => {
//         document.getElementById("pictureUrl").src = profile.pictureUrl;
//         document.getElementById("displayName").innerHTML = '<b>ชื่อผู้แจ้ง:</b> ' + profile.displayName;
//         document.getElementsByName("user_name")[0].value = profile.displayName;
//         document.getElementsByName("id_user")[0].value = profile.userId;
//     }).catch(err => console.error(err));

//     liff.init({ liffId: "1656976272-Z4p0QWO9" }, () => {
//         if (liff.isLoggedIn()) {
//             runApp()
//         } else {
//             liff.login();
//         }
//     }, err => console.error(err.code, error.message));
// }
const body = document.getElementById('body')

// Button elements
const btnSend = document.getElementById("btnSend")
const btnClose = document.getElementById("btnClose")
const btnShare = document.getElementById("btnShare")
const btnLogIn = document.getElementById("btnLogIn")
const btnLogOut = document.getElementById("btnLogOut")
const btnScanCode = document.getElementById("btnScanCode")
const btnOpenWindow = document.getElementById("btnOpenWindow")

// Profile elements
const email = document.getElementById("email")
const userId = document.getElementById("userId")
const pictureUrl = document.getElementById("pictureUrl")
const displayName = document.getElementById("displayName")
const statusMessage = document.getElementById("statusMessage")

// QR element
const code = document.getElementById("code")
const friendShip = document.getElementById("friendShip")

async function main() {
    // Initialize LIFF app)
    await liff.init({ liffId: "1656989131-GwK0Q7pg" })

    // Try a LIFF function
    switch (liff.getOS()) {
        case "android":
            body.style.backgroundColor = "#d1f5d3";
            break
        case "ios":
            body.style.backgroundColor = "#eeeeee";
            break
    }

    if (!liff.isInClient()) {
        if (liff.isLoggedIn()) {
            btnShare.style.display = "block"
            btnLogIn.style.display = "none"
            btnLogOut.style.display = "block"
            getUserProfile()
            getFriendship()
        } else {
            btnLogIn.style.display = "block"
            btnLogOut.style.display = "none"
        }
    } else {
        getUserProfile()
        btnSend.style.display = "block"
        btnShare.style.display = "block"
        getFriendship()
    }
    btnScanCode.style.display = "block"

    btnOpenWindow.style.display = "block"
}
main()

async function getUserProfile() {
    const profile = await liff.getProfile()
    pictureUrl.src = profile.pictureUrl
    userId.innerHTML = "<b>userId:</b> " + profile.userId
    statusMessage.innerHTML = "<b>statusMessage:</b> " + profile.statusMessage
    displayName.innerHTML = "<b>displayName:</b> " + profile.displayName
    email.innerHTML = "<b>email:</b> " + liff.getDecodedIDToken().email
}

if (!liff.isInClient()) {
    btnLogIn.onclick = () => {
        liff.login()
    }

    btnLogOut.onclick = () => {
        liff.logout()
        window.location.reload()
    }
}
async function sendMsg() {
    if (liff.getContext().type !== "none" && liff.getContext().type !== "external") {
        await liff.sendMessages([{
                "type": "text",
                "text": "Line Developers University Workshop"
            },
            {
                "type": "text",
                "text": "This message was sent by sendMessages"
            }
        ])
        liff.closeWindow()
    }
}

btnSend.onclick = () => {
    sendMsg()
}

async function shareMsg() {
    await liff.shareTargetPicker([{
            "type": "text",
            "text": "Line Developers University Workshop"
        },
        {
            type: "image",
            originalContentUrl: "https://d.line-scdn.net/stf/line-lp/2016_en_02.jpg",
            previewImageUrl: "https://d.line-scdn.net/stf/line-lp/2016_en_02.jpg"
        }
    ], {
        isMultiple: false
    });
    if (result) {
        liff.closeWindow();
    }
}

btnShare.onclick = () => {
    shareMsg()
}

async function scanCode() {
    const result = await liff.scanCodeV2();
    code.innerHTML = "<b>Code: </b>" + result.value;
}

btnScanCode.onclick = () => {
    scanCode();
};

btnOpenWindow.onclick = () => {
    liff.openWindow({
        url: 'https://codelab.line.me/codelabs/liff/index.html#9',
        external: false
    })
}
async function getFriendship() {
    let msg = "Hooray! You and our chatbot are friend."
    const friend = await liff.getFriendship()
    if (!friend.friendFlag) {
        msg = "<a href=\"https://line.me/R/ti/p/@BOT-ID\">Follow our chatbot here!</a>"
    }
    friendShip.innerHTML = msg;
}