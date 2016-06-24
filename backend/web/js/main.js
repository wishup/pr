$(document).ready(function(){

    $(".replace_file").on("click", function(){

        $("#replace_file_id").val( $(this).attr("data-file-id") );

    });

    $(".switch_resource").on("switchChange.bootstrapSwitch", function(){

        if( $(this).prop("checked") ){
            $(".url_row").hide();
            $(".file_row").show();
        } else {
            $(".url_row").show();
            $(".file_row").hide();
        }

    });

    $(".filter_model_dropdown").find(":input").prop("disabled", true);

    $(".tab_errors").on("submit", function(){

        $("a[data-toggle='tab']").css("color", "#557386");

        $.each( $(this).find(".has-error"), function(){

            id = $(this).closest(".tab-pane").attr("id");

            $("a[href='#"+id+"']").css("color", "#ff0000");

        } );

    });


    $(".user_change_pass_enable").on("click", function(){

        $(".user_change_pass_inp").show();
        $(".user_change_pass_inp input").prop("disabled", false);
        $(".user_change_pass_inp input").val("");
        $(this).hide();

    });

    $(".bulk_action_input").on("change", function(){

        if( confirm("Are you sure?") ){

            $(this).closest("form").attr("method", "post");

            $(this).closest("form").submit();

        }

    });

    /** Admin: Users Notes */
    var usersNotesWrap = $('.users-notes-wrap');
    $(document).mouseup(function (e) {
        if (!usersNotesWrap.is(e.target) && usersNotesWrap.has(e.target).length === 0) {
            hideUserNotes();
        }
    });

    $('.note-create').on('click', function(){
        hideUserNotes();

        var noteCreateBox =  $(this).closest('.users-notes-wrap').find('.note-create-box');
        noteCreateBox.fadeIn(500);

        return false;
    });

    $('.note-save').on('click', function(){
        var noteViewBox = $(this).closest('.users-notes-wrap').find('.note-view-box');
        var noteCreateBox =  $(this).closest('.users-notes-wrap').find('.note-create-box');

        var user_id = $(this).data('id');
        var author_id = $(this).data('author');
        var reload = $(this).data('reload');
        var text = $(this).closest('.note-create-box').find('textarea').val();
        var th = this;
        $.ajax({
            type: "POST",
            url: '/backend/users/addnote',
            data: {user_id: user_id, author_id:author_id, text:text},
            dataType: "json",
            success: function(data){
                if(!$.isEmptyObject(data)) {
                    if(reload){
                        location.reload();
                    }
                    $(th).closest('.users-notes-wrap').find('.note-text').html(data.text);
                    $(th).closest('.users-notes-wrap').find('.note-autor').html(data.author);
                    $(th).closest('.users-notes-wrap').find('.note-date').html(data.date);
                    $(th).closest('.users-notes-wrap').find("input[type=text], textarea").val("");
                    var notes_cuount =$(th).closest('.users-notes-wrap').find('.notes_count').html();
                    notes_cuount++;
                    $(th).closest('.users-notes-wrap').find('.notes_count').html(notes_cuount);
                    if ($(th).parents('.users-notes-wrap').find('.note-view-main').hasClass('hidden')) {
                        $(th).parents('.users-notes-wrap').find('.note-view-main').removeClass('hidden');
                        $(th).parents('.users-notes-wrap').find('.note-create-main').addClass('hidden');
                    }
                    noteCreateBox.hide();
                    noteViewBox.fadeIn(500);
                }
            }

        });

        return false;
    });

    $('.note-view').on('click', function(){
        hideUserNotes();

        var noteViewBox = $(this).closest('.users-notes-wrap').find('.note-view-box');
        noteViewBox.fadeIn(500);

        return false;
    });

    function hideUserNotes(){
        $('.note-create-box').fadeOut(500);
        $('.note-view-box').fadeOut(500);
    }

    /** Admin: CS statuses */
    var cs_status_url = "/backend/users/updatecs/";

    var csUsersTable = $('.table-bordered-users');
    if(csUsersTable.length > 0) {
        var csUsersTableTd = csUsersTable.find('.cs-status-checkbox-wrap');
        var csUsersStatusList = csUsersTable.find('.cs-status-checkbox-list');

        csUsersTableTd.on('click', function (e) {
            if (!$(e.target).hasClass("cs-status-checkbox") && !$(e.target).is(":checkbox")) {
                csUsersStatusList.removeClass('active');
                $(this).find('.cs-status-checkbox-list').addClass('active');
            }
        });

        var color = $('.cs-status-checkbox');
        color.popover({
            html : true,
            container: 'body',
            singleton : true,
            content: '',
            title: 'Are you sure?',
            placement: 'left',
            template: '<div class="cs_status-popover popover confirmation" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
        });

        color.on('show.bs.popover', function (e) {
            var myPopover = $(this).data('bs.popover');
            var popoverContent = '<div class="btn-group" id="cs-csatus-popover">' +
                '<button class="btn btn-sm btn-primary cs-status-save" ><i class="glyphicon glyphicon-ok"></i>Save</button>';

            if($(this).data('notify')){
                popoverContent += '<button class="btn btn-sm btn-success cs-status-notify" ><i class="glyphicon glyphicon-send"></i>Save&Send</button>'+
                '<button class="btn btn-sm btn-success cs-status-edit" ><i class="glyphicon glyphicon-send"></i>Save&Edit</button></div>';
            }
            popoverContent += '</div>';

            myPopover.options.content = popoverContent;

            popoverHide($(this).attr('id'));
            $('#popover-data').attr('data-id', $(this).data('id'));
            $('#popover-data').attr('data-selector', $(this).attr('id'));
            $('#popover-data').attr('data-index', $(this).data('index'));
            $('#popover-data').attr('data-type', $(this).data('type'));
        });


        $('body').on('click', '.cs-status-save', function () {
            chage_cs_status();
        });
        $('body').on('click','.cs-status-notify', function () {
            chage_cs_status(1);
        });
        $('body').on('click','.cs-status-edit', function (e) {
            e.preventDefault();
            var dataObj = $('#popover-data');
            var index = dataObj.attr('data-index');
            var type = dataObj.attr('data-type');
            tinymce.get('status_change_email_content').setContent($('#cs_email_'+ type +'_' + index).html());
            $("#status_change_email").modal("show");
        });

        $('body').on('click','.cs_email_save', function () {
            var text = tinyMCE.get('status_change_email_content').getContent();
            chage_cs_status(1, text);
            $("#status_change_email").modal("hide");
        });
        //$('body').on('click', '.cs-status-close', function () {
        //    popoverHide();
        //});

        function chage_cs_status(notify, text){
            var nt = notify || 0;
            var text = text || '';
            var dataObj = $('#popover-data');
            var index = dataObj.attr('data-index');
            var id = dataObj.attr('data-id');
            var th = dataObj.attr('data-selector');
            var u_t = dataObj.attr('data-type');
            $.post(cs_status_url, {id:id, index:index, type:u_t, notify:nt, text:text}).done(function (data) {
                $('#' + th).closest('.cs-status-checkbox-wrap').attr('class', 'cs-status-checkbox-wrap cs-status' + index);
                $('#' + th).parents('.cs-status-checkbox-list').removeClass('active');
                popoverHide();
            });
        }

        $(document).mouseup(function (e) {
            if (!csUsersTableTd.is(e.target) && csUsersTableTd.has(e.target).length === 0) {
                csUsersTableTd.find('.cs-status-checkbox-list').removeClass('active');
                popoverHide();
            }
        });

        function popoverHide(th){
            var th = th || '';
            var sel = $('#popover-data').attr('data-selector');
            if(th != sel) {
                $('#' + sel).popover('hide');
            }
        }

        /** Ststus Filters */
        var statusFilterWrap = $('.cs-status-filter');

        statusFilterWrap.each(function(){
            var statusFilter = $(this).find('select');

            createSelectBox(statusFilter, $(this));
            initSelectBox(statusFilter, $(this));
        });

        statusFilterWrap.on( "click", "span", function() {
            statusFilterWrap.find('ul').hide();
            $(this).next('ul').show();
        });

        statusFilterWrap.on( "click", "li", function() {
            var filterWrap = $(this).closest('.cs-status-filter');
            var select = filterWrap.find('select');
            var ul = filterWrap.find('ul');
            var value = $(this).data('value');

            select.val(value).trigger('change');
        });
    }

    function createSelectBox(select, wrap){
        var html = '<span>'+select.data('type')+'</span>';

        html += '<ul>';
        select.find('option').each(function(){
            html += '<li data-value="'+$(this).attr('value')+'"></li>';
        });
        html += '</ul>';

        wrap.append(html);
    }

    function initSelectBox(select, wrap){
        var selected = select.val();

        switch(selected) {
            case "0":
                wrap.addClass('cs-status0');
                break;
            case "1":
                wrap.addClass('cs-status1');
                break;
            case "2":
                wrap.addClass('cs-status2');
                break;
            case "3":
                wrap.addClass('cs-status3');
                break;
            case "4":
                wrap.addClass('cs-status4');
                break;
            default:
                wrap.addClass('cs-status-none');
        }
    }

    // ----------------------------

    $("#live_edit_change_status").on("click", function(e){

        e.preventDefault();

        $.getJSON( "/liveedit/changestatus/?liveedit_status="+$(this).attr("data-status"), function( data ) {

            window.location.reload();

        });

    });

    updateDiscountModel();

    $(".discount_model").on("change", function(){

        updateDiscountModel();

    });



    $(".admin_change_season").on("change", function(){

        $(this).closest("form").submit();

    });

    $.extend({
        password: function (length, special) {
            var iteration = 0;
            var password = "";
            var randomNumber;
            if(special == undefined){
                var special = false;
            }
            while(iteration < length){
                randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
                if(!special){
                    if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
                    if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
                    if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
                    if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
                }
                iteration++;
                password += String.fromCharCode(randomNumber);
            }
            return password;
        }
    });

    if($("#pages-status").val() == 'private'){
        $('.password_input').removeClass( "hidden" );
    }
    $("#pages-status").on("change", function(){
        $('.password_input').addClass("hidden");
        if($(this).val() == 'private'){
            $('.password_input').removeClass( "hidden" );
        }
    });

    function generate_pass(btn){
        password = $.password(8);
        $('#'+btn).val(password);
        if ( $( "#new-pass-show" ).length ) {
                $('#new-pass').val(password);
        }
    }

    $('.btn-generate').click(function(){
        generate_pass($(this).data('generateto'));
        return false;
    })

    $('.generate-user-pass').click(function(){
        password = $.password(8);
        $('#new-pass').val(password);
        $('#new-pass-show').text(password);
        return false;
    });

    $("#modal_widget_sel").on("change", function(){

        widget_slug = $(this).val();

        if( widget_slug != '' )
            $("#save_widget_modal").show();
        else
            $("#save_widget_modal").hide();

        $.each($(".modal_widget_cont"), function(){

            if( $(this).attr("data-widget-slug") == widget_slug ){

                $(this).show();

            } else {

                $(this).hide();

            }

        });

    });

    $(".add_widget_btn").on("click", function(){

        widget_modal_reset();

        $("#modal_widget_area").val( $(this).attr("data-area-id") );

    });

    $("#layouts_widgets_container").find("input[type='checkbox']").on("change", function(){

        if( $(this).prop("checked") == true )
            $(this).val(1);
        else
            $(this).val(0);

    });

    $("#save_widget_modal").on("click", function(e){

        e.preventDefault();

        widget_slug = $("#modal_widget_sel").val();
        order = $("#modal_widget_order").val();
        modal_widget_area = $("#modal_widget_area").val();
        modal_widget_in_area = $("#modal_widget_in_area").val();

        var dataa = new FormData();

        dataa.append('widget_slug', widget_slug);
        dataa.append('order', order);
        dataa.append('area', modal_widget_area);
        dataa.append('widget_in_area', modal_widget_in_area);

        $.each($("#widget_form_container").find(".modal_widget_cont[data-widget-slug='"+widget_slug+"']").find(":input"), function(){

            if( $(this).attr("type") == 'file' ) {

                files = $(this).prop('files');

                input_name = $(this).attr("name");

                $.each(files, function(key, value)
                {
                    dataa.append(input_name+'['+key+']', value);
                });

            } else {

                if( $(this).attr("data-wysiwyg") ) {

                    vl = tinyMCE.get($(this).attr('id')).getContent();

                } else {

                    vl = $(this).val();

                }

                dataa.append($(this).attr("name"), vl);

            }

        });

        $.ajax({
            type: 'POST',
            url: '/backend/widget/save/',
            data: dataa,
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function(response){

                addWidgetRow( response["widget"] );

                $("#addwidget").modal("hide");

            }
        });

    });


    $(".widgets_areas").on("click", ".widget_delete", function(e){

        e.preventDefault();

        datastring = 'widget_in_area='+$(this).attr("data-widget-in-area");

        $.ajax({
            type: 'POST',
            url: '/backend/widget/delete/',
            data: datastring,
            success: function(response){ }
        });

        tbody = $(this).closest("tbody");

        $(this).closest("tr").remove();

        if( tbody.find("tr").length == 0 ){

            tbody.html('<tr class="nowidget_row"><td colspan="10" style="text-align:center"><small>There is no widget added yet in this area.</small></td></tr>');

        }

    });

    $(".add_widget_group").on("click", function(e){

        e.preventDefault();

        clone = $(".form-group[data-param-index='"+$(this).attr("data-param-index")+"']").html();

        $(".widget_cloned_groups[data-param-index='"+$(this).attr("data-param-index")+"']").append( '<div class="form-group form-group-md">'+clone+'</div>' );

    });

    $(".widgets_areas").on("click", ".widget_edit", function(e){

        e.preventDefault();

        widget_modal_reset();

        widget_in_area = $(this).attr("data-widget-id");

        params = wid_params[ widget_in_area ];

        $("#modal_widget_area").val( params["area"] );
        $("#modal_widget_in_area").val( widget_in_area );
        $("#modal_widget_sel").find('option[value="' + params["widget_slug"] + '"]').prop('selected', true);
        $("#modal_widget_order").val( params["order"] );

        for( ind in params["params"] ){

            if( !is_array( params["params"][ind] ) ) {

                $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "']").val(params["params"][ind]);
                $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("textarea[name='" + ind + "']").val(params["params"][ind]);

                if( editor_id = $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("textarea[name='" + ind + "']").attr("id") ){

                    tinymce.get(editor_id).setContent(params["params"][ind]);

                }

                if (params["params"][ind] == 1) {
                    $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "'][type='checkbox']").prop("checked", true);
                    $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "'][type='checkbox']").parent().addClass("checked");
                }
                if (params["params"][ind] == 0) {
                    $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "'][type='checkbox']").prop("checked", false);
                    $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "'][type='checkbox']").parent().removeClass("checked");
                }
                $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("select[name='" + ind + "']").find('option[value="' + params["params"][ind] + '"]').prop('selected', true);

            } else {

                if( $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "']").attr("type") == 'file' ){

                    files_html = '<div class="widget_attached_files">';

                    for( var fileind in params["params"][ind] ){

                        files_html += '<div><a href="'+params["params"][ind][fileind]['base_url']+'" target="_blank">'+params["params"][ind][fileind]['filename']+'</a> <a href="#" class="widget_del_attach" data-widget-in-area="'+widget_in_area+'" data-param-slug="'+ind+'" data-file-index="'+fileind+'">Delete</a></div>';

                    }

                    files_html += '';

                    $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "']").parent().find('.widget_attached_files').remove();

                    $("#widget_form_container").find(".modal_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "']").parent().append( files_html );

                }

            }

        }

        $.each($(".modal_widget_cont"), function(){

            if( $(this).attr("data-widget-slug") == params["widget_slug"] ){

                $(this).show();

            } else {

                $(this).hide();

            }

        });

        $("#save_widget_modal").show();

        $("#addwidget").modal("show");

    });

    $(document).on("click", ".widget_del_attach", function(e){

        e.preventDefault();

        datastring = 'widget_in_area='+$(this).attr("data-widget-in-area")+'&param_slug='+$(this).attr("data-param-slug")+'&file_index='+$(this).attr("data-file-index");

        $.ajax({
            type: 'POST',
            url: '/backend/widget/deleteattachment/',
            data: datastring,
            success: function(response){ }
        });

        $(this).parent().remove();

    });

    $("#pages-type").on("change", "input[type='radio']", function(){

        tp = $(this).val();

        $(".page_type_cont").hide();
        $(".page_type_cont[data-type-id='"+tp+"']").show();

    });

    $(".disable_section_check").on("change", function(){

        check_section_disable();

    });

    check_section_disable();

    $(".add_widget_area_to_section").on("click", function(e){

        e.preventDefault();

        $(this).closest(".section_widget_area").find(".section_widget_area_cont").append( $(this).closest(".section_widget_area").find(".section_widget_area_tmpl").html() );

    });

    $(document).on("click", ".remove_widget_area_fs", function(e){

        e.preventDefault();

        $(this).closest(".wdg_area_s").remove();

    });

    $(".gridform").find("thead").find("tr").eq(1).find(":input").on("change", function(){

        $(this).closest("form").submit();

    });

    $(".gridform").find("thead").find("tr").eq(1).find(":input").on("keydown", function(e){

        if(e.keyCode == 13 ){
            e.preventDefault();

            $(this).closest("form").submit();
        }

    });

    $(".gridform select[name='per-page']").on("change", function(){

        $(this).closest("form").submit();

    });

    $(".change_form_post").on("click", function(){

        $(this).closest("form").attr("method", "post");

    });

    $(".checkall_hosts").on("change", function(){

        $.each( $(".bulk_act"), function(){

            $(this).prop("checked", $(".checkall_hosts").prop("checked"));

            if($(".checkall_hosts").prop("checked")){
                $(this).closest("span").addClass("checked");
            } else {
                $(this).closest("span").removeClass("checked");
            }

        } );



    });

    $("#menu_url").on("change", function(){

        check_menu_url();

    });

    check_menu_url();

    $(".restore_page").on("click", function(){

        return confirm("Are you sure you want to restore to this point? You will be able to restore the current version later.");

    });

    $("#extand_layout").on("change", function(e){

        load_extand_layout();

    });

    load_extand_layout();

    renderTreeView();

    $(".favorite_title").val( $(document).find("title").text() );

    $(document).on("click", ".add_favorite", function(e){

        e.preventDefault();

        url = encodeURIComponent( window.location.href );
        title = $(".favorite_title").val();

        datastring = 'url=' + url+'&title='+title;

        $.ajax({
            type: 'POST',
            url: '/backend/favoriteurls/add/',
            data: datastring,
            success: function (response) {

                if( response != '0' ){

                    $("#add_page_to_favs").hide();
                    $("#remove_page_from_favs").show();

                    title = $(".favorite_title").val();

                    $("#favorite_links_bar").prepend('<li class="media" id="fu_link" data-url="'+encodeURIComponent(response)+'"><a href="'+response+'" class="right_bar_link"><div class="media-body"><h4 class="media-heading">'+title+'</h4><div class="media-heading-sub"> '+response+' </div></div></a></li>');

                }

            }
        });

    });

    $(document).on("click", ".remove_favorite", function(e){

        e.preventDefault();

        url = encodeURIComponent( window.location.href );

        datastring = 'url=' + url;

        $.ajax({
            type: 'POST',
            url: '/backend/favoriteurls/remove/',
            data: datastring,
            success: function (response) {

                if( response != '0' ){

                    $("#add_page_to_favs").show();
                    $("#remove_page_from_favs").hide();

                    $("#fu_link[data-url='"+encodeURIComponent(response)+"']").remove();

                }

            }
        });

    });

    $(document).on("click", ".remove_favorite_btn", function(e){

        e.preventDefault();

        url = $(this).attr("data-url");

        datastring = 'url=' + url;

        $.ajax({
            type: 'POST',
            url: '/backend/favoriteurls/remove/',
            data: datastring,
            success: function (response) {

                if( response != '0' ){

                    $(".remove_favorite_btn[data-url='"+url+"']").closest(".favorite_row").remove();

                    $("#fu_link[data-url='"+encodeURIComponent(response)+"']").remove();

                }

            }
        });

    });

    $(".activate_tab_form").on("change", function(){

        if( $(this).prop("checked") == true ){

            $(this).closest(".tab-pane").find(".tab_hidden_content").find(":input").prop("disabled",false);
            $(this).closest(".tab-pane").find(".tab_hidden_content").css("opacity","1");


        } else {

            if( $(this).attr("data-delete-content") == "1" ) alert("Disabling this section will delete all information related to it.");

            $(this).closest(".tab-pane").find(".tab_hidden_content").find(":input").prop("disabled",true);
            if( $(this).attr("data-delete-content") == "1" ) $(this).closest(".tab-pane").find(".tab_hidden_content").find(":input").val("");
            $(this).closest(".tab-pane").find(".tab_hidden_content").css("opacity","0.5");

        }

    });

    $.each($(".activate_tab_form"), function(){

        if( $(this).prop("checked") == true ){

            $(this).closest(".tab-pane").find(".tab_hidden_content").find(":input").prop("disabled",false);
            $(this).closest(".tab-pane").find(".tab_hidden_content").css("opacity","1");


        } else {

            $(this).closest(".tab-pane").find(".tab_hidden_content").find(":input").prop("disabled",true);
            $(this).closest(".tab-pane").find(".tab_hidden_content").css("opacity","0.5");

        }

    });

    $(".rl_add_filter").on("click", function(e){

        e.preventDefault();

        rl_add_new_filter();

    });

    $("#rl_find_model_from").on("change", function(){

        rl_recreate_filters();
        rl_add_new_filter();

    });

    if( typeof predef_filters != 'undefined' ) {

        if (predef_filters.length == 0) {

            rl_recreate_filters();
            rl_add_new_filter();

        } else {

            rl_recreate_filters();

            for (i in predef_filters) {

                rl_add_predef_filter(predef_filters[i]);

            }

        }

    }

    $(document).on("click", ".rl_remove_filter", function(e){

        e.preventDefault();

        $(this).closest(".row").remove();

    });

    $(".widget_area_title").on("click", function(){

        $(this).closest(".portlet").find(".portlet-body").toggle();

    });

    $(document).on('focusin', function(e) {
        if ($(e.target).closest(".mce-window").length) {
            e.stopImmediatePropagation();
        }
    });

    $(".show_media_url").on("click", function(e){

        e.preventDefault();

        $(this).closest(".cbp-item").find(".media_url").toggle();

    });

    $(".tinymce_use_file").on("click", function(e){

        e.preventDefault();

        filetype = $(this).attr("data-file-type");
        fileurl = $(this).closest(".cbp-item").find(".media_url").find("input").val();
        filename = $(this).closest(".cbp-item").find(".media_file_name").html();

        htmlcont = '';

        switch( filetype ){

            case "image":

                htmlcont = '<img src="'+fileurl+'" border="0" alt="" width="250" height="250" class="media_attachment_image">';

                break;

            default:

                htmlcont = '<a href="' + fileurl + '" title="'+filename+'" class="media_attachment_file">' + filename + '</a>';

                break;

        }

        top.tinymce.activeEditor.insertContent( htmlcont );

        top.tinymce.activeEditor.windowManager.close();

    });

    $(".layouts_add_widget").on("click", function(e){

        e.preventDefault();

        resetlayoutwidgetmodal();

        $("#addlayoutwidget").modal("show");

    });

    $(".layouts_add_widget_area").on("click", function(e){

        e.preventDefault();

        $(".layouts_sel_widgets_area").val("");
        $(".layout_sel_widget_area_title").val("");
        $(".layout_sel_widget_area_position").val("");
        $(".layout_sel_widget_area_id").val("0");

        $("#addlayoutwidgetarea").modal("show");

    });

    $(".layouts_sel_widgets_area").on("change", function(){

        if( $(this).val() != '' ){

            $(".layouts_add_widget_area_save").show();

        } else {

            $(".layouts_add_widget_area_save").hide();

        }

    });

    $(".layouts_add_widget_area_save").on("click", function(e){

        e.preventDefault();

        var dataa = new FormData();

        dataa.append('layout_id', current_layout_id);
        dataa.append('widget_area_id', $(".layouts_sel_widgets_area").val());
        dataa.append('widget_area_title', $(".layout_sel_widget_area_title").val());
        dataa.append('widget_area_position', $(".layout_sel_widget_area_position").val());
        dataa.append('layout_area_id', $(".layout_sel_widget_area_id").val());

        $.ajax({
            type: 'POST',
            url: '/backend/layouts/savewidgetarea/',
            data: dataa,
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function(response){

                addLayoutWidget( response["widget"] );

                $("#addlayoutwidgetarea").modal("hide");

            }
        });

    });

    $(".layout_sel_widget").on("change", function(){

        widget_slug = $(this).val();

        if( widget_slug != '' )
            $(".layout_save_widget").show();
        else
            $(".layout_save_widget").hide();

        $.each($(".layout_widget_cont"), function(){

            if( $(this).attr("data-widget-slug") == widget_slug ){

                $(this).show();

            } else {

                $(this).hide();

            }

        });

    });

    $(".layout_save_widget").on("click", function(e){

        e.preventDefault();

        layoutAddWidget();

    });

    $(document).on("click", ".layouts_edit_widget", function(e){

        e.preventDefault();

        $.getJSON( "/backend/layouts/widgetinfo/"+$(this).attr("data-widget-id"), function( data ) {

            if( data.type == 'widget' ){

                layouteditmodal( data );

            } else {

                layouteditmodalarea( data );

            }

        });

    });

    $(document).on("click", ".remove_layout_widget", function(e){

        e.preventDefault();
        var widget_portlet = $(this).closest(".layout_widget_portlet");
        widget_id = widget_portlet.attr("data-widget-id");
        //delete from dom
        widget_portlet.remove();

        $.getJSON( "/backend/layouts/delwidget/"+widget_id, function( data ) {

        });

    });

    $(document).on("switchChange.bootstrapSwitch", ".layout_widget_active_check", function(){

        widget_id = $(this).closest(".layout_widget_portlet").attr("data-widget-id");

        checked = $(this).prop("checked") ? 1 : 0;

        $.getJSON( "/backend/layouts/activewidget/"+widget_id+"?active="+checked, function( data ) {



        });

    });

    $(document).on("switchChange.bootstrapSwitch", ".layout_section_active_check", function(){

        section = $(this).attr("data-section");

        checked = $(this).prop("checked") ? 1 : 0;

        layout_id = $(".layout_section").attr("data-layout-id");

        $.getJSON( "/backend/layouts/activesection/"+layout_id+"?active="+checked+"&section="+section, function( data ) {



        });

    });

    $("#sortable_category_portlets").on("mouseup", function(){

        setTimeout("reorderLayoutWidgets()", 800);

    });

    $(".goto_next_tab").on("click", function(e){

        e.preventDefault();

        $('.nav-tabs > .active').next('li').find('a').trigger('click');

    });

    $(".select-on-check-all").on("change", function(){

        if( $(this).prop("checked") ){

            $(".users_list_check").prop("checked", true);
            $(".users_list_check").closest("span").addClass("checked");

        } else {

            $(".users_list_check").prop("checked", false);
            $(".users_list_check").closest("span").removeClass("checked");

        }

    });

    $(".users_list_check").on("change", function(){

        if( $(this).prop("checked") == false ){

            $(this).parent().append("<input type='hidden' name='userslistdel[]' value='"+$(this).val()+"' class='users_del_check'>")

        } else {

            $(this).parent().find(".users_del_check").remove();

        }

    });

    $(".mailing_keyword").on("click", function(e){

        e.preventDefault();

        tinymce.activeEditor.execCommand('mceInsertContent', false, "{"+$(this).attr("data-keyword")+"}");

    });

    $.each( $("form[data-disabled='1']").find(":input"), function(){

        $(this).prop("disabled",true);

    } );

    $(".check_all_hosts").on("click", function(e){

        e.preventDefault();

        if( $(this).attr("data-check") == 1 ){

            $(".users_list_check[data-host='1']").prop("checked", true);
            $(".users_list_check[data-host='1']").closest("span").addClass("checked");

        } else {

            $(".users_list_check[data-host='1']").prop("checked", false);
            $(".users_list_check[data-host='1']").closest("span").removeClass("checked");

        }

    });

    $(".check_all_hosts_status").on("click", function(e){

        e.preventDefault();

        if( $(this).attr("data-check") == 1 ){

            $(".users_list_check[data-host-status='"+$(this).attr("data-status")+"']").prop("checked", true);
            $(".users_list_check[data-host-status='"+$(this).attr("data-status")+"']").closest("span").addClass("checked");

        } else {

            $(".users_list_check[data-host-status='"+$(this).attr("data-status")+"']").prop("checked", false);
            $(".users_list_check[data-host-status='"+$(this).attr("data-status")+"']").closest("span").removeClass("checked");

        }

    });

    $(".mailing_use_template").on("click", function(e){

        e.preventDefault();

        $.getJSON( "/backend/mailingtemplates/gettemplate/"+$("#mailing_template_id").val(), function( data ) {

            tinymce.activeEditor.setContent(data.message);

        });

    });

}); /* End doc-ready */

