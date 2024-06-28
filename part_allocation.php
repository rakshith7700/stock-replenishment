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
    <title>Product Allocation</title>
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

<div class="container-fluid">
    <div class="row">
      <div class="col-12">
       
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

      </div>
    </div>
  </div>

<div class="container-fluid   main_div">
    <section>
      <div class="container-fluid mt-5" >
        <div class="row  px-2">
          <div class="col-12 col-lg-5 mt-1 ">
            <img src="images/roop-polymer-logo.png" class="roopImg"  alt="Logo">
            <b class="ms-1  mainHeadg">PART ALLOCATION</b>
          </div>
          <div class="d-none d-lg-block col-lg-7 text-end">
            <button type="button"  class="btn border-0 dropdown btn-secondary me-3 responsiveText" style="background-color:#F5F5F5; color:#707070;" data-bs-toggle="dropdown" aria-expanded="false">
              &nbsp;<i class="bi bi-buildings text-secondary" style="color:#707070;"></i>&nbsp;<span id="dropdown-buttn">PLANTS</span>&nbsp;&nbsp;
            </button>
            <ul class="dropdown-menu" id="get-plant">
                          
            </ul>
        
            <button  class="btn border-0 btn-secondary me-3 responsiveText" style="background-color:#243A85CC; color:#F5F5F5;">
                <i style="color: rgb(241, 237, 237);" class="bi bi-upload" style="color:#707070;"></i>&nbsp;PART ALLOCATION
            </button>
        
            <button class="btn border-0 btn-secondary responsiveText" onclick="file()" style="background-color:#F5F5F5; color:#707070;" type="button" aria-expanded="false">
              &nbsp;<i class="bi bi-border-style " style=" color:#707070;"></i>&nbsp;FILE UPLOAD&nbsp;&nbsp;</button>  <input type="file" id="fileInput" style="display:none;">
        </div>
        </div>
      </div>
    </section>
</div>
<div class="container mt-3">
   <div class="row"><div class="col-12">
    <button class="btn btn-secondary" onclick="copy()">Copy</button>
    <button class="btn btn-success" onclick="Excel()">Excel</button>

   </div></div>
</div>
<div class="container-fluid d-none" id="hideContainer">
    <div class="row">
        <div class="col-12 col-lg-6 mt-4">
            <div class="row mx-auto trr d-flex justify-content-between align-items-center rounded-top-3 p-0">
                <div class="col-3" >MACHINE NUMBER</div>
                <div class="col-3">PART NUMBER</div>
                <div class="col-3">PART NAME</div>
                <div class="col-3"></div>
            </div>
            <div id="getMachine1" class="row p-0 d-flex justify-content-between align-items-center"></div>
        </div>

        <div class="col-12 col-lg-6 mt-lg-4">
            <div class="row mx-auto trr d-flex justify-content-between align-items-center rounded-top-3">
                <div class="col-3" >MACHINE NUMBER</div>
                <div class="col-3">PART NUMBER</div>
                <div class="col-3">PART NAME</div>
                <div class="col-3"></div>
            </div>
            <div id="getMachine2" class="row"></div>
        </div>
    </div>
</div>

<footer>
    <div class="container-fluid fixed-bottom bg-light" id="hideBlock">
        <div class="row px-2 py-1 d-flex align-items-center">
            <div class="col-3 col-md-1 col-lg-1">
                <img src="images/th.jpeg" alt="logo" height="30px" width="50px">
            </div>
            <div class="col-9 col-md-11 col-lg-8" id="lines_area">
                <!-- <button class="buttonText px-3 py-2 ms-0 text-white"><i class="bi bi-bounding-box iconSize2" style="color:white;"></i>&nbsp;&nbsp;Line 1</button> -->
                <!-- <button class="buttonText px-3 py-2 ms-0 text-white"><i class="bi bi-bounding-box iconSize2" style="color:white;"></i>&nbsp;&nbsp;Line 1</button> -->
            </div>
            <div class="col-12 col-lg-3 pt-1 text-end inditext">
                <span style="height: 3px; width: 3px; background-color: #3BFC2E66;">&nbsp;&nbsp;&nbsp;</span>&nbsp;Waiting for material
                <span style="height: 3px; width: 3px; background-color: #EF2B2B8C;">&nbsp;&nbsp;&nbsp;</span>&nbsp;Has material
            </div>
        </div>
    </div>
