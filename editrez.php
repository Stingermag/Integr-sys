<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<style>

    form  {
        background: #B0C4DE;
        width: 400px;
        border-radius: 30px;
        padding: 10px;
 		display:inline-block;
    	}

    input[type=text], input[type=password]
		{
		
		 border-radius: 10px;
		 border: 0px;
		     padding: 5px;
		}
		input[type=submit]
		{
		
		 border-radius: 10px;
		 border: 0px;
		 padding: 5px;
		 width: 200px;
		}
		
		.services_item{
	width: 370px;
	
	text-align: center;

}


  </style>
</head>

<body id="portfolio">
<center>
<?php 

$id = $_GET['id'];
$disc = $_GET['disc'];


 echo "
 <form action=\"editrezbd.php\" method=\"post\">
 <p>Описание: <br><input type=\"text\" name=\"newdisc\" value=\"$disc\"/></p>
  <p>Номер: <br> <input type=\"text\" name=\"id\" value=\"$id\"/></p>
  <p><input type=\"submit\" /></p>
</form>"; 

 ?>

</center>
</body>

</html>