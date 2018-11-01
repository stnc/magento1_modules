jQuery(document).ready(function () {

    jQuery("a.stnc-beden-link").on('click', function (event) {
        event.preventDefault();
        $link = jQuery(this).attr ("data-href");
        jQuery('.kiz_cocuk_ust_kisimlar,.kiz_cocuk_elbise,.kiz_cocuk_etek_pantalon').hide();//grup 1 kÄ±z cocuk
        jQuery('.erkek_ust_kisimlar,.erkek_pantalon').hide();//grup 1 erkek cocuk
        jQuery('.kiz_bebek_ust_kisim, .kiz_bebek_etek_pantalon,  .kiz_bebek_elbise   ').hide();//grup 3
        jQuery('.erkek_pantalon, .erkek_bebek_ust_kisim, .erkek_ust_kisimlar ').hide();//grup 4
        jQuery('.erkek_ust_kisimlar,.erkek_pantalon').hide();//grup 1 erkek cocuk
        jQuery('.' + $link).show();
    });

    jQuery("a.size_guide-link").on('click', function (event) {
        jQuery.ajax({
            url: '/mageticaret/my/size/',
            type: 'get',
            success: function (data) {
                    jQuery("#sizeGuideContent").html(data);
            }
        });
        event.preventDefault();
        $link = jQuery(this).attr ("data-href");
        jQuery('.' + $link).show();
    });


});

