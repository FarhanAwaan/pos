<?php
    session_start();
    include('connection.php');
    if(isset($_POST)){
        $date=date('d-m-Y');
        date_default_timezone_set("Asia/Karachi");
        $time = date("h:i:sa");
        $data = rtrim($_POST['data'], '|');
        $dataRowArray = explode("|", $data);
        $dataItemsArray = array();
        $rows=count($dataRowArray);
        $bill_no=$dataRowArray[0];
        $cus_id=$dataRowArray[1];
        $cus_name=$dataRowArray[2];
        $cus_type=$dataRowArray[3];
        $iid;
        for($i = 4;$i < $rows;$i++)
        {
            $drow=explode(",", $dataRowArray[$i]);
    		for($j = 0;$j < count($drow);$j++)
    		{
        		$dataItemsArray[$i-4][$j] =$drow[$j]; 
        	}
    	}
    	$datarows=count($dataItemsArray);
    	for($i = 0;$i < $datarows;$i++)
    	{
            $iid=$dataItemsArray[$i][0];
            $sql="select * from items where id='$iid'";
            $result=$conn->query($sql);
            if($result ->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['id'];
                    $tstock = $row['total_stock'];
                    $ostock= $row['old_stock'];
                    $os_cprice = $row['old_stock_cprice'];
                    $os_rprice = $row['old_stoct_price'];
                    $nstock = $row['new_stock'];
                    $ns_cprice = $row['new_stock_cprice'];
                    $ns_rprice = $row['new_stoct_price'];
                }
                $needqty=$dataItemsArray[$i][2];
                $actualqty=$dataItemsArray[$i][2];
                if($needqty <= $ostock && $needqty <= $tstock)
                {
                    $sql1="UPDATE `items` SET `old_stock`=old_stock-$needqty,`total_stock`=total_stock-$needqty WHERE id='$id' ";
                }
                else if($needqty > $ostock && $needqty <= ($ostock+$nstock) && $needqty <= $tstock)
                {
                    $needqty=$needqty-$ostock;
                    $sql1="UPDATE `items` SET `old_stock`='0',`new_stock`=new_stock-$needqty, `total_stock`=total_stock-$actualqty WHERE id='$id' ";
                }
                
                $result1=$conn->query($sql1);
                if($result1 > 0)
                {
                    $price11=$dataItemsArray[$i][3];
                    $discount=$dataItemsArray[$i][5];
                    if($cus_type == 'retail')
                    {
                        $sql2="INSERT INTO `retail_sell`(`name`, `item_id`, `invoice_no`, `qty`, `price`, `discount`, `date`) VALUES
                        ('$cus_name','$iid','$bill_no','$actualqty','$price11','$discount','$date')";
                    }
                    else if($cus_type == 'labour')
                    {
                        $sql2="INSERT INTO `labour_sell`(`labour_id`, `item_id`, `invoice_no`, `qty`, `price`, `discount`, `commission`, `date`) VALUES
                        ('$cus_id','$iid','$bill_no','$actualqty','$price11','$discount','$cus_name','$date')";
                    }
                    else if($cus_type == 'wholesale')
                    {
                        $sql2="INSERT INTO `vendor_sell`( `customer_id`, `item_id`, `invoice_no`, `qty`, `price`, `discount`, `date`, `time`) VALUES 
                        ('$cus_id','$iid','$bill_no','$actualqty','$price11','$discount','$date','$time')";
                        
                        $totl=($price11*$actualqty)-$discount;
                        $sql3="UPDATE `customer` SET `pending_amount`=pending_amount+$totl WHERE `id`='$cus_id'";
                        $result3=$conn->query($sql3);
                        if($result3 > 0)
                        {
                            echo "11111";
                        }
                    }
                    
                    $result2=$conn->query($sql2);
                    if($result2 > 0)
                    {
                        echo "okkkkkkk";
                    }
                }
                else
                {
                    
                }
            }
            else
            {
                echo "error2";
            }
    	}
    	
    	    // ================   For Maintain Stocks(Start)   ====================
    
    
    $sql = "SELECT * from `items`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $id = $row['id'];
            $name = $row['name'];
            $tstock = $row['total_stock'];
            $ostock= $row['old_stock'];
            $os_cprice = $row['old_stock_cprice'];
            $os_rprice = $row['old_stoct_price'];
            $nstock = $row['new_stock'];
            $ns_cprice = $row['new_stock_cprice'];
            $ns_rprice = $row['new_stoct_price'];
            
            if($ostock != 0 && $nstock != 0)
            {
                
            }
            else if($ostock == 0 && $nstock != 0)
            {
                // get new save in old and get for new from stock
                
                $trprice =0;
                $tcprice =0;
                $qty =0;
                $de=false;
                $sql6="SELECT * FROM `stock` WHERE `item_id`='$id' LIMIT 1";
                $result6 = $conn->query($sql6);
                if ($result6->num_rows > 0)
                {
                    while($row6 = mysqli_fetch_assoc($result6))
                    {
                        $sid =$row6['id'];
                        $trprice =$row6['rprice'];
                        $tcprice =$row6['cprice'];
                        $qty =$row6['qty'];
                        $de=true;
                    } 
                }
                $sql7="UPDATE `items` SET `old_stock`=new_stock,`old_stoct_price`=new_stoct_price,`old_stock_cprice`=new_stock_cprice,
                `new_stock`='$qty',`new_stoct_price`='$trprice',`new_stock_cprice`='$tcprice' where `id` = '$id'";
                $result7 = $conn->query($sql7);
                if($result7 > 0)
                {
                    if( $de == true)
                    {
                        $dlt2="DELETE FROM `stock` WHERE `id`='$sid'";
                        $resultd2 = $conn->query($dlt2);
                        if($resultd2 > 0)
                        {
                            
                        }
                        else
                        {
                            echo "7";
                        }
                    }
                }
                else
                {
                    echo "6";
                }
            }
            else if($ostock == 0 && $nstock == 0)
            {
                // both get from stock store in new and old
                $sql3="SELECT * FROM `stock` WHERE `item_id`='$id' LIMIT 2";
                $result3 = $conn->query($sql3);
                $count=0;
                if ($result3->num_rows > 0)
                {
                    while($row3 = mysqli_fetch_assoc($result3))
                    {
                        $sid[$count]=$row3['id'];
                        $trprice[$count]=$row3['rprice'];
                        $tcprice[$count]=$row3['cprice'];
                        $qty[$count]=$row3['qty'];
                        $count++;
                    }
                    
                    $sql4="UPDATE `items` SET `old_stock`='$qty[0]',`old_stoct_price`='$trprice[0]',`old_stock_cprice`='$tcprice[0]' where `id` = '$id'";
                    $result4 = $conn->query($sql4);
                    if($result4 > 0)
                    {
                        
                    }
                    else
                    {
                        echo "3";
                    }
                    
                    $sql5="UPDATE `items` SET `new_stock`='$qty[1]',`new_stoct_price`='$trprice[1]',`new_stock_cprice`='$tcprice[1]' where `id` = '$id'";
                    $result5 = $conn->query($sql5);
                    if($result5 > 0)
                    {
                        
                    }
                    else
                    {
                        echo "2";
                    }
                    
                    $dlt1="DELETE FROM `stock` WHERE `id` IN ('$sid[0]','$sid[1]')";
                    $resultd1 = $conn->query($dlt1);
                    if($resultd1 > 0)
                    {
                        
                    }
                    else
                    {
                        echo "5";
                    }
                }
                
            }
            else if($ostock != 0 && $nstock == 0)
            {
                // get from stock for new 
                $sql1="SELECT * FROM `stock` WHERE `item_id`='$id' LIMIT 1";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0)
                {
                    while($row1 = mysqli_fetch_assoc($result1))
                    {
                        $sid = $row1['id'];
                        $trprice=$row1['rprice'];
                        $tcprice=$row1['cprice'];
                        $qty=$row1['qty'];
                    }
                    $sql2="UPDATE `items` SET `new_stock`='$qty',`new_stoct_price`='$trprice',`new_stock_cprice`='$tcprice' where `id` = '$id'";
                    $result2 = $conn->query($sql2);
                    if($result2 > 0)
                    {
                        $dlt="DELETE FROM `stock` WHERE `id`='$sid'";
                        $resultd = $conn->query($dlt);
                        if($resultd > 0)
                        {
                            
                        }
                        else
                        {
                            echo "4";
                        }
                    }
                    else
                    {
                        echo "1";
                    }
                }
            }
        }
    }
     // ================   For Maintain Stocks(End)   ====================
    }
?>