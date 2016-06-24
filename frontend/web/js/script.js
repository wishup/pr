//add scroll class
if($('body').hasClass('layout1') || $('body').hasClass('account-dashboard')){
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if (scroll > 0 ) {
            $('body').addClass('scrolled');
        }
        else {
            $('body').removeClass('scrolled');
        }
    });
}

var long_form_errors_form='';

function elementInViewport(el) {
    var top = el.offsetTop;
    var left = el.offsetLeft;
    var width = el.offsetWidth;
    var height = el.offsetHeight;

    while(el.offsetParent) {
        el = el.offsetParent;
        top += el.offsetTop;
        left += el.offsetLeft;
    }

    return (
    top >= window.pageYOffset &&
    left >= window.pageXOffset &&
    (top + height) <= (window.pageYOffset + window.innerHeight) &&
    (left + width) <= (window.pageXOffset + window.innerWidth)
    );
}

function long_form_scroll( obj ){

    if( $(long_form_errors_form).find(".has-error").length > 0 ){

        if( !elementInViewport( $(long_form_errors_form).find(".has-error:eq(0)") ) && $(".header").length > 0 ) {

            $('html, body').scrollTop($(long_form_errors_form).find(".has-error:eq(0)").offset().top - $(".header").height() - 30);

        }

    }

}

function long_form_tooltip( obj ){

    if( $(long_form_errors_form).find(".has-error").length > 0 ){

        addTooltip($(long_form_errors_form).find("button[type='submit']"), "PLEASE CORRECT ISSUES ABOVE");

    }

}

$(window).on('load', function(){

    $("input[autocomplete='new-password']").val('');

});

