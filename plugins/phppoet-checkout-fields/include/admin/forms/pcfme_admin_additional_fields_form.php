<?php        
       global $woocommerce;
         
       
        $this->countries    = new WC_Countries();
	    
	    
		
		$additional_settings  = $this->additional_settings;
		$additional_settings  = array_filter($additional_settings);
		$core_fields          = '';
		$country_fields       = '';
		$address2_field       = '';

		$requiredadditional_slugs = '';
		
	    if (isset($additional_settings) && (sizeof($additional_settings) >= 1)) { 
		   $conditional_fields_dropdown = $additional_settings;
		} else {
		   $conditional_fields_dropdown = array();
		}
		
		$noticerowno3 = 1;
		 ?>
		 <center>
		 <div class="panel-group pcfme-sortable-list" id="accordion" >
		<?php if (isset($additional_settings) && (sizeof($additional_settings) >= 1)) { 
		    foreach ($additional_settings as $key =>$field) { 
		      $this->show_fields_form($conditional_fields_dropdown,$key,$field,$noticerowno3,$this->additional_settings_key,$requiredadditional_slugs,$core_fields,$country_fields,$address2_field);
		    $noticerowno3++;
		 } 
		 } 
		  ?>
		<script>
		 var hash= <?php echo $noticerowno3; ?>;
		jQuery(document).ready(function($) {
		  $(".checkout_field_width").chosen({width: "250px" ,"disable_search": true}); 
          $(".checkout_field_visibility").chosen({width: "250px" ,"disable_search": true});	
          $(".checkout_field_conditional_showhide").chosen({width: "70px" ,"disable_search": true});
          $(".checkout_field_conditional_parentfield").chosen({width: "170px" });		  
          $(".row-validate-multiselect").chosen({width: "250px" });  
          $(".checkout_field_type").chosen({width: "250px" });  
		  $(".checkout_field_products").chosen({width: "400px" }); 
		  $(".checkout_field_category").chosen({width: "400px" });
		 });
		 </script>
		</div>
		<div class="additional-buttondiv">
         <input type="button" id="add-additional-field" class="btn button-primary" style="float:left;" value="<?php _e('Add additional Field','pcn'); ?>">
	    </div>
		</center> <?php
		
	     $this->show_new_form($conditional_fields_dropdown,$this->additional_settings_key,$country_fields);