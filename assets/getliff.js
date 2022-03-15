function runApp() {
    liff.getProfile().then(profile => {
        document.getElementById("pictureUrl").src = profile.pictureUrl;
        document.getElementById("displayName").innerHTML = '<b>ชื่อผู้แจ้ง:</b> ' + profile.displayName;
        document.getElementsByName("pname")[0].value = profile.displayName;
        document.getElementsByName("id_user")[0].value = profile.userId;
    }).catch(err => console.error(err));
}
liff.init({ liffId: "1656976272-Jrqed6a7" }, () => {
    if (liff.isLoggedIn()) {
        runApp()
    } else {
        liff.login();
    }
}, err => console.error(err.code, error.message));