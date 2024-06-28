<?php
session_start();
require_once "config.php";
if($_SESSION['u']==null){
  header("location:loginmain.php");
}
// if($_SESSION['a']==null){
//     header("location:loginmain.php");
//   }
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
    <title>Machine-2</title>
    
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Xen8TnLrWbIeQny9uYBJulktz9fISDKrlf1MCd9VRAGvLE9qI4Z/nFM8DlClcJZZk7okhGzjZwnfCziSj4I3gw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Xen8TnLrWbIeQny9uYBJulktz9fISDKrlf1MCd9VRAGvLE9qI4Z/nFM8DlClcJZZk7okhGzjZwnfCziSj4I3gw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <style>
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
                        <li><a class="dropdown-item" href="machine.php">Machines</a></li>
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

                    <li class="nav-item dropdown dropstart my-2 d-lg-none">
                                      <a href="#" class="dropdown text-dark text-decoration-none responsiveText" id="dropdown-button" data-bs-toggle="dropdown" aria-expanded="false"  ><i class="bi bi-buildings text-dark"></i>&nbsp;&nbsp;RPL/CHE/PROD&nbsp;&nbsp;</a>
                          <ul class="dropdown-menu" id="dropdown-menu">
                              <li><a class="dropdown-item" href="#">RPL/CHE/PROD</a></li>
                              <li><a class="dropdown-item" href="#">RPL/CHE/PROD</a></li>
                              <li><a class="dropdown-item" href="#">RPL/CHE/PROD</a></li>
                              <li><a class="dropdown-item" href="#">RPL/CHE/PROD</a></li>
                              <li><a class="dropdown-item" href="#">RPL/CHE/PROD</a></li>
                          </ul>
                    </li>
                    <li class="nav-item dropdown dropstart my-md-1 my-2 d-lg-none">
                      <a href="#" class="dropdown text-dark text-decoration-none responsiveText" data-bs-toggle="modal" data-bs-target="#addLineModal"  ><i class="fas fa-plus fa-sm text-dark"></i>&nbsp;&nbsp;MACHINE&nbsp;&nbsp;</a>
                    </li>
                    <li class="nav-item dropdown dropstart my-2 d-lg-none">
                      <a href="#" class="dropdown text-dark text-decoration-none responsiveText"  ><i class="bi bi-file-earmark text-dark"></i>&nbsp;&nbsp;FILE UPLOAD&nbsp;&nbsp;</a>
                    </li>
                    <li class="nav-item dropdown dropstart my-2 d-lg-none">
                      <a href="#" class="dropdown text-dark text-decoration-none responsiveText"  ><i class="bi bi-download text-dark"></i>&nbsp;&nbsp;SAMPLE EXCEL&nbsp;&nbsp;&nbsp;&nbsp</a>

                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
    </nav>
      </div>
    </div>
  </div>

  <section>
      <div class="container-fluid mt-5" >
        <div class="row  px-2">
          <div class="col-12 col-lg-3  ">
            <img src="images/roop-polymer-logo.png" class="roopImg"  alt="Logo">
            <b class="ms-1  mainHead">MACHINE</b>
          </div>
          <div class="col-12 col-lg-9 text-end">
          <button href="#" class="btn btn-sm ab border  border-0 me-2 d-none d-lg-inline responsiveText" id="plantName" data-bs-toggle="dropdown" aria-expanded="false"  >&nbsp;&nbsp;<i style="color: gray;" class="bi bi-buildings text-secondary"></i>&nbsp;&nbsp;PLANT&nbsp;&nbsp;</button>
            <ul class="dropdown-menu responsiveText" id="get-plant">
                <!-- <li><a class="dropdown-item" href="#">RPL/CHE/PROD</a></li>
                <li><a class="dropdown-item" href="#">RPL/CHE/PROD</a></li>
                <li><a class="dropdown-item" href="#">RPL/CHE/PROD</a></li>
                <li><a class="dropdown-item" href="#">RPL/CHE/PROD</a></li>
                <li><a class="dropdown-item" href="#">RPL/CHE/PROD</a></li> -->
            </ul>
           
         
            <button type="button" class="btn btn-sm border border-0 mx-3 pe-3 d-none  responsiveText " id="addMachine" data-bs-toggle="modal" data-bs-target="#createMachine">
              &nbsp;&nbsp;<i style="color: gray;" class="fas fa-plus fa-sm text-secondary"></i>&nbsp;&nbsp;MACHINE
            </button>
            <div class="modal fade" id="createMachine" tabindex="-1" aria-labelledby="addLineModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                <div class="modal-content border-0">
                  <div class="modal-header border-0">
                    <h5 class="modal-title subHead" id="addLineModalLabel">ADD MACHINE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p class="text-start responsiveText">MACHINE NUMBER</p>
                    <input type="text" id="newMachine" class="form-control responsiveText" style="width: 100%; background-color: #F5F5F5;">
                  </div>
                  <div class="modal-footer border-0">
                    <button type="button " class="buttonT px-3 py-2" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" onclick="addMachine()" class="buttonT px-3 py-2 text-white" style="background-color:#243A85CC;">ADD</button>
                  </div>
                </div>
              </div>
            </div>
          
          <button onclick="file()" class="btn btn-sm ab border  border-0  mx-2 pe-3 d-none d-lg-inline responsiveText"  >&nbsp;&nbsp;<i style="color: gray;" class="bi bi-file-earmark"></i>&nbsp;&nbsp;FILE UPLOAD&nbsp;&nbsp;</button>
     
          <input type="file" id="file" style="display: none;">
          <button id="downloadExcel" class="btn btn-sm ab border  border-0  ms-3 d-none d-lg-inline responsiveText"  ><i style="color: gray;" class="bi bi-download"></i>&nbsp;&nbsp;SAMPLE EXCEL&nbsp;&nbsp;</button>
         
        </div>
        </div>
      </div>
    </section>



    
