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
    <title>Mixing area</title>
    <style>
       .modal-backdrop.show {
      z-index: 1;
    }

    .modal {
      z-index: 1050;
    }
    .flex-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .button-container {
      display: flex;
      align-items: center;
    }
    .divider {
      margin: 0 5px;
    }
    .default-bg {
            background-color: #F5F5F5;
        }
        .default-text {
            color: black;
        }
        .selected-bg {
            background-color: #243A85CC;
        }
        .selected-text {
            color: white;
        }
    </style>
    
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                      <a class=" dropdown d-none d-lg-block text-decoration-none responsiveText py-3 py-lg-2"  type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
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
                    <li class="nav-item my-2 dropdown dropstart">
                      <a type="button" id="dropdown-button" class="dropdown text-dark text-decoration-none responsiveText d-lg-none" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-buildings text-dark me-2"></i>PLANTS_1
                      </a>
                      <ul class="dropdown-menu text-dark" id="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Plant_2</a></li>
                        <li><a class="dropdown-item" href="#">Plant_3</a></li>
                        <li><a class="dropdown-item" href="#">Plant_4</a></li>
                    </ul>
                    </li>
                </div>
              </div>
            </div>
          </div>
        </div>
    </nav>


  <div class="container-fluid main_div">
    <div class="row butt mt-5 px-3 px-lg-0 p-0">
        <!-- <div class="col-lg-3 col-md-4 col-sm-6 col-12 ms-lg-4 mixing_area text-start "> -->
        <div class="col-lg-3 col-12 ms-lg-4 mixing_area text-start ">

            <img src="images/roop-polymer-logo.png" class="roopImg" alt="Logo">
            <b class="ms-1 mainHead  ">LINES</b>
        </div>  

        <div class=" col-lg-8 ms-lg-5 text-end my-4 my-lg-0 d-none d-lg-inline p-0">
        <!-- <div class="col-lg-6 col-1 ms-lg-3 mixing_area text-start "> -->
            <button type="button" class="btn ab border-0 dropdown-toggle px-3 responsiveText" id="dropdownButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#F5F5F5;color:gray;">
                <i style="color: gray;" class="bi bi-buildings"></i>&nbsp;&nbsp;PLANTS
            </button> 
            <ul class="dropdown-menu" id="plants_menu">
                
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row px-1 mt-2 px-lg-4 px-3">
      <div class="col-6 text-start">
            <button class="btn responsiveText" id="addline_btn" style="  font-size: 14px; font-family: Arial; color: #ffffff; font-weight: regular; background-color: #243A85CC;display:none" data-bs-toggle="modal" data-bs-target="#addLineModal">
            <span style="font-size: 14px; vertical-align: middle; margin-right:10px;">+</span> LINE
            </button>
      </div>
      <div class="col-6 text-end">
      <button type="button" class="btn btn-sm  mx-3 pe-3   responsiveText " style="display: none; font-size: 14px; font-family: Arial; color: #ffffff; font-weight: regular; background-color: #243A85CC;" id="checkmachine" data-bs-toggle="modal" data-bs-target="#assignMachine">
              &nbsp;&nbsp;<i style="color: gray;" class="fas fa-plus fa-sm text-white "></i>&nbsp;&nbsp;MACHINE
      </button>
      </div>
    </div>
</div>
<div class="modal fade" id="assignMachine" tabindex="-1" aria-labelledby="addLineModalLabel2" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                <div class="modal-content border-0">
                  <div class="modal-header border-0">
                    <h5 class="modal-title subHead" id="addLineModalLabel2">ADD MACHINE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input border-dark" type="checkbox" value="" onclick="updatema('selectAllCheckbox')"  id="selectAllCheckbox">
                      <label class="form-check-label responsiveText" for="checkbox">Select all machine</label>
                    </div>
                    <div id="targetcheckbox">
                    </div>
                  </div>
                  <div class="modal-footer border-0">
                    <button type="button " class="buttonT px-3 py-2" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" onclick="addMachine()" class="buttonT px-3 py-2 text-white" style="background-color:#243A85CC;">ADD</button>
                  </div>
                </div>
              </div>
            </div>

