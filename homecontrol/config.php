<?
//--------------------------------------------------------------------------------//
// Credits
//	Code and idea by Dimitri Tas
//
//	File version:
//		Version: 0.95
//		date: May 29, 2015
//
//  Update: 
//		0.8 - Added dimmer functions to SMART switches
//		0.9 - Added polling, enlarged buffer sizes
//      0.95 - Polling rewritten, limitless buffer sizes, dimmer last position memory, multiple actions at once support
//
//	ABOUT THIS PROJECT
//		Project Owner: Stubborn BE
//		Web interface code compatible with Niko Home Control 1 network module, no gateway needed.
//
//	DEPENDENCIES
//  	Your domotica setup must be connected to your local network and have a fixed IP (DHCP reservation hint hint!)
//		You need a php webserver located in the same network as your domotica setup.
//		If you want to access your setup form the internet you need to forward a TCP port towards your webserver in your router. (Duh)
//
//	SETUP
//		Place these files and folders on your php enabled webserver.
//		Enter the IP address of your domotica network module in the $networkmoduleIP variable.
//		Set your custom siteTitle in the $siteTitle variable.
//      Choose if you want forms_based_auth. (login on the web page, set to false if using htaccess or no security)
//		If forms_based_auth, add users and passwords, as many as you want, if you want them to be encrypted program it yourself ;)
//		$users[]=new User('username1','password1');
//		$users[]=new User('username2','password2');
//		$users[]=new User('username3','password3');
//		Open the website location and go out of your mind.
//
//		Enjoy your setup
//
//	License
//		This code is free of charge for everyone and can be updated for personal use.
//		Just keep the credits in the codebase.
//			
//--------------------------------------------------------------------------------//
/**************DON'T CHANGE*********************/
include_once('classUser.php');
$users=array();
/**************DON'T CHANGE*********************/

//TO BE SET UP BY USER
$networkmoduleIP='<IP ADDRESS>';//Enter the network module's IP here
$siteTitle="Homecontrol webapp";//Enter the custom title here, keep it short

$use_forms_based_auth=false;//I use a .htpasswd file with apache auth
$users[]=new User('peter','Somepass123');
$users[]=new User('ronny','MySectret');
//END TO BE SET UP BY USER

//$url="www.example.com";
/**************From here on no changes needed*********************/

?>
