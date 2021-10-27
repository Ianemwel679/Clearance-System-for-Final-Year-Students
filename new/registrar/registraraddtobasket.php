<?php
session_start();
if(!isset($_SESSION['registrarlogin']))
{
 	header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	 <?php
	 //start of basic application details
  	include("../connection.php");
	$query=mysqli_query($conn,"select * from clearance_basics");
	$wata=mysqli_fetch_array($query);
	$copyright=$wata['rights'];
	$developed=$wata['developed'];
	$website=$wata['website'];
	$title=$wata['title'];
	$subtitle=$wata['subtititle'];
	//end of basic application details
    ?>
    <title><?php echo $title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
	<?php
	$username=$_SESSION['studentlogin'];
	$clearancequery=mysqli_query($conn,"select * from student_details where idnumber='$username'");
	$clearancedata=mysqli_fetch_array($clearancequery);
	$clearedornot=$clearancedata['clearance_status'];
	?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:green">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a style="text-transform:uppercase;" class="navbar-brand" href="../index.php"><?php echo $title; ?></a>
            </div>
            <!-- Top Menu Items -->
			<!-- start processing php -->
			<!-- End processing php -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['registrarlogin']; ?> admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href=""><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="registrarhome.php"><i class="fa fa-fw fa-dashboard"></i> <?php echo $_SESSION['registrarlogin']; ?> Home</a>
                    </li>
					
					<li>
                        <a href="registrarclearedstudents.php"><i class="glyphicon glyphicon-thumbs-up"></i> Cleared Students</a>
                    </li>
					
					<li>
                        <a href="registrarunclearedstudents.php"><i class="glyphicon glyphicon-thumbs-down"></i> Uncleared Students</a>
                    </li>
					<li class="active">
                        <a href="registrarbasket.php"><i class="glyphicon glyphicon-bullhorn"></i> Students Basket</a>
                    </li>

					<li>
                        <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">registrar Basket addition progress</h1>
						<p>
						<?php
						$idnumber=$_POST['idnumber'];
						$basket=$_POST['basket'];
						if($idnumber && $basket)
						{
							$query=mysqli_query($conn,"select * from department_registrar where idnumber='$idnumber'");
							$no=mysqli_num_rows($query);
							if($no==0)
							{
								echo"the admission number you provided is not registered in our database";
							}
							else
							{
								$update=mysqli_query($con,"update department_registrar set basket='$basket',clearance_status='2' where idnumber='$idnumber'");
								if($update)
								{
									$update2=mysqli_query($conn,"update student_details set clearance_status='2' where idnumber='$idnumber'");
									if($update2)
									{
										echo"you have successfully added item(s) to student with admission number $idnumber<br/><a href='registrarbasket.php'>View Basket</a>";
									}
									else
									{
										echo"student not successfully uncleared from the graduation list";
									}
								}
								else
								{
									echo"addition of items to student $idnumber not successful<br/><a href='registrarbasket.php'>Try Again</a>";
								}
							}
						}
						else
						{
							header("location:registrarhome.php");
						}
						?>
						</p>
                    </div>
                </div>
                <!-- /.row -->

            </div>
			<footer style="text-align:left;background-color:#000000;color:#FFFFFF;" class="navbar navbar-default navbar-fixed-bottom">
					<div style="text-align:center;" class="container-fluid">&copy; <?php echo date("Y");?> <a href=""><?php echo $title; ?></a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Design by <a href="<?php echo $website; ?>" target="_blank"><?php echo $developed; ?></a>.</div>
					</footer>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	
</body>

</html>