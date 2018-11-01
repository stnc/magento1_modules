var magesmsValid = function() {
    $$('#form-validate button').each(function(element) {
       element.observe('click', function(e) {
           if (dataForm.validator.validate()) {
               showMagesmsPopup(magesmsValidUrl);
           }
           e.stop();
       });
    });
};
document.observe("dom:loaded", function() {
    magesmsValid();
});

var oPopup;
function showMagesmsPopup(sUrl) {
    oPopup = new Window({
        id:'magesms_validate_popup',
        className: 'magento',
        //url: sUrl,
        title: Translator.translate('OTP SMS'),
        width: 400,
        height: 180,
        minimizable: false,
        maximizable: false,
        showEffectOptions: {
            duration: 0.4
        },
        hideEffectOptions:{
            duration: 0.4
        },
        destroyOnClose: true
    });
    oPopup.setZIndex(100);
    oPopup.showCenter(true);
    var mobile = '';
    var code = '';
    if ($('code')) {
        code = $('code').value;
        mobile = '';
    } else {
        var params = ['mobilenumber', 'mobile_number', 'phone', 'phone_number', 'telephone', 'mobile', 'mobilephone'];
        for (var i in params) {
            var m = $(params[i]);
            if (m && m.value) {
                mobile = m.value;
                break;
            }
        }
    }
    new Ajax.Request(sUrl, {
         method: 'get',
         parameters: {smsnumber:mobile, code:code},
         //asynchronous: false,
         onSuccess: function(transport) {
             var response = transport.responseText.evalJSON();
             oPopup.setHTMLContent(response.html);
             if ($('code'))
                $('code').focus();
             else
                 $('smsnumber').focus();
         }
     });

}

function closePopup() {
    Windows.close('magesms_validate_popup');
}

function magesmsValidateNumber(next) {
    var parameters = {};
    if (next) {
        var code = $('code');
        if (!code.value) {
            alert(Translator.translate('This is a required field.'));
            code.focus();
            return;
        }
        parameters = {code: code.value};
    } else {
        var smsnumber = $('smsnumber');
        if (!smsnumber.value) {
            alert(Translator.translate('This is a required field.'));
            smsnumber.focus();
            return;
        }
        parameters = {smsnumber: smsnumber.value};
    }
    new Ajax.Request(magesmsValidUrl, {
        method: 'get',
        parameters: parameters,
        //asynchronous: false,
        onSuccess: function(transport) {
            var response = transport.responseText.evalJSON();
            if (response.error) {
                alert(response.error);
            } else {
                if (response.validate) {
                    closePopup();
                    if (response.order)
                        review.save();
                    else
                        $('form-validate').submit();
                }
                oPopup.setHTMLContent(response.html);
                $('code').focus();
            }
        }
    });
}