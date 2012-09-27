<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="StyleSheet.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8" />
        <title></title>
    </head>
	 <body id="mapbody" >
	<div id="zoom">zoom: <a href="map.php?zoom=1" target="mainframe" class="button">1x</a> 
	<a href="map.php?zoom=2" target="mainframe" class="button">2x</a> 
	<a href="map.php?zoom=4" target="mainframe" class="button">3x</a> 
	</div>
						
<?php
if($_REQUEST["zoom"]=="4"){ echo '<img src="map_2.jpg" width="4088px" height="3405px" />';}
else if( $_REQUEST["zoom"]=="2"){ echo '<img src="map_1.jpg" width="2040px" height="1702px" />';}
else{ echo '<img src="map_0.jpg" width="1020px" height="851px" />';}

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
			
			// some wierd ass numbers and offsets that dont make sense at all but it works http://i.qkme.me/355ovv.jpg
			if($_REQUEST["zoom"]=="4"){
			echo "<img src='".$ob[2]."' alt='".$ob[3]."' title='".$ob[3]."' style=\"position:absolute; top:".(string)(((13700-$ob[1])/3.54)-85). "px; left:".(string)(($ob[0]/3.54)-95). "px; \"  />";
			}
			else if( $_REQUEST["zoom"]=="2"){ 
			echo "<img src='".$ob[2]."' alt='".$ob[3]."' title='".$ob[3]."' style=\"position:absolute; top:".(string)(((13700-$ob[1])/7.08)-42.5). "px; left:".(string)(($ob[0]/7.08)-47.5). "px; \"  />";
			}
			else{ 
			echo "<img src='".$ob[2]."' alt='".$ob[3]."' title='".$ob[3]."' style=\"position:absolute; top:".(string)(((13700-$ob[1])/14.16)-21.25). "px; left:".(string)(($ob[0]/14.16)-23.75). "px; \"  />";
			}
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
