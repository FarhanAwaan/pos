<?php 
include('../connection.php');


		if(isset($_POST['itemid']) && $_POST['populate']=='populate'){
				$id = $_POST['itemid'];
			    $sql = "SELECT * FROM `items` where `id`='$id'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0)
				{	$array = array();
					while($row = mysqli_fetch_assoc($result))
					{
						$array['name'] = $row['name'];
						$array['date'] = $row['date'];
						$array['ostock'] = $row['old_stock'];
						$array['os_cprice'] = $row['old_stock_cprice'];
						$array['os_rprice'] = $row['old_stoct_price'];
						$array['nstock'] = $row['new_stock'];
						$array['ns_cprice'] = $row['new_stock_cprice'];
						$array['ns_rprice'] = $row['new_stoct_price'];
						$array['biid'] = $row['bike_id'];
						$array['coid'] = $row['company_id'];
						
					}
						echo json_encode($array,true);
						exit;
				}
		}
?>