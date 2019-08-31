<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PHP Code Snippets</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript">
<!-- 
//Browser Support Code
function ajaxFunction(URL){
    var ajaxRequest; // The variable that makes Ajax possible!
    
    try{
        // Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
    } catch (e){
        // Internet Explorer Browsers
        try{
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try{
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
                // Something went wrong (User Probably Doesn't have JS or JS is turned off)
                alert("You Browser Doesn't support AJAX.");
                return false;
            }
        }
    }
    // Create a function that will receive data sent from the server
    ajaxRequest.onreadystatechange = function(){
        //This if satement will check if the status of the script
        //If the readyState is not equal to 4 (The request is complete)
        //It will display text that says loading...
        if(ajaxRequest.readyState < 4){
            //AJAX in the prenthacies, is what id element in the body will be changed.
            document.getElementById('AJAX').innerHTML = "<h2>Loading...</h2>";
        }
        //Once the readyState is equal to four, this means that the request was sent,
        //and successfully processed.
        if(ajaxRequest.readyState == 4){
            //This is where the output of the file we called and it will be placed
            //in the div where we named the ID = AJAX
            document.getElementById('AJAX').innerHTML = ajaxRequest.responseText;
        }
    }
    //This section processes the data
    ajaxRequest.open("GET", URL, true);
    ajaxRequest.send(null);    
}
//-->
</script>
</head>

<body>
<!-- This is the link to the ajax function
It should always start with javascript:
after that is the function name ajaxFunction
inside the parenthacies, is the file we want,
this file can look like any URL you would make in a
normal href. Examples:
adate.php
adate.php?page=1
adate.php?page=1&name=fred
-->
<a href="javascript:ajaxFunction('adate.php')">What Time Is It?</a>
<div id="AJAX"></div>
</body>