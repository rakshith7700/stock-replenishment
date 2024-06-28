<?php
session_start();
require_once "config.php";
if($_SESSION['u']==null){
  header("location:loginmain.php");
}

if(isset($_POST["logout"])){
    session_destroy();
    header("location: loginmain.php");
    exit();
}
?>
<?php
// require_once "config.php";

if (isset($_SESSION["u"]->r_id) && isset($_SESSION["u"]->plant_id)) {
    $userRole = $_SESSION["u"]->id;
    $ch=$_SESSION["u"]->r_id;
    $userPlant = $_SESSION["u"]->plant_id;
    
    $selectRole = mysqli_query($conn, "SELECT * FROM roles WHERE r_id='$ch' AND plant_id='$userPlant'");
$role = mysqli_fetch_object($selectRole);
}
else{
  $userRole=null;
  $role=null;
}
?>
<script>
var role = <?php echo json_encode($role); ?>;
var ses_id=<?php echo json_encode($userRole); ?>;
console.log(ses_id)
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>users</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
        .custom-modal-width .modal-dialog {
            max-width: 60% ;
            
        }
        .modal-backdrop.show {
      z-index: 1;
    }

    .modal {
      z-index: 1050;
    }
    </style>

</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top p-0" style="background-color:#243A8599;">
    <div class="container-fluid p-0">
      <div class="row p-0 ps-lg-0 ps-2 w-100">
        <div class="col-5 col-md-3 col-lg-2 navbar-item responsiveText m-0 p-0 pt-2 pt-md-2 py-3 py-lg-2 text-center">
          <span class="text-light">
            <i class="fas fa-envelope mine text-light"></i>&nbsp;
            <span class="d-none d-md-inline">shah@gmail.com</span>
          </span>
        </div>
        <div class="col-5 col-md-3 col-lg-2 navbar-item responsiveText mt-0 pt-2 pt-md-2 py-3 py-lg-2 text-center" style="background-color:#243A85CC;">
          <span class="text-light">
            <i class="fas fa-phone text-light mine"></i>&nbsp;
            <span class="d-none d-md-inline">91 3152378726</span>
    
          </span>
        </div>
        <div class="col-2 col-md-6 col-lg-8 p-0 m-0 d-flex justify-content-between"> <!-- Modified class -->
          <button class="navbar-toggler ms-1 ms-md-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas bg-light text-center offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <!-- <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5> -->
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body text-start">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-2 pe-xl-4">
                <li class="nav-item dropdown dropstart">
                  <a class=" dropdown text-black text-decoration-none responsiveText d-lg-none" href="#" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <i class="bi bi-gear text-dark responsiveText me-1"></i> Settings
                  </a>
                  <a class=" dropdown d-none d-lg-block text-decoration-none responsiveText py-3 py-lg-2" href="#" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <i class="bi bi-gear text-light responsiveText me-1 me-xl-4"></i>
                  </a>
                  <ul class="dropdown-menu responsiveText">
                    <li><a class="dropdown-item" href="machine.php">Machine</a></li>
                    <li><a class="dropdown-item" href="lines.php">Line</a></li>
                    <li><a class="dropdown-item" href="#">Activity Log</a></li>
                    <li><a class="dropdown-item" href="#">Issue Log</a></li>
                    <li><a class="dropdown-item" href="roles.php">Access</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown dropstart">
                  <a class="dropdown text-black text-decoration-none responsiveText d-lg-none" type="button" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle text-dark responsiveText me-2 my-md-1"></i>Profile
                  </a>
                  <a class="dropdown d-none d-lg-block text-decoration-none responsiveText py-3 py-lg-2 " type="button" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle text-light responsiveText me-2"></i>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                    <form method="post" id="logoutForm">
                              <input type="button" class="dropdown-item responsiveText"  data-bs-toggle="modal" data-bs-target="#logOut" value="Logout">
                            </form>

                            <div class="modal fade" id="logOut" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">LOGOUT</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    Are you sure you want to logout the session?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                                    <form method="post">
                                    <input type="submit" class="btn btn-primary" name="logout" id="confirmLogout" value="Yes">
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</nav>


