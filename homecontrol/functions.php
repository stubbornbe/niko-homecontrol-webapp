<?
function checkLogin($users,$user,$pw){
	foreach($users as $key=>$userobj){
		if($userobj->getUser()==$user){
			if($userobj->getPw()==$pw){
				return true;	
			}
		}
	}
	return false;
}

function fillLocationsAndActions($networkmoduleIP){
	$error="";
	$locationsDecoded=json_decode('{"data":[]}');
	$actionsDecoded=json_decode('{"data":[]}');
	$eventsDecoded=json_decode('{"data":[]}');
	set_error_handler(function(){return true;});
	$fp = stream_socket_client("tcp://".$networkmoduleIP.":8000", $errno, $errstr, 30);
	restore_error_handler();
	if($fp){;
		fwrite($fp, '{"cmd":"listlocations"}');
		$locationsRaw=fgets($fp);
		fwrite($fp, '{"cmd":"listactions"}');
		$actionsRaw=fgets($fp);
		fwrite($fp, '{"cmd":"getalarms"}');
		$eventsRaw=fgets($fp);
		fclose($fp);
		$locationsDecoded=json_decode($locationsRaw);
		$actionsDecoded=json_decode($actionsRaw);
		$eventsDecoded=json_decode($eventsRaw);
	}else{
		$error= "Failed to connect to Homecontrol: ". $errstr."<br />";
	}
	return array($locationsDecoded,$actionsDecoded,$eventsDecoded,$error);
}
?>