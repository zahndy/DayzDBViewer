<html>
<head>
<link href="StyleSheet.css" rel="stylesheet" type="text/css">
</head>
<body class="nobg" >
<?php
require "config.php";

$cxn = mysqli_connect(_host, _user, _password, _database)
				or die ("could not connect to server");
				
$query = "SELECT * FROM main WHERE death = '0' ORDER BY name";

$result = mysqli_query($cxn,$query)
				or die("couldnt execute query");
echo "<table><tr> 
	<th>Name</th>
	<th>Zombie Kills</th>
	<th>Human Kills</th>
	<th>Headshots</th>
	<th>Humanity</th>
	<th>Survival Time</th>
	<th>Outfit</th>
	<th>Inventory</th>
	<th>Backpack</th>
	<th>Medical</th>
	</tr>";
while ($row= mysqli_fetch_assoc($result))
		{
			echo "<tr>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['kills'] . "</td>";
			echo "<td>" . $row['hkills'] . "</td>";
			echo "<td>" . $row['hs'] . "</td>";
			echo "<td>" . $row['humanity'] . "</td>";
			echo "<td>" . formattime($row['stime']) . "</td>";
			echo "<td>" . formatmodel($row['model']) . "</td>";
			echo "<td>" . formatinventory($row['inventory']) . "</td>";
			echo "<td>" . formatbackpack($row['backpack']) . "</td>";
			echo "<td>" . formatmedical($row['medical']) . "</td>";
			echo "</tr>";
		}
	mysqli_close($cxn);
	echo "</table>";
	
	function formattime($minutes)
	{
		$hours = floor($minutes / 60);
		$rest = $minutes - ($hours*60);
		
	return $hours."h ". $rest . "m";
	}
	
	function formatmodel($model)
	{
		if($model=="Survivor2_DZ")
		{
		return "Civilian Clothing";
		}
		
		elseif($model=="Camo1_DZ")
		{
		return "Camouflage";
		}
		
		else
		{
		return "Ghillie Suit";
		}
		
	}
	
	function formatinventory($inventory)
	{
	 	$clean = str_replace(array("[", "]", '"',","),array("","","","\\n"), $inventory);
		return "<a href=\"javascript:alert('". $clean ."')\"><img class='tblimg' src='inventory.png' height='42' width='42'/></a>";
	}
	
	function formatbackpack($inventory)
	{
		$clean1 = str_replace(array("[1]","1,","[1","1]",
		"[2]","2,","[2","2]",
		"[3]","3,","[3","3]",
		"[4]","4,","[4","4]",
		"[5]","5,","[5","5]",
		"[6]","6,","[6","6]",
		"[7]","7,","[7","7]",
		"[8]","8,","[8","8]",
		"[9]","9,","[9","9]",), "", $inventory); // not showing the amount of items
	 	$clean2 = str_replace(array("[", "]", '"',","),array("","","","\\n"), $clean1);
		return "<a href=\"javascript:alert('". $clean2 ."')\"><img class='tblimg' src='DZ_Backpack_EP1.png' height='42' width='42'/></a>";
	}
	
	function formatmedical($medick)
	{
	/*
	medical values:
	[isDead,
	unconscious,
	infected,
	injured,
	inPain,
	isCardiac,
	lowBlood,
	BloodQty,
	[wounds],		  //dont really need to know this
	[0,0],            //ignoring these other values as i havent figured them out yet
	0,                //
	[1067.68,227.209]]//
	*/
	$withoutbrackets = str_replace(array("[", "]"),"", $medick);
	$arr = explode(",", $withoutbrackets);
	$str = array();
	if($arr[0]=="true"){array_push($str,"dead");}
	if($arr[1]=="true"){array_push($str,"unconscious");}
	if($arr[2]=="true"){array_push($str,"infected");}
	if($arr[3]=="true"){array_push($str,"injured");}
	if($arr[4]=="true"){array_push($str,"in pain");}
	if($arr[5]=="true"){array_push($str,"is Cardiac");}
	array_push($str,"blood: ".$arr[7]);
	return implode(", ",$str);
	
	}
		
?>
</body>
</html>