<div class="container-fluid mb-5">
    <div class="row px-4">
        <div class="col-12 col-md-2 mt-4" >
        <div class="head1 row mx-auto " style="display: none;width:97%" id="mainline_head">LINES</div>

            <div class="row p-0  d-flex justify-content-center" id="line_div" >
            <!-- <div class="head1 col-11 " style="display: none;" id="mainline_head">LINES</div> -->
            <div  class="d-flex justify-content-center flex-column"  >
            <!-- <div class=" py-2 col-11 my-2 responsiveText" style="background-color:#F5F5F5;">Line 1</div>
            <div class=" py-2 col-11 my-2 responsiveText" style="background-color:#F5F5F5;">Line 2</div>
            <div class=" py-2 col-11 my-2 responsiveText" style="background-color:#F5F5F5;">Line 3</div>
            <div class=" py-2 col-11 my-2 responsiveText" style="background-color:#F5F5F5;">Line 4</div> -->
            </div>
            </div>
      
</div>



        <div class="col-md-1 "></div>
        <!-- /////////////////////////// col-9 beside col-lg-2////////// -->
        <div id="machineHead1" class="col-12 col-md-4 mt-4  p-0 d-none">
        <div  class="head1 row mx-auto" style="width:97%;">MACHINE NUMBER</div>
            <div id="getMachine1"  class="row d-flex p-0 justify-content-center">
              </div>
        </div>




        <div class="col-md-1 "></div>
        <div  id="machineHead2" class=" col-12 col-md-4 mt-4 p-0 d-none">
        <div  class="head1 row mx-auto" style="width:97%;">MACHINE NUMBER</div>
            <div id="getMachine2"  class="row p-0 d-flex justify-content-center" >
              </div>
        </div>
      </div>
    </div>
</div>


<div class="modal fade" id="deleteLineModal" tabindex="-1" aria-labelledby="deleteLineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title  subHead" id="deleteLineModalLabel">DELETE MACHINE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="responsiveText">Are you sure you want to delete this MACHINE?</p>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class=" buttonT px-3 py-2" data-bs-dismiss="modal">CANCEL</button>
        <button type="button" class=" buttonT px-3 py-2" style="background-color:#243A85CC; color:#FFFFFF;">DELETE</button>
      </div>
    </div>
  </div>
</div>
<!-- 
<div class="modal-dialog modal-dialog-centered">
  ...
</div> -->