$(document).ready(function(){

    $("#subscribe_form[data-open-popup='1']").on("submit", function(e){

        e.preventDefault();

        $("#studyguidesubscribe-email").val( $(this).closest("section").find("#studyguidesubscribeform-email").val() );

        openPopup( "#newsletterPopup" );

    });

    $(".resources_discount_popup").on("click", function(e){

        e.preventDefault();

        $(".resources_amazon_link").attr("href", $(this).attr("href"));

        $.magnificPopup.open({
            items: {
                src: '#discountPopup',
                type:'inline',
            },
            showCloseBtn: true,
            closeBtnInside: true
        });

       //openPopup('#discountPopup'); //{showCloseBtn: true, closeBtnInside: true}

    });

    $(".resources_dp_close").on("click", function(e){

        e.preventDefault();

        closePopup();

    });

    $(".resources_amazon_link").on("click", function(e){

        closePopup();

    });

    /** Change Host Status */
    $(".change_host_status").on("change", function(){

        status = $(this).prop("checked") ? 1 : 2;

        $.ajax({
            type:'POST',
            url: "/user/changehoststatus",
            data: {status: status},
            dataType: "json",
            success:function(data){



            },
            error: function(data){ }
        });

    });

    $("form").on("submit", function(){

        long_form_errors_form = $(this);

        setTimeout("long_form_scroll()", 300);

    });

    $("form.long_form").on("submit", function(){

        long_form_errors_form = $(this);

        setTimeout("long_form_tooltip()", 300);

    });


    /** Map Widget: Nav Select */
    var mapNav = $('#map-nav');
    if( mapNav.length > 0 ) {
        var mapNavVal = mapNav.find('.nav-value');
        var mapNavList = mapNav.find('.map-nav-list');
        var mapNavListItem = mapNavList.find('li');
        var mapNavOption = mapNav.find('.map-nav-option');
        var mapNavIcon = mapNavOption.find('.icon');

        mapNavOption.on('click', function(){
            if(mapNav.hasClass('opened')){
                mapNavClose();
            } else {
                mapNavOpen();
            }
        });

        mapNavListItem.on('click', function(){
            var value = $(this).data('value');
            var html = $(this).html();

            map_navigate_to( value );

            mapNavVal.empty().html(html).attr('data-value', value);
            mapNavClose();
        });

        $(document).mouseup(function (e) {
            if (!mapNav.is(e.target) && mapNav.has(e.target).length === 0) {
                mapNavClose();
            }
        });

        var mapNavClose = function(){
            mapNav.removeClass('opened');
            mapNavList.slideUp(150);
            mapNavIcon.removeClass('icon-arrow-up').addClass('icon-arrow-down');
        }

        var mapNavOpen = function(){
            mapNav.addClass('opened');
            mapNavList.slideDown(150);
            mapNavIcon.removeClass('icon-arrow-down').addClass('icon-arrow-up');
        }
    }


    /** Price select (donation payment page) */
    var priceSelect = $('.price-select');
    if( priceSelect.length > 0 ){
        var select = priceSelect.find('select');
        var selectVal = priceSelect.find('.amount');
        var selectCur = priceSelect.find('.sign');

        select.trigger('change');

        select.on('change', function(){
            if($(this).val() == "999999"){
                selectCur.empty();
                selectVal.empty().html('Other');
            } else {
                selectCur.empty().html('$');
                selectVal.empty().html( $(this).val() );
            }

        });
        select.trigger('change');
    }

    /** FM Dashboard: Contestants */
    $('.fm-contestant-parent-toggle').on('click', function(){
        var wrap = $(this).closest('.fm-contestant-box');
        var btnText = $(this).find('span');

        if( wrap.hasClass('opened') ){
            $(this).find('.icon').removeClass('icon-arrow-up').addClass('icon-arrow-down');
            wrap.find('.fm-contestant-parent').slideUp(500);
            wrap.removeClass('opened');
            btnText.empty().html( btnText.data('txt-more') );
        } else {
            $(this).find('.icon').removeClass('icon-arrow-down').addClass('icon-arrow-up');
            wrap.find('.fm-contestant-parent').slideDown(500);
            wrap.addClass('opened');
            btnText.empty().html( btnText.data('txt-less') );
        }
    });

    $(".donation-btn-group input:checkbox").change(function () {
        $(".donation-btn-group input:checkbox").prop('checked', false);
        $(this).prop('checked', true);
    });

    //if($(".price-select .amount").length > 0) {
    //    $(".price-select .amount").html($("#familypayment-amount").val());
    //}

    $("#familypayment-amount").on("change", function(){

        check_donation_amount();

    });

    function check_donation_amount(){
        if( $("#familypayment-amount").val() == '999999' ){

            $("#familypayment-amount_other").show();

        } else {

            $("#familypayment-amount_other").hide();

        }
    }

    check_donation_amount();




    $(".find_hosts").on("click", function(e){

        e.preventDefault();
        update_hosts_map(  );

    });

    $(".hosts_zipcode").on("keyup", function(e){

        e.preventDefault();
        if(e.keyCode == 13 ) update_hosts_map(  );

    });

    $(".map_hosts_count").on("change", function(e){

        e.preventDefault();
        update_hosts_map(  );

    });

    $(".openDisconnectPopup").on("click", function(e){

        e.preventDefault();

        openPopup("#disconnectPopup");

    });

    $(".closeDisconnectPopup").on("click", function(e){

        e.preventDefault();

        closePopup("#disconnectPopup");

    });

    $(document).on("click", ".join_host_to_family", function(e){

        e.preventDefault();

        host_id = $(this).attr("data-host-id");

        if( logged_in_host == 1 ) {

            if( !$(this).hasClass("cant_join_another_host") ){

                window.location = '/user/connecttohost/' + host_id;

            } else {
				$.magnificPopup.open({
				  items: {
					src: '<div class="get-started-popup popup-block popup-has-close main-box text-center popup-step3 getstarted-popup">'+
						'<h2 class="title -md text-featured">You are already the best choice for host. No need to change. :)</h2></div>',
					type: 'inline'
				  }
				});
            }

        } else {

            window.location = '/user/connecthostaftereg?host_id='+host_id;

        }

    });

    function update_hosts_map(){

        zip = $(".hosts_zipcode").val();

        var mygc = new google.maps.Geocoder();
        mygc.geocode({
            'address': zip
        }, function (results, status) {
            if (status == "OK") {
                mylng = results[0].geometry.location.lng();
                mylat = results[0].geometry.location.lat();

                getnearesthosts(mylat, mylng);
            } else {
                return false;
            }
        });



    }

    function getnearesthosts(mylat, mylng){

        $.ajax({
            type:'POST',
            url: "/user/gethostsmap",
            data: {lat: mylat, lng:mylng},
            dataType: "json",
            success:function(data){

                id = $(".map_container").attr("id");

                map_data[id] = new Array();

                map_data[id] = data;

                update_hosts_map_view();

            },
            error: function(data){ }
        });

    }

    var current_map_data = '';

    function update_hosts_map_view(){

        zip = $(".hosts_zipcode").val();
        count = $(".map_hosts_count").val();

        if( zip.length != 5 ){
            alert("Zip code length must be at least 5 symbols.");
            return false;
        }

        id = $(".map_container").attr("id");

        var origin = zip;

        var dests = new Array();

        j=0;

        for( var i in map_data[ id ] ){

            dests[ j ] = new google.maps.LatLng(map_data[ id ][i]['lat'], map_data[ id ][i]['lng']);

            j++;

        }

        var service = new google.maps.DistanceMatrixService();

        service.getDistanceMatrix(
            {
                origins: [origin],
                destinations: dests,
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.IMPERIAL,
            }, function (response, status) {

                j = 0;

                for( var i in map_data[ id ] ){

                    if( response.rows[0].elements[j].status == 'OK' ) {

                        map_data[id][i]['distance'] = response.rows[0].elements[j].distance.value;
                        map_data[id][i]['distance_text'] = response.rows[0].elements[j].distance.text;

                    } else {

                        map_data[id][i]['distance'] = -1;
                        map_data[id][i]['distance_text'] = "";

                    }

                    j++;

                }

                data = map_data[id];

                data.sort(function(a, b){
                    var a1= a.distance, b1= b.distance;
                    if(a1== b1) return 0;
                    return a1> b1? 1: -1;
                });

                $(".map_hosts_list_container").find(".map_hosts_list").html('');

                cnt = 0;

                host_html = '<div class="row">';

                map_markers = new Array();

                current_map_data = data;

                for( var i in data ){

                    if( data[i]['distance'] == -1 ) continue;

                    map_markers[i] = [ data[i]["lat"], data[i]["lng"] ];

                    host_html += '<div class="col-sm-6 map-host">';
                    host_html += '<h4><strong>'+ data[i]['host'] +'</strong><span>('+data[i]['distance_text']+'):</span></h4>';
                    host_html += '<p>';
                    if( data[i]['location_name'] != '' ) host_html += '<strong>Location Name:</strong> '+ data[i]['location_name'] +'<br/>';
                    host_html += '<strong>Host:</strong> '+ data[i]['host'] +'<br/>';
                    host_html += '<strong>Location:</strong> '+ data[i]['location'] +'<br/>';
                    host_html += '<strong>Email:</strong> <a href="mailto:'+ data[i]['email'] +'">'+ data[i]['email'] +'</a>';
                    host_html += '</p>';
                    host_html += '<div class="btn-list">';
                    if( data[i]['canjoin'] == 1 && data[i]['join_enable'] == 1 && disable_join == 0 ) host_html += '<a href="#" class="btn btn-success join_host_to_family" data-host-id="'+data[i]['host_id']+'">Join</a>';
                    host_html += '<button class="btn btn-brd-success host_show_on_map" data-lat="'+data[i]['lat']+'" data-lng="'+data[i]['lng']+'" data-index="'+i+'" type="button">Show on Map</button>';
                    host_html += '</div>';
                    host_html += '</div>';

                    cnt ++;

                    if( cnt >= count ) break;

                    if( cnt % 2 == 0 )
                        host_html += '</div><div class="row">';

                }

                host_html += '</div>';

                map_viewbox($(".map_container"), map_markers );

                $(".map_hosts_list_container").find(".map_hosts_list").append( host_html );

                $(".map_hosts_list_container").show();

                addTooltip( ".find_hosts", "Results Displayed below map" );

                $('html, body').animate({
                    scrollTop: $(".map_hosts_list_container").offset().top
                }, 1000);

            });


    }

    $(document).on("click", ".host_show_on_map", function(e){

        latlng = new Array();

        latlng[0] = new Array();

        latlng[0][0] = $(this).attr("data-lat");
        latlng[0][1] = $(this).attr("data-lng");

        map_viewbox($(".map_container"), latlng);

        $(".map_container").mapSvg().showPopover2('',current_map_data[$(this).attr('data-index')]['html'], [$(".map_container").offset().left + parseInt( $(".map_container").width()/2 ), $(".map_container").offset().top + parseInt( $(".map_container").height()/2 ) - 30])

        $('html, body').animate({
            scrollTop: $(".map_start_div").offset().top
        }, 800);

    });


    $(".ssn_mask").mask("999-99-9999",{placeholder:"xxx-xx-xxxx"});
    $(".phone_mask").mask("(999) 999-9999",{placeholder:"(xxx) xxx-xxxx"});

    $(".mm_yy_mask").mask("99/99",{placeholder:"mm/yy"});
    $(".date_mask").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
    $(document).on("change",'.date_mask', function(){
        if( !isValidDate( $(this).val() ) ){
            addError(this, "Please enter valid mm/dd/yyyy date.", ".form-group");
        } else {
            removeError(this);
        }
    });

    //search button control
    if($('.sr-btn').length>0){
        $('.sr-btn').click(function(){
            $('.sr-box').toggleClass('active');
            return false;
        });
    }
   //toggle menu(mobile)
    $('.menu-btn').click(function () {
		$('body').toggleClass('menu-open');
        return false;
    });


    //make view-mode controls readonly
    if($('.view-mode').length) {
        $('.view-mode').find('.form-group').not('.stay-edit').find('input[class="form-control"]').attr('readonly', true);
    }
    //toggle mode
    $('body').on('click', '.toggle-mode', function () {
        //custom select

        toggleMode($(this));
        //$('.custom-select-state').customSelect();
        return false;
    });
    //custom select
    if($('.custom-select').length>0){
        $('.custom-select').customSelect();
    }

    //disable pdf, xls, pring
  /*  $('.doc-controls a').click(function(){
        return false;
    });*/
    if($('.icon-xls').length>0) {
        if (window.location.hash) {
            $('a[href="' + window.location.hash + '"]').parent().addClass('active');
            $(window.location.hash).addClass('active');
            $('.icon-xls').data('params').type = window.location.hash.substring(1);
            $('.icon-pdf').data('params').type = window.location.hash.substring(1);
        } else {
            $('a[href="#glossary"]').parent().addClass('active');
            $("#glossary").addClass('active');
            $('.icon-xls').data('params').type = 'glossary';
            $('.icon-pdf').data('params').type = 'glossary';
        }
    }
    $('.primary-tabs .tab-nav li a').click(function(){
        var hash = $(this).attr('href');
        window.location.hash = hash;
        $('.icon-xls').data('params').type = hash.substring(1);
        $('.icon-pdf').data('params').type = hash.substring(1);
        $(window.location.hash).parent().addClass('active');
    })
    $('.icon-print').click(function(){
        window.print();
    })
    //magnificpopup with form
    $('.popup-with-form').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#name',

        showCloseBtn: true,
        closeBtnInside: true,

        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {
                if($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#name';
                }
            }
        }
    });

    $(".get_started_studyguide_submit").on("click", function(){

        $("#studyguidesubscribe-email").val( $(this).closest("section").find("#studyguidesubscribeform-email").val() );

    });

    $("#study_guide_get_started_frm").on("submit", function(e){

        e.preventDefault();

        $("#studyguidesubscribe-email").val( $(this).closest("section").find("#exampleInputEmail3").val() );

        openPopup('#getstartedPopup');

    });

    $("#getstartedsubsuccessclose").on("click", function(e){

        e.preventDefault();

        $('#getstartedPopupSuccess').magnificPopup('close');

    });


    var markup = $('.get-started-popup-wrap').html();
    $('.get-started-popup').magnificPopup({type:'inline', items: {src: markup},});
    //bootstrap tabs
    //$('#myTabs a').click(function (e) {
    //    e.preventDefault();
    //    $(this).tab('show');
    //});
    //collapse
    // Listen for click on toggle checkbox
    $('#showAllAnswers input[type="checkbox"]').click(function(event) {
        if(this.checked) {
            $('.faq-list .collapse').collapse('show');
        }else{
            $('.faq-list .collapse').collapse('hide');
        }
    });

    $(".get_started_form_btn").on("click", function(e){

        e.preventDefault();

        get_started();

    });

    $(".get_started_form_btn").closest("form").on("submit", function(e){

        e.preventDefault();

        get_started();

    });

    function get_started(){

        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        email = $(".get_started_email").val();

        $.post( "/user/login", { email: email, user_type:"host", _csrf: csrfToken, get_started: 1 }).done(function( data ) {

            if( data == 1 ){  // Successfull registration

                $(".get_started_email").val('');
                var markup = $('.get-started-popup-wrap').html();
                $('.get-started-popup-wrap').magnificPopup({
                    items: {
                        src: markup,
                        type: 'inline'
                    }
                }).magnificPopup('open');

                removeError(".get_started_email");

            } else { // Error while registered

                addError(".get_started_email", data);

            }

        });

    }

    $(".get_started_popup_btn").on("click", function(e){

        e.preventDefault();

        get_started_popup();

    });

    $(".get_started_popup_btn").closest("form").on("submit", function(e){

        e.preventDefault();

        get_started_popup();

    });

    function get_started_popup(){

        var csrfToken = $('meta[name="csrf-token"]').attr("content");


        email = $(".get_started_popup_email").val();

        if($("input[name=user_type]").length > 0){
            var user_type = $("input[name=user_type]:checked").val();
        } else{
            var user_type = "host";
        }

        if(user_type == 'host'){

            $.post( "/user/login", { email: email, user_type: user_type, _csrf: csrfToken, get_started: 1 }).done(function( data ) {

                $("#signinBlock").css("z-index", "1000");

                if( data == 1 ){  // Successfull registration

                    $(".get_started_popup_email").val('');
                    $('.get-started-popup').magnificPopup('open');

                    removeError(".get_started_popup_email");

                } else {

                    if( data == 2 ){  // Successfull registration

                        window.location = '/user/renewhost/';

                    } else { // Error while registered

                        addError(".get_started_popup_email", data);

                    }

                }

            });
        } else {
            var family_reg_url = $("#family_reg_url").val();
            window.location.href = family_reg_url + '?email='+email;
            return true;
        }

    }

    $(".get_started_family_popup_btn").on("click", function(e){

        e.preventDefault();

        get_started_family_popup();

    });

    $(".get_started_family_popup_btn").closest("form").on("submit", function(e){

        e.preventDefault();

        get_started_family_popup();

    });

    function get_started_family_popup(){

        var csrfToken = $('meta[name="csrf-token"]').attr("content");


        email = $(".get_started_family_popup_email").val();

        $.post( "/user/login", { email: email, user_type:"family", _csrf: csrfToken, get_started: 1 }).done(function( data ) {

            $("#signinBlock").css("z-index", "1000");

            if( data == 1 ){  // Successfull registration

                $(".get_started_family_popup_email").val('');
                $('.get-started-popup').magnificPopup('open');

                removeError(".get_started_family_popup_email");

            } else { // Error while registered

                addError(".get_started_family_popup_email", data);

            }

        });

    }

    $(".login-form").on("submit", function(e){

        e.preventDefault();

        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        email = $(".login_inp_email").val();
        password = $(".login_inp_password").val();

        $.post( "/user/login", { email: email, password: password, _csrf: csrfToken, auth: 1 }).done(function( data ) {

            if( data == 1 ){  // Successfull registration

                window.location = '/dashboard';

            } else { // Error while registered

                addError(".login_inp_email", data);
                addError(".login_inp_password", '');

            }

        });

    });

    $(".registration-block").find(":input").on("focus", function(){

        removeError( $(this) );

    });

    //simple tabs
    /*if($('.simple-tabs').length>0){
        $('.tab-nav a').click(function(){
            var currentItem = $(this).attr('href');
            $(this).closest('.simple-tabs').find('.tab-pane').removeClass('active').hide(400);
            $(this).closest('.simple-tabs').find(currentItem).addClass('active').show(400);
        });
    }*/

    $(".renew_host_form").on("submit", function(){

        success = 1;

        for( i=1; i<=1; i++ ){

            if( !$("#agreement_"+i).prop("checked") ){

                $("#agreement_"+i).closest("a").addClass("has-error");

                success = 0;

            } else {

                $("#agreement_"+i).closest("a").removeClass("has-error");

            }

        }

        if( success == 0 ) return false;

    });

    $(".family_registration_form").on("submit", function(){

        success = 1;

        if( !$("#agreement_1").prop("checked") ){

            $("#agreement_1").closest("a").addClass("has-error");

            success = 0;

        } else {

            $("#agreement_1").closest("a").removeClass("has-error");

        }

        if( success == 0 ) return false;

    });

    $(".reset_renew_host_info").on("click", function(e){

        e.preventDefault();

        $(".renew_host_info").find(":input").val(function() {
            if( !$(this).hasClass("custom-select-state") ) {
                return this.defaultValue;
            } else {
                return $(this).attr("data-default-val");
            }
        });

        toggleMode($(".renew_host_form").find(".toggle-mode"));

        $(".renew_host_user_name").html( $("#userinfo-first_name").val() + " " + $("#userinfo-last_name").val() );
        $(".renew_host_state_view").html( $("#userinfo-state").find("option:selected").val() ? $("#userinfo-state").find("option:selected").html() : '&nbsp;' );

    });

    $(".reset_contestants").on("click", function(e){

        $(this).closest("form")[0].reset();
    });

    $(".reset_renew_host_info2").on("click", function(e){

        e.preventDefault();

        $(".renew_host_info2").find(":input").val(function() {
            if( !$(this).hasClass("custom-select-state")  && !$(this).hasClass("custom-select-whost") ) {
                return this.defaultValue;
            } else {
                return $(this).attr("data-default-val");
            }
        });

        $(".renew_host_state_view2").html( $("#usershosts-summer_event_state").find("option:selected").val() ? $("#usershosts-summer_event_state").find("option:selected").html() : '&nbsp;' );
        $(".renew_host_whost_view").html( $("#usershosts-willing_to_host").find("option:selected").val() ? $("#usershosts-willing_to_host").find("option:selected").html() : '&nbsp;' );

    });

    $(".edit_contact_info").on("click", function(e){

        e.preventDefault();

        $(".contact_info_edit_section").removeClass("view-mode").addClass("edit-mode");
        $(".contact_info_edit_section").find('input[class="form-control"]').removeAttr('readonly');

        window.location.hash = '';
        window.location.hash = 'contact_info';

    });


    $("#userinfo-state").on("change", function(){

        $(".renew_host_state_view").html( $("#userinfo-state").find("option:selected").val() ? $("#userinfo-state").find("option:selected").html() : '&nbsp;' );

    });

    $("#usershosts-summer_event_state").on("change", function(){

        $(".renew_host_state_view2").html( $("#usershosts-summer_event_state").find("option:selected").val() ? $("#usershosts-summer_event_state").find("option:selected").html() : '&nbsp;' );

    });

    $("#usershosts-willing_to_host").on("change", function(){

        $(".renew_host_whost_view").html( $("#usershosts-willing_to_host").find("option:selected").val() ? $("#usershosts-willing_to_host").find("option:selected").html() : '&nbsp;' );

    });

    $("#userinfo-first_name, #userinfo-last_name").on("change", function(){

        $(".renew_host_user_name").html( $("#userinfo-first_name").val() + " " + $("#userinfo-last_name").val() );

    });

    $(".agreement_popup_check").on("change", function(){

        if( !$(this).prop("checked") )
            $("#" + $(this).closest(".agreement-popup").find(".agreement_popup_check").attr("data-child-id")).prop("checked", false);

    });

    $(".agreement_name").on("change", function(){

        if( $(this).val() == '' )
            $("#" + $(this).closest(".agreement-popup").find(".agreement_popup_check").attr("data-child-id")).prop("checked", false);

    });

    $(".agreement_button").on("click", function(){

        if( $(this).closest(".agreement-popup").find(".agreement_popup_check").prop("checked") ){

            $(this).closest(".agreement-popup").find(".agreement_popup_check").parent().find("span").css("border", "none");

            if( $(this).closest(".agreement-popup").find(".agreement_name").val()!='' ) {

                $(this).closest(".agreement-popup").find(".agreement_name").closest(".form-group").removeClass("has-error");

                $("#" + $(this).closest(".agreement-popup").find(".agreement_popup_check").attr("data-child-id")).prop("checked", true);

                closePopup();

            } else {

                $(this).closest(".agreement-popup").find(".agreement_name").closest(".form-group").addClass("has-error");

            }

        } else {

            $(this).closest(".agreement-popup").find(".agreement_popup_check").parent().find("span").css("border", "solid 1px #ff0000");

        }

    });

    $(document).on("click", ".host_renew_restore_fb", function(e){

        e.preventDefault();

        $(".fb_error").html("");
        $(".fb_error").hide();

        $(".fbkey").remove();

        $(".fb-login").show();
        if($('#users-password').length > 0) {
            $('#users-password').attr("placeholder", "New Password");
            $('#users-password').closest('.pass-wrap').removeClass("optional-fields");
        }
        logged_in_social = false;
        $(".fb-account").hide();
        $(".create-password").show(400);

    });

    //new old bibblebee
    /*md slider*/
    if($('#md-slider-block').length>0){
        var md_slider_options = {
            //"fullwidth": true,
            "transitionsSpeed": 800,
            "width": "1518",
            "height": "730",
            "enableDrag": true,
            "responsive": true,
            "pauseOnHover": false,
            "loop": true,
            "showLoading": false,
            //"loadingPosition": "bottom",
            //"showArrow": true,
            "showBullet": true,
            "posBullet": "2",
            "showThumb": false,
            "posThumb": "1",
            "slideShowDelay": "4000",
            "slideShow": true,
            "styleBorder": "0",
            "styleShadow": "0",
            //"videoBox": true
        }
        $('#md-slider-block').mdSlider(md_slider_options);
    }


    //datepicker
    if($( ".datepicker").length>0){
        $( ".datepicker").each(function(){
            $(this).datepicker({
                dateFormat: 'mm/dd/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0"
            });
        });
    }

    $(".avatar_change_image").on("click", function(e){

        e.preventDefault();
        elemId = 'avatar_image';

        var elem = document.getElementById(elemId);
        if(elem && document.createEvent) {
            var evt = document.createEvent("MouseEvents");
            evt.initEvent("click", true, false);
            elem.dispatchEvent(evt);
        }

    });



    //image crop
    if($("#container_image").length) {
        $("#container_image").PictureCut({
            InputOfImageDirectory: "image",
            PluginFolderOnServer: "/jquery.picture.cut/",
            FolderOnServer: "/uploads/",
            EnableCrop: true,
            CropWindowStyle: "Bootstrap",
            CropOrientation: false,
            CropModes: {
                widescreen: false,
                letterbox: true,
                free: false
            }
        });
    }

    $("#avatar_image").on("change", function(){

        $("#avatar_change_form").submit();

    });
   /* $('#spinner').ajaxStart(function () {
        $(this).fadeIn('fast');
    }).ajaxStop(function () {
        $(this).stop().fadeOut('fast');
    });*/
    $('#avatar_change_form').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $('#spinner').fadeIn('fast');



        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if( data != '' ){
                    $(".avatar_change_image").attr("src", data);

                    removeTooltip(".avatar_chng_img");
                } else {
                    addTooltip( ".avatar_chng_img", "Maximum upload size: 5MB Valid extensions: .jpg, .jpeg, .png, .gif" );

                    console.log("error");
                    console.log(data);
                }
                $('#spinner').fadeOut('fast');
            },
            error: function(data){

                addTooltip( ".avatar_chng_img", "Maximum upload size: 5MB Valid extensions: .jpg, .jpeg, .png, .gif" );

                console.log("error");
                console.log(data);
            }
        });
    }));

    $(".reload_captcha").on("click", function(e){

        e.preventDefault();

        $.ajax({
            type:'POST',
            url: "/site/captcha?refresh=1",
            dataType: "json",
            success:function(data){

                $(".captcha-obj").attr("src", data.url);

            },
            error: function(data){ }
        });

    });

    $(".close_admin_message").on("click", function(e){

        e.preventDefault();

        msg_id = $(this).attr("data-msg-id");
        csrfToken = $('meta[name="csrf-token"]').attr("content");

        $(this).closest(".notice-box").remove();

        $.ajax({
            type:'POST',
            url: "",
            data: {close_admin_msg: msg_id, _csrf: csrfToken },
            dataType: "json",
            success:function(data){

                $(".captcha-obj").attr("src", data.url);

            },
            error: function(data){ }
        });

    });

    $(".dashboard_birthdate").on("change", function(){

        dashboardAge();

    });

    dashboardAge();

    function dashboardAge(){

        age = getAge( $(".dashboard_birthdate").val() );

        if( age > 0 ){
            $(".dashboard_age_box").closest('.form-group').addClass('with-info');
        }
        else {
            $(".dashboard_age_box").closest('.form-group').removeClass('with-info');
        }


        $(".dashboard_age").html( age );

        $(".dashboard_age_box").find("input").prop("checked", false);

    }



    $(".hear_about_us_select").on("change", function(){

        check_hear_about_us();

    });

    function check_hear_about_us(){
        if( $(".hear_about_us_select").val() == '999999' ){

            $(".hear_about_us_other").show();

        } else {

            $(".hear_about_us_other").hide();

        }
    }

    check_hear_about_us();

    $(".date_mask_child").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});

});

