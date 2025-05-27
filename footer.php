<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
	$footer_about = $row['footer_about'];
	$contact_email = $row['contact_email'];
	$contact_phone = $row['contact_phone'];
	$contact_address = $row['contact_address'];
	$footer_copyright = $row['footer_copyright'];
	$total_recent_post_footer = $row['total_recent_post_footer'];
    $total_popular_post_footer = $row['total_popular_post_footer'];
    $newsletter_on_off = $row['newsletter_on_off'];
    $before_body = $row['before_body'];
}
?>

<?php if (isset($newsletter_on_off) && $newsletter_on_off == 1): ?>



<style>

.footer-links {
    margin-top: 10px;
}

.footer-links a {
    color: #ffffff;
    text-decoration: none;
    margin: 0 5px;
}

.footer-links a:hover {
    text-decoration: underline;
}









 .home-newsletter {
        background-color: #ffeef3;
        padding: 20px 0;
    }
    .home-newsletter .single {
        background-color: #ffeef3;
        color: #000000;
    }
    .home-newsletter h2 {
        color: #000000;
    }
    .home-newsletter .form-control {
        background-color: #ffeef3;
        color: #000000;
        border: 1px solid #000000;
    }
    .home-newsletter .form-control::placeholder {
        color: #000000;
        opacity: 0.7;
    }
    .home-newsletter .btn-theme {
        background-color: #000000;
        color: #FFC0CB;
        border: 1px solid #000000;
    }
</style>

   
<section class="home-newsletter">
	<div class="container">
		<div class="row">
		    
		 
			<div class="col-md-6 col-md-offset-3">
				<div class="single">
					<?php
			if(isset($_POST['form_subscribe']))
			{

				if(empty($_POST['email_subscribe'])) 
			    {
			        $valid = 0;
			        $error_message1 .= LANG_VALUE_131;
			    }
			    else
			    {
			    	if (filter_var($_POST['email_subscribe'], FILTER_VALIDATE_EMAIL) === false)
				    {
				        $valid = 0;
				        $error_message1 .= LANG_VALUE_134;
				    }
				    else
				    {
				    	$statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_email=?");
				    	$statement->execute(array($_POST['email_subscribe']));
				    	$total = $statement->rowCount();							
				    	if($total)
				    	{
				    		$valid = 0;
				        	$error_message1 .= LANG_VALUE_147;
				    	}
				    	else
				    	{
				    		// Sending email to the requested subscriber for email confirmation
				    		// Getting activation key to send via email. also it will be saved to database until user click on the activation link.
				    		$key = md5(uniqid(rand(), true));

				    		// Getting current date
				    		$current_date = date('Y-m-d');

				    		// Getting current date and time
				    		$current_date_time = date('Y-m-d H:i:s');

				    		// Inserting data into the database
				    		$statement = $pdo->prepare("INSERT INTO tbl_subscriber (subs_email,subs_date,subs_date_time,subs_hash,subs_active) VALUES (?,?,?,?,?)");
				    		$statement->execute(array($_POST['email_subscribe'],$current_date,$current_date_time,$key,1));

				    		// Sending Confirmation Email
				    		$to = $_POST['email_subscribe'];
							$subject = 'Subscriber Email Confirmation';
							
							// Getting the url of the verification link
							$verification_url = BASE_URL.'verify.php?email='.$to.'&key='.$key;

							$message = '
Merci de votre intérêt à vous abonner à notre newsletter!<br><br>
Veuillez cliquer sur ce lien pour confirmer votre abonnement:
					'.$verification_url.'<br><br>
Ce lien ne sera actif que pendant 24 heures.
					';

							$headers = 'From: ' . $contact_email . "\r\n" .
								   'Reply-To: ' . $contact_email . "\r\n" .
								   'X-Mailer: PHP/' . phpversion() . "\r\n" . 
								   "MIME-Version: 1.0\r\n" . 
								   "Content-Type: text/html; charset=ISO-8859-1\r\n";

							// Sending the email
							mail($to, $subject, $message, $headers);

							$success_message1 = LANG_VALUE_136;
				    	}
				    }
			    }
			}
			if($error_message1 != '') {
				echo "<script>alert('".$error_message1."')</script>";
			}
			if($success_message1 != '') {
				echo "<script>alert('".$success_message1."')</script>";
			}
			?>
				<form action="" method="post">
					<?php $csrf->echoInputField(); ?>
					<h2><?php echo LANG_VALUE_93; ?></h2>
					<div class="input-group">
			        	<input type="email" class="form-control" placeholder="<?php echo LANG_VALUE_95; ?>" name="email_subscribe">
			         	<span class="input-group-btn">
			         	<button class="btn btn-theme" type="submit" name="form_subscribe"><?php echo LANG_VALUE_92; ?></button>
			         	</span>
			        </div>
				</div>
				</form>
			</div>
            <!-- ---------------- -->