<div class="modal fade" id="addLineModal" tabindex="-1" aria-labelledby="addLineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title subHead" id="addLineModalLabel">ADD LINE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
      <div class="modal-body">
      
        <p class="responsiveText">Line Name</p>
        
        <input type="text" class="form-control responsiveText" id="lineName" style="width: 100%; background-color: #F5F5F5;">
      </div>
      <div class="modal-footer border-0">
        <button type="button" class=" buttonT px-3 py-2" data-bs-dismiss="modal">CANCEL</button>
        <button type="button" class=" buttonT px-3 py-2" onclick="addline()" style="background-color:#243A85CC; color:#FFFFFF;">ADD</button>
      </div>
      </form>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var s = "";
    var selectedplantid=null;
    var selectedplantname=null;
    var selectedlineid=null;
    $(document).ready(function() {

      if(role!=null){
        if (!role.checkbox.includes('part-assignment')) {
  $("#part_allocCon").remove();
}
if (!role.checkbox.includes('dash-board')) {
  $("#dashBoardCon").remove();
}
if (!role.checkbox.includes('machines')) {
  $("#machinesCon").remove();
}
if (!role.checkbox.includes('access')) {
  $("#accessCon").remove();
}

  }
  

    if(ses_id==null){
    $.ajax({
        url: 'getAccess.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            var plants = response;
            plants.forEach(function(plant) {
                s += `<li><a class="dropdown-item"  onclick="updateDropdown('${plant.plant_name}','${plant.plant_id}')">${plant.plant_name}</a></li>`;
            });
            console.log("sdfghd",s)
            document.getElementById("plants_menu").innerHTML = s;
        },
        error: function(error) {
            console.error('Error fetching tasks:', error);
        }
    });}
    else{
      $.ajax({
        url:"get_user_plants.php",
        type:"POST",
        data:{
          id:ses_id
        },
        
        success:function(response){
          var plantss = JSON.parse(response);
            plantss.forEach(function(plant) {
                s += `<li><a class="dropdown-item"  onclick="updateDropdown('${plant.plant_name}','${plant.plant_id}')">${plant.plant_name}</a></li>`;
            });
            document.getElementById("plants_menu").innerHTML = s;
            console.log("s",s)

        },
        error: function(error) {
            console.error('Error :', error);
        }

      })
    }
});

    function updateDropdown(plantName, plantId) {
    var dropdownButton = document.getElementById("dropdownButton");
    console.log(plantName)
    console.log(plantId);
    selectedplantid = plantId;
    selectedplantname=plantName;
    dropdownButton.innerHTML = plantName;
    var lins = "";
    var btns="";

    document.getElementById('mainline_head').style.display = 'block';
    document.getElementById('addline_btn').style.display = 'block';
    document.getElementById('getMachine1').classList.remove('d-flex');
    document.getElementById('getMachine1').classList.add('d-none');
    document.getElementById('getMachine2').classList.remove('d-flex');
    document.getElementById('getMachine2').classList.add('d-none');

    
abc(plantId);
    $.ajax({
        url: 'plants.php',
        type: 'GET',
        success: function (data) {
            var result = JSON.parse(data);
            result.lines.forEach(function (item) {

                if (item.plant_id == plantId) {

                    lins += ` <div class="py-2 col-11 my-2 responsiveText default-bg default-text flex-container" style="background-color:#F5F5F5;" id="${item.line_id}" onclick="getMachine('${item.line_id}')">
    ${item.line_name}
    <div class="button-container">
      <button class="btn btn-link edit-plant also" data-bs-toggle="modal" id="edit${item.line_id}" data-bs-target="#editMachine${item.line_id}" style="background: none; border: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square text-secondary" viewBox="0 0 16 16">
          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
        </svg>
      </button>
      <span class="divider">|</span>
      <button class="btn btn-link delete-plant also" data-bs-toggle="modal" id="${item.line_id}" data-bs-target="#deleteMachine${item.line_id}" data-plant-name="" style="background: none; border: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash text-secondary" viewBox="0 0 16 16">
          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
        </svg>
      </button>
    </div>
  </div>
   <div class="modal" id="editMachine${item.line_id}" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content px-5">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="editmodalLabel">EDIT LINE</h5>
                            </div>
                            <div class="modal-body">
                            <input type="text" id="editlineName${item.line_id}" value="${item.line_name}" class="form-control py-2 my-2 rounded-1" placeholder="Shruti" style="background-color:#F5F5F5; color: #010101;">
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                                <button type="button" class="btn" onclick="edit_line(${item.line_id}, 'plant-row-${item.line_id}')" style="background-color:#243A85CC;color: #FFFFFF;">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="modal fade" id="deleteMachine${item.line_id}" tabindex="-1" aria-labelledby="deleteLineModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0">
                              <div class="modal-header border-0">
                                <h5 class="modal-title subHead" id="deleteLineModalLabel">DELETE MACHINE</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <p class="responsiveText">Are you sure you want to delete this LINE?</p>
                              </div>
                              <div class="modal-footer border-0">
                                <button type="button" class="buttonT px-3 py-2" data-bs-dismiss="modal">CANCEL</button>
                                <button type="button" onclick="delete_line('${item.line_id}', 'plant-row-${item.line_id}')" id="${item.line_id}" class="buttonT px-3 py-2" style="background-color:#243A85CC; color:#FFFFFF;">DELETE</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    
                    `
                    // btns+=`<button class="buttonText px-3 py-2 ms-0 mx-2 text-secondary foot-butt" onclick="getMachine(${item.line_id})"><i class="bi bi-bounding-box iconSize2" style="color:gray;"></i>&nbsp;&nbsp;${item.line_name}</button>`;
                  }

            });
            $('#line_div').html(lins);
            // $("lines_div div:first-child").click()
            
            // $('#line_btn').html(btns);
            if(role!=null){
                if (role.checkbox.includes('lines') && role.line === 'read-only') {
                  // $(".thisHidePart").css("visibility", "hidden");
                  $(".also").css("visibility", "hidden");
                  $('#addline_btn').prop('disabled', true);
                  $('#checkmachine').prop('disabled', true);

                }}

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


let selectedDivIndex = null;

$('#line_div').on('click', '.flex-container', function() {
    // Reset all div styles to default
    $('#line_div .flex-container').removeClass('selected-bg selected-text').addClass('default-bg default-text');

    // Set the clicked div style to blue
    $(this).removeClass('default-bg default-text').addClass('selected-bg selected-text');

    // Save the index of the clicked div
    selectedDivIndex = $(this).index();
});
    
function abc(plantId){
    $.ajax({
        url: 'getfreemachines.php',
        type: 'POST',
        data:{
            p_id:plantId
        },
        dataType: 'json',
        success: function(response) {
          var selectMachine ="";
            var free_machines = response;
            free_machines.forEach(function(freeMach) {
              selectMachine += ` <input class="form-check-input border-dark" name="checkings" type="checkbox" value="" onclick="updatema(${freeMach.machine_id})" id="${freeMach.machine_id}">
                      <label class="form-check-label responsiveText">${freeMach.machine_name}</label>
                      `;
            });
            
            document.getElementById("targetcheckbox").innerHTML = selectMachine;
        },
        error: function(error) {
            console.error('Error fetching tasks:', error);
 }
});}
function addline() {
    var line_name = $('#lineName').val();
    $.ajax({
        url: 'addline_lines_back.php',
        type: 'POST',
        data: {
            plant_id: selectedplantid,
            line: line_name
        },
        success: function (data) {
        
            if (typeof data !== 'object') {
                data = JSON.parse(data);
            }

            if (data.success) {
                // var newDiv = document.createElement('div');
                // newDiv.className = 'py-2 col-11 my-2 responsiveText';
                // newDiv.style.backgroundColor = '#F5F5F5';
                // newDiv.textContent = line_name;
               
                // console.log(data.line_id);
                // newDiv.addEventListener('click', function() {
                //     getMachine(data.line_id);
                // });
                // document.getElementById('line_div').appendChild(newDiv);
                updateDropdown(selectedplantname,selectedplantid);
                $('.modal-backdrop').remove();
                $('#addLineModal').hide();

                swal({
                    title: 'Success',
                    text: 'Line created successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

            } else {
                swal({
                    title: 'Error',
                    text: 'Something went wrong',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function (xhr, status, error) {
            swal({
                title: 'Error',
                text: 'An error occurred while adding the line',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
}
function getMachine(id) {
  // document.getElementById(id).style.backgroundColor="#243A85CC";
  document.getElementById('getMachine1').classList.remove('d-none');
    document.getElementById('getMachine1').classList.add('d-flex');
    document.getElementById('getMachine2').classList.remove('d-none');
    document.getElementById('getMachine2').classList.add('d-flex');
    console.log("sdfgdsfdsfgedwefgb"+id);
    selectedlineid=id;
    document.getElementById('checkmachine').style.display = 'inline';
    $.ajax({
        url: 'postMachine.php',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (Array.isArray(response)) {
                var machines = response;

                var half = Math.ceil(machines.length / 2);
                var firstHalf = machines.slice(0, half);
                var secondHalf = machines.slice(half);

                function generateMachineHTML(machineList) {
                    return machineList.map(function(machine) {
                        return `<div class="py-1 col-11 my-2 d-flex justify-content-between align-items-center responsiveText" style="background-color:#F5F5F5;" id="plant-row-${machine.machine_id}">
                                ${machine.machine_name}
                                <button class="btn btn-link delete-plant thisHidePart" data-bs-toggle="modal" id="${machine.machine_id}" data-row-id="plant-row-${machine.machine_id}" data-bs-target="#deleteLineModal${machine.machine_id}" data-plant-name="" style="background: none; border: none;">
                                <i class="bi bi-trash text-secondary"></i>
                                </button>
                            </div>

                            <div class="modal fade" id="deleteLineModal${machine.machine_id}" tabindex="-1" aria-labelledby="deleteLineModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0">
                              <div class="modal-header border-0">
                                <h5 class="modal-title subHead" id="deleteLineModalLabel">DELETE MACHINE</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <p class="responsiveText">Are you sure you want to delete this MACHINE?</p>
                              </div>
                              <div class="modal-footer border-0">
                                <button type="button" class="buttonT px-3 py-2" data-bs-dismiss="modal">CANCEL</button>
                                <button type="button" onclick="deletePlant('${machine.machine_id}', 'plant-row-${machine.machine_id}')" id="${machine.machine_id}" class="buttonT px-3 py-2" style="background-color:#243A85CC; color:#FFFFFF;">DELETE</button>
                              </div>
                            </div>
                          </div>
                        </div>
                          `;
                    }).join('');
                }
                let getMachine1HTML = generateMachineHTML(firstHalf);
                let getMachine2HTML = generateMachineHTML(secondHalf);
                document.getElementById("getMachine1").innerHTML = getMachine1HTML;
                document.getElementById("getMachine2").innerHTML = getMachine2HTML;
                document.getElementById("machineHead1").classList.remove('d-none');
                document.getElementById("machineHead2").classList.remove('d-none');
                if(role!=null){
                if (role.checkbox.includes('lines') && role.line === 'read-only') {
                  $(".thisHidePart").css("visibility", "hidden");
                  $(".also").css("visibility", "hidden");
                }}
                

            } else {
                console.error('Response is not an array:', response);
            }
        },
        error: function(error) {
            console.error('Error fetching machines:', error);
        }
    });
    $('#line_div').on('click', 'div', function() {
        // Reset all div styles to default (gray) first
        $('#line_div div').css('background-color', '');
        $('#line_div div').css('color', '');
        $('#line_div div svg').css('color', '');

        // $(this).css('color', 'black');

        
        // Set the clicked button style to red
        $(this).css('background-color', '#243A85CC');
        $(this).css('color', 'white');
        $('#line_div div svg').css('color', 'white');
      


    });
    
}

function deletePlant(id, rowId) {
    console.log(id);

    $.ajax({
        url: 'deleteMachine.php',
        method: 'POST',
        data: { machineId : id },
        success: function(response) {
            $('.modal-backdrop').remove();
            $("#" + rowId).remove();
            $('#' + id).closest('.modal').modal('hide');
            abc(selectedplantid);
            console.log('Success:', response);
        },
        error: function(error) {
            console.error('Error deleting machine:', error);
        }
    });
}
var arr=[];
function updatema(id) {
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const checkboxes = document.querySelectorAll("input[name='checkings']");
        
        if (id === 'selectAllCheckbox') {
            if (selectAllCheckbox.checked) {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    if (!arr.includes(Number(checkbox.id))) {
                        arr.push(Number(checkbox.id));
                    }
                });
            } else {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                arr = [];
            }
        } else {
            let xham = document.getElementById(id);
            if (xham.checked) {
                if (!arr.includes(Number(id))) {
                    arr.push(Number(id));
                }
            } else {
                let index = arr.indexOf(Number(id));
                if (index > -1) {
                    arr.splice(index, 1);
                }
                selectAllCheckbox.checked = false;
            }
        }

        console.log(arr);
    }
    function addMachine(){
      $.ajax({
        url:'check_mach.php',
        type:'POST',
        data:{
          line_id:selectedlineid,
          arrr:arr
        },
        success:function(data){
          if(data=='success'){
            getMachine(selectedlineid);
            $('.modal-backdrop').hide();
            $("#assignMachine").hide();

            swal({
                    title: 'Success',
                    text: 'machines added successfully',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    onAfterClose: () => {
                      applySelectedStyle()
        }
                });

          }
          else{
            getMachine(selectedlineid);
            $('.modal-backdrop').hide();
            $("#assignMachine").hide();
            swal({
                    title: 'error',
                    text: 'Machines limit exceeded above 18',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    onAfterClose: () => {
                      applySelectedStyle()
        }
                });
          }
         
        },
        error:function(data){
          getMachine(selectedlineid);
            console.log("eeeeerror",data)
          }
      })

    }
    function delete_line(id, rowId) {
    console.log(id);
    
    $.ajax({
        url: 'deleteLine.php',
        method: 'POST',
        data: { lineId : id },
        success: function(response) {
          if(response=='success'){
          updateDropdown(selectedplantname,selectedplantid);
          $('.modal-backdrop').remove();
            $("#" + rowId).remove();
            $('#' + id).closest('.modal').modal('hide');
            console.log('Success:', response);
          }
          else{
            var data=JSON.parse(response);
        //     swal({
        //             title: 'error',
        //             text: `,
        //             icon: 'error',
        //             confirmButtonText: 'OK',
        //             onAfterClose: () => {
        //               applySelectedStyle()
        // }
        //         });
        
          alert(`first delete ${data.count} Machines `);
          var modalElement = document.getElementById("deleteMachine"+id); // Replace 'yourModalId' with your actual modal ID
          // var modalElement = document.getElementById('yourModalId');
    if (modalElement) {
        var modal = bootstrap.Modal.getInstance(modalElement);
        console.log(modal)
        if (modal) {
            modal.hide();
        } else {
            console.error('Modal instance not found.');
        }
    } else {
        console.error('Modal element not found.');
    }
          

               
          
   
   
          }
        },
        error: function(error) {
            console.error('Error deleting machine:', error);
        }
    });
}

function edit_line(id, rowId) {
        console.log(id, rowId);

        var edit_Machine = $("#editlineName" + id).val();

        console.log(edit_Machine);

        $.ajax({
            url: 'edit_lines.php',
            method: 'POST',
            data: { id: id, machine : edit_Machine },
            success: function(response) {
                $('.modal-backdrop').remove();
                $("#editMachine" + id).modal('hide');

                // updateDropdown(selectedplantname,selectedplantid);
                // getMachine(id);
                // alert("changed successfully")
                    swal({
                    title: 'Success',
                    text: `changed successfully`,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    onAfterClose: () => {
                      applySelectedStyle()
        }
                });
                var modalElement = document.getElementById("editMachine"+id); // Replace 'yourModalId' with your actual modal ID
          // var modalElement = document.getElementById('yourModalId');
    if (modalElement) {
        var modal = bootstrap.Modal.getInstance(modalElement);
        console.log(modal)
        if (modal) {
            modal.hide();
        } else {
            console.error('Modal instance not found.');
        }
    } else {
        console.error('Modal element not found.');
    }
             updateDropdown(selectedplantname,selectedplantid);
                // getMachine(id);
                console.log('Success:', response);
            },
            error: function(error) {
                console.error('Error updating user:', error);
            }
        });
    }

        // Add event listener to the select all checkbox
        // document.getElementById('selectAllCheckbox').addEventListener('click', update);
 
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>