<div class="container-fluid">
  <div class="row mt-5 ps-2">
    <div class="col-12 col-md-6">
      <img src="images/roop-polymer-logo.png" class="roopImg" alt="Logo">
      <b class="ms-1 access">ACCESS</b>
    </div>
    <div class="col-12 col-lg-6 text-center text-md-end pe-md-4">
    <button type="button" id="plantInd" class="btn btn-md border-0 px-3 buttonT text-start text-secondary dropdown-toggle-inline mb-4 showPlant d-none" style="background-color:#F5F5F5; width:10rem;">
    <i class="bi text-secondary bi-buildings"></i>&nbsp;&nbsp;PLANT
</button>
    </div>
  </div>
  <div class="container-fluid con3">
    <div class="row me-2 me-md-4">
      <!-- <div class="col-lg-9  col-12 ms-5"></div> -->
      <div class=" col-12 d-flex justify-content-end"><ul class="nav nav-pills " id="pills-tab" role="tablist">
        <li class=" me-2" role="presentation">
            <button class="nav-link  mb-1" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" onclick="plants()" aria-selected="true">PLANTS</button>
        </li>
        <li class=" me-2" role="presentation">
            <button class="nav-link  mb-1" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" onclick="roles()" aria-controls="pills-profile" aria-selected="false">ROLES</button>
        </li>
        <li class="" role="presentation">
            <button class="nav-link active mb-1" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" onclick="users()" aria-controls="pills-contact" aria-selected="false">USERS</button>
        </li>
    </ul>
</div>
    </div>


    <div class="container-fluid rounded rounded-4 createplantblock w-100 px-md-4 pt-3 pb-5" style="height:70vh;">
        <div class="row mt-1 pt-3 pe-lg-2 ps-md-3">
            <div class="col-12 col-md-5 pb-5">
            <button type="button" class="btn btn-md border-0 px-3 buttonT text-start dropdown-toggle-inline text-white mb-4" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#243A85CC; width:10rem;">
                <i class="bi bi-buildings"></i>&nbsp;&nbsp;PLANT
            </button>
            <br>
            <ul class="dropdown-menu responsiveText" id="plant-data">
                <!-- <li><a class="dropdown-item" onclick="selectPlant('Machine')" href="#">Machine</a></li>
                <li><a class="dropdown-item" onclick="selectPlant('Line')" href="#">Line</a></li>
                <li><a class="dropdown-item" onclick="selectPlant('Activity Log')" href="#">Activity Log</a></li>
                <li><a class="dropdown-item" onclick="selectPlant('Issue Log')" href="#">Issue Log</a></li>
                <li><a class="dropdown-item" onclick="selectPlant('Access')" href="#">Access</a></li> -->
            </ul>

            <button type="button" id="createButton" class="btn border-0 px-3 buttonT text-start dropdown-toggle-inline text-white py-1 mb-4 d-none" data-bs-toggle="modal" data-bs-target="#createUser" style="background-color:#243A85CC; width:10rem">
    <i class="bi bi-plus-lg"></i>&nbsp;&nbsp;CREATE USER
</button> 

<div class="modal fade custom-modal-width" id="createUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-6 ps-md-5" id="exampleModalLabel">CREATE USER</h3>
            </div>
            <div class="modal-body container w-100">
                <form id="createUserForm" method="post" action="createUser.php">
                    <div class="row w-100 ps-md-5">
                        <div class="col-12 col-md-6">
                            <span>Name</span>
                            <input type="text" id="newName" name="name" class="form-control py-2 my-2 rounded-1" placeholder="Shruti" style="background-color:#F5F5F5; color: #010101; width:90%;" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <span>Mail ID</span>
                            <input type="email" id="newMail" name="email" class="form-control py-2 my-2 rounded-1" placeholder="shruti@gmail.com" style="background-color:#F5F5F5; color: #010101;  width:90%;" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <span>Password</span>
                            <input type="password" id="newPassword" name="password" class="form-control py-2 my-2 rounded-1" placeholder="*" style="background-color:#F5F5F5; color: #010101;  width:90%;" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <span>Confirm Password</span>
                            <input type="password" id="newPassword2" name="confirm_password" class="form-control py-2 my-2 rounded-1" placeholder="*" style="background-color:#F5F5F5; color: #010101;  width:90%;" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <span>Roles</span>
                            <div class="dropdown">
                                <input onclick="joke(`${selectedplantid}`)" id="roleInput" name="role" class="form-control py-2 my-2 rounded-1" placeholder="Manager" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#F5F5F5; color: #010101; width:90%;" required>
                                <ul class="dropdown-menu" aria-labelledby="roleInput" style="width:90%;" id="dada">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 pe-md-5">
                <button type="button" class="buttonT" data-bs-dismiss="modal" style="background-color:transparent;">CANCEL</button>
                <button type="button" onclick="addUser()" class="buttonT px-4 py-2 rounded-1 me-md-4" style="background-color:#243A85CC; color:#FFFFFF;">&nbsp;&nbsp;SAVE&nbsp;&nbsp;</button>
            </div>
        </div>
    </div>
