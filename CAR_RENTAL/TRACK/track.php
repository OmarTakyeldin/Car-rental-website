<!DOCTYPE html>
<html lang="en">
    <head>
      <title>View Reservation</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="track_style.css" />
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
      />
      <link
        href="https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600"
        rel="stylesheet"
        type="text/css"
      />
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/6faef4fc76.js" crossorigin="anonymous"></script>
    </head>



    <body class="body">
        <div class="login-page">
            <h1 id="reservation-h">View a Reservation</h1>
            <div class="container">
                <a href="../LANDING_PAGE/landing_page.php"><i class="fa-solid fa-chevron-circle-left fa-lg"></i></a>
                <form method="post" id="reservation-form">
                    <div class="top">
                        <input type="email" placeholder="Email" id="email-input">
                        <input type="text" placeholder="Reservation ID" id="reservation-id-input"/>
                    </div>
                    <button id="view-btn" type="submit" value="Submit">VIEW</button>  
                </form>
                <div id="reservation-info"></div>
            </div>
        </div>
    </body>

<script>
    const form = document.querySelector('#reservation-form');
    const emailInput = document.querySelector('#email-input');
    const reservationIdInput = document.querySelector('#reservation-id-input');
    const reservationInfo = document.querySelector('#reservation-info');
    const viewButton = document.querySelector('#view-btn');
    const reservationHeader = document.querySelector('#reservation-h');

    form.addEventListener('submit', (event) => {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('email', emailInput.value);
    formData.append('reservation_id', reservationIdInput.value);
    
    fetch('./view.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.found) {
                reservationHeader.textContent = `RESERVATION-${data.reservation_id}`;
                let totalPrice = data.price;
                if (data.payment_status === '1') {
                    totalPrice = data.total_paid;
                }
                reservationInfo.innerHTML = `
                    <div class="customer-info">
                        <p>Customer ID: ${data.customer_id}</p>
                        <p>Customer Name: ${data.customer_name}</p>
                        <p>Start Date: ${data.start_date}</p>
                        <p>End Date: ${data.end_date}</p>
                        <p>Total Price: RM${totalPrice}</p>
                        ${data.payment_status == 0 ? '<button onclick="window.location.href=\'../PAYMENT_PAGE/payment.php?reservation_id=' + data.reservation_id + '\'">PAY NOW</button>' : '<p class="label">PAID</p>'}
                    </div>
                    <div class="car-info">
                        <img src="${data.car_img}" alt="${data.car_model}">
                        <p>Model: ${data.car_model}</p>
                    </div>
                    
                `;
                form.style.display = 'none';
                // Hide the reset button
                resetButton.style.display = 'none';
            } else {
                reservationInfo.innerHTML = '<p>No reservation found for the given email and reservation ID.</p>';
            }
            const resetButton = document.createElement('button');
            emailInput.style.display ='none';
            reservationIdInput.style.display='none';
            viewButton.style.display='none';

            resetButton.textContent = 'TRY AGAIN';
            resetButton.addEventListener('click', () => {
                reservationInfo.innerHTML = '';
                form.style.display = 'block';
                emailInput.style.display ='block';
                reservationIdInput.style.display='block';
                viewButton.style.display='block';
            });
            reservationInfo.appendChild(resetButton);
        })
        .catch(error => {
            console.error(error);
        });
    });
</script>

</html>
