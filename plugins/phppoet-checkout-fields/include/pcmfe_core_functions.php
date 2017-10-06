<?php

if ( ! function_exists( 'pcmfe_admin_form_field' ) ) {

	/**
	 * Outputs a checkout/address form field.
	 *
	 * @access public
	 * @subpackage	Forms
	 * @param mixed $key
	 * @param mixed $args
	 * @param string $value (default: null)
	 * @return void
	 * @todo This function needs to be broken up in smaller pieces
	 */
	function pcmfe_admin_form_field( $key, $args, $value = null ) {
		$defaults = array(
			'type'              => 'text',
			'label'             => '',
			'description'       => '',
			'placeholder'       => '',
			'maxlength'         => false,
			'required'          => false,
			'id'                => $key,
			'class'             => array(),
			'label_class'       => array(),
			'input_class'       => array(),
			'return'            => false,
			'options'           => array(),
			'custom_attributes' => array(),
			'validate'          => array(),
			'default'           => '',
		);

		$args = wp_parse_args( $args, $defaults  );

	    if (isset($args['options'])) {
	      if (is_array($args['options'])) {
            $tempoptions = $args['options'];
	      } else {
	      	$tempoptions = explode(',',$args['options']);
	      }
	     
		}

        if (isset($args['disable_past'])) {
			$datepicker_class='pcfme-datepicker-disable-past';
		} else {
			$datepicker_class='pcfme-datepicker';
		}		
		      
		$optionsarray = array();
         
        if (isset($tempoptions)) {            
          foreach($tempoptions as $val){
    
                         $optionsarray[$val]  = $val;
      
          }	
         }



	switch ( $args['type'] ) {

		case "country":
		    
            $countries = $key == 'shipping_country' ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

			if ( sizeof( $countries ) == 1 ) {


				$field = '<strong>' . current( array_values( $countries ) ) . '</strong>';

				$field .= '<input type="hidden"   value="' . current( array_keys($countries ) ) . '" class="country_to_state" />';

				

			} else {

				$field = '<select  class="pcfme-country-select country_to_state country_select">
						 <option value="">'.__( 'Select a country&hellip;', 'pcn' ) .'</option>';

				foreach ( $countries as $ckey => $cvalue )
					$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'woocommerce' ) .'</option>';

				$field .= '</select>';

				

				
			}

			break;

			case "state" :

	          $field = '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '"   />';

			

			break;


		    
		case "textarea" :

			$field = '<textarea  class="input-text "  placeholder="' . esc_attr( $args['placeholder'] ) . '"></textarea>';

			break;

		case "checkbox" :

			$field = '<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox"  value="1"  />';
					

			break;

		case "password" :

			$field = '<input type="password" class="input-text "  placeholder="' . esc_attr( $args['placeholder'] ) . '" value="" />';

			break;

		case "text" :

		    $field = '<input type="text" class="input-text "   placeholder="' . esc_attr( $args['placeholder'] ) . '" '.$args['maxlength'].' value="" />';

		    break;

		case "select" :

		    

			$options = '';

			if ( ! empty( $optionsarray ) )
				foreach ( $optionsarray as $option_key => $option_text )
					$options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) .'</option>';

				$field = '<select class="select" style="width:200px;">
						' . $options . '
					</select>';
        break;

        case "pcfmeselect" :

		    

			$options = '';

			if ( ! empty( $optionsarray ) )
				foreach ( $optionsarray as $option_key => $option_text )
					$options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) .'</option>';

				$field = '<select class="select pcfme-singleselect" style="width:200px;">
						' . $options . '
					</select>';
        break;

		case "radio" :

		  $options = '';
          $field   = '';
			if ( ! empty( $optionsarray ) ) {
				foreach ( $optionsarray as $option_key => $option_text ) {
					$field .= '<input type="radio" class="input-radio" value="" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_" /><label for="' . esc_attr( $option_text ) . '_' . esc_attr( $option_text ) . '" >' . $option_text . '</label>&emsp;';
					
				}
			}

		   break;

		 
		 
	     case "multiselect":


	        $options = '';

            if ( ! empty( $optionsarray ) ) {
              foreach ( $optionsarray as $option_key => $option_text ) {
              $options .= '<option value="' . $option_key . '">' . $option_text .'</option>';
             }

             $field = '<select id="' . $key . '" class="select pcfme-multiselect" style="width:200px;" multiple="multiple">
                ' . $options . '
               </select>';
            
             }


	        break;

	      case "datepicker":

              $field = '<input type="text" class="'.$datepicker_class.' input-text"  placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="" />';
			
              break;
		}

		if (isset($field)) {

			echo $field;
		}
	}
}


if ( ! function_exists( 'pcfme_get_woo_version_number' ) ) {

    /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function pcfme_get_woo_version_number() {
        // If get_plugins() isn't available, require it
	   
	   if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
        // Create the plugins folder and file variables
	   $plugin_folder = get_plugins( '/' . 'woocommerce' );
	   $plugin_file = 'woocommerce.php';
	
	   // If the plugin version number is set, return it 
	   if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
		 return $plugin_folder[$plugin_file]['Version'];

	   } else {
	// Otherwise return null
		return NULL;
	  }
   }
   
}


