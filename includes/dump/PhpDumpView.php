<?php 
$mode = $_GET['method'];
$tables = '*';
include('../db_connect.php');
$passcode = 'No PassCode';
$Id = null;
$query1 = "Select * from DataBackUp;";
		$rset = mysql_query($query1,$con);
			while ($row = mysql_fetch_array($rset, MYSQL_NUM)) {
				$Id =($row[0]);
				$passcode =($row[1]);
			}
    switch ($mode) {
    case $passcode:
  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $result = mysql_query("select `table_name` from information_schema.tables where table_schema = '".$databasename."' and table_type = 'View';",$con);
    while($row = mysql_fetch_row($result))
    {
      $tables[] = $row[0];
    }
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
  
  //cycle through
  foreach($tables as $table)
  {
    $result = mysql_query('SELECT * FROM '.$table,$con);
    $num_fields = mysql_num_fields($result);
    
    $return.= 'DROP TABLE '.$table.';';
    $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table,$con));
    $return.= "\n\n".$row2[1].";\n\n";
    
    /*for ($i = 0; $i < $num_fields; $i++) 
    {
      while($row = mysql_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) 
        {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = ereg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
          if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    }*/
    $return.="\n\n\n";
  }


  echo $return;
    break;
	default:
      {
	  	  // email Flailing Robot Yelling 'DANGER WILL ROBINSON DANGER'
        echo "bad code";
		$newpasscode = hash(sha256, $passcode);
		mysql_query("update DataBackUp SET PassCode = '".$newpasscode."' WHERE Id = ".$Id,$con);
	  }
break;
}

?>