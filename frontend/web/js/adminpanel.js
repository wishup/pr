$(document).ready(function(){

    $("#live_edit_change_status").on("click", function(e){

        e.preventDefault();

        $.getJSON( "/liveedit/changestatus/?liveedit_status="+$(this).attr("data-status"), function( data ) {

            window.location.reload();

        });

    });

    $("#live_edit_change_inline_status").on("click", function(e){

        e.preventDefault();

        $.getJSON( "/liveedit/changeinlinestatus/?liveedit_inline_status="+$(this).attr("data-status"), function( data ) {

            window.location.reload();

        });

    });

    $(".live_edit_field_inline").on("click", function(e){

        e.preventDefault();

        if( url = $(this).attr("data-url") ){


            window.open(url);

        }

    });

    if( $(".live_edit_is_on").length > 0 ){

        $(document).on("click", "a", function(e){

            e.preventDefault();

        });

    }

    $(document).on("click", ".live_edit_field[data-editing=0]", function(e){

        e.preventDefault();

        $(this).attr("data-editing", "1");

        fieldFormat = $(this).attr("data-format");

        cont = $(this).html();

        inputHtml = '<div class="row form-group"><div class="col-sm-12"><textarea rows="'+( fieldFormat == 'text' ? 1 : 10 )+'" class="form-control live_edit_field_textarea '+(fieldFormat == 'wysiwyg' ? 'tinymce' : '')+'" id="textarea_'+(new Date).getTime()+'">'+cont+'</textarea></div></div>';
        inputHtml += '<div class="row form-group"><div class="col-sm-12"><a href="#" class="live_edit_field_save btn btn-success">Preview</a> </div></div>';

        $(this).html( inputHtml );

        if( fieldFormat != 'wysiwyg' ) $(this).find("textarea").focus();

        if( fieldFormat == 'wysiwyg' ) {

            tinyMCE.init({
                selector: '.tinymce',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true,
                convert_urls: false
            });

        }

    });

    $(document).on("click", ".live_edit_field_save", function(e){

        e.preventDefault();

        cont = $(this).closest(".live_edit_field").find("textarea").hasClass("tinymce") ? tinyMCE.get($(this).closest(".live_edit_field").find(".tinymce").attr("id")).getContent() : $(this).closest(".live_edit_field").find("textarea").val();

        $(this).closest(".live_edit_field").attr("data-editing", "0");
        $(this).closest(".live_edit_field").html( cont );

    });

    $("#save_live_edit_changes").on("click", function(){

        if( $(".live_edit_field[data-editing=1]").length > 0 ){

            alert("You have unsaved changes. Please save them, after try to save the page.");

            return false;

        }

        fieldsdata = {};

        $.each( $(".live_edit_field[data-source='db']"), function(){

            token = $(this).attr("data-token");
            cont = $(this).html();

            fieldsdata[token] = cont;

        } );

        filedata = {};

        $.each( $(".live_edit_field[data-source='file']"), function(){

            token = $(this).attr("data-token");
            cont = $(this).html();

            filedata[token] = cont;

        } );

        $.ajax({
            type: "POST",
            data: {'fields': fieldsdata, 'filefields': filedata },
            url: "/liveedit/savechanges/",
            success: function(data){
                if( data == 1 ){

                    window.location.reload();

                } else {

                    alert("Error: Couldn't save changes!");

                }
            }
        });

    });

});
