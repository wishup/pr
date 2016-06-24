$(window).on('load', function(){

    $('form.send_ajax').unbind('submit').bind("submit", function(event, jqXHR, settings) {
        event.preventDefault();
        event.stopPropagation();
        var form = $(this);
        //if(form.find('.has-error').length) {
        //    return false;
        //}

        $.ajax({
            url: form.attr('action'),
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
                if( typeof data.response != 'undefined' ){

                    if( data.response == 'ok' ){

                        form.find(".has-error").removeClass("has-error");
                        form.find(".help-block[data-dont-clear!='1']").html("");

                        window[form.attr("data-callback")]( data );

                    } else {

                        if( data.response == 'error' ){

                            if( typeof data.errors != 'undefined' ) {

                                delpreverrors = 0;

                                for (field in data.errors) {

                                    if (delpreverrors == 0) {

                                        $("#" + form.attr("data-id-prefix") + "-" + field).closest("form").find(".has-error").removeClass("has-error");
                                        $("#" + form.attr("data-id-prefix") + "-" + field).closest("form").find(".help-block[data-dont-clear!='1']").html("");

                                        delpreverrors = 1;

                                    }

                                    $("#" + form.attr("data-id-prefix") + "-" + field).parent().addClass("has-error");

                                    if ($("#" + form.attr("data-id-prefix") + "-" + field).parent().find(".help-block").length == 0) $("#" + data.id_prefix + "-" + field).parent().append('<div class="help-block"></div>');

                                    for (err in data.errors[field]) {
                                        $("#" + form.attr("data-id-prefix") + "-" + field).parent().find(".help-block").append("<div>" + data.errors[field][err] + "</div>")
                                    }

                                }

                            }

                            if( typeof data.multierrors != 'undefined' ) {

                                delpreverrors = 0;

                                for( fieldInd in data.multierrors ){

                                    errors = data.multierrors[ fieldInd ];

                                    for (field in errors) {

                                        if (delpreverrors == 0) {

                                            $("#" + form.attr("data-id-prefix") + "-" + fieldInd + "-" + field).closest("form").find(".has-error").removeClass("has-error");
                                            $("#" + form.attr("data-id-prefix") + "-" + fieldInd + "-" + field).closest("form").find(".help-block[data-dont-clear!='1']").html("");

                                            delpreverrors = 1;

                                        }

                                        $("#" + form.attr("data-id-prefix") + "-" + fieldInd + "-" + field).parent().addClass("has-error");

                                        if ($("#" + form.attr("data-id-prefix") + "-" + fieldInd + "-" + field).parent().find(".help-block").length == 0) $("#" + data.id_prefix + "-" + fieldInd + "-" + field).parent().append('<div class="help-block"></div>');

                                        for (err in errors[field]) {
                                            $("#" + form.attr("data-id-prefix") + "-" + fieldInd + "-" + field).parent().find(".help-block").append("<div>" + errors[field][err] + "</div>")
                                        }

                                    }

                                }

                            }

                        }

                    }

                }

            }
        });

        return false;
    });

});
