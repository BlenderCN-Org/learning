<?php
function getProxyFromIE()
{
        exec("reg query \"HKEY_CURRENT_USER\Software\Microsoft".
        "\Windows\CurrentVersion\Internet Settings\" /v ProxyEnable",
        $proxyenable,$proxyenable_status);

        exec("reg query \"HKEY_CURRENT_USER\Software\Microsoft".
        "\Windows\CurrentVersion\Internet Settings\" /v ProxyServer",
        $proxyserver);

        if($proxyenable_status!=0)
        return false; #Can't access the registry! Very very bad...
        else
        {
        $enabled=substr($proxyenable[4],-1,1);
        if($enabled==0)
        return false;
        else
        {
        $proxy=ereg_replace("^[ \t]{1,10}ProxyServer\tREG_SZ[ \t]{1,20}","",
        $proxyserver[4]);

        if(ereg("[\=\;]",$proxy))
        {
             $proxy=explode(";",$proxy);
             foreach($proxy as $i => $v)
             {
                   if(ereg("http",$v))
                   {
                   $proxy=str_replace("http=","",$v);
                   break;
                   }
             }
             if(@!ereg("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:".
             "[0-9]{1,5}$",$proxy))
             return false;
             else
             return $proxy;
        }
        else
        return $proxy;
        }

        }
}
?>
Note, that this function returns FALSE if proxy is disabled in Internet
Explorer. This function returns ONLY HTTP proxy server.

Usage:
<?php
$proxy=getProxyFromIE();
if(!$proxy)
echo "Can't get proxy!";
else
echo $proxy;
?>