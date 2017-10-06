<?php
class pcfme_add_order_meta_class {
     
	 
	 private $billing_settings_key = 'pcfme_billing_settings';
	 private $shipping_settings_key = 'pcfme_shipping_settings';
	 private $additional_settings_key = 'pcfme_additional_settings';
     
	 public function __construct() {
	 
	      
	      add_filter('woocommerce_checkout_update_order_meta', array( &$this, 'update_order_meta' ) );
	      add_filter('woocommerce_admin_order_data_after_billing_address', array( &$this, 'data_after_billing_address' ) );
	      add_filter('woocommerce_email_order_meta', array( &$this, 'woocommerce_custom_new_order_templace' )  );
	      add_filter('wpo_wcpdf_after_order_data', array( &$this, 'woocommerce_custom_new_pdfinvoice_template' )  ,10,2);
		  add_filter('woocommerce_thankyou', array($this, 'data_after_order_details_page'), 75);
          add_filter('woocommerce_view_order', array($this, 'data_after_order_details_page'), 195);
	      
	 }
	 
	 public function woocommerce_custom_new_pdfinvoice_template ($template,$order) {
           
		   
		   $billing_fields                = (array) get_option( $this->billing_settings_key );
		   $shipping_fields               = (array) get_option( $this->shipping_settings_key );
		   $additional_fields             = (array) get_option( $this->additional_settings_key );
		   
	
		   
		     foreach ($billing_fields as $billingkey=>$billing_field) {
			    
				   if (isset($billing_field['pdfinvoice'])) {
					  
				  
				     $billingkeyvalue = get_post_meta( $order->id, $billingkey, true );
					  
				        if ( ! empty( $billingkeyvalue ) ) { ?>
				          
						   <tr class="billing-nif">
                             <th><?php echo $billing_field['label']; ?></th>
                             <td><?php echo $billingkeyvalue; ?></td>
                           </tr>
					   <?php	}	
			
			       }
			 }
		   
		   
		   
		   
		     foreach ($shipping_fields as $shippingkey=>$shipping_field) {
			    
				   if (isset($shipping_field['pdfinvoice'])) {
					  
					   
				    $shippingkeyvalue = get_post_meta( $order->id, $shippingkey, true );
					  
				         if ( ! empty( $shippingkeyvalue ) ) { ?>
				          
						   <tr class="billing-nif">
                             <th><?php echo $shipping_field['label']; ?></th>
                             <td><?php echo $shippingkeyvalue; ?></td>
                           </tr>
					   <?php	}	
                                   }  					
				      
                    
				
			 }
		   

		   foreach ($additional_fields as $additionalkey=>$additional_field) {
              if (isset($additional_field['pdfinvoice'])) {
					  
			          $additionalkeyvalue = get_post_meta( $order->id, $additionalkey, true );
					
				         if ( ! empty( $additionalkeyvalue ) ) { ?>
				          
						   <tr class="billing-nif">
                             <th><?php echo $additional_field['label']; ?></th>
                             <td><?php echo $additionalkeyvalue; ?></td>
                           </tr>
					   <?php	}	
				      
                     }

		   }
	    }
		
