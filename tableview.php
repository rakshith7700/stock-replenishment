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
console.log("hbuhfebusrvhycue",role)
var ses_id=<?php echo json_encode($userRole); ?>;
console.log(ses_id)
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mixing area</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Xen8TnLrWbIeQny9uYBJulktz9fISDKrlf1MCd9VRAGvLE9qI4Z/nFM8DlClcJZZk7okhGzjZwnfCziSj4I3gw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Xen8TnLrWbIeQny9uYBJulktz9fISDKrlf1MCd9VRAGvLE9qI4Z/nFM8DlClcJZZk7okhGzjZwnfCziSj4I3gw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <section>
      <div class="container-fluid mt-5" >
        <div class="row  px-2">
          <div class="col-12 col-lg-5 ">
            <img src="images/roop-polymer-logo.png" class="roopImg"  alt="Logo">
            <b class="ms-1  mainHead" id="heading_area"></b>
          </div>
          <div class="d-none d-lg-block col-lg-7 text-end">
            <button type="button" id="dropdownButton" class="btn border-0 dropdown btn-secondary me-3 responsiveText" style="background-color:#F5F5F5; color:#707070;" data-bs-toggle="dropdown" aria-expanded="false">
              &nbsp;<i class="bi bi-buildings text-secondary" style="color:#707070;"></i>&nbsp;PLANTS&nbsp;&nbsp;
            </button>
            <ul class="dropdown-menu" id="dropdown-men">
               
            </ul>
        
            <button  class="btn border-0 btn-secondary me-3 responsiveText" id="part" style="background-color:#F5F5F5; color:#707070;"><a href="part_allocation.php" class="text-decoration-none text-secondary">
                <i style="color: gray;" class="bi bi-upload" style="color:#707070;"></i>&nbsp;PART ALLOCATION</a>
            </button>
        
            <button class="btn border-0 btn-secondary responsiveText" style="background-color:#243A85CC;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              &nbsp;<i class="bi bi-border-style text-light"></i>&nbsp;TABLE VIEW&nbsp;&nbsp;
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="gridView3.php">Grid view</a></li>
                <li><a class="dropdown-item" href="tableview.php">Table view</a></li>
            </ul>
        </div>
              
        
        
        </div>
      </div>
    </section>

<div class="container-fluid my-4">
    <div class="row ">
        <!-- <div class="col-1"></div> -->
           <!-- <div class="col-md-5 col-12 ms-md-5 ms-0  "> -->
           
                <table class="col-lg col-12 mx-lg-4  " >
                   <thead class="rounded-5" style="text-align: center;">
                    <tr class="trr">
                        <th class="t_left">MACHINE NUMBER</th>
                        <th>PART NUMBER</th>
                        <th>PART NAME</th>
                        <th class="t_right">STATUS</th>
                    </tr>
                   </thead>
                   <tbody id="tbody1" >
                   
                     
                   </tbody>
                    
                </table>
           <!-- </div> -->
          
           
                <table   class="col-lg col-12 mx-lg-4" >
                   <thead style="text-align: center;">
                    <tr class="trr table_dis">
                        <th class="t_left">MACHINE NUMBER</th>
                        <th>PART NUMBER</th>
                        <th>PART NAME</th>
                        <th class="t_right">STATUS</th>
                    </tr>
                   </thead>
                   <tbody id="tbody2">
                   
                  
                     

                   </tbody>
                </table>
               

           
           
    </div>
</div>

<footer>
      <div class="container-fluid fixed-bottom bg-light" id="hideBlock">
        <div class="row  px-2 py-1 d-flex align-items-center">
          <div class="col-3 col-md-1 col-lg-1">
            <img src="images/th.jpeg" alt="logo" height="30px" width="50px">
          </div>
          <div class="col-9 col-md-11 col-lg-8" id="line_btn">
            <!-- <button href="#" class=" buttonText px-3 py-2 ms-0 text-white"><i class="bi bi-bounding-box iconSize2" style="color:white;"></i>&nbsp;&nbsp;Line 1</button> -->
          </div>
          <div class="col-12 col-lg-3  pt-1 text-end inditext" >
            <span   class="" style="height: 3px; width: 3px; background-color: #3BFC2E66;">&nbsp;&nbsp;&nbsp; </span>&nbsp;Waiting for material
            <span class="" style="height: 3px; width: 3px; background-color: #EF2B2B8C;">&nbsp;&nbsp;&nbsp;  </span>&nbsp;Has material</div>
          </div>
        </div>
      </div>
