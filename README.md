# Niko Homecontrol Webapp

![image](https://github.com/user-attachments/assets/ce3869ac-2457-4e99-a211-875609661581)

## Intro
Mobile compatible web app to control your Niko Homecontrol 1 installation via a web browser. This can be usefull if you want to be able to reach your installation over the internet, without the expensive gateway module.

## Installation
- Extract the repo to your webserver
- Open config.php and set up your parameters
- Browse the site and start using

## Custom naming
If you want to customize the naming of your "Rooms", you can set up the $manLocation array in index.php starting at line 34 and uncomment line 125, comment line 124 like this:

    //foreach($locations->data as $k => $location){
    foreach($manLocation as $k => $location){
