$(document).ready(function() { 

	//PopUps
	
	var popupPrimary =  '.popupPrimary';
	var popupClick = '.ql h4';
	
	$(popupPrimary).hide(); 
	
	$(popupClick).click(function(){
		
	var $this = $(this);
		
	if( $this.next().is(':hidden') ) { 
		$(popupClick).removeClass('active').next().hide(); 
		$this.toggleClass('active').next().show(); 
	}
	return false; 
	});
	
	//Hide elements on document click
	$(popupPrimary).click(function (e) {
    	e.stopPropagation();
	});
	$(document).click(function() {
		$(popupPrimary).hide();
	});
	
	
	//Menu

	$('#main_navigation ul li > ul').css('visibility', 'hidden');
	
	$('#main_navigation ul > li').hover(function(){
		
		if($(this).find('ul').length>0) {
			$(this).addClass('hover_sub');
		} else $(this).addClass('li_hover');

        $('ul:first',this).css('visibility', 'visible');
    
    }, function(){
    
        $(this).removeClass('hover_sub');
		$(this).removeClass('li_hover');
        $('ul:first',this).css('visibility', 'hidden');
    
    });
	
	//Sidebar
	
	$('#left_side ul li.box:first, #right_side ul li.box:first').addClass('first');
	$('#left_side ul li.box:last, #right_side ul li.box:last').addClass('last');
	
	//Inputs
	
	var inputs = 'input[type=text], textarea';
	
	$(this).find(inputs).addClass("idleField");
	$(this).find(inputs).focus(function() {
		$(this).removeClass("idleField").addClass("focusField");
		if (this.value == this.defaultValue){
			this.value = '';
		}
		if(this.value != this.defaultValue){
			this.select();
		}
	});

	$(this).find(inputs).blur(function() {
		if ($.trim(this.value) == ''){
			$(this).removeClass("focusField").removeClass("completeField");
			this.value = (this.defaultValue ? this.defaultValue : '');
		} 
	});
	
	//Slider
	
	$('#slider')
	.nivoSlider({
		directionNav: true,
		controlNav: false,
		prevText: '&lt;', 
        nextText: '&gt;',
		pauseTime: 4000,
		directionNavHide: false
	});
	
});


