



<style type="text/css">
td{
border-width:0px 1px 1px 0px;
height:200px;
width:200px;
text-align:center;
}
table{
    background-color:#d9d9d9;
    position:fixed;
    left:25%;
}
button{
height:200px;
width:200px;
text-align:center;
font-size:2.0em;
background-color:white;
color:black;
}
</style>


<script>
    function revealCard(btnClass, btnId) {
        var btn = "\""+btnID+"\"";
    	
        if (btnClass == "First") {
            document.getElementById(btn).style.backgroundColor = "blue";      
        }
        else if (btnClass == "Second"{
            document.getElementById(btn).style.backgroundColor = "red";
        }
 		else if (btnClass == "Miss"{
            document.getElementById(btn).style.backgroundColor = "yellow";
        }
        else{
        	document.getElementById(btn).style.backgroundColor = "black";
        }
        
    }
</script>


<html>
<head>
</head>
<body>

<?php
$gameseed = substr(md5(microtime()),rand(0,26),4);
$seed = "codenames".$gameseed.".html";

$file = fopen($seed, "w+");

$masterkey = '<style type="text/css">#btnFirst{height:200px;width:200px;text-align:center;font-size:2.0em;background-color: blue;}#btnSecond{height:200px;width:200px;text-align:center;font-size:2.0em;background-color: red;}#btnMiss{height:200px;width:200px;text-align:center;font-size:2.0em;background-color: yellow;}#btnAssassin{height:200px;width:200px;text-align:center;font-size:2.0em;background-color: black;color: white;}</style><html><head></head><body><h1>'.$gameseed.'<table border = "1"><tr>';
echo'<h1>'.$gameseed.'</h1>';
mysql_connect('localhost','root','Reg74wea') or die(mysql_error());
mysql_select_db('codenames')  or die(mysql_error());
$query=mysql_query("select word FROM wordlist ORDER BY RAND() LIMIT 25")  or die(mysql_error());
echo'<table border="1" ><tr>';
$i = 0;
$j = 0;
$startcolor = rand(1,2);
$cards = range(1,25);
shuffle($cards);
while($res=mysql_fetch_array($query))
{
 $j++;
 echo'<td><button type= "button" class="btn';
 $masterkey = $masterkey.'<td><input type="button" class="btn';
 
 
 $card = array_pop($cards);
 switch ($card){
 	case ($card <= 9):
 		$x = 'First';
 		echo $x;
 		$masterkey = $masterkey.$x;
 	break;
 	case ($card <= 17 and $card >9):
 		$x = 'Second';
 		echo $x;
 		$masterkey = $masterkey.$x;
 	break;
 	case ($card <=24 and $card > 17):
 		$x = 'Miss';
 		echo $x;
 		$masterkey = $masterkey.$x;
 	break;
 	default:
 		$x = 'Assassin';
 		echo $x;
 		$masterkey = $masterkey.$x;
 	break;
 }


 echo'" id = "btn'.$j.'" value = "'.$res['word'].'"';
 echo' onclick = "revealCard('.$x.",btn".$j.")></button></td>";


//$masterkey = $masterkey.'" id = "btn'.$j.'" value = "'.$res['word'].'\' onclick = \'revealCard(\"'.$x.',\"btn'.$j.')\'/></td>';
 $i++;
 if ($i == 5){
 	$i = 0;
 	echo'</tr><tr>';
 	$masterkey = $masterkey.'</tr><tr>';

 }	
}
echo'</tr></table>';
$masterkey = $masterkey.'</tr></table></body></html>';
fwrite($file, $masterkey);
fclose($file);

?>
</body>
</html>