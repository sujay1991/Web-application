<?php 
if(preg_match("/^[ A-Z 0-9]+/", $_REQUEST['search_code'])){
 $search_code=$_REQUEST['search_code'];
 if(preg_match("/^[  0-9]+/", $_REQUEST['search_age'])){
  $search_age=$_REQUEST['search_age'];
   if(preg_match("/^[  0-9]+/", $_REQUEST['search_race'])){
  $search_race=$_REQUEST['search_race'];
 
 $db= mysql_connect('omega.uta.edu','sxy4836','Simple1');
$mydb =mysql_select_db('sxy4836');


$sql ="SELECT National_Provider_ID, Avg (Length_of_Stay)as StayLength 
 FROM Hospital where Admitting_Diagnosis_Code ='$search_code' and Age = '$search_age'
 group by National_Provider_ID";
$records = mysql_query($sql);
}
}
}
// Print out rows
//$prefix = '';
// echo " {\n";
// $record = array();
$rows = array();
$flag = true;

$table = array();

$table['cols'] = array(
//i guess i need a loop through the first column to get all items and make them labels
    array('label' => 'National_Provider_ID', 'type' => 'string'),
    array('label' => 'StayLength', 'type' => 'number'),
  
);

$rows = array();
while($r = mysql_fetch_assoc($records)) {
    $temp = array();

$temp[] = array('v' => (string) $r['National_Provider_ID']); 
$temp[] = array('v' => (int) $r['StayLength']);

$rows[] = array('c' => $temp);
}

$table['rows'] = $rows;

$jsonTable = json_encode($table);

echo $jsonTable;
      
/*
echo "\"Patient\"";
echo ":[\n";
while ( $row = mysql_fetch_assoc( $records ) ) {
	$record[]= $row;
  echo $prefix . " {\n";
  echo '  "National_Provider_ID": ' . $row['National_Provider_ID'] . ',' . "\n";
  echo '  "StayLength": ' . $row['StayLength'] .''.  "\n";
   echo " },";

 //$prefix = ",\n";
  } echo "\n]";
echo $prefix . " }\n";  */
 //file_put_contents("demo.json", json_encode($record)); 
//  $string = file_get_contents("results.json");
// echo $string;


?>
