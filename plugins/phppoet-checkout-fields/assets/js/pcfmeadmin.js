jQuery(document).ready(function($) {
var pcfmecheckoutfield = $(".checkoutfield");

$("#add-billing-field").on("click", function () {
   var pcfmenewPanel = pcfmecheckoutfield.clone();
    pcfmenewPanel.find(".collapse").removeClass("in");
    pcfmenewPanel.find(".accordion-toggle").attr("href", "#pcfme" + (hash));
    pcfmenewPanel.find(".new-field-label").append(pcfmeadmin.checkoutfieldtext4 + hash);
		
	pcfmenewPanel.find(".checkoutfield").attr("id", "pcfme_list_items_" + (hash));
	pcfmenewPanel.find(".panel-collapse").attr("id", "pcfme" + (hash));
	 
         var randomnumber=Math.floor(Math.random()*1000);


    
	pcfmenewPanel.find(".checkout_field_type_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][type]");
	pcfmenewPanel.find(".checkout_field_label").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][label]");
	pcfmenewPanel.find(".checkout_field_label").attr("value", "" + pcfmeadmin.checkoutfieldtext4 + hash + "");     
	pcfmenewPanel.find(".checkout_field_width_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][width]");
	pcfmenewPanel.find(".checkout_field_required").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][required]");
	
	pcfmenewPanel.find(".checkout_field_clear").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][clear]");
	pcfmenewPanel.find(".checkout_field_placeholder").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][placeholder]");
	pcfmenewPanel.find(".pcfme_checkout_field_extraclass_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][extraclass]");
	pcfmenewPanel.find(".pcfme_checkout_field_option_values_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][options]");
	pcfmenewPanel.find(".checkout_field_visibility_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][visibility]");
	pcfmenewPanel.find(".checkout_field_products_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber+ "][products][]");
	pcfmenewPanel.find(".checkout_field_category_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber+ "][category][]");
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber+ "][conditional][showhide]");
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber+ "][conditional][parentfield]");
	pcfmenewPanel.find(".checkout_field_conditional_equalto_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber+ "][conditional][equalto]");
	pcfmenewPanel.find(".checkout_field_validate_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber+ "][validate][]");
	pcfmenewPanel.find(".checkout_field_orderedition").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][orderedition]");
	pcfmenewPanel.find(".checkout_field_emailfields").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][emailfields]");
	pcfmenewPanel.find(".checkout_field_pdfinvoice").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][pdfinvoice]");
	pcfmenewPanel.find(".checkout_field_disable_past_dates").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][disable_past]");
	pcfmenewPanel.find(".checkout_field_editaddress").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][editaddress]");

	pcfmenewPanel.find(".checkout_field_width_new").chosen({width: "250px","disable_search": true});
	pcfmenewPanel.find(".checkout_field_visibility_new").chosen({width: "250px","disable_search": true});
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").chosen({width: "70px","disable_search": true});
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").chosen({width: "170px"});
	pcfmenewPanel.find(".checkout_field_type_new").chosen({width: "250px"});
	pcfmenewPanel.find(".checkout_field_validate_new").chosen({width: "250px"});
	pcfmenewPanel.find(".checkout_field_products_new").chosen({width: "400px" }); 
    pcfmenewPanel.find(".checkout_field_category_new").chosen({width: "400px" }); 
	
	pcfmenewPanel.find('.pcfme_checkout_field_option_values_new').tagEditor({
     delimiter: ', ', 
     placeholder: pcfmeadmin.optionplaceholder
    });
	
	pcfmenewPanel.find('.pcfme_checkout_field_extraclass_new').tagEditor({
      delimiter: ', ', /* space and comma */
      placeholder: pcfmeadmin.classplaceholder
    });
	
	
	$("#accordion").append(pcfmenewPanel.fadeIn());
	hash++;
	
});

