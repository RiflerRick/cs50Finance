<!--<div>
    <iframe allowfullscreen frameborder="0" height="315" src="https://www.youtube.com/embed/oHg5SJYRHA0?autoplay=1&iv_load_policy=3&rel=0" width="420"></iframe>
</div>-->
<?php
if ($checkStock==1){
$pos=$positions;

echo '<table class="table">';
echo '<thead>';
echo '<tr>';
echo '<th style="text-align:center;">Symbol</th>';
echo '<th style="text-align:center;">Name</th>';
echo '<th style="text-align:center;">Shares</th>';
echo '<th style="text-align:center;">Price</th>';
echo '<th style="text-align:center;">Total</th>';
echo '</tr>';
echo '</thead>';

foreach($pos as $row)
{
    echo '<tr>';
    print ('<td>'.$row["symbol"].'</td>');//this is an example of variable interpolation...
    print ('<td>'.$row["name"].'</td>');//this variable($positions) will be available to us because we are actually doing this using render and
    //recall has an extract function that does this work...
    print ('<td>'.$row["shares"].'</td>');
    print ('<td>'.$row["price"].'</td>');
    print ('<td>'.$row["total"].'</td>');
    echo '</tr>';
}

echo '<tr>';
print ('<td>CASH</td>');//this is an example of variable interpolation...
print ('<td></td>');//this variable($positions) will be available to us because we are actually doing this using render and
//recall has an extract function that does this work...
print ('<td></td>');
print ('<td></td>');
print ('<td>'.$cash[0]["cash"].'</td>');
echo '</tr>';
echo '</table>';
}
else
{
    //echo $cash[0];
    print ('<table class="table">');
    echo '<tr>';
    print ('<td>CASH</td>');//this is an example of variable interpolation...
    print ('<td></td>');//this variable($positions) will be available to us because we are actually doing this using render and
    //recall has an extract function that does this work...
    print ('<td></td>');
    print ('<td>'.$cash[0]["cash"].'</td>');
    echo '</tr>';
    print ('</table>');
}

?>
