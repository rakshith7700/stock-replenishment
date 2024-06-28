<?php
require_once "config.php";
$plants=mysqli_query($conn,"SELECT * FROM all_plants where status='1'") or die(mysqli_error($conn));
$plant=array();
if(mysqli_num_rows($plants)>0){
    while($res=mysqli_fetch_object($plants)){
        $plant[]=$res;
    }
}
$lines=mysqli_query($conn,"SELECT * FROM lines_table where status='1'") or die(mysqli_error($conn));
$line=array();
if(mysqli_num_rows($lines)>0){
    while($res=mysqli_fetch_object($lines)){
        $line[]=$res;
    }
}
$machines=mysqli_query($conn,"SELECT * FROM machines where status='1'") or die(mysqli_error($conn));
$machine=array();
if(mysqli_num_rows($machines)>0){
    while($res=mysqli_fetch_object($machines)){
        $machine[]=$res;
    }
}
$users=mysqli_query($conn,"SELECT * FROM user ") or die(mysqli_error($conn));
$user=array();
if(mysqli_num_rows($users)>0){
    while($res=mysqli_fetch_object($users)){
        $user[]=$res;
    }
}
$data=array(
    "plants"=>$plant,
    "lines"=>$line,
    "machines"=>$machine,
    "users"=>$user
);
$data_json=json_encode($data);
echo $data_json;
$conn->close();
?>