// Tweets
(function(a){a.fn.tweet=function(n){var f="https:",c=null,b=a.extend({username:c,list:c,favorites:false,query:c,avatar_size:c,count:3,fetch:c,page:1,retweets:true,intro_text:c,outro_text:c,join_text:c,auto_join_text_default:"i said,",auto_join_text_ed:"i",auto_join_text_ing:"i am",auto_join_text_reply:"i replied to",auto_join_text_url:"i was looking at",loading_text:c,refresh_interval:c,twitter_url:"twitter.com",twitter_api_url:"api.twitter.com",twitter_search_url:"search.twitter.com",template:"{avatar}{time}{join}{text}",comparator:function(a,b){return b.tweet_time-a.tweet_time},filter:function(){return true}},n),g=/\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»""'']))/gi;function d(a,d){if(typeof a==="string"){var b=a;for(var e in d){var f=d[e];b=b.replace(new RegExp("{"+e+"}","g"),f===c?"":f)}return b}else return a(d)}a.extend({tweet:{t:d}});function e(c,b){return function(){var d=[];this.each(function(){d.push(this.replace(c,b))});return a(d)}}a.fn.extend({linkUrl:e(g,function(a){var b=/^[a-z]+:/i.test(a)?a:"http://"+a;return'<a href="'+b+'">'+a+"</a>"}),linkUser:e(/@(\w+)/gi,'@<a href="http://'+b.twitter_url+'/$1">$1</a>'),linkHash:e(/(?:^| )[\#]+([\w\u00c0-\u00d6\u00d8-\u00f6\u00f8-\u00ff\u0600-\u06ff]+)/gi,' <a href="http://'+b.twitter_search_url+"/search?q=&tag=$1&lang=all"+(b.username&&b.username.length==1&&!b.list?"&from="+b.username.join("%2BOR%2B"):"")+'">#$1</a>'),capAwesome:e(/\b(awesome)\b/gi,'<span class="awesome">$1</span>'),capEpic:e(/\b(epic)\b/gi,'<span class="epic">$1</span>'),makeHeart:e(/(&lt;)+[3]/gi,"<tt class='heart'>&#x2665;</tt>")});function m(a){return Date.parse(a.replace(/^([a-z]{3})( [a-z]{3} \d\d?)(.*)( \d{4})$/i,"$1,$2$4$3"))}function k(d){var c=arguments.length>1?arguments[1]:new Date,a=parseInt((c.getTime()-d)/1e3,10),b="";if(a<60)b=a+" seconds ago";else if(a<120)b="a minute ago";else if(a<2700)b=parseInt(a/60,10).toString()+" minutes ago";else if(a<7200)b="an hour ago";else if(a<86400)b=""+parseInt(a/3600,10).toString()+" hours ago";else if(a<172800)b="a day ago";else b=parseInt(a/86400,10).toString()+" days ago";return"about "+b}function i(a){return a.match(/^(@([A-Za-z0-9-_]+)) .*/i)?b.auto_join_text_reply:a.match(g)?b.auto_join_text_url:a.match(/^((\w+ed)|just) .*/im)?b.auto_join_text_ed:a.match(/^(\w*ing) .*/i)?b.auto_join_text_ing:b.auto_join_text_default}function l(a){return f==document.location.protocol?a.replace(/^http:/,f):a}function j(){var d="&callback=?",a="//",g=f==document.location.protocol?f:"http:",e=b.fetch===c?b.count:b.fetch;if(b.list)return g+a+b.twitter_api_url+"/1/"+b.username[0]+"/lists/"+b.list+"/statuses.json?page="+b.page+"&per_page="+e+d;else if(b.favorites)return g+a+b.twitter_api_url+"/favorites/"+b.username[0]+".json?page="+b.page+"&count="+e+d;else if(b.query===c&&b.username.length==1)return g+a+b.twitter_api_url+"/1/statuses/user_timeline.json?screen_name="+b.username[0]+"&count="+e+(b.retweets?"&include_rts=1":"")+"&page="+b.page+d;else{var h=b.query||"from:"+b.username.join(" OR from:");return g+a+b.twitter_search_url+"/search.json?&q="+encodeURIComponent(h)+"&rpp="+e+"&page="+b.page+d}}function h(e){var c={};c.item=e;c.source=e.source;c.screen_name=e.from_user||e.user.screen_name;c.avatar_size=b.avatar_size;c.avatar_url=l(e.profile_image_url||e.user.profile_image_url);c.retweet=typeof e.retweeted_status!="undefined";c.tweet_time=m(e.created_at);c.join_text=b.join_text=="auto"?i(e.text):b.join_text;c.tweet_id=e.id_str;c.twitter_base="http://"+b.twitter_url+"/";c.user_url=c.twitter_base+c.screen_name;c.tweet_url=c.user_url+"/status/"+c.tweet_id;c.reply_url=c.twitter_base+"intent/tweet?in_reply_to="+c.tweet_id;c.retweet_url=c.twitter_base+"intent/retweet?tweet_id="+c.tweet_id;c.favorite_url=c.twitter_base+"intent/favorite?tweet_id="+c.tweet_id;c.retweeted_screen_name=c.retweet&&e.retweeted_status.user.screen_name;c.tweet_relative_time=k(c.tweet_time);c.tweet_raw_text=c.retweet?"RT @"+c.retweeted_screen_name+" "+e.retweeted_status.text:e.text;c.tweet_text=a([c.tweet_raw_text]).linkUrl().linkUser().linkHash()[0];c.tweet_text_fancy=a([c.tweet_text]).makeHeart().capAwesome().capEpic()[0];c.user=d('<a class="tweet_user" href="{user_url}">{screen_name}</a>',c);c.join=b.join_text?d(' <span class="tweet_join">{join_text}</span> ',c):" ";c.avatar=c.avatar_size?d('<a class="tweet_avatar" href="{user_url}"><img src="{avatar_url}" height="{avatar_size}" width="{avatar_size}" alt="{screen_name}\'s avatar" title="{screen_name}\'s avatar" border="0"/></a>',c):"";c.time=d('<span class="tweet_time"><a href="{tweet_url}" title="view tweet on twitter">{tweet_relative_time}</a></span>',c);c.text=d('<span class="tweet_text">{tweet_text_fancy}</span>',c);c.reply_action=d('<a class="tweet_action tweet_reply" href="{reply_url}">reply</a>',c);c.retweet_action=d('<a class="tweet_action tweet_retweet" href="{retweet_url}">retweet</a>',c);c.favorite_action=d('<a class="tweet_action tweet_favorite" href="{favorite_url}">favorite</a>',c);return c}return this.each(function(m,c){var g="tweet:load",f="</p>",e=a('<ul class="tweet_list">').appendTo(c),k='<p class="tweet_intro">'+b.intro_text+f,l='<p class="tweet_outro">'+b.outro_text+f,i=a('<p class="loading">'+b.loading_text+f);if(b.username&&typeof b.username=="string")b.username=[b.username];b.loading_text&&a(c).append(i);a(c).bind(g,function(){a.getJSON(j(),function(j){b.loading_text&&i.remove();b.intro_text&&e.before(k);e.empty();var f=a.map(j.results||j,h);f=a.grep(f,b.filter).sort(b.comparator).slice(0,b.count);e.append(a.map(f,function(a){return"<li>"+d(b.template,a)+"</li>"}).join("")).children("li:first").addClass("tweet_first").end().children("li:odd").addClass("tweet_even").end().children("li:even").addClass("tweet_odd");b.outro_text&&e.after(l);a(c).trigger("loaded").trigger(f.length===0?"empty":"full");b.refresh_interval&&window.setTimeout(function(){a(c).trigger(g)},1e3*b.refresh_interval)})}).trigger(g)})}})(jQuery);


/*
 * jQuery Nivo Slider v3.2
 * http://nivo.dev7studios.com
 *
 * Copyright 2012, Dev7studios
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */

(function(e){var t=function(t,n){var r=e.extend({},e.fn.nivoSlider.defaults,n);var i={currentSlide:0,currentImage:"",totalSlides:0,running:false,paused:false,stop:false,controlNavEl:false};var s=e(t);s.data("nivo:vars",i).addClass("nivoSlider");var o=s.children();o.each(function(){var t=e(this);var n="";if(!t.is("img")){if(t.is("a")){t.addClass("nivo-imageLink");n=t}t=t.find("img:first")}var r=r===0?t.attr("width"):t.width(),s=s===0?t.attr("height"):t.height();if(n!==""){n.css("display","none")}t.css("display","none");i.totalSlides++});if(r.randomStart){r.startSlide=Math.floor(Math.random()*i.totalSlides)}if(r.startSlide>0){if(r.startSlide>=i.totalSlides){r.startSlide=i.totalSlides-1}i.currentSlide=r.startSlide}if(e(o[i.currentSlide]).is("img")){i.currentImage=e(o[i.currentSlide])}else{i.currentImage=e(o[i.currentSlide]).find("img:first")}if(e(o[i.currentSlide]).is("a")){e(o[i.currentSlide]).css("display","block")}var u=e("<img/>").addClass("nivo-main-image");u.attr("src",i.currentImage.attr("src")).show();s.append(u);e(window).resize(function(){s.children("img").width(s.width());u.attr("src",i.currentImage.attr("src"));u.stop().height("auto");e(".nivo-slice").remove();e(".nivo-box").remove()});s.append(e('<div class="nivo-caption"></div>'));var a=function(t){var n=e(".nivo-caption",s);if(i.currentImage.attr("title")!=""&&i.currentImage.attr("title")!=undefined){var r=i.currentImage.attr("title");if(r.substr(0,1)=="#")r=e(r).html();if(n.css("display")=="block"){setTimeout(function(){n.html(r)},t.animSpeed)}else{n.html(r);n.stop().fadeIn(t.animSpeed)}}else{n.stop().fadeOut(t.animSpeed)}};a(r);var f=0;if(!r.manualAdvance&&o.length>1){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}if(r.directionNav){s.append('<div class="nivo-directionNav"><a class="nivo-prevNav">'+r.prevText+'</a><a class="nivo-nextNav">'+r.nextText+"</a></div>");e(s).on("click","a.nivo-prevNav",function(){if(i.running){return false}clearInterval(f);f="";i.currentSlide-=2;d(s,o,r,"prev")});e(s).on("click","a.nivo-nextNav",function(){if(i.running){return false}clearInterval(f);f="";d(s,o,r,"next")})}if(r.controlNav){i.controlNavEl=e('<div class="nivo-controlNav"></div>');s.after(i.controlNavEl);for(var l=0;l<o.length;l++){if(r.controlNavThumbs){i.controlNavEl.addClass("nivo-thumbs-enabled");var c=o.eq(l);if(!c.is("img")){c=c.find("img:first")}if(c.attr("data-thumb"))i.controlNavEl.append('<a class="nivo-control" rel="'+l+'"><img src="'+c.attr("data-thumb")+'" alt="" /></a>')}else{i.controlNavEl.append('<a class="nivo-control" rel="'+l+'">'+(l+1)+"</a>")}}e("a:eq("+i.currentSlide+")",i.controlNavEl).addClass("active");e("a",i.controlNavEl).bind("click",function(){if(i.running)return false;if(e(this).hasClass("active"))return false;clearInterval(f);f="";u.attr("src",i.currentImage.attr("src"));i.currentSlide=e(this).attr("rel")-1;d(s,o,r,"control")})}if(r.pauseOnHover){s.hover(function(){i.paused=true;clearInterval(f);f=""},function(){i.paused=false;if(f===""&&!r.manualAdvance){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}})}s.bind("nivo:animFinished",function(){u.attr("src",i.currentImage.attr("src"));i.running=false;e(o).each(function(){if(e(this).is("a")){e(this).css("display","none")}});if(e(o[i.currentSlide]).is("a")){e(o[i.currentSlide]).css("display","block")}if(f===""&&!i.paused&&!r.manualAdvance){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}r.afterChange.call(this)});var h=function(t,n,r){if(e(r.currentImage).parent().is("a"))e(r.currentImage).parent().css("display","block");e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").width(t.width()).css("visibility","hidden").show();var i=e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").parent().is("a")?e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").parent().height():e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").height();for(var s=0;s<n.slices;s++){var o=Math.round(t.width()/n.slices);if(s===n.slices-1){t.append(e('<div class="nivo-slice" name="'+s+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block !important; top:0; left:-"+(o+s*o-o)+'px;" /></div>').css({left:o*s+"px",width:t.width()-o*s+"px",height:i+"px",opacity:"0",overflow:"hidden"}))}else{t.append(e('<div class="nivo-slice" name="'+s+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block !important; top:0; left:-"+(o+s*o-o)+'px;" /></div>').css({left:o*s+"px",width:o+"px",height:i+"px",opacity:"0",overflow:"hidden"}))}}e(".nivo-slice",t).height(i);u.stop().animate({height:e(r.currentImage).height()},n.animSpeed)};var p=function(t,n,r){if(e(r.currentImage).parent().is("a"))e(r.currentImage).parent().css("display","block");e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").width(t.width()).css("visibility","hidden").show();var i=Math.round(t.width()/n.boxCols),s=Math.round(e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").height()/n.boxRows);for(var o=0;o<n.boxRows;o++){for(var a=0;a<n.boxCols;a++){if(a===n.boxCols-1){t.append(e('<div class="nivo-box" name="'+a+'" rel="'+o+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block; top:-"+s*o+"px; left:-"+i*a+'px;" /></div>').css({opacity:0,left:i*a+"px",top:s*o+"px",width:t.width()-i*a+"px"}));e('.nivo-box[name="'+a+'"]',t).height(e('.nivo-box[name="'+a+'"] img',t).height()+"px")}else{t.append(e('<div class="nivo-box" name="'+a+'" rel="'+o+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block; top:-"+s*o+"px; left:-"+i*a+'px;" /></div>').css({opacity:0,left:i*a+"px",top:s*o+"px",width:i+"px"}));e('.nivo-box[name="'+a+'"]',t).height(e('.nivo-box[name="'+a+'"] img',t).height()+"px")}}}u.stop().animate({height:e(r.currentImage).height()},n.animSpeed)};var d=function(t,n,r,i){var s=t.data("nivo:vars");if(s&&s.currentSlide===s.totalSlides-1){r.lastSlide.call(this)}if((!s||s.stop)&&!i){return false}r.beforeChange.call(this);if(!i){u.attr("src",s.currentImage.attr("src"))}else{if(i==="prev"){u.attr("src",s.currentImage.attr("src"))}if(i==="next"){u.attr("src",s.currentImage.attr("src"))}}s.currentSlide++;if(s.currentSlide===s.totalSlides){s.currentSlide=0;r.slideshowEnd.call(this)}if(s.currentSlide<0){s.currentSlide=s.totalSlides-1}if(e(n[s.currentSlide]).is("img")){s.currentImage=e(n[s.currentSlide])}else{s.currentImage=e(n[s.currentSlide]).find("img:first")}if(r.controlNav){e("a",s.controlNavEl).removeClass("active");e("a:eq("+s.currentSlide+")",s.controlNavEl).addClass("active")}a(r);e(".nivo-slice",t).remove();e(".nivo-box",t).remove();var o=r.effect,f="";if(r.effect==="random"){f=new Array("sliceDownRight","sliceDownLeft","sliceUpRight","sliceUpLeft","sliceUpDown","sliceUpDownLeft","fold","fade","boxRandom","boxRain","boxRainReverse","boxRainGrow","boxRainGrowReverse");o=f[Math.floor(Math.random()*(f.length+1))];if(o===undefined){o="fade"}}if(r.effect.indexOf(",")!==-1){f=r.effect.split(",");o=f[Math.floor(Math.random()*f.length)];if(o===undefined){o="fade"}}if(s.currentImage.attr("data-transition")){o=s.currentImage.attr("data-transition")}s.running=true;var l=0,c=0,d="",m="",g="",y="";if(o==="sliceDown"||o==="sliceDownRight"||o==="sliceDownLeft"){h(t,r,s);l=0;c=0;d=e(".nivo-slice",t);if(o==="sliceDownLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);n.css({top:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="sliceUp"||o==="sliceUpRight"||o==="sliceUpLeft"){h(t,r,s);l=0;c=0;d=e(".nivo-slice",t);if(o==="sliceUpLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);n.css({bottom:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="sliceUpDown"||o==="sliceUpDownRight"||o==="sliceUpDownLeft"){h(t,r,s);l=0;c=0;var b=0;d=e(".nivo-slice",t);if(o==="sliceUpDownLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);if(c===0){n.css("top","0px");c++}else{n.css("bottom","0px");c=0}if(b===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;b++})}else if(o==="fold"){h(t,r,s);l=0;c=0;e(".nivo-slice",t).each(function(){var n=e(this);var i=n.width();n.css({top:"0px",width:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({width:i,opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({width:i,opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="fade"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:t.width()+"px"});m.animate({opacity:"1.0"},r.animSpeed*2,"",function(){t.trigger("nivo:animFinished")})}else if(o==="slideInRight"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:"0px",opacity:"1"});m.animate({width:t.width()+"px"},r.animSpeed*2,"",function(){t.trigger("nivo:animFinished")})}else if(o==="slideInLeft"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:"0px",opacity:"1",left:"",right:"0px"});m.animate({width:t.width()+"px"},r.animSpeed*2,"",function(){m.css({left:"0px",right:""});t.trigger("nivo:animFinished")})}else if(o==="boxRandom"){p(t,r,s);g=r.boxCols*r.boxRows;c=0;l=0;y=v(e(".nivo-box",t));y.each(function(){var n=e(this);if(c===g-1){setTimeout(function(){n.animate({opacity:"1"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1"},r.animSpeed)},100+l)}l+=20;c++})}else if(o==="boxRain"||o==="boxRainReverse"||o==="boxRainGrow"||o==="boxRainGrowReverse"){p(t,r,s);g=r.boxCols*r.boxRows;c=0;l=0;var w=0;var E=0;var S=[];S[w]=[];y=e(".nivo-box",t);if(o==="boxRainReverse"||o==="boxRainGrowReverse"){y=e(".nivo-box",t)._reverse()}y.each(function(){S[w][E]=e(this);E++;if(E===r.boxCols){w++;E=0;S[w]=[]}});for(var x=0;x<r.boxCols*2;x++){var T=x;for(var N=0;N<r.boxRows;N++){if(T>=0&&T<r.boxCols){(function(n,i,s,u,a){var f=e(S[n][i]);var l=f.width();var c=f.height();if(o==="boxRainGrow"||o==="boxRainGrowReverse"){f.width(0).height(0)}if(u===a-1){setTimeout(function(){f.animate({opacity:"1",width:l,height:c},r.animSpeed/1.3,"",function(){t.trigger("nivo:animFinished")})},100+s)}else{setTimeout(function(){f.animate({opacity:"1",width:l,height:c},r.animSpeed/1.3)},100+s)}})(N,T,l,c,g);c++}T--}l+=100}}};var v=function(e){for(var t,n,r=e.length;r;t=parseInt(Math.random()*r,10),n=e[--r],e[r]=e[t],e[t]=n);return e};var m=function(e){if(this.console&&typeof console.log!=="undefined"){console.log(e)}};this.stop=function(){if(!e(t).data("nivo:vars").stop){e(t).data("nivo:vars").stop=true;m("Stop Slider")}};this.start=function(){if(e(t).data("nivo:vars").stop){e(t).data("nivo:vars").stop=false;m("Start Slider")}};r.afterLoad.call(this);return this};e.fn.nivoSlider=function(n){return this.each(function(r,i){var s=e(this);if(s.data("nivoslider")){return s.data("nivoslider")}var o=new t(this,n);s.data("nivoslider",o)})};e.fn.nivoSlider.defaults={effect:"random",slices:15,boxCols:8,boxRows:4,animSpeed:500,pauseTime:3e3,startSlide:0,directionNav:true,controlNav:true,controlNavThumbs:false,pauseOnHover:true,manualAdvance:false,prevText:"Prev",nextText:"Next",randomStart:false,beforeChange:function(){},afterChange:function(){},slideshowEnd:function(){},lastSlide:function(){},afterLoad:function(){}};e.fn._reverse=[].reverse})(jQuery)