//functions
function toggleMode( button ) {
    var mode_section = button.closest('.mode-section');
    if(mode_section.hasClass('view-mode')){
        var collapseButton = button.closest('.mode-section').find('.collapse-btn.collapsed');
        if(collapseButton.length>0){
            collapseButton.trigger('click');
            $('html, body').animate({
                scrollTop: collapseButton.offset().top
            }, 600);
        }
        mode_section.removeClass('view-mode').addClass('edit-mode');
        mode_section.find('input[class="form-control"]').removeAttr('readonly');
    }else{
        mode_section.removeClass('edit-mode').addClass('view-mode');
        mode_section.find('input[class="form-control"]').attr('readonly',true);


    }
}

function toggleModeClose( button ) {
    var mode_section = button.closest('.mode-section');
    mode_section.removeClass('edit-mode').addClass('view-mode');
    mode_section.find('input[class="form-control"]').attr('readonly',true);
}

//collapse
/*$(".collapse-btn.collapsed").click(function () { console.log(222);
    var myEl = $(this);
    $('html, body').animate({
        scrollTop: myEl.offset().top
    }, 500);
});*/

function closePopup() {
    $.magnificPopup.close();
}

var logged_in_social = false;

function renew_host_fb_login( profile_info ){

    if( profile_info["status"] == 'success' ) {

        if ($("#userinfo-first_name").val() == '') $("#userinfo-first_name").val(profile_info["first_name"]);
        if ($("#userinfo-last_name").val() == '') $("#userinfo-last_name").val(profile_info["last_name"]);

        $(".renew_host_user_name").html( $("#userinfo-first_name").val() + " " + $("#userinfo-last_name").val() );


        $(".fb-account").find(".media-object").attr("src", profile_info["picture"]);
        $(".fb-account").find(".fb_user_name").html( profile_info["first_name"] + ' ' + profile_info["last_name"] );

        $(".fb-account").append( '<input type="hidden" name="fbkey" value="' + profile_info["fbkey"] + '" class="fbkey">' );

        $(".fb-login").hide();
        $(".fb-account").show();
        if($('#users-password').length > 0) {
            $('#users-password').attr("placeholder", "New Password (Optional)");
            $('#users-password').closest('.pass-wrap').addClass("optional-fields");
        }

        $(".fb_error").html("");
        $(".fb_error").hide();

        logged_in_social = true;

    } else {

        $(".fb_error").html("Facebook account already connected to an account. Please try another one.");
        $(".fb_error").show();

        $(".fbkey").remove();

        $(".fb-login").show();
        $(".fb-account").hide();

        logged_in_social = false;
    }

}

