<?php
$sql_type = "mysql";
$sql_host = "localhost";
$sql_port = "3306";
$sql_user = "root";
$sql_pw = "";
$sql_db = "parse_db";


$dbh = new PDO("{$sql_type}:dbname={$sql_db};host={$sql_host};port={$sql_port}", $sql_user, $sql_pw);
 

$xmlDoc = new DOMDocument();
$xmlDoc->load("info.xml");
 
$employees = $xmlDoc->getElementsByTagName( "employee" ); 
//$itemCount = $employees->length;
foreach( $employees as $employee ) 
{ 
  $names = $employee->getElementsByTagName( "name" ); 
  $name = $names->item(0)->nodeValue; 
   
  $ages= $employee->getElementsByTagName( "age" ); 
  $age= $ages->item(0)->nodeValue; 
   
  $salaries = $employee->getElementsByTagName( "salary" ); 
  $salary = $salaries->item(0)->nodeValue; 
  
   $sql = $dbh->prepare("INSERT INTO `employees` (`name`, `age`, `salary`) VALUES (?, ?, ?)");
   $sql->execute(array( $name, $age, $salary ));  
  echo "<b>$name - $age - $salary\n</b><br>"; 
  }
?>
