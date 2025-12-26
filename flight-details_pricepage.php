 		<?php

  $jsonCont = file_get_contents(APPPATH."third_party/CountryCodes.json");
  $country_code  =  json_decode($jsonCont,true);
 

   if(isset($_SESSION["customer_login"]))
   {	
    $customer_emailid=$_SESSION["customer_login"]['email_id'];	
   $customer_phone_code=explode("-",$_SESSION["customer_login"]['mobile_no'])[0];	
   $customer_mobile_no = explode("-",$_SESSION["customer_login"]['mobile_no'])[1];
   } 
   else {	
   $customer_emailid="";	
   $customer_mobile_no="";	
   $customer_phone_code="";}
   $searchdata=$_SESSION['flight']['Search_data'];
   $showonardmeal  =  "no";
   if($searchdata['journeytype']=="roundtrip" and $searchdata['isdomestic']=="true"){
	    $showonardmeal  =  "yes";
   }
   if($searchdata['journeytype']=="multicity"){
	   $passport_depart_date=date("Y-m-d",strtotime(end($searchdata['departdate'])));} 
	   else {	
	   $passport_depart_date=date("Y-m-d",strtotime($searchdata['departdate']));}
	   if($searchdata['journeytype']=="roundtrip" && $searchdata['isdomestic']=='true')
		   {		$domestic="true";} else {	$domestic="false";}
	   $adtcount=$searchdata['adults'];
	   $chdcount=$searchdata['child'];
	   $infcount=$searchdata['infant'];
	   if(isset($_SESSION['flight']['responce']['FareQuoteOB'])){	
	   $responce=json_decode($_SESSION['flight']['responce']['FareQuoteOB'],true);} 
	   else {	$responce=json_decode($_SESSION['flight']['responce']['FareQuote'],true);}
	   if(isset($_SESSION['flight']['responce']['FareQuoteIB'])){	
	   $responce_ib=json_decode($_SESSION['flight']['responce']['FareQuoteIB'],true);	
	   if($responce_ib['Response']['Error']['ErrorCode']==0)	{	  	
	   $Fare_ib=$responce_ib['Response']['Result']['Fare'];		
	   $Segments_ib=$responce_ib['Response']['Result']['Segments'];		
	   $TraceId_ib=$responce_ib['Response']['Search_Token'];		
	   $flight_data_ib=$responce_ib['Response']['Result'];	 	}} 
	   if($responce['Response']['Error']['ErrorCode']==0)
	   {	/* $country_code= file_get_contents("".site_url()."assets/js/countrylistwithcode.json");   */	
   /* Start check passport required International Flights */	
   $required_passport_country=array('NP','AE','SA');	
   /* End check passport required International Flights */		/* Start Adult Dob  */	
   $active_source=array(19);	$Source=$responce['Response']['Result']['Source'];		
   /* End Adult Dob  */	$Fare=$responce['Response']['Result']['Fare'];    
   $Segments=$responce['Response']['Result']['Segments'];	
   $TraceId=$responce['Response']['Search_Token'];	
   $flight_data=$responce['Response']['Result'];/* pr($Fare); */ ?> 		
     <?php 
if (isset($_SESSION['flight']['responce']['SSROB'])) {
                $ssrdata = json_decode($_SESSION['flight']['responce']['SSROB'], true);
                $SSROBArray = gennerateSSR($ssrdata, $responce['Response']['Result']['IsLCC']);
				$_SESSION['flight']['responce']['SSROBupdate'] = json_encode($SSROBArray);;
            } else {
                $SSROBArray = array();
            }
if (isset($_SESSION['flight']['responce']['SSRIB'])) {
                $ssrdata = json_decode($_SESSION['flight']['responce']['SSRIB'], true);
                $SSRIBArray = gennerateSSR($ssrdata, $responce['Response']['Result']['IsLCC']);
				 $_SESSION['flight']['responce']['SSRIBupdate'] = json_encode($SSRIBArray);
            } else {
                $SSRIBArray = array();
            } ?>

		<?php
			$meal_price_ob=0;
		$baggage_price_ob=0;
		$meal_price_ib=0;
		$baggage_price_ib=0;
		$baggage_array_ib=array();
		$baggage_array_ob=array();
		$meal_array_ib=array();
		$meal_array_ob=array();
$coupon_amount   = 0;
$markup_value    = 0;
$discount_amount = 0;
$discount_amount_ib = 0;
 $markup_value_ib    = 0;
    $discount_amount_ib = 0;
$ob_fare_breakup = array();
if ($Segments) {
    foreach ($Segments as $fligth_markup) {
        $fligth_commetion = $Fare['Discount'] + $Fare['CommissionEarned'] + $Fare['PLBEarned'] + $Fare['IncentiveEarned'];
        $fare_type        = faretype_status($flight_data['Source']);
        if ($searchdata['isdomestic'] == "true") {
            if ($fare_type) {
                $fare_type = "Coupon";
            } else {
                $fare_type = "Normal";
            }
        } else {
            if ($fare_type) {
                $fare_type = "Coupon";
            } elseif ($fligth_commetion == null || $fligth_commetion == 0) {
                $fare_type = "Soto";
            } else {
                $fare_type = "Normal";
            }
        }
        /* Markup Calculation  */
        $airline_code = $fligth_markup[0]['Airline']['AirlineCode'];
        $flight_fare  = $Fare['PublishedFare'];
        if (isset($air_markup_array[$airline_code]) || isset($air_markup_array["ALL"])) {
            $markup_value = airline_markup_value($air_markup_array, $airline_code, $fare_type, $flight_fare);
        }
        /* Discount Amount */
        $discount_amount = round(get_discount_value($fligth_commetion, $air_discount_val));
    }
}
$ob_fare_breakup = array(
    'markup' => $markup_value,
    'discount' => $discount_amount,
    'TBO_fare' => $Fare,
    'TBO_fare_breakdown' => $responce['Response']['Result']['FareBreakdown']
);
$ib_fare_breakup = array();
if (isset($_SESSION['flight']['responce']['FareQuoteIB'])) {
   
    foreach ($Segments_ib as $fligth_markup_ib) {
        $fligth_commetion_ib = $Fare_ib['Discount'] + $Fare_ib['CommissionEarned'] + $Fare_ib['PLBEarned'] + $Fare_ib['IncentiveEarned'];
        $fare_type_ib        = faretype_status($flight_data_ib['Source']);
        if ($searchdata['isdomestic'] == "true") {
            if ($fare_type_ib) {
                $fare_type_ib = "Coupon";
            } else {
                $fare_type_ib = "Normal";
            }
        } else {
            if ($fare_type_ib) {
                $fare_type_ib = "Coupon";
            } elseif ($fligth_commetion_ib == null || $fligth_commetion_ib == 0) {
                $fare_type_ib = "Soto";
            } else {
                $fare_type_ib = "Normal";
            }
        }
        /* Markup Calculation  */
        $flight_fare_ib  = $Fare_ib['PublishedFare'];
        $airline_code_ib = $fligth_markup_ib[0]['Airline']['AirlineCode'];
        if (isset($air_markup_array[$airline_code_ib]) || isset($air_markup_array["ALL"])) {
            $markup_value_ib = airline_markup_value($air_markup_array, $airline_code_ib, $fare_type_ib, $flight_fare_ib);
        }
        /* Discount Amount */
        $discount_amount_ib = round(get_discount_value($fligth_commetion_ib, $air_discount_val));
    }
    $ib_fare_breakup = array(
        'markup' => $markup_value_ib,
        'discount' => $discount_amount_ib,
        'TBO_fare' => $Fare_ib,
        'TBO_fare_breakdown' => $responce_ib['Response']['Result']['FareBreakdown']
    );
}

?>   

<?php 
             
				

 
               foreach ($_SESSION['flight']['pax_data']['pax_details']['pax'] as $key => $pax_details) {
			   foreach ($pax_details as $pax_key => $pax_info) {
				    $meal_array =  array();
				    $baggage_array =  array();
				    $seat_array =  array();
				   if(isset($pax_info['meal'])){
                    foreach($pax_info['meal'] as $mealkey=>$meals){
                           if($mealkey=="OB"){
							   if($meals){
							   if(isset( $_SESSION['flight']['responce']['SSROBupdate'])){
								   $SSROB_data  =json_decode($_SESSION['flight']['responce']['SSROBupdate'],true);
								foreach($meals as $supersubmealkey=>$mealdata)
							   {  
							   if(isset($SSROB_data['Response']['Result']['Meal'][$supersubmealkey])){
							   foreach($mealdata as $submealkey=>$mealvalue)
							   {
								    if($mealvalue!=""){
										 $meal_array_ob[] =   $SSROB_data['Response']['Result']['Meal'][$supersubmealkey][$submealkey][$mealvalue];   
								   $meal_price_ob =  $meal_price_ob+ $SSROB_data['Response']['Result']['Meal'][$supersubmealkey][$submealkey][$mealvalue]['Price'];
									 }  
							   }}
							   }
							   } } 
						   }
						   

				   }
				   
				  
				   
			   } 
			     if(isset($pax_info['baggage'])){
                    foreach($pax_info['baggage'] as $baggagekey=>$baggage){
                           if($baggagekey=="OB"){
							    if($baggage) {
							   if(isset( $_SESSION['flight']['responce']['SSROBupdate'])){
								   $SSROB_data  =json_decode($_SESSION['flight']['responce']['SSROBupdate'],true);
								  foreach($baggage as $superbaggagekey=>$baggagedata)
							   {
 if(isset($SSROB_data['Response']['Result']['Baggage'][$superbaggagekey])){								   
							   foreach($baggagedata as $subbaggagekey=>$baggagevalue)
							   {
								    if($baggagevalue!=""){
                                   $baggage_array_ob[] =   $SSROB_data['Response']['Result']['Baggage'][$superbaggagekey][$subbaggagekey][$baggagevalue];
								   
								   $baggage_price_ob =   $baggage_price_ob+$SSROB_data['Response']['Result']['Baggage'][$superbaggagekey][$subbaggagekey][$baggagevalue]['Price'];  

									} 
 }}
							   }
							   
								} } 
						   }
				   }
				   
				    
				   
			   }
			   }}








$fare_data_show  =  array();
$total_base_fare  = 0;
$total_base_fare_ib  = 0;
$total_pax  = 0;


foreach($responce['Response']['Result']['FareBreakdown'] as $farkey=>$fare_breakup) { 
$total_paxwisefare =  0;
$total_paxwisefare_ib =  0;
$total_paxwisefare_ob =  0;


                              if($responce_ib){
									$total_paxwisefare = $responce_ib['Response']['Result']['FareBreakdown'][$farkey]['BaseFare'];
									$total_paxwisefare_ib = $responce_ib['Response']['Result']['FareBreakdown'][$farkey]['BaseFare'];
									$total_base_fare_ib+=$total_paxwisefare_ib;
									/* $total_pax+=$responce_ib['Response']['Result']['FareBreakdown'][$farkey]['BaseFare']; */
									
								}
							
								 $total_paxwisefare = $total_paxwisefare+$fare_breakup['BaseFare'];
								 $total_paxwisefare_ob = $total_paxwisefare_ob+$fare_breakup['BaseFare'];
								 $total_base_fare+=$total_paxwisefare_ob;
								$fare_data_show[$farkey] = array('fare'=>$total_paxwisefare,'paxcount'=>$fare_breakup['PassengerCount']);
								$total_pax+=$fare_breakup['PassengerCount']; 
								$onward_tax=$Fare['Tax']+$Fare['AdditionalTxnFeePub']+$Fare['ServiceFee']+$Fare['OtherCharges'];
                                   if($Fare_ib){
										  $inward_tax=$Fare_ib['Tax']+$Fare_ib['AdditionalTxnFeePub']+$Fare_ib['ServiceFee']+$Fare_ib['OtherCharges'];
										  }
										 
						



}
      
	  		if($responce_ib){
						 
						  
     foreach ($_SESSION['flight']['pax_data']['pax_details']['pax'] as $key => $pax_details) {
			   foreach ($pax_details as $pax_key => $pax_info) {
				    $meal_array =  array();
				    $baggage_array =  array();
				    $seat_array =  array();
				   if(isset($pax_info['meal'])){
                    foreach($pax_info['meal'] as $mealkey=>$meals){
                           if($mealkey=="IB"){
							   if($meals){
							   if(isset( $_SESSION['flight']['responce']['SSRIBupdate'])){
								   $SSRIB_data  =json_decode($_SESSION['flight']['responce']['SSRIBupdate'],true);
								foreach($meals as $supersubmealkey=>$mealdata)
							   {  
							   if(isset($SSRIB_data['Response']['Result']['Meal'][$supersubmealkey])){
							   foreach($mealdata as $submealkey=>$mealvalue)
							   {
								    if($mealvalue!=""){
										 $meal_array_ib[] =   $SSRIB_data['Response']['Result']['Meal'][$supersubmealkey][$submealkey][$mealvalue];   
								   $meal_price_ib =  $meal_price_ib+ $SSRIB_data['Response']['Result']['Meal'][$supersubmealkey][$submealkey][$mealvalue]['Price'];
									 }  
							   }}
							   }
							   } } 
						   }
						   

				   }
				   
				  
				   
			   } 
			     if(isset($pax_info['baggage'])){
                    foreach($pax_info['baggage'] as $baggagekey=>$baggage){
                           if($baggagekey=="IB"){
							    if($baggage) {
							   if(isset( $_SESSION['flight']['responce']['SSRIBupdate'])){
								   $SSRIB_data  =json_decode($_SESSION['flight']['responce']['SSRIBupdate'],true);
								  foreach($baggage as $superbaggagekey=>$baggagedata)
							   {
 if(isset($SSRIB_data['Response']['Result']['Baggage'][$superbaggagekey])){								   
							   foreach($baggagedata as $subbaggagekey=>$baggagevalue)
							   {
								    if($baggagevalue!=""){
                                   $baggage_array_ib[] =   $SSRIB_data['Response']['Result']['Baggage'][$superbaggagekey][$subbaggagekey][$baggagevalue];
								   
								   $baggage_price_ib =   $baggage_price_ib+$SSRIB_data['Response']['Result']['Baggage'][$superbaggagekey][$subbaggagekey][$baggagevalue]['Price'];  

									} 
 }}
							   }
							   
								} } 
						   }
				   }
				   
				    
				   
			   }
			   }}
			   $ib_fare_breakup['meal_price']	 =  $meal_price_ib;									  
$ib_fare_breakup['baggage_price']	 =  $baggage_price_ib;									  
$ib_fare_breakup['baggage_array']	 =  $baggage_array_ib;									  
$ib_fare_breakup['meal_array']	 =  $meal_array_ib;							  
					
	  
	 }

 $fare_data_show['Tax&Other-Charges'] = $onward_tax+$inward_tax+$markup_value+$markup_value_ib;
										  $fare_data_show['disount'] = $discount_amount_ib+$discount_amount;
										  $fare_data_show['total_base_fare'] = $total_base_fare+$total_base_fare_ib;
										  $fare_data_show['total_pax'] = $total_pax;
		$totalfareforconvincefee           = $fare_data_show['total_base_fare']+ $fare_data_show['Tax&Other-Charges']-$fare_data_show['disount']+$baggage_price_ob+$meal_price_ob+$meal_price_ib+ $baggage_price_ib;

				
		      if ($convenience_fee) {
                
                        if ($convenience_fee['type'] == "Fixed") {
                        
                             $conveniencefee = round($convenience_fee['value']); 
                           
                        } else {

                            $conveniencefee = round(($totalfareforconvincefee * $convenience_fee['value']) / 100);
                           
                          
                        }

                       
                        $_SESSION['flight']['convenience_fee'] = $conveniencefee;
                       
                    
                } else {
                    $conveniencefee = 0;
                    $conveniencefee_without_markup = 0;
                }				
				 $fare_data_show['conveniencefee'] = $conveniencefee;		



$coupon_amount =0;								  
										  
	$ob_fare_breakup['meal_price']	 =  $meal_price_ob;									  
$ob_fare_breakup['baggage_price']	 =  $baggage_price_ob;									  
$ob_fare_breakup['baggage_array']	 =  $baggage_array_ob;									  
$ob_fare_breakup['meal_array']	 =  $meal_array_ob;												  
										  
	$_SESSION['flight']['fare_breakup']['customer'] = array(
    'OB_fare' => $ob_fare_breakup,
    'IB_fare' => $ib_fare_breakup,
    'coupon_discount' => ''
);									  
										  
$_SESSION['flight']['totalprice'] = round($fare_data_show['total_base_fare']+ $fare_data_show['Tax&Other-Charges']-$fare_data_show['disount']+$fare_data_show['conveniencefee']+$baggage_price_ob+$meal_price_ob+$meal_price_ib+ $baggage_price_ib);
$_SESSION['flight']['pax_data']['totalprice'] = round($_SESSION['flight']['totalprice']);

?>

        	 <!--Flight Detail-->
			
               

   
         <div class=" m-0">
            <div class="col-12 border-bottom p-0">
              <div class="col-12 pt-1">
              <div class="row">
                  <div class="col-8">
              <div class="fare_item_title d-flex align-items-center">
                <span class="d-block cp"><span class="nh_color fs_12">Base Fare</span><span class="p_color fs_12 pl-1">(<?php echo $fare_data_show['total_pax']; ?> Traveller) <i class="fa fa-angle-down fs_8"></i></span></span>
              </div>
            </div>        	
            <div class="col-4 text-right">
              <div class="fare_item_value d-flex align-items-center nh_color fs_12 justify-content-end"><i class="fa fa-rupee fs_10 pr-1"></i> <span><?php echo $fare_data_show['total_base_fare']; ?></span></div>
            </div>
            <div class="col-12">
              <div class="hidden_charges ">
			  <?php if(isset($fare_data_show['ADT'])) {?>
                <div class="row"> 
                <div class="col-8">
				
                  <span class="d-block"><span class="nh_color fs_12">Adult </span><span class="p_color fs_12 pl-1">x <?php echo 	$fare_data_show['ADT']['paxcount']?></span></span>
              </div>
              <div class="col-4 text-right">
                <div class="fare_item_value d-flex align-items-center nh_color fs_12 justify-content-end"><i class="fa fa-rupee fs_10 pr-1"></i> <span><?php echo 	$fare_data_show['ADT']['fare']?></span></div>
              </div>
              </div>
			  <?php } ?> 
			  <?php if(isset($fare_data_show['CHD'])) {?>
                <div class="row m-0"> 
                <div class="col-8">
				
                  <span class="d-block"><span class="nh_color fs_12">Child </span><span class="p_color fs_12 pl-1">x <?php echo 	$fare_data_show['CHD']['paxcount']?></span></span>
              </div>
              <div class="col-4 text-right">
                <div class="fare_item_value d-flex align-items-center nh_color fs_12 justify-content-end"><i class="fa fa-rupee fs_10 pr-1"></i> <span><?php echo 	$fare_data_show['CHD']['fare']?></span></div>
              </div>
              </div>
			  <?php } ?>  
			  <?php if(isset($fare_data_show['INF'])) {?>
                <div class="row m-0"> 
                <div class="col-8">
				
                  <span class="d-block"><span class="nh_color fs_12">Infant </span><span class="p_color fs_12 pl-1">x <?php echo 	$fare_data_show['INF']['paxcount']?></span></span>
              </div>
              <div class="col-4 text-right">
                <div class="fare_item_value d-flex align-items-center nh_color fs_12 justify-content-end"><i class="fa fa-rupee fs_10 pr-1"></i> <span><?php echo 	$fare_data_show['INF']['fare']?></span></div>
              </div>
              </div>
			  <?php } ?>
              </div>
            </div>
              </div>
            </div>
            <div class="col-12 pb-1 pt-1">
              <div class="row">
                  <div class="col-8">
              <div class="fare_item_title_2 d-flex align-items-center">
                <span class="d-block cp"><span class="nh_color fs_13">Fee & Surcharges  <!--<i class="fa fa-angle-down fs_8"></i>--></span>
              </span>
              </div>
            </div>
            <div class="col-4 text-right">
              <div class="fare_item_value d-flex align-items-center nh_color fs_13 justify-content-end"><i class="fa fa-rupee fs_10 pr-1"></i> <span><?php echo round($fare_data_show['Tax&Other-Charges']); ?></span></div>
            </div>
         
              </div>
			  <?php  if($meal_price_ob) {?>
			     <div class="fare">
                                                           <div class="row"><div class="col-md-8"> <span class="nh_color fs_13"><?php if($showonardmeal=="yes") { echo  "Onward"; }?> Meal</span></div> <div class="col-md-4 fare_item_value d-flex align-items-center nh_color fs_13 justify-content-end"><span><i class="fa fa-inr" aria-hidden="true"></i><span class = "">&nbsp; <?php echo  $meal_price_ob; ?>	</span></span>  </div> </div>
                                                        </div>
	   <?php }  ?>
	   <?php  if($baggage_price_ob) {?>
														<div class="fare">
                                                            <div class="row"><div class="col-md-8"> <span class="nh_color fs_13"><?php if($showonardmeal=="yes") { echo  "Onward"; }?>  Baggage</span></div> <div class="col-md-4 fare_item_value d-flex align-items-center nh_color fs_13 justify-content-end"><span><i class="fa fa-inr" aria-hidden="true"></i><span class = "">&nbsp; <?php echo  $baggage_price_ob; ?>	</span></span>  </div> </div>
                                                        </div>
	   <?php } ?>	  <?php  if($meal_price_ib) {?>
			     <div class="fare">
                                                           <div class="row"><div class="col-md-8"> <span class="nh_color fs_13">Return Meal</span></div> <div class="col-md-4 fare_item_value d-flex align-items-center nh_color fs_13 justify-content-end"><span><i class="fa fa-inr" aria-hidden="true"></i><span class = "">&nbsp; <?php echo  $meal_price_ib; ?>	</span></span>  </div> </div>
                                                        </div>
	   <?php }  ?>
	   <?php  if($baggage_price_ib) {?>
														<div class="fare">
                                                            <div class="row"><div class="col-md-8"> <span class="nh_color fs_13">Return Baggage</span></div> <div class="col-md-4 fare_item_value d-flex align-items-center nh_color fs_13 justify-content-end"><span><i class="fa fa-inr" aria-hidden="true"></i><span class = "">&nbsp; <?php echo  $baggage_price_ib; ?>	</span></span>  </div> </div>
                                                        </div>
	   <?php } ?>
			  <?php  if($fare_data_show['disount']) { ?>
			    <div class="row">
                  <div class="col-8">
              <div class="fare_item_title_2 d-flex align-items-center">
                <span class="d-block cp"><span class="nh_color fs_13">Discount  <!--<i class="fa fa-angle-down fs_8"></i>--></span>
              </span>
              </div>
            </div>
            <div class="col-4 text-right">
              <div class="fare_item_value d-flex align-items-center nh_color fs_13 justify-content-end"><i class="fa fa-rupee fs_10 pr-1"></i> <span><?php echo round($fare_data_show['disount']); ?></span></div>
            </div>
           
              </div>
			  
			  <?php  }  ?>
			    <?php  if($fare_data_show['conveniencefee']) { ?>
			    <div class="row">
                  <div class="col-8">
              <div class="fare_item_title_2 d-flex align-items-center">
                <span class="d-block cp"><span class="nh_color fs_13">Convenience fee  <!--<i class="fa fa-angle-down fs_8"></i>--></span>
              </span>
              </div>
            </div>
            <div class="col-4 text-right">
              <div class="fare_item_value d-flex align-items-center nh_color fs_13 justify-content-end"><i class="fa fa-rupee fs_10 pr-1"></i> <span><?php echo round($fare_data_show['conveniencefee']); ?></span></div>
            </div>
           
              </div>
			  
			  <?php  }  ?>
            </div>
            </div>
            <div class="col-12 pt-1 pb-1">
              <div class="row">
                <div class="col-7">
                  <span class="fs_15 nh_color">Total Fare</span>
                </div>
                <div class="col-5 text-right">
                <div class="fare_item_value d-flex align-items-center nh_color fs_15 justify-content-end"><i class="fa fa-rupee fs_14 pr-1"></i> <span><?php echo $_SESSION['flight']['totalprice']; ?></span></div>
                </div>
                  <div class="col-12">
        	<div  id="" class=" mycoupon_div">
											<table  border="0" class="w-100">
											<tr>	
									<?php if(isset($_SESSION['flight']['coupon_info'])) { 
									 
										$coupon_amount=$_SESSION['flight']['coupon_info']['coupon_amount'];
										
									?>
										
										
									
										
								<td class="col rit" style="width: 108px;border-color: #fff;">
											Coupon Discount
											</td>
                                            
                                            	<td class="col rit" style="width: 108px;border-color: #fff;">
											&nbsp
											</td>
                                          
                                            <td class="col rit"  style="border-color: #fff; font-size: 13px; width: 90px;     position: relative;
    top: -9px;
    font-size: 13px;">
											<i class="fa fa-inr" aria-hidden="true"></i>&nbsp; <?php echo change_money_format($coupon_amount); ?>
											</td>
                                              <?Php }  else {$coupon_amount =0;}
											  $_SESSION['flight']['totalprice'] = $_SESSION['flight']['totalprice']-$coupon_amount;
											  
											  ?>
											</tr>
										</table>
										</div>
            </div>
              </div>
            </div>
            <div class="col-12 pt-1 pb-2 total_final_payment_block">
              <div class="total_final_payment">
                <div class="row">
                  <div class="col-7">
                    <span class="p_color fs_15">You Pay :</span>
                  </div>
                  <div class="col-5 text-right">
                    <div class="fare_item_value d-flex align-items-center nh_color fs_15 fw_5 justify-content-end"><i class="fa fa-rupee fs_15 pr-1"></i> <span class  = "publish_ob"><?php echo $_SESSION['flight']['totalprice']; ?></span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>   
        	<?php  }  else { ?><?php } ?>






