<?php
$site_stats = new stdClass();

require_once('conn.php');
function quer($query){
    global $db;
    $query = "$query";
    $result = $db->query($query);
    $obj = $result->fetch_object();
    return $obj;
}
//Total Website Users
$obj = quer("SELECT count(id) as userCount FROM users");
$site_stats->user_count = number_format($obj->userCount,0,'.',',');
//Active Users this week
$obj = quer("SELECT count(id) as userCount FROM users WHERE online >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
$site_stats->user_week = (string) number_format($obj->userCount,0,'.',',');
//Active Users this month
$obj = quer("SELECT count(id) as userCount FROM users WHERE online >= DATE_SUB(NOW(), INTERVAL 1 MONTH)");
$site_stats->user_month = (string) number_format($obj->userCount,0,'.',',');
//Total Points in circulation
$obj = quer("SELECT sum(coins) as pointCount FROM users");
$site_stats->points_all = (string) number_format($obj->pointCount,2,'.',',');
//Users Online Today
$obj = quer("SELECT count(id) as userCount FROM users WHERE online >= CURDATE() - INTERVAL 1 DAY");
$site_stats->user_today = (string) number_format($obj->userCount,0,'.',',');

$userActivity = array('Jan'=>0,'Feb'=>0,'Mar'=>0,'Apr'=>0,'May'=>0,'June'=>0,'July'=>0,'Aug'=>0,'Sep'=>0,'Oct'=>0,'Nov'=>0,'Dec'=>0);
$cashAct = array('Jan'=>0,'Feb'=>0,'Mar'=>0,'Apr'=>0,'May'=>0,'June'=>0,'July'=>0,'Aug'=>0,'Sep'=>0,'Oct'=>0,'Nov'=>0,'Dec'=>0);

$rawarr=array();

$year = date("Y");
if(!isset($_SESSION['prevstats'])){
    $_SESSION['prevstats'] = array();
}
for($i=1;$i<=12;$i++) {
    $rawarr[$i] = 0;
    $obj = 0;
    if($i != date("m"))
    {
        if($_SESSION['prevstats']['userActivity'][$i]){
            $obj = $_SESSION['prevstats']['userActivity'][$i];
        }
        
    }
    
    if($obj == 0){
            $obj = quer("SELECT count(id) as usercount FROM users WHERE YEAR(signup)='{$year}' AND MONTH(signup)='{$i}'");
            $_SESSION['prevstats']['userActivity'][$i] = $obj;
    }
    
    $rawarr[$i] = $obj->usercount;
    
}
$i=1;
foreach($userActivity as $key=>$val){
    $userActivity[$key] = $rawarr[$i];
    $i++;
}
$site_stats->user_activity = $userActivity;

//Website Stats HITS
    $obj=quer("SELECT COUNT(id) as hitcount FROM statistics WHERE YEAR(date)='{$year}' AND MONTH(date)='{$month}' AND DAY(date)='{$day}'");
    $site_stats->hit_count= $obj->hitcount;


for($i=1;$i<=12;$i++) {
    $rawarr[$i] = 0;
    $obj = 0;
    if($i != date("m")){
        if($_SESSION['prevstats']['cashAct'][$i]){
            $obj = $_SESSION['prevstats']['cashAct'][$i];
        }
         
    }
    if($obj == 0){
        $obj = quer("SELECT SUM(money) as moneysum FROM fakeorders WHERE YEAR(date)='{$year}' AND MONTH(date)='{$i}'");
        $_SESSION['prevstats']['cashAct'][$i] = $obj;
    }
        $rawarr[$i] = $obj->moneysum;
}
$i=1;
foreach($cashAct as $key=>$val){
    $cashAct[$key] = $rawarr[$i];
    $i++;
}

$site_stats->cash_activity = $cashAct;
$month = date("m");
$day=date("d");
//Get purchases today
$obj = quer("SELECT SUM(money) as sumcash FROM fakeorders WHERE YEAR(date)='{$year}' AND MONTH(date)='{$month}' AND DAY(date)='{$day}'");
$site_stats->cash_today = $obj->sumcash;

$rawarr=array();
//Get 7 days previous
$i=0;
$day++;
while($i<30){
     
    $day--;
    if($day <= 0) {
        $month--;
        if($month <= 0) {
            $year--;
            $month=12;
        }
        $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
    $obj = 0;
    if($day != date("d")){
        if($_SESSION['prevstats']['dailystats'][$day][$month][$year]){
            $obj = $_SESSION['prevstats']['dailystats'][$day][$month][$year];
        }
    }
    if($obj == 0){
    $obj = quer("SELECT SUM(money) as sumcash FROM fakeorders WHERE YEAR(date)='{$year}' AND MONTH(date)='{$month}' AND DAY(date)='{$day}'");
    $_SESSION['prevstats']['dailystats'][$day][$month][$year] = $obj;
    
    }
    $datestring = "{$day}-{$month}-{$year}";  
    if($obj->sumcash > 0) $rawarr[$datestring] = $obj->sumcash;
    else $rawarr[$datestring] = 0;
    $i++;
    }
    $site_stats->cash_daily=  array_reverse($rawarr);
    
    
    
