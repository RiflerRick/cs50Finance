<?php

    // configuration
    require("../includes/config.php");

    //this is not gonna be the landing page of the application if the user is not logged in...
    //so if there is a session variable available then the index page is shown with respect to that session variable...

    // render portfolio
    $rows=CS50::query("SELECT * FROM Stocks WHERE user_id=?",$_SESSION["id"]);//getting all the rows of that person's quotes...
    if ($rows==false)
    {
        //apologize("You have not bought any stocks!!!");//apologize if no stocks have been bought...
        //in this case we will show the user the total money that he/she has...
        $val=CS50::query("SELECT cash FROM users WHERE id=?",$_SESSION["id"]);//in the users table we have id, not user_id
        render("portfolio.php",["title"=>"portfolio","cash"=>$val,"checkStock"=>0]);
    }
    $val=CS50::query("SELECT cash FROM users WHERE id=?",$_SESSION["id"]);
    $positions = [];
    foreach ($rows as $row)//here we are gonna take one each row separately...
    {
      //echo "displaying row: ".$row["symbol"];
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total"=>$row["shares"]*$stock["price"]
            ];
        }
    }
    //echo '<br>';
    //echo 'cash now:'.$val[0]["cash"];
    render("portfolio.php", ["title" => "Portfolio","positions"=>$positions,"cash"=>$val,"checkStock"=>1]);

?>
