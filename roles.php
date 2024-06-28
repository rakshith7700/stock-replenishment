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
  <title>roles</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <style>
        .accordion-button::after {
            transform: none !important;
            transition: none !important;
            text-align: end !important;
        }

        .accordion-button {
            background-color: transparent !important;
            color: inherit !important;
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.20rem rgba(0, 0, 0, 0.5) !important;
        }
        .dropdown-toggle {
            display: inline;
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
              <a href="mailto:sairakshith77@gmail.com" class="text-decoration-none">
              <span class="text-light">
                <i class="fas fa-envelope mine text-light"></i>&nbsp;
                <span class="d-none d-md-inline">shah@gmail.com</span>
              </span>
              </a>
            </div>
            <div class="col-5 col-md-3 col-lg-2 navbar-item responsiveText mt-0 pt-2 pt-md-2 py-3 py-lg-2 text-center" style="background-color:#243A85CC;">
             <a href="tel:9515154877" class="text-decoration-none"><span class="text-light">
                <i class="fas fa-phone text-light mine"></i>&nbsp;
                <span class="d-none d-md-inline">91 3152378726</span>
        
              </span>
             </a>
            </div>
            <div class="col-2 col-md-6 col-lg-8 p-0 m-0 d-flex justify-content-between"> <!-- Modified class -->
              <button class="navbar-toggler ms-1 ms-md-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="offcanvas bg-white  text-center offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                  <!-- <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5> -->
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body text-start">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-2 pe-xl-4">
                    <li class="nav-item dropdown dropstart my-lg-0 my-2">
                      <a class=" dropdown text-dark  text-decoration-none responsiveText d-lg-none" href="#" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <i class="bi bi-gear text-dark responsiveText me-1"></i> Settings
                      </a>
                      <a class=" dropdown d-none d-lg-block text-decoration-none responsiveText py-3 py-lg-2" id="rub"  type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <i class="bi bi-gear text-white responsiveText me-1 me-xl-4"></i>
                      </a>
                      <ul class="dropdown-menu responsiveText">
                      <li><a class="dropdown-item" href="tableview.php" id="dashBoardCon">Dashboard</a></li>
                        <li><a class="dropdown-item" href="machine.php" id="machinesCon">Machines</a></li>
                        <li><a class="dropdown-item" href="lines.php" id="linesCon">Lines</a></li>
                        <li><a class="dropdown-item" href="part_allocation.php" id="part_allocCon">Partallocation logs</a></li>
                        <li><a class="dropdown-item" href="access_plant.php" id="accessCon">Access</a></li>
                      </ul>
                    </li>
                    <li class="nav-item my-lg-0 my-2 dropdown dropstart">
                      <a class="dropdown text-dark text-decoration-none responsiveText d-lg-none" type="button" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle text-dark responsiveText me-2 my-md-1"></i>Profile
                      </a>
                      <a class="dropdown d-none d-lg-block text-decoration-none responsiveText py-3 py-lg-2 " type="button" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle text-white responsiveText me-2"></i>
                      </a>
                      <ul class="dropdown-menu">
                        <li>
                          <form method="post">
                            <input type="submit" class="dropdown-item responsiveText" name="logout" value="Logout">
                          </form>
                        </li>
                      </ul>
                    </li>
                    <li class="nav-item my-2 dropdown dropstart">
                      <a type="button" id="dropdown-button" class="dropdown text-dark text-decoration-none responsiveText d-lg-none" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-buildings text-dark me-2"></i>PLANTS
                      </a>
                      <ul class="dropdown-menu text-dark" id="dropdown-menu">
                       
                    </ul>
                    </li>
                    <li class="nav-item my-2 dropdown dropstart my-md-1">
                      <a type="button" href="part_allocation.html" id="dropdown-button" class="dropdown text-dark text-decoration-none responsiveText d-lg-none" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-upload text-dark me-2"></i>PART ALLOCATION
                      </a>
                    </li>
                    <li class="nav-item my-2 dropdown dropstart">
                      <a type="button" id="dropdown-button" class="dropdown text-dark text-decoration-none responsiveText d-lg-none" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-border-style text-dark me-2"></i>GRID VIEW
                      </a>
                      <ul class="dropdown-menu" id="dropdown-menu">
                        <li><a class="dropdown-item" href="gridView3.php">Grid view</a></li>
                        <li><a class="dropdown-item" href="tableview.php">Table view</a></li>
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
    <div class="col-9 ">
      <img src="images/roop-polymer-logo.png" class="roopImg" alt="Logo">
      <b class="ms-1 access">ACCESS</b>
    </div>
    <div class="col-3">
    <button type="button" id="top" class="btn border-0 dropdown btn-secondary me-3 responsiveText" style="background-color:#F5F5F5; color:#707070;display:none" data-bs-toggle="dropdown" aria-expanded="false" disabled>
              &nbsp;<i class="bi bi-buildings text-secondary" style="color:#707070;"></i>&nbsp;<span id="dropdownButton"></span>&nbsp;&nbsp;
            </button>
           
    </div>
    <div>

    </div>
  </div>
  <div class="container-fluid con3">
    <div class="row mt-5 me-2 me-md-4">
      <!-- <div class="col-lg-9  col-12 ms-5"></div> -->
      <div class=" col-12 d-flex justify-content-end"><ul class="nav nav-pills " id="pills-tab" role="tablist">
        <li class=" me-2" role="presentation">
            <button class="nav-link  mb-1" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" onclick="plants()" aria-selected="true">PLANTS</button>
        </li>
        <li class=" me-2" role="presentation">
            <button class="nav-link active mb-1" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" onclick="roles()" aria-selected="false">ROLES</button>
        </li>
        <li class="" role="presentation">
            <button class="nav-link  mb-1" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" onclick="users()" aria-selected="false">USERS</button>
        </li>
    </ul>
</div>
    </div>


    <div class="container-fluid rounded rounded-4 createplantblock w-100 px-4 pt-3 pb-5">
        <div class="row mt-1 pt-3">
            <div class="col-12 col-md-6 pb-5">
            <button type="button" class=" btn border-0  px-3 buttonT  text-start dropdown-toggle-inline text-white w-25 py-1 mb-4"  data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#243A85CC">
                <i class="bi bi-buildings"></i>&nbsp;&nbsp;PLANT <span class="float-end dropdown-toggle mt-1"></span>
            </button> 
            <ul class="dropdown-menu responsiveText" id="plants_menu">
                    <!-- <li><a class="dropdown-item" href="machine1.php">Machine</a></li>
                    <li><a class="dropdown-item" href="line.php">Line</a></li>
                    <li><a class="dropdown-item" href="#">Activity Log</a></li>
                    <li><a class="dropdown-item" href="#">Issue Log</a></li>
                    <li><a class="dropdown-item" href="access1.html">Access</a></li> -->
                  </ul>
                <div class="createplant" style="display: none;" id="create">Create Role</div>
                <div class="py-2 plantname" id="addline_btn" style="display: none;">
                    <label>Role Name</label>
                    <div><input type="text" id="newRole" class="w-50 p-2 seatrubber" placeholder="Mixing Manager"></div>
                    <div class="row ps-5">
                        <div class="col-6 py-2 text-end ">
                            <button type="button" onclick="addRole()" class="btn btn-sm rounded-1 px-3" style="color:#FFFFFF;background-color:#243A85CC; margin-right:11px;">SAVE</button>
                        </div>
                    </div>                    
                </div>

              </div>
              <div class="col-12 col-md-6">
        <div class="row">
            <div class="col-12 plantlists p-0 pb-2 createplant" style="display: none;" id="roles_list">Roles List</div>
        </div>
        <div class="row" id="mainline_head" style="display: none;">
            <div class="col-12 head1 w-100">ROLE NAME</div>
            <div class="row p-0" id="target-roles">
                <!-- /*here the fetch data */ -->
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
     function users(){
    window.location.href="user3.php";
  }
  function roles(){
    window.location.href="roles.php";
  }
  function plants(){
    window.location.href="access_plant.php";

  }
</script>
<script>
      var drop = "";
    var selectedplantid=null;
    console.log("hi")
    $(document).ready(function() {

      if(role!=null){
  if (!role.checkbox.includes('dash-board')) {
  $("#dashBoardCon").remove();
}
if (!role.checkbox.includes('lines')) {
  $("#linesCon").remove();
}
if (!role.checkbox.includes('machines')) {
  $("#machinesCon").remove();
}
if (!role.checkbox.includes('part-assignment')) {
  $("#part_allocCon").remove();
}

  }
        
        $.ajax({
            url: 'plants.php',
            type: 'GET',
            success: function(data) {
                var result = JSON.parse(data);
                console.log(result);
                result.plants.forEach(function(item) {
                    drop += `<li><a class="dropdown-item" id="${item.plant_id}" onclick="updateDropdown('${item.plant_name}','${item.plant_id}')">${item.plant_name}</a></li>`;
                });
                $('#plants_menu').html(drop);
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
    function updateDropdown(plantName, plantId) {
    var dropdownButton = document.getElementById("dropdownButton");
    console.log(plantName)
    console.log(plantId);
    selectedplantid = plantId;
    dropdownButton.innerHTML = plantName;
    var getRoles = "";
  

    document.getElementById('mainline_head').style.display = 'block';
    document.getElementById('addline_btn').style.display = 'block';
    document.getElementById('top').style.display = 'block';
    document.getElementById('roles_list').style.display = 'block';
    document.getElementById('create').style.display = 'block';




    $.ajax({
        url: 'getRoles.php',
        type: 'GET',
        success: function (data) {
            var result = JSON.parse(data);
           result.forEach(function (role) {

                if (role.plant_id == plantId) {
                    console.log(role.r_id)
                getRoles += `<div id="plant-row-${role.r_id}" class="col-12 p-0 pt-4" style="margin-left:12px;">
                      <div class="accordion accordion-flush" id="accordionFlushExample">
                          <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingOne${role.r_id}">
                                  <button class="accordion-button collapsed py-1 d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne${role.r_id}" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <span id="roleName${role.r_id}"> ${role.role_name}</span>
                                      <span class="flex-grow-1 text-end">
                                          <a type="button" class="btn btn-link edit-plant" data-bs-toggle="modal" id="edit${role.r_id}" data-row-id="plant-row-${role.r_id}" data-bs-target="#editRole${role.r_id}" data-plant-name="" style="background: none; border: none;">
                                              <i class="bi bi-pencil-square text-secondary"></i>
                                          </a>
                                          <span class="divider px-1">|</span>
                                          <a type="button" class="btn btn-link delete-plant" data-bs-toggle="modal" id="${role.r_id}" data-row-id="plant-row-${role.r_id}" data-bs-target="#deleteRole${role.r_id}" data-plant-name="" style="background: none; border: none;">
                                              <i class="bi bi-trash text-secondary"></i>
                                          </a>
                                      </span>
                                  </button>
                              </h2>
                              <div id="flush-collapseOne${role.r_id}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne${role.r_id}" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">
                                      <div class="d-flex align-items-center mb-2">
                                          <input type="checkbox" class="me-2 resText" name="dashboard" value="dash-board" ${role.checkbox.includes('dash-board') ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Dashboard
                                          <div class="ms-auto d-flex">
                                              <label class="me-lg-5"><input type="radio" name="dashboard-access-${role.r_id}" value="read-only" ${role.dash_board == 'read-only' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Only</label>
                                              <label class="me-lg-5"><input type="radio" name="dashboard-access-${role.r_id}" value="read-write" ${role.dash_board == 'read-write' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Write</label>
                                          </div>
                                      </div>
                                      <div class="d-flex align-items-center mb-2">
                                          <input type="checkbox" class="me-2" name="partAssign" value="part-assignment" ${role.checkbox.includes('part-assignment') ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Part Assignment
                                          <div class="ms-auto d-flex">
                                              <label class="me-lg-5"><input type="radio" name="part-assignment-access-${role.r_id}" value="read-only" ${role.part_assignment == 'read-only' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Only</label>
                                              <label class="me-lg-5"><input type="radio" name="part-assignment-access-${role.r_id}" value="read-write" ${role.part_assignment == 'read-write' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Write</label>
                                          </div>
                                      </div>
                                      <div class="d-flex align-items-center mb-2">
                                          <input type="checkbox" class="me-2" name="line" value="lines" ${role.checkbox.includes('lines') ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Lines
                                          <div class="ms-auto d-flex">
                                              <label class="me-lg-5"><input type="radio" name="lines-access-${role.r_id}" value="read-only" ${role.line == 'read-only' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Only</label>
                                              <label class="me-lg-5"><input type="radio" name="lines-access-${role.r_id}" value="read-write" ${role.line == 'read-write' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Write</label>
                                          </div>
                                      </div>
                                      <div class="d-flex align-items-center mb-2">
                                          <input type="checkbox" class="me-2" name="machine" value="machines" ${role.checkbox.includes('machines') ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Machines
                                          <div class="ms-auto d-flex">
                                              <label class="me-lg-5"><input type="radio" name="machine-access-${role.r_id}" value="read-only" ${role.machines == 'read-only' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Only</label>
                                              <label class="me-lg-5"><input type="radio" name="machine-access-${role.r_id}" value="read-write" ${role.machines == 'read-write' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Write</label>
                                          </div>
                                      </div>
                                      <div class="d-flex align-items-center mb-2">
                                          <input type="checkbox" class="me-2" name="Access" value="access" ${role.checkbox.includes('access') ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Access
                                          <div class="ms-auto d-flex">
                                              <label class="me-lg-5"><input type="radio" name="part-allocation-access-${role.r_id}" value="read-only" ${role.access == 'read-only' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Only</label>
                                              <label class="me-lg-5"><input type="radio" name="part-allocation-access-${role.r_id}" value="read-write" ${role.access == 'read-write' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Write</label>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                 <div class="modal" id="editRole${role.r_id}" tabindex="-1" aria-labelledby="editmodalLabel${role.r_id}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content px-5">
                              <div class="modal-header border-0">
                                <h5 class="modal-title" id="editmodalLabel${role.r_id}">EDIT ROLE</h5>
                              </div>
                              <div class="modal-body">
                                <div class="row mb-3">
                                  <div class="col-sm-12">
                                    <label for="roleNameInput${role.r_id}" class="col-form-label modal2lbl">Role Name</label>
                                    <input type="text" class="form-control h-75 w-100 modal2inputs" id="roleNameValue${role.r_id}" value="${role.role_name}">
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer border-0">
                                <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                                <button type="button" class="btn" onclick="editRole(${role.r_id}, 'roleName${role.r_id}', 'roleNameValue${role.r_id}')" style="background-color:#243A85CC;color: #FFFFFF;">
                                  UPDATE
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                
                <div class="modal" id="deleteRole${role.r_id}" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
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
                        <button type="button" onclick="deleteRole('${role.r_id}', 'plant-row-${role.r_id}')" id="${role.r_id}" class="btn" style="background-color:#243A85CC;color: #FFFFFF;" id="updatePlantButton">DELETE</button>
                      </div>
                    </div>
                  </div>
                </div>`;



                   
                   
                }

            });
            document.getElementById("target-roles").innerHTML = getRoles;
           

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


function addRole() {
    var new_role = $('#newRole').val();

    if (!new_role) {
        swal({
            title: 'Error',
            text: 'Please enter all details',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    } else {
        $.ajax({
            url: 'createRole.php',
            type: 'POST',
            data: {
                plant_id:selectedplantid,
                role: new_role
            },
            success: function(data) {
              
              swal({
                    title: 'Success',
                    text: 'Role created successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                getRoles();
                $('#newRole').val('');
            },
            error: function(xhr, status, error) {
                swal({
                    title: 'Error',
                    text: 'An error occurred while creating the user. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
}
function getRoles() {
    var getRoles = "";
    $.ajax({
        url: 'getRoles.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            var roles = response;
            console.log(roles);
            roles.forEach(function(role) {
              console.log(role.r_id)
              if(role.plant_id==selectedplantid){
                getRoles += `<div id="plant-row-${role.r_id}" class="col-12 p-0 pt-4" style="margin-left:12px;">
                      <div class="accordion accordion-flush" id="accordionFlushExample">
                          <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingOne${role.r_id}">
                                  <button class="accordion-button collapsed py-1 d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne${role.r_id}" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <span id="roleName${role.r_id}"> ${role.role_name}</span>
                                      <span class="flex-grow-1 text-end">
                                          <a type="button" class="btn btn-link edit-plant" data-bs-toggle="modal" id="edit${role.r_id}" data-row-id="plant-row-${role.r_id}" data-bs-target="#editRole${role.r_id}" data-plant-name="" style="background: none; border: none;">
                                              <i class="bi bi-pencil-square text-secondary"></i>
                                          </a>
                                          <span class="divider px-1">|</span>
                                          <a type="button" class="btn btn-link delete-plant" data-bs-toggle="modal" id="${role.r_id}" data-row-id="plant-row-${role.r_id}" data-bs-target="#deleteRole${role.r_id}" data-plant-name="" style="background: none; border: none;">
                                              <i class="bi bi-trash text-secondary"></i>
                                          </a>
                                      </span>
                                  </button>
                              </h2>
                              <div id="flush-collapseOne${role.r_id}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne${role.r_id}" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">
                                      <div class="d-flex align-items-center mb-2">
                                          <input type="checkbox" class="me-2 resText" name="dashboard" value="dash-board" ${role.checkbox.includes('dash-board') ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Dashboard
                                          <div class="ms-auto d-flex">
                                              <label class="me-lg-5"><input type="radio" name="dashboard-access-${role.r_id}" value="read-only" ${role.dash_board == 'read-only' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Only</label>
                                              <label class="me-lg-5"><input type="radio" name="dashboard-access-${role.r_id}" value="read-write" ${role.dash_board == 'read-write' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Write</label>
                                          </div>
                                      </div>
                                      <div class="d-flex align-items-center mb-2">
                                          <input type="checkbox" class="me-2" name="partAssign" value="part-assignment" ${role.checkbox.includes('part-assignment') ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Part Assignment
                                          <div class="ms-auto d-flex">
                                              <label class="me-lg-5"><input type="radio" name="part-assignment-access-${role.r_id}" value="read-only" ${role.part_assignment == 'read-only' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Only</label>
                                              <label class="me-lg-5"><input type="radio" name="part-assignment-access-${role.r_id}" value="read-write" ${role.part_assignment == 'read-write' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Write</label>
                                          </div>
                                      </div>
                                      <div class="d-flex align-items-center mb-2">
                                          <input type="checkbox" class="me-2" name="line" value="lines" ${role.checkbox.includes('lines') ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Lines
                                          <div class="ms-auto d-flex">
                                              <label class="me-lg-5"><input type="radio" name="lines-access-${role.r_id}" value="read-only" ${role.line == 'read-only' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Only</label>
                                              <label class="me-lg-5"><input type="radio" name="lines-access-${role.r_id}" value="read-write" ${role.line == 'read-write' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Write</label>
                                          </div>
                                      </div>
                                       <div class="d-flex align-items-center mb-2">
                                          <input type="checkbox" class="me-2" name="machine" value="machines" ${role.checkbox.includes('machines') ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Machines
                                          <div class="ms-auto d-flex">
                                              <label class="me-lg-5"><input type="radio" name="machine-access-${role.r_id}" value="read-only" ${role.machines == 'read-only' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Only</label>
                                              <label class="me-lg-5"><input type="radio" name="machine-access-${role.r_id}" value="read-write" ${role.machines == 'read-write' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Write</label>
                                          </div>
                                      </div>
                                      <div class="d-flex align-items-center mb-2">
                                          <input type="checkbox" class="me-2" name="Access" value="access" ${role.checkbox.includes('access') ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Access
                                          <div class="ms-auto d-flex">
                                              <label class="me-lg-5"><input type="radio" name="part-allocation-access-${role.r_id}" value="read-only" ${role.access == 'read-only' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Only</label>
                                              <label class="me-lg-5"><input type="radio" name="part-allocation-access-${role.r_id}" value="read-write" ${role.access == 'read-write' ? 'checked' : ''} onclick="updateRole(${role.r_id})"> Read Write</label>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                 <div class="modal" id="editRole${role.r_id}" tabindex="-1" aria-labelledby="editmodalLabel${role.r_id}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content px-5">
                              <div class="modal-header border-0">
                                <h5 class="modal-title" id="editmodalLabel${role.r_id}">EDIT ROLE</h5>
                              </div>
                              <div class="modal-body">
                                <div class="row mb-3">
                                  <div class="col-sm-12">
                                    <label for="roleNameInput${role.r_id}" class="col-form-label modal2lbl">Role Name</label>
                                    <input type="text" class="form-control h-75 w-100 modal2inputs" id="roleNameValue${role.r_id}" value="${role.role_name}">
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer border-0">
                                <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                                <button type="button" class="btn" onclick="editRole(${role.r_id}, 'roleName${role.r_id}', 'roleNameValue${role.r_id}')" style="background-color:#243A85CC;color: #FFFFFF;">
                                  UPDATE
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                
                <div class="modal" id="deleteRole${role.r_id}" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
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
                        <button type="button" onclick="deleteRole('${role.r_id}', 'plant-row-${role.r_id}')" id="${role.r_id}" class="btn" style="background-color:#243A85CC;color: #FFFFFF;" id="updatePlantButton">DELETE</button>
                      </div>
                    </div>
                  </div>
                </div>`;}
            });
            document.getElementById("target-roles").innerHTML = getRoles;
        },
        error: function(error) {
            console.error('Error fetching roles:', error);
        }
    });
};



function editRole(id, rowId, inputId) {
    console.log(id, rowId, inputId);
    var newValue = $("#" + inputId).val();
    console.log(newValue)

    $.ajax({
        url: 'editRole.php',
        method: 'POST',
        data: { id: id, value: newValue ,plant_id:selectedplantid},
        success: function(response) {
            $('.modal-backdrop').remove();
            $("#editRole" + id).hide();

            $("#"+rowId).text(newValue);

            console.log('Success:', response);
        },
        error: function(error) {
            console.error('Error updating plant:', error);
        }
    });
}

function deleteRole(id, rowId) {
    console.log(rowId);

    $.ajax({
        url: 'deleteRole.php',
        method: 'POST',
        data: { id: id },
        success: function(response) {
            $("#" + rowId).remove();

            var modalId = '#deleteRole' + id;
            $(modalId).modal('hide');
            $('.modal-backdrop').remove();
            
            console.log('Success:', response);
        },
        error: function(error) {
            console.error('Error deleting role:', error);
        }
    });
}


function updateRole(id) {
    var checkboxes = [];
    $(`#plant-row-${id} input[type=checkbox]:checked`).each(function() {
        checkboxes.push($(this).val());
    });

    var dashboardAccess = $(`input[name='dashboard-access-${id}']:checked`).val();
    var partAssignmentAccess = $(`input[name='part-assignment-access-${id}']:checked`).val();
    var linesAccess = $(`input[name='lines-access-${id}']:checked`).val();
    var machinesAccess =  $(`input[name='machine-access-${id}']:checked`).val();
    var partAllocAccess = $(`input[name='part-allocation-access-${id}']:checked`).val();

    $.ajax({
        url: 'updateRole.php',
        method: 'POST',
        data: {
            id: id,
            checkboxes: checkboxes.join(','),
            dashboard: dashboardAccess,
            part_assignment: partAssignmentAccess,
            line: linesAccess,
            machine: machinesAccess,
            part_alloc: partAllocAccess,
        },
        success: function(response) {
            console.log('Success:', response);
        },
        error: function(error) {
            console.error('Error updating role:', error);
        }
    });
}

</script>
</body>

</html>