<?php 

function inspect($label, $val = "__undefin_e_d__") 
{ 
    if($val == "__undefin_e_d__") { 

        /* The first argument is not the label but the  
           variable to inspect itself, so we need a label. 
           Let's try to find out it's name by peeking at  
           the source code.  
        */ 

        /* The reason for using an exotic string like  
           "__undefin_e_d__" instead of NULL here is that  
           inspected variables can also be NULL and I want  
           to inspect them anyway. 
        */ 

        $val = $label; 
         
        $bt = debug_backtrace();         
        $src = file($bt[0]["file"]); 
        $line = $src[ $bt[0]['line'] - 1 ];         

        // let's match the function call and the last closing bracket 
        preg_match( "#inspect\((.+)\)#", $line, $match ); 
         
        /* let's count brackets to see how many of them actually belongs  
           to the var name 
           Eg:   die(inspect($this->getUser()->hasCredential("delete"))); 
                  We want:   $this->getUser()->hasCredential("delete") 
        */ 
        $max = strlen($match[1]); 
         
        $varname = ""; 
        $c = 0; 
        for($i = 1; $i < $max; $i++){ 
            if(     $match[1]{$i} == "(" ) $c++; 
            elseif( $match[1]{$i} == ")" ) $c--; 
            if($c < 0) break; 
            $varname .=  $match[1]{$i}; 
        } 
        $label = $varname; 
    } 

    // $label now holds the name of the passed variable ($ included) 
    // Eg:   inspect($hello)  
    //             => $label = "$hello" 
    // or the whole expression evaluated 
    // Eg:   inspect($this->getUser()->hasCredential("delete")) 
    //             => $label = "$this->getUser()->hasCredential(\"delete\")" 

    // now the actual function call to the inspector method,  
    // passing the var name as the label: 

      // return dInspect::dump($label, $val); 
         // UPDATE: I commented this line because people got confused about  
         // the dInspect class, wich has nothing to do with the issue here. 

    echo("The label is: ".$label); 
    echo("The value is: ".$val); 

} 
?>