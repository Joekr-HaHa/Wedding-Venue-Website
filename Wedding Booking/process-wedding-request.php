<?php
$c1=$_GET['c1'];
$c2=$_GET['c2'];
$c3=$_GET['c3'];
$c4=$_GET['c4'];
$c5=$_GET['c5'];
$min=$_GET['min'];
$max=$_GET['max'];
$date=$_GET['date'];
$endDate=$_GET['endDate'];
$username = "coa123wuser";
$password = "grt64dkh!@2FD";
$servername = "sci-mysql";
$dbname = "coa123wdb";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//sql query to be sent to server
$query = "SELECT  distinct venue.name,venue.capacity,catering.grade,licensed,catering.cost,venue.weekend_price,venue.weekday_price,COUNT(venue_booking.venue_id) AS popularity,
venue_booking.booking_date
FROM venue_booking LEFT JOIN venue ON venue_booking.venue_id=venue.venue_id LEFT JOIN catering ON catering.venue_id=venue.venue_id
WHERE venue_booking.booking_date>='".$date."' AND venue_booking.booking_date<='".$endDate."'
AND (catering.grade IN (SELECT catering.grade FROM catering WHERE catering.cost<".$c1." AND catering.grade=1)
OR catering.grade IN (SELECT catering.grade FROM catering WHERE catering.cost<".$c2." AND catering.grade=2)
OR catering.grade IN (SELECT catering.grade FROM catering WHERE catering.cost<".$c3." AND catering.grade=3)
OR catering.grade IN (SELECT catering.grade FROM catering WHERE catering.cost<".$c4." AND catering.grade=4)
OR catering.grade IN (SELECT catering.grade FROM catering WHERE catering.cost<".$c5." AND catering.grade=5))
AND venue.capacity<".$max." AND venue.capacity>".$min."
GROUP BY venue.name, venue.capacity,catering.grade,licensed,catering.cost,venue.weekend_price,venue.weekday_price,venue_booking.booking_date
ORDER BY COUNT(venue_booking.venue_id) DESC;";
$result=mysqli_query($conn,$query);
$allDataArray = array();
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {//results of query
   $allDataArray[] = $row;
}
echo json_encode($allDataArray);
?>