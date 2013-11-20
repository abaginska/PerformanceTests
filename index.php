<?php
$order_id = $_GET['id'];

$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    header("HTTP/1.1 500 Internal Server Error");
}
echo 'Connected successfully <br />';

$db_selected = mysql_select_db('orders', $link);
if (!$db_selected) {
    header("HTTP/1.1 500 Internal Server Error");
}
echo 'Database selected <br />';

$sql = "select * from orders_products x join products y on x.product_id = y.id where x.order_id = $order_id";
$result = mysql_query($sql);

echo "<table border='1'>
<tr>
<th>name</th>
<th>amount</th>
<th>unit_price</th>
<th>total</th>
</tr>";

$total = 0;

while($row = mysql_fetch_array($result))
  {
  $tot = $row['amount'] * $row['unit_price'];
  
  echo "<tr>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['amount'] . "</td>";
  echo "<td>" . $row['unit_price'] . "</td>";
  echo "<td>" . $tot . "</td>";
  echo "</tr>";
  
  $total += $tot;
  }
  
echo "<tr><td> </td><td> </td><td> </td><td>$total</td></tr>";
echo "</table>";
?>

       