<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Data</title>
    <script src="https://static.line-scdn.net/liff/edge/2.1/liff.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="text-center">
                        <img id="pictureUrl" width="50%" class="rounded">
                    </div><br>
                    <h3 class="text-center text-info">
                        <p id="displayName"></p>
                    </h3>
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">เรื่องที่จะแจ้ง</h3>

            <hr class="my-4">

            <a href="indexpest.php"  class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" ><i class="fab fa-google me-2"> ศัตรูพืช</i></a><br><br>
            <a href="indexepidemic.php" class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;" ><i class="fab fa-facebook-f me-2">โรคระบาด</i></a>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="assets/getliff.js"></script>
</body>

</html>
<?php
mysqli_close($conn);


