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
  <title>access</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
       .modal-backdrop.show {
      z-index: 1;
    }

    .modal {
      z-index: 1050;
    }
    .modal2inputs {
      margin-top: 10px;
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
                  <li><a class="dropdown-item" href="tableview.php" id="dashBoardCon">Dashboard</a></li>
                        <li><a class="dropdown-item" href="machine.php" id="machinesCon">Machines</a></li>
                        <li><a class="dropdown-item" href="lines.php" id="linesCon">Lines</a></li>
                        <li><a class="dropdown-item" href="part_allocation.php" id="part_allocCon">Partallocation logs</a></li>
                        <li><a class="dropdown-item" href="access_plant.php" id="accessCon">Access</a></li>
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
  <div class="row mt-5 pt-3 ps-2">
    <div class="col-12 ">
      <img src="images/roop-polymer-logo.png" class="roopImg" alt="Logo">
      <b class="ms-1 access">ACCESS</b>
    </div>
  </div>
  <div class="container-fluid con3">
    <div class="row mt-5 me-2 me-md-4">
      <!-- <div class="col-lg-9  col-12 ms-5"></div> -->
      <div class=" col-12 d-flex justify-content-end"><ul class="nav nav-pills " id="pills-tab" role="tablist">
        <li class=" me-2" role="presentation">
            <button class="nav-link active  mb-1" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" onclick="plants()" aria-controls="pills-home" aria-selected="true">PLANTS</button>
        </li>
        <li class=" me-2" role="presentation">
            <button class="nav-link  mb-1" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" onclick="roles()" role="tab" aria-controls="pills-profile" aria-selected="false">ROLES</button>
        </li>
        <li class="" role="presentation">
            <button class="nav-link  mb-1" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" onclick="users()" role="tab" aria-controls="pills-contact" aria-selected="false">USERS</button>
        </li>
    </ul>
</div>
    </div>

    <div class="container-fluid  rounded rounded-4 createplantblock w-100 px-4 pt-3 pb-5">
      <div class="row mt-1 pt-3">
        <div class="col-md-6 pb-5">
            <form method="post">
          <div class="createplant">Create Plant</div>
          <div class="py-2 plantname">
            <lable>Plant Name</lable>
            <div><input type="text" id="plantname" class="w-50 p-2 seatrubber" placeholder="Seat Rubber"></div>
            
            <div><label class="assignStatus mt-5">Assign Status</label></div>
            <div class="col"><button type="button" class="btn btn-sm rounded rounded-1 px-2 statusbtn"
                data-bs-toggle="modal" data-bs-target="#statusModal"
                style="color:white;background-color: #243A8599;font-family: Segoe UI;font-size:14px;">+ STATUS</button>
            </div>
            <div class="px-3 py-3 mt-1 w-50 loademptyhold"><div class="d-flex justify-content-between ">
              </div>
              
                <div id="colors"></div>
            </div>

                  <div class="row ps-5">
                       <div class="col-6 py-2 text-end ">
                    <div><button type="button" onclick="addplant()" id="ramu" class=" btn btn-sm rounded rounded-1 px-3 mx-2 "
                          style="color:#FFFFFF;background-color: #243A8599;font-family: Segoe UI;font-size:14px;">SAVE</button>
                        </div>
                       </div>
                     </div>
          </div>
          <div class="modal" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content px-5">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="statusModalLabel">Add Status</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-sm-9">
                                <label for="statusLabel1" class="col-form-label modal1lbl">Status Name</label>
                                <input type="text" class="form-control h-75 modal1inputs" id="statusLabel1" placeholder="Hold">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-9">
                                <label for="statusLabel2" class="col-form-label modal1lbl">HEX Number</label>
                                <input type="text" class="form-control h-75 modal1inputs" readonly id="statusLabel2" placeholder="#125457">
                            </div>
                            <div class="col-sm-3 my-3">
                                <div id="color-picker" style="height: 100%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                        <button type="button" class="btn"  style="background-color:#243A85CC;color: #FFFFFF;" id="addStatusButton">ADD</button>
                    </div>
                </div>
            </div>
            </div>
            </form>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
          <div class="col-lg-12">
            <p>
            <h4 class="plantlists">Plant Lists</h4>
            </p>

            <table style="width:100%;">
            <thead>
              <tr>
                <th class="p-2 tableth">PLANT NAME</th>
              </tr>
            </thead>
            <form method="post">
              <tbody id="task-container">

              </tbody>
            </form>  
             
            </table>


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
<script>
    var colors={
       
    }
 var navbar = document.getElementById("bottom");
  var lastScrollTop = 0;

  
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
      var currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

      if (currentScrollTop > lastScrollTop) {
         
          navbar.style.display = "none";
      } else {
         
          navbar.style.display = "block";
      }

      lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop; 
  }
