<?php
print ('<table class="table">');
//here we have rows coming into the picture and we can simply use rows as a variable thanks to render function defined in helpers.php
echo '<thead>';
echo '<tr>';
echo '<th style="text-align:center;">Transaction</th>';
echo '<th style="text-align:center;">Date/Time</th>';
echo '<th style="text-align:center;">Symbol</th>';
echo '<th style="text-align:center;">Shares</th>';
echo '<th style="text-align:center;">Price</th>';
echo '</tr>';
echo '</thead>';

foreach ($rows as $row)
{
    print ('<tr></tr>');
    print ('<td>'.$row["transaction"].'</td>');
    print ('<td>'.$row["date/time"].'</td>');
    print ('<td>'.$row["symbol"].'</td>');
    print ('<td>'.$row["shares"].'</td>');
    print ('<td>$'.$row["price"].'</td>');
    print ('</tr>');
}
print ('</table>');
?>
