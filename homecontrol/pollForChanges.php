<?
include_once('config.php');
$fp = stream_socket_client("tcp://".$networkmoduleIP.":8000", $errno, $errstr, 30);
if($fp){;
	fwrite($fp, '{"cmd":"startevents"}');
	stream_set_timeout ( $fp , 60);
	$startReport=fgets($fp, 1024);
	$actions[]=fgets($fp);
	$info = stream_get_meta_data($fp);
	if (!$info['timed_out']) {
		
		stream_set_timeout ( $fp , 0,100000);
		while(!$info['timed_out']){
			$actions[]=fgets($fp);
			$info=stream_get_meta_data($fp);
		}
	}else{
		$actions=array();
	}
	fwrite($fp, '{"cmd":"stopevents"}');
	$info = stream_get_meta_data($fp);
	fclose($fp);
	
	if (count($actions)==0) {
        die( json_encode( array( 'status' => 'no-results')));
    } else {
		
		//print_r($actions);
		array_pop($actions);
		$a2=array();
		$e2=array();
		
		foreach($actions as $action){
			$a1=json_decode($action);
			if($a1->event=='listactions'){
				$a2=array_merge($a2,$a1->data);
				/*echo "<br /><br />A2 is dus:<br />";
				print_r($a2);
				echo "<br /><br />";*/
			}
			
			if($a1->event=='getalarms'){
				$a3=array('id'=>$a1->data->id,'type'=>$a1->data->type,'text'=>$a1->data->text);
				//print_r($a1);
				$e2=array_merge($e2,$a3);
				/*echo "<br /><br />E2 is dus:<br />";
				print_r($e2);
				echo "<br /><br />";*/
			}
			
			
		}
		
		if((count($a2)>0)&&(count($e2)>0)){
			die( json_encode( array( 'status' => 'results', 'data' => $a2, 'eventje' => array($e2) ) ) );
		}elseif(count($e2)>0){
			die( json_encode( array( 'status' => 'results', 'eventje' => array($e2) ) ) );
		}
		elseif(count($a2)>0){
			die( json_encode( array( 'status' => 'results', 'data' => $a2 ) ) );
		}else{
			die( json_encode( array( 'status' => 'no-results')));
		}
    }
}else{
	die(json_encode(array('status' => 'error')));
}

?>