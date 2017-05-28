<?php
define('DB_HOST', '');
define('DB_NAME', '');
define('DB_USER','');
define('DB_PASSWORD','');

$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Failed to connect'.mysql_error());

$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to database".mysql_error());

if(mysql_errno($con)){
	echo "Failed to connect to database";
}
else{
	echo "Connected";
}
function start(){
	$user = $_POST['user'];
	$query = 'SELECT message FROM messages WHERE sender='.$user.' OR receiver='.$user.' ORDER BY sent DESC;';
	$data = mysql_query($query);
	if($data){
		echo 'Found messages';
	}
	else{
		echo 'Inbox empty';
	}
    $index = 0;
    $dat_array = array();
    while($row = mysql_fetch_assoc($data) && $index <= 100){
        $dat_array[$index]['message'] = $row['message'];
        $dat_array[$index]['sender'] = $row['sender'];
        $dat_array[$index]['receiver'] = $row['receiver'];
        $dat_array[$index]['tag'] = $row['tag'];
        $dat_array[$index]['sent'] = $row['sent'];
        $index++;
    }
    $i = 0;
    $cluster_arr = array();
    if($dat_array[$i]['sender'] == $user){
        $curr = $dat_array[$i]['receiver'];
    }
    elseif($dat_array[$i]['receiver'] == $user){
        $curr = $dat_array[$i]['sender'];
    }
    $cluster_arr[$i] = $dat_array[$i]['receiver'];
    $i=1;
    while($dat_array[$i]['sender'] != "" || $dat_array[$i]['receiver'] != ""){
        if($dat_array[$i]['sender'] == $user){
            $curr = $dat_array[$i]['receiver'];
            if(!in_array($curr, $cluster_arr)){
                $cluster_arr[$i] = $curr;
            }
        }
        elseif($dat_array[$i]['receiver'] == $user){
            $curr = $dat_array[$i]['sender'];
            if(!in_array($curr, $cluster_arr)){
                $cluster_arr[$i] = $curr;
            }
        }
        $i++;
    }
}

function signup(){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $query_s = "INSERT INTO x (user, password) VALUES ('".$user."', '".$pass."');";
    mysql_query($query_s);
}
if(isset($_POST['login'])){
	start();
}
if(isset($_POST['signup'])){
    signup();
}
?>