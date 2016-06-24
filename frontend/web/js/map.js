$(document).ready(function() {

    var map;
    var markers = [];
    var address_input = $('.address');
    var geocoder = new google.maps.Geocoder();

    function initialiseGoogleMap(map_el, map_lat, map_lng) {
        map = new google.maps.Map($(map_el)[0], {
            zoom: 8,
            center: {lat: parseFloat(map_lat.val()), lng: parseFloat(map_lng.val())}
        });
        var myLatLng = {lat: parseFloat(map_lat.val()), lng: parseFloat(map_lng.val())};
        addMarker(myLatLng, map_el.parent().find('.address').data('map'));
        var geocoder = new google.maps.Geocoder();
        $('.address, .city, .state, .zip').change(function() {
            geocodeAddress(geocoder, $(this).data('map'), true, map);
        });
    }

    address_input.each(function() {
        var parent = $(this).parent();
        $( this ).parent().append('<a class="view_map" data-click-state = "1">View Map</a>');
        if($('.map_lat[data-map="'+$(this).data('map')+'"]').val() == '' && $('.map_lng[data-map="'+$(this).data('map')+'"]').val() == '') {
            geocodeAddress(geocoder, $(this).data('map'), false);
        }

        parent.find('.view_map').click(function() {
            if(parent.find(address_input).val() == ''){
                return false;
            }
            if($(this).attr('data-click-state') == 1) {
                $(this).attr('data-click-state', 0)
                $(this).text('Close Map');
                $(this).parent().append('<div class="map"></div>');
                initialiseGoogleMap(parent.find('.map'), $('.map_lat[data-map="'+parent.find(address_input).data('map')+'"]'),$('.map_lng[data-map="'+parent.find(address_input).data('map')+'"]'));
            } else {
                $(this).attr('data-click-state', 1)
                $(this).text('View Map');
                parent.find('.map').remove();
            }
            return false;
        });
    });

    $('.address, .city, .state, .zip').change(function() {
        var message = 'your location will be changed';
        alertMessage('teal', message);
        geocodeAddress(geocoder, $(this).data('map'), false);
    });


    function geocodeAddress(geocoder, elem, with_map, resultsMap) {
        var address = '';
        var address_arr = [];

        if($('.address[data-map="'+elem+'"]').length>0 && $('.address[data-map="'+elem+'"]').val()!='') address_arr.push($('.address[data-map="'+elem+'"]').val());
        if($('.city[data-map="'+elem+'"]').length>0 && $('.city[data-map="'+elem+'"]').val()!='') address_arr.push($('.city[data-map="'+elem+'"]').val());
        if($('.state[data-map="'+elem+'"]').length>0 && $('.state[data-map="'+elem+'"]').val()!='') address_arr.push($('.state[data-map="'+elem+'"]').val());
        if($('.zip[data-map="'+elem+'"]').length>0 && $('.zip[data-map="'+elem+'"]').val()!='') address_arr.push($('.zip[data-map="'+elem+'"]').val());
        address = address_arr.join(", ");
        if(address) {
            geocoder.geocode({'address': address}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (with_map) {
                        resultsMap.setCenter(results[0].geometry.location);
                        deleteMarkers();
                        addMarker(results[0].geometry.location, elem);
                    }
                    if($('.map_lat[data-map="'+elem+'"]').val() != results[0].geometry.location.lat){
                        $('.map_lat[data-map="'+elem+'"]').val(results[0].geometry.location.lat);
                    }
                    if($('.map_lng[data-map="'+elem+'"]').val() != results[0].geometry.location.lng){
                        $('.map_lng[data-map="'+elem+'"]').val(results[0].geometry.location.lng);
                    }
                } else {
                    alert('Cannot determine address at this location.');
                }
            });
        }
    }

    function addMarker(location, elem) {
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            draggable:true
        });
        markers.push(marker);
        google.maps.event.addListener(marker, 'dragend', function(evt){
            if($('.map_lat[data-map="'+elem+'"]').val() != evt.latLng.lat()){
                $('.map_lat[data-map="'+elem+'"]').val( evt.latLng.lat());
            }
            if($('.map_lat[data-map="'+elem+'"]').val() != evt.latLng.lng()){
                $('.map_lng[data-map="'+elem+'"]').val( evt.latLng.lng());
            }
        });

    }

    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    function clearMarkers() {
        setMapOnAll(null);
    }

    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }

    function alertMessage(theme, message){
        var settings = {
                theme: theme
            },
            $button = $(this);

        if ($.trim($('#notific8_heading').val()) != '') {
            settings.heading = $.trim($('#notific8_heading').val());
        }


        $.notific8('zindex', 11500);
        $.notific8($.trim(message), settings);
    }


});