$("#add-shipping-field").on("click", function () {
   var pcfmenewPanel = pcfmecheckoutfield.clone();
   pcfmenewPanel.find(".collapse").removeClass("in");
   pcfmenewPanel.find(".accordion-toggle").attr("href", "#pcfme" + (hash));
   pcfmenewPanel.find(".new-field-label").append(pcfmeadmin.checkoutfieldtext5 + hash);
    
		
	pcfmenewPanel.find(".checkoutfield").attr("id", "pcfme_list_items_" + (hash));
	pcfmenewPanel.find(".panel-collapse").attr("id", "pcfme" + (hash));
	
        var randomnumber2=Math.floor(Math.random()*1000);
        
	pcfmenewPanel.find(".checkout_field_type_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][type]");
	pcfmenewPanel.find(".checkout_field_label").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][label]");
	pcfmenewPanel.find(".checkout_field_label").attr("value", "" + pcfmeadmin.checkoutfieldtext5 + hash + "");
	pcfmenewPanel.find(".checkout_field_width_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][width]");
	pcfmenewPanel.find(".checkout_field_required").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][required]");
	
	pcfmenewPanel.find(".checkout_field_clear").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][clear]");
	pcfmenewPanel.find(".checkout_field_placeholder").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][placeholder]");
	pcfmenewPanel.find(".pcfme_checkout_field_extraclass_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][extraclass]");
	pcfmenewPanel.find(".pcfme_checkout_field_option_values_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][options]");
	pcfmenewPanel.find(".checkout_field_visibility_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][visibility]");
	pcfmenewPanel.find(".checkout_field_products_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][products][]");
	pcfmenewPanel.find(".checkout_field_category_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][category][]");
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2+ "][conditional][showhide]");
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2+ "][conditional][parentfield]");
	pcfmenewPanel.find(".checkout_field_conditional_equalto_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2+ "][conditional][equalto]");
	pcfmenewPanel.find(".checkout_field_validate_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][validate][]");
	pcfmenewPanel.find(".checkout_field_orderedition").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][orderedition]");
	pcfmenewPanel.find(".checkout_field_emailfields").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][emailfields]");
	pcfmenewPanel.find(".checkout_field_pdfinvoice").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][pdfinvoice]");
	pcfmenewPanel.find(".checkout_field_disable_past_dates").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][disable_past]");
	pcfmenewPanel.find(".checkout_field_editaddress").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][editaddress]");
	
	pcfmenewPanel.find(".checkout_field_width_new").chosen({width: "250px","disable_search": true});
	pcfmenewPanel.find(".checkout_field_visibility_new").chosen({width: "250px","disable_search": true});
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").chosen({width: "70px","disable_search": true});
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").chosen({width: "170px"});
	pcfmenewPanel.find(".checkout_field_type_new").chosen({width: "250px"});
	pcfmenewPanel.find(".checkout_field_validate_new").chosen({width: "250px"});
	pcfmenewPanel.find(".checkout_field_products_new").chosen({width: "400px" }); 
    pcfmenewPanel.find(".checkout_field_category_new").chosen({width: "400px" }); 
	
	pcfmenewPanel.find('.pcfme_checkout_field_option_values_new').tagEditor({
     delimiter: ', ', /* space and comma */
     placeholder: pcfmeadmin.optionplaceholder
    });
	
	pcfmenewPanel.find('.pcfme_checkout_field_extraclass_new').tagEditor({
      delimiter: ', ', /* space and comma */
      placeholder: pcfmeadmin.classplaceholder
    });

	
	$("#accordion").append(pcfmenewPanel.fadeIn());
	hash++;
	
});


