<?php
$page_title = "Free Fan Sign Photo Generator from LikesPlanet.com - People hang up signs with your name";
$meta_description = "Fan Sign Photo Generator/Maker Online for FREE by LikesPlanet.com";
$meta_keywords = "Fan Sign, Generator, Maker, Photo, Online, Fan, Sign, LikesPlanet";

include('header.php');
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$fan_id = $get['fan_id'];

// mysql_query("INSERT INTO `fans` (hits) VALUES('0') ");

if ($fan_id == 1) {
$def_msg = "i love you\nLikesPlanet.com";
$def_font = "01.ttf";
$def_fontcolor = "#203049";
$def_fontsize = "28";
}
if ($fan_id == 2) {
$def_msg = "I Love You\nLikesPlanet.com";
$def_font = "02.ttf";
$def_fontcolor = "#904080";
$def_fontsize = "26";
}
if ($fan_id == 3) {
$def_msg = "LikesPlanet";
$def_font = "03.otf";
$def_fontcolor = "#992222";
$def_fontsize = "110";
}
if ($fan_id == 4) {
$def_msg = "i love you\nLikesPlanet\n\nit helps to get fans\nand followers easy\n\nearning money also!";
$def_font = "04.ttf";
$def_fontcolor = "#203049";
$def_fontsize = "22";
}
if ($fan_id == 5) {
$def_msg = " \n yes!! LikesPlanet\njust Coool site :)";
$def_font = "05.ttf";
$def_fontcolor = "#202020";
$def_fontsize = "28";
}
if ($fan_id == 6) {
$def_msg = "LikesPlanet.com";
$def_font = "09.ttf";
$def_fontcolor = "#202090";
$def_fontsize = "21";
}
if ($fan_id == 7) {
$def_msg = "I love this site\nLikesPlanet.com\nvery much, it is my\nfav website.  xoxo";
$def_font = "10.otf";
$def_fontcolor = "#202020";
$def_fontsize = "19";
}
if ($fan_id == 8) {
$def_msg = " LikesPlanet\n  is my life !\n\nmimi";
$def_font = "11.ttf";
$def_fontcolor = "#202090";
$def_fontsize = "19";
}
if ($fan_id == 9) {
$def_msg = "I love you LikesPlanet\nmy best wishes for you\n\nmimi\nxoxo";
$def_font = "12.ttf";
$def_fontcolor = "#202020";
$def_fontsize = "16";
}
if ($fan_id == 10) {
$def_msg = " LikesPlanet.com\n    join us now!\nxoxo";
$def_font = "01.ttf";
$def_fontcolor = "#203049";
$def_fontsize = "24";
}
if ($fan_id == 11) {
$def_msg = "www.LikesPlanet.com\n   join us now! Free!!";
$def_font = "02.ttf";
$def_fontcolor = "#904080";
$def_fontsize = "22";
}
if ($fan_id == 12) {
$def_msg = "LikesPlanet.com\njoin us now!\nFree!!\nGet Real Fans\ngood luck!";
$def_font = "13.ttf";
$def_fontcolor = "#202020";
$def_fontsize = "23";
}
if ($fan_id == 13) {
$def_msg = "   LikesPlanet.com";
$def_font = "10.otf";
$def_fontcolor = "#202090";
$def_fontsize = "13";
}
if ($fan_id == 14) {
$def_msg = "I\nLikesPlanet\nxoxo";
$def_font = "01.ttf";
$def_fontcolor = "#992222";
$def_fontsize = "28";
}
if ($fan_id == 15) {
$def_msg = "I\nLikesPlanet.com";
$def_font = "14.ttf";
$def_fontcolor = "#483C32";
$def_fontsize = "40";
}
if ($fan_id == 16) {
$def_msg = "LikesPlanet.com";
$def_font = "07.ttf";
$def_fontcolor = "#203049";
$def_fontsize = "19";
}
if ($fan_id == 17) {
$def_msg = "LikesPlanet.com!\n             xoxo";
$def_font = "14.ttf";
$def_fontcolor = "#203049";
$def_fontsize = "17";
}
if ($fan_id == 18) {
$def_msg = "LikesPlanet.com\njoin now!";
$def_font = "13.ttf";
$def_fontcolor = "#202090";
$def_fontsize = "34";
}
if ($fan_id == 19) {
$def_msg = "LikesPlanet.com";
$def_font = "06.ttf";
$def_fontcolor = "#483C32";
$def_fontsize = "38";
}
if ($fan_id == 20) {
$def_msg = "Happy Birthday\nLikesPlanet.com\n                    - yang";
$def_font = "01.ttf";
$def_fontcolor = "#483C32";
$def_fontsize = "10";
}
if ($fan_id == 21) {
$def_msg = "Happy Birthday\n LikesPlanet.com\n i love you.  xoxo";
$def_font = "10.otf";
$def_fontcolor = "#992222";
$def_fontsize = "13";
}
if ($fan_id == 22) {
$def_msg = "Happy Birthday\n LikesPlanet.com\n  i love you.\nxoxo";
$def_font = "01.ttf";
$def_fontcolor = "#483C32";
$def_fontsize = "9";
}
if ($fan_id == 23) {
$def_msg = "Hello Likers!\nLikesPlanet.com\n Very cool site!\n<< Join now >>";
$def_font = "01.ttf";
$def_fontcolor = "#C07777";
$def_fontsize = "16";
}
if ($fan_id == 24) {
$def_msg = "LikesPlanet\n      ^^";
$def_font = "17.ttf";
$def_fontcolor = "#606090";
$def_fontsize = "20";
}
if ($fan_id == 25) {
$def_msg = "  I\n\nLikesPlanet";
$def_font = "16.ttf";
$def_fontcolor = "#804050";
$def_fontsize = "26";
}
if ($fan_id == 26) {
$def_msg = " I\n  Likes   Planet";
$def_font = "22.ttf";
$def_fontcolor = "#804050";
$def_fontsize = "40";
}
if ($fan_id == 27) {
$def_msg = "Happy Birthday\nLikesPlanet.com!\nbest wishes...\n  follow me there!";
$def_font = "15.otf";
$def_fontcolor = "#486666";
$def_fontsize = "26";
}
if ($fan_id == 28) {
$def_msg = "Happy Birthday\nLikesPlanet.com!\nbest wishes...\n  follow me there!\n                               xoxo";
$def_font = "15.otf";
$def_fontcolor = "#486666";
$def_fontsize = "25";
}
if ($fan_id == 29) {
$def_msg = "Happy Birthday\nLikesPlanet.com!\nbest wishes...\n  follow me there!\n                           xoxo";
$def_font = "15.otf";
$def_fontcolor = "#486666";
$def_fontsize = "25";
}
if ($fan_id == 30) {
$def_msg = "Happy Birthday\nLikesPlanet.com!\n    best wishes...\n  follow me there!";
$def_font = "18.ttf";
$def_fontcolor = "#486666";
$def_fontsize = "35";
}
if ($fan_id == 31) {
$def_msg = "     i love www.LikesPlanet.com";
$def_font = "19.ttf";
$def_fontcolor = "#202090";
$def_fontsize = "22";
}
if ($fan_id == 32) {
$def_msg = "www.LikesPlanet.com\n      is 1st\nsocial media exchanger\n     join now!!";
$def_font = "20.ttf";
$def_fontcolor = "#486666";
$def_fontsize = "15";
}
if ($fan_id == 33) {
$def_msg = "LikesPlanet.com\n    join now!!";
$def_font = "20.ttf";
$def_fontcolor = "#486666";
$def_fontsize = "14";
}

