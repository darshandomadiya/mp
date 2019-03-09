<?php
$username="root";
$password="";
$database="map_test";

$connection=mysqli_connect ('localhost', $username, $password,$database);
if (!$connection) {
  die('Not connected : ' . mysqli_error());
}

$userFilter = $_REQUEST['userFilter'];
$where = '';
if($userFilter!=''){
   $where = " and type='$userFilter'";
}
$query = "SELECT * FROM markers WHERE 1 $where";
$result = mysqli_query($connection,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$data = array();
$ind=0;
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  $data[] = array($row['name'],$row['lat'],$row['lng'],$ind);  
  $ind = $ind + 1;
}
echo json_encode($data);

?>