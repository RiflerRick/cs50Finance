<?php
//here we will use a very interesting function of php called extract(), remember this function very nicely because it is really useful
//when we call the render function from quote.php we actually pass to this function a few values because the render function of
//helpers.php actually calls the extract function and so we can now use those values...

print ("Symbol: ".$symbol);//these three values are actualy available now...
print ('<br>');
print ("Name: ".$name);
print ('<br>');
print ("Price: ".$price);
?>
