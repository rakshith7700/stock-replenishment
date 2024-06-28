<?php
require_once 'config.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $plant=$_POST['plant'];
    $c=$_POST['color_data'];
    $check=mysqli_query($conn,"SELECT * from all_plants where plant_name='$plant'") or die(mysqli_error($conn));
    if(mysqli_num_rows($check)>0){
        echo "plant already existed";
    }
    else{
        $c1=json_encode($c);
        $ins=mysqli_query($conn,"INSERT into all_plants(plant_name,status,colours) values('$plant',1,'$c1')") or die(mysqli_error($conn));
        if($ins){
            echo "success";

        }
        else{
            echo "something went wrong";
        }

    }

}
else{
    echo "eroor occured in connection";
}
?>