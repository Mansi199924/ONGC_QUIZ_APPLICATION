![image](https://github.com/Mansi199924/ONGC_QUIZ_APPLICATION/assets/51586639/f6724c72-c6bf-4600-943e-08393034b41e)

########To Run
create a new database named "quiz" and then import the quiz.sql file

enter your database login info in  database.php as follows:-
	<?php
		$con= new mysqli('localhost','username','password','database name')or die("Could not connect to mysql".mysqli_error($con));
	?>
Example
	<?php
		$con= new mysqli('localhost','root','','quiz')or die("Could not connect to mysql".mysqli_error($con));
	?>	


########Default Admin Password
email=admin@gmail.com
password=admin

########