<!-- ---------------- -->
		</div>
        
	</div>
    
</section>
<?php endif; ?>

<style>
/* الحاوية العامة للأيقونات */
.right .icons-wrapper {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 20px;
  justify-content: center; /* يمكنك تغييره إلى center أو flex-end */
  margin: 50px;
}

/* قائمة الأيقونات (السوشيال + الدفع) */
.footer-icons,
.payment-icons {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
}

/* أيقونات السوشيال */
.footer-icons li a {
  display: inline-flex;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background-color: #fff;
  color: #fff;
  justify-content: center;
  align-items: center;
  font-size: 16px;
  transition: 0.3s;
  text-decoration: none;
  border:1px solid black; 
}

.footer-icons li a:hover {
  background-color: #ffeef3;
}

/* شعارات الدفع */
.payment-icons li img {
  height: 30px;
  display: block;
}

.divider {
  width: 1px;
  height: 36px;
  background-color: #333;
}
</style>



<div class="footer-bottom white-text">
    <div class="container">
        <div class="row align-items-center"> <!-- Ajout de align-items-center ici -->
            <!-- 1ère partie: Siège social -->
<!-- ------------------------------------------------- -->
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="right">
    <div class="icons-wrapper">
      <!-- الشبكات الاجتماعية -->
      <ul class="footer-icons">
        <?php
        $statement = $pdo->prepare("SELECT * FROM tbl_social");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            if($row['social_url'] != '') {
                echo '<li><a href="' . $row['social_url'] . '"><i class="' . $row['social_icon'] . '"></i></a></li>';
            }
        }
        ?>
      </ul>
      <div class="divider"></div>
      <!-- وسائل الدفع -->
      <ul class="payment-icons">
        <li><a href=""><img src="https://img.icons8.com/color/48/visa.png" alt="Visa"></a></li>
        <li><a href=""><img src="https://img.icons8.com/color/48/mastercard-logo.png" alt="Mastercard"></a></li>
        <li><a href=""><img src="https://img.icons8.com/color/48/paypal.png" alt="PayPal"></a></li>
        <li><a href=""><img src="https://img.icons8.com/color/48/apple-pay.png" alt="Apple Pay"></a></li>
        <li><a href=""><img src="https://img.icons8.com/color/48/google-pay.png" alt="Google Pay"></a></li>
        <li><a href=""><img src="https://img.icons8.com/color/48/amex.png" alt="American Express"></a></li>
      </ul>
    </div>
  </div>
</div>
<!-- ------------------------------------------------- -->

            <div class="col-md-3">
                <h4 class="text-white">SIÈGE SOCIAL</h4>
                <p class="text-white">
                    12 square bulsunce<br>
                    Marseille 13001<br>
                </p>
            </div>
            
            <!-- 2ème partie: Aide & Information -->
            <div class="col-md-3">
                <h4 class="text-white">AIDE & INFORMATION</h4>
                <div class="footer-links">
                    <a href="/faq.php" class="text-white">FAQ</a>
                    <a href="/contact.php" class="text-white">Contactez-nous</a>
                    <a href="/about.php" class="text-white">Notre histoire</a><br>
                </div>
            </div>
            
            <!-- 3ème partie: À propos -->
            <div class="col-md-3">
                <h4 class="text-white">LE PAYS</h4>
                <div class="france-info">
                    <div class="mb-2">
                       <img src="./assets/img/french-flag.svg" alt="Drapeau Français" style="width:25px; height:auto;">
                        <span>Site français</span>
                    </div>
                    <div class="mb-2">
                         Devise : EUR (€)
                    </div>
                    <div class="mb-2">
                        Langue : Français
                    </div>
                    <div>
                       Livraison : Métropole
                    </div>
                </div>
            </div>
            <!-- 4ème partie: LE PAYS -->
           <div class="col-md-3">
    <h4 class="text-white">LE PAYS</h4>
    <div class="footer-links">
        <form method="post" action="">
            <label for="country" style="color: #333;">VOUS ÊTES EN :</label>
            <select name="country" id="country" class="form-control" style="margin-top: 2px;">
                <option value="">Sélectionner un pays</option>
                <?php
                try {
                    $statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
                    $statement->execute();
                    $countries = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($countries as $row) {
                        echo '<option value="' . htmlspecialchars($row['country_id']) . '">' . htmlspecialchars($row['country_name']) . '</option>';
                    }
                } catch (PDOException $e) {
                    echo '<option value="">Erreur</option>';
                }
                ?>
            </select>
        </form>
    </div>