<div id="machineHead1" class="container-fluid d-none">
  <div class="row">
        
        <!-- <div class="col-12 col-lg-6   mt-4" >
            <div class="row p-0 d-flex justify-content-center" >
            <div class="col-11 head1 ">MACHINE NUMBER</div>            
            </div>
        </div> -->
        <div class="col-12 col-lg-6 mt-4">
        <div  class="head1 row mx-auto" style="width:95%;">MACHINE NUMBER</div>
            <div id="getMachine1" class="row d-flex justify-content-center p-0">
            </div>
        </div>
            
        <div class="col-12 col-lg-6 mt-4">
        <div  class="head1 row mx-auto" style="width:95%;">MACHINE NUMBER</div>
            <div id="getMachine2" class="row d-flex justify-content-center">
            </div>
        </div>
    </div>
</div>




                    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
 var selectedplantid=null;
//  var selectedLineId = null;
var selectedplantname=null;
 var getPlant = "";
 $(document).ready(function() {
  if(role!=null){
  if (!role.checkbox.includes('dash-board')) {
  $("#dashBoardCon").remove();
}
if (!role.checkbox.includes('lines')) {
  $("#linesCon").remove();
}
if (!role.checkbox.includes('access')) {
  $("#accessCon").remove();
}
if (!role.checkbox.includes('part-assignment')) {
  $("#part_allocCon").remove();
}

  }
 
    // var getPlant = "";
    if(ses_id==null){
    $.ajax({
        url: 'getAccess.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            var plants = response;
            plants.forEach(function(plant) {
                getPlant += `<li><a class="dropdown-item"  onclick="getMachine(${plant.plant_id},'${plant.plant_name}')">${plant.plant_name}</a></li>`;
            });
            document.getElementById("get-plant").innerHTML = getPlant;
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
                getPlant += `<li><a class="dropdown-item"  onclick="getMachine(${plant.plant_id},'${plant.plant_name}')">${plant.plant_name}</a></li>`;
            });
            document.getElementById("get-plant").innerHTML = getPlant;
        },
        error: function(error) {
            console.error('Error :', error);
        }

      })
    }
});
function file(){
  $("#file").click();
}

document.getElementById('downloadExcel').addEventListener('click', function() {
    // Collect the data from the displayed machines
    var machines = [];
    document.querySelectorAll('[id^="plant-row-"]').forEach(function(row) {
        var machineName = row.textContent.trim();
        machines.push({
            'Machine Name': machineName
        });
    });

    // Generate the worksheet
    var ws = XLSX.utils.json_to_sheet(machines);

    // Create a new workbook
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Machines');

    // Generate the Excel file and trigger the download
    XLSX.writeFile(wb, 'machines.xlsx');
});



