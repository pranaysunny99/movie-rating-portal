<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title></title>
	<style type="text/css">
		body
		{
			background-color: #1D0033;
			background-image: url(shw.jpg);

		}

		.review
		{
			margin-left: 440px;
			margin-top: 100px;
			widows: 50%;
			height: 30%;
		}
		.show
		{
			margin-left: 440px;
			color: white;
			background-image: linear-gradient(to bottom right, #F00B51, #7366FF);
			margin-top: 20px;
			border-radius: 5px;
			width: 465px;
			height: 30%;
		}
		h1
		{
			padding-top: 20px;
			text-align: center;
			color: white;
		}
		.box
		{
			margin-top: 50px;
		}
		strong
		{
			color: white;
		}
		
		
	</style>
</head>
<body>
<h1>WELCOME TO&nbsp&nbsp<a href="https://fontmeme.com/fonts/messages-font/"><img src="https://fontmeme.com/permalink/200412/95e92eeb12c7a6e4d05a877d2bda997f.png" alt="messages-font" border="0"></a></h1><br>
<center><strong>Please Connect to internet for Bootstrap and other things.</strong></center>

<div class="review">
<form method="post">
		<select name="name" class="browser-default custom-select" style="width: 50%">
  <option selected>Movie Name</option>
  <option value="Intersteller">Intersteller</option>
  <option value="Inception">Inception</option>
  <option value="Avengers Endgame">Avengers Endgame</option>
  <option value="URI">URI</option>
  <option value="Kabir Singh">Kabir Singh</option>
</select>
<br><br>
<select name="rating" class="browser-default custom-select" style="width: 50%">
  <option selected>Rate</option>
  <option value="1">1</option>
  <option value="1.5">1.5</option>
  <option value="2">2</option>
  <option value="2.5">2.5</option>
  <option value="3">3</option>
  <option value="3.5">3.5</option>
  <option value="4">4</option>
  <option value="4.5">4.5</option>
  <option value="5">5</option>
</select>
<br><br>
 <button type="submit" class="btn btn-primary" name="rate" value="rate" style="width: 50%;">Rate</button>
</form>
<?php
	if (isset($_POST['rate']))
	{
		$conn=mysqli_connect("localhost","root","","movie rating");
		if ($conn)
		{
			$name=$_POST['name'];
			$rate=$_POST['rating'];
			if ($name!='Movie Name' OR $rate!="Rate") 
			{
			$sql="SELECT * FROM rating where name='".$name."'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0)
				{
					$row=mysqli_fetch_assoc($result);
					$noofentry=($row['noofentry']+1);
					$totalrate=($row['totalrate']+$rate);
					$rating=$totalrate/$noofentry;
					$sql="update rating set totalrate='".$totalrate."',noofentry='".$noofentry."',rating='".$rating."' where name='".$name."'";
					if (mysqli_query($conn,$sql))
					{
						header('Location:/assignment/review.php');
					}
				}
			else
			{
				$sql="INSERT INTO rating(name,totalrate,noofentry,rating)VALUES('$name','$rate','1','$rate')";
				if (mysqli_query($conn,$sql))
					{
						header('Location:/assignment/review.php');
					}

			}
			}
			else
			{
				echo "<script>alert('Please select Valid options!');</script>";
			}
		}
	}
 ?>
</div>
<div class="show">
	<br>
	<center><h5>Ratings</h5></center>
	<br>
	<?php 
		$conn=mysqli_connect("localhost","root","","movie rating");
		if ($conn)
		{
			$sql="SELECT name,rating FROM rating";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0)
				{
					while ($row=mysqli_fetch_assoc($result))
					{
						$name=$row['name'];
						$rating=$row['rating'];
						echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$name."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".round($rating,2)."<br><br>";
					}
				}
		}
	 ?>
</div>
</body>
</html>