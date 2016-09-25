// JavaScript Document
$(document).ready(function(){
	/* PRELOAD */
	
	/* END PRELOAD */
	
	/* OVER SOUNDS */
	$(".btn_ini").mouseenter(function(){ $(".over1").trigger("play"); });
	$(".btn_how").mouseenter(function(){ $(".over2").trigger("play"); });
	$(".btn_coin").mouseenter(function(){ $(".over3").trigger("play"); });
	$(".btn_rank").mouseenter(function(){ $(".over4").trigger("play"); });
	$(".botfb").mouseenter(function(){ $(".over1").trigger("play"); });
	$(".bottw").mouseenter(function(){ $(".over2").trigger("play"); });
	$(".botmenu").mouseenter(function(){ $(".over3").trigger("play"); });
	$(".botmore").mouseenter(function(){ $(".over4").trigger("play"); });
	$(".btn_return").mouseenter(function(){ $(".over1").trigger("play"); });
	
	/*   LINES FOR ANDROID 4.0.4 DOWN  */
	$('.maintheme, .soundClock, .soundError, .soundGreat, .soundFlip, .over1, .over2, .over3, .over4, .over5, .over6, .over7, .over8').on('ended', function() {
		if($(this).attr("class")=="maintheme"){
			$(this).attr("src","sounds/maintheme.mp3");
		}else
		if($(this).attr("class")=="soundClock"){
			$(this).attr("src","sounds/clock.mp3");
		}else
		if($(this).attr("class")=="soundError"){
			$(this).attr("src","sounds/error.mp3");
		}else
		if($(this).attr("class")=="soundGreat"){
			$(this).attr("src","sounds/great.mp3");
		}else
		if($(this).attr("class")=="soundFlip"){
			$(this).attr("src","sounds/flip.mp3");
		}else{
			$(this).attr("src","sounds/over.mp3");
		}
	});
	/*************************************/
	
	/* END OVER SOUND */
	
	$(".velo").html("<div class='box'><div onclick='generate();' onMouseOver='overSnd(5);' id='btnInicio'></div></div");
	$(".ct_menu .btn_ini").click(function(){
		$(".velo").html("<div class='box'><div onclick='generate();' onMouseOver='overSnd(5);' id='btnInicio'></div></div");
		$(".how").hide();
		$(".menu").hide();
	});
	$(".ct_menu .btn_how").click(function(){
		$(".how").show();
		$(".menu").hide();
	});
	$(".btn_return").click(function(){
		$(".how").hide();
		$(".menu").show();
	});
	
	$('#time').jrumble().hover(function(){
		//$(this).trigger('startRumble');
	}, function(){
		//$(this).trigger('stopRumble');
	});		
	
}); /*   END READY   */
var xPos=0;
var yPos=0;

function overSnd(idx){
	$(".over"+idx).trigger("play");
}

var val=[];
var estado=0; //0=inicia  -  1=continua
var score=0;
var seguida=0;
var lvl=1;
var TimeGame = new (function() {
    var $countdown,
        incrementTime = 70,
        currentTime = 6000,
        updateTimer = function() {
            //$countdown.html(currentTime);
            if (currentTime == 0) {
                TimeGame.Timer.stop();
                timerComplete();
                //TimeGame.resetCountdown();
                return;
            }
            currentTime -= incrementTime / 10;
            if(currentTime < 0){ currentTime = 0; }
			if((currentTime/100)<=5){ $('#time').trigger('startRumble'); $(".soundClock").trigger("play"); }
			$("#sec").css("background-position","center "+(-32*Math.round(currentTime/100)+1)+"px");
			
			
			//console.log(Math.round(currentTime/100));
        },
        timerComplete = function() {
			$(".velo").addClass("opacidad").show().html("<div class='box2'><div onclick='generate();' onMouseOver='overSnd(6);' id='again'></div><div id='more' onMouseOver='overSnd(7);'></div><div onclick='salida();' onMouseOver='overSnd(8);' id='salir'></div></div>");
			$('#time').trigger('stopRumble');
			estado=0;
            //console.log("SE ACABO EL TIEMPO");
        },
        init = function() {
            //$countdown = $('#time');
            TimeGame.Timer = $.timer(updateTimer, incrementTime, false);
        };
    this.resetCountdown = function(num) {
        var newTime = parseInt(num) * 100;
        if (newTime > 0) {currentTime = newTime;}
		this.Timer.stop().once();
        //this.Timer.play();
    };
	this.incrementCountdown = function(num) {
        var newTime = parseInt(num) * 100;
        if (newTime > 0) {currentTime += newTime;}
		this.Timer.stop().once();
        //this.Timer.play();
    };
    $(init);
});

var arrCards = ["card1","card2","card3","card4","card5","card6","card7","card8","card9","card10",
				"card11","card12","card13","card14","card15","card16","card17","card18","card19","card20"];
				
var arr = ["c1.png","c2.png","c3.png","c4.png","c5.png","c6.png","c7.png","c8.png","c9.png","c10.png",
		   "c1.png","c2.png","c3.png","c4.png","c5.png","c6.png","c7.png","c8.png","c9.png","c10.png"];
			   
function generate(){
	//$(".hover").removeClass("flip");
	$("#contCards").empty();
	$('#time').trigger('stopRumble');
	arr.sort(function() {return 0.5 - Math.random()});
	//console.log(arr);
	for(var k=1; k<21; k++){
		$("#contCards").append('<div class="hover panel" id="card'+k+'"><div class="front"><div class="pad"></div></div><div style="background:url(img/'+arr[k-1]+') no-repeat" id="sr'+k+'" class="back"><div class="pad"></div></div></div>');
		
	}
	initGame();
}
	
