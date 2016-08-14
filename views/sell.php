<?php
print ('<form class="form-group" action="sell.php" method="post">');
print ('<div class="form-group">');
print ('<select class="form-control" name="stocksToBeSold" class="form-control">');
$c=0;
foreach($rows as $row)
{
    $c+=1;
    //print('<option value="{$row["symbol"]}">{$row["symbol"]}</option>');
    print ('<option value='.$row["symbol"].'>'.$row["symbol"].'</option>');
}
print ('</select>');
print ('</div>');
print ('<div class="form-group">');
print ('<input class="form-control" value="Sell" type="submit"/>');
print ('</div>');
print ('</form>');
?>
