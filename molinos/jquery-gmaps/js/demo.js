$(document).ready(function(){
   	
    //Simple map
    $('#simple-map').gmaps();
    
    //Complex map
    $("#complex-map").gmaps({
        latitude: 37.00255267215955,
        longitude: -78.81591796875,
        zoom: 6  
    });
    
    var pb = progressBar();
    var map_data = $("#complex-map").data();
    
    map_data.map.controls[google.maps.ControlPosition.RIGHT].push(pb.getDiv());
    $("#complex-map").data(map_data);    
    
    $('.addMarkers').click(function(){
        var markers = [
            {
                latitude: 38.91221098726067,
                longitude: -77.23411970625,
                html: "Address: %address%<br />Coords: %lat% - %lng%"
            },
            {
                address: "Richmond, usa",
                html: "Address: %address%<br />Coords: %lat% - %lng%"
            },
            {
                address: "Norfolk, usa",
                html: "Address: %address%<br />Coords: %lat% - %lng%",
                draggable: true
            },
            {
                address: "Asheville, usa",
                html: "Address: %address%<br />Coords: %lat% - %lng%"
            },
            {
                address: "Jacksonville, north carolina, usa",
                html: "Address: %address%<br />Coords: %lat% - %lng%"
            },
            {
                address: "Huntington, usa",
                html: "Address: %address%<br />Coords: %lat% - %lng%"
            },
            {
                address: "daneville, north carolina,  usa",
                html: "Address: %address%<br />Coords: %lat% - %lng%"
            }
        ];
        $("#complex-map").gmaps("deleteAllMarkers");
        pb.start(markers.length);        
        $.each(markers,function(index,values){
            setTimeout(function() { $("#complex-map").gmaps("addMarker",values);
                                    pb.updateBar(1)
                                    if (index == 6) pb.hide();
                                    }, index*1000); 
        });
        
        
    });
    
    $('.deleteAllMarkers').click(function(){
        $("#complex-map").gmaps("deleteAllMarkers"); 
    });
    
    $('.changeCenter').click(function(){
        $("#complex-map").gmaps("centerAt",{address: "Washington DC, USA", zoom: 13}); 
    });
    
    $('.deleteFirstMarker').click(function(){
        $("#complex-map").gmaps("deleteMarker",0); 
    });
    
    $('.deleteCustomMarker').click(function(){
        var o = $("#complex-map").data();
        
        $.each(o.mapMarkers,function(index,values){
            if (values.draggable)
            {
                $("#complex-map").gmaps("deleteMarker",values);           
            } 
        });
        
         
    });
    
    //explains
	$('.htmlCode, .jsCode').click(function(ui){
		var find = ($(ui.currentTarget).hasClass('htmlCode')) ? '.html-code' : '.js-code';
		var parent = $(this).parents().eq(1);
		var code = parent.find(find);
		if (code.css('display') == 'none') code.slideDown('slow');
		else code.slideUp('slow');
		
	   	return false;	
	});

   	
});