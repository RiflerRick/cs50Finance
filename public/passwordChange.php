<?php
require("../includes/config.php");
if($_SERVER["REQUEST_METHOD"]=="GET")
render("passwordChangeForm.php",["title"=>"Change your password"]);
// so first we render the form...
else{
//now we need to check a few things first...
$curPassword=$_POST["currentPassword"];
$curPassword=htmlspecialchars($curPassword);
$newPassword=$_POST["newPassword"];
$newPassword=htmlspecialchars($newPassword);
$confNewPassword=$_POST["confNewPassword"];
$confNewPassword=htmlspecialchars($confNewPassword);

//if we are not sure about the existence of the function hash_equals we can write the following if block so that the function is used even if it does not exist..

if(!function_exists('hash_equals')) {
  function hash_equals($str1, $str2) {
    if(strlen($str1) != strlen($str2)) {
      return false;
    } else {
      $res = $str1 ^ $str2;
      $ret = 0;
      for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
      return !$ret;
    }
  }
}


$row=CS50::query("SELECT hash FROM users WHERE id=?",$_SESSION["id"]);

if (hash_equals($row[0]["hash"],crypt($curPassword,$row[0]["hash"])))//this is the technique of checking if crypt function is used...
{
    if($newPassword==$confNewPassword)
    {
        $passHash=crypt($newPassword);
        $row=CS50::query("UPDATE users SET hash=? WHERE id=?",$passHash,$_SESSION["id"]);
        if ($row!=false)
        {

            //print ("<p><b>password successfully changed...</b></p>");
            redirect("index.php");
        }
        else
        {
            apologize("could not change password...");
        }

    }
    else
    {
        apologize("Your new password and confirmed password do not match...");
        render("passwordChangeForm.php",["title"=>"Change your password"]);
    }
}
else
{
    apologize("Please enter your current password correctly...");
    render("passwordChangeForm.php",["title"=>"Change your password"]);
}}
?>
