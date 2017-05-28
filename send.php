<?php
define('DB_HOST', '');
define('DB_NAME', '');
define('DB_USER','');
define('DB_PASSWORD','');

include 'endec.php';

$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Failed to connect'.mysql_error());

$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to database".mysql_error());

if(mysql_errno($con)){
	echo "Failed to connect to database";
}
else{
	echo "Connected";
}

function send(){
    $pass = "huff138gryff";
    $message = MyCrypt($_POST['message'], $pass);
    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $date_time = date('Y-m-d H:i:s');
    $rec_chk_qr = 'SELECT * FROM x WHERE username='.$receiver.';';
    $rec_exists = mysql_query($rec_chk_qr);
    if($message != ""){
        if($rec_exists != null){
            $insert_qr = 'INSERT INTO messages (tag, sender, receiver, message, sent) VALUES ('.$sender.', '.$receiver.', '.$message.', '.$date_time.');';
            mysql_query($insert_qr);
        }
        else
            die("User does not exist!");
    }
    else
        die("Empty message!");
}
if(isset($_POST['send'])){
    send();
}



?>