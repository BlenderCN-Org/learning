
<?php
function userAgent($ua){
## This credit must stay intact (Unless you have a deal with @lukasmig or frimerlukas@gmail.com
## Made by Lukas Frimer Tholander from Made In Osted Webdesign.
## Price will be $2

    $iphone = strstr(strtolower($ua), 'mobile'); //Search for 'mobile' in user-agent (iPhone have that)
    $android = strstr(strtolower($ua), 'android'); //Search for 'android' in user-agent
    $windowsPhone = strstr(strtolower($ua), 'phone'); //Search for 'phone' in user-agent (Windows Phone uses that)
    
    
    function androidTablet($ua){ //Find out if it is a tablet
        if(strstr(strtolower($ua), 'android') ){//Search for android in user-agent
            if(!strstr(strtolower($ua), 'mobile')){ //If there is no ''mobile' in user-agent (Android have that on their phones, but not tablets)
                return true;
            }
        }
    }
    $androidTablet = androidTablet($ua); //Do androidTablet function
    $ipad = strstr(strtolower($ua), 'ipad'); //Search for iPad in user-agent
    
    if($androidTablet || $ipad){ //If it's a tablet (iPad / Android)
        return 'tablet';
		echo 'tablet';
    }
    elseif($iphone && !$ipad || $android && !$androidTablet || $windowsPhone){ //If it's a phone and NOT a tablet
        return 'mobile';
		echo 'mobile';
    }
    else{ //If it's not a mobile device
        return 'desktop';
		echo 'desktop';
    }    
}
userAgent();
?> 