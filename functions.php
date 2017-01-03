<?php
/**
 * Project Wonderful - Reporting
 * Functions
 */
 
// Report breakdowns
const BY_DAY = 'daily';
const BY_AD = 'adid';
const BY_AD_TYPE = 'adtype';
const BY_AD_BOX = 'adboxid';
const BY_AD_BOX_CATEGORY = 'category';
const BY_TRAFFIC_REGION = 'region';
const BY_BID = 'bidid';

/**
 * Authenticate with Project Wonderful and return a live CURL object
 */
function login($email, $password)
{
    
    $ch = curl_init("https://www.projectwonderful.com/");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "pwcookie");
    curl_setopt($ch, CURLOPT_COOKIEJAR, "pwcookie");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_VERBOSE, FALSE);
    
    // Make a call to the homepage to get a session cookie
    curl_exec($ch);
    
    // Now login
    curl_setopt($ch, CURLOPT_URL, "https://www.projectwonderful.com/login.php");
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['email' => $email, 'pass' => $password]));
    
    curl_exec($ch);
    
    // We'll assume it passed
    return $ch;
    
}

/**
 * Convert a string containing CSV data, into an associative array
 */
function csv_to_assoc($csv)
{
    $lines = explode("\n", $csv);
    
    $array = [];
    $headers = [];
    $i = 0;
    
    foreach($lines as $line)
    {
        if ($i == 0)
        {
            foreach(explode(",", trim($line)) as $h)
            {
                if (trim($h) !== "") $headers[] = $h;
            }
        }
        else
        {
            $row = [];
            $cells = explode(",", trim($line));
            
            foreach($cells as $n => $cell)
            {
                if (trim($cell) !== "") $row[$headers[$n]] = $cell;
            }
            
            $array[] = $row;
            
        }
        
        $i++;
    }
    
    return $array;
    
}

/**
 * Fetch a CSV dump of all active campaigns
 */
function get_campaigns($ch)
{
    curl_setopt($ch, CURLOPT_URL, "https://www.projectwonderful.com/mycampaigns.php");
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'sort' => 'cnickname',
        'active' => '1',
        'paused' => '0',
        'updateselection' => '3',
        'page' => '0',
        'tpages' => '0',
        'showmerged' => '1',
        'paused' => '0'    
    ]));
    
    $csv = curl_exec($ch);
    
    return csv_to_assoc($csv);
    
}

/**
 * Retrieve the content of a single report
 */
function get_report($ch, $cid, $type, $date_from = null, $date_to = null)
{
    // Default date range to last 72 hours
    if ($date_from == null) $date_from = date("Y-m-d", strtotime('-3 day'));
    if ($date_to == null) $date_to = date("Y-m-d", strtotime('+1 day'));
    
    // Configure report call
    curl_setopt($ch, CURLOPT_URL, "https://www.projectwonderful.com/campaignperformance.php");
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'cid'.$cid => 1,
        'report' => $type,
        'self' => 1,
        'cid' => $cid,
        'date-b' => $date_to,
        'date' => $date_from,
        'updateselection' => 3
    ]));
    
    $result = curl_exec($ch);
    
    return csv_to_assoc($result);
    
}