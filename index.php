<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Tnp IIT KGP</title>
  
  
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    </head>
    <?php
    	function db_connect(){

		//$con = mysqli_connect("localhost","root","25011994","tnp");
		$con = mysqli_connect("localhost","webtutplus","webtutplus","webtut_tnp");
		// Check connection
		if (mysqli_connect_errno())
	  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  	//else
			//echo "Connection Successful<br>";
		
		return $con;
	}
	$conn = db_connect();
    ?>
<body>

	<div class="container" style="text-align:center">
		<h1 class="bg-info" > Search T &amp; P IIT kgp </h1>
		<form action="" method="get" style="width:50%;margin:0 auto">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Search</label>
		    <input type="text" class="form-control" name="company"
		    id="exampleInputEmail1" placeholder="Enter a company name" required>
		  </div>
		
		  
	
		  <button type="submit" name="search" class="btn btn-info">Submit</button>
		</form>


	</div>
	<div class="container" >
		
		<div id="result">
		<h2 class="bg-info" style="text-align:center" > This year Result </h2>
			<table class="table table-striped">
			<?php 
				if(isset($_GET['search'])){


					$company  = mysqli_real_escape_string($conn,$_GET['company'] );
					//echo $company;
					$query = "SELECT * FROM erp WHERE description LIKE '%$company%' or
						company LIKE '%$company%' ";
					//echo $query;
					$result = mysqli_query($conn, $query);

						if (mysqli_num_rows($result) > 0) {
						    // output data of each row
						    while($row = mysqli_fetch_assoc($result)) {

						    	?>
						    		<tr>
						    		<td>
						    				<?php echo $row['company']; ?>
						    		</td>
						    		<td>
						    				<?php echo $row['type']; ?>
						    		</td>

						    		<td>
						    				<?php echo $row['cell3']; ?>
						    		</td>

						    			<td>
						    				<?php echo $row['date']; ?>
						    			</td>
						    			<td>
						    			
						    			
						    			<?php echo $row['description']; ?>
						    			
						    			</td>
						    			<td>
						    				
						    				<?php 
						    				if(preg_match("#DATA/ARCHIVE/TRAINGANDPLACEMNT#", $row['link'])){
						    					$link = explode("&quot;", $row['link'])[1];
						    					$link = "https://erp.iitkgp.ernet.in/TrainingPlacement/TPJNFDescriptionShow?filepath=".$link;
						    				
						    				?>
						    				<a href="<?php echo $link;  ?>" target="_blank">

						    				Download </a>
						    				<?php } ?>
						    			</td>
						    		</tr>



						    	<?php
				         

						    }
						} else {
						    echo "No result matching";
						}



				}

			?>

				</table>
			<h2 class="bg-success" style="text-align:center" > Last 3 year Result </h2>
			<table class="table table-striped">
			<?php 
				if(isset($_GET['search'])){


					$company  = mysqli_real_escape_string($conn,$_GET['company'] );
					//echo $company;
					$query = "SELECT * FROM data_date WHERE description LIKE '%$company%'";
					//echo $query;
					$result = mysqli_query($conn, $query);

						if (mysqli_num_rows($result) > 0) {
						    // output data of each row
						    while($row = mysqli_fetch_assoc($result)) {

						    	?>
						    		<tr>
						    			<td>
						    				<?php echo $row['date']; ?>
						    			</td>
						    			<td>
						    			<?php $link =  $row['link']; ?>
						    			<a href="<?php echo $link; ?>" target="_blank"> 
						    			<?php echo $row['description']; ?>
						    			</a>
						    			</td>
						    			<td>
						    				
						    				<a href="<?php echo $link; ?>" target="_blank"> 
						    					Open Link
						    				</a>
						    			</td>
						    		</tr>



						    	<?php
				         

						    }
						} else {
						    echo "No result matching";
						}



				}

			?>

				</table>
		</div>
	</div>

	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64943107-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>