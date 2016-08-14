<?php
require("../includes/config.php");
//require("../include/helpers.php");
$userId=$_SESSION["id"];//user id stored...
if ($_SERVER["REQUEST_METHOD"] == "GET")//this means the user has not clicked sell button
    {


$rows=CS50::query("SELECT * FROM Stocks WHERE user_id=?",$userId);
if ($rows==false)
{
    apologize("You do not have any stocks to sell");

}
else
{
    render("sell.php",["title"=>"Sell","rows"=>$rows]);
}}
else//now it is a post request
{
    $value=$_POST["stocksToBeSold"];
    $rows=CS50::query("SELECT * FROM Stocks WHERE user_id=? AND symbol=?",$_SESSION["id"],$value);//getting all the rows of that person's quotes...
    $stock = lookup($value);
    //stock is actually an array...
    $row=CS50::query("UPDATE users SET cash = (cash + ?) WHERE id=?",$stock["price"]*$rows[0]["shares"],$_SESSION["id"]);
    $row=CS50::query("DELETE FROM Stocks where user_id=? AND symbol=?",$userId,$value);
    $row=CS50::query("INSERT INTO History (user_id,transaction,symbol,shares,price) VALUES(?,?,?,?,?)", $_SESSION["id"],"SELL",$value,$rows[0]["shares"],$stock["price"]);
    //The above code is actually updating the history table and letting us do our job...
    redirect("index.php");//redirect to the index page...
}
?>
