<?php
    //This page is responsible to return a JSON object
    //code starts after the functions for those who might get confused xD

    header('content-type: application/json; charset=utf-8');


    global $responseData;


    function AdjustRate($Ra, $Ea, $Sa)
    {
        //i used my own rules here 32 points for less than 500
        if($Ra < 500)
            $k = 32;
        elseif ($Ra < 1000)//24 points for anything between 500 and 1000
            $k = 24;
        else
            $k = 16;//16 for anything more than 1000

        return $Ra + ($k*($Sa - $Ea));
    }

    function GetExpectedChance($rA, $rB) // the ELO formula taken from http://en.wikipedia.org/wiki/Elo_rating_system
    {
        return (1/(1+pow(10,(($rB-$rA)/400))));
    }

    function setNewRates($lastCall) // function I used to update my database tables
    {
        global $responseData;

        $A = $lastCall->p1;
        $B = $lastCall->p2;
        $C = $lastCall->c;
        $A->E = GetExpectedChance($A->rate, $B->rate);
        $B->E = GetExpectedChance($B->rate, $A->rate);

        // decide who won and who lost
        if($A->id == $C){
            $winner = $A;
            $looser = $B;
        }
        elseif ($B->id == $C) {
            $winner = $B;
            $looser = $A;
        }

        // 3 cases, in all of them winner will get his rate/hits increased by 1
        //Case #1: normal case we just update rate/hits for the winner, this applies all the time
        $winner->rate += 1;
        $winner->hits += 1;
        //Case #2 / #3 : here we should adjust the rate after applying case #1
        // if he won while he is expected to lose OR if he lost while expected to win
        // there should be minimum rate different of 40 between the two
        $diff = abs($winner->rate - $looser->rate);
        if($diff >= 40 && ($winner->E < 0.5 || $looser->E >= 0.5)) {
            $winner->rate = AdjustRate($winner->rate, $winner->E, 1);
            $looser->rate = AdjustRate($looser->rate, $looser->E, 0);
        }


        // update the db to update rates, hits for both winner and looser
            $updateQuery = 'UPDATE user SET rate='.$winner->rate.',hits='.$winner->hits.' WHERE id=' . $winner->id;
            mysql_query($updateQuery);

            $updateQuery = 'UPDATE user SET rate='.$looser->rate.' WHERE id=' . $looser->id;
            mysql_query($updateQuery);

        // Save to responsedate
        $responseData->winner = $winner;
        $responseData->looser = $looser;
    }

    //CODE STARTS HERE :)

    // Setup the mysql connection
    include 'db.php';
    // Part 1: calculate the rate and save to db, if we have a lastcall
    // GET the last call data object, it has p1, p2, c, these are the items i recieved from my javascript ajax call
    $lastCall  = json_decode((string)$_GET['lastCall']); // it was a JSON object so i need to decode it first
    // Save last call data, will be sent with the respond as well
    $responseData->lastCall = $lastCall;

    // if there is a json object, means that there was a rating process and I have to set the new rates
    if($lastCall->c != NULL)
    {
        setNewRates($responseData->lastCall);
    }

    // Part 3: Select new persons and addthem to our responseData
    $q = Array();
    $q[0] = 'SELECT id, name, sex, rate, hits FROM user WHERE fm_status=1 AND sex="female" ORDER BY RAND() LIMIT 2';
    $q[1] = 'SELECT id, name, sex, rate, hits FROM user WHERE fm_status=1 AND sex="male" ORDER BY RAND() LIMIT 2';

    // girls or boys ?
    srand(mktime());
    $query = $q[array_rand($q)];
    $result1 = QueryIntoArray($query);
    $responseData->user = $result1;


    // Part 4: encode to JSON/JSONP string then respond to the call
    $json = json_encode($responseData);
    $json = isset($_GET['callback'])? "{$_GET['callback']}($json)" : $json;
    echo $json;

    mysql_close();
    // by Noor Syron :)
    //I used this in my www.mimm.me

    ?>