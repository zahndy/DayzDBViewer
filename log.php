<html>
<head>
<link href="StyleSheet.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function scroll()
{
document.getElementById("logwindow").scrollTop=document.getElementById("logwindow").scrollHeight;

}
</script>
</head>
<body class="nobg" onload="scroll()" id="noscroll">
<div id="logwindow">
<?php
require "config.php";

$cxn = mysqli_connect(_host, _user, _password, _database)
				or die ("could not connect to server");
				
$query = "SELECT * FROM main WHERE death = '0' ORDER BY name";

$result = mysqli_query($cxn,$query)
				or die("couldnt execute query");
$userarray = array();
$index = 0;
while ($row= mysqli_fetch_assoc($result))
		{
			
			$userarray[$index][0]= $row['uid'];
			$userarray[$index][1]= $row['name'];
			$index++;
		}
$query = "SELECT * FROM `log_entry` ORDER BY id DESC LIMIT 50";
$result = mysqli_query($cxn,$query)
				or die("couldnt execute query");
				
$logentry = array();
$newindex =0;
while ($row= mysqli_fetch_assoc($result))
		{
			
			$logentry[$newindex][0]= $row['profile_id'];
			$logentry[$newindex][1]= $row['log_code_id'];
			$logentry[$newindex][2]= $row['created'];
			$newindex++;
		}
	mysqli_close($cxn);
$logentry=	array_reverse ($logentry);
foreach($logentry as $entry)
{
	if($entry[1]=="1"){$entry[1]="has connected";}
	if($entry[1]=="2"){$entry[1]="has disconnected";}
	if($entry[1]=="3"){$entry[1]="has was banned";}
	if($entry[1]=="4"){$entry[1]="has logged in";}
	if($entry[1]=="5"){$entry[1]="has logged out";}
	
	foreach($userarray as $user)
	{
		if($entry[0] == $user[0])
		{
		 $entry[0] = $user[1];
		}
	}
	
	echo $entry[2] ."  ". $entry[0] ."  ".$entry[1] . "<br/>";
}
	
		
?>
</div>
</body>
</html>

