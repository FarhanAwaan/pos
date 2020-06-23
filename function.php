<?php
//    session_start();
    include('connection.php');
    include('master/session.php');
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
        
if(isset($_POST['signin']))
    {
        $password = $_POST['password'];
        $uname = $_POST['email'];
        $qry = "select * from login where password='$password' and email='$uname'";
        // $result = $conn->query($qry);
        $result = mysqli_query($conn,$qry);
        // if($result->num_rows > 0 )
        // print_r(mysqli_fetch_assoc($result)); exit;
        if( mysqli_num_rows($result) > 0 )
        {
            while($row = mysqli_fetch_assoc($result))
             {
              $uid = $row['id'];
              $roleText = $row['role'];
             }

            $_SESSION["uid"] = $uid;
            $_SESSION["role"] = $roleText;
            $_SESSION['loggedin'] = true;
            
                // echo "<script>window.open('index.php','_self');</script>";
            header("Location: index.php");
            
        }
        else 
        {
            // echo "<script>window.open('login.php','_self'); alert('Sorry Login Failed!');</script>";
            header("Location: login.php");
        }
    } 
        
        
    if(isset($_GET['logout'])) 
    {
        session_destroy();
        unset($_SESSION['uemail']);
        unset($_SESSION['uid']);
        unset($_SESSION['loggedin']);
        // echo "<script>window.open('login.php','_self'); alert('Logout Sucessfull');</script>";
        // echo "<script>window.open('login.php','_self'); </script>";
        header("Location: login.php");
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
    
    if(isset($_POST['add_bike']))
    {
      
        $name = $_POST['name'];
        $date = date('d-m-Y');
          
        $sql = "INSERT INTO `bike`(`name`, `date`) VALUES ('$name','$date')";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('addbike.php?success=Bike added Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('addbike.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }   

    if(isset($_POST['add_expenditure']))
    {
      
        $name = $_POST['name'];
        $date = $_POST['date'];
        $amount = $_POST['amount'];
          
        $sql = "INSERT INTO `expenditure`(`name`,`amount`, `date`) VALUES ('$name','$amount','$date')";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('addexpenditure.php?success=Expenditure added Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('addexpenditure.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }   


    if(isset($_POST['add_company']))
    {
      
        $name = $_POST['name'];
        $date = date('d-m-Y');
          
        $sql = "INSERT INTO `company`(`name`, `date`) VALUES ('$name','$date')";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('addcompany.php?success=Company added Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('addcompany.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    if(isset($_POST['add_customer']))
    {
      
        $name = $_POST['name'];
        $address = $_POST['address'];
        $shopname = $_POST['shopname'];
        $number2 = $_POST['number2'];
        $number1 = $_POST['number1'];
        $date = date('d-m-Y');
        $pending=0;
          
        $sql = "INSERT INTO `customer`(`name`, `pending_amount`, `date`, `shop_name`, `address`, `number1`, `number2`) VALUES
        ('$name','$pending','$date','$shopname','$address','$number1','$number2')";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('addcustomer.php?success=customer added Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('addcustomer.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    
    if(isset($_POST['add_labour']))
    {
      
        $name = $_POST['name'];
        $address = $_POST['address'];
        $number2 = $_POST['number2'];
        $number1 = $_POST['number1'];
        $date = date('d-m-Y');
        $pending=0;
          
        $sql = "INSERT INTO `labour`(`name`, `date`, `address`, `contact1`, `contact2`) VALUES
        ('$name','$date','$address','$number1','$number2')";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('addlabour.php?success=Labour added Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('addlabour.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    if(isset($_POST['add_vendor']))
    {
      
        $name = $_POST['name'];
        $address = $_POST['address'];
        $shopname = $_POST['shopname'];
        $number2 = $_POST['number2'];
        $number1 = $_POST['number1'];
        $date = date('d-m-Y');
          
        $sql = "INSERT INTO `vendor`(`name`,`date`, `shop_name`, `address`, `number1`, `number2`) VALUES
        ('$name','$date','$shopname','$address','$number1','$number2')";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('addvendor.php?success=Vendor added Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('addvendor.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    
    if(isset($_POST['add_item']))
    {
      
        $name = $_POST['name'];
        $bike = $_POST['bike'];
        $company = $_POST['company'];
        $qty = $_POST['qty'];
        $cprice = $_POST['cprice'];
        $rprice = $_POST['rprice'];
        $date = date('d-m-Y');
          
        $sql = "INSERT INTO `items`(`name`, `bike_id`, `company_id`, `date`, `old_stock`, `old_stoct_price`, `new_stock`, `new_stoct_price`, `total_stock`, `old_stock_cprice`,
        `new_stock_cprice`) VALUES ('$name','$bike','$company','$date','$qty','$rprice','0','0','$qty','$cprice','0')";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            $last_id = $conn->insert_id;
            $sql1 = "INSERT INTO `buy_items`(`item_id`, `qty`, `retail_price`, `cost_price`, `date`) VALUES
            ('$last_id','$qty','$rprice','$cprice','$date')";
            $result1 = $conn->query($sql1);
            if($result1>0)
            {
                echo "<script>window.open('additem.php?success=Product added Successfully.','_self');</script>";
            }
            else
            {
                echo "<script>window.open('additem.php?error=An Unknown Error Occurred!','_self');</script>";
            }
        }
        else
        {
            echo "<script>window.open('additem.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    } 
    
    
    if(isset($_POST['edit_company']))
    {
      
        $name = $_POST['name'];
        $id = $_POST['action_id'];
          
        $sql = "UPDATE `company` SET `name`='$name' WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewcompany.php?success=Company Updated Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewcompany.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }

    
    if(isset($_POST['edit_customer']))
    {
        $address = $_POST['address'];
        $shopname = $_POST['shopname'];
        $number2 = $_POST['number2'];
        $number1 = $_POST['number1'];
        $name = $_POST['name'];
        $pending = $_POST['pending'];
        $id = $_POST['action_id'];
          
        $sql = "UPDATE `customer` SET `name`='$name',`pending_amount`='$pending',`shop_name`='$shopname',`address`='$address',`number1`='$number1',`number2`='$number2' WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewcustomer.php?success=customer Updated Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewcustomer.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    
    if(isset($_POST['edit_labour']))
    {
        $address = $_POST['address'];
        $number2 = $_POST['number2'];
        $number1 = $_POST['number1'];
        $name = $_POST['name'];
        $id = $_POST['action_id'];
          
        $sql = "UPDATE `labour` SET `name`='$name',`address`='$address',`contact1`='$number1',`contact2`='$number2' WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewlabour.php?success=Labour Updated Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewlabour.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    if(isset($_POST['edit_vendor']))
    {
        $address = $_POST['address'];
        $shopname = $_POST['shopname'];
        $number2 = $_POST['number2'];
        $number1 = $_POST['number1'];
        $name = $_POST['name'];
        $id = $_POST['action_id'];
          
        $sql = "UPDATE `vendor` SET `name`='$name',`shop_name`='$shopname',`address`='$address',`number1`='$number1',`number2`='$number2' WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewvendor.php?success=Vendor Updated Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewvendor.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    if(isset($_POST['edit_expenditure']))
    {
      
        $name = $_POST['name'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
        $id = $_POST['action_id'];
          
        $sql = "UPDATE `expenditure` SET `name`='$name',`amount`='$amount',`date`='$date' WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewexpenditure.php?success=Expenditure Updated Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewexpenditure.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    
    if(isset($_POST['edit_bike']))
    {
      
        $name = $_POST['name'];
        $id = $_POST['action_id'];
          
        $sql = "UPDATE `bike` SET `name`='$name' WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewbike.php?success=Bike Updated Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewbike.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    
    if(isset($_POST['update_item']))
    {
        $id = $_POST['action_id'];
        $name = $_POST['name'];
        $bike = $_POST['bike'];
        $company = $_POST['company'];
        $qty = $_POST['qty'];
        $cprice = $_POST['cprice'];
        $rprice = $_POST['rprice'];
        $nqty = $_POST['nqty'];
        $ncprice = $_POST['ncprice'];
        $nrprice = $_POST['nrprice'];
        $total=($nqty+$qty);
         
        $sql = "UPDATE `items` SET`name`='$name',`bike_id`='$bike',`company_id`='$company',`old_stock`='$qty',`old_stoct_price`='$rprice',
        `new_stock`='$nqty',`new_stoct_price`='$nrprice',`total_stock`='$total',`old_stock_cprice`='$cprice',`new_stock_cprice`='$ncprice' WHERE `id`='$id'";
        
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewitem.php?success=Product Updated Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewitem.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    } 
    
    
    
    
    if(isset($_POST['delete_bike']))
    {
        $id = $_POST['action_id'];
          
        $sql = "DELETE FROM `bike` WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewbike.php?success=Bike Deleted Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewbike.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    if(isset($_POST['delete_expenditure']))
    {
        $id = $_POST['action_id'];
          
        $sql = "DELETE FROM `expenditure` WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewexpenditure.php?success=Expenditure Deleted Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewexpenditure.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    
    if(isset($_POST['delete_item']))
    {
        $id = $_POST['action_id'];
          
        $sql = "DELETE FROM `items` WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewitem.php?success=Product Deleted Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewitem.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    if(isset($_POST['delete_customer']))
    {
        $id = $_POST['action_id'];
          
        $sql = "DELETE FROM `customer` WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewcustomer.php?success=customer Deleted Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewcustomer.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    if(isset($_POST['delete_labour']))
    {
        $id = $_POST['action_id'];
          
        $sql = "DELETE FROM `labour` WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewlabour.php?success=Labour Deleted Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewlabour.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    if(isset($_POST['delete_vendor']))
    {
        $id = $_POST['action_id'];
          
        $sql = "DELETE FROM `vendor` WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewvendor.php?success=Vendor Deleted Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewvendor.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    
    
    if(isset($_POST['pay_bill']))
    {
      
        $ramount = $_POST['ramount'];
        $gamount = $_POST['gamount'];
        $pamount = $_POST['pamount'];
        $customer_id = $_POST['customer_id'];
        $date = date('d-m-Y');
          
        $sql = "INSERT INTO `bill_paid`( `customer_id`, `pending_amount`, `paid_amount`, `remaining_amount`, `date`) VALUES ('$customer_id','$pamount','$gamount','$ramount','$date')";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            $sql1 = "UPDATE `customer` SET`pending_amount`='$ramount' WHERE `id`='$customer_id'";
            $result1 = $conn->query($sql1);
             
            if($result1>0)
            {
                
                echo "<script>window.open('viewcustomer.php?success=Bill Paid Successfully.','_self');</script>";
            }
            else
            {
                echo "<script>window.open('viewcustomer.php?error=An Unknown Error Occurred!','_self');</script>";
            }
        }
        else
        {
            echo "<script>window.open('viewcustomer.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }   
    
    
    if(isset($_POST['delete_bill']))
    {
        $id = $_POST['action_id'];
          
        $sql = "DELETE FROM `bill_paid` WHERE `id` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('viewbills.php?success=Bill Deleted Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('viewbills.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    if(isset($_POST['delete_customer_return']))
    {
        $id = $_POST['action_id'];
          
        $sql = "DELETE FROM `returns` WHERE `returnid` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('return.php?success=Customer Returns Deleted Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('return.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
    if(isset($_POST['delete_vendor_return']))
    {
        $id = $_POST['action_id'];
          
        $sql = "DELETE FROM `returns` WHERE `returnid` = '$id'";
        $result = $conn->query($sql);
         
        if($result>0)
        {
            echo "<script>window.open('return.php?success=Vendor Returns Deleted Successfully.','_self');</script>";
        }
        else
        {
            echo "<script>window.open('return.php?error=An Unknown Error Occurred!','_self');</script>";
        }
      
    }
     
    
    if(isset($_POST['add_returns']) || isset($_POST['edit_returns']))
    {
      
/*	 nrprice ncprice nqty rprice cprice qty vendor customer Title
*/	

// title returnitemid customer vendor qty(old stock) cprice(old stock) nqty(New Stock) ncprice(New Stock Cost Price)
// nrprice(New Stock Retail product)

       // print_r($_POST);
        if(isset($_POST['edit_returns'])){
            $id = $_POST['action_id'];
        
        }
        
        $title= isset($_POST['title'])?$_POST['title']:'';
        $itemid= isset($_POST['returnitemid'])?$_POST['returnitemid']:0;
        $item_no= isset($_POST['item_no'])?$_POST['item_no']:0;
        $cid= isset($_POST['customer'])?$_POST['customer']:0;
        $vid= isset($_POST['vendor'])?$_POST['vendor']:0;
        $returnee= isset($_POST['returnee'])?$_POST['returnee']:0;      // returnee who returned the item 
        $qty = isset($_POST['qty'])?$_POST['qty']:0;                    //(old stock quantity)
        $cprice = isset($_POST['cprice'])?$_POST['cprice']:0;           //(old stock cost price) 
        $nrprice = isset($_POST['nrprice'])?$_POST['nrprice']:0;         //(New Stock Retail product)
        $ncprice = isset($_POST['ncprice'])?$_POST['ncprice']:0;         //ncprice(New Stock Cost Price)
        $nqty = isset($_POST['nqty'])?$_POST['nqty']:0;              // (New Stock) quantity
        $rprice = isset($_POST['rprice'])?$_POST['rprice']:0;           //retail price(old stock)
         //echo "ncprice posted".$ncprice."<br/>";
        
        if($returnee=='customer')    {
           $qty = $qty + $item_no;
            if( $qty==0 || $qty<$item_no ){
             $qty = $item_no; 
            }else{
                $qty = $qty + $item_no; 
            }
        }elseif($returnee=='vendor'){
            if( $qty==0 || $qty<$item_no ){
                $qty = $item_no; 
            }else{
                $qty = $qty - $item_no; 
            }
        }  	
        
        $date = date('d-m-Y');
       
        if(isset($_POST['edit_returns'])){
            $sql2="UPDATE `returns` SET `title`='$title',`returnitemid`='$itemid',
                    `cid`='$cid',`vid`='$vid',`returnee`='$returnee' ,`item_no`='$item_no' ,`qty`='$qty' 
                    WHERE `returnid` ='$id'";
            $result = $conn->query($sql);
        
        }else{
              $sql = "INSERT INTO `returns` (`title`, `returnitemid`,`item_no`, `cid`, `vid`, `returnee`, 
                                    `created_date`, `updated_date`) 
                                VALUES ('".$title."', '".$itemid."','".$item_no."', '".$cid."', '".$vid."',
                                        '".$returnee."', current_timestamp(), current_timestamp());";
                $result = $conn->query($sql);
           
            }
           
     //  print_r($_POST);
      
        $sql1 = "select * from items where id = '$itemid'";
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0)
        {
            while($row = mysqli_fetch_assoc($result1))
            {
                $ostock = $row['old_stock'];
                $os_cprice = $row['old_stock_cprice'];
                $os_rprice = $row['old_stoct_price'];
                $nstock = $row['new_stock'];
                $ns_cprice = $row['new_stock_cprice'];
                $ns_rprice = $row['new_stoct_price'];
                
            }
           
            if($ostock == 0)
            {
              //  echo "debugged";
             // echo "<br/> in 1";
                $sql2="UPDATE 
                            `items` 
                                SET `old_stock`='$qty',`old_stoct_price`='$rprice',`total_stock`='$qty',
                                    `old_stock_cprice`='$cprice' 
                                WHERE `id` ='$itemid'";
                $result3 = $conn->query($sql2);
            }
            else if($os_cprice == $cprice && $os_rprice == $rprice)
            {
                //echo "debugged";
                //echo $os_cprice ."==". $cprice.'&&' .$os_rprice ."==". $rprice."<br/>";

              //  echo "<br/> in 2";
                 //echo "<br/>ostock ".$ostock;
                 //echo "<br/> qty".$qty;
                $sstock=$qty;
                  $sql2="UPDATE 
                            `items` 
                                SET `old_stock`='$sstock',`new_stock`='$item_no',`old_stoct_price`='$rprice',`total_stock`=total_stock+$qty,
                                `old_stock_cprice`='$cprice' 
                            WHERE `id` ='$itemid'";
                $result3 = $conn->query($sql2);     
            }
            else if($nstock == 0)
            {
             // echo "<br/> in 3";
                 $sql2="UPDATE 
                            `items` 
                            SET `new_stock`='$qty',`new_stoct_price`='$rprice',`total_stock`=total_stock+$qty,
                            `new_stock_cprice`='$cprice' 
                        WHERE `id` ='$itemid'";
                $result3 = $conn->query($sql2);
            }
            else if($ns_cprice == $cprice && $ns_rprice == $rprice)
            {
              // echo "<br/> in 4";
                $sstock=$qty;
                  $sql2="UPDATE 
                            `items` 
                                SET 
                                `new_stock`='$sstock',`new_stoct_price`='$rprice',`total_stock`=total_stock+$qty,
                                `new_stock_cprice`='$cprice' 
                            WHERE `id` ='$itemid'";
                $result3 = $conn->query($sql2);
            }
            else
            {
             // echo "<br/> in 5";
                 $sql2="UPDATE 
                            `items` 
                                    SET `total_stock`=total_stock+$qty 
                                WHERE `id` ='$itemid'";
                $result3 = $conn->query($sql2);
                 $sql3="INSERT 
                            INTO `stock`(`item_id`, `qty`, `cprice`, `rprice`, `date`) 
                        VALUES 
                                ('$itemid','$qty','$cprice','$rprice','$date')";
                $result3 = $conn->query($sql3); 
            }
           // exit;
         
             if($result>0)
           {
               echo "<script>window.open('return.php?success=Stock Maintained Successfully With Returns.','_self');</script>";
           }
           else
           {
               echo "<script>window.open('return.php?error=An Unknown Error Occurred!','_self');</script>";
           }			
           
           }
        }




    // if(isset($_POST['addstock']))
    // {
    //     $id = $_POST['action_id'];
    //     $qty = $_POST['qty'];
    //     $cprice = $_POST['cprice'];
    //     $rprice = $_POST['rprice'];
    //     $date = date('d-m-Y');
        
    //     $sql1 = "select * from items where id = '$id'";
    //     $result1 = $conn->query($sql1);
    //     if($result1->num_rows > 0)
    //     {
    //         while($row = mysqli_fetch_assoc($result1))
    //         {
    //             $ostock = $row['old_stock'];
    //             $os_cprice = $row['old_stock_cprice'];
    //             $os_rprice = $row['old_stoct_price'];
    //             $nstock = $row['new_stock'];
    //             $ns_cprice = $row['new_stock_cprice'];
    //             $ns_rprice = $row['new_stoct_price'];
    //         }
            
    //         if($ostock == 0)
    //         {
    //             $sql2="UPDATE `items` SET `old_stock`='$qty',`old_stoct_price`='$rprice',`total_stock`='$qty',`old_stock_cprice`='$cprice' WHERE `id` ='$id'";
    //         }
    //         else if($os_cprice == $cprice && $os_rprice == $rprice)
    //         {
    //             $sstock=($ostock+$qty);
    //             $sql2="UPDATE `items` SET `old_stock`='$sstock',`old_stoct_price`='$rprice',`total_stock`=total_stock+$qty,`old_stock_cprice`='$cprice' WHERE `id` ='$id'";
    //         }
    //         else if($nstock == 0)
    //         {
    //             $sql2="UPDATE `items` SET `new_stock`='$qty',`new_stoct_price`='$rprice',`total_stock`=total_stock+$qty,`new_stock_cprice`='$cprice' WHERE `id` ='$id'";
    //         }
    //         else if($ns_cprice == $cprice && $ns_rprice == $rprice)
    //         {
    //             $sstock=($nstock+$qty);
    //             $sql2="UPDATE `items` SET `new_stock`='$sstock',`new_stoct_price`='$rprice',`total_stock`=total_stock+$qty,`new_stock_cprice`='$cprice' WHERE `id` ='$id'";
    //         }
    //         else
    //         {
    //             $sql2="UPDATE `items` SET `total_stock`=total_stock+$qty WHERE `id` ='$id'";
    //             $sql3="INSERT INTO `stock`(`item_id`, `qty`, `cprice`, `rprice`, `date`) VALUES ('$id','$qty','$cprice','$rprice','$date')";
    //             $result3 = $conn->query($sql3);
    //             if($result3 > 0)
    //             {
                    
    //             }
    //             else
    //             {
    //                 echo "<script>window.open('addstock.php?error=An Unknown Error Occurred!','_self');</script>";
    //             }
    //         }
            
            
    //         // $sql5="INSERT INTO `buy_items`(`item_id`, `qty`, `cost_price`, `retail_price`, `date`) VALUES ('$id','$qty','$cprice','$rprice','$date')";
            
    //         // $result2 = $conn->query($sql2);
    //         // if($result2 > 0)
    //         // {
    //         //     $result5 = $conn->query($sql5);
    //         //     if($result5 > 0)
    //         //     {
    //         //         echo "<script>window.open('viewitem.php?success=Stock Added Successfully Successfully.','_self');</script>";
    //         //     }
    //         //     else
    //         //     {
    //         //         echo "<script>window.open('addstock.php?error=An Unknown Error Occurred!','_self');</script>";
    //         //     }
    //         // }
    //         // else
    //         // {
    //         //     echo "<script>window.open('addstock.php?error=An Unknown Error Occurred!','_self');</script>";
    //         // }
    //     }
    // }
    
    
    
    
    
    
    
    
    
    
    
    
    
    // =====================   STOCKS ========================
    
    
    
    
?>