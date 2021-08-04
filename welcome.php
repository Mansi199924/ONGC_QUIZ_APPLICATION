<?php
    include_once 'database.php';
    session_start();
    if(!(isset($_SESSION['email'])))
    {
        header("location:login.php");
    }
    else
    {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        include_once 'database.php';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ONGC Quiz System</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link  rel="stylesheet" href="css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="css/welcome.css">
    <link  rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"  type="text/javascript"></script>
    <script type="text/javascript">
var ss = 60;

function countdown() {
ss = ss-1;

if (ss<0) {
    document.getElementById('abhilash').click();
}
else {
document.getElementById("countdown").innerHTML=ss;
window.setTimeout("countdown()", 1000);
}
}
</script>
    <style>
@media screen and (max-width: 600px) {
  .col-md-12 {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}
</style>
</head>
<body style=" background-color:#4c0000" onload="countdown()">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">ONGC QUIZ SYSTEM</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		<li <?php if(@$_GET['q']==1) echo'class="active"'; ?> class="nav-item active">
        <a class="nav-link" href="welcome.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a>
      </li>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
        <li <?php echo''; ?> > <a href="logout.php?q=welcome.php" style="color:black;"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Log out</a></li>
        </ul>
	  </div>
</nav>
    <br><br>
    <div class="container">
        <div class="row">
                <?php if(@$_GET['q']==1) 
                {
                    $qu = "SELECT * FROM quiz ";
                    $re = mysqli_query($con, $qu);
                    $ro = mysqli_fetch_array($re, MYSQLI_ASSOC);
                    if(! $ro) {
                        echo '<h1 style="color:white;font-size:40px;text-shadow:5px 5px 5px black;">No Quiz Available</h1>';
                    } 
                    else {
                    $result = mysqli_query($con,"SELECT * FROM quiz WHERE `status`='enabled' ORDER BY date DESC ") or die('Error');
                    $c=1;
                    while($row = mysqli_fetch_array($result)) {
                        $title = $row['title'];
                        $total = $row['total'];
                        $timelimit=$row['timelimit'];
                        $eid = $row['eid'];
                    $q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
                    $rowcount=mysqli_num_rows($q12);	
                    if($rowcount == 0){
                $c++;
                echo'
				<div class="col-12 col-sm-6 col-md-4">
				<div class="card mx-2 my-2" href="google.com">
						<div class="card-body">
							<h4><b>'.$title.'</b></h4> 
							<p>Number Of Questions: '.$total.'</p>
							<p>Max Marks:'.$total.' </p>
							<p>Time Limit:'.$timelimit.' </p>

							
							<p><a href="takequiz.php?q=quiz&eid='.$eid.'&timelimit='.$timelimit.'" class="btn sub1" style="color:black;margin:0px;background:#cccccc"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></p>
						</div>
					</div>
					</div>';
                    }
                    else
                    {
                        $c++;
                        echo'<div class="col-12 col-sm-6 col-md-4">
						<div class="card mx-2 my-2" href="google.com">
                        <div class="card-body">
                          <h4><b>'.$title.'</b></h4> 
                          <p>Number Of Questions: '.$total.'</p>
                          <p>Max Marks:'.$total.' </p>
                          <p>Time Limit:'.$timelimit.' </p>
                          <p style=" font-weight: bold;">You have already given this quiz</p>
                        </div>
                      </div>
					  </div>';
                }
                    }
                    $c=0;
                    echo '</table></div>';
                }}?>


                <?php
                    if(@$_GET['q']== 'result' && @$_GET['eid']) 
                    {
                        echo '<h1 style="color:white; font-size:40px;text-shadow:5px 5px 5px black;" ><i>YOUR ANSWERS ARE SUBMITTED!!</i></h1>';
                    }
                ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>                
</body>
</html>