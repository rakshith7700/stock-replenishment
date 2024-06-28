<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forgot password</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="login-container">
  <div class="brand-section d-none d-md-block">
    <img src="images/cy4logo.png" class="cy4 img-fluid" alt="Cy4 Logo">
  </div>
  <div class="login-section">
    <form id="forgotPasswordForm" method="post">
      <div class="w-100 mb-4 text-center">
        <img src="images/roop-polymer-logo.png" alt="Roop Logo">
      </div>
      <div class="w-100 mb-5 text-center">
        <h5 class="hd">FORGOT PASSWORD</h5>
        <p class="form-check-label">Enter your Email address!</p>
      </div>
      <div class="input-container mb-3">
        <i class='ri bx bx-user'></i>
        <input type="email" id="email" placeholder="Enter mail">
      </div>
      <div id="error-message" class="text-danger mb-3" style="display: none; font-size:14px;"></div>
      <div class="form-check"></div>
     
      <input type="button" onclick="validateEmail()" value="SEND" class="btn1 mt-5">
    </form>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://smtpjs.com/v3/smtp.js">
</script>
<script>
  function validateEmail() {
    var email = document.getElementById('email').value;
    var errorMessage = document.getElementById('error-message');
    var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    if (email === '') {
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'Email is required.';
    } else if (!email.match(emailPattern)) {
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'Please enter a valid email address.';
    } else {
        
        let otp_val = Math.floor(100000 + Math.random() * 900000);

      
        $.ajax({
            url: 'passforget_back.php',
            type: 'POST',
            data: { email: email, otp: otp_val },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    sendOtp(email, otp_val);
                } else {
                  swal({
                      title: 'Error',
                      text: response.message,
                      icon: 'error',
                      confirmButtonText: 'OK'
                    });
                    
                }
            },
            error: function(xhr, status, error) {
              swal({
                      title: 'Error',
                      text: 'An error occurred while checking the email.',
                      icon: 'error',
                      confirmButtonText: 'OK'
                    });
                
                
            }
        });
    }
}

function sendOtp(email, otp_val) {
    let emailbody = `<h2>Your OTP is </h2>${otp_val}`;
    
    Email.send({
        SecureToken : "133202c8-fc22-48ec-be9f-8860af352023",
        To : email,
        From : "sairakshith77@gmail.com",
        Subject : "Otp for ROOP",
        Body : emailbody,
    }).then(
        message => {
            if (message === "OK") {
               
                window.location.href = 'mailotp.php';
            } else {
              swal({
              title: 'Error',
              text: 'Failed to send OTP. Please try again.',
              icon: 'error',
              confirmButtonText: 'OK'
            });
               
            }
        }
    );
}


</script>

</body>
</html>