function initGame(){
	val=[];
	
	if(estado==0){
		score=0;
		$("#score").text(score);
		TimeGame.resetCountdown(60);
		TimeGame.Timer.play();
		estado = 1;
	}else{
		TimeGame.incrementCountdown(20); //POR DEFINIR - DEFINIDO
		TimeGame.Timer.play();
	}
	
	$(".hover").click(validar);
	$(".velo").hide().removeClass("opacidad").html("");
}
	
function validar(e){
	xPos = e.clientX-406;
    yPos = e.clientY-65;
	$(".soundFlip").trigger("play");
	$(this).off('click');
	if(!$(this).hasClass("flip")){
		$(this).addClass('flip');
	}
	//console.log("EL ARRAY: "+val.length);
	if(val.length==0){
		val[0]=[ $(this).attr("id"),$(this).find(".back").attr("style") ];
	}else{
		if(val[0][1]==$(this).find(".back").attr("style")){
			$(".soundGreat").trigger("play");
			//alert("bien");
			//console.log($(".flip").length);
			
			seguida++;
			var incr = 0;
			if(seguida>=5){ incr=2; }else{ incr=1; }
			score+=100*50*seguida*incr; /*ARGGGGG*/
			
			$( "#contCards" ).append( "<img style='left:"+xPos+"; top:"+yPos+"' class='morePts' src='img/"+100*50*seguida*incr+".gif?="+Math.round(Math.random()*100000)+"' />" ).find(".morePts").delay(1000).fadeOut(function(){$(this).remove();});
						
			if($(".flip").length >= 19){ 
				
				if(seguida>2){
					$( "#contCards" ).delay(500).append( "<img class='moreTimex20' src='img/25segs.gif?="+Math.round(Math.random()*100000)+"' />" ).find(".moreTimex20").delay(1000).fadeOut(function(){$(this).remove();});
				}else{
					$( "#contCards" ).delay(500).append( "<img class='moreTimex20' src='img/20segs.gif?="+Math.round(Math.random()*100000)+"' />" ).find(".moreTimex20").delay(1000).fadeOut(function(){$(this).remove();});
				}
				
				var toNets = setTimeout(
				function() 
				{
					seguida=0;
					nextLevel();
					clearTimeout(toNets);
				}, 1500);
			}else{
				if(seguida>2){
				TimeGame.incrementCountdown(5);
				TimeGame.Timer.play();
				$( "#contCards" ).append( "<img class='moreTimex5' src='img/5segs.gif?="+Math.round(Math.random()*100000)+"' />" ).find(".moreTimex5").delay(1000).fadeOut(function(){$(this).remove();});
			}
			}
			$("#score").text(score);
			val=[];
		}else{
			seguida=0;
			retornar(val[0][0],$(this).attr("id"));
			$(".soundError").trigger("play");				
		}
	}
}
function pauseGame(){
	if(estado==1){
		$(".velo").addClass("opacidad").show().html("<div class='box3'><div class='contbt'><div class='si' onClick='salida();' onMouseOver='overSnd(5);'></div><div class='no' onClick='playGame();' onMouseOver='overSnd(6);'></div></div></div>");
		TimeGame.Timer.pause();
	}else{
		salida();
	}
}
function playGame(){
	$(".velo").hide().removeClass("opacidad").html("");
	TimeGame.Timer.play();
}

function nextLevel(){
	if(lvl>=10){
		$(".velo").addClass("opacidad").show().html("<div class='box2' style='background:url(img/end_box_2.png) no-repeat;'><div onclick='generate();' onMouseOver='overSnd(6);' id='again'></div><div id='more' onMouseOver='overSnd(7);'></div><div onclick='salida();' onMouseOver='overSnd(8);' id='salir'></div></div>");
		$('#time').trigger('stopRumble');
		TimeGame.Timer.pause();
		estado=0;
		lvl=1;
	}else{
		TimeGame.Timer.pause();
		estado=1;
		lvl++;
		$(".velo").addClass("opacidad").show().html("<div class='box'><div class='btnLvl' style='background: url(img/nivel_"+lvl+".png) no-repeat;'></div></div>");
		var waitNext = setTimeout(
		function() 
		{
			generate();
			$(".noClick").hide();
			clearTimeout(waitNext);
		}, 3000);
	}
}

function retornar(_v1,_v2){
	$(".noClick").show();
	var wait = setTimeout(
	function() 
	{
		$("#"+_v1).removeClass('flip').on('click', validar);
		$("#"+_v2).removeClass('flip').on('click', validar);
		val=[];
		$(".noClick").hide();
		clearTimeout(wait);
	}, 1000);
}

function salida(){
	val=[];
	estado=0; //0=inicia  -  1=continua
	score=0;
	seguida=0;
	lvl=1;
	$(".menu").show();
	$("#sec").css("background-position","center "+(-32*60)+"px");
	$(".velo").html("<div class='box'><div onclick='generate();' id='btnInicio'></div></div");
	$("#score").text("0");
	$('#time').trigger('stopRumble');
}

/*************FORMATO TIEMPO **********/
function pad(number, length) {
    var str = '' + number;
    while (str.length < length) {str = '0' + str;}
    return str;
}
function formatTime(time) {
    var min = parseInt(time / 6000),
        sec = parseInt(time / 100) - (min * 60),
        hundredths = pad(time - (sec * 100) - (min * 6000), 2);
    return (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2)/* + ":" + hundredths*/;
}