function renew_host_g_login( profile_info ){

    var is_family_direct = ($("#family_direct_reg").length > 0);

    if( profile_info["status"] == 'success' && (!is_family_direct || profile_info['email_is_used'] == 0 )) {

        if ($("#userinfo-first_name").val() == '') $("#userinfo-first_name").val(profile_info["first_name"]);
        if ($("#userinfo-last_name").val() == '') $("#userinfo-last_name").val(profile_info["last_name"]);

        if ($("#users-email").length > 0) $("#users-email").val(profile_info["email"]);
        if ($("#users-email_confirm").length > 0) $("#users-email_confirm").val(profile_info["email"]);

        $(".renew_host_user_name").html( $("#userinfo-first_name").val() + " " + $("#userinfo-last_name").val() );


        $(".fb-account").find(".media-object").attr("src", profile_info["picture"]);
        $(".fb-account").find(".fb_user_name").html( profile_info["first_name"] + ' ' + profile_info["last_name"] );

        $(".fb-account").append( '<input type="hidden" name="gkey" value="' + profile_info["fbkey"] + '" class="fbkey">' );
        $(".fb-account").append( '<input type="hidden" name="gavatar" value="' + encodeURIComponent(profile_info["picture"]) + '" class="fbavatar">' );

        $(".fb-login").hide();
        $(".fb-account").show();
        if($('#users-password').length > 0) {
            $('#users-password').attr("placeholder", "New Password (Optional)");
            $('#users-password').closest('.pass-wrap').addClass("optional-fields");
        }

        $(".fb_error").html("");
        $(".fb_error").hide();

        $(".create-password").hide();

        logged_in_social = true;



    } else {
        if(profile_info['email_is_used'] == 0){
            $(".fb_error").html("Google account already connected to an account. Please try another one.");

        } else {
            $(".fb_error").html("You have alredy have an account connected with this email.");

        }

        $(".fb_error").show();

        $(".fbkey").remove();
        $(".fbavatar").remove();

        $(".fb-login").show();
        $(".fb-account").hide();

        logged_in_social = false;


    }

}

