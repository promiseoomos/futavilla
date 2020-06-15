 <?php
  // This is a database connect _included_file
  //echo "me is good";

  $db = "futa_villa";
  $host = "localhost";
  $user =  "promise";
  $password = "promzy31258";

  $conn = mysqli_connect($host,$user,$password);

  if(!$conn){
    die('could not connect to MySql' . mysqli_error());
  }
  //echo "connected succesfully";
  $db_conn = mysqli_select_db($conn,$db);
  if(!$db_conn){
    die('could not connect to database' . mysql_error());
  }
  //echo "Connected succesfully to database";

 ?>