if ( ! function_exists( 'pcfmeinput_conditional_class' ) ) {
	
	function pcfmeinput_conditional_class($fieldkey) {
		 $billing_settings_key      = 'pcfme_billing_settings';
	     $shipping_settings_key     = 'pcfme_shipping_settings';
	     $pcfme_additional_settings = 'pcfme_additional_settings';
		 $pcfme_class_text          = '';
		 
		 
		 $billing_fields                = (array) get_option( $billing_settings_key );
		 $shipping_fields               = (array) get_option( $shipping_settings_key );
		 $additional_fields             = (array) get_option( $pcfme_additional_settings );
		 
		 $hiderlist  = array();
		 $openerlist = array();
		 
		 foreach ($billing_fields as $billingkey=>$billingvalue) {
			if (isset($billingvalue['visibility']) && ($billingvalue['visibility'] == 'field-specific')) {
			 
			 $parentfield1              = $billingvalue['conditional']['parentfield'];
			 $cxshowhide1                = $billingvalue['conditional']['showhide'];
			 
			 if (isset($parentfield1) && ($parentfield1 != '')) {
				
				if (isset($cxshowhide1) && ($cxshowhide1 != '')) {
					switch ($cxshowhide1) {
						case "open":
						 if (!in_array($parentfield1, $openerlist)) array_push($openerlist, $parentfield1);
						break;
						
						case "hide":
						 if (!in_array($parentfield1, $hiderlist)) array_push($hiderlist, $parentfield1);
						break;
						
						
					}
				}
			 } 
			 
		    }   
		 }
		 
		 foreach ($shipping_fields as $shippingkey=>$shippingvalue) {
			if (isset($shippingvalue['visibility']) && ($shippingvalue['visibility'] == 'field-specific')) {
			 
			 $parentfield2               = $shippingvalue['conditional']['parentfield'];
			 $cxshowhide2                = $shippingvalue['conditional']['showhide'];
			 
			 if (isset($parentfield2) && ($parentfield2 != '')) {
				
				if (isset($cxshowhide2) && ($cxshowhide2 != '')) {
					switch ($cxshowhide2) {
						case "open":
						 if (!in_array($parentfield2, $openerlist)) array_push($openerlist, $parentfield2);
						break;
						
						case "hide":
						 if (!in_array($parentfield2, $hiderlist)) array_push($hiderlist, $parentfield2);
						break;
						
						
					}
				}
			 } 
			 
		    }   
		 }
		 
		 
		 foreach ($additional_fields as $additionalkey=>$additionalvalue) {
			if (isset($additionalvalue['visibility']) && ($additionalvalue['visibility'] == 'field-specific')) {
			 
			 $parentfield3               = $additionalvalue['conditional']['parentfield'];
			 $cxshowhide3                = $additionalvalue['conditional']['showhide'];
			 
			 if (isset($parentfield3) && ($parentfield3 != '')) {
				
				if (isset($cxshowhide3) && ($cxshowhide3 != '')) {
					switch ($cxshowhide3) {
						case "open":
						 if (!in_array($parentfield3, $openerlist)) array_push($openerlist, $parentfield3);
						break;
						
						case "hide":
						 if (!in_array($parentfield3, $hiderlist)) array_push($hiderlist, $parentfield3);
						break;
						
						
					}
				}
			 } 
			 
		    }   
		 }
		 
		   if (in_array($fieldkey, $openerlist)) {
			   $pcfmeopernertext                = 'pcfme-opener';
		   } else {
			   $pcfmeopernertext                = '';
		   }
		   
		    if (in_array($fieldkey, $hiderlist)) {
			   $pcfmehidertext                 = 'pcfme-hider';
		   } else {
			   $pcfmehidertext                 = '';
		   }
			
			
			   $pcfme_class_text  = ''.$pcfmeopernertext.' '.$pcfmehidertext.'';
			
		    
			
			return $pcfme_class_text;
	}
	        
}



if ( ! function_exists( 'pcfme_verify_envato_purchase_code' ) ) {
	
	/**
 * Check for valid envato item purchase code via envato api
 */
 
function pcfme_verify_envato_purchase_code() {
	
	    $extra_settings        = get_option('pcfme_extra_settings');
        $purchase_code         = $extra_settings['purchase_code'];
        $item_id               = 9799777;
        
		
      	$ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, "http://phppoet.com/updates/verify.php?code=". $purchase_code ."&callback=?");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        
        $result = json_decode( curl_exec($ch) , true );
        
       
        if ( !empty($result['verify-purchase']['item_id']) && $result['verify-purchase']['item_id'] ) {
            
            if ( !$item_id ) return true;
            
            if  ($result['verify-purchase']['item_id'] == $item_id) {
				update_option( 'pcfme_activation_status', "active" );
			} else {
				update_option( 'pcfme_activation_status', "inactive" );
			}
        } else {
			update_option( 'pcfme_activation_status', "inactive" );
		}

}
}


    
		
		
		
     
	
   
?>