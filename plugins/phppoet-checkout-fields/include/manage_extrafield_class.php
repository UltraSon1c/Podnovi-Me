<?php
class pcfme_manage_extrafield_class {

     public function __construct() {
		add_filter( 'woocommerce_form_field_text', array( &$this, 'pcfmetext_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_password', array( &$this, 'pcfmetext_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_email', array( &$this, 'pcfmetext_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_tel', array( &$this, 'pcfmetext_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_number', array( &$this, 'pcfmetext_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_textarea', array( &$this, 'pcfmetextarea_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_checkbox', array( &$this, 'pcfmecheckbox_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_radio', array( &$this, 'radio_form_field' ), 10, 4 );
     	add_filter( 'woocommerce_form_field_pcfmeselect', array( &$this, 'pcfmeselect_form_field' ), 10, 4 );
	    add_filter( 'woocommerce_form_field_datepicker', array( &$this, 'datepicker_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_multiselect', array( &$this, 'multiselect_form_field' ), 10, 4 );
		add_filter( 'wp_enqueue_scripts', array( &$this, 'add_checkout_frountend_scripts' ));
	 }



	 
	 public function add_checkout_frountend_scripts() {
	   global $post;

	   $pcfme_woo_version=pcfme_get_woo_version_number();

	    if ( is_checkout() || is_account_page() ) {
	     wp_enqueue_script( 'jquery-ui-datepicker' );
		 
		 wp_enqueue_style( 'jquery-ui', ''.pcfme_PLUGIN_URL.'assets/css/jquery-ui.css' );
		 
		 if ($pcfme_woo_version < 2.3) {
		 	wp_enqueue_script( 'pcfme-frontend1', ''.pcfme_PLUGIN_URL.'assets/js/frontend1.js' );
		 } else {
            wp_enqueue_script( 'pcfme-frontend2', ''.pcfme_PLUGIN_URL.'assets/js/frontend2.js' );
		 }
		 wp_enqueue_style( 'pcfme-frontend', ''.pcfme_PLUGIN_URL.'assets/css/frontend.css' );
		}
	 }
	 
	 

      
	  public function pcfmetext_form_field($field = '', $key, $args, $value) {

         if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	     if ( $args['required'] ) {
			  $args['class'][] = 'validate-required';
			  $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'pcfme'  ) . '">*</abbr>';
		  } else {
			$required = '';
		  }
		 
		 
		 
		 
	     if (isset($args['visibility']) && ($args['visibility'] == 'field-specific')) {
			 $showhide                 = $args['conditional']['showhide'];
			 $parentfield              = $args['conditional']['parentfield'];
			 $equalto                  = $args['conditional']['equalto'];
			 if (isset($equalto) && ($equalto != '')) {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . '_' . $equalto .''; 
			 } else {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . ''; 
			 }
			 
		 } else {
			 $pcfme_conditional_class  = '';
		 }

        $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' ' . $pcfme_conditional_class .'" id="' . $key . '_field">
            <label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
            <input type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'  '. pcfmeinput_conditional_class($key) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $args['maxlength'] . ' ' . $args['autocomplete'] . ' value="' . esc_attr( $value ) . '" />
        </p>' . $after;
         

        return $field;
      }
	  

	  
	  public function pcfmetextarea_form_field($field = '', $key, $args, $value) {

         if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	     if ( $args['required'] ) {
			  $args['class'][] = 'validate-required';
			  $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'pcfme'  ) . '">*</abbr>';
		  } else {
			$required = '';
		  }
		  
		 if (isset($args['visibility']) && ($args['visibility'] == 'field-specific')) {
			 $showhide                 = $args['conditional']['showhide'];
			 $parentfield              = $args['conditional']['parentfield'];
			 $equalto                  = $args['conditional']['equalto'];
			 if (isset($equalto) && ($equalto != '')) {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . '_' . $equalto .''; 
			 } else {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . ''; 
			 }
			 
		 } else {
			 $pcfme_conditional_class  = '';
		 }
		
	    

        $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' ' . $pcfme_conditional_class .'" id="' . $key . '_field">
            <label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
            <textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'  '. pcfmeinput_conditional_class($key) .'" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $args['maxlength'] . ' ' . $args['autocomplete'] . ' ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . '>'. esc_textarea( $value  ) .'</textarea>
        </p>' . $after;
         

        return $field;
      }
	  
	 public function pcfmecheckbox_form_field($field = '', $key, $args, $value) {

         if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	     if ( $args['required'] ) {
			  $args['class'][] = 'validate-required';
			  $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'pcfme'  ) . '">*</abbr>';
		  } else {
			$required = '';
		  }
		
		 if (isset($args['visibility']) && ($args['visibility'] == 'field-specific')) {
			 $showhide                 = $args['conditional']['showhide'];
			 $parentfield              = $args['conditional']['parentfield'];
			 $equalto                  = $args['conditional']['equalto'];
			 if (isset($equalto) && ($equalto != '')) {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . '_' . $equalto .''; 
			 } else {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . ''; 
			 }
			 
		 } else {
			 $pcfme_conditional_class  = '';
		 }
	   

         $field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) .' ' . implode( ' ', $args['class'] ) .' ' . $pcfme_conditional_class .'" ><input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) .' ' . $pcfme_conditional_class .' '. pcfmeinput_conditional_class($key) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="yes" '.checked( $value, 'yes' , false ) .' /> '
						 . $args['label'] . $required . '</label>';
         

        return $field;
      }
     
      public function radio_form_field($field = '', $key, $args, $value) {
      
	   
	  
        if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
        
		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'pcfme'  ) . '">*</abbr>';
		} else {
			$required = '';
		}
		
        
		
		if (isset($args['visibility']) && ($args['visibility'] == 'field-specific')) {
			 $showhide                 = $args['conditional']['showhide'];
			 $parentfield              = $args['conditional']['parentfield'];
			 $equalto                  = $args['conditional']['equalto'];
			 if (isset($equalto) && ($equalto != '')) {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . '_' . $equalto .''; 
			 } else {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . ''; 
			 }
			 
		 } else {
			 $pcfme_conditional_class  = '';
		 }

		 $options = '';

      if ( !empty( $args[ 'options' ] ) ) {
		  
	       foreach ( $args[ 'options' ] as $option_key => $option_text ) {
			  $options .= '&nbsp;&nbsp;<input type="radio" name="' . $key . '" id="' . $key . '" value="' . $option_key . '" ' . checked( $value, $option_key, false ) . 'class="select  '. pcfmeinput_conditional_class($key) .'">  ' . $option_text . '';
		   }
            
            
			$field = '<p class="form-row ' . implode( ' ', $args[ 'class' ] ) . ' ' . $pcfme_conditional_class .'" id="' . $key . '_field">
			          <label for="' . $key . '" class="' . implode( ' ', $args[ 'label_class' ] ) . '">' . $args[ 'label' ] . $required . '</label>' . $options . '</p>' . $after;
        }



          return $field;
       
     }
      

     public function pcfmeselect_form_field($field = '', $key, $args, $value) {

     if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	 if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'pcfme'  ) . '">*</abbr>';
		} else {
			$required = '';
		}
	 
	 if (isset($args['visibility']) && ($args['visibility'] == 'field-specific')) {
			 $showhide                 = $args['conditional']['showhide'];
			 $parentfield              = $args['conditional']['parentfield'];
			 $equalto                  = $args['conditional']['equalto'];
			 if (isset($equalto) && ($equalto != '')) {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . '_' . $equalto .''; 
			 } else {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . ''; 
			 }
			 
		 } else {
			 $pcfme_conditional_class  = '';
    }	  
	    $options = '';
	
	if (! empty ($args['placeholder'])) {
		$options .= '<option></option>';
	}
    

    if ( ! empty( $args['options'] ) ) {
        foreach ( $args['options'] as $option_key => $option_text ) {
            $options .= '<option value="' . $option_key . '" '. selected( $value, $option_key, false ) . '>' . $option_text .'</option>';
        }

        $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' ' . $pcfme_conditional_class .'" id="' . $key . '_field">
            <label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
            <select placeholder="'.$args['placeholder'].'" name="' . $key . '" id="' . $key . '" class="select pcfme-singleselect  '. pcfmeinput_conditional_class($key) .'" >
				' . $options . '
            </select>
        </p>' . $after;
      }

       return $field;
     }


	 
	 public function multiselect_form_field($field = '', $key, $args, $value) {
	  if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	    if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'pcfme'  ) . '">*</abbr>';
		} else {
			$required = '';
		}
	
     
       
	    $optionsarray='';
	    
		if (isset($value)) {
			   
			 foreach ($value as $optionvalue) {
			       $optionsarray.=''.$optionvalue.',';
			    } 
			  
			$optionsarray=substr_replace($optionsarray, "", -1);
			
	    }
		
		
	    if (isset($args['visibility']) && ($args['visibility'] == 'field-specific')) {
			 $showhide                 = $args['conditional']['showhide'];
			 $parentfield              = $args['conditional']['parentfield'];
			 $equalto                  = $args['conditional']['equalto'];
			 if (isset($equalto) && ($equalto != '')) {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . '_' . $equalto .''; 
			 } else {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . ''; 
			 }
			 
		 } else {
			 $pcfme_conditional_class  = '';
		 }
		
	    $options = '';

    if ( ! empty( $args['options'] ) ) {
        foreach ( $args['options'] as $option_key => $option_text ) {
			if (preg_match('/\b'.$option_key.'\b/', $optionsarray )) {
				$selectstatus = 'selected';
			} else {
				$selectstatus = '';
			}  
            $options .= '<option value="' . $option_key . '" '. $selectstatus . '>' . $option_text .'</option>';
        }

        $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' ' . $pcfme_conditional_class .'" id="' . $key . '_field">
            <label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
            <select name="' . $key . '[]" id="' . $key . '" class="select pcfme-multiselect  '. pcfmeinput_conditional_class($key) .'" multiple="multiple">
                ' . $options . '
            </select>
        </p>' . $after;
      }

       return $field;
	 }
	 
	 
	 public function datepicker_form_field( $field = '', $key, $args, $value) {
	    if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'pcfme'  ) . '">*</abbr>';
		} else {
			$required = '';
		}
		
		 if (isset($args['visibility']) && ($args['visibility'] == 'field-specific')) {
			 $showhide                 = $args['conditional']['showhide'];
			 $parentfield              = $args['conditional']['parentfield'];
			 $equalto                  = $args['conditional']['equalto'];
			 if (isset($equalto) && ($equalto != '')) {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . '_' . $equalto .''; 
			 } else {
				$pcfme_conditional_class  = '' . $showhide . '_by_' . $parentfield . ''; 
			 }
			 
		 } else {
			 $pcfme_conditional_class  = '';
		 }
		
		if (isset($args['disable_past'])) {
			$datepicker_class='pcfme-datepicker-disable-past';
		} else {
			$datepicker_class='pcfme-datepicker';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( ! empty( $args['validate'] ) )
			foreach( $args['validate'] as $validate )
				$args['class'][] = 'validate-' . $validate;

		$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .' ' . $pcfme_conditional_class .'" id="' . esc_attr( $key ) . '_field">';

		if ( $args['label'] )
			$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';

		$field .= '<input type="text" class="'. $datepicker_class .' input-text  '. pcfmeinput_conditional_class($key) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" />
			</p>' . $after;

		return $field;
	 }
}

new pcfme_manage_extrafield_class();
?>