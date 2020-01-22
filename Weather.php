<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body bgcolor="aabbcc">

</body>
</html>



<?php
$apiKey = "9c2ba5af1fc1b51b596699358bda9be6";
$cityId = "1275817";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);

$currentTime = time();

  $name=$data->name;
  $time= date("l g:i a",$currentTime);
  $date=date("jS F, Y",$currentTime);
  $tempmax=$data->main->temp_max;
  $tempmin=$data->main->temp_min;
  $humdity=$data->main->humidity;
  $wind=$data->wind->speed;
  $servername="localhost";
$username="root";
$password="root";
$databse="namekart";
$conn=mysqli_connect($servername,$username,$password,$databse);
if(!$conn)
     die("connection not created..".mysqli_connect_error());
   $sql = "INSERT INTO  weather(name, tempmax, tempmin,humdity,windspeed)
VALUES ('$name','$tempmax','$tempmin', '$humdity', '$wind')";

$conn->query($sql);



   echo "<h3 style='color:red;text-align:center'>Weather display</h3>";
   $result=mysqli_query($conn,"select  name,tempmax,tempmin,humdity,windspeed,Logindate from weather");


echo "<table border='2'>
   <tr>
      <th>Name</th>
      <th>TempMax</th>
      <th>TempMin</th>
      <th>Humidity</th>
      <th>WindSpeed</th>
      <th>DateTime</th>
    </tr>";
    if(mysqli_num_rows($result)>0)
    {
      while ($array = mysqli_fetch_assoc($result))
     {
        echo "<tr><td>".$array["name"]."</td><td>".
        $array["tempmax"]."</td><td>".$array["tempmin"].
        "</td><td>".$array["humdity"]."</td><td>".
        $array["windspeed"]."</td><td>".$array["Logindate"].
        "</td></tr>";
     }

    }
    else
    {
        echo "0 results";
    }
    echo "</table";
?>


