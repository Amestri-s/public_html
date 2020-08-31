<?php 



/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'scfrdata');
define('DB_PASSWORD', 'scfrdata');
define('DB_NAME', 'scfrdata');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$result = mysqli_query($link, "DELETE FROM new WHERE id=$id");
 
//redirecting to the display page (index.php in our case)
header("Location:approval.php");