$def_msg2 = str_replace("\n", "%0D%0A", $def_msg);
$def_fontcolor2 = str_replace("#", "", $def_fontcolor);



?>
<body id="tab3"> 

<h1>Get Real Fans</h1>
<p>You can get Real people holding your name, website, or company name.</p>
<p>Now, Enter Message Needed, Edit font size to fit your message!</p>

<div class="clearer">&nbsp;</div>

<table cellpadding="0" cellspacing="0" border="0" style="margin-top: 0px; padding: 0px; border: 0px;"><tr>
<td>
<h1>Your Message :</h1>
<textarea id="htmlmsg" style="width: 250px; height: 130px; color:darkblue; background: cyan;"><? echo $def_msg;?></textarea>
</td>
<td width="20"></td>
<td> <h1>Font :</h1>
<select name="fontid" id="fontid" onchange="PrevFont(this.value);" onscroll="PrevFont(this.value);">
<option value="01.ttf" <?if($def_font == "01.ttf"){?>selected<?}?> > Handy Pen </option>
<option value="02.ttf" <?if($def_font == "02.ttf"){?>selected<?}?> > Draw </option>
<option value="03.otf" <?if($def_font == "03.otf"){?>selected<?}?> > Candy </option>
<option value="04.ttf" <?if($def_font == "04.ttf"){?>selected<?}?> > Thin </option>
<option value="05.ttf" <?if($def_font == "05.ttf"){?>selected<?}?> > Draw 2 </option>
<option value="06.ttf" <?if($def_font == "06.ttf"){?>selected<?}?> > Candy 2</option>
<option value="07.ttf" <?if($def_font == "07.ttf"){?>selected<?}?> > Candy 3</option>
<option value="08.ttf" <?if($def_font == "08.ttf"){?>selected<?}?> > Draw 3</option>
<option value="09.ttf" <?if($def_font == "09.ttf"){?>selected<?}?> > Draw Pen </option>
<option value="10.otf" <?if($def_font == "10.otf"){?>selected<?}?> > Pencil </option>
<option value="11.ttf" <?if($def_font == "11.ttf"){?>selected<?}?> > Draw Pen 2</option>
<option value="12.ttf" <?if($def_font == "12.ttf"){?>selected<?}?> > Thin 2</option>
<option value="13.ttf" <?if($def_font == "13.ttf"){?>selected<?}?> > Draw Pen 3</option>
<option value="14.ttf" <?if($def_font == "14.ttf"){?>selected<?}?> > Skinny </option>
<option value="15.otf" <?if($def_font == "15.otf"){?>selected<?}?> > Font 15</option>
<option value="16.ttf" <?if($def_font == "16.ttf"){?>selected<?}?> > Big Bold</option>
<option value="17.ttf" <?if($def_font == "17.ttf"){?>selected<?}?> > Skinng Pen </option>
<option value="18.ttf" <?if($def_font == "18.ttf"){?>selected<?}?> > Skinng Pen 2</option>
<option value="19.ttf" <?if($def_font == "19.ttf"){?>selected<?}?> > Skinng Pen 3</option>
<option value="20.ttf" <?if($def_font == "20.ttf"){?>selected<?}?> > Hand Pen 2</option>
<option value="21.ttf" <?if($def_font == "21.ttf"){?>selected<?}?> > Skinng Pen 3</option>
<option value="22.ttf" <?if($def_font == "22.ttf"){?>selected<?}?> > Hand Pen 3</option>
<option value="23.ttf" <?if($def_font == "23.ttf"){?>selected<?}?> > Hand Pen 4</option>

