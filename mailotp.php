<!--  -->



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verify mail</title>
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
    <form id="otpForm" method="post">
      <div class="w-100 mb-4 text-center">
        <img src="images/roop-polymer-logo.png" alt="Roop Logo">
      </div>
      <div class="w-100 mb-5 text-center">
        <h5 class="hd">VERIFY YOUR MAIL</h5>
        <p class="form-check-label">Enter the 6-digit code sent to your Email ID</p>
      </div>
      <div class="container">
        <div class="row justify-content-center mt-5" style="padding:10px">
          <div class="col-auto">
            <div class="verification-code" id="verification-code-container"></div>

            <!-- <div class="verification-code">
            <input type="text" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="text" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="text" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="text" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="text" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="text" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">

            </div> -->
            <span class="resend-code" onclick="otpsender()">Resend Code</span>
          </div>
        </div>
      </div>
      <center><div id="error-message" class="text-danger mb-3" style="display: none; font-size:14px;"></div>
      <!-- <a href="newpass.php"> -->
      <button type="button" name="verify" onclick="validateOTP()" class="btn1 mt-5">VERIFY</button></center></a>
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://smtpjs.com/v3/smtp.js">
</script>


<script>
  var storeValue = new Array(6).fill(''); 
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById('verification-code-container');
    for (let i = 0; i < 6; i++) {
        const input = document.createElement('input');
        input.type = 'text';
        input.maxLength = 1;

        input.oninput = function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length === 1) {
                storeValue[i] = this.value;
                if (this.nextElementSibling) {
                    this.nextElementSibling.focus();
                }
            } else {
                storeValue[i] = '';
            }
            console.log(storeValue); 
        };

        input.onkeydown = function(e) {
            if (e.key === 'Backspace' && this.value.length === 0 && this.previousElementSibling) {
                storeValue[i] = ''; 
                this.previousElementSibling.focus();
                console.log(storeValue);
            }
        };

        container.appendChild(input);
    }
});




  document.querySelectorAll('.verification-code input').forEach((input, index, inputs) => {
    input.addEventListener('input', (e) => {
      if (input.value.length >= 1) {
        if (index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      }
    });
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace' && input.value.length === 0) {
        if (index > 0) {
          inputs[index - 1].focus();
        }
      }
    });
  });

  function validateOTP() {
    var inputs = document.querySelectorAll('.verification-code input');
    var errorMessage = document.getElementById('error-message');
    var isValid = true;

    inputs.forEach(input => {
      if (input.value === '') {
        isValid = false;
      }
    });

    if (!isValid) {
      errorMessage.style.display = 'block';
      errorMessage.textContent = 'All fields are required.';
    } else {
      errorMessage.style.display = 'none';
    }
   
    var OTP = storeValue.join('');
    $.ajax({
      url:'mailotp_back.php',
      type:'POST',
      data:{
        otp:OTP
      },
      success:function(data){
        if(data==='success'){
          window.location.href='changepass.php';
        }
        else{
          swal({
            title: 'Error',
            text: data,
            icon: 'error',
            confirmButtonText: 'OK'
          });

        }

      },
      error:function(data){
        swal({
            title: 'Error',
            text: 'An error occurred while checking the email.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
      }
    });
    console.log(OTP);
        
    

    
  }
  function otpsender(){
    $.ajax({
      url:'getmailforotp_back.php',
      type:'GET',
      success:function(data){
        email=data
        console.log(email)
      },
      error:function(xhr, status, error) {
              swal({
                      title: 'Error',
                      text: 'An error occurred while checking the email.',
                      icon: 'error',
                      confirmButtonText: 'OK'
                    });
                
                
            }

    });
    let otp_val = Math.floor(100000 + Math.random() * 900000);
    $.ajax({
      url:'resendotp_back.php',
      type:'POST',
      data:{
        otp:otp_val
      },
      success:function(data){
        if(data=='success'){
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
              swal({
              title: 'Success',
              text: 'OTP is sent to your mail',
              icon: 'success',
              confirmButtonText: 'OK'
            });
                
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
  else{
    swal({
              title: 'Error',
              text: 'Failed to send OTP . Please try again.',
              icon: 'error',
              confirmButtonText: 'OK'
            });
  }
      },
      error:function(xhr, status, error) {
              swal({
                      title: 'Error',
                      text: 'An error occurred while checking the email.',
                      icon: 'error',
                      confirmButtonText: 'OK'
                    });
                
                
            }
    })
    
  }

</script>
</body>
</html>