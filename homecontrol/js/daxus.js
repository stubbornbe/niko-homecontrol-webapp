// JavaScript Document

function getScrollY() {
	
  var scrOfY = 0;
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    scrOfY = window.pageYOffset;
  } else if( document.documentElement && document.documentElement.scrollTop ) {
    //IE6 standards compliant mode
    scrOfY = document.documentElement.scrollTop;
  } else if( document.body && document.body.scrollTop ) {
    //DOM compliant
    scrOfY = document.body.scrollTop;
  }
return scrOfY;
}

$(".button").click(function(){
	
	actionId=$(this).attr('Id').substring(7);
	
	if($(this).attr('class')=="button buttonOn"){
		if($("#slider_" +actionId).length) {
			setTo=255;
		}else{
			setTo=0;
		}
	}else{
		if($("#slider_" +actionId).length) {
			setTo=254;
		}else{
			setTo=100;
		}
		
	}
	
	$.ajax({
		type: "POST",
		url: "command.php",
		data: {
			'actionId' : actionId,
			'action' : setTo,
			'ip' : ip
		}
	});
});

$(function() {
	
	$('.slider').prepend("<div class='customMarker'></div>");
	
	$('.slider').slider({
		min: 0,
		max:100,
		step: 1,
		animate: true,
		create: function( event, ui ) {
			value=$('#h_'+$(this).attr('Id')).val();
			$(this).slider( "value", value );
			$('#d_'+$(this).attr('Id')).find('.customMarker').css('width', value*2.25 + 'px');
		},
		change: function( event, ui ) {
			if (event.originalEvent) {
				actionId=$(this).attr('Id').substring(7);
				$.ajax({
					type: "POST",
					url: "command.php",
					data: {
						'actionId' : actionId,
						'action' : ui.value,
						'ip' : ip
					}
				});
			}
		}
	});
});

function updateVisual(id,setTo){
	if(setTo==0){
		$('#button_'+id).removeClass("buttonOn");
		$('#button_'+id).addClass("buttonOff");
		if($("#slider_" +id).length >= 0) {
			$('#slider_'+id).slider( "value", 0 );
			$("#slider_"+id).find('.customMarker').css('width', '0px');
		}
	}else{
		$('#button_'+id).removeClass("buttonOff");
		$('#button_'+id).addClass("buttonOn");
		if($("#slider_" +id).length >= 0) {
			$('#slider_'+id).slider( "value", setTo );
			$("#slider_"+id).find('.customMarker').css('width', setTo*2.25 + 'px');
		}
	}
}

function messages_longpolling(){

   jQuery.ajax({
      url: 'pollForChanges.php',
      type: 'GET',
	  cache   : false,
	  dataType: 'json',

      success: function( payload ){
         if( payload.status == 'results' || payload.status == 'no-results' ){
			 messages_longpolling();
            if( payload.status == 'results' ){
				//alert(payload.data);
               	jQuery.each( payload.data, function(x,y){
					id=y.id;
					setTo=y.value1;
					updateVisual(id,setTo);
					//alert(id);
               });
			   
			   jQuery.each( payload.eventje, function(x,y){
					id=y.id;
					typeke=y.type;
					text=y.text;
					//updateVisual(id,setTo);
               });
            }/*else if( payload.status == 'no-results' ){
				alert("Geen event binnen interval");
			}*/
         } else if( payload.status == 'error' ){
            alert('Polling stopped due to error.');
         }
      },
	  
      error: function(){
		  messages_longpolling();
      }
   });
}

messages_longpolling();
	
/*
jQuery.each( payload.eventje, function(x,y){
				   alert('goe');
					id=y.id;
					type=y.type;
					text=y.text;
					alert(text);
					//updateVisual(id,setTo);
               });*/