</select></br>
<iframe id='prevfont' name="prevfont" src="fan_sign_generator/fan_sign_font.php?font=<? echo $def_font; ?>"
        scrolling="no" frameborder="0"
        style="border:none; width:410px; height:70px"></iframe>
<h1>Font Size :</h1>
<input type="text" name="fontsizee" id="fontsizee" value="<? echo $def_fontsize;?>" size="5" /></br>
</td>
<td> <h1>Font Color :</h1>
<select name="fontcolorp" id="fontcolorp" onchange="FontColorSet(this.value);">
<option value="203049" <?if($def_fontcolor == "#203049"){?>selected<?}?> style="background-color: #203049;" > #203049</option>
<option value="904080" <?if($def_fontcolor == "#904080"){?>selected<?}?> style="background-color: #904080;" > #904080</option>
<option value="992222" <?if($def_fontcolor == "#992222"){?>selected<?}?> style="background-color: #992222;" > #992222</option>
<option value="483C32" <?if($def_fontcolor == "#483C32"){?>selected<?}?> style="background-color: #483C32;" > #483C32</option>
<option value="202020" <?if($def_fontcolor == "#202020"){?>selected<?}?> style="background-color: #202020;" > #202020</option>
<option value="202090" <?if($def_fontcolor == "#202090"){?>selected<?}?> style="background-color: #202090;" > #202090</option>
<option value="C07777" <?if($def_fontcolor == "#C07777"){?>selected<?}?> style="background-color: #C07777;" > #C07777</option>
<option value="606090" <?if($def_fontcolor == "#606090"){?>selected<?}?> style="background-color: #606090;" > #606090</option>
<option value="804050" <?if($def_fontcolor == "#804050"){?>selected<?}?> style="background-color: #804050;" > #804050</option>
<option value="486666" <?if($def_fontcolor == "#486666"){?>selected<?}?> style="background-color: #486666;" > #486666</option>


