<?php include('../includes/config.php'); checkadminlogin(); checkadminroles('reports');

	function exportMysqlToCsv($queryrws, $filename)
	{
		global $db;
		$csv_terminated = "\n";
		$csv_separator = ",";
		$csv_enclosed = '"';
		$csv_escaped = "\\";   
	 
		// Gets the data from the database
		
		//$con2 = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
		$result = $db->query($queryrws);
		$count = $result->num_rows;
		$rsforname = $db->getRecordSet($queryrws);
		$fields_cnt = mysqli_num_fields($rsforname);		
		
		$schema_insert = '';
	 	$fieldname = array();
		for ($i = 0; $i < $fields_cnt; $i++)
		{
			$fetchfield = mysqli_fetch_field_direct($rsforname, $i);
			$l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed,
				stripslashes($fetchfield->name)) . $csv_enclosed;				
			$schema_insert .= $l;
			$schema_insert .= $csv_separator;
			$fieldname[$i]=$fetchfield->name;
		} // end for
	 
		$out = trim(substr($schema_insert, 0, -1));
		$out .= $csv_terminated;
	 
		// Format the data
		$rsrecord = $result->rows;
		foreach ($rsrecord as $key=>$row)
		{
			$schema_insert = '';
			
			/*print("<pre>");
			print_r($row);
			print("</pre>");*/
			
			for ($j = 0; $j < $fields_cnt; $j++)
			{
			//	echo $fieldname[$j];
				if ($row[$fieldname[$j]] == '0' || $row[$fieldname[$j]] != '')
				{
					
					
	 
					if ($csv_enclosed == '')
					{
						$schema_insert .= $row[$fieldname[$j]];
					} else
					{
						$schema_insert .= $csv_enclosed . 
						str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row[$fieldname[$j]]) . $csv_enclosed;
					}
				} else
				{
					$schema_insert .= '';
				}
	 
				if ($j < $fields_cnt - 1)
				{
					$schema_insert .= $csv_separator;
				}
			} // end for
	 
			$out .= $schema_insert;
			$out .= $csv_terminated;
		} // end while
		
		/*echo $out;		
	 	die();*/
	 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Length: " . strlen($out));
		// Output to browser with appropriate mime type, you choose ;)
		header("Content-type: text/x-csv");
		//header("Content-type: text/csv");
		//header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=$filename");
		echo $out;
		exit;
	 
	}
	
	$nquery = "";
	
	$start_date = $_GET["start_date"];
	$end_date = $_GET["end_date"];
	$parent_id = $_GET["parent_id"];
	
	$order_status = $_GET["order_status"];
	
	if($_GET["start_date"]!="") { $nquery .= " AND journey_date='$start_date' "; }	
	if($_GET["start_date"] && $_GET["end_date"]!="") { $nquery .= " AND journey_date BETWEEN '$start_date' AND '$end_date' "; }
	if($_GET["parent_id"]!="") { $nquery .= " AND service_id='$parent_id' "; }	
	
	if($_GET["order_status"]!="") { $nquery .= " AND order_status='$order_status' "; }	
		
	$query="SELECT order_id, order_reference_number, customer_name, email, mobile, `from`, `to`, journey_date, start_time, end_time, pickup_point, drop_point, package_price, quantity, totalamount, order_status FROM `ss_consumer_order` WHERE order_id > 0 ".$nquery."  group by order_id ORDER BY dateoforder ASC";
	
	//$query="SELECT order_id, order_reference_number, customer_name, email, mobile, `from`, `to`, journey_date, start_time, end_time, pickup_point, drop_point, package_price, quantity, totalamount, ( CASE WHEN order_status=0 THEN 'Pending' WHEN order_status=1 THEN 'Paid' WHEN order_status=2 THEN 'Cancelled' ELSE 'Failed' END) as order_status FROM `ss_consumer_order` WHERE order_id > 0 ".$nquery."  group by order_id ORDER BY dateoforder ASC";
	
	$filename = 'MDV_Order_Data_'.mt_rand(10000,99999)."-".date("d-m-y").'.csv';		
	exportMysqlToCsv($query, $filename);	
	

?>