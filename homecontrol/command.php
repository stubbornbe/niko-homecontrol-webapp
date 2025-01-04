<?
if(isset($_POST['actionId'])){
	
	$commandToExecute='{"cmd":"executeactions", "id":'.$_POST['actionId'].',"value1":'.$_POST['action'].'}';
	

	$fp = stream_socket_client("tcp://".$_POST['ip'].":8000", $errno, $errstr, 30);
    if(!$fp){
        echo "$errstr ($errno)<br />\n";
    }else{
		if($commandToExecute!=false){
			fwrite($fp, $commandToExecute);
			fgets($fp, 1024);
		}
        fclose($fp);
    }
}
?>