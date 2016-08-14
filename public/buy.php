<?php
require("../includes/config.php");
if ($_SERVER["REQUEST_METHOD"]=="GET")
{
    render("buy_form.php",["title"=>"Buy"]);
}
else
{
    if (isset($_POST["symbol"])&& isset($_POST["shares"]))
    {
        $check=preg_match("/^\d+$/",$_POST["shares"]);
        if ($check==true)
        {
          //echo 'shares type:'.gettype($_POST["shares"]);
          //echo '<br>';
          settype($_POST["shares"],"integer");
            if(true)
            {
                $symbol=strtoupper(htmlspecialchars($_POST["symbol"]));
                $stock=lookup($symbol);
                if($stock==false)
                {
                    apologize("No such stocks found");
                }
                else
                {
                    $price=$stock["price"];//remember $stock is an array of certain variables...
                    $row=CS50::query("UPDATE users SET cash=(cash-?) WHERE id=?",$price*$_POST["shares"],$_SESSION["id"]);//cash deducted
                    $row=CS50::query("INSERT INTO Stocks (user_id, symbol, shares) VALUES(?,?,?) ON DUPLICATE KEY UPDATE shares=shares+VALUES(shares)",$_SESSION["id"],$symbol,$_POST["shares"]);
                    $row=CS50::query("INSERT INTO History (user_id,transaction,symbol,shares,price) VALUES(?,?,?,?,?)", $_SESSION["id"],"BUY",$symbol,$_POST["shares"],$price);
                    //this inserts a new row in the History table, this table can be used later for retrieving the history of transactions of an individual...
                    redirect("index.php");
                }
            }
            else
            {
                apologize("invalid no of shares...");
            }
        }
        else
        {
            apologize("invalid no of shares...");
        }
    }
    else
    {
        apologize("No symbol enetered...");

    }
}
?>