</script>

  

  <!-- Modal -->
  <!-- Include Pickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>

<!-- Include Pickr JS -->
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr@1.8.2/dist/pickr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var statusLabel2 = document.getElementById('statusLabel2');
        var addStatusButton = document.getElementById('addStatusButton');

        // Initialize Pickr
        const pickr = Pickr.create({
            el: '#color-picker',
            theme: 'classic',
            default: '#125457',
            components: {
                preview: true,
                opacity: true,
                hue: true,

                interaction: {
                    hex: true,
                    
                    save: true
                }
            }
        });

        // Update HEX input field when color is changed
        pickr.on('change', (color, instance) => {
            statusLabel2.value = color.toHEXA().toString();
        });

        addStatusButton.addEventListener('click', function () {
            var statusName = document.getElementById('statusLabel1').value;
            var statusColor = statusLabel2.value;

            console.log('Status Name:', statusName);
            console.log('Status Color:', statusColor);
            var status_name=$('#statusLabel1').val();
            var status_color=$('#statusLabel2').val();
            
            if(status_name!='' && status_color!=''){
            colors[status_name]=status_color;
            console.log(colors);
            var content=`<small class="mb-2 w-100">${status_name}&nbsp;&nbsp;<div class="mx-4" style="background-color:${status_color}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></small>`;
            $('#colors').append(content);
            }
            else{
                $('#statusLabel1').css('border', '1px solid red');
                $('#statusLabel2').css('border', '1px solid red');
            }

 
            var statusModal =bootstrap.Modal.getInstance(document.getElementById('statusModal'));
            statusModal.hide();
        });
    });
