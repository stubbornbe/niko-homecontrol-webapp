<?
//--------------------------------------------------------------------------------//
// Credits
// Code and idea by Dimitri Tas
// To configure, just edit config.php
//--------------------------------------------------------------------------------//

session_start();

include_once('config.php');
include_once('functions.php');
/**************From here on no changes needed*********************/

if(!isset($_SESSION['loggedIn'])){
	$_SESSION['loggedIn']=false;
}
$error="";

if(isset($_POST['user'])){
	$_SESSION['loggedIn']=checkLogin($users,$_POST['user'],$_POST['pw']);
	
	if(!$_SESSION['loggedIn']){
		$error="login failed";
	}
}

if(($_SESSION['loggedIn']&&$use_forms_based_auth)||(!$use_forms_based_auth)){
	$locationsAndActions=fillLocationsAndActions($networkmoduleIP);
	$locations=$locationsAndActions[0];
	$actions=$locationsAndActions[1];
	$events=$locationsAndActions[2];
	$error=$locationsAndActions[3];

	$manLocation=array(
		$locations->data[14],//Garage
		$locations->data[13],//Garage
		$locations->data[12],//Buiten
		$locations->data[4],//Bureau
		$locations->data[1],//Keuken
		$locations->data[3],//Eethoek
		$locations->data[2],//Zithoek
		$locations->data[5],//Gang beneden
		$locations->data[6],//Gang boven
		$locations->data[10],//Badkamer
		$locations->data[7],//Kamer voor
		$locations->data[8],//Kamer midden
		$locations->data[9],//kamer achter
		$locations->data[11]//Zolder
	);

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?=$siteTitle;?></title>

<? /*<base href="http://<? echo $url;?>/" target="_self" />*/?>

<!-- MOBILE OPTIMIZATION -->
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
<meta name="HandheldFriendly" content="true" />
<meta name="format-detection" content="telephone=no" />
<meta name="MobileOptimized" content="true" />

<meta name="description" content="<?=$siteTitle;?>"/>
<meta name="author" content="Dimitri Tas, Sofie Debie"/>

<meta property="og:title" content="<?=$siteTitle;?>" /> 
<meta property="og:description" content="<?=$siteTitle;?>" /> 
<? /*<meta property="og:url" content="http://<? echo $url;?>/" />*/?>

<script type="text/javascript">
if( navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/iPad/i)) {	document.title = "<?=$siteTitle;?>"; }
</script>

<script src="js/jquery-1.7.2.min.js" language="javascript"></script>
<script src="js/jquery-ui.min.js" language="javascript"></script>
<script src="js/jquery.ui.touch-punch.min.js" language="javascript"></script>

<script src="js/mediaqueries.js" type="text/javascript"></script>
<script src="js/mdetect.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="css/webcontrol.css" />
<link rel="stylesheet" type="text/css" href="css/mediaqueries.css" />
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css' />

</head>

<body>
<? //print_r($events);

/*foreach($events->data as $k => $alarm){
?>
<?=$alarm->id;?> <?=$alarm->date;?> <?=$alarm->type;?> <?=$alarm->text;?><br />
<?
	
}?>
*/?>
<div class="header">
	<div class="centerContainer">
    	<div class="headerBG">
			<div class="headerTitle"><?=$siteTitle;?></div>
        </div>
    </div>
</div>
<?
if(!$_SESSION['loggedIn']&&$use_forms_based_auth){
	include_once('login.php');
}else{
?>
<div class="centerContainer"><? 
        if($error!=""){
			?>
            <div class="loginError"><?=$error;?></div>
            <?
		}
        $rowdelimiter=0;
        foreach($locations->data as $k => $location){
				//foreach($manLocation as $k => $location){
            if($location->name!=""){
        
            ?><div class="zoneCont" id="zoneCont_<?=$k;?>"><?
                 /*<div class="onderEffect"></div>*/?>
                <div class="zoneTitel"><?=$location->name;?></div>
                <div class="zoneIcoon"></div>
                <div class="zoneContMid">
                <?
                $firstAction=true;
                foreach($actions->data as $action){
                    if($action->location==$location->id){
                        if($firstAction){
                            $firstAction=false;
                        }else{
                        ?>
                            <div class="tussenLijn"></div>
                        <?	
                        }
                    
                        $newvalue=0;
                        if($action->value1==0){
                            $newvalue=100;	
                        }
                            
                        if($action->type==1){
                
                        ?>
                        <div class="kringCont">
                            <div class="kringNaam"><?=$action->name;?></div>
                            <div class="kringSchakel">
                                <div id="button_<?=$action->id;?>" class="button <? if($action->value1>0){ echo "buttonOn";}else{ echo "buttonOff";};?>"></div>
                            </div>
                        </div>
                        <?
                        }elseif($action->type==2){
                        ?>
                        <div class="kringCont">
                            <div class="kringNaam"><?=str_replace("Smart_","",$action->name);?></div>
                            <div class="kringSchakel">
                                <div id="button_<?=$action->id;?>" class="button <? if($action->value1>0){ echo "buttonOn";}else{ echo "buttonOff";};?>"></div>
                            </div>
                            <div class="kringDimmer" id="d_slider_<?=$action->id;?>">
                                <div id="slider_<?=$action->id;?>" class="slider"></div>
                                <input type="hidden" id="h_slider_<?=$action->id;?>" value="<?=$action->value1;?>" />
                            </div>
                        </div>
                        <?
                        }
                    }
                }
                ?></div>
            </div><?
			
            }
        }
        ?>
</div>
<script language="javascript">
	ip ='<?=$networkmoduleIP;?>';
</script>
<script language="javascript" src="js/daxus.js"></script>
<?
}
?>
<? //<div id="indicator"></div>?>
</body>
</html>