</footer>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
  function Excel() {
            // Get the table element
            var table = document.getElementById("getMachine1");

            // Initialize an array to hold the table data
            var tableData = [];

            // Get all rows in the table
            var rows = table.getElementsByClassName("chappak");

            // Loop through each row
            for (var i = 0; i < rows.length; i++) {
                // Get all cells in the current row
                var cells = rows[i].getElementsByClassName("cell");

                // Initialize an array to hold the row data
                var rowData = [];

                // Loop through each cell in the row
                for (var j = 0; j < cells.length; j++) {
                    rowData.push(cells[j].innerText);
                }

                // Add the row data to the table data
                tableData.push(rowData);
            }

            // Create a workbook and a worksheet
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet(tableData);

            // Append the worksheet to the workbook
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

            // Generate Excel file and trigger download
            XLSX.writeFile(wb, "table_data.xlsx");
        }
   function copy() {
            // Get the table element
            var table = document.getElementById("getMachine1");

            // Initialize a string to hold the table text
            var tableText = "";

            // Get all rows in the table
            var rows = table.getElementsByClassName("chappak");

            // Loop through each row
            for (var i = 0; i < rows.length; i++) {
                // Get all cells in the current row
                var cells = rows[i].getElementsByClassName("cell");

                // Loop through each cell in the row
                for (var j = 0; j < cells.length; j++) {
                    tableText += cells[j].innerText + "\t"; // Add cell text to the string with a tab delimiter
                }
                tableText += "\n"; // Add a newline after each row
            }

            // Create a temporary textarea to copy the text
            var tempTextarea = document.createElement("textarea");
            tempTextarea.value = tableText;
            document.body.appendChild(tempTextarea);

            // Select the text and copy it
            tempTextarea.select();
            document.execCommand("copy");

            // Remove the temporary textarea
            document.body.removeChild(tempTextarea);

            alert("Table text copied to clipboard");
        }
    var selectedplantid=null;

    
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
if (!role.checkbox.includes('access')) {
  $("#accessCon").remove();
}

  }
    var getPlant = "";
    if(ses_id==null){
    $.ajax({
        url: 'getAccess.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            var plants = response;
            plants.forEach(function(plant) {
                getPlant += `<li><a class="dropdown-item"  onclick="getLines('${plant.plant_id}','${plant.plant_name}')">${plant.plant_name}</a></li>`;
            });
            document.getElementById("get-plant").innerHTML = getPlant;
            $('#get-plant li:first-child a').click();
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
                getPlant += `<li><a class="dropdown-item"  onclick="getLines('${plant.plant_id}','${plant.plant_name}')">${plant.plant_name}</a></li>`;
            });
            document.getElementById("get-plant").innerHTML = getPlant;
            $('#get-plant li:first-child a').click();

        },
        error: function(error) {
            console.error('Error :', error);
        }

      })
    }
});
function file(){
  $('#fileInput').click();
}