</div>

</div>
              <div class="col-12 col-md-7 d-none" id="usersContent">
        <div class="row">
            <div class="col-12 plantlists p-0 pb-2 ps-3 createplant">Users List</div>
        </div>
        <div class="row">
        <div class="col-12">
            <div class="row mx-auto trr d-flex justify-content-between align-items-center rounded-top-3 p-0">
                <div class="col-3">USER NAME</div>
                <div class="col-4">EMAIL ID</div>
                <div class="col-2">STATUS</div>
                <div class="col-2">ROLE</div>
                <div class="col-1">
                </div>
            </div>
            <div class="row p-0" id="target-users">
                <!-- /*here the fetch data */ -->
            </div>
        </div>
        </div>
    </div>
        </div>
    </div>


  <footer>
    <div class="container-fluid fixed-bottom bg-light" id="hideBlock">
      <div class="row  px-2 py-1 d-flex align-items-center">
        <div class="col-3 col-md-1 col-lg-1">
          <img src="images/th.jpeg" alt="logo" height="30px" width="50px">
        </div>
        <div class="col-9 col-md-11 col-lg-8"></div>
        <div class="col-12 col-lg-3  pt-1 text-end inditext" >
          <span   class="" style="height: 3px; width: 3px; background-color: #3BFC2E66;">&nbsp;&nbsp;&nbsp; </span>&nbsp;Waiting for material
          <span class="" style="height: 3px; width: 3px; background-color: #EF2B2B8C;">&nbsp;&nbsp;&nbsp;  </span>&nbsp;Has material</div>
        </div>
      </div>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function users(){
    window.location.href="users.php";
  }
  function roles(){
    window.location.href="roles.php";
  }
  function plants(){
    window.location.href="access_plant.php";

  }
</script>
<script>

    function selectPlant(plant) {
        var buttons1 = document.getElementsByClassName('showPlant');
        for (var i = 0; i < buttons1.length; i++) {
            buttons1[i].innerHTML = plant;
        }
    
    }

    function selectRole(role) {
        document.getElementById('roleInput').value = role;
    }

    function selectRole2(role) {
      var roleInputs = document.getElementsByClassName('roleInput2');
    for (var i = 0; i < roleInputs.length; i++) {
        roleInputs[i].value = role;
    }    }

    function selectRole3(role) {
    var roleInputs = document.getElementsByClassName('roleInput3');
    for (var i = 0; i < roleInputs.length; i++) {
        roleInputs[i].value = role;
    }
    }


var drop = "";
var selectedplantid = null;
console.log("hi");

