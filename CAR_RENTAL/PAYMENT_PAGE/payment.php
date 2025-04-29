<?php
    include("../FUNCTIONS/connection.php");
    $reservation_id = $_GET['reservation_id'];
    $reservation_query = "SELECT * FROM reservation WHERE reservation_id = '$reservation_id'";
    $reservation_result = $con->query($reservation_query);
    $reservation_row = $reservation_result->fetch_assoc();
    $price = $reservation_row['price'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $amount_paid = $_POST["amount_paid"];
      $update_query = "UPDATE reservation SET total_paid = '$amount_paid', payment_status = '1' WHERE reservation_id = '$reservation_id'";
      echo $update_query;
      $result = $con->query($update_query);
      if ($result) {
        header("Location: ../TRACK/track.php");
      } else {
          echo"error submitting payment";
      }
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Payment Gateway</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="payment_style.css" />
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
      />
      <link
        href="https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600"
        rel="stylesheet"
        type="text/css"
      />
      <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/6faef4fc76.js" crossorigin="anonymous"></script>
    </head>



    <body class="body">
      <div class="payment-page">
        <h1>PAYMENT GATEWAY</h1>
        <div class="container">
            <a href="../TRACK/track.php"><i class="fa-solid fa-chevron-circle-left fa-lg"></i></a>
            <form method="post" id="payment-form">
              <input type="hidden" name="amount_paid" value="">
                <div class="left">
                    <?php
                        echo"<p id='total-amount'>Total: RM $price</p>";
                    ?>

                <input type="text" id="coupon-name" placeholder="Apply a Coupon (optional)">

                </div>
                <div class="right">
                    <div class="payment-options">
                    <img class="payment-option-img" src="./img/googlePay.png" alt="google pay" width="30%" style="border-radius:4em; cursor: pointer;">
                    <img class="payment-option-img" src="./img/ApplePay_black_yes_2x.png" alt="apple pay" width="34%" style="border-radius:4em; cursor: pointer;">
                    <img class="payment-option-img" src="./img/tng.png" alt="touchngo" width="10%" style="cursor: pointer;">
                    </div>
                    <h3>Or pay with card</h3>
                    <div class="card-info">
                        <input type="text" placeholder="First Name" name="first_name"/>
                        <input type="text" placeholder="Last Name" name="last_name" />
                        <input id="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx">
                        <div class="datecvv">
                            <input type="month" placeholder="MM/YY" name="expirydate" />
                            <input type="text" placeholder="CVV" name="cvv" />
                        </div>
                        <input type="postal" placeholder="Postal Code" name="postcode" />
                    </div>
                    
                    <button id="view-btn" type="submit" value="Submit" onclick="setAmountPaid()">PAY</button>  
                </div>
            </form>
        </div>
      </div>
    </body>
    <script> 
      const couponName = document.querySelector('#coupon-name');    
      const totalAmount = document.querySelector('#total-amount');
      const couponInfo = document.createElement('p');
      couponInfo.style.color = 'green'; // optional: style the coupon info text
      couponInfo.style.width = '80%';

      let coupons = [];
      let price = <?php echo $price; ?>;

      fetch('./available_coupons.php')
        .then(response => response.json())
        .then(data => {
          coupons = data;
        })
        .catch(error => {
          console.error(error);
        });

      couponName.addEventListener('keyup', (event) => {
        const enteredCouponName = event.target.value;
        let discountAmount = 0;

        coupons.forEach(coupon => {
          if (coupon.coupon_name === enteredCouponName) {
            discountAmount = coupon.discount_amount;
          }
        });

        const discountedPrice = price - (price * (discountAmount));
        totalAmount.childNodes[0].textContent = `Total: RM ${discountedPrice.toFixed(2)}`;

        if (discountAmount > 0) {
          couponInfo.textContent = `${discountAmount*100}% discount applied`;
          couponName.insertAdjacentElement('afterend', couponInfo);
        } else {
          couponInfo.textContent = '';
        }
      });

      const paymentOptionImgs = document.querySelectorAll('.payment-option-img');

      paymentOptionImgs.forEach(img => {
          img.addEventListener('click', () => {
              setAmountPaid();
          });
      });



      function setAmountPaid() {
          const amountPaid = parseFloat(document.querySelector('#total-amount').textContent.replace('Total: RM ', '')).toFixed(2);
          document.querySelector('input[name="amount_paid"]').value = amountPaid;
      }
    </script>



</html>
