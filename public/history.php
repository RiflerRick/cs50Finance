<?php
//so this is the controller history page, here we are gonna tell the user the basic details
require("../includes/config.php");
$row=CS50::query("SELECT * FROM History WHERE user_id=?",$_SESSION["id"]);
render("history.php",["rows"=>$row]);//render function will only be available if config.php of includes dir is required...
?>
