<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

require_once "connect.php";

$pname = $_POST['pname'];
$planteco = $_POST['planteco_id'];
$data_pest_epic = $_POST['data_pest_epic_id'];
$latitude = $_POST['lat'];
$longitude = $_POST['lon'];
$descrip = $_POST['descrip'];
$result = getAddress($latitude, $longitude);
$aray = explode(',', $result);
$chang_wat = $aray[2]
// query planteco name_th
$plant = mysqli_query($conn, "SELECT * FROM plantecopests WHERE id = '$planteco'");
while ($row = $plant->fetch_assoc()) {
    $planteco_name_th = $row['name_th'];
}
// query data_pest_epic name_th
$data_pest_epic_a = mysqli_query($conn, "SELECT * FROM datapests WHERE id = '$data_pest_epic'");
while ($row = $data_pest_epic_a->fetch_assoc()) {
    $data_pest_epic_name_th = $row['name_th'];
}
// query planten name_en
$planten = mysqli_query($conn, "SELECT * FROM plantecopests WHERE id = '$planteco'");
while ($row = $planten->fetch_assoc()) {
    $plant_en = $row['name_en'];
}
// query dataepidemicen name_en
$pesten = mysqli_query($conn, "SELECT * FROM datapests WHERE id = '$data_pest_epic'");
while ($row = $pesten->fetch_assoc()) {
    $pest_en = $row['name_en'];
}

function getAddress($latitude, $longitude)
{
        //google map api url
        $url = "https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=AIzaSyASbZrFhniY4kK1neOBybtfgyUXNaH1WrU";

        // send http request
        $geocode = file_get_contents($url);
        $json = json_decode($geocode);
        $address = $json->results[0]->formatted_address;
        return $address;
}


$sql = "INSERT INTO pests (yname,plant_type,data_pest,lat,lon,description,plant_en,pest_en,address,chang_wat)
VALUE ('$pname', '$planteco_name_th', '$data_pest_epic_name_th', '$latitude','$longitude','$descrip','$plant_en','$pest_en','$result','$chang_wat')";
$resultInsert = mysqli_query($conn, $sql);
//แจ้งเตือน
ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$sToken = "82DUKC5VGzG7PQw9RAbrLUooaA6oNTNSVrJ4LVXiLie";
    $sMessage = "📌เเจ้งเตือนเรื่องศัตรูพืช\n";
    
    $sMessage .= "👨‍💼ชื่อ:  " . $pname . " \n";
  
     $sMessage .= "ชนิดของพืชเศรษฐกิจ:  " . $planteco_name_th . " \n";
    

        $sMessage .= "ชื่อศัตรูพืช:  " . $data_pest_epic_name_th . " \n";
    
    $sMessage .= "ที่อยู่:  " . $result . " \n";
   
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result3 = curl_exec( $chOne ); 

	curl_close( $chOne );   

//บันทึกสำเร็จแจ้งเตือนและกระโดดกลับไปหน้าฟอร์ม
if ($resultInsert) {
    echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'success',
                        text: 'Data inserted successfully!',
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                })
            </script>";
    header('refresh:2; url=index.php');
}

?>