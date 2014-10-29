<?php
include('header.php');
if (!isset($data->login)) {
    echo "<script>document.location.href='index.php'</script>";
    exit;
}

require 'youtube_sub_app.php';

$youbuteSub->getAuthToken();
$youbuteSub->setToken();

$x110 = explode('(', $data->country);
if (count($x110) > 1) {
    $x110o = explode(')', $x110[1]);
    if ($x110o[0] == '') {
        $x110o[0] = 'XX';
    }
}
else {
    $x110o[0] = 'XX';
}

$usertargetc = '(' . $x110o[0] . ')';
?>
<div class="clearer">&nbsp;</div>

<body id="tab2"> 
    <div>
        <ul id="tabnav">  
            <li class="tab2"><a href="ytsub.php">Earn Points</a></li> 
            <li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
            <li class="tab3"><a href="addytsub.php">Add Channel</a></li> 
            <li class="tab4"><a href="ytsubpages.php">My Channels</a></li> 
        </ul>
    </div>

    <h1>YouTube Channel Subscribers - Subscribe channels to Earn points/cash.</h1>
    <p>Here you can Subscribe Youtube Channels to earn Points/Money.</p>
    <p>Click on 'Subscribe' button, Subscribe channel on YouTube then 'Close Oppened Window', You can Skip channel you do not like.</p>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.tables.js"></script>

    <?
    $siteliked4[] = -1;
    $siteliked2 = mysql_query("SELECT * FROM `ytsubed` WHERE (`user_id`='{$data->id}') ");
    for ($j = 0; $siteliked = mysql_fetch_object($siteliked2); $j++) {
        $siteliked4[] = $siteliked->site_id;
    }

    $keyword = isset($_GET['keyword']) ? trim(mysql_real_escape_string($_GET['keyword'])) : '';
    $total_pages = 1;
    $sqlstr = '';
    $limit = 12;
    $pageid = isset($_GET['pageid']) ? intval($_GET['pageid']) : 1;
    if (!$pageid) {
        $pageid = 1;
    }
    if (!empty($keyword)) {
        $sqlstr = " AND (ytsub LIKE '%{$keyword}%' OR title LIKE '%{$keyword}%') ";
    }

    $num = mysql_query("SELECT COUNT(id) num FROM `ytsub` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) AND `id` NOT in (" . implode(',', $siteliked4) . ") {$sqlstr}");
    $row = mysql_fetch_object($num);
    $limitstart = ($pageid - 1) * $limit;
    $total_pages = ceil($row->num / $limit);

    if ($pageid > $total_pages) {
        $pageid = $total_pages;
    }

    $site2 = mysql_query("SELECT * FROM `ytsub` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) AND `id` NOT in (" . implode(',', $siteliked4) . ") {$sqlstr} ORDER BY `cpc` DESC LIMIT {$limitstart}, {$limit};");
    //echo "SELECT * FROM `ytsub` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) AND `id` NOT in (" . implode(',', $siteliked4) . ") ORDER BY `cpc` DESC LIMIT {$limitstart}, {$limit};";

    $ext = mysql_num_rows($site2);

    if ($ext > 0) {
        ?><div id="fb-root"></div>

        <script>
            function refreshpage()
            {
                window.location.reload();
            }
            function removeElement(parentDiv, childDiv) {
                if (document.getElementById(childDiv)) {
                    var child = document.getElementById(childDiv);
                    var parent = document.getElementById(parentDiv);
                    parent.removeChild(child);
                }
            }
        </script>

        <div id="tbl" style="width: 850px;">

            <br />
            <center><div id="Hint" class="smartbox" style="background: #FFFFFF; border-radius: 12px; border: 2px solid #cdcdcd; display:block; padding: 2px; position: center">
                    <?php
                    if (isset($_SESSION['err_message'])) :
                        echo $_SESSION['err_message'];
                        unset($_SESSION['err_message']);
                    endif;
                    ?>
                </div></center>
            <br />

            <?
            for ($j = 1; $site = mysql_fetch_object($site2); $j++) {

                $name = $site->ytsub;
                ?>
                <div class="smartbox" id="<? echo $site->id; ?>" style="width: 350px; background: #EFEFEF; border-radius: 15px; float: left; position: relative; border: 2px solid #cdcdcd; padding: 2px; -webkit-border-radius: 15px; -moz-border-radius: 15px; margin: 3px 4px 0 0;">
                    <center>
                        <div><font color='green' size='3'> <b><? echo $site->cpc - 1; ?> Points = $<? echo number_format(($site->cpc - 1) / $coinsdollar, 5); ?> </b></font></div>
                        <br />
                        <div><b> <a href="https://www.youtube.com/<? echo $site->ytsub; ?>" target="_blank"> <font color='blue'><? echo $site->title; ?></font> </a> </b> </div>
                        <br />

                        <div>
                            <a href="ytsubconf.php?sid=<? echo $site->id; ?>&user=<? echo $site->user; ?>&ytsub=<? echo $site->ytsub; ?>">
                                <input type="button" class="submit" value="Subscribe" style="width: 150px; height: 42px; font-size: 20px;" />
                            </a>
                        </div>

                        <br />
                        <div>
                            <a href="javascript:void(0);" onClick="SkipThisPage('<? echo $site->id; ?>');"><font color='grey' size=2>[Skip]</font></a>
                            &nbsp;&nbsp;
                            <a href="javascript:void(0);" onClick="ReportThisPage('<? echo $site->id; ?>');"><font color='darkred' size=1>[Report]</font></a>
                        </div>
                    </center>
                </div>
            <? } ?>

            <script type="text/javascript">
                var mywindow;
                var waittoconfirm = 0;
                var AddCPCnow = 0;
                var MybalancenowI = 0;
                MybalancenowI = <? echo $data->coins; ?>;

                function WaitToConfirmIt() {
                    if (waittoconfirm > 0) {
                        waittoconfirm = waittoconfirm - 1;
                        setTimeout("WaitToConfirmIt();", 1000);
                    }
                }
                function OpenLike(mysiteid, siteowner, mysite, cpc) {
                    /* AddCPCnow = cpc - 1;
                     MybalancenowI = MybalancenowI + AddCPCnow;
                     $("#Mybalancenow").html(numberWithCommas(MybalancenowI));
                     mywindow = window.open("http://www.youtube.com/subscribe_widget?p=" + mysite, "LikesASAP");
                     var timer11 = setInterval(function() {
                     if (mywindow.closed) {
                     clearInterval(timer11);
                     GetSubCount(mysiteid, siteowner);
                     }
                     }, 1000);
                     document.getElementById("Hint").style.display = 'block';
                     if (waittoconfirm < 1) {
                     waittoconfirm = 1;
                     setTimeout("WaitToConfirmIt();", 1000);
                     $("#Hint").html('<img src="img/loader.gif">');
                     $.ajax({
                     type: "GET",
                     url: "ytsubstart.php",
                     data: "sitename1=" + mysiteid + "---" + siteowner,
                     success: function(msg) {
                     if (msg > 0) {
                     $("#Hint").html('<font size="4" color="blue">Subscribe, and Close oppened window.</font>');
                     } else {
                     $("#Hint").html('<font size="4" color="red">Channel link is Broken. Please skip it and subscribe another.</font>');
                     }
                     }
                     });
                     
                     }
                     else {
                     $("#Hint").html('<font size="4" color="blue">Please wait ' + waittoconfirm + ' Seconds to confirm again!</font>');
                     }*/
                    GetSubCount(mysiteid, siteowner, mysite);
                }
                function SkipThisPage(mysiteid) {
                    document.getElementById("Hint").style.display = 'block';
                    $("#Hint").html('<img src="img/loader.gif">');
                    $.ajax({
                        type: "POST",
                        url: "ytsubskip.php",
                        data: "data=" + mysiteid + "---" + '<? echo $data->id; ?>',
                        cache: false,
                        success: function() {
                            $("#Hint").html('<font size="4" color="blue">Skipped!</font>');
                            removeElement('tbl', mysiteid);
                        }
                    });
                }
                function ReportThisPage(mysiteid) {
                    document.getElementById("Hint").style.display = 'block';
                    $("#Hint").html('<img src="img/loader.gif">');
                    $.ajax({
                        type: "POST",
                        url: "ytsubskipr.php",
                        data: "data=" + mysiteid + "---" + '<? echo $data->id; ?>',
                        cache: false,
                        success: function() {
                            $("#Hint").html('<font size="4" color="blue">Skipped!</font>');
                            removeElement('tbl', mysiteid);
                        }
                    });
                }

                function GetSubCount(mysiteaccid1, pageuserowner, mysite) {
                    document.getElementById("Hint").style.display = 'block';
                    if (waittoconfirm < 1) {
                        waittoconfirm = 1;
                        setTimeout("WaitToConfirmIt();", 1000);
                        $("#Hint").html('<img src="img/loader.gif">');
                        $.ajax({
                            type: "GET",
                            url: "ytsubconf.php",
                            data: "sitename1=" + mysiteaccid1 + "---" + pageuserowner + "---" + mysite,
                            success: function(msg) {
                                if (msg > 0) {
                                    $("#Hint").html('<font size="4" color="green">Subscribed! ' + msg + ' Points added to your balance.</font>');
                                    document.getElementById('Mybalancenow').contentWindow.location.reload(true);
                                    removeElement('tbl', mysiteaccid1);
                                }
                                if (msg == '-1') {
                                    $("#Hint").html('<font size="4" color="green">Ok. Points Added.</font>');
                                    document.getElementById('Mybalancenow').contentWindow.location.reload(true);
                                    removeElement('tbl', mysiteaccid1);
                                }
                                if (msg == 0) {
                                    $("#Hint").html('<font size="4" color="red">Not Subscribed!</font>');
                                }
                            }
                        });

                    }
                    else {
                        $("#Hint").html('<font size="4" color="blue">Please wait ' + waittoconfirm + ' Seconds to confirm again!</font>');
                    }

                }
            </script>

        </div>

        <div class="clearer">&nbsp;</div>

        <div class='infobox'> 
            <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='get' style="margin-bottom: 10px">
                <label for="">Search For the Channel:</label><input type="text" name="keyword" value="" />
                <input name='refresh' type='submit' value='Search' style='width:80px;'>
            </form>
            <?php $keyword = empty($keyword) ? '' : '&keyword=' . $keyword; ?>
            <?php if ($pageid > 1) : ?>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=1<?php echo $keyword; ?>" title="">Start</a>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo ($pageid - 1); ?><?php echo $keyword; ?>" title="">Previous</a>
            <?php endif; ?>
            <?php if ($pageid < $total_pages) : ?>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo ($pageid + 1); ?><?php echo $keyword; ?>" title="">Next</a>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo $total_pages; ?><?php echo $keyword; ?>" title="">End</a>
            <?php endif; ?>
            <span style="padding:5px;border:1px solid #DADADA;background-color:#F8F8F8"><?php echo $pageid . '/' . $total_pages; ?></span>
        </div>

    <? } else { ?>
    <center><br />
        <? $message00 = "Sorry, there are no more coins to be earned at the moment.<br />Please come back again later.<br /><a href='buy.php'><b>Feel like you need more coins? You can purchase them now!</b></a>"; ?>
        <table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
            <tr><td><img src="img/planet_stop.jpg" border="0" title="LikesASAP.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message00; ?> </font> </td></tr>
        </table>
    </center>
<? } ?>
<div class="clearer">&nbsp;</div>

<? include('footer.php'); ?>