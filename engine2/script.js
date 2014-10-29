/**
 * Coin Slider - Unique jQuery Image Slider
 * @version: 1.0 - (2010/04/04)
 * @requires jQuery v1.2.2 or later 
 * @author Ivan Lazarevic
 * Examples and documentation at: http://workshop.rs/projects/coin-slider/
 
 * Licensed under MIT licence:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * ! modified by wowslider.com:
 * use image instance insted of src property (need for use preloader)
 * use additional container insted of image container
 * resposible
**/
if(!jQuery.fn.coinslider){(function(g){var f=new Array;var d=new Array;var n=new Array;var p=new Array;var e=new Array;var l=new Array;var c=new Array;var h=new Array;var o=new Array;var b=new Array;var m=new Array;var a=new Array;g.fn.coinslider=g.fn.CoinSlider=function(q){init=function(r){d[r.id]=new Array();n[r.id]=new Array();p[r.id]=new Array();e[r.id]=new Array();l[r.id]=new Array();h[r.id]=q.startSlide||0;b[r.id]=0;m[r.id]=1;a[r.id]=r;f[r.id]=g.extend({},g.fn.coinslider.defaults,q);g.each(g("#"+r.id+" img"),function(s,t){n[r.id][s]=t;p[r.id][s]=g(t).parent().is("a")?g(t).parent().attr("href"):"";e[r.id][s]=g(t).parent().is("a")?g(t).parent().attr("target"):"";l[r.id][s]=g(t).next().is("span")?g(t).next().html():""});a[r.id]=g("<div class='coin-slider' id='coin-slider-"+r.id+"' />").css({"background-image":"url("+n[r.id][q.startSlide||0].src+")","-o-background-size":"100%","-webkit-background-size":"100%","-moz-background-size":"100%","background-size":"100%",width:"100%",height:"100%",position:"relative","background-position":"top left"}).appendTo(g(r).parent());for(i=1;i<=f[r.id].sph;i++){for(j=1;j<=f[r.id].spw;j++){g(f[r.id].links?("<a href='"+p[r.id][0]+"'></a>"):"<div></div>").css({"float":"left",position:"absolute"}).appendTo(a[r.id]).attr("id","cs-"+r.id+i+j)}}a[r.id].append("<div class='cs-title' id='cs-title-"+r.id+"' style='position: absolute; bottom:0; left: 0; z-index: 1000;'></div>");if(f[r.id].navigation){g.setNavigation(r)}};g.setFields=function(s){var r=a[s.id].width();var t=a[s.id].height();tWidth=sWidth=parseInt(r/f[s.id].spw);tHeight=sHeight=parseInt(t/f[s.id].sph);counter=sLeft=sTop=0;tgapx=gapx=f[s.id].width-f[s.id].spw*sWidth;tgapy=gapy=f[s.id].height-f[s.id].sph*sHeight;for(i=1;i<=f[s.id].sph;i++){gapx=tgapx;if(gapy>0){gapy--;sHeight=tHeight+1}else{sHeight=tHeight}for(j=1;j<=f[s.id].spw;j++){if(gapx>0){gapx--;sWidth=tWidth+1}else{sWidth=tWidth}d[s.id][counter]=i+""+j;counter++;g("#cs-"+s.id+i+j).css({width:sWidth+"px",height:sHeight+"px","background-position":-sLeft+"px "+(-sTop+"px"),"background-size":r+"px "+t+"px","-moz-background-size":r+"px "+t+"px","-o-background-size":r+"px "+t+"px","-webkit-background-size":r+"px "+t+"px",left:sLeft,top:sTop}).addClass("cs-"+s.id);sLeft+=sWidth}sTop+=sHeight;sLeft=0}g(".cs-"+s.id).mouseover(function(){g("#cs-navigation-"+s.id).show()});g(".cs-"+s.id).mouseout(function(){g("#cs-navigation-"+s.id).hide()});g("#cs-title-"+s.id).mouseover(function(){g("#cs-navigation-"+s.id).show()});g("#cs-title-"+s.id).mouseout(function(){g("#cs-navigation-"+s.id).hide()});if(f[s.id].hoverPause){g(".cs-"+s.id).mouseover(function(){f[s.id].pause=true});g(".cs-"+s.id).mouseout(function(){f[s.id].pause=false});g("#cs-title-"+s.id).mouseover(function(){f[s.id].pause=true});g("#cs-title-"+s.id).mouseout(function(){f[s.id].pause=false})}};g.transitionCall=function(r){if(f[r.id].delay<0){return}clearInterval(c[r.id]);delay=f[r.id].delay+f[r.id].spw*f[r.id].sph*f[r.id].sDelay;c[r.id]=setInterval(function(){g.transition(r)},delay)};g.transition=function(r,s){if(f[r.id].pause==true){return}g.setFields(r);g.effect(r);b[r.id]=0;o[r.id]=setInterval(function(){g.appereance(r,d[r.id][b[r.id]])},f[r.id].sDelay);g(a[r.id]).css({"background-image":"url("+n[r.id][h[r.id]].src+")"});if(typeof(s)=="undefined"){h[r.id]++}else{if(s=="prev"){h[r.id]--}else{h[r.id]=s}}if(h[r.id]==n[r.id].length){h[r.id]=0}if(h[r.id]==-1){h[r.id]=n[r.id].length-1}g(".cs-button-"+r.id).removeClass("cs-active");g("#cs-button-"+r.id+"-"+(h[r.id]+1)).addClass("cs-active");if(l[r.id][h[r.id]]){g("#cs-title-"+r.id).css({opacity:0}).animate({opacity:f[r.id].opacity},f[r.id].titleSpeed);g("#cs-title-"+r.id).html(l[r.id][h[r.id]])}else{g("#cs-title-"+r.id).css("opacity",0)}};g.appereance=function(s,r){g(".cs-"+s.id).attr("href",p[s.id][h[s.id]]).attr("target",e[s.id][h[s.id]]);if(b[s.id]==f[s.id].spw*f[s.id].sph){clearInterval(o[s.id]);setTimeout(function(){g(s).trigger("cs:animFinished")},300);return}g("#cs-"+s.id+r).css({opacity:0,"background-image":"url("+n[s.id][h[s.id]].src+")"});g("#cs-"+s.id+r).animate({opacity:1},300);b[s.id]++};g.setNavigation=function(r){g(a[r.id]).append("<div id='cs-navigation-"+r.id+"'></div>");g("#cs-navigation-"+r.id).hide();g("#cs-navigation-"+r.id).append("<a href='#' id='cs-prev-"+r.id+"' class='cs-prev'>prev</a>");g("#cs-navigation-"+r.id).append("<a href='#' id='cs-next-"+r.id+"' class='cs-next'>next</a>");g("#cs-prev-"+r.id).css({position:"absolute",top:f[r.id].height/2-15,left:0,"z-index":1001,"line-height":"30px",opacity:f[r.id].opacity}).click(function(s){s.preventDefault();g.transition(r,"prev");g.transitionCall(r)}).mouseover(function(){g("#cs-navigation-"+r.id).show()});g("#cs-next-"+r.id).css({position:"absolute",top:f[r.id].height/2-15,right:0,"z-index":1001,"line-height":"30px",opacity:f[r.id].opacity}).click(function(s){s.preventDefault();g.transition(r);g.transitionCall(r)}).mouseover(function(){g("#cs-navigation-"+r.id).show()});g("<div id='cs-buttons-"+r.id+"' class='cs-buttons'></div>").appendTo(g("#coin-slider-"+r.id));for(k=1;k<n[r.id].length+1;k++){g("#cs-buttons-"+r.id).append("<a href='#' class='cs-button-"+r.id+"' id='cs-button-"+r.id+"-"+k+"'>"+k+"</a>")}g.each(g(".cs-button-"+r.id),function(s,t){g(t).click(function(u){g(".cs-button-"+r.id).removeClass("cs-active");g(this).addClass("cs-active");u.preventDefault();g.transition(r,s);g.transitionCall(r)})});g("#cs-navigation-"+r.id+" a").mouseout(function(){g("#cs-navigation-"+r.id).hide();f[r.id].pause=false});g("#cs-buttons-"+r.id).css({left:"50%","margin-left":-n[r.id].length*15/2-5,position:"relative"})};g.effect=function(r){effA=["random","swirl","rain","straight","snakeV","rainV"];if(f[r.id].effect==""){eff=effA[Math.floor(Math.random()*(effA.length))]}else{eff=f[r.id].effect}d[r.id]=new Array();if(eff=="random"){counter=0;for(i=1;i<=f[r.id].sph;i++){for(j=1;j<=f[r.id].spw;j++){d[r.id][counter]=i+""+j;counter++}}g.random(d[r.id])}if(/rain|swirl|straight|snakeV|rainV/.test(eff)){g[eff](r)}m[r.id]*=-1;if(m[r.id]>0){d[r.id].reverse()}};g.random=function(r){var t=r.length;if(t==0){return false}while(--t){var s=Math.floor(Math.random()*(t+1));var v=r[t];var u=r[s];r[t]=u;r[s]=v}};g.swirl=function(r){var t=f[r.id].sph;var u=f[r.id].spw;var B=1;var A=1;var s=0;var v=0;var z=0;var w=true;while(w){v=(s==0||s==2)?u:t;for(i=1;i<=v;i++){d[r.id][z]=B+""+A;z++;if(i!=v){switch(s){case 0:A++;break;case 1:B++;break;case 2:A--;break;case 3:B--;break}}}s=(s+1)%4;switch(s){case 0:u--;A++;break;case 1:t--;B++;break;case 2:u--;A--;break;case 3:t--;B--;break}check=g.max(t,u)-g.min(t,u);if(u<=check&&t<=check){w=false}}};g.rain=function(t){var w=f[t.id].sph;var r=f[t.id].spw;var v=0;var u=to2=from=1;var s=true;while(s){for(i=from;i<=u;i++){d[t.id][v]=i+""+parseInt(to2-i+1);v++}to2++;if(u<w&&to2<r&&w<r){u++}if(u<w&&w>=r){u++}if(to2>r){from++}if(from>u){s=false}}};g.rainV=function(t){var u=f[t.id];var v=0;for(var s=1;s<=u.sph;s++){for(var r=1;r<=u.spw;r++){d[t.id][v]=s+""+r;v++}}};g.snakeV=function(t){var u=f[t.id];var v=0;for(var s=1;s<=u.sph;s++){for(var r=1;r<=u.spw;r++){d[t.id][v]=s+""+(s%2?r:u.spw+1-r);v++}}};g.straight=function(r){counter=0;for(i=1;i<=f[r.id].sph;i++){for(j=1;j<=f[r.id].spw;j++){d[r.id][counter]=i+""+j;counter++}}};g.min=function(s,r){if(s>r){return r}else{return s}};g.max=function(s,r){if(s<r){return r}else{return s}};this.each(function(){init(this)})};g.fn.coinslider.defaults={width:565,height:290,spw:7,sph:5,delay:3000,sDelay:30,opacity:0.7,titleSpeed:500,effect:"",navigation:true,links:true,hoverPause:true}})(jQuery)};// -----------------------------------------------------------------------------------
// http://wowslider.com/
// JavaScript Wow Slider is a free software that helps you easily generate delicious 
// slideshows with gorgeous transition effects, in a few clicks without writing a single line of code.
// Generated by WOW Slider 4.2
//
//***********************************************
// Obfuscated by Javascript Obfuscator
// http://javascript-source.com
//***********************************************
function ws_squares(c,a,b){var g=jQuery;var e=b.find("ul").get(0);e.id="wowslider_tmp"+Math.round(Math.random()*99999);var h=0;g(e).coinslider({hoverPause:false,startSlide:c.startSlide,navigation:0,delay:-1,effect:c.type,width:c.width,height:c.height,sDelay:c.duration/(7*5)});var f=g("#coin-slider-"+e.id).css({position:"absolute",left:0,top:0,"z-index":8});var d=c.startSlide;g(e).bind("cs:animFinished",function(){g(e).css({left:-d+"00%"}).stop(true,true).show();if(h<2){h=0;f.hide()}});this.go=function(i){h++;f.show();d=i;g.transition(e,i);f.css("background","none");if(c.fadeOut){g(e).fadeOut(c.duration)}return i}};// -----------------------------------------------------------------------------------
// http://wowslider.com/
// JavaScript Wow Slider is a free software that helps you easily generate delicious 
// slideshows with gorgeous transition effects, in a few clicks without writing a single line of code.
// Generated by WOW Slider 4.2
//
//***********************************************
// Obfuscated by Javascript Obfuscator
// http://javascript-source.com
//***********************************************
jQuery("#wowslider-container2").wowSlider({effect:"squares",prev:"",next:"",duration:20*100,delay:30*100,width:792,height:332,autoPlay:true,playPause:true,stopOnHover:false,loop:false,bullets:true,caption:true,captionEffect:"slide",controls:true,onBeforeStep:0,images:0});