</select></br>
<h1>Custom :</h1>
<input type="text" name="fontcolorcode" id="fontcolorcode" value="<? echo $def_fontcolor2;?>" size="8" />
</td>
</tr>
</table>


</br>


        
        
<center><input type=submit class="submitgreen" value="Fan Me" style="width: 300px; hieght: 60px; font-size: 24;" onclick="RefBefore();"></center>

<div class="clearer">&nbsp;</div>
<center>

<iframe id='pagesbeforeii' name="pagesbeforeii" src="fan_sign_generator/fan_sign_gen.php?fan_id=<? echo $fan_id;?>&msg=<? echo $def_msg2;?>&font=<? echo $def_font;?>&color=<? echo $def_fontcolor2;?>&size=<? echo $def_fontsize;?>&paid=0&ref=<? echo rand(1,1000);?>"
        scrolling="no" frameborder="0"
        style="border:none; width:700px; height:700px"></iframe>
</br>


<? if(isset($data->login)){ ?>
<input type=submit class="submitgreen" value="Remove Watermark (25 Points)" onclick="BuyThisWater(); RefreshCoins();" style="width: 500px; hieght: 60px; font-size: 24;" >
<? } else { ?>
</br>
<font color='green' size='5'> Remove (LikesPlanet.com) watermark <font size='6'>for <b>FREE!</b></font> </font></br></br></br>
<font color='green' size='5'> Just join LikesPlanet.com (100% Free) </font></br></br>
<a href="register.php"><font color='blue' size='5'> <b>Create LikesPlanet account now and Enjoy Fans! </b> </font></br></a>
<? } ?>

</br></br>
<input type=submit class="submitgreen" value="<< Back to Fans List" onclick="document.location.href='fan_sign_start.php?rnd=<? echo rand(1,100); ?>';" style="width: 350px; hieght: 60px; font-size: 24;" >
</br></br>

<font color='green' size='4'>Download Photo: </font></br></br>
<font color='blue' size='3'> Right-click on Photo, Save Image As... </font></br></br>

</center>

<script language=javascript>
var randd = <? echo rand(1, 1000); ?>;

function RefBefore() { 
randd = randd +1;
var text = document.getElementById("htmlmsg").value;
text = text.replace(/\n\r?/g, '%0D%0A');
var aaa = "fan_sign_generator/fan_sign_gen.php?fan_id=<? echo $fan_id;?>&msg=" + text + "&font=" + document.getElementById("fontid").value + "&color=" + document.getElementById("fontcolorcode").value + "&size=" + document.getElementById("fontsizee").value + "&paid=0&ref=" + randd;
document.getElementById("pagesbeforeii").src = aaa;
}
function BuyThisWater() { 
randd = randd +1;
var text = document.getElementById("htmlmsg").value;
text = text.replace(/\n\r?/g, '%0D%0A');
var aaa = "fan_sign_generator/fan_sign_gen.php?fan_id=<? echo $fan_id;?>&msg=" + text + "&font=" + document.getElementById("fontid").value + "&color=" + document.getElementById("fontcolorcode").value + "&size=" + document.getElementById("fontsizee").value + "&paid=1&ref=" + randd;
document.getElementById("pagesbeforeii").src = aaa;
}
function PrevFont(fontfilename) { 
var aaa = "fan_sign_generator/fan_sign_font.php?font=" + fontfilename;
document.getElementById("prevfont").src = aaa;
}
function FontColorSet(fontcolorcodee) { 
document.getElementById("fontcolorcode").value = fontcolorcodee;
}
function RefreshCoins() {
	var timer11 = setInterval(function() {   
    		document.getElementById('Mybalancenow').contentWindow.location.reload(true);
        	clearInterval(timer11);  
		}, 1000);  
}

function downloadWithName(uri, name) {

    function eventFire(el, etype){
        if (el.fireEvent) {
            (el.fireEvent('on' + etype));
        } else {
            var evObj = document.createEvent('Events');
            evObj.initEvent(etype, true, false);
            el.dispatchEvent(evObj);
        }
    }

    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    eventFire(link, "click");

}

</script>

<? include('footer.php');?>