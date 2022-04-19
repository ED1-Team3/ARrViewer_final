<?php 
include_once('config.php');
session_start();

	if(!isset($_SESSION['userlogin'])){
		header("Location: Login.php");
	}

	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION);
		header("Location: index.php");
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Creator Portal</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>


 <!-- ======= Header ======= -->
 <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo"><img src="assets/img/logo.png" alt=""></a>

      <nav id="navbar" class="navbar">
        <ul>

            <li>
              <a href="portal.php?logout=true"><button type="button" id="myBtn" class="btn btn-primary navbar-btn">            
                <b>LOG OUT</b>
              </button></a>
            </li> 

          
      
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

	<div class="limiter">
	<h1><b><strong>
							<?php 
							$sql="SELECT * from Creators;";
							$result = $db->query($sql);
							if($result)
							{
								// while($row = $result->fetch())
								foreach($result as $row)
								{
									if($_SESSION['userlogin']==$row->email){
										echo $row->firstname;
									}
								}
							}
							// $resultCheck = 
						?>'s Creator Portal</strong></b></h1>


	<section id="portal" class="d-flex align-items-center">
	<h1></h1>
	</section>

		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100 ver1 m-b-110">
				<div id="container" class="flex">
					<div class="completed"><h1><b> Completed Projects</b></h1></div>
					<div id="create"><a href="../editor/index.html"><button type="button" id="myBtn" class="btn btn-primary navbar-btn">            
					<b>Create a New Project</b></button></a></div>
					</div>
					
					<table data-vertable="ver1">
						<thead>
							<tr class="row100 head">
								<th class="column100 column1" data-column="column1">Project Name</th>
								<th class="column100 column2" data-column="column2">Link</th>
								<th class="column100 column4" data-column="column4">QR Code</th> 
							</tr>
						</thead>
						<tbody>
							<?php 
								$sql="SELECT * from Creator_Models;";
								$result = $db->query($sql);
								if($result)
								{
									foreach($result as $row)
									{
										if($_SESSION['userlogin']==$row->email){
											$qr_link = "coe-202201-4952-3-fe.hpc.fau.edu/database/view.php?id=".$row->model_id;
											$qr_link = str_replace(':444', '', $qr_link);
											echo $qr_link	
							?>
										<tr class="row100">
											<td class="column100 column1" data-column="column1"><?php echo $row->file_name; ?></td>
											<td class="column100 column2" data-column="column2"><a href="<?php echo "/database/view.php?id=".$row->model_id;?>" class="QRcode"><?php echo "coe-202201-4952-3-fe.hpc.fau.edu/database/view.php?id=".$row->model_id;?></a></td>
											<td class="column100 column3" data-column="column3"><a class="btn btn-success" tabindex="0" title="QR Code" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-url="<?php echo $qr_link;?>">View QR Code</a>
											<div id="qrcode" style="display: none; width: auto; height: auto; padding: 15px;"></div> </td>
									
										</tr>
										<?php
										}
									}
								}
										?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
<!--===============================================================================================-->
	<script src="qrcode.min.js"></script>
	<script>
	// Create QR code
	var qrcode = new QRCode(document.getElementById("qrcode"), {
		width : 120,
		height : 120
	});
	// Get data
	function makeQrcode(e) {
		qrcode.makeCode(e.attr("data-url"));
	}


	jQuery(document).ready(function(){
		jQuery("[data-toggle='popover']").popover(
			options = {
						content: jQuery("#qrcode"),
						html: true 
			}
		);
		//Show QR code
		jQuery("[data-toggle='popover']").on("show.bs.popover", function(e) {
			makeQrcode(jQuery(this));
			jQuery("#qrcode").show();
		});
	});

	</script>
</body>
</html>