var f=1000*20;
function getSongAlter(){
   var getsong = $.get('songs/current',function(xml){
      if(xml=="error"){
         $("#songTitle").html("Server not running.");
         $("#songAlbum").html("Server not running.");
         f=0;
      }
      else{
         $("#songTitle").fadeOut();
         $("#songTitle").html("Playing: "+$(xml)[4].textContent);
         $("#songTitle").fadeIn();
         $("#songArtist").fadeOut();
         $("#songArtist").html("Artist: "+$(xml)[3].textContent);
         $("#songArtist").fadeIn();
      }
   });
}

player = {
   "value":1,
   "play": function(audio){
      audio.src= "http://localhost:8000/stream.ogg";
      getSongAlter();
      audio.play();
      audio.volume = this.value;
   },
   "stop": function(audio){
      audio.pause();
      //audio.src="";
   },
   "mute": function(audio){
      $("#muted").hide();
      $("#mute").show();
      audio.volume = 0;
   },
   "unmute": function(audio){
      $("#mute").hide();
      $("#muted").show();
      audio.volume = this.value;
   },
   "ended": function(){
      alert("audio ended");
   },
   "updateVolume": function(e,u,audio){
      if(window.localStorage){
         localStorage.setItem("volume",u.value);
      }
      this.value = u.value/100;
      if(u.value/100==0){
         this.mute(audio);
      }
      else{
         this.unmute(audio);
      }
   }
}

/*function genWave(audio){
   var canvas = document.getElementsByTagName("canvas")[0];
   var context = canvas.getContext('2d');
   audio.addEventListener("MozAudioAvailable", buildWave, false);
   function buildWave (event){
      var channels = audio.mozChannels;
      var frameBufferLength = audio.mozFrameBufferLength;
      var fbData = event.frameBuffer;
      var stepInc = (frameBufferLength / channels) / canvas.width;
      var waveAmp = canvas.height / 2;
      canvas.width = canvas.width;
      context.beginPath();
      context.moveTo(0, waveAmp - fbData[0] * waveAmp);
      for(var i=1; i < canvas.width; i++){
         context.lineTo(i, waveAmp - fbData[i*stepInc] * waveAmp);
      }
      context.strokeStyle = "#fff";
      context.stroke();
   }
}*/

function delete_error(e,t){
   setTimeout(function(){
      if($(e))
         $(e).fadeOut().remove();
   },t);
}

/*function getSong(){
   var getsong = $.get('files/now_playing.json',function(json){
      /*if(xml=="error"){
         $("#songTitle").html("Server not running.");
         $("#songAlbum").html("Server not running.");
         f=0;
      }*/
      /*else{
         $("#songTitle").fadeOut();
         $("#songTitle").html("Playing: "+json.song);
         $("#songTitle").fadeIn();
         if(json.artist){
            $("#songArtist").html("Artist: "+json.artist);
            $("#songArtist").parent().parent().parent().show()
         }else{
            $("#songArtist").parent().parent().parent().hide();
         }
         if(json.dedicate_to){
            $("#dedicateTo").html("Dedicate To: "+json.dedicate_to);
            $("#dedicateTo").parent().parent().parent().show()
         }else{
            $("#dedicateTo").parent().parent().parent().hide();
         }
         if(json.username){
            $("#requestedBy").html("Dedication By: "+json.username);
            $("#requestedBy").parent().parent().parent().show()
         }else{
            $("#requestedBy").parent().parent().parent().hide();
         }
      //}
   });
}*/

function getSongName(){
   setTimeout(function(){getSong();getSongName();},10000);
}


$(document).ready(function(){
   setTimeout(function(){
      if($('.control-group .error-message'))
         $('.control-group .error-message').remove();
   },2000);

   if(window.HTMLAudioElement){
   var audio = document.createElement('audio');
   if(audio.canPlayType("audio/ogg")===""){
      $("#playerArea").html("<p class='alert alert-error'>Your browser does not support playback of ogg files. Its time to upgrade or use another browser!!</p>");
   }
   else{
      var audio = new Audio();
      /*audio.addEventListener("error",function(e){
         //console.log(e);
         player.stop(audio);
         player.play(audio);
         //getSongAlter();
      });*/

      function updateTime(e){
         var ele = $("#currentTime");
         var min = audio.currentTime/60;
         var sec = audio.currentTime%60;
         min=parseInt(min);
         sec=parseInt(sec);
         if(min<10){
            min="0"+min;
         }
         if(sec<10){
            sec="0"+sec;
         }
         ele.html(min+":"+sec);
      }

      if(localStorage.getItem('volume')){
         player.value=localStorage.getItem('volume')/100;
      }
      
      //audio.addEventListener('timeupdate',updateTime);
      
      player.play(audio);

      $('#vol-slider').slider({
         "min": 0,
         "max": 100,
         "value":player.value*100,
         "slide": function(e,u){
            player.updateVolume(e,u,audio);
         }
      });
   }
   }
   else{
      $("#playerArea").html("<p class='alert alert-error'>Your browser does not support audio playback at all. Its time to upgrade!!</p>");
   }

   //getSongAlter();

   $("#now-playing li").bind("mouseover",function(){
   		if(!$(this).hasClass("ui-btn-up-b"))
    		   $(this).addClass("ui-btn-down-c");
   });
   $("#now-playing li").bind("mouseout",function(){
       $(this).removeClass("ui-btn-down-c");
   });

   $("#play").live("click",function(){
   		$(this).hide();
   		$("#stop").show();
         player.play(audio);
         return false;
   });
   $("#stop").live("click",function(){
   		$(this).hide();
   		$("#play").show();
         player.stop(audio);
         return false;
   });
   $("#mute").live("click",function(e){
   		$(this).hide();
   		$("#muted").show();
         player.unmute(audio);
         return false;
   });
   $("#muted").live("click",function(e){
   		$(this).hide();
   		$("#mute").show();
         player.mute(audio);
         return false;
   });

   $("#main-menu li a").bind("click",function(){
      if($(this).parent().hasClass("active")){
      }
      else{
         $("#main-menu li").each(function(){
            $(this).removeClass("active");
         });
         $(this).parent().addClass("active");
      }
      return false;
   });

   $("#alertModal").modal({
      "show":false,
      "backdrop":false,
      "keyboard":true
   });

   $("#modalClose").click(function(){
      $('#alertModal').modal("hide");
      return false;
   });
});
