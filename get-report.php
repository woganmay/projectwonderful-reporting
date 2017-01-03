<?php

//
// Retrieve campaign report data
//

require_once 'functions.php';

// 1. Authenticate
$session = login("john@example.com", "password");

// 2. Get a list of campaigns
$campaigns = get_campaigns($session);

// 3. For each campaign, get a CSV dump : from 3 days ago, to now

foreach($campaigns as $campaign)
{
    $cid = $campaign['Campaign ID'];
    
    $report = get_report($session, $cid, BY_DAY);
    
    //
    // Do whatever you need to with the report data
    //
    
}