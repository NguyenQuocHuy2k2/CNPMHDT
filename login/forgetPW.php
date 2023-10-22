<link rel="stylesheet" type="text/css" href="styles.css">
<?php
require "../config.php";
require "../models/db.php";
require "../models/user.php";

$user = new User;
if(isset($_POST['submit'])){
    $username = $_GET['username'];
    
}
