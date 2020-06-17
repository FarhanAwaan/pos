<?php
    session_start();
    include('connection.php');
    if(isset($_POST))
    {
    $error=false;
    $date = date('d-m-Y');
    $data =$_POST['data'];
    $dataa = explode("|", $data);
    // print_r($dataa);
    
        $qty=$dataa[5];
        $cprice=$dataa[6];
        $rprice=$dataa[7];
        $date = date('d-m-Y');
        
        $sql1 = "SELECT * FROM `items` WHERE `bike_id`='$dataa[3]' AND `company_id`='$dataa[4]' AND `name`='$dataa[2]'";
        $result1 = $conn->query($sql1);
        if($result1 ->num_rows > 0)
        {
            $row = mysqli_fetch_assoc($result1);
            $id=$row['id'];
            $ostock = $row['old_stock'];
            $os_cprice = $row['old_stock_cprice'];
            $os_rprice = $row['old_stoct_price'];
            $nstock = $row['new_stock'];
            $ns_cprice = $row['new_stock_cprice'];
            $ns_rprice = $row['new_stoct_price'];
            // print_r($row);
            if($ostock == 0)
            {
                $sql2="UPDATE `items` SET `old_stock`='$qty',`old_stoct_price`='$rprice',`total_stock`='$qty',`old_stock_cprice`='$cprice' WHERE `id` ='$id'";
            }
            else if($os_cprice == $cprice && $os_rprice == $rprice)
            {
                $sstock=($ostock+$qty);
                $sql2="UPDATE `items` SET `old_stock`='$sstock',`old_stoct_price`='$rprice',`total_stock`=total_stock+$qty,`old_stock_cprice`='$cprice' WHERE `id` ='$id'";
            }
            else if($nstock == 0)
            {
                $sql2="UPDATE `items` SET `new_stock`='$qty',`new_stoct_price`='$rprice',`total_stock`=total_stock+$qty,`new_stock_cprice`='$cprice' WHERE `id` ='$id'";
            }
            else if($ns_cprice == $cprice && $ns_rprice == $rprice)
            {
                $sstock=($nstock+$qty);
                $sql2="UPDATE `items` SET `new_stock`='$sstock',`new_stoct_price`='$rprice',`total_stock`=total_stock+$qty,`new_stock_cprice`='$cprice' WHERE `id` ='$id'";
            }
            else
            {
                $sql2="UPDATE `items` SET `total_stock`=total_stock+$qty WHERE `id` ='$id'";
                $sql3="INSERT INTO `stock`(`item_id`, `qty`, `cprice`, `rprice`, `date`) VALUES ('$id','$qty','$cprice','$rprice','$date')";
                $result3 = $conn->query($sql3);
                if($result3 > 0)
                {
                    
                }
                else
                {
                    $error=true;
                    echo "An Unknown Error Occurred";
                }
            }
            $result2 = $conn->query($sql2);
            if($result2 > 0)
            {
                
            }
            else
            {
                $error=true;
                echo "noo";
            }
            
        }
        else
        {
            $sql11="INSERT INTO `items`(`name`, `bike_id`, `company_id`, `date`, `old_stock`, `old_stoct_price`, `new_stock`, `new_stoct_price`, `total_stock`,
            `old_stock_cprice`, `new_stock_cprice`) VALUES ('$dataa[2]','$dataa[3]','$dataa[4]','$date','$dataa[5]','$dataa[7]','0','0','$dataa[5]','$dataa[6]','0')";
            $result11=$conn->query($sql11);
            if($result11 > 0)
            {
                $id=$conn->insert_id;
            }
            else
            {
                $error=true;
                echo "An Unknown Error Occurred";
            }
        }
        
        $sql12="INSERT INTO `buy_items`(`item_id`, `vendor_id`, `qty`, `retail_price`, `cost_price`, `date`,`invoice_no`) VALUES
        ('$id','$dataa[1]','$dataa[5]',$dataa[7],'$dataa[6]','$date','$dataa[0]')";
        $result13=$conn->query($sql12);
        if($result13 > 0)
        {
            echo "true";
        }
        else
        {
            $error=true;
            echo "An Unknown Error Occurred";
        }
        
    }
    
?>