</script>

  <div class="modal" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content px-5">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="editmodalLabel">EDIT PLANT</h5>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-sm-12">
              <label for="plantNameInput" class="col-form-label modal2lbl">Plant Name</label>
              <input type="text" class="form-control h-75 w-100 modal2inputs" id="plantNameInput">
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
          <button type="button" class="btn" style="background-color:#243A85CC;color: #FFFFFF;"
            id="updatePlantButton">UPDATE</button>
        </div>
      </div>
    </div>
  </div>

  

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var editButtons = document.querySelectorAll(".edit-plant");

      editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
          var plantName = button.getAttribute("data-plant-name");
          var plantNameInput = document.getElementById("plantNameInput");

          plantNameInput.value = plantName;
        });
      });

      var updatePlantButton = document.getElementById("updatePlantButton");
      updatePlantButton.addEventListener("click", function () {
        var plantName = document.getElementById("plantNameInput").value;

        console.log('Updated Plant Name:', plantName);

        var editmodal = new bootstrap.Modal(document.getElementById('editmodal'));
        editmodal.hide();
      });
    });
  </script>

  <!-- Modal for delete Plant -->
  <div class="modal" id="deletemodal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content px-5">
        <div class="modal-body" style="padding: 0  0 -2rem 0;">
          <h6 class="modal-title pt-2 px-2" id="deletemodalLabel">DELETE PLANT</h6>
          <div class="row">
            <div class="modal-body mx-1" style="padding: 0  0 -20px 0;">
              Are you sure you want to delete the plant?
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
          <button type="button" class="btn" style="background-color:#243A85CC;color: #FFFFFF;"
            id="updatePlantButton">DELETE</button>
        </div>
      </div>
    </div>
  </div>

  
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var editButtons = document.querySelectorAll(".edit-plant");

      editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
          var plantName = button.getAttribute("data-plant-name");
          var plantNameInput = document.getElementById("plantNameInput");

          plantNameInput.value = plantName;
        });
      });

      var updatePlantButton = document.getElementById("updatePlantButton");
      updatePlantButton.addEventListener("click", function () {
        var plantName = document.getElementById("plantNameInput").value;

        console.log('Updated Plant Name:', plantName);

        var deletemodal = new bootstrap.Modal(document.getElementById('deletemodal'));
        deletemodal.hide();
      });
    });
  </script>
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
  if(role!=null){
  // if (!role.checkbox.includes('access')) {
   document.getElementById("ramu").disabled=true;
   document.getElementsByClassName("jabili").disabled=true;

// }
  }

    function isDivEmpty(div) {
    return div.innerHTML.trim() === '';
}
const divElement = document.getElementById('colors');

    function addplant(){
        var plant_name=$('#plantname').val();
        if(plant_name==''){
            swal({
                      title: 'Error',
                      text:'Enter plant name',
                      icon: 'error',
                      confirmButtonText: 'OK'
                    });
                    plant_name="";

        }
        else if(isDivEmpty(divElement)){
          swal({
                      title: 'Error',
                      text:'Select status',
                      icon: 'error',
                      confirmButtonText: 'OK'
                    });
            plant_name="";

        }
        else{
            $.ajax({
                url:'accessplant_back.php',
                type:'POST',
                data:{
                    plant:plant_name,
                    color_data:colors
                },
                success:function(data){
                    if(data=='success'){
                       get_newplant();
                       $('#plantname').val('');
                       $('#colors').hide();
                        swal({
                      title: 'Success',
                      text:'Plant generated successfully',
                      icon: 'success',
                      confirmButtonText: 'OK'
                    });

                    }
                    else{
                        swal({
                      title: 'Error',
                      text:data,
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
            });
        }
        

    }
    function get_newplant(){
      var newplant='';
      $.ajax({
        url:'plants.php',
        type:'GET',
        success:function(data){
          data=JSON.parse(data);
          data.plants.forEach(function(plant){
            status_colors=JSON.parse(plant.colours);
            var ramu=Object.keys(status_colors);
                console.log("selfie",status_colors)
                let colorInputs = '';
                  for (const [key, value] of Object.entries(status_colors)) {
                    colorInputs += `
                      <div class="col-sm-12">
                        <input type="text" class="form-control  mt-3" id="${key}Name${plant.plant_id}" value="${key}" >
                        <input type="color" class="form-control" id="${key}Color${plant.plant_id}" value="${value}">
                      </div>`;
                  }
            // console.log("item raja",item)
          newplant+=`<tr id="plant-row-${plant.plant_id}">
            <td class="tabledatarows px-2">
              <span id="plantContent">${plant.plant_name}</span>
              <small>
                <!-- Edit button -->
                <button type="submit" class="btn btn-link edit-plant jabili" data-bs-toggle="modal" data-bs-target="#editmodal${plant.plant_id}" style="background: none; border: none;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                  </svg>
                </button>
                <!-- Edit modal -->
                <div class="modal" id="editmodal${plant.plant_id}" tabindex="-1" aria-labelledby="editmodalLabel${plant.plant_id}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content px-5">
                      <div class="modal-header border-0">
                        <h5 class="modal-title" id="editmodalLabel${plant.plant_id}">EDIT PLANT</h5>
                      </div>
                      <div class="modal-body">
                        <div class="row mb-3">
                          <div class="col-sm-12 mb-3">
                            <label for="plantNameInput${plant.plant_id}" class="col-form-label modal2lbl">Plant Name</label>
                            <input type="text" class="form-control h-75 w-100 modal2inputs" id="plantNameValue${plant.plant_id}" value="${plant.plant_name}">
                          </div>
                          <!-- Color inputs -->
                          ${colorInputs}
                          <!-- Container for dynamic status inputs -->
                          <div id="status-container-${plant.plant_id}"></div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addStatusInput(${plant.plant_id})">Add Status</button>
                             

                      </div>
                      <div class="modal-footer border-0">
                        <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                        <!-- Update button -->
                        <button type="button" class="btn" onclick="editPlant(${plant.plant_id}, 'plant-row-${plant.plant_id}', 'plantNameValue${plant.plant_id}',' ${ramu.toString()}')" style="background-color:#243A85CC;color: #FFFFFF;">
                          UPDATE
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <span class="divider px-1">|</span>
                <!-- Delete button -->
                <button class="btn btn-link delete-plant jabili" data-bs-toggle="modal" id="${plant.plant_id}" data-row-id="plant-row-${plant.plant_id}" data-bs-target="#deletemodal${plant.plant_id}" data-plant-name="" style="background: none; border: none;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                  </svg>
                </button>
                <!-- Delete modal -->
                <div class="modal" id="deletemodal${plant.plant_id}" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content px-5">
                      <div class="modal-body" style="padding: 0 0 -2rem 0;">
                        <h6 class="modal-title pt-2 px-2" id="deletemodalLabel">DELETE PLANT</h6>
                        <div class="row">
                          <div class="modal-body mx-1" style="padding: 0 0 -20px 0;">
                            Are you sure you want to delete the plant?
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer border-0">
                        <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                        <!-- Delete button -->
                        <button type="submit" class="btn" onclick="deletePlant(this.id, 'plant-row-${plant.plant_id}')" style="background-color:#243A85CC;color: #FFFFFF;" id="${plant.plant_id}">DELETE</button>
                      </div>
                    </div>
                  </div>
                </div>
              </small>
            </td>
          </tr>`;
          })
          document.getElementById("task-container").innerHTML = newplant;
        },
        error:function(error) {
            console.error('Error fetching tasks:', error);
        }
        

      })
    }
    

  function addStatusInput(plantId) {
      const newStatusId = `newStatus${Date.now()}`;
      const newStatusInput = `
        <div class="col-sm-12 mb-3" id="${newStatusId}">
          <label for="statusName${plantId}" class="col-form-label modal2lbl">Status</label>
          <input type="text" class="form-control  w-100 modal2inputs" id="statusName${plantId}" placeholder="Status Name">
          <label for="statusColor${plantId}" class="col-form-label modal2lbl mt-2">Color</label>
          <input type="color" class="form-control  w-100 modal2inputs small-color-picker" id="statusColor${plantId}">
          <button type="button" class="btn btn-link text-danger" onclick="removeStatusInput('${newStatusId}')" style="text-decoration: none;">Remove</button>
        </div>`;
      document.getElementById(`status-container-${plantId}`).innerHTML += newStatusInput;
    }
//   function addStatusInput(plantId) {
//     const container = document.getElementById('status-container-' + plantId);
//     const newStatusInput = document.createElement('div');
//     newStatusInput.classList.add('col-sm-12', 'mb-3');
//     newStatusInput.innerHTML = `
//         <input type="text" class="form-control mt-3" placeholder="Status Name">
//         <input type="color" class="form-control mt-1" value="#000000" oninput="updateColorValue(${plantId})">
//     `;
//     container.appendChild(newStatusInput);
// }

function removeStatusInput(id) {
    document.getElementById(id).remove();
}

function updateColorValue(inputId) {
    var colorInput = document.getElementById(inputId);
    if (colorInput) {
        var hexValue = colorInput.value;
        colorInput.value = hexValue;
    } else {
        console.error('Element not found for ID:', inputId);
    }
}

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
    var getPlant = "";
    $.ajax({
        url: 'getAccess.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            var plants = response;
            plants.forEach(function(plant) {
                var statusColors = JSON.parse(plant.colours);
                let colorInputs = '';
                for (const [key, value] of Object.entries(statusColors)) {
                    colorInputs += `
                      <div class="col-sm-12">
                        <input type="text" class="form-control mt-3" id="${key}Name${plant.plant_id}" value="${key}">
                        <input type="color" class="form-control" id="${key}Color${plant.plant_id}" value="${value}" oninput="updateColorValue('${key}Color${plant.plant_id}')">
                      </div>`;
                }
                var ramu=(Object.keys(statusColors));
                getPlant += `<tr id="plant-row-${plant.plant_id}">
                    <td class="tabledatarows px-2">
                        <span id="plantContent">${plant.plant_name}</span>
                        <small>
                            <!-- Edit button -->
                            <button type="submit" class="btn btn-link edit-plant" data-bs-toggle="modal" data-bs-target="#editmodal${plant.plant_id}" style="background: none; border: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                            </button>
                            <!-- Edit modal -->
                            <div class="modal" id="editmodal${plant.plant_id}" tabindex="-1" aria-labelledby="editmodalLabel${plant.plant_id}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content px-5">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title" id="editmodalLabel${plant.plant_id}">EDIT PLANT</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-sm-12 mb-3">
                                                    <label for="plantNameInput${plant.plant_id}" class="col-form-label modal2lbl">Plant Name</label>
                                                    <input type="text" class="form-control h-75 w-100 modal2inputs" id="plantNameValue${plant.plant_id}" value="${plant.plant_name}">
                                                </div>
                                                <!-- Color inputs -->
                                                ${colorInputs}
                                                <!-- Container for dynamic status inputs -->
                                                <div id="status-container-${plant.plant_id}"></div>
                                            </div>
                                            <button type="button" class="btn btn-primary" onclick="addStatusInput(${plant.plant_id})">Add Status</button>
                                            

                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                                            <!-- Update button -->
                                            <button type="button" class="btn" onclick="editPlant(${plant.plant_id}, 'plant-row-${plant.plant_id}', 'plantNameValue${plant.plant_id}', '${ramu.toString()}')" style="background-color:#243A85CC;color: #FFFFFF;">
                                                UPDATE
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="divider px-1">|</span>
                            <!-- Delete button -->
                            <button class="btn btn-link delete-plant" data-bs-toggle="modal" id="${plant.plant_id}" data-row-id="plant-row-${plant.plant_id}" data-bs-target="#deletemodal${plant.plant_id}" data-plant-name="" style="background: none; border: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg>
                            </button>
                            <!-- Delete modal -->
                            <div class="modal" id="deletemodal${plant.plant_id}" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content px-5">
                                        <div class="modal-body" style="padding: 0 0 -2rem 0;">
                                            <h6 class="modal-title pt-2 px-2" id="deletemodalLabel">DELETE PLANT</h6>
                                            <div class="row">
                                                <div class="modal-body mx-1" style="padding: 0 0 -20px 0;">
                                                    Are you sure you want to delete the plant?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                                            <!-- Delete button -->
                                            <button type="submit" class="btn" onclick="deletePlant(this.id, 'plant-row-${plant.plant_id}')" style="background-color:#243A85CC;color: #FFFFFF;" id="${plant.plant_id}">DELETE</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </small>
                    </td>
                </tr>`;
            });
            document.getElementById("task-container").innerHTML = getPlant;
        },
        error: function(error) {
            console.error('Error fetching plants:', error);
        }
    });
});

function deletePlant(id, rowId) {
    $.ajax({
        url: 'postAccess.php',
        method: 'POST',
        data: { id: id },
        success: function(response) {
            $('.modal-backdrop').remove();
            $("#" + rowId).remove();
            console.log('Success:', response);
        },
        error: function(error) {
            console.error('Error deleting plant:', error);
        }
    });
}

function editPlant(plantId, rowId, plantNameInputId, colorKeys) {
    var newPlantName = $("#" + plantNameInputId).val();

    var updatedColors = {};
    let colorK = colorKeys.split(',');
    colorK.forEach(key => {
        var colorKey = $("#" + key + "Name" + plantId).val();
        var colorValue = $("#" + key + "Color" + plantId).val();
        updatedColors[colorKey] = colorValue;
    });

    // Process dynamically added status inputs
    $("#status-container-" + plantId).find(".col-sm-12").each(function() {
        var statusKey = $(this).find('input[type="text"]').val();
        var statusColor = $(this).find('input[type="color"]').val();
        updatedColors[statusKey] = statusColor;
    });

    // Convert updatedColors object to JSON string
    var updatedColorsJSON = JSON.stringify(updatedColors);

    var data = {
        id: plantId,
        plantName: newPlantName,
        colors: updatedColorsJSON  // Ensure colors are sent as a JSON string
    };

    $.ajax({
        url: 'editAccess.php',
        method: 'POST',
        data: data,
        success: function(response) {
            $('.modal-backdrop').remove();
            $("#editmodal" + plantId).modal('hide');  // Hide the modal using .modal('hide')
            $("#" + rowId).find("#plantContent").text(newPlantName);
            alert("edited successfully");
        },
        error: function(error) {
            console.error('Error updating plant:', error);
        }
    });
}



</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>