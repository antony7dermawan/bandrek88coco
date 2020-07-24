<?php
try
{
  $conn = new PDO( "sqlsrv:Server=ASUSZENBOOK13\SQLEXPRESS,49678;Database=es_payroll", "antony", "1234");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  }
  catch(Exception $e)
  {
  die( print_r( $e->getMessage() ) );
}
?>