$(document).ready(function() {
    $.ajax({
        url: 'plants.php',
        type: 'GET',
        success: function(data) {
            var result = JSON.parse(data);
            console.log(result);
            result.plants.forEach(function(item) {
                drop += `<li><a class="dropdown-item" id="${item.plant_id}" onclick="updateDropdown('${item.plant_name}', '${item.plant_id}'); selectPlant('${item.plant_name}')">${item.plant_name}</a></li>`;
            });
            $('#plant-data').html(drop);
        },
        error: function(xhr, status, error) {
            swal({
                title: 'Error',
                text: 'An error occurred while showing plants',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});
var rss = '';

function joker(pla, iid) {
    $.ajax({
        url: "joker.php",
        type: "POST",
        data: {
            id: pla,
        },
        success: function (data) {
            var d = JSON.parse(data);
            console.log(d)
            rss = ''; // Reset rss to avoid appending to previous calls
            d.forEach(function (item) {
                rss += `<li><a class="dropdown-item" onclick="selectRole('${item.role_name}')">${item.role_name}</a></li>`;
            });
            console.log(rss)
            console.log(document.getElementById("ram-"+iid))
            document.getElementById("ram-"+iid).innerHTML = rss;
        },
        error: function (data) {
            console.log("error", data);
        }
    });
}
var rs='';
function joke(plam) {
    console.log("vedgavegd",plam)
    $.ajax({
        url: "joker.php",
        type: "POST",
        data: {
            id: plam,
        },
        success: function (data) {
            var d = JSON.parse(data);
            console.log(d)
            rs='';
            d.forEach(function (item) {
                // rs += `<li><a class="dropdown-item">${item.role_name}</a></li>`;
                rs+= `<li><a class="dropdown-item" onclick="selectRole('${item.role_name}')">${item.role_name}</a></li>`;

            });
            console.log(rs)
         
            document.getElementById("dada").innerHTML = rs;
        },
        error: function (data) {
            console.log("error", data);
        }
    });
}
function updateDropdown(plantName, plantId) {
    selectedplantid = plantId; 
    var getRoles = "";
    console.log(plantId);

    $('#createButton').removeClass('d-none');
    $('#plantInd').removeClass('d-none');
    $('#usersContent').removeClass('d-none');

    $.ajax({
        url: 'getUsers.php',
        type: 'POST',
        data: {
            plant_id: plantId
        },
        success: function (data) {
            var users = JSON.parse(data); 
            users.forEach(function (user) {

                    // console.log("dbjcbjbfijbijij")
                getRoles += `
                <div class="col-12 mx-auto d-flex justify-content-between align-items-center py-1 my-2 responsiveText" id="plant-row-${user.id}" style="width:96%; background-color:#F5F5F5;">
                    <div class="col-3">${user.username}</div>
                    <div class="col-4 ps-1">${user.usermail}</div>
                    <div class="col-2 ps-3">${user.status}</div>
                    <div class="col-1 ps-3">${user.role_name}</div>
                    <div class="col-2 text-end ">
                        <button type="submit" class="btn btn-link edit-plant" data-bs-toggle="modal" id="edit${user.id}" data-row-id="plant-row1-${user.id}" data-bs-target="#editUser${user.id}" style="background: none; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </button>
                        <span class="divider">|</span>
                        <button class="btn btn-link delete-plant" data-bs-toggle="modal" id="${user.id}" data-row-id="plant-row2-${user.id}" data-bs-target="#deleteUser${user.id}" data-plant-name="" style="background: none; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="modal" id="editUser${user.id}" tabindex="-1" aria-labelledby="editmodalLabel${user.id}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content px-5">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="editmodalLabel">EDIT USER</h5>
                            </div>
                            <div class="modal-body">
                                <form class="row" method="post">
                                    <div class="col-12 col-md-6">
                                        <span>Name</span>
                                        <input type="text" id="userName${user.id}" value="${user.username}" class="form-control py-2 my-2 rounded-1" placeholder="Shruti" style="background-color:#F5F5F5; color: #010101; width:90%;">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <span>Mail ID</span>
                                        <input type="email" id="userMail${user.id}" value="${user.usermail}" class="form-control py-2 my-2 rounded-1" placeholder="shruti@gmail.com" style="background-color:#F5F5F5; color: #010101;  width:90%;">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <span>Status</span>
                                        <div class="dropdown">
                                            <input id="userStatus${user.id}" class="form-control py-2 my-2 rounded-1 roleInput3" placeholder="${user.status}" value="${user.status}" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#F5F5F5; color: #010101; width:90%;">
                                            <ul class="dropdown-menu" aria-labelledby="roleInput" style="width:90%;">
                                                <li value="Active"><a class="dropdown-item" href="#" onclick="selectRole3('Active')">Active</a></li>
                                                <li value="Inactive"><a class="dropdown-item" href="#" onclick="selectRole3('Inactive')">Inactive</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <span>Roles</span>
                                        <div class="dropdown">
                                            <input  id="userRole${user.id}" onclick="joker('${selectedplantid}','${user.id}')" class="form-control py-2 my-2 rounded-1 roleInput2" placeholder="${user.role_name}" value="${user.role_name}" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#F5F5F5; color: #010101; width:90%;">
                                            <ul class="dropdown-menu" aria-labelledby="roleInput" id="ram-${user.id}"  style="width:90%;">
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                                <button type="button" class="btn" onclick="editUser(${user.id}, 'plant-row-${user.id}')" style="background-color:#243A85CC;color: #FFFFFF;">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="deleteUser${user.id}" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content px-5">
                            <div class="modal-body" style="padding: 0  0 -2rem 0;">
                                <h6 class="modal-title pt-2 px-2" id="deletemodalLabel">DELETE ROLE</h6>
                                <div class="row">
                                    <div class="modal-body mx-1" style="padding: 0  0 -20px 0;">
                                        Are you sure you want to delete the role?
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                                <button type="button" onclick="deleteUser('${user.id}', 'plant-row-${user.id}')" id="${user.id}" class="btn" style="background-color:#243A85CC;color: #FFFFFF;" id="updatePlantButton">DELETE</button>
                            </div>
                        </div>
                    </div>
                </div>`;  
             
            })
            document.getElementById("target-users").innerHTML = getRoles;
           

        },
        error: function (xhr, status, error) {
            swal({
                title: 'Error',
                text: 'An error occurred while showing plants',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    })
}
function addUser() {
    var new_name = $('#newName').val();
    var new_mail = $('#newMail').val();
    var new_password = $('#newPassword').val();
    var confirm_password = $('#newPassword2').val();
    var new_role = $('#roleInput').val();

    if (!new_name || !new_mail || !new_password || !confirm_password || !new_role) {
       alert("Please fill all required fields");
    } else if (new_password !== confirm_password) {
        alert("Passwords do not match. Please ensure both password fields are the same.");
    } else {
        $.ajax({
            url: 'createUser.php',
            type: 'POST',
            data: {
                plant_id: selectedplantid,
                name: new_name,
                mail: new_mail,
                password: new_password,
                role: new_role,
            },
            success: function(data) {
                var response = JSON.parse(data);
                if (response.error) {
                    alert("Error: " + response.error);
                } else {
                    getUsers();
                    $('.modal-backdrop').remove();
                    $("#createUser").modal('hide');
                    console.log("User created successfully");
                    $('#newName').val('');
                    $('#newMail').val('');
                    $('#newPassword').val('');
                    $('#newPassword2').val('');
                    $('#roleInput').val('');
                }
            },
            error: function(xhr, status, error) {
                alert("An error occurred while creating the user. Please try again.");
            }
        });
    }
}


function getUsers() {
    var getRoles = "";
    $.ajax({
        url: 'getUsers.php',
        type: 'POST',
        data:{
            plant_id:selectedplantid
        },
        dataType: 'json',
        success: function(response) {
            var users = response;
            console.log(users);
            users.forEach(function(user) {
              
                 
                getRoles += `
                <div class="col-12 mx-auto d-flex justify-content-between align-items-center py-1 my-2 responsiveText" id="plant-row-${user.id}" style="width:96%; background-color:#F5F5F5;">
                    <div class="col-3">${user.username}</div>
                    <div class="col-4 ps-1">${user.usermail}</div>
                    <div class="col-2 ps-3">${user.status}</div>
                    <div class="col-1 ps-3">${user.role_name}</div>
                    <div class="col-2 text-end ">
                        <button type="submit" class="btn btn-link edit-plant" data-bs-toggle="modal" id="edit${user.id}" data-row-id="plant-row1-${user.id}" data-bs-target="#editUser${user.id}" style="background: none; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </button>
                        <span class="divider">|</span>
                        <button class="btn btn-link delete-plant" data-bs-toggle="modal" id="${user.id}" data-row-id="plant-row2-${user.id}" data-bs-target="#deleteUser${user.id}" data-plant-name="" style="background: none; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="modal" id="editUser${user.id}" tabindex="-1" aria-labelledby="editmodalLabel${user.id}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content px-5">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="editmodalLabel">EDIT USER</h5>
                            </div>
                            <div class="modal-body">
                                <form class="row" method="post">
                                    <div class="col-12 col-md-6">
                                        <span>Name</span>
                                        <input type="text" id="userName${user.id}" value="${user.username}" class="form-control py-2 my-2 rounded-1" placeholder="Shruti" style="background-color:#F5F5F5; color: #010101; width:90%;">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <span>Mail ID</span>
                                        <input type="email" id="userMail${user.id}" value="${user.usermail}" class="form-control py-2 my-2 rounded-1" placeholder="shruti@gmail.com" style="background-color:#F5F5F5; color: #010101;  width:90%;">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <span>Status</span>
                                        <div class="dropdown">
                                            <input id="userStatus${user.id}" class="form-control py-2 my-2 rounded-1 roleInput3" placeholder="${user.status}" value="${user.status}" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#F5F5F5; color: #010101; width:90%;">
                                            <ul class="dropdown-menu" aria-labelledby="roleInput" style="width:90%;">
                                                <li value="Active"><a class="dropdown-item" href="#" onclick="selectRole3('Active')">Active</a></li>
                                                <li value="Inactive"><a class="dropdown-item" href="#" onclick="selectRole3('Inactive')">Inactive</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <span>Roles</span>
                                        <div class="dropdown">
                                             <input type="" id="userRole${user.id}" onclick="joker('${selectedplantid}',${user.id})" class="form-control py-2 my-2 rounded-1 roleInput2" placeholder="${user.role_name}" value="${user.role_name}" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#F5F5F5; color: #010101; width:90%;">
                                            <ul class="dropdown-menu" aria-labelledby="roleInput" id="ram-${user.id}"  style="width:90%;">
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                                <button type="button" class="btn" onclick="editUser(${user.id}, 'plant-row-${user.id}')" style="background-color:#243A85CC;color: #FFFFFF;">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="deleteUser${user.id}" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content px-5">
                            <div class="modal-body" style="padding: 0  0 -2rem 0;">
                                <h6 class="modal-title pt-2 px-2" id="deletemodalLabel">DELETE ROLE</h6>
                                <div class="row">
                                    <div class="modal-body mx-1" style="padding: 0  0 -20px 0;">
                                        Are you sure you want to delete the role?
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                                <button type="button" onclick="deleteUser('${user.id}', 'plant-row-${user.id}')" id="${user.id}" class="btn" style="background-color:#243A85CC;color: #FFFFFF;" id="updatePlantButton">DELETE</button>
                            </div>
                        </div>
                    </div>
                </div>`;  
             
            });
            document.getElementById("target-users").innerHTML = getRoles;
        },
        error: function(error) {
            console.error('Error fetching users:', error);
        }
    });
}


function deleteUser(id, rowId) {
    console.log(rowId);

    $.ajax({
        url: 'deleteUser.php',
        method: 'POST',
        data: { id: id },
        success: function(response) {
            $("#" + rowId).remove();

            var modalId = '#deleteUser' + id;
            $(modalId).modal('hide');
            $('.modal-backdrop').remove();
            
            console.log('Success:', response);
        },
        error: function(error) {
            console.error('Error deleting user:', error);
        }
    });
}

function editUser(id, rowId) {
        console.log(id, rowId);

        var userName = $("#userName" + id).val();
        var userMail = $("#userMail" + id).val();
        var userStatus = $("#userStatus" + id).val();
        var userRole = $("#userRole" + id).val();

        console.log("user role", userRole);

        $.ajax({
            url: 'editUser.php',
            method: 'POST',
            data: { id: id, name: userName, mail: userMail, status: userStatus, role: userRole },
            success: function(response) {
                $('.modal-backdrop').remove();
                $("#editUser" + id).modal('hide');

                $("#" + rowId).html(`
                <div class="col-12 mx-auto d-flex justify-content-between align-items-center responsiveText" id="plant-row-${id}" style=" background-color:#F5F5F5;">
                               <div class="col-3">${userName}</div>
                    <div class="col-4 ps-1">${userMail}</div>
                    <div class="col-2 ps-3">${userStatus}</div>
                    <div class="col-1 ps-3">${userRole}</div>
                                <div class="col-2 text-end thisHidePart">
                                <button type="submit" class="btn btn-link edit-plant" data-bs-toggle="modal" id="edit${id}" data-row-id="plant-row-${id}" data-bs-target="#editUser${id}" style="background: none; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                            </button>
                                            <span class="divider">|</span>
                                            <button class="btn btn-link delete-plant" data-bs-toggle="modal" id="${id}" data-row-id="plant-row-${id}" data-bs-target="#deleteUser${id}" data-plant-name="" style="background: none; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg>
                                            </button>
                                </div>
                            </div>
            `);

                console.log('Success:', response);
            },
            error: function(error) {
                console.error('Error updating user:', error);
            }
        });
    }

</script>

</body>

</html>