$("#add-additional-field").on("click", function () {
   var pcfmenewPanel = pcfmecheckoutfield.clone();
    pcfmenewPanel.find(".collapse").removeClass("in");
    pcfmenewPanel.find(".accordion-toggle").attr("href", "#pcfme" + (hash));
    pcfmenewPanel.find(".new-field-label").append(pcfmeadmin.checkoutfieldtext6 + hash);
    
		
	pcfmenewPanel.find(".checkoutfield").attr("id", "pcfme_list_items_" + (hash));
	pcfmenewPanel.find(".panel-collapse").attr("id", "pcfme" + (hash));
	
        var randomnumber3=Math.floor(Math.random()*1000);
        
	pcfmenewPanel.find(".checkout_field_type_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][type]");
	pcfmenewPanel.find(".checkout_field_label").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][label]");
	pcfmenewPanel.find(".checkout_field_label").attr("value", "" + pcfmeadmin.checkoutfieldtext6 + hash + "");
	pcfmenewPanel.find(".checkout_field_width_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][width]");
	pcfmenewPanel.find(".checkout_field_required").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][required]");
	
	pcfmenewPanel.find(".checkout_field_clear").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][clear]");
	pcfmenewPanel.find(".checkout_field_placeholder").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][placeholder]");
	pcfmenewPanel.find(".pcfme_checkout_field_extraclass_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][extraclass]");
	pcfmenewPanel.find(".pcfme_checkout_field_option_values_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][options]");
	pcfmenewPanel.find(".checkout_field_visibility_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][visibility]");
	pcfmenewPanel.find(".checkout_field_products_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][products][]");
	pcfmenewPanel.find(".checkout_field_category_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][category][]");
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3+ "][conditional][showhide]");
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3+ "][conditional][parentfield]");
	pcfmenewPanel.find(".checkout_field_conditional_equalto_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3+ "][conditional][equalto]");
	pcfmenewPanel.find(".checkout_field_orderedition").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][orderedition]");
	pcfmenewPanel.find(".checkout_field_emailfields").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][emailfields]");
	pcfmenewPanel.find(".checkout_field_pdfinvoice").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][pdfinvoice]");
	pcfmenewPanel.find(".checkout_field_disable_past_dates").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][disable_past]");
	pcfmenewPanel.find(".checkout_field_editaddress").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][editaddress]");
	
	pcfmenewPanel.find(".checkout_field_width_new").chosen({width: "250px","disable_search": true});
	pcfmenewPanel.find(".checkout_field_visibility_new").chosen({width: "250px","disable_search": true});
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").chosen({width: "70px","disable_search": true});
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").chosen({width: "170px"});
	pcfmenewPanel.find(".checkout_field_type_new").chosen({width: "250px"});
	pcfmenewPanel.find(".checkout_field_products_new").chosen({width: "400px" }); 
    pcfmenewPanel.find(".checkout_field_category_new").chosen({width: "400px" }); 
	
	pcfmenewPanel.find('.pcfme_checkout_field_option_values_new').tagEditor({
     delimiter: ', ', /* space and comma */
     placeholder: pcfmeadmin.optionplaceholder
    });
	
	pcfmenewPanel.find('.pcfme_checkout_field_extraclass_new').tagEditor({
      delimiter: ', ', /* space and comma */
      placeholder: pcfmeadmin.classplaceholder
    });
	
	
	$("#accordion").append(pcfmenewPanel.fadeIn());
	hash++;
	
});


$("div.pcfme-sortable-list").sortable({
    opacity : 0.7
	
});

$(function() {
$('.checkout_field_type').live('change',function(){
    var typevalue1 = $(this).val();
	if (typevalue1 == "datepicker") {
		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').show();
	} else {
		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').hide();
	}
});

$('.checkout_field_type_new').live('change',function(){
    var typevalue2 = $(this).val();
	if (typevalue2 == "datepicker") {
		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').show();
	} else {
		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').hide();
	}
});

$('.checkout_field_visibility').live('change',function(){
    var visibilityvalue2 = $(this).val();
	if (visibilityvalue2 == "product-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').show();
	} else if (visibilityvalue2 == "category-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').show();
	} else if (visibilityvalue2 == "field-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').show();
	
	} else {
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
	}
});

$('.checkout_field_visibility_new').live('change',function(){
    var visibilityvalue2 = $(this).val();
	if (visibilityvalue2 == "product-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').show();
	} else if (visibilityvalue2 == "category-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').show();
	} else if (visibilityvalue2 == "field-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').show();
	
	} else {
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
	}
});



$('.pcfme_checkout_field_option_values').tagEditor({
    delimiter: ', ', /* space and comma */
    placeholder: pcfmeadmin.optionplaceholder
});

$('.pcfme_checkout_field_extraclass').tagEditor({
    delimiter: ', ', /* space and comma */
    placeholder: pcfmeadmin.classplaceholder
});

});



$(document).on('click', '.glyphicon-remove-circle', function () {

   var result = confirm(pcfmeadmin.removealert);
   if (result==true) {
     $(this).parents('.panel').get(0).remove();
   }
   });

$("#restore-billing-fields").click(function() {
   var result2 = confirm(pcfmeadmin.restorealert);
   if (result2 == true) {
     
     $.ajax({
            data: {action: "restore_billing_fields" },
            type: 'POST',
            url: ajaxurl,
            success: function( response ) { 
			  window.location.reload();
			}
        });
   }
});

$("#restore-shipping-fields").click(function() {
   var result3 = confirm(pcfmeadmin.restorealert);
   if (result3 == true) {
     
     $.ajax({
            data: {action: "restore_shipping_fields" },
            type: 'POST',
            url: ajaxurl,
            success: function( response ) { 
			  window.location.reload();
			}
        });
   }
});
});



