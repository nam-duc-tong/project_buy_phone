<?php
	require_once 'inc/header.php';
	// require_once 'inc/slider.php';
?>
<?php
	if(isset($_GET['orderId'])&&$_GET['orderId']=='order'){
        $customer_Id = Session::get('customer_Id');
        $insertOrder = $ct->insertOrder($customer_Id);
        $delCart = $ct->del_all_data_cart();
        header('Location: success.php');
    }
   
	// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    //     $quantity = $_POST['quantity'];
	// 	$Addtocart = $ct-> add_to_cart($quantity,$id);
    // }
?>
<style type="text/css">
    .box-left{
        width: 50%;
        border:1px solid #666;
        float: left;
        padding: 4px;
    }
    .box-right{
        width: 45%;
        border: 1px solid #666;
        float:right;
        padding: 4px;
    }
   a.a_order{
       background:red;
       padding:7px 20px;
       color:#fff;
       font-size: 21px;
   }
</style>
<form action="" method="POST">
<div class="main">
    <div class="content">
    	<div class="section group">
            <div class="heading">
                    <h3>Offiline Payment</h3>
            </div>
            <div class="clear"></div>
            <div class="box-left">
            <div class="cartpage">
					<?php
						if(isset($update_quantity_cart)){
							echo $update_quantity_cart;
						}
					?>
					<?php		
						if(isset($delcart)){
							echo $delcart;
						}
					?>
						<table class="tblone">
							<tr>
                                <th width="5%">ID</th>
								<th width="15%">Product Name</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
                                <th width="20%">Action</th>
							</tr>
							<?php
								$get_product_cart = $ct ->get_product_cart();
								if($get_product_cart){
									$subtotal = 0;
									$qty = 0;
                                    $i =0;
									while($result = $get_product_cart->fetch_assoc()){
                                        $i++;
							?>
							<tr>
                                <td><?php echo $i;?></td>
								<td><?php echo $result['productName']?></td>
								<td><?php echo $result['price']." VND"?></td>
								<td>
                                        <?php echo $result['quantity']?>
								</td>
								<td><?php $total = $result['price'] * $result['quantity']; echo $total.' VND';?></td>	
                                <td><a href="?cartid=<?php echo $result['cartid']?>">Xóa</a></td>
                            </tr>
							<?php
								$subtotal +=$total;
								$qty = $qty + $result['quantity'];
								}
							}
							?>
						</table>
						<?php
									$check_cart = $ct->check_cart();
									if($check_cart){
										
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php
									// $qty = $qty + $result['quantity'];
									echo $subtotal.' VND';
									Session::set('sum',$subtotal);
									Session::set('qty',$qty);
								?>
							</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>15%(<?php echo $vat = $subtotal*0.15;?>)</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php $vat = $subtotal*0.15;
										$glotal = $subtotal+$vat;
										echo $glotal.' VND';
									?>
								</td>
							</tr>
					   </table>
					   <?php
								}
								else{
									echo 'Your cart is empty! please  shopping now';
								}  
						?>
					</div>	
            </div>
            <div class="box-right">
            <table class="tblone">
                <?php
                $id = Session::get('customer_Id');
                    $get_customers = $cs->show_customers($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){
                ?>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><?php echo $result['name'] ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $result['city'] ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $result['phone'] ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $result['country'] ?></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><?php echo $result['zipcode'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email'] ?></td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $result['address'] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                </tr>
                <?php                       
                        }
                  }
                ?>
            </table>
            </div>
 
        </div>
       
 	</div>

     <center><a href="?orderId=order" class="a_order">Order Now</a></center><br />
</div>
</form>
<?php
	require_once 'inc/footer.php';
?>