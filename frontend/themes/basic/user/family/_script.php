<?php
$url = Yii::$app->getUrlManager()->createUrl("user/loadchildbyajax");
$cart_url = Yii::$app->getUrlManager()->createUrl("user/updatecartbyajax");
$script = <<< JS

var _index = "$index";
var _cart_url = "$cart_url";

$(document).on("change", '.first_name', function(e){
    var index = $(this).data("index");
    var name = this.value;
    updateCart('change_name', index, name)
});

$("#loadChildByAjax").click(function(e){
    e.preventDefault();
    var _url = "$url" + "?index="+_index;
    $.ajax({
        url: _url,
        success:function(response){
            $("#contestant-form-list").append(response);
            updateCart();
            $(".date_mask_child").unmask().mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
            $("ul.child-container-"+_index+" .custom-select").customSelect();
            _index++;
        }
    });
});

function updateCart(action, index, param){
if (typeof action === 'undefined') { action = false; }
if (typeof index === 'undefined') { index = false; }
if (typeof param === 'undefined') { param = false; }

$.ajax({
        url: _cart_url,
        data : { action :action, index:index, param:param },
        success:function(response){
            $("#family-reg-cart").html(response);
        }
    });
}




$(document).on("change", '#donate_count', function(){
    var donation_count = this.value;
    var donate_agree = $("#donate_agree").is(":checked");
    if(donate_agree){
        updateCart('donation', '', donation_count);
    }
});

$(document).on("change", '.date_mask_child', function(){
    var date_of_birth = this.value;
    var index = $(this).data('index');
    updateCart('date_of_birth', index, date_of_birth);
});

$(document).on("change", '#donate_agree', function(){
    var donation_count = $("#donate_count option:selected").val();

    var donate_agree = $("#donate_agree").is(":checked");
    if(!donate_agree){
        donation_count = 0;
    }
    updateCart('donation', '', donation_count);
});



function deleteChild(elm, index)
{
    element=$(elm).parent().parent();
    $(element).animate(
    {
        opacity: 0.25,
        left: '+=50',
        height: 'toggle'
    }, 500,
    function() {
        $(element).remove();
        updateCart('remove', index);

    });
};



jQuery(document).ready(function () {
    if(_index == 0){
        $("#loadChildByAjax").click();
    }
    updateCart();
});

$('form').on('afterValidateAttribute', function (event, attribute, messages) {
    if(messages.length == 0 && $(attribute.input).hasClass('date_mask_child')){

            var _this = attribute.input;
            var value = $(_this).val();
            $(_this).closest('.form-group').find(".alert-block").text('');

            if (!isValidDate(value)) {
                messages.push("Please enter valid mm/dd/yyyy date.")
            } else {
                age = getAge(value, '11/13/2016');
                var isReqAge = true;

                if (age >0 && age <= 6) {
                    $(_this).closest('.form-group').find(".alert-block").text('This participant will be a "Beginner" and only charged $5.');
                }

                if(age > 18) {
                    isReqAge = false;
                }
                if (!isReqAge) {
                    messages.push("Contestant's age need to be not more then 18 years old on November 13th.")
                }

            }
    }
});

JS;

$this->registerJs($script, \yii\web\View::POS_END);