function getLines(id,plantName) {
  var liness="";
    console.log(id);
    var dropdownButton = document.getElementById("dropdown-buttn");
    console.log(plantName)
    console.log(id);
    selectedplantid = id;
    dropdownButton.innerHTML = plantName;
    $.ajax({
        url:'plants.php',
        type:'GET',
       
        success:function(data){

            var result=JSON.parse(data);
            console.log(result)
            result.lines.forEach(function(item){
                console.log(item.line_name)
                if(item.plant_id==id){
                liness+=`<button class="buttonText px-3 py-2 ms-0 mx-2  foot-butt" style="color:gray" onclick="getMachines(${item.line_id})"><i class="bi bi-bounding-box iconSize2" style="color:gray;"></i>&nbsp;&nbsp;${item.line_name}</button>`;
                }
            }) 
            $('#lines_area').html(liness);
            $('#lines_area button:first-child ').click();
           

           
        },
        error:function(error){
            console.error('Error fetching tasks:', error);
        }

    })
   




   
}
$(document).on('click', '#lines_area button', function() {
    // var lineId = $(this).data('line-id');
    // getMachines(lineId); 
    $(this).css('background-color', '#243A85CC');
    $(this).css('color', 'white');
    // $(this).find("i").css('color', 'white');


    //  $(this).removeClass('text-secondary').addClass('text-white');
   
    $('#lines_area button').not(this).css('background-color', '');
    // $('#lines_area button i').not(this).css('color', '');
    $('#lines_area button').not(this).css('color', '');
    // $('#lines_area button').removeClass('text-white').addClass('text-secondary');

});
function getMachines(id) {
    console.log("chhammak",id);

    $.ajax({
        url: 'partAllocMachine.php',
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
                        return `
                            <div class="col-12 mx-auto d-flex justify-content-between align-items-center py-1 my-2 chappak responsiveText" id="plant-row-${machine.machine_id}" style="width:96%; background-color:#F5F5F5;">
                                <div class="col-3 cell">${machine.machine_name}</div>
                                <div class="col-3 ps-1">${machine.part_number}</div>
                                <div class="col-3 ps-3">${machine.part_name}</div>
                                <div class="col-3 text-end thisHidePart">
                                    <button type="button" class="border-0" data-bs-toggle="modal" data-bs-target="#exampleModal${machine.machine_id}" style="background: none; border: none;">
                                        <i class="bi bi-pencil-square text-secondary"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal${machine.machine_id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT MACHINE</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="form-row d-flex flex-column justify-content-between">
                                                    <span>Machine Number</span>
                                                    <input type="text" id="machine${machine.machine_id}" value="${machine.machine_name}" class="form-control" placeholder="CP023" style="background-color:#F5F5F5; color: #010101;">
                                                    <span>Part Number</span>
                                                    <input type="text" id="partNumber${machine.machine_id}" value="${machine.part_number}" placeholder="PO9898997" class="form-control" style="background-color:#F5F5F5; color: #010101;">
                                                    <span>Part Name</span>
                                                    <input type="text" id="partName${machine.machine_id}" value="${machine.part_name}" placeholder="Ring0427" class="form-control" style="background-color:#F5F5F5; color: #010101;">
                                                </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                        <button type="button" class="buttonT px-3 py-2" data-bs-dismiss="modal">CANCEL</button>
                                        <button type="button" onclick="editPlant(this.id, 'plant-row-${machine.machine_id}', '${machine.machine_id}')" id="${machine.machine_id}" class="buttonT px-3 py-2" style="background-color:#243A85CC; color:#FFFFFF;">UPDATE</button>
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
                document.getElementById("hideContainer").classList.remove("d-none");
                if(role!=null){
                if (role.checkbox.includes('part-assignment') && role.part_assignment === 'read-only') {
                 $(".thisHidePart").css("visibility", "hidden");
              }
            }


            } else {
                console.error('Response is not an array:', response);
            }
        },
        error: function(error) {
            console.error('Error fetching machines:', error);
        }
    });
}
function editPlant(id, rowId, inputId) {
    console.log(id);
    var editMachine = $("#machine" + inputId).val();
    console.log(editMachine);
    var editPartNumber = $("#partNumber" + inputId).val();
    var editPartName = $("#partName" + inputId).val();

    $.ajax({
        url: 'editPartAlloc.php',
        method: 'POST',
        data: { id: id, machine: editMachine, partNumber: editPartNumber, partName: editPartName },
        success: function(response) {
            $('.modal-backdrop').remove();
            $("#exampleModal" + id).modal('hide');
            if(response=='success'){
            $("#" + rowId).html(`
                <div class="col-3">${editMachine}</div>
                <div class="col-3 ps-1">${editPartNumber}</div>
                <div class="col-3 ps-3">${editPartName}</div>
                <div class="col-3 text-end">
                    <button type="button" class="border-0" data-bs-toggle="modal" data-bs-target="#exampleModal${inputId}" style="background: none; border: none;">
                        <i class="bi bi-pencil-square text-secondary"></i>
                    </button>
                </div>
            `);
            }

            console.log('Success:', response);
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