function getstarted_subscribe_callback(data){

    $("#studyguide_subscribe_form")[0].reset();
    $("#exampleInputEmail3").val("");

    $('#getstartedPopup').magnificPopup('close');
    openPopup('#getstartedPopupSuccess');

}

function subscribe_callback(data){

    if( $("#subscribe_form2").length > 0 ) $("#subscribe_form2")[0].reset();
    $("#studyguidesubscribeform-email").val("");

    $('#newsletterPopup').magnificPopup('close');
    openPopup('#newsletterPopupSuccess');

}


function subscribe_callback2(data){

    $("#subscribe_form2")[0].reset();
    $("#studyguidesubscribeform-email").val("");

    $('#newsletterPopup').magnificPopup('close');
    openPopup('#newsletterPopupSuccess');

}

function openPopup(popupObj, popup_type ){
    if ($(popupObj).length) {
        $.magnificPopup.open({
            items: {
                src: popupObj
            },
            type: popup_type
        });
    }
}

function dashboard_contact_save_callback(data){

    toggleModeClose($("#dashboard_contact_info_form").find(".toggle-mode"));

}

function dashboard_contestant_save_callback(data){

    toggleModeClose($("#dashboard_contestant_info_form_"+data["contestant_id"]).find(".toggle-mode"));

    $("#dashboard_contestant_info_form_"+data["contestant_id"]).find(".contestant-view-name").html( data["name"] );
    $("#dashboard_contestant_info_form_"+data["contestant_id"]).find(".contestant-view-dob").html( data["dob"] );
    $("#dashboard_contestant_info_form_"+data["contestant_id"]).find(".contestant-view-gender").html( data["gender"] );
    $("#dashboard_contestant_info_form_"+data["contestant_id"]).find(".contestant-view-version").html( data["version"] );

    if( data["flashmessage"] ){

        addTooltip($("#dashboard_contestant_info_form_"+data["contestant_id"]).find(".contestant-view-name") , data["flashmessage"] );

    }

}