function reorderLayoutWidgets(){

    positions = new Array();
    positions[0] = 'top';
    positions[1] = 'left';
    positions[2] = 'right';
    positions[3] = 'center';
    positions[4] = 'bottom';

    order = '';

    for( var p in positions ) {

        position = positions[ p ];

        ind = 0;

        $.each($(".layout_widgets_section[data-position='" + position + "']").find(".layout_widget_portlet"), function () {

            widget_id = $(this).attr("data-widget-id");
            ind++;

            order += order == '' ? '' : ',';

            order += widget_id + '_' + ind + '_' + position;

        });

    }

    $.getJSON( "/backend/layouts/reorder/?order="+order, function( data ) {



    });

}

function layouteditmodal( data ){

    resetlayoutwidgetmodal();

    $(".layout_sel_widget_id").val( data.id );
    $(".layout_sel_widget_title").val( data.title );
    $(".layout_sel_widget_position").val( data.position );
    $(".layout_sel_widget").val( data.widget_slug );

    params = new Array();
    params["params"] = data.params;
    params["widget_slug"] = data.widget_slug;

    for( ind in params["params"] ){

        if( !is_array( params["params"][ind] ) ) {

            $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "']").val(params["params"][ind]);
            $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("textarea[name='" + ind + "']").val(params["params"][ind]);

            if( editor_id = $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("textarea[name='" + ind + "']").attr("id") ){

                tinymce.get(editor_id).setContent(params["params"][ind]);

            }

            if (params["params"][ind] == 1) {
                $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "'][type='checkbox']").prop("checked", true);
                $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "'][type='checkbox']").parent().addClass("checked");
            }
            if (params["params"][ind] == 0) {
                $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "'][type='checkbox']").prop("checked", false);
                $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "'][type='checkbox']").parent().removeClass("checked");
            }
            $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("select[name='" + ind + "']").find('option[value="' + params["params"][ind] + '"]').prop('selected', true);

        } else {

            if( $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find(".form-group[data-param-index='"+params["widget_slug"]+"_"+ind+"']").length > 0 ){

                for (var fieldind in params["params"][ind]) {

                    if( fieldind != 0 ){

                        clone = $(".form-group[data-param-index='" + params["widget_slug"] + "_"+ind+"']").html();

                        $(".widget_cloned_groups[data-param-index='" + params["widget_slug"] + "_"+ind+"']").append( '<div class="form-group form-group-md" data-param-index="'+params["widget_slug"] + "_"+ind+'">'+clone+'</div>' );


                    }

                        for( paramind in params["params"][ind][fieldind] ){

                            if( !is_array( params["params"][ind][fieldind][paramind] ) ) {

                                $(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("input[name='" + ind + '[' + paramind + "][]']").val(params["params"][ind][fieldind][paramind]);
                                $(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("textarea[name='" + ind + '[' + paramind + "][]']").val(params["params"][ind][fieldind][paramind]);

                                if (editor_id = $(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("textarea[name='" + ind + '[' + paramind + "][]']").attr("id")) {

                                    tinymce.get(editor_id).setContent(params["params"][ind][fieldind][paramind]);

                                }

                                if (params["params"][ind][fieldind][paramind] == 1) {
                                    $(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("input[name='" + ind + '[' + paramind + "][]'][type='checkbox']").prop("checked", true);
                                    $(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("input[name='" + ind + '[' + paramind + "][]'][type='checkbox']").parent().addClass("checked");
                                }

                                if (params["params"][ind][fieldind][paramind] == 0) {
                                    $(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("input[name='" + ind + '[' + paramind + "][]'][type='checkbox']").prop("checked", false);
                                    $(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("input[name='" + ind + '[' + paramind + "][]'][type='checkbox']").parent().removeClass("checked");
                                }

                                $(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("select[name='" + ind + '[' + paramind + "][]']").find('option[value="' + params["params"][ind][fieldind][paramind] + '"]').prop('selected', true);

                            } else {

                                if ($(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("input[name='" + ind + '[' + paramind + "][]']").attr("type") == 'file') {
alert("a");
                                    files_html = '<div class="widget_attached_files">';

                                    for (var fileind in params["params"][ind][fieldind][paramind]) {

                                        files_html += '<div><a href="' + params["params"][ind][fieldind][paramind][fileind]['base_url'] + '" target="_blank">' + params["params"][ind][fieldind][paramind][fileind]['filename'] + '</a> <a href="#" class="widget_del_attach" data-widget-in-area="' + data.id + '" data-param-slug="' + ind + '" data-file-index="' + fileind + '">Delete</a></div>';

                                    }

                                    files_html += '';

                                    $(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("input[name='" + ind + '[' + paramind + "][]']").parent().find('.widget_attached_files').remove();

                                    $(".layout_widgets_form_container").find(".form-group[data-param-index='" + params["widget_slug"] + "_" + ind + "']").eq(fieldind).find("input[name='" + ind + '[' + paramind + "][]']").parent().append(files_html);

                                }

                            }
                        }

                }

            } else {

                if ($(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "']").attr("type") == 'file') {

                    files_html = '<div class="widget_attached_files">';

                    for (var fileind in params["params"][ind]) {

                        files_html += '<div><a href="' + params["params"][ind][fileind]['base_url'] + '" target="_blank">' + params["params"][ind][fileind]['filename'] + '</a> <a href="#" class="widget_del_attach" data-widget-in-area="' + data.id + '" data-param-slug="' + ind + '" data-file-index="' + fileind + '">Delete</a></div>';

                    }

                    files_html += '';

                    $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "']").parent().find('.widget_attached_files').remove();

                    $(".layout_widgets_form_container").find(".layout_widget_cont[data-widget-slug='" + params["widget_slug"] + "']").find("input[name='" + ind + "']").parent().append(files_html);

                }

            }

        }

    }

    $.each($(".layout_widget_cont"), function(){

        if( $(this).attr("data-widget-slug") == data.widget_slug ){

            $(this).show();

        } else {

            $(this).hide();

        }

    });

    $(".layout_save_widget").show();

    $("#addlayoutwidget").modal("show");

}

function layouteditmodalarea( data ){

    $(".layout_sel_widget_area_id").val( data.id );
    $(".layout_sel_widget_area_title").val( data.title );
    $(".layout_sel_widget_area_position").val( data.position );
    $(".layouts_sel_widgets_area").val( data.widget_id );


    $(".layouts_add_widget_area_save").show();

    $("#addlayoutwidgetarea").modal("show");

}

function resetlayoutwidgetmodal(){

    $(".widget_cloned_groups").html("");

    $.each($(".layout_widgets_form_container").find(":input"), function(){

        tagName = $(this).prop("tagName").toLowerCase();

        switch( tagName ){

            case 'input':

                tagType = $(this).attr("type");

                switch( tagType ){

                    case 'hidden':
                    case 'text':

                        $(this).val( $(this).attr("data-default") );

                        break;

                    case 'checkbox':

                        $(this).val( $(this).attr("data-default") );
                        if( $(this).attr("data-default") == 1 ){ $(this).prop("checked", true); $(this).parent().addClass("checked"); } else { $(this).prop("checked", false); $(this).parent().removeClass("checked"); }

                        break;

                    case 'file':

                        $(this).val('');

                        break;

                }

                break;

            case 'textarea':

                $(this).val( $(this).attr("data-default") );

                if( editor_id = $(this).attr("id") ){

                    default_value = $("#"+editor_id).attr("data-default");

                    tinymce.get(editor_id).setContent(default_value);

                }

                break;

            case 'select':

                $(this).find('option[value="' + $(this).attr("data-default") + '"]').prop('selected', true);

                break;

        }

    });

    $(".layout_sel_widget_id").val("0");

    $(".layout_save_widget").hide();

    $(".layout_widget_cont").hide();

}

function layoutAddWidget(){

    widget_slug = $(".layout_sel_widget").val();
    widget_position = $(".layout_sel_widget_position").val();
    widget_title = $(".layout_sel_widget_title").val();
    widget_id = $(".layout_sel_widget_id").val();

    var dataa = new FormData();

    dataa.append('layout_id', current_layout_id);
    dataa.append('widget_id', widget_id);
    dataa.append('widget_slug', widget_slug);
    dataa.append('widget_position', widget_position);
    dataa.append('widget_title', widget_title);

    $.each($("#layouts_widgets_container").find(".layout_widget_cont[data-widget-slug='"+widget_slug+"']").find(":input"), function(){

        if( $(this).attr("type") == 'file' ) {

            files = $(this).prop('files');

            input_name = $(this).attr("name");

            $.each(files, function(key, value)
            {
                dataa.append(input_name+'['+key+']', value);
            });

        } else {

            if( $(this).attr("data-wysiwyg") ) {

                vl = tinyMCE.get($(this).attr('id')).getContent();

            } else {

                vl = $(this).val();

            }

            dataa.append($(this).attr("name"), vl);

        }

    });

    $.ajax({
        type: 'POST',
        url: '/backend/layouts/savewidget/',
        data: dataa,
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        success: function(response){

            addLayoutWidget( response["widget"] );

            $("#addlayoutwidget").modal("hide");

        }
    });

}

function updateDiscountModel(){

    $(".discount_model_rows").html("<option value=''></option>");

    if( $(".discount_model").val() == '' ){

        return false;

    }

    $.getJSON( "/backend/discount/getmodel/?model="+$(".discount_model").val(), function( data ) {

        data.sort(function(a, b){
            var a1= a['option'], b1= b['option'];
            if(a1== b1) return 0;
            return a1> b1? 1: -1;
        });

        for( var i in data ){

            if($.trim( data[i]['option'] ) == '' ) continue;

            if( $(".discount_model").val() == $(".discount_model").attr("data-default-val") && $(".discount_model_rows").attr("data-default-val") == data[i]['value'] ){
                seled = 1;
            } else {
                seled = 0;
            }

            html = '<option value="'+data[i]['value']+'" '+( seled == 1 ? 'selected="selected"' : '' )+'>'+data[i]['option']+'</option>';

            $(".discount_model_rows").append(html);

        }

    });

}

function addLayoutWidget( data ){

    if( data.newrecord == 1 ){

        html = '<div class="portlet portlet-sortable box default layout_widget_portlet" style="display: block;" data-widget-id="'+data.id+'">';
            html += '<div class="portlet-title">';
                html += '<div class="caption widget_portlet_title">'+data.title+'</div>';
                html += '<div class="tools">';
                    html += '<a href="" class="expand"> </a>';
                    html += '<a href="" class="remove_layout_widget"></a>';
                html += '</div>';
            html += '</div>';
            html += '<div class="portlet-body" style="display: none;">';
                html += '<ul class="list-unstyled">';

                switch( data.type ){

                    case 'widget':
                        html += '<li><span class="font-grey-silver">Widget:</span>  <span class="widget_portlet_widget_title">'+data.widget_title+'</span> </li>';
                        html += '<li><span class="font-grey-silver">Description:</span>  <span class="widget_portlet_widget_desc">'+data.widget_description+'</span> </li>';
                        break;

                    case 'area':
                        html += '<li><span class="font-grey-silver">Widget Area:</span>  <span class="widget_portlet_widget_title">'+data.widget_title+'</span> </li>';
                        break;

                }

                html += '</ul>';
                html += '<div class="clearfix">';
                    html += '<a href="#" class="btn-link pull-left layouts_edit_widget" data-widget-id="'+data.id+'" data-widget-type="'+data.type+'">';
                        html += '<i class="fa fa-pencil"></i> Edit';
                    html += '</a>';
                    html += '<div class="pull-right bootstrap-switch-handle-on bootstrap-switch-success" >';
                        html += '<input type="checkbox" class="make-switch layout_widget_active_check" data-on-color="success" data-size="small" '+(data.active==1 ? 'checked' : '')+'>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

        $(".layout_widgets_section[data-position='"+data.position+"']").prepend( html );

        //init bootstrap switcher
        $('.make-switch').bootstrapSwitch();

        reorderLayoutWidgets();

    } else {

        $(".layout_widget_portlet[data-widget-id='"+data.id+"']").find(".widget_portlet_title").html( data.title );
        $(".layout_widget_portlet[data-widget-id='"+data.id+"']").find(".widget_portlet_widget_title").html( data.widget_title );
        $(".layout_widget_portlet[data-widget-id='"+data.id+"']").find(".widget_portlet_widget_desc").html( data.widget_description );

    }


}

function rl_add_new_filter(){

    model_slug = $("#rl_find_model_from").val();

    dropdown = $(".filter_model_dropdown[data-model-slug='"+model_slug+"']").clone();

    $(dropdown).removeClass("filter_model_dropdown");

    $(dropdown).find(":input").prop("disabled", false);

    $(dropdown).appendTo(".rl_filters_cont");

}

function rl_add_predef_filter( filter ){

    model_slug = $("#rl_find_model_from").val();

    dropdown = $(".filter_model_dropdown[data-model-slug='"+model_slug+"']").clone();

    $(dropdown).removeClass("filter_model_dropdown");

    $(dropdown).find(".filter_record").val( filter["filter_record"] );
    $(dropdown).find(".filter_record_value").val( filter["filter_record_value"] );
    $(dropdown).find(".filter_record_show").val( filter["filter_record_show"] );
    $(dropdown).find(".filter_record_cond").val( filter["filter_record_cond"] );

    $(dropdown).find(":input").prop("disabled", false);

    $(dropdown).appendTo(".rl_filters_cont");

}

function rl_recreate_filters(){

    $(".rl_filters_cont").html("");

}

function renderTreeView(){

    $.each($(".treeview"), function(){

        editTableByParent( $(this).find("tbody"), 0, 0 );

    });

}

function editTableByParent( table, parent_id, level ){

    $.each( $(table).find("tr[data-parent-id="+parent_id+"]"), function(){

        if( parent_id != 0 ){

            $(this).attr("data-to-delete","1");

            for( i=0; i<=level; i++ ) {
                $(this).find("td:nth-child(2)").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + $(this).find("td:nth-child(2)").html());
            }

            cont = '<tr data-parent-id="'+$(this).attr('data-parent-id')+'" data-key="'+$(this).attr('data-key')+'">'+$(this).html()+'</tr>';

            $(cont).insertAfter( $(table).find("tr[data-key='"+parent_id+"'][data-to-delete!='1']") );

        }
        editTableByParent( table, $(this).attr("data-key"), level+1 );

        if( parent_id != 0 ){

            $(this).remove();

        }

    } );

}

function load_extand_layout(){

    if( $("#extand_layout").length == 0 ) return false;

    layout_id = $("#extand_layout").val();

    $(".section_widget_area_extanded").html('');
    $(".disable_section_check").prop("disabled", false);

    if( layout_id != '' ) {

        datastring = 'layout_id=' + layout_id;

        $.ajax({
            type: 'POST',
            url: '/backend/layouts/extandinfo/',
            data: datastring,
            dataType: 'json',
            success: function (response) {

                for (i in response['widgets']) {

                    cont = $(".section_widget_area_extanded_" + response['widgets'][i].section).closest(".section_widget_area").find(".section_widget_area_tmpl").find(".wdg_area_s").clone(true);

                    $(cont).find("select").val(response['widgets'][i].widget_area_id);
                    $(cont).find("select").prop('disabled', true);
                    $(cont).find(".remove_widget_area_fs").remove();

                    $(".section_widget_area_extanded_" + response['widgets'][i].section).append(cont);

                }

                for( key in response['settings'] ){

                    if( key.substr(-8) == '_disable' ){

                        if( response['settings'][key] == 1 ){

                            $(".disable_"+key.substr(0,key.indexOf('_'))).prop("checked", true);
                            $(".disable_"+key.substr(0,key.indexOf('_'))).prop("disabled", true);
                            $(".disable_"+key.substr(0,key.indexOf('_'))).parent().addClass("checked");
                            $(".disable_"+key.substr(0,key.indexOf('_'))).closest(".layout_section").find(".disable_section_check_inp").val('1');

                        }

                    }

                }

                check_section_disable();

            }
        });

    }

}

function check_menu_url(){

    if( $("#menu_url").val() == 'other' ){

        $("#menu_url_other").css("display","block");

    } else {

        $("#menu_url_other").css("display","none");

    }

}

function is_array( mixed_var ) {
    return ( mixed_var instanceof Array );
}


function check_section_disable(){

    $.each( $(".disable_section_check"), function(){

        if( $(this).prop("checked") == true ){

            $(this).closest(".layout_section").addClass("disabled_section");
            $(this).closest(".layout_section").find(".disable_section_check_inp").val('1');

        } else {

            $(this).closest(".layout_section").removeClass("disabled_section");
            $(this).closest(".layout_section").find(".disable_section_check_inp").val('0');

        }

    } );

}

function widget_modal_reset(){

    $.each($("#layouts_widgets_container").find(":input"), function(){

        tagName = $(this).prop("tagName").toLowerCase();

        switch( tagName ){

            case 'input':

                tagType = $(this).attr("type");

                switch( tagType ){

                    case 'hidden':
                    case 'text':

                        $(this).val( $(this).attr("data-default") );

                        break;

                    case 'checkbox':

                        $(this).val( $(this).attr("data-default") );
                        if( $(this).attr("data-default") == 1 ){ $(this).prop("checked", true); $(this).parent().addClass("checked"); } else { $(this).prop("checked", false); $(this).parent().removeClass("checked"); }

                        break;

                    case 'file':

                        $(this).val('');

                        break;

                }

                break;

            case 'textarea':

                $(this).val( $(this).attr("data-default") );

                if( editor_id = $(this).attr("id") ){

                    default_value = $("#"+editor_id).attr("data-default");

                    tinymce.get(editor_id).setContent(default_value);

                }

                break;

            case 'select':

                $(this).find('option[value="' + $(this).attr("data-default") + '"]').prop('selected', true);

                break;

        }

    });

    $("#save_widget_modal").hide();

    $(".modal_widget_cont").hide();

}

function addWidgetRow( data ){

    $(".widget_row[data-widget-in-area='"+data['widget_in_area']+"']").remove();

    html = '<tr class="widget_row" data-widget-in-area="'+data['widget_in_area']+'">';
    html += '<td style="white-space:nowrap"><small>'+data["title"]+'</small></td>';
    html += '<td><small>'+data['description']+'</small></td>';
    html += '<td class="fit sortnr">'+data['order']+'</td>';
    html += '<td class="fit">';
    html += '<a href="#" class="btn btn-xs btn-primary widget_edit" data-widget-id="'+data['widget_in_area']+'">Edit</a>';
    html += '<a href="#" class="btn btn-xs btn-primary red widget_delete" data-widget-in-area="'+data['widget_in_area']+'">Delete</a>';
    html += '</td>';
    html += '</tr>';

    $(".widget_area[data-area-id='"+data['area']+"']").find(".widget_area_table").find("tbody").append(html);
    $(".widget_area[data-area-id='"+data['area']+"']").find(".widget_area_table").find("tbody").find(".nowidget_row").remove();

    wid_params[data['widget_in_area']] = new Array();
    wid_params[data['widget_in_area']]['widget_id'] = data['widget_id'];
    wid_params[data['widget_in_area']]['widget_slug'] = data['widget_slug'];
    wid_params[data['widget_in_area']]['order'] = data['order'];
    wid_params[data['widget_in_area']]['area'] = data['area'];
    wid_params[data['widget_in_area']]['params'] = new Array();

    for( var ind in data['params'] ) {

        wid_params[data['widget_in_area']]['params'][ind] = data['params'][ind];

    }

    reorderWidgetTables();

}

function reorderWidgetTables(){

    $.each( $(".widget_area_table"), function(){

        var rows = $(this).find('tbody').children('tr').get();
        rows.sort(function(a, b) {
            var anum = parseInt($(a).find(".sortnr").text(), 10);
            var bnum = parseInt($(b).find(".sortnr").text(), 10);
            return anum-bnum;
        });
        for (var i = 0; i < rows.length; i++) {
            $(this).find('tbody').append(rows[i]);
        }

    } );



}

$('.nav-tabs li a').on('shown.bs.tab', function(e){
    location.hash = $(e.target).attr('href').substr(1);
    window.scrollTo(0, 0);
    setTimeout(function() {
        window.scrollTo(0, 0);
    }, 0);
});