	 	public function update_order_meta($order_id) {
		   
		   $billing_fields      = (array) get_option( $this->billing_settings_key );
		   $shipping_fields     = (array) get_option( $this->shipping_settings_key );
		   $additional_fields   = (array) get_option( $this->additional_settings_key );
	       
		   
		   
		     foreach ($billing_fields as $billingkey=>$billing_field) {
			   
				   if ((isset($billing_field['orderedition'])) || (isset($billing_field['emailfields'])) || (isset($billing_field['pdfinvoice']))) {
				     if ( ! empty( $_POST[$billingkey] ) ) {
						 
						if (is_array($_POST[$billingkey]))  {
							$billingkeyvalue = implode(',', $_POST[$billingkey]);
						} else {
							$billingkeyvalue = $_POST[$billingkey];
						}
						 
                        update_post_meta( $order_id, $billingkey, sanitize_text_field( $billingkeyvalue ) );
                       } 
				   }
				
			 }
		   
		   
		   
		   
		     foreach ($shipping_fields as $shippingkey=>$shipping_field) {
			    
				   if ((isset($shipping_field['orderedition'])) || (isset($shipping_field['emailfields'])) || (isset($shipping_field['pdfinvoice']))) {
				     if ( ! empty( $_POST[$shippingkey] ) ) {
						 
						if (is_array($_POST[$shippingkey]))  {
							$shippingkeyvalue = implode(',', $_POST[$shippingkey]);
						} else {
							$shippingkeyvalue = $_POST[$shippingkey];
						}
						
                        update_post_meta( $order_id, $shippingkey, sanitize_text_field( $shippingkeyvalue ) );
                       } 
				   }
				
			 }
		   

		   foreach ($additional_fields as $additionalkey=>$additional_field) {
		   	    if ((isset($additional_field['orderedition'])) || (isset($additional_field['emailfields'])) || (isset($additional_field['pdfinvoice']))) {
				     if ( ! empty( $_POST[$additionalkey] ) ) {
						 
						if (is_array($_POST[$additionalkey]))  {
							$additionalkeyvalue = implode(',', $_POST[$additionalkey]);
						} else {
							$additionalkeyvalue = $_POST[$additionalkey];
						}
						
                        update_post_meta( $order_id, $additionalkey, sanitize_text_field( $additionalkeyvalue ) );
                       } 
				   }
		   }
		   
		   
	       
	 }   
	 
	    public function data_after_order_details_page($orderid)  {
	       
	      
		   
		   
		   $billing_fields      = (array) get_option( $this->billing_settings_key );
		   $shipping_fields     = (array) get_option( $this->shipping_settings_key );
           $additional_fields   = (array) get_option( $this->additional_settings_key );
		   
		     ?>
		   <table class="shop_table additional_details">
		    <tbody>
		    <?php
		     foreach ($billing_fields as $billingkey=>$billing_field) {
			    
				   if (isset($billing_field['orderedition'])) {
					  
				  
				     $billingkeyvalue = get_post_meta( $orderid, $billingkey, true );
					  
				        if ( ! empty( $billingkeyvalue ) ) { ?>
				          
						   <tr>
                             <th><?php echo $billing_field['label']; ?>:</th>
                             <td><?php echo $billingkeyvalue; ?></td>
                           </tr>
					   <?php	}	
			
			       }
			 }
		   
		   
		   
		   
		     foreach ($shipping_fields as $shippingkey=>$shipping_field) {
			    
				   if (isset($shipping_field['orderedition'])) {
					  
					   
				    $shippingkeyvalue = get_post_meta( $orderid, $shippingkey, true );
					  
				         if ( ! empty( $shippingkeyvalue ) ) { ?>
				          
						   <tr>
                             <th><?php echo $shipping_field['label']; ?>:</th>
                             <td><?php echo $shippingkeyvalue; ?></td>
                           </tr>
					   <?php	}	
                                   }  					
				      
                    
				
			 }
		   

		   foreach ($additional_fields as $additionalkey=>$additional_field) {
              if (isset($additional_field['orderedition'])) {
					  
			          $additionalkeyvalue = get_post_meta( $orderid, $additionalkey, true );
					
				         if ( ! empty( $additionalkeyvalue ) ) { ?>
				          
						   <tr>
                             <th><?php echo $additional_field['label']; ?>:</th>
                             <td><?php echo $additionalkeyvalue; ?></td>
                           </tr>
					   <?php	}	
				      
                     }

		   }
		   ?>
		   </tbody>
		   </table>
	       <?php  
	    }
	 
