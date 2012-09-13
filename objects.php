<html>
<head>
<link href="StyleSheet.css" rel="stylesheet" type="text/css">
</head>
<body class="nobg" >
<?php
require "config.php";

$cxn = mysqli_connect(_host, _user, _password, _database)
				or die ("could not connect to server");
				
$query = "SELECT * FROM objects ORDER BY otype";

$result = mysqli_query($cxn,$query)
				or die("couldnt execute query");
echo "<table><tr> 
	<th>Type</th>
	<th>Pos[deg[x,y,z]]</th>
	<th>Inventory</th>
	<th>Damaged parts</th>
	<th>Damage</th>
	<th>Fuel</th>
	</tr>";
while ($row= mysqli_fetch_assoc($result))
		{
			echo "<tr>";
			echo "<td>" . $row['otype'] . "</td>";
			echo "<td>" . $row['pos'] . "</td>";
			echo "<td>" . formatbackpack($row['inventory']) . "</td>";
			echo "<td>" . $row['health'] . "</td>";
			echo "<td>" . $row['damage'] . "</td>";
			echo "<td>" . $row['fuel'] . "</td>";
			echo "</tr>";
		}
	mysqli_close($cxn);
	echo "</table>";
	
	
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
		
?>
</body>
</html>