function dashboard_host_save_callback(data){

    toggleModeClose($("#dashboard_host_info_form").find(".toggle-mode"));

}

function dashboard_contestants_save_callback(data){

    toggleModeClose($("#dashboard_contestants_form").find(".toggle-mode"));

}

function dashboard_bgcheck_save_callback(data){

    $(".field-userinfo-ssn").html( '<span class="help-block">'+$(".field-userinfo-ssn").find("input").val()+'</span>' );
    $(".field-userinfo-date_of_birth").html( '<span class="help-block">'+$(".field-userinfo-date_of_birth").find("input").val()+'</span>' );
    $(".submit_dashboard_bgcheck").remove();

    $(".checked_profile_msg").show();
    $(".unchecked-profile").hide();

}

function forgot_pass_callback(data){

    openPopup('#restorePopup');

}

function addTooltip( obj, msg ){

    $(obj).addClass("has-error tipsy tipsy--n");
    $(obj).attr("data-tipsy", msg);

}

function removeTooltip( obj, msg ){

    $(obj).removeClass("has-error tipsy tipsy--n");
    $(obj).attr("data-tipsy", '');

}

function getAge(dateString, compare_to) {
    compare_to = compare_to || false;
    if(compare_to){
        var today = new Date(compare_to);
    } else {
        var today = new Date();
    }

    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function isValidDate(dateString) {
    var regEx = /^(\d{2})\/(\d{2})\/(\d{4})$/;
    var dtArray = dateString.match(regEx);
    if (dtArray == null)
        return false;

    dtMonth = dtArray[1];
    dtDay = dtArray[2];
    dtYear = dtArray[3];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay > 31)
        return false;


    return true;

}

function addError( selector, data , error_selector){
    error_selector = error_selector || "div";

    obj = $(selector).closest(error_selector);

    obj.addClass("has-error");

    if( obj.find(".help-block").length == 0 )
        obj.append('<div class="help-block"></div>');

    if( data != '' )
        obj.find(".help-block").html(data);

    //if( data != '' ) {
    //    obj.addClass("tipsy");
    //    obj.addClass("tipsy--n");
    //    obj.attr("data-tipsy", data+"<a href=''>aaa</a>");
    //}

}

function removeError( selector, error_selector ){
    error_selector = error_selector || 'div';
    obj = $(selector).closest(error_selector);

    obj.removeClass("has-error");

    if( obj.find(".help-block").length > 0 )
        obj.find(".help-block").html("");

    //obj.removeClass("tipsy");
    //obj.removeClass("tipsy--n");
    //obj.attr("data-tipsy", "");

}