	 	 public function data_after_billing_address($order)  {
	       
	      
		   
		   
		   $billing_fields      = (array) get_option( $this->billing_settings_key );
		   $shipping_fields     = (array) get_option( $this->shipping_settings_key );
           $additional_fields   = (array) get_option( $this->additional_settings_key );
		   
		   
		  
		     foreach ($billing_fields as $billingkey=>$billing_field) {
			    
				  if (isset($billing_field['orderedition'])) {
					 
					 $billingkeyvalue = get_post_meta( $order->id, $billingkey, true );
				     if ( ! empty( $billingkeyvalue ) ) {
						 echo '<p><strong>'.__(''.$billing_field['label'].'').':</strong> ' . $billingkeyvalue . '</p>';
                     }						 
					 
				   }
				
			 }
		   
		   
		   
		     foreach ($shipping_fields as $shippingkey=>$shipping_field) {
			    
				   if (isset($shipping_field['orderedition'])) {
					  
					 $shippingkeyvalue = get_post_meta( $order->id, $shippingkey, true );
					 
					  if ( ! empty( $shippingkeyvalue ) ) {
						  echo '<p><strong>'.__(''.$shipping_field['label'].'').':</strong> ' . $shippingkeyvalue . '</p>';
					  }
				     
				   }
				
			 }
		   
            
		    foreach ($additional_fields as $additionalkey=>$additional_field) {
		   	    if (isset($additional_field['orderedition'])) {
					
					$additionalkeyvalue = get_post_meta( $order->id, $additionalkey, true );
				    
					if ( ! empty( $additionalkeyvalue ) ) {
					   echo '<p><strong>'.__(''.$additional_field['label'].'').':</strong> ' . $additionalkeyvalue . '</p>';
					}
					
					
                 }
		   }
	       
	 }
	 
	 public function woocommerce_custom_new_order_templace ($order) {
          
		   
		   $billing_fields      = (array) get_option( $this->billing_settings_key );
		   $shipping_fields     = (array) get_option( $this->shipping_settings_key );
           $additional_fields   = (array) get_option( $this->additional_settings_key );
		   
		     ?>
		   <br />
		   <br />
		   <table width="100%">
		    <tbody>
		    <?php
		     foreach ($billing_fields as $billingkey=>$billing_field) {
			    
				   if (isset($billing_field['emailfields'])) {
					  
				  
				     $billingkeyvalue = get_post_meta( $order->id, $billingkey, true );
					  
				        if ( ! empty( $billingkeyvalue ) ) { ?>
				          
						   <tr>
                             <th width="50%" ><?php echo $billing_field['label']; ?>:</th>
                             <td width="50%" ><?php echo $billingkeyvalue; ?></td>
                           </tr>
					   <?php	}	
			
			       }
			 }
		   
		   
		   
		   
		     foreach ($shipping_fields as $shippingkey=>$shipping_field) {
			    
				   if (isset($shipping_field['emailfields'])) {
					  
					   
				    $shippingkeyvalue = get_post_meta( $order->id, $shippingkey, true );
					  
				         if ( ! empty( $shippingkeyvalue ) ) { ?>
				          
						   <tr>
                             <th width="50%" ><?php echo $shipping_field['label']; ?>:</th>
                             <td width="50%" ><?php echo $shippingkeyvalue; ?></td>
                           </tr>
					   <?php	}	
                                   }  					
				      
                    
				
			 }
		   

		   foreach ($additional_fields as $additionalkey=>$additional_field) {
              if (isset($additional_field['emailfields'])) {
					  
			          $additionalkeyvalue = get_post_meta( $order->id, $additionalkey, true );
					
				         if ( ! empty( $additionalkeyvalue ) ) { ?>
				          
						   <tr>
                             <th width="50%" ><?php echo $additional_field['label']; ?>:</th>
                             <td width="50%" ><?php echo $additionalkeyvalue; ?></td>
                           </tr>
					   <?php	}	
				      
                     }

		   }
		   ?>
		   </tbody>
		   </table>
	       <?php  
	 }
	 
}

new pcfme_add_order_meta_class();
?>