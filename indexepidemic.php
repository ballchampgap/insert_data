<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Data Pest</title>
    <script src="https://static.line-scdn.net/liff/edge/2.1/liff.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css">
</head>
<style>
.loading {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 9999;
    background: url("https://i.gifer.com/YCZH.gif") no-repeat rgb(249, 249, 249);
    background-position: center;
    background-size: 100%;
}
</style>
<?php

include('connect.php');
$sql = "SELECT * FROM plantecoepidemics";
$query = mysqli_query($conn, $sql);
?>

<body>
    <div id="login">
        <div class="loading"></div>
        <div class="container my-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img id="pictureUrl" width="50%" class="rounded">
                    </div><br>
                    <h3 class="text-center text-info">
                        <p id="displayName"></p>
                    </h3>
                    <form id="mainfrom" action="frminsert.php" method="POST">
                        <div class="form">
                            <div class="form-group">
                                <label for="planteco">กรุณาเลือกชนิดของพืชเศรษฐกิจ</label>
                                <select name="planteco_id" id="planteco" class="form-control" required>
                                <option value=""></option>
                                <?php while($result = mysqli_fetch_assoc($query)): ?>
                                    <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="data_pest_epic">โรคระบาดที่พบ</label>
                                <select name="data_pest_epic_id" id="data_pest_epic" class="form-control" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descrip" rows="3">รายละเอียด (ไม่บังคับ)</label><br>
                                <textarea name="descrip" type="text" id="descrip" class="form-control" required> </textarea><br>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="lat">
                                <input type="hidden" name="lon">
                                <input type="hidden" name="pname">
                                <button id="btn" type="submit" class="btn btn-primary mt-3" onClick="JavaScript:window.close();">Save</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script> 
    window.onload = function() {
        var lat, lon = null;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                lat = position.coords.latitude;
                lon = position.coords.longitude;
                document.getElementsByName("lat")[0].value = lat;
                document.getElementsByName("lon")[0].value = lon;
                var elem = document.querySelector('.loading');
                elem.parentNode.removeChild(elem);
            });
        }
    }
    </script>

    <script> 
function runApp() {
    liff.getProfile().then(profile => {
        document.getElementById("pictureUrl").src = profile.pictureUrl;
        document.getElementById("displayName").innerHTML = '<b>ชื่อผู้แจ้ง:</b> ' + profile.displayName;
        document.getElementsByName("user_name")[0].value = profile.displayName;
        document.getElementsByName("id_user")[0].value = profile.userId;
    }).catch(err => console.error(err));

    liff.init({ liffId: "1656976284-4b86kPOB" }, () => {
        if (liff.isLoggedIn()) {
            runApp()
        } else {
            liff.login();
        }
    }, err => console.error(err.code, error.message));
}
</script>

    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
    <!-- <script src="assets/getliff.js"></script> -->
</body>

</html>
<?php
mysqli_close($conn);



