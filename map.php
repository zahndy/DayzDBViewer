
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="StyleSheet.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body  id="mapbody">
	<img src="chernarus.jpg" />
<?php
require "config.php";

$cxn = mysqli_connect(_host, _user, _password, _database)
				or die ("could not connect to server");

$query = "SELECT * FROM objects WHERE otype = 'ATV_CZ_EP1' OR otype = 'UralCivil2' OR otype = 'Old_bike_TK_INS_EP1' 
OR otype = 'boat.png' 
OR otype = 'Ikarus' 
OR otype = 'Skoda' 
OR otype = 'UH1H_DZ' 
OR otype = 'PBX' 
OR otype = 'Tractor' 
OR otype = 'hilux1_civil_3_open' 
OR otype = 'UAZ_Unarmed_TK_EP1' 
OR otype = 'V3S_Civ' 
OR otype = 'Ikarus_TK_CIV_EP1' 
OR otype = 'car_hatchback' 
OR otype = 'Old_bike_TK_INS_EP1' 
OR otype = 'ATV_US_EP1' 
OR otype = 'SkodaBlue' 
OR otype = 'SkodaGreen' 
OR otype = 'Volha_2_TK_CIV_EP1' 
OR otype = 'Volha_1_TK_CIV_EP1' 
OR otype = 'S1203_TK_CIV_EP1' 
OR otype = 'TT650_TK_EP1' 
OR otype = 'TT650_TK_CIV_EP1'
ORDER BY otype";

$result = mysqli_query($cxn,$query)
				or die("couldnt execute query");

while ($row= mysqli_fetch_assoc($result))
		{
			$ob = process($row['pos'],$row['otype']);
			echo "<img src='".$ob[2]."' alt='".$ob[3]."' title='".$ob[3]."' style=\"position:absolute; top:".(string)(1580-($ob[1]/10)). "px; left:".(string)(($ob[0]/10)-30). "px; \"  /><br/>";
		}
	mysqli_close($cxn);

function process($str,$name)
{

    $arr  = explode(",",str_replace(array("[","]"),"",$str));
    array_shift($arr);
    array_pop($arr); 
    $search = array('ATV_CZ_EP1','UralCivil2',' Old_bike_TK_INS_EP1 ','Fishing_Boat','smallboat_1','smallboat_2','UH1H_DZ','PBX','Tractor','hilux1_civil_3_open','UAZ_Unarmed_TK_EP1','V3S_Civ','Ikarus_TK_CIV_EP1','car_hatchback','Old_bike_TK_INS_EP1','ATV_US_EP1','SkodaBlue','SkodaGreen','Volha_2_TK_CIV_EP1','Volha_1_TK_CIV_EP1','S1203_TK_CIV_EP1','TT650_TK_EP1','TT650_TK_CIV_EP1','Ikarus','Skoda');
    $replace = array('atv.png','bigtruck.png','bike.png','boat.png','boat.png','boat.png','helicopter.png','motorcycle.png','tractor.png','truck.png','uaz.png','bigtruck.png','bus.png','car.png','bike.png','atv.png','car.png','car.png','car.png','car.png','car.png','motorcycle.png','motorcycle.png','bus.png','car.png');
    array_push($arr,str_replace($search,$replace,$name));
    array_push($arr,$name); 
    return $arr; // [posx,posy,image,name]
}
?>
    </body>
</html>
