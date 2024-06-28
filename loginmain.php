<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<body>
<div class="login-container">
  <div class="brand-section d-none d-md-block">
    <img src="images/cy4logo.png" class="cy4 img-fluid" alt="Cy4 Logo">
  </div>
  <div id="spinner"></div>
  <div class="login-section">
    <form id="loginForm" method="post">
      <div class="w-100 mb-4 text-center">
        <img src="images/roop-polymer-logo.png" alt="Roop Logo">
      </div>
      <div class="w-100 mb-5 text-center">
        <h5 class="hd">USER LOGIN</h5>
      </div>
      <div class="input-container mb-3">
        <i class='ri bx bx-user'></i>
        <input type="mail" id="username" name="username" placeholder="Enter Username">
      </div>
      <div class="input-container mb-3">
        <i class="ri-lock-2-line"></i>
        <input type="password" id="password" name="password" placeholder="Enter Password">
      </div>
      <div id="error-message" class="text-danger mb-3 text-center" style="display: none; font-size:14px;"></div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Remember</label>
        <a href="passforget.php" class="form-check-label1">Forgot Password?</a>
      </div>
      
      <input type="button" value="LOGIN" onclick="userLogin()"  class="btn1 mt-5">
    </form>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  function userLogin() {
    var uname = $("#username").val();
    var pass = $("#password").val();
    if(uname=='' || pass==''){
        
        $('#error-message').text('Username and Password are required.').show();
    }
    else if(uname.indexOf('@')==-1){
      $('#error-message').text('Enter your correct mail').show();


    }
    else{
      $('#error-message').hide();
    
    $.ajax({
      url: 'logincheck.php',
      method: "POST",
      data: {
        username : uname,
        password : pass,
      },
      success: function(data) {
        console.log(data)
        if(data==='Login Successfull'){
          window.location.href="tableview.php";
        }
        else{
          $("#username").val('')
          $("#password").val('')
          swal({
              title: 'Error',
              text: data,
              icon: 'error',
              confirmButtonText: 'OK'
            });
            
        }
      },
      error: function(xhr, status, error) {
         
          swal({
            title: 'Error',
            text: xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong',
            icon: 'error',
            confirmButtonText: 'OK'
          });
      }
    })
  }
  }
</script>





</body>
</html>
