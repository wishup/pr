var markers  = new Array();

$(document).ready(function(){

    $.each( $(".map_container"), function(){

        load_map( $(this) );

    } );

});

function map_navigate_to( value ){

    latlng = new Array();

    latlng["alaska"] = [[71.114992, -167.607422], [53.301338, -141.416016]];
    latlng["all"] = [[71.114992, -167.607422], [15.066819, -60.556641]];
    latlng["hawaii"] = [[24.395882, -163.454590], [16.708548, -152.863770]];
    latlng["continental"] = [[48.963991, -126.694336], [24.104140, -65.083008]];

    value = value.toLowerCase();

    map_viewbox($(".map_container"), latlng[ value ]);

}

function map_viewbox(map_obj, latlng){

    coords = getLatLngBox( map_obj, latlng );

    map_change_viewbox( map_obj, coords );

}

function getLatLngBox( map_obj, latlng ){

    min_x = 10000;
    min_y = 10000;
    max_x = 0;
    max_y = 0;

    for( var i in latlng ){

        coord = $(map_obj).mapSvg().ll3px(latlng[i]);

        if( coord[0] < min_x ) min_x = coord[0];
        if( coord[0] > max_x ) max_x = coord[0];

        if( coord[1] < min_y ) min_y = coord[1];
        if( coord[1] > max_y ) max_y = coord[1];

    }

    return [ [min_x, min_y], [max_x, max_y] ];

}

function map_change_viewbox( map_obj, coords ){

    padding = 5;

    xy = coords[0];
    xy2 = coords[1];

    width = Math.abs( xy[0] - xy2[0] );
    height = Math.abs( xy[1] - xy2[1] );

    // Set padding
    xy[0] = ( xy[0] - padding ) >= 0 ? xy[0] - padding : 0;
    xy[1] = ( xy[1] - padding ) >= 0 ? xy[1] - padding : 0;

    width += (padding * 2);
    height += (padding * 2);

    $(map_obj).mapSvg().setViewBox([xy[0], xy[1], width, height], true);
    $(map_obj).mapSvg().updateScale(  );

}

function map_zoom_in(map_obj, count){

    for( i=0; i<count; i++ ){

        $(map_obj).mapSvg().zoomIn();

    }

}

function map_zoom_out(map_obj, count){

    for( i=0; i<count; i++ ){

        $(map_obj).mapSvg().zoomOut();

    }

}

function load_map( map_obj )
{
    markers = new Array();

    tp = $(map_obj).attr("data-type");

    $.each(map_data[ tp ], function() {

        create_marker( this["lat"], this["lng"], this["html"], this["icon"] );

    });

    initiate_map( map_obj );

}

function create_marker( lat, lng, html, icon ){

    markers[markers.length] =
    {
        c: [lat,lng],
        popover: html,

        attrs: {
            src:  icon
        }
    };

}

function initiate_map( map_obj ){

    $(map_obj).mapSvg({

        source: '/widgets/map/other/world_with_states.svg',
        loadingText : 'Loading map...',
        colors:        {
            background: "transparent",
            base: "#FFFFFF",
            hover: "90-#fff-#000",
            stroke: "#e9e8e7",
            disabled: "#FFFFFF"
        },

        viewBox: [0, 60, 334.52056, 283.2942],
        zoom: true,
        zoomLimit: [-25,25],
        zoomButtons: {'show': true, 'location': 'left'}  ,
        tooltipsMode:    'combined',
        pan: true,
        responsive: true,
        disableAll: true,
        marks: markers
    });
}