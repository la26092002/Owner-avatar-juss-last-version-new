<?php require_once('header.php'); ?>

<?php
$error_message = '';
if(isset($_POST['form1'])) {
    $valid = 1;
    if(empty($_POST['subject_text'])) {
        $valid = 0;
        $error_message .= 'Subject can not be empty\n';
    }
    if(empty($_POST['message_text'])) {
        $valid = 0;
        $error_message .= 'Message can not be empty\n';
    }
    if($valid == 1) {

        $subject_text = strip_tags($_POST['subject_text']);
        $message_text = strip_tags($_POST['message_text']);

        // Getting Customer and Admin Email Addresses
        $statement = $pdo->prepare("
            SELECT c.cust_email, c.cust_phone
            FROM tbl_customer c
            JOIN tbl_payment p ON c.cust_id = p.customer_id
            WHERE p.payment_id = ?
        ");
        $statement->execute(array($_POST['payment_id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $cust_email = $row['cust_email'];
            $cust_phone = isset($row['cust_phone']) ? $row['cust_phone'] : 'Not provided';
        }

        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $admin_email = $row['contact_email'];
        }

        $order_detail = '';
        $statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_id=?");
        $statement->execute(array($_POST['payment_id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
        	
        	if($row['payment_method'] == 'PayPal'):
        		$payment_details = '
Transaction Id: '.$row['txnid'].'<br>
        		';
        	elseif($row['payment_method'] == 'Stripe'):
				$payment_details = '
Transaction Id: '.$row['txnid'].'<br>
Card number: '.$row['card_number'].'<br>
Card CVV: '.$row['card_cvv'].'<br>
Card Month: '.$row['card_month'].'<br>
Card Year: '.$row['card_year'].'<br>
        		';
        	elseif($row['payment_method'] == 'Bank Deposit'):
				$payment_details = '
Transaction Details: <br>'.$row['bank_transaction_info'];
        	endif;

            $order_detail .= '
Customer Name: '.$row['customer_name'].'<br>
Customer Email: '.$row['customer_email'].'<br>
Customer Phone: '.$cust_phone.'<br> <!-- Display Customer Phone -->
Payment Method: '.$row['payment_method'].'<br>
Payment Date: '.$row['payment_date'].'<br>
Payment Details: <br>'.$payment_details.'<br>
Paid Amount: '.$row['paid_amount'].'<br>
Payment Status: '.$row['payment_status'].'<br>
Shipping Status: '.$row['shipping_status'].'<br>
Payment Id: '.$row['payment_id'].'<br>
            ';
        }

        $i=0;
        $statement = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
        $statement->execute(array($_POST['payment_id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $i++;
            $order_detail .= '
<br><b><u>Product Item '.$i.'</u></b><br>
Product Name: '.$row['product_name'].'<br>
Size: '.$row['size'].'<br>
Color: '.$row['color'].'<br>
Quantity: '.$row['quantity'].'<br>
Unit Price: '.$row['unit_price'].'<br>
            ';
        }

        $statement = $pdo->prepare("INSERT INTO tbl_customer_message (subject,message,order_detail,cust_id) VALUES (?,?,?,?)");
        $statement->execute(array($subject_text,$message_text,$order_detail,$_POST['cust_id']));

        // sending email
        $to_customer = $cust_email;
        $message = '
<html><body>
<h3>Message: </h3>
'.$message_text.'
<h3>Order Details: </h3>
'.$order_detail.'
</body></html>
';
        $headers = 'From: ' . $admin_email . "\r\n" .
                   'Reply-To: ' . $admin_email . "\r\n" .
                   'X-Mailer: PHP/' . phpversion() . "\r\n" . 
                   "MIME-Version: 1.0\r\n" . 
                   "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // Sending email to admin                  
        //mail($to_customer, $subject_text, $message, $headers);
        
        $success_message = 'Votre e-mail au client est envoyé avec succès.';

    }
}
?>
<?php
if($error_message != '') {
    echo "<script>alert('".$error_message."')</script>";
}
if($success_message != '') {
    echo "<script>alert('".$success_message."')</script>";
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Orders</h1>
    </div>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-12">

            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Détails du Produit</th>
                                <th>Informations de Paiement</th>
                                <th>Montant Payé</th>
                                <th>Statut du Paiement</th>
                                <th>Statut d'Expédition</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT p.*, c.cust_phone,cust_address
                                                        FROM tbl_payment p
                                                        JOIN tbl_customer c ON p.customer_id = c.cust_id
                                                        ORDER BY p.id DESC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr id="row-<?php echo $row['id']; ?>" class="<?php if($row['payment_status']=='Pending'){echo 'bg-r';}else{echo 'bg-g';} ?>">
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <b>Id:</b> <?php echo $row['customer_id']; ?><br>
                                        <b>Name:</b><br> <?php echo $row['customer_name']; ?><br>
                                        <b>Addres:</b><br> <?php echo $row['cust_address']; ?><br>
                                        <b>Email:</b><br> <?php echo $row['customer_email']; ?><br>
                                        <b>Phone:</b><br> <?php echo isset($row['cust_phone']) ? $row['cust_phone'] : 'Not provided'; ?><br><br>
                                    </td>
                                    <td>
                                        <?php
                                        $statement1 = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
                                        $statement1->execute(array($row['payment_id']));
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            echo '<b>Product:</b> '.$row1['product_name'];
                                            echo '<br>(<b>Size:</b> '.$row1['size'];
                                            echo ', <b>Color:</b> '.$row1['color'].')';
                                            echo '<br>(<b>Quantity:</b> '.$row1['quantity'];
                                            echo ', <b>Unit Price:</b> '.$row1['unit_price'].')';
                                            echo '<br><br>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if($row['payment_method'] == 'Bank Deposit'): ?>
                                            <b>Payment Id:</b> <?php echo $row['payment_id']; ?><br>
                                            <b>Date:</b> <?php echo $row['payment_date']; ?><br>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row['paid_amount']; ?> DZ</td>
                                    <td>
                                        <?php echo $row['payment_status']; ?>
                                        <br><br>
                                        <?php
                                            if($row['payment_status']=='Pending'){
                                                ?>
                                                <a href="order-change-status.php?id=<?php echo $row['id']; ?>&task=Completed" class="btn btn-success btn-xs action-btn" style="width:100%;margin-bottom:4px;">Mark as Completed</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="order-change-status.php?id=<?php echo $row['id']; ?>&task=Pending" class="btn btn-warning btn-xs action-btn" style="width:100%;margin-bottom:4px;">Mark as Pending</a>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row['shipping_status']; ?>
                                    </td>
                                    <td>
                                        <!-- Action Buttons -->
                                        <a href="#" class="btn btn-primary btn-xs action-btn" onclick="printRow(<?php echo $row['id']; ?>);return false;">Print</a>
                                        <a href="order-delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs action-btn" onclick="return confirmDelete();">Delete</a>                                    
                                    </td>
                                </tr>
                                <!-- Hidden Print Div -->
                                <div id="print-<?php echo $row['id']; ?>" style="display:none;">
                                    <h2>Customer Information</h2>
                                    <p><strong>Name:</strong> <?php echo $row['customer_name']; ?></p>
                                    <p><strong>Email:</strong> <?php echo $row['customer_email']; ?></p>
                                    <p><strong>Phone:</strong> <?php echo $row['cust_phone']; ?></p>
                                    <p><strong>Address:</strong> <?php echo $row['cust_address']; ?></p>

                                    <h2>Order Details</h2>
                                    <?php
                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
                                    $statement1->execute(array($row['payment_id']));
                                    $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result1 as $row1) {
                                        echo '<p><strong>Product:</strong> '.$row1['product_name'];
                                        echo ' (<strong>Size:</strong> '.$row1['size'];
                                        echo ', <strong>Color:</strong> '.$row1['color'].')';
                                        echo ' (<strong>Quantity:</strong> '.$row1['quantity'];
                                        echo ', <strong>Unit Price:</strong> '.$row1['unit_price'].')</p>';
                                    }
                                    ?>
                                    <p><strong>Montant Payé:</strong> $<?php echo $row['paid_amount']; ?></p>
                                    <p><strong>Statut du Paiement:</strong> <?php echo $row['payment_status']; ?></p>
                                    <p><strong>Statut d'Expédition:</strong> <?php echo $row['shipping_status']; ?></p>
                                </div>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    </div>

</section>

<script>
function printRow(id) {
    var content = document.getElementById('print-' + id).innerHTML;
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Order Details</title>');
    printWindow.document.write('<style>body{font-family: Arial, sans-serif;} h2{margin-top:0;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>

<?php require_once('footer.php'); ?>
