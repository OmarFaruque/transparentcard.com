jQuery('span#elementor-device-mode').prev('div').hide();
jQuery(document).ready(function(){
    
    'use strict';
    
    jQuery('span#elementor-device-mode').prev('div').hide();
    var toggleBtn = jQuery('.sffm-flymenu-wrapper').detach();
    jQuery('.col-lg-2.col-md-2.col-sm-3.mobile-nav-btn').append(toggleBtn);

   
    jQuery(document.body).on('click', 'body.single-product #closeFrameDesign', function(){
        location.reload();
    });


    jQuery('.trns-nbd-tag-list-item').on( 'click', function( e ){
        var val = jQuery(this).data('value') + '',
        type = jQuery(this).data('type'),
        url = new URL(window.location.href),
        // current_val = url.searchParams.get( type );
        current_val = null;

        
        if( current_val !== null ){
            var current_val_arr = current_val.split(',');
            if( current_val_arr.includes( val ) ){
                val = current_val;
            }else{
                val = current_val + ',' + val;
            }
        }
        var link = addParameter( window.location.href, type, val, false );
        link = removeParam( 'paged', link );
        window.location = link;
        e.preventDefault();
    });
    


    jQuery(document.body).on('click', '.woocommerce-form-login-toggle button', function(){
        if(jQuery(this).hasClass('showRegistration')){
            jQuery('form.woocommerce-form.woocommerce-form-login.login').slideUp();
            if(!jQuery('form.woocommerce-form.woocommerce-form-register.register').is(":visible")){
                jQuery('form.woocommerce-form.woocommerce-form-register.register').slideDown();
            }else{
                jQuery('form.woocommerce-form.woocommerce-form-register.register').slideUp();
                
            }    
        }


        if(jQuery(this).hasClass('showlogin')){
            jQuery('form.woocommerce-form.woocommerce-form-register.register').slideUp();
            if(!jQuery('form.woocommerce-form.woocommerce-form-login.login').is(":visible")){
                jQuery('form.woocommerce-form.woocommerce-form-login.login').slideDown();
            }else{
                jQuery('form.woocommerce-form.woocommerce-form-login.login').slideUp();
                
            }    
        }
        
    });
    

    

    jQuery(document.body).on('click', 'a.transparentcard-coupons', function(){
        var targetDetails = jQuery(document.body).find('div#coolcardsCopons');
        jQuery(targetDetails).slideToggle();    
    });


    jQuery(document.body).on('click', 'a.duplicate_cart_item', function(e){
        e.preventDefault();
        var item_key = jQuery(this).data('item_key'), 
        item_source_folder = jQuery(this).data('design_folder'),
        orientation = jQuery(this).data('orientation');

        duplicate_cart_item(item_key, item_source_folder, orientation);
    });


    jQuery(document.body).on('click', 'a.duplicate_cart_item_upload', function(e){
        e.preventDefault();
        var item_key = jQuery(this).data('item_key'), 
        item_source_folder = jQuery(this).data('design_folder');

        duplicate_cart_item(item_key, item_source_folder, '');
    });


    // Toggle menu cart by custom button in top menu 
    jQuery(document.body).on('click', 'a.target_menu_cart', function(e){
        e.preventDefault();
        
        jQuery(document.body).find('#elementor-menu-cart__toggle_button').trigger('click');
        return false;
    });

    jQuery(document.body).on('click', 'a.transparentcard_live_support', function(){
        jQuery('div#nbd-chat-app > div > div.nbc-button').trigger('click');
    });


    //Add more files 
    jQuery(document.body).on('click', '.add-more-files', function(){
        var html = `<div class="input-item position-relative"><input type="file" class="form-control w-full" name="coolcard-nbd-logo[]" id="coolcard-nbd-logo" ng-change="upload_expert_logo()" ><span class="clost-icon position-absulate"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
        </svg></span></div>`;
        jQuery(html).appendTo(jQuery(this).closest('.files_group'));
    });
   
    // Remove a item for add more files as extra logo and design elements 
    jQuery(document.body).on('click', 'span.clost-icon', function(){
        jQuery(this).closest('div.input-item').slideUp('slow', function(){
            jQuery(this).closest('div.input-item').remove();    
        });
    });

   
  
});
var toggleBillingDetails = function(e){
    var targetDetails = jQuery(document.body).find('div#billing_details_transparentcards');
    jQuery(targetDetails).slideToggle();
    return false;
}


//Cart kItem duplicate
var duplicate_cart_item = function($item_key = false, $item_source_folder = '', $orientation = 'horizontal'){

    var nonce = nbds_frontend.nonce,    
    cart_item_key = $item_key;


    var fd = new FormData();
    fd.append('nonce', nonce);
    
    fd.append('item_key', cart_item_key);
    fd.append('item_source_folder', $item_source_folder);



    if($orientation != ''){
        fd.append('action', 'transparentcart_copy_item');
        fd.append('orientation', $orientation);
    }else{
        fd.append('action', 'transparentcart_copy_item_upload');
    }



     jQuery.ajax({
        url: window.nbds_frontend.url,
        method: "POST",
        processData: false,
        contentType: false,
        data: fd,
        success: function (data) {
            // Handle the success response
            if(data.data.message == 'item-duplicated'){
                window.location.replace(data.data.redirect_url);
            }else{
                console.log('Something wrong: ', data.data.message)
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Handle errors here
            alert('Form submission failed: ' + textStatus);
        }
    });
}





// Province load 
jQuery(function($) {

    let billingCountry = jQuery('select#billing_country').val();
    var stateField = $('#billing_state');
    if(!billingCountry){
        $(stateField).attr('disabled', 'disabled');
    }else{
        $(stateField).removeAttr('disabled');
    }

    $('form.register').on('change', 'select#billing_country', function() {
        var country = $(this).val();
        var stateField = $('#billing_state');
        
        // Clear current options
        stateField.empty();

        // Request states via AJAX
        $.ajax({
            url: window.nbds_frontend.url,
            data: {
                action: 'transparentde_woocommerce_get_states',
                country: country
            },
            success: function(response) {
                if (response.success) {
                    
                    if(typeof response.data.states.length != 'undefined' && response.data.states.length <= 0){
                        $(stateField).attr('disabled', 'disabled');
                    }else{
                        $(stateField).removeAttr('disabled');
                    }

                    $.each(response.data.states, function(key, value) {
                        stateField.append('<option value="' + key + '">' + value + '</option>');
                    });

                }
                stateField.trigger('change');
            }
        });
    });


    // product slider arrow customization ;
    setTimeout(() => {
        jQuery('.tooltip').tooltipster({
            maxWidth: 300, 
            theme: 'tooltipster-punk', 
            contentCloning: true
        });
    }, 3000);

});




/** Back button url */
function removeURLParameter(param) {
    // Get the current URL
    var url = new URL(window.location.href);

    // Get the search parameters
    var searchParams = new URLSearchParams(url.search);

    // Remove the specified parameter
    searchParams.delete('action');
    searchParams.delete('cik');
    searchParams.delete('nbu_item_key');
    searchParams.delete('tasks');
    searchParams.delete('task');

    // Update the URL with the modified parameters
    url.search = searchParams.toString();

    // use url to string to back button
    window.location.replace(url.toString());

}

jQuery(document.body).on('click', '.back-to-left a, a.back-to-template-gallery-btn', function () {
    removeURLParameter();
});