</footer>
<script>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  var selectedplant=null;
  var s = "";
    var selectedplantid=null;
    var selectedlineid=null;
    $(document).ready(function() {

      if(role!=null){
        if (!role.checkbox.includes('part-assignment')) {
  $("#part_allocCon").remove();
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
      

    var ses_id = <?php echo json_encode($userRole); ?>;
    var s = ''; 
    if(role==null){
      
      document.getElementById("heading_area").innerHTML="PRODUCTION AREA";
    }
    else{
    if(role.checkbox.includes('dash-board') && role.dash_board === 'read-only'){
      document.getElementById("heading_area").innerHTML="MIXING AREA";

    }
    else{
      document.getElementById("heading_area").innerHTML="PRODUCTION AREA";


    }
  }
    
    function fetchPlantsAndPopulateDropdown() {
       
        if (ses_id == null) {
            $.ajax({
                url: 'getAccess.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var plants = response;
                    plants.forEach(function(plant, index) {
                        s += `<li><a class="dropdown-item"  onclick="get_lines('${plant.plant_name}', '${plant.plant_id}')">${plant.plant_name}</a></li>`;
                    });
                    
                   
                    document.getElementById("dropdown-men").innerHTML = s;
                    
                    
                    $('#dropdown-men li:first-child a').click();
                },
                error: function(error) {
                    console.error('Error fetching plants:', error);
                }
            });
        } else {
            $.ajax({
                url: "get_user_plants.php",
                type: "POST",
                data: {
                    id: ses_id
                },
                success: function(response) {
                    var plantss = JSON.parse(response);
                    plantss.forEach(function(plant, index) {
                        s += `<li><a class="dropdown-item"  onclick="get_lines('${plant.plant_name}', '${plant.plant_id}')">&nbsp;<i class="bi bi-buildings text-secondary" style="color:#707070;"></i>${plant.plant_name}</a></li>`;
                    });
                    
                   
                    document.getElementById("dropdown-men").innerHTML = s;
                    
                   
                    $('#dropdown-men li:first-child a').click();
                },
                error: function(error) {
                    console.error('Error fetching user plants:', error);
                }
            });
        }
    }

    
    fetchPlantsAndPopulateDropdown();
});
if(ses_id!=null){
 
if(role.checkbox.includes('dash-board') && role.dash_board === 'read-only'){
  
  $('.disableButton').each(function() {
        $(this).removeAttr('onclick');
    });

document.getElementById('part').disabled = true;
document.getElementById('dropdownButton').disabled = true;
// document.getElementById('rub').disabled = true;



function get_lines(name, id) {
    selectedplant = id;
    var btns = "";
    var dropdownButton = document.getElementById("dropdownButton");
    dropdownButton.innerHTML = `&nbsp;<i class="bi bi-buildings text-secondary" style="color:#707070;"></i>&nbsp;${name}&nbsp;&nbsp;`;
    
   
    $.ajax({
        url: 'plants.php',
        type: 'GET',
        success: function(data) {
            var result = JSON.parse(data);
            var lines = result.lines.filter(item => item.plant_id == id);
            
            lines.forEach(function(item, index) {
                btns += `<button class="buttonText px-3 py-2 ms-0 mx-2 text-secondary foot-butt" id="l-${item.line_id}" data-line-id="${item.line_id}"><i class="bi bi-bounding-box iconSize2" style="color:gray;"></i>&nbsp;&nbsp;${item.line_name}</button>`;
            });
            
            $('#line_btn').html(btns); 
            function clickButtonsSequentially(startIndex) {
                var buttons = $('#line_btn button');
                var currentIndex = startIndex >= 0 ? startIndex : 0;
                var nextIndex = (currentIndex + 1) % buttons.length;
                var currentButton = buttons.eq(currentIndex);
                
               
                currentButton.click();
                
                var delay = 5000; 
                
               
                if (nextIndex === 0) {
                    setTimeout(function() {
                        clickButtonsSequentially(nextIndex);
                    }, delay);
                } else {
                    setTimeout(function() {
                        clickButtonsSequentially(nextIndex);
                    }, delay);
                }
            }
            
            
            clickButtonsSequentially(0);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching lines:', error);
            swal({
                title: 'Error',
                text: 'An error occurred while fetching lines',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
}

// $(document).on('click', '#line_btn button', function() {
//     var lineId = $(this).data('line-id');
//     getMachine(lineId); 
//     $(this).css('background-color', '#243A85CC');
    
   
//     $('#line_btn button').not(this).css('background-color', '');
// });


$(document).on('click', '#line_btn button', function() {
    var lineId = $(this).data('line-id');
    getMachine(lineId);
});
}


else{

function get_lines(name, id) {
selectedplant = id;
var btns = "";
var dropdownButton = document.getElementById("dropdownButton");
dropdownButton.innerHTML = `&nbsp;<i class="bi bi-buildings text-secondary" style="color:#707070;"></i>&nbsp;${name}&nbsp;&nbsp;`

$.ajax({
    url: 'plants.php',
    type: 'GET',
    success: function(data) {
        var result = JSON.parse(data);
        result.lines.forEach(function(item) {
            if (item.plant_id == id) {
                btns += `<button class="buttonText px-3 py-2 ms-0 mx-2 text-secondary foot-butt" id="l-${item.line_id}" onclick="getMachine(${item.line_id})"><i class="bi bi-bounding-box iconSize2" style="color:gray;"></i>&nbsp;&nbsp;${item.line_name}</button>`;
            }
        });
        
        $('#line_btn').html(btns);
     
            $('#line_btn button:first-child').click();
            
        
    },
    error: function(xhr, status, error) {
        console.error('Error fetching lines:', error);
        swal({
            title: 'Error',
            text: 'An error occurred while fetching lines',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
});
  }


}
}
else{
function get_lines(name, id) {
selectedplant = id;
var btns = "";
var dropdownButton = document.getElementById("dropdownButton");
dropdownButton.innerHTML = `&nbsp;<i class="bi bi-buildings text-secondary" style="color:#707070;"></i>&nbsp;${name}&nbsp;&nbsp;`

$.ajax({
    url: 'plants.php',
    type: 'GET',
    success: function(data) {
        var result = JSON.parse(data);
        result.lines.forEach(function(item) {
            if (item.plant_id == id) {
                btns += `<button class="buttonText px-3 py-2 ms-0 mx-2  foot-butt" id="l-${item.line_id}" style="color:gray" onclick="getMachine(${item.line_id})"><i class="bi bi-bounding-box iconSize2" style="color:gray;"></i>&nbsp;&nbsp;${item.line_name}</button>`;
            }
        });
        
        $('#line_btn').html(btns);
     
            $('#line_btn button:first-child').click();
            $('#line_btn').on('click', 'button', function() {
        // Reset all button styles to default (gray) first
          // Set the clicked button style to red
          $(this).css('background-color', '#243A85CC');
        $(this).css('color', 'white');
        // $(this).find("i").css('color', 'white');
       $('#line_btn button').not(this).css('background-color', '');
    // $('#line_btn button i').not(this).css('color', '');
    $('#line_btn button').not(this).css('color', '');



        
      


    });
        
    },
    error: function(xhr, status, error) {
        console.error('Error fetching lines:', error);
        swal({
            title: 'Error',
            text: 'An error occurred while fetching lines',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
});
  }
}

// document.getElementById("access").removeAttribute("href");
$('#line_btn').on('click', 'button', function() {
        // Reset all button styles to default (gray) first
          // Set the clicked button style to red
          $(this).css('background-color', '#243A85CC');
        $(this).css('color', 'white');
        // $(this).find("i").css('color', 'white');
       $('#line_btn button').not(this).css('background-color', '');
    // $('#line_btn button i').not(this).css('color', '');
    $('#line_btn button').not(this).css('color', 'gray');



        
      


    });
 function getMachine(id) {
    console.log(id);
    selectedlineid=id;
    console.log("selected line id is"+selectedlineid)
    var text="";
   

    $.ajax({
        url: 'postMachine.php',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (Array.isArray(response)) {
                var machines = response;
                console.log(machines.fill_status)

                

                var half = Math.ceil(machines.length / 2);
                var firstHalf = machines.slice(0, half);
                var secondHalf = machines.slice(half);

                function generateMachineHTML(machineList) {
                  if(role!=null){
                  if(role.checkbox.includes('dash-board') && role.dash_board === 'read-only'){
                    return machineList.map(function(machine) {

                      console.log(machine)

                      
                        return `<tr>
                        <td class="ps-5">${machine.machine_name}</td>
                        <td>${machine.part_number}</td>
                        <td>${machine.part_name}</td>
                        <td class="text-center"><button class="border-0 border rounded-3 my-2 disableButton" style="background-color:${machine.fiill_color}"  type="button" id="${machine.machine_id}"
                         onclick="updatebutto(${machine.machine_id})">${machine.fill_status}</button></td>
                        </tr>
                          `;
                    }).join('');}
                    else{
                      return machineList.map(function(machine) {

                      console.log(machine)


                        return `<tr>
                        <td class="ps-5">${machine.machine_name}</td>
                        <td>${machine.part_number}</td>
                        <td>${machine.part_name}</td>
                        <td class="text-center"><button class="border-0 border rounded-3 my-2 disableButton" style="background-color:${machine.fiill_color}"  type="button" id="${machine.machine_id}"
                        onclick="updatebutton(${machine.machine_id})">${machine.fill_status}</button></td>
                        </tr>
                          `;
                      }).join('');
                    }
                  }
                    else{
                      return machineList.map(function(machine) {

                      console.log(machine)


                        return `<tr>
                        <td class="ps-5">${machine.machine_name}</td>
                        <td>${machine.part_number}</td>
                        <td>${machine.part_name}</td>
                        <td class="text-center"><button class="border-0 border rounded-3 my-2 disableButton" style="background-color:${machine.fiill_color}"  type="button" id="${machine.machine_id}"
                        onclick="updatebutton(${machine.machine_id})">${machine.fill_status}</button></td>
                        </tr>
                          `;
                      }).join('');
                    }
         
                }
                let getMachine1HTML = generateMachineHTML(firstHalf);
                let getMachine2HTML = generateMachineHTML(secondHalf);
                document.getElementById("tbody1").innerHTML = getMachine1HTML;
                document.getElementById("tbody2").innerHTML = getMachine2HTML;
                
                
                

            } else {
                console.error('Response is not an array:', response);
            }
        },
        error: function(error) {
            console.error('Error fetching machines:', error);
        }
    });
}
// const socket = new WebSocket('ws://localhost:8080');
const socket = new WebSocket('ws://192.168.91.43:8080');


socket.addEventListener('message', (event) => {
    try {
        const data = JSON.parse(event.data);
        console.log('Received data:', data);
        const button = document.getElementById(data.id);
        const line_button=document.getElementById(`l-${data.lin_id}`);
        console.log("ramubbfhbhefb"+line_button)
        line_button.click();
        var clickSound = new Audio("sound.mp3");
            clickSound.play();
            setTimeout(function() {
                clickSound.pause();
                clickSound.currentTime = 0; 
            }, 3000);
        


          if (button) {
            button.style.backgroundColor = data.color;
            button.innerText = data.value;
            
            
        } else {
            console.error(`Button with id ${data.id} not found`);
        }

        
        // if (data.lineId){
        //   getMachine(data.lineId);

        //   var firstMachieButton = $('#line_btn button[data-line-id="' +data.lineId+ '"]').first();
        //   if (firstMachieButton.length > 0){
        //     firstMachieButton[0].scrollIntoView({ behavior: 'smooth', block: 'start'})
        //   }
        // }
       
        
    } catch (error) {
        console.error('Error parsing WebSocket message:', error);
    }
});

// $(document).on('click', 'line_btn button', function(){
//   var lineId = $(this).data('line-id');

//   socket.send(JSON.stringify({ lineId : lineId}));
  
//   var firstMachieButton = $('#line_btn button[data-line-id="' +lineId+ '"]').first();
//   if (firstMachieButton.length > 0){
//     firstMachieButton[0].scrollIntoView({ behavior: 'smooth', block: 'start'})
//   }

// });

function updatebutton(m_id) {
    $.ajax({
        url: "get_mach.php",
        type: "POST",
        data: {
            p_id: selectedplant
        },
        success: function(data) {
            try {
                var ans = JSON.parse(data);
                var button = document.getElementById(m_id);

                ans.forEach(function(item) {
                    var raw = JSON.parse(item.colours);
                    const currentColorName = button.innerText;
                    const colorNames = Object.keys(raw);

                    let currentIndex = colorNames.indexOf(currentColorName);
                    let nextIndex = (currentIndex + 1) % colorNames.length;

                    const nextColorName = colorNames[nextIndex];
                    console.log(nextColorName)
                    const nextColorValue = raw[nextColorName];

                   
                    console.log(`Current Color: ${currentColorName}, Next Color: ${nextColorName}, Next Value: ${nextColorValue}`);

                    
                    socket.send(JSON.stringify({ id: m_id, color: nextColorValue, value: nextColorName, lin_id:selectedlineid }));
                    

                   
                    button.innerText = nextColorName;
                    button.style.backgroundColor = nextColorValue;

                    $.ajax({
                        url: "upd_color.php",
                        type: "POST",
                        data: {
                            p_id: selectedplant,
                            name: nextColorName,
                            id: m_id
                        },
                        
                        success: function(dat) {
                        console.log("Response data: " + dat);

                       
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX request failed:", status, error);
                    },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                });
            } catch (e) {
                console.error('Error parsing response data:', e);
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}


</script>
</body>
</html>