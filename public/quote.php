<?php
require("../includes/config.php");
//require("../includes/helpers.php");
if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quote"]);
    }

$stock=lookup(strtoupper(htmlspecialchars($_POST["symbol"])));
if($stock!=false)
{
    //in this case lookup actually returns an associative array containing three keys symbol, name and price...
    //so for rendering we will actually send the price value with 4 decimal places...
    $symbol=$stock["symbol"];
    $name=$stock["name"];
    $price=$stock["price"];
    $price=number_format($price,4);
    render("quote.php",["title"=>"Quote","symbol"=>$symbol,"name"=>$name,"price"=>$price]);
}
else
{
    apologize("The entered symbol is incorrect...");
}
?>
