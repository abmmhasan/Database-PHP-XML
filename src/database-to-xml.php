<?php 
$sql_type = "mysql";
$sql_host = "localhost";
$sql_port = "3306";
$sql_user = "root";
$sql_pw = "";
$sql_db = "parse_db";


$dbh = new PDO("{$sql_type}:dbname={$sql_db};host={$sql_host};port={$sql_port}", $sql_user, $sql_pw);

	 $employees = $dbh->prepare("SELECT * FROM `employees`");
   $employees->execute();
   
  $doc = new DOMDocument(); 
  $doc->formatOutput = true; 
   
  $r = $doc->createElement( "employees" ); 
  $doc->appendChild( $r ); 
   
  foreach( $employees as $employee ) { 
  
  $b = $doc->createElement( "employee" ); 
   
  $name = $doc->createElement( "name" ); 
  $name->appendChild($doc->createTextNode( $employee['name'])); 
  $b->appendChild( $name ); 
   
  $age = $doc->createElement( "age" ); 
  $age->appendChild($doc->createTextNode( $employee['age'])); 
  $b->appendChild( $age ); 
   
  $salary = $doc->createElement( "salary" ); 
  $salary->appendChild($doc->createTextNode( $employee['salary'])); 
  $b->appendChild( $salary ); 
   
  $r->appendChild( $b );
  } 
   
  echo $doc->saveXML(); 
  $doc->save("write.xml") 
  ?>
