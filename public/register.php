<?php

    // configuration
    require("../includes/config.php");
    //require("../includes/helpers.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);//this is actually a scenario where somehow the user got redirected to this page...
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_POST["username"])|| isset($_POST["password"]))
        {
            //this means that the username and password fields are not blank...

            if($_POST["password"]==$_POST["confirmation"])
            {
                //now it apparently seems everything has gone right...
                $result=CS50::query("SELECT * FROM users WHERE username=?",htmlspecialchars($_POST["username"]));
                if ($result!=false)
                {
                  apologize("This username already exists...Try another one...");
                  //sleep(2);//sleep or simply delay by 2 seconds...
                  //render("register_form.php", ["title" => "Register"]);
                }
                $result=CS50::query("INSERT INTO users(username,hash,cash) VALUES (?,?,10000.0000)",htmlspecialchars($_POST["username"]),crypt(htmlspecialchars($_POST["password"])));
                /*the above function will actually be able to insert a row with these values inside the users table...crypt() is a php function
                that essentially can return a hashed version of the string passed into it...*/
                if ($result==false)
                {
                    apologize("You are already registered, log in instead...");
                }
                else
                {
                    //this means the new user has actually gone inside the database and is now ready to actually start off...
                    $row=CS50::query("SELECT LAST_INSERT_ID() AS id");
                    $id=$row[0]["id"];
                    $_SESSION["id"]=$id;
                    redirect("index.php");
                }
            }
            else
            {
                apologize("Passwords do not match!!!");//apologize is a function in helpers.php
            }
        }
        else
        {
            apologize("username or password cannot be left blank");
        }
    }

?>