</div>

            
              <!-- 4ème partie: Copyright -->
            <div class="col-md-12 copyright mt-5">
                <?php if (!empty ($footer_copyright)) {?>
                <p class="text-white"><?php echo $footer_copyright; ?></p>
                <?php }?>
            </div>
            
        </div>
    </div>
</div>

<style>
    .white-text,
    .white-text a,
    .white-text h4,
    .white-text p {
        color: #333 !important;
    }
    
    .text-white {
        color: #333 !important;
    }
    
    .footer-bottom {
        background-color: #fff;
        padding: 30px 0;
    }
    
    .footer-links a {
        display: block;
        margin-bottom: 8px;
    }
    
    .footer-links a:hover {
        text-decoration: underline;
    }
    
    /* Ajout pour garantir la hauteur égale des colonnes */
    .row.align-items-center {
        min-height: 100%;
    }
    
    .copyright {
        height: 100%;
    }







    






    


.dawn {
  overflow: hidden;
  width: 100%;
  height: 60px; /* ajuste selon la hauteur de tes images */
  position: relative;
  background-color:rgb(0, 0, 0); /* facultatif */
}

.dawn::before,
.dawn::after {
  content: '';
  position: absolute;
  top: 0;
  width: 10%;
  height: 60%;
  z-index: 2;
}


.dawn img {
  height: 80px;
  margin-right: 30px;
}

.dawn-scroll {
  display: flex;
  animation: scroll-left 30s linear infinite;
}

@keyframes scroll-left {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-50%);
  }
}


</style>


<div class="dawn">
  <div class="dawn-scroll">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">

    <!-- Clone pour boucle infinie -->
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">
    <img src="assets/uploads/banner_login.png">

    
  </div>
</div>

<div class="header">
    <div class="container">
        <div class="row inner">
            
        </div>
    </div>
</div>



<a href="#" class="scrollup">
	<i class="fa fa-angle-up"></i>
</a>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $stripe_public_key = $row['stripe_public_key'];
    $stripe_secret_key = $row['stripe_secret_key'];
}
?>

<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="https://js.stripe.com/v2/"></script>
<script src="assets/js/megamenu.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/owl.animate.js"></script>
<script src="assets/js/jquery.bxslider.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/rating.js"></script>
<script src="assets/js/jquery.touchSwipe.min.js"></script>
<script src="assets/js/bootstrap-touch-slider.js"></script>
<script src="assets/js/select2.full.min.js"></script>
<script src="assets/js/custom.js"></script>
<script>
	function confirmDelete()
	{
	    return confirm("Sure you want to delete this data?");
	}
	$(document).ready(function () {
		advFieldsStatus = $('#advFieldsStatus').val();

		$('#paypal_form').hide();
		$('#stripe_form').hide();
		$('#bank_form').hide();

        $('#advFieldsStatus').on('change',function() {
            advFieldsStatus = $('#advFieldsStatus').val();
            if ( advFieldsStatus == '' ) {
            	$('#paypal_form').hide();
				$('#stripe_form').hide();
				$('#bank_form').hide();
            } else if ( advFieldsStatus == 'PayPal' ) {
               	$('#paypal_form').show();
				$('#stripe_form').hide();
				$('#bank_form').hide();
            } else if ( advFieldsStatus == 'Stripe' ) {
               	$('#paypal_form').hide();
				$('#stripe_form').show();
				$('#bank_form').hide();
            } else if ( advFieldsStatus == 'Bank Deposit' ) {
            	$('#paypal_form').hide();
				$('#stripe_form').hide();
				$('#bank_form').show();
            }
        });
	});


	$(document).on('submit', '#stripe_form', function () {
        // createToken returns immediately - the supplied callback submits the form if there are no errors
        $('#submit-button').prop("disabled", true);
        $("#msg-container").hide();
        Stripe.card.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
            // name: $('.card-holder-name').val()
        }, stripeResponseHandler);
        return false;
    });
    Stripe.setPublishableKey('<?php echo $stripe_public_key; ?>');
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('#submit-button').prop("disabled", false);
            $("#msg-container").html('<div style="color: red;border: 1px solid;margin: 10px 0px;padding: 5px;"><strong>Error:</strong> ' + response.error.message + '</div>');
            $("#msg-container").show();
        } else {
            var form$ = $("#stripe_form");
            var token = response['id'];
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            form$.get(0).submit();
        }
    }
</script>

<?php if (!empty ($before_body)) {?>
<?php echo $before_body; ?>
<?php }?>
</body>
</html>