function getMachine(id,plantName) {
    console.log(id)
    selectedplantid=id;
    selectedplantname=plantName;
    // var selectedLineId = id;
  
    // console.log("defrefw"+selectedLineId);
    var dropdownButton = document.getElementById("plantName");
    
    dropdownButton.innerHTML = plantName;

    $.ajax({
        url: 'machineByLine.php',
        type: 'POST',
        data: { p_id: id},
        dataType: 'json',
        success: function(response) {
            if (Array.isArray(response)) {
                var machines = response;
                console.log(machines)

                var half = Math.ceil(machines.length / 2);
                var firstHalf = machines.slice(0, half);
                var secondHalf = machines.slice(half);

                function generateMachineHTML(machineList) {
                    return machineList.map(function(machine) {
                      if(machine.plant_id == id){
                        return `
                            <div class=" py-1 col-11 my-2 d-flex justify-content-between align-items-center responsiveText" style="background-color:#F5F5F5;" id="plant-row-${machine.machine_id}" >
                            ${machine.machine_name}
                             <div>
                             <button class="btn btn-link edit-plant" data-bs-toggle="modal" id="edit${machine.machine_id}"  data-bs-target="#editMachine${machine.machine_id}" style="background: none; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square text-secondary" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </button>
                        <span class="divider">|</span>
                        <button class="btn btn-link delete-plant" data-bs-toggle="modal" id="${machine.machine_id}" data-bs-target="#deleteMachine${machine.machine_id}" data-plant-name="" style="background: none; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash text-secondary" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg>
                        </button>
                             </div>
                            </div>

                            <div class="modal" id="editMachine${machine.machine_id}" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content px-5">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="editmodalLabel">EDIT MACHINE</h5>
                            </div>
                            <div class="modal-body">
                            <input type="text" id="editMachineName${machine.machine_id}" value="${machine.machine_name}" class="form-control py-2 my-2 rounded-1" placeholder="Shruti" style="background-color:#F5F5F5; color: #010101;">
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn" data-bs-dismiss="modal" style="color:#515151;">CANCEL</button>
                                <button type="button" class="btn" onclick="editMachine(${machine.machine_id}, 'plant-row-${machine.machine_id}')" style="background-color:#243A85CC;color: #FFFFFF;">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </div>

                            <div class="modal fade" id="deleteMachine${machine.machine_id}" tabindex="-1" aria-labelledby="deleteLineModalLabel" aria-hidden="true">
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
                    }
                }).join('');
                }
                let getMachine1HTML = generateMachineHTML(firstHalf);
                let getMachine2HTML = generateMachineHTML(secondHalf);
                document.getElementById("getMachine1").innerHTML = getMachine1HTML;
                document.getElementById("getMachine2").innerHTML = getMachine2HTML;
                document.getElementById("machineHead1").classList.remove('d-none');
                document.getElementById("addMachine").classList.remove('d-none');

            } else {
                console.log('Response is not an array:', response);
            }
        },
        error: function(error) {
            swal({
                    title: 'Error',
                    text: 'An error occurred while showing plants',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
        }
    });
}



function addMachine() {
    var new_machine = $('#newMachine').val();
    console.log("plant_id"+selectedplantid)
    plant_id = selectedplantid;
    
          $.ajax({
            url: 'createMachine.php',
            type: 'POST',
            data: {
                plant: plant_id,
                
                machine: new_machine

            },
            success: function(data) {
              if(data=='success'){
              getMachine(selectedplantid,selectedplantname);
                $('.modal-backdrop').remove();
                $("#createMachine").modal('hide');
                swal({
                    title: 'Success',
                    text: 'Machine created successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                $('#newMachine').val('');}
                else{
                  swal({
                    title: 'Error',
                    text: 'An error occurred ',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });

                }
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
   


function editMachine(id, rowId) {
        console.log(id, rowId);

        var edit_Machine = $("#editMachineName" + id).val();

        console.log(edit_Machine);

        $.ajax({
            url: 'editMachine.php',
            method: 'POST',
            data: { id: id, machine : edit_Machine, },
            success: function(response) {
                $('.modal-backdrop').remove();
                $("#editMachine" + id).modal('hide');

                $("#" + rowId).html(`
                <div class="col-12 d-flex justify-content-between align-items-center responsiveText" style="background-color:#F5F5F5;" id="plant-row-${id}" >
                            ${edit_Machine}
                             <div>
                             <button class="btn btn-link edit-plant" data-bs-toggle="modal" id="edit${id}"  data-bs-target="#editMachine${id}" style="background: none; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square text-secondary" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </button>
                        <span class="divider">|</span>
                        <button class="btn btn-link delete-plant" data-bs-toggle="modal" id="${id}" data-bs-target="#deleteMachine${id}" data-plant-name="" style="background: none; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash text-secondary" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg>
                        </button>
                             </div>
                            </div>
            `);
            swal({
                    title: 'Success',
                    text: 'Machine name changed successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                console.log('Success:', response);
            },
            error: function(error) {
                console.error('Error updating user:', error);
            }
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
            console.log('Success:', response);
        },
        error: function(error) {
            console.error('Error deleting machine:', error);
        }
    });
}

</script>

</body>
</html>