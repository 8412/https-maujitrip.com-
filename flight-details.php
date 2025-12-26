<?php  $this->load->view("include/header"); ?>

<?php  if($_SESSION['flight']['responce']) { ?>
   <section class="flight_details_page grey_bg1">
   <div class="container">		 		
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
      <div class=" row">
      	 <div class="head_fly_data col-md-12 mt-4">
            <ol class="pl-0">
               <li><span class="review_time"></span></li>
               <li >1. Review </li>
               <li><span class="pay_data"></span></li>
               <li >2. Travellers</li>
               <li><span class="pay_data"></span></li>
               <li>3. Payment</li>
            </ol>
         </div>  		  		 		 		 		 		 		 		 		 
        <div class="col-md-9 mt-3">
		<?php
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
$_SESSION['flight']['fare_breakup']['customer'] = array(
    'OB_fare' => $ob_fare_breakup,
    'IB_fare' => $ib_fare_breakup,
    'coupon_discount' => ''
);
?>   

<?php 

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
 $fare_data_show['Tax&Other-Charges'] = $onward_tax+$inward_tax+$markup_value+$markup_value_ib;
										  $fare_data_show['disount'] = $discount_amount_ib+$discount_amount;
										  $fare_data_show['total_base_fare'] = $total_base_fare+$total_base_fare_ib;
										  $fare_data_show['total_pax'] = $total_pax;
		$totalfareforconvincefee           = $fare_data_show['total_base_fare']+ $fare_data_show['Tax&Other-Charges']-$fare_data_show['disount'];

				
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
										  
										  
										  
										  
										  
$_SESSION['flight']['totalprice'] = round($fare_data_show['total_base_fare']+ $fare_data_show['Tax&Other-Charges']-$fare_data_show['disount']+$fare_data_show['conveniencefee']);

?>
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


			



        	 <!--Flight Detail-->
			
               <div class="flight_pay mb-3">
                  <div class="head_name fw_500"><span>Flight Details</span></div>
                  <div class="data_box border_itiniary">
                        <div class="">	<?php	if($Segments)  {	unset($totaltraveltime,$layovervalue,$layover_time,$segment_time,$layover,$total_duration_segment);	foreach($Segments as $segkey=>$Segment) { 	unset($totaltraveltime,$layovervalue,$layover_time,$segment_time,$layover,$total_duration_segment);			$first_segment = reset($Segment); 		    $end_segment = end($Segment); 			$_SESSION['flight']['primary_onward_airline_code']=$first_segment['Airline']['AirlineCode'];					foreach($Segment as $detailkey=>$flight_segvia)			{				$layover_time[]=$flight_segvia['Origin']['AirportCode']."_".$flight_segvia['Origin']['DepartTime'];				$layover_time[]=$flight_segvia['Destination']['AirportCode']."_".$flight_segvia['Destination']['ArrivalTime'];				 $middletime=journey_time($flight_segvia['Origin']['AirportCode'],$flight_segvia['Destination']['AirportCode'],$flight_segvia['Origin']['DepartTime'],$flight_segvia['Destination']['ArrivalTime']);				$segment_time[]=hour_minute_format_remove($middletime);				$total_duration_segment[]  =  $flight_segvia['Duration'];   															} 			$layover=layovertime($layover_time);			$layovervalue[$segkey]=$layover;			// $totaltraveltime[]=total_travel_duration($layover,$segment_time);	?>
                           <div class="data_itinary">
                              <span class="time_itinary">Total Time: <?php  $total_duration  = get_total_duration($total_duration_segment); echo  $total_duration;  ?> </span>
							  <?php if($segkey==1 and $searchdata['journeytype']=="roundtrip")  { ?>
                              <div class=" clearfix">
                                 <span class="data_review gray ">Return </span>
                              </div>
							  <?php }  else { ?>
							  <div class=" clearfix">
                                 <span class="data_review gray ">Departure</span>
                              </div>
							  <?php } ?>
                              <div class="pt-2 pb-2">                             <?php foreach($Segment as $detailkey=>$segment_detail) {			?>
                                 <article class="row show_article">
                                    <div class="text-center img_left  col-md-2 col-2">
                                       <img src="<?php echo base_url(); ?>webroot/airline-images/<?php echo $segment_detail['Airline']['AirlineCode']; ?>.png" alt="<?php echo $segment_detail['Airline']['AirlineCode']; ?>" class="logo d-inline" alt="flight logo"> 
                                       <span class="ib fs-12 gray  d-block"><?php echo $segment_detail['Airline']['AirlineName']; ?>
                                       <span class="light_gray  d-block"><?php echo $segment_detail['Airline']['AirlineCode']; ?>-<?php echo $segment_detail['Airline']['FlightNumber']; ?></span>
                                       </span>
                                       <span class="fs-xs gray block"><?php echo getcrafttype($segment_detail['Craft']); ?></span>
                                    </div>
                                    <div class="col-sm-10 col-lg-9 col-10 bdr border_left   ">
                                       <div class="row destiny_margin">
                                          <div class="col-xs-6 col-md-3 col-4">
                                             <p class="push_size  mb-0"><?php echo $segment_detail['Origin']['CityName']; ?>, <?php echo $segment_detail['Origin']['CountryCode']; ?></p>
                                             <h3 class="fs_20 lh28 bold"><?php   echo tbo_flight_time($segment_detail['Origin']['DepartTime']); ?></h3>
                                             <p class=" gray lh18">
                                                <span class="bold"><?php echo tbo_flight_date($segment_detail['Origin']['DepartTime']); ?></span>
                                                <br>
                                                <span class="light_gray"><?php echo $segment_detail['Origin']['AirportName']; ?>                                                  <?php if($segment_detail['Origin']['Terminal']!=="") { ?>
                                                <span>, T-<?php echo $segment_detail['Origin']['Terminal']; ?></span>																								  <?php }  ?>
                                                </span>
                                             </p>
                                          </div>
                                       <div class="col-sm-12 col-4 dot_flight align_tabpost col-md-6 col-lg-6 ">
                                        <p class="mb-0 hidden-md-up"> <?php echo $searchdata['cabinclass']; ?> </p>
                                                <p class="d-flex align-items-center justify-content-center mb-0">                                                                                
                                                <label class="testdur d-block mb-0" data-toggle="tooltip" data-placement="top" title="CabinBaggage | Baggage "><i class="fa fa-suitcase"></i> <?php echo $segment_detail['CabinBaggage']; ?>     <?php echo $segment_detail['Baggage']; ?></label>
                                                <span class="d-none d-md-block"><span class="gray_super pl-2 pr-2">|</span> <?php echo $searchdata['cabinclass']; ?>   </span>   

                                              </p>
                                              <p class="hidden-md-up mb-0"><?php echo time_duration($segment_detail['Origin']['DepartTime'],$segment_detail['Destination']['ArrivalTime']); ?> </p>
                                            <label class="detduration  pr-2 d-none d-md-block">
                                       <i class="dot"></i>
                                       <span class="text "><?php echo time_duration($segment_detail['Origin']['DepartTime'],$segment_detail['Destination']['ArrivalTime']); ?></span>
                                       <i class="plain">✈</i>
                                       </label>
                                          
                                            
                                           <!--   <i class="" style="right: 10px;"></i>
 -->                                             <span class="title_ref ">                             
                                                <?php if($responce['Response']['Result']['IsRefundable']) { ?>                         
                                                  <label class="refundable">Refundable</label>             <?php } else { ?>             <label class="nonrefundable">Non Refundable</label>               <?php } ?>
                                         
                                             </span>
                                             <div class="layover">            <samp>                                                 <?php                                                                         if(isset($layovervalue[$segkey][$detailkey]))                 {              echo $segment_detail['Destination']['CityName'];                  if($layovervalue[$segkey][$detailkey]) {                    echo " | Layover: ".covertintoHM($layovervalue[$segkey][$detailkey]);                  }                 } ?></samp>       </div>
                                          </div>
                                          <div class="col-xs-6 col-4 push_size absolute_size col-md-3 text-right">
                                             <p class="push_size  mb-0"><?php echo $segment_detail['Destination']['CityName']; ?>, <?php echo $segment_detail['Destination']['CountryCode']; ?></p>
                                             <h3 class="fs_20 lh28 bold"><?php   echo tbo_flight_time($segment_detail['Destination']['ArrivalTime']); ?></h3>
                                             <p class="fs-sm gray lh18">
                                                <span class="bold d-block"><?php echo tbo_flight_date($segment_detail['Destination']['ArrivalTime']); ?></span>
                                                <span class="light_gray "><?php echo $segment_detail['Destination']['AirportName']; ?>
                                                <?php if($segment_detail['Destination']['Terminal']!=="") { ?>
                                            , T-<?php echo $segment_detail['Destination']['Terminal']; ?>																						 <?php }  ?>
                                                </span>
                                             </p>
                                          </div>
         
                                       </div>
                                    </div>
                                 </article>							 <?php  } ?>
                              </div>
                           </div>	<?php  }  } ?>
                        </div>
                     </div>
            </div>
	<?php 
	

	if(($responce_ib['Response']['Error']['ErrorCode'] == 0) and ($Segments_ib) )	{	?>
     <div class="flight_pay mb-2">

         <div class="head_name fw_500"><span>Flight Details</span></div>
                  <div class="data_box border_itiniary">
                        <div class="">                      	
						<?php			if($Segments_ib) {	unset($totaltraveltime_ib,$layovervalue_ib,$layover_time_ib,$segment_time_ib,$layover_ib,$total_duration_segmentib);	foreach($Segments_ib as $segkey=>$Segment) { 	unset($totaltraveltime_ib,$layovervalue_ib,$layover_time_ib,$segment_time_ib,$layover_ib,$total_duration_segmentib);			$first_segment = reset($Segment); 		    $end_segment = end($Segment);				$_SESSION['flight']['primary_return_airline_code']=$first_segment['Airline']['AirlineCode'];				foreach($Segment as $detailkey=>$flight_segvia)			{				$layover_time_ib[]=$flight_segvia['Origin']['Airport']['AirportCode']."_".$flight_segvia['Origin']['DepartTime'];				$layover_time_ib[]=$flight_segvia['Destination']['Airport']['AirportCode']."_".$flight_segvia['Destination']['ArrivalTime'];				 $middletime=journey_time($flight_segvia['Origin']['Airport']['AirportCode'],$flight_segvia['Destination']['Airport']['AirportCode'],$flight_segvia['Origin']['DepartTime'],$flight_segvia['Destination']['ArrivalTime']);				$segment_time_ib[]=hour_minute_format_remove($middletime);				$total_duration_segmentib[]  =  $flight_segvia['Duration'];   			} 			$layover_ib=layovertime($layover_time_ib);			$layovervalue_ib[]=$layover_ib;			// $totaltraveltime_ib[]=total_travel_duration($layover,$segment_time_ib);	?>
                           <div class="data_itinary">
                              <span class="time_itinary">Total Time: <?php  $total_duration  = get_total_duration($total_duration_segmentib); echo  $total_duration;  ?> </span>
                              <div class=" clearfix">
                                 <span class="data_review gray ">Return</span>
                              </div>
                              <div class="pt-2 pb-2">                                    
                                 <?php foreach($Segment as $detailkey=>$segment_detail) {					?>
                                 <article class="row show_article">
                                    <div class="text-center img_left  col-md-2 col-2">
                                       <img src="<?php echo base_url(); ?>webroot/airline-images/<?php echo $segment_detail['Airline']['AirlineCode']; ?>.png" class="logo d-inline" alt="flight logo"> 
                                       <span class="ib fs-12 gray d-block"><?php echo $segment_detail['Airline']['AirlineName']; ?>
                                       <span class="light_gray d-block"><?php echo $segment_detail['Airline']['AirlineCode']; ?>-<?php echo $segment_detail['Airline']['FlightNumber']; ?></span>
                                       </span>
                                       <span class="fs-xs gray block"><?php echo getcrafttype($segment_detail['Craft']); ?></span>
                                    </div>
                                    <div class="col-sm-10 col-lg-9 col-10 bdr border_left">
                                       <div class="row destiny_margin">
                                          <div class="col-xs-6 col-md-3 col-4">
                                             <p class="push_size  mb-0"><?php echo $segment_detail['Origin']['CityName']; ?>, <?php echo $segment_detail['Origin']['CountryCode']; ?></p>
                                             <h3 class="fs_20 lh28 bold"><?php   echo tbo_flight_time($segment_detail['Origin']['DepartTime']); ?></h3>
                                             <p class=" gray lh18">
                                                <span class="bold d-block"><?php echo tbo_flight_date($segment_detail['Origin']['DepartTime']); ?></span>
                                                <span class="light_gray d-flex align-items-center"><?php echo $segment_detail['Origin']['AirportName']; ?>
                                                <?php if($segment_detail['Origin']['Terminal']!=="") { ?>   , T-<?php echo $segment_detail['Origin']['Terminal']; ?>								<?php } ?>
                                                </span>
                                             </p>
                                          </div>
                                                  <div class="col-sm-12 col-4 dot_flight align_tabpost col-md-6 col-lg-6 ">
                                                    <p class="mb-0 hidden-md-up"><?php echo $searchdata['cabinclass']; ?></p>
                                                    <p class="d-flex align-items-center justify-content-center mb-0">   
                                                        <label class="testdur d-block mb-0" data-toggle="tooltip" data-placement="top" title="CabinBaggage | Baggage "><i class="fa fa-suitcase"></i> <?php echo $segment_detail['CabinBaggage']; ?>  <?php echo $segment_detail['Baggage']; ?></label>                                                                             
                                               <span class="d-none d-md-block"> <span class="gray_super pl-md-2 pl-1 pr-1 pr-md-2 ">|</span> <?php echo $searchdata['cabinclass']; ?> 
</span>
                                             </p>
                                             <p class="hidden-md-up mb-0"><?php echo time_duration($segment_detail['Origin']['DepartTime'],$segment_detail['Destination']['ArrivalTime']); ?></p>
                                            <label class="detduration d-none  d-md-block pr-2">
                                       <i class="dot"></i>
                                       <span class="text "><?php echo time_duration($segment_detail['Origin']['DepartTime'],$segment_detail['Destination']['ArrivalTime']); ?></span>
                                       <i class="plain">✈</i>
                                       </label>
                                        
                                          
                                            <!--  <i class="" style="right: 10px;"></i> -->
                                             <span class="title_ref "><?php if($responce['Response']['Result']['IsRefundable']) { ?>                                                    <label class="refundable">Refundable</label>                                        <?php } else { ?>                                            <label class="nonrefundable">Non Refundable</label>                                         <?php } ?></span>
                                               <div class="layover">            <samp>                                                 <?php if(isset($layovervalue_ib[$segkey][$detailkey]))                 {              echo $segment_detail['Destination']['CityName'];                  if($layovervalue_ib[$segkey][$detailkey]) {                    echo " | Layover: ".covertintoHM($layovervalue_ib[$segkey][$detailkey]);                  }                 } ?></samp>       </div>
                                          </div>
                                          <div class="col-xs-6 col-4 push_size absolute_size col-md-3 text-right">
                                             <p class="push_size  mb-0"><?php echo $segment_detail['Destination']['CityName']; ?>, <?php echo $segment_detail['Destination']['CountryCode']; ?> </p>
                                             <h3 class="fs_20 lh28 bold"><?php   echo tbo_flight_time($segment_detail['Destination']['ArrivalTime']); ?></h3>
                                             <p class="fs-sm gray lh18">
                                                <span class="bold "><?php echo tbo_flight_date($segment_detail['Destination']['ArrivalTime']); ?></span>
                                                <br>
                                                                                       <span class="light_gray"><?php echo $segment_detail['Destination']['AirportName']; ?>                                                     <?php if($segment_detail['Destination']['Terminal']!=="") { ?>                                                <span  >, T-<?php echo $segment_detail['Destination']['Terminal']; ?></span>																									 <?php }  ?>                                                </span>
                                                </span>
                                             </p>
                                          </div>
                                  
                                       </div>
                                    </div>
                                 </article>									<?php } ?>
                              </div>
                           </div>		<?php } } ?>
                        </div>
                     </div>
            </div>
	<?php  } ?>


 <?php if(!isset($_SESSION["customer_login"]))
{ ?>
<div class="row trav_info pt-3 mb-2">
         <div class="col-md-8 col-8 d-flex mob_bot14">
          <img src="<?php echo site_url('/');?>/webroot/images/lock_login.svg" alt="gst" title="gst" class="img-fluid" style="    margin-right: 10px; width: 34px;     margin-top: -10px;"> 
          <p class="fs_14 fw_5  mb-0">Log-in to your <?php  echo $this->company_info['company_name'];?> account </p>
         </div> 		


          <div class="col-md-4 col-4 cont_g text-right mb-2">
          <a href="javascript:void(0);" data-toggle="modal" data-target="#loginmodal" class="continue_guest1">Login</a>
         </div>      
     </div> 
<?php } else { ?>

<?php  }  ?>
 <form  id="traveller_details"  data-travelform="true">
          <div class="row">
  <div class="col-md-12 mb-2 mt-2">
              <div class="flight_details_box pt-2 pb-2 ">
                <div class="row m-0">
                  <div class="col-2 col-md-1  d-flex align-items-center">
                    <div class="text-right w-100">
                      <img src="<?php echo site_url('/');?>/webroot/images/gst.png" alt="gst" title="gst" class="img-fluid">
                    </div>
                  </div>
                  <div class="col-7 col-md-9 d-flex align-items-center">
                    <div class="row">
                      <div class="col-12">
                        <p class="fs_16 fw_5  mb-0">Add your GST Details  <span class="font-weight-normal fs_12 p_color">(Optional)</span>
                        </p>
                      </div>
                      <div class="col-12">
                        <p class="fs_12 p_color mb-0">Claim credit of GST charges. Your taxes may get updated post submitting your GST details.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-3 col-md-2 align-items-center d-flex ">
          
            <div id="div_gst" class="col-md-12 p-0">
      <a href="javascript:void(0);" class="raj_pointer raj_link addgst"  gstattribute   = "add" onclick  =  "gstdivshowhid(this)">
    Add   </a>
      </div>
                    <!--<div class="add_gst cp">Add</div>-->
                    
                  </div>
                  <div class="col-md-12 mr-auto" addgstdata = "true">
                  <?php if((isset($responce['Response']['Result']['IsGSTMandatory'])&&$responce['Response']['Result']['IsGSTMandatory']==true) || (isset($responce_ib['Response']['Result']['IsGSTMandatory'])&&$responce_ib['Response']['Result']['IsGSTMandatory']== true)) { ?>
		  
      <div class="modal-body">
        <div class="row inside "> 
        <div class="col-lg-6 col-sm-6 col-12 mb10">
          <label>GST Number *</label>
          <input type="text" name="gst[gst_number]" class="form-control inputtext" placeholder="GST Number" data-validation="required length" data-validation-length="min15|max15" data-validation-help = "GST NO. Compulsory 15 digit"> 
        </div>
        <div class="col-lg-6 col-sm-6 col-12 mb10 form_errormsg">
          <label>GST Company Name *</label>
          <input type="text" name="gst[gst_company_name]" class="form-control inputtext" placeholder="GST Company Name" data-validation="required" > 
        </div>
        <div class="col-lg-6 col-sm-6 col-12 mb10 form_errormsg">
          <label>GST Company Contact No *</label>
          <input type="text" name="gst[gst_company_contact_no]" class="form-control inputtext"  placeholder="GST Company Contact No" data-validation="required number"> 
        </div>
        <div class="col-lg-6 col-sm-6 col-12 mb10 form_errormsg">
          <label>GST Company Email  *</label>
          <input type="text" name="gst[gst_company_email]" class="form-control inputtext"  placeholder="GST Company Email" data-validation="email" > 
        </div>
        <div class="col-lg-6 col-sm-6 col-12 mb10 form_errormsg">
          <label>GST Company Address *</label>
          <input type="text" name="gst[gst_company_address]" class="form-control inputtext" placeholder="GST Company Address" data-validation="required"> 
        </div>
      <div class="col-12 pt15">
        <p><strong>Please Note:</strong> Your taxes may get updated post submitting your GST details. Please review the final amount in Fare Details.</p>
      </div>
           
    </div>   
      </div> <!-- modal body end -->
	
	
	<?php } ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
      <!--  GST end -->





<!-- cancelation end -->


<!-- Contact Information -->
            <div class="booking_details_title mt-2">
             <div class="d-flex align-items-center ml-2"><img src="<?php echo site_url('/'); ?>webroot/images/tourist.png" alt="flight"> <span class="ml-3">Traveller Information </span></div>
            </div>
            <div class="pb-3 pt-3 mb-2 ralative_hide mob_p0 contact_information flight_details_box col"  data-stepone-show =  "true">
             
                <div class="col-md-12 mr-auto pr-0">
                  <article class="row paxinfo  pt-3 pb-3">
                    <div class="col-lg-2 col-sm-2 col-12 align-self-center inner_heading_details_page fw_5 nh_color fs_15 pl-0">Contact Detail</div>
                    <div class="col-md-10 pl-0">
                      <div class="row">
                        <div class="col-lg-5 col-sm-4 col-12 form_errormsg plr6 m_mb10 has-error">
                      <input type="email" name="contact_email" class="form-control inputtext text_validation" placeholder="  Your Email" value="<?php echo   $customer_emailid;?>" data-validation="email">
                    </div>
                        <div class="col col-lg-7">
                          <div class="row">
                            <div class="col-md-4 col-5 form_errormsg mob_flight_mob_no pr-0">
                              <select name="phone_code" id="phone_code" class="form-control inputtext phonecode  border-right-0 rounded-left">
							  
							  <?php  foreach($country_code as $country_codes) { 
							  
							  
							  if($country_codes['dial_code']== 91){
							  echo  "<option value  =".$country_codes['dial_code']." selected>".$country_codes['name']."  ( + ".$country_codes['dial_code']." )</option>";
							  } 
							  else {
								  
								echo  "<option value  =".$country_codes['dial_code'].">".$country_codes['name']."( + ".$country_codes['dial_code']." )</option>";
							    
							  }}
							  ?>
							  
							  
							  
                               
                       
                              </select>
                            </div>
                            <div class="col-md-8 col-7 pl-0 mob_flight_mobnum">
                              <input type="text" name="contact_no" class="w-100 form-control inputtext numtext text_validation rounded-right" placeholder="Mobile No" value="<?php echo    $customer_mobile_no;?>" onkeypress="return isNumber(event)"   maxlength="10">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col"></div>
                    <div class="col-md-9 col-12">
                      <p class=" w-100 text-center  mb-0 pt-1 pb-3 fs_15 p_color">Your booking details will be sent to this email address and mobile number.</p>
                    </div>
					
					
					
					<div  class  =  "row" travelinfo =  "true" style  =  "width: 100%;">
					 <?php for($i=1;$i<=$adtcount;$i++){  $paxtype="Adult";  ?>
                    <div class="col-md-2 col-sm-2 col-12 form_errormsg inner_heading_details_page fw_5">Adult <?php echo $i; ?></div>
                    <div class="col-md-10 pr-0">
                      <div class="row m-0 ">
                        <div class="col-4 col-md-2 mb_15 pl-0 pr-0">
                         <select  class="form-control inputtext text_validation " data-validation="required" data-validation-error-msg="Required" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][title]">
                         <option value="">Title</option>
                         <option value="Mr">Mr</option>
                         <option value="Ms">Ms</option>
                         <option value="Mrs">Mrs</option>
                         <option value="Miss">Miss</option>   
                         <option value="Mstr">Mstr</option> 
                         </select>
                        </div>
                        <div class="col-lg-4 plr6 mb15 col-8 form_errormsg pl-0 pr-0">
                       <input type="text"  class="form-control inputtext text_validation" data-validation="required" placeholder="First Name" data-validation-error-msg="Enter First Name" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][first_name]">
                      </div>
                        <div class="col-lg-4 form_errormsg plr6 mb15 col-12 pr-0 pl-0">
                          <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][last_name]" class="form-control inputtext text_validation" placeholder="Last Name" >
                        </div>
                      <div class="col-lg-2 plr6 mb15 col-12 pl-0 pr-0 dob_dateicon form_errormsg has-error">
        <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][dob]" class="form-control inputtext text_validation adult_date" data-validation="required" placeholder="DOB" data-validation-error-msg="Enter DOB">
        <i class="fa fa-calendar dateicon"></i>
      </div> 

       </div>
        </div>
						<?php if (in_array($Source, $active_source)) { ?>

	
			<?php } ?>
			<?php if($searchdata['isdomestic']=='false') { ?>
			
			<div class="col-12 row passportparent pr-0" attr-parent> 
				<div class="col-lg-12 ">
				<p class="passport_title">Required (Passport ) </p>
				<div class="col-12" attr-optionalshow="true">				
				<div class="row  gray_bg passfield">				
					<div class="col-12 text_pasp">
						 Passport Details 
					</div>
					<div class="col-md-3 col-sm-6 col-12 plr6 mb15 form_errormsg">
						<input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][nationality]" class="form-control inputtext" data-validation="required " placeholder="Nationality" data-validation-error-msg="Enter Nationality">
					</div>
					<div class="col-md-3 col-sm-6 col-12 plr6 mb15 form_errormsg">
						<input type="text"  name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][passport]" class="form-control inputtext" placeholder="Passport No" data-validation="length alphanumeric"  data-validation-help="passport no must be between 8-15 characters" data-validation-length="8-15" data-validation-error-msg="Enter Passport Number" maxlength="15">
					</div>
					<div class="col-md-3 col-sm-6 col-12   plr6 mb15 form_errormsg">
						<input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][passport_issue_date]" class="form-control inputtext raj_pr30 passport_issue" placeholder="Passport issue"  data-validation-error-msg="Passport issue date">
						<i class="fa fa-calendar dateicon"></i>
					</div> 
					<div class="col-lg-3 col-md-3 col-sm-6 col-12 datedv plr6  mb15 form_errormsg">
						<input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][passport_exp_date]" class="form-control inputtext raj_pr30 passport_expiry"  placeholder="Passport Expiry" data-validation-error-msg="Passport expiry date">
						<i class="fa fa-calendar dateicon"></i>
					</div>
				</div>
				</div>
				</div>
			</div>
			<?php } ?>
	<?php if ($SSROBArray) {
   if ($SSROBArray['Response']['Error']['ErrorCode'] == "0") { ?>
  <div class  =  "col-md-12"> 
  
<div class="row clearfix">
   <!-- Start  select meal preferences -->
   <?php if(isset($SSROBArray['Response']['Result']['Meal'])) { foreach ($SSROBArray['Response']['Result']['Meal'] as $supermealkey => $meal_details) {
      foreach($meal_details as $mealkey=>$meal_detail){
      
           ?>
   <div class="col-md-4 text-left mb15">
      <label> Meal Preferences :
      <b><?php if($mealkey) { echo str_replace("_", "-", $mealkey); } ?></b>
      </label>
      <select class="form-control inputtext"
         name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][meal][OB][<?php echo $supermealkey; ?>][<?php echo $mealkey; ?>]"
         onchange="meal_onward(this,'<?php echo $paxtype; ?><?php echo $i; ?>','<?php echo str_replace("_", "", $mealkey).$supermealkey; ?>')">
         <option value="" data-p="0"
            data-flighttype="LCC">Select
            Meal
         </option>
         <?php foreach ($meal_detail as $mealsubkey => $meal_details) {  if($meal_details['Code']!="NoMeal") { ?>
         <option value="<?php echo $mealsubkey; ?>"
            data-p="<?php echo $meal_details['Price']; ?>"
            data-flighttype="LCC"> <?php echo $meal_details['AirlineDescription']; ?>
            ( <?php if($meal_details['Price'] ) {  ?>Price: <?php echo $meal_details['Price']; ?> <?php } ?>
            <?php if($meal_details['Quantity'] !="UNKNOWN" ) {  ?> Qty:<?php echo $meal_details['Quantity']; ?> <?php }  ?>
            )
         </option>
         <?php }} ?>
      </select>
   </div>
   <?php } }}
      ?>
   <!-- end select meal preferences -->
   <!-- start select baggage preferences -->
   <?php
   if(isset($SSROBArray['Response']['Result']['Baggage'])){
      foreach ($SSROBArray['Response']['Result']['Baggage'] as $superbaggaekey => $Baggagesdata) { 
      foreach($Baggagesdata as $baggaekey=>$Baggages){
      
      ?>
   <div class="col-md-4 mb15 text-left">
      <label> Select  Baggage :
      <b><?php echo str_replace("_", "-", $baggaekey); ?></b>
      </label>
      <select class="form-control inputtext"
         name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][baggage][OB][<?php echo $superbaggaekey; ?>][<?php echo $baggaekey; ?>]"
         onchange="baggage_onward(this,'<?php echo $paxtype; ?><?php echo $i; ?>','<?php echo str_replace("_", "", $baggaekey).$superbaggaekey; ?>')">
         <option value="" data-p="0"
            data-flighttype="LCC">Select
            Baggage
         </option>
         <?php foreach ($Baggages as $baggaesubkey => $baggaege_details) { ?>
         <option value="<?php echo $baggaesubkey; ?>"
            data-flighttype="LCC"
            data-p="<?php echo $baggaege_details['Price']; ?>">
            Weight: <?php echo $baggaege_details['Weight']; ?>
            kg &nbsp;
            Price:<?php echo $baggaege_details['Price']; ?> 
         </option>
         <?php } ?>
      </select>
   </div>
   <?php 
   } }}
      ?>
   <!-- end select baggage preferences -->
</div>
</div>
<?php }
   } ?>
   
   		<?php if ($SSRIBArray) {
   if ($SSRIBArray['Response']['Error']['ErrorCode'] == "0") {  ?>
  <div class  =  "col-md-12"> 
<div class="row clearfix">
   <!-- Start  select meal preferences -->
   <?php if(isset($SSRIBArray['Response']['Result']['Meal'])) { foreach ($SSRIBArray['Response']['Result']['Meal'] as $supermealkey => $meal_details) {
      foreach($meal_details as $mealkey=>$meal_detail){
      
           ?>
   <div class="col-md-4 text-left mb15">
      <label> Meal Preferences :
      <b><?php if($mealkey) { echo str_replace("_", "-", $mealkey); } ?></b>
      </label>
      <select class="form-control inputtext"
         name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][meal][IB][<?php echo $supermealkey; ?>][<?php echo $mealkey; ?>]"
         onchange="meal_return(this,'<?php echo $paxtype; ?><?php echo $i; ?>','<?php echo str_replace("_", "", $mealkey).$supermealkey; ?>')">
         <option value="" data-p="0"
            data-flighttype="LCC">Select
            Meal
         </option>
         <?php foreach ($meal_detail as $mealsubkey => $meal_details) {
             if($meal_details['Code']!="NoMeal") {
			 ?>
         <option value="<?php echo $mealsubkey; ?>"
            data-p="<?php echo $meal_details['Price']; ?>"
            data-flighttype="LCC"> <?php echo $meal_details['AirlineDescription']; ?>
            ( <?php if($meal_details['Price'] ) {  ?>Price: <?php echo $meal_details['Price']; ?> <?php } ?>
             <?php if($meal_details['Quantity'] !="UNKNOWN" ) {  ?> Qty:<?php echo $meal_details['Quantity']; ?> <?php }  ?>
            )
         </option>
	  <?php } } ?>
      </select>
   </div>
   <?php } }}
      ?>
   <!-- end select meal preferences -->
   <!-- start select baggage preferences -->
   <?php
   if(isset($SSRIBArray['Response']['Result']['Baggage'])){
      foreach ($SSRIBArray['Response']['Result']['Baggage'] as $superbaggaekey => $Baggagesdata) { 
      foreach($Baggagesdata as $baggaekey=>$Baggages){
      
      ?>
   <div class="col-md-4 mb15 text-left">
      <label> Select  Baggage :
      <b><?php echo str_replace("_", "-", $baggaekey); ?></b>
      </label>
      <select class="form-control inputtext"
         name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][baggage][IB][<?php echo $superbaggaekey; ?>][<?php echo $baggaekey; ?>]"
         onchange="baggage_return(this,'<?php echo $paxtype; ?><?php echo $i; ?>','<?php echo str_replace("_", "", $baggaekey).$superbaggaekey; ?>')">
         <option value="" data-p="0"
            data-flighttype="LCC">Select
            Baggage
         </option>
         <?php foreach ($Baggages as $baggaesubkey => $baggaege_details) { ?>
         <option value="<?php echo $baggaesubkey; ?>"
            data-flighttype="LCC"
            data-p="<?php echo $baggaege_details['Price']; ?>">
            Weight: <?php echo $baggaege_details['Weight']; ?>
            kg &nbsp;
            Price:<?php echo $baggaege_details['Price']; ?> 
         </option>
         <?php } ?>
      </select>
   </div>
   <?php 
   } }}
      ?>
   <!-- end select baggage preferences -->
</div>
</div>
<?php }
   } ?>
					 <?php  } ?>
					 
					 
					 	 <?php for($i=1;$i<=$chdcount;$i++){  $paxtype="Child";  ?>
                    <div class="col-lg-3 col-sm-2 col-12 form_errormsg inner_heading_details_page fw_5">Child <?php echo $i; ?></div>
                    <div class="col-md-9">
                      <div class="row m-0">
                        <div class="col-4 col-md-2  plr6 mb_15 pr-0 pl-0 form_errormsg">
                         <select  class="form-control inputtext text_validation " data-validation="required" data-validation-error-msg="Required" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][title]">
                         <option value="">Title</option>
                         <option value="Mr">Mr</option>
                         <option value="Ms">Ms</option>
                         <option value="Mrs">Mrs</option>
                         <option value="Miss">Miss</option>   
                         <option value="Mstr">Mstr</option> 
                         </select>
                        </div>
                        <div class="col-lg-4 plr6 mb15 col-8 mb15 pr-0 form_errormsg pl-0">
                       <input type="text"  class="form-control inputtext text_validation" data-validation="required" placeholder="First Name" data-validation-error-msg="Enter First Name" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][first_name]">
                      </div>
                        <div class="col-lg-4 form_errormsg plr6 mb15 col-12 pr-0 pl-0">
                          <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][last_name]"  class="form-control inputtext text_validation" placeholder="Last Name" >
                        </div>
                         <div class="col-lg-2 plr6 mb15 col-12 pl-0 pr-0 dob_dateicon form_errormsg">
        <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][dob]" class="form-control inputtext text_validation child_date" data-validation="required" placeholder="DOB" data-validation-error-msg="Enter DOB">
        <i class="fa fa-calendar dateicon"></i>
      </div> 
                      </div>
                    </div>
						

			
			<?php if($searchdata['isdomestic']=='false') { ?>
			
			<div class="col-12 row passportparent" attr-parent> 
				<div class="col-lg-12 row  p0">
				<p class="passport_title">Required (Passport ) </p>
				<div class="col-12 p0" attr-optionalshow="true">				
				<div class="row  gray_bg passfield">				
					<div class="col-12 text_pasp">
						 Passport Details 
					</div>
					<div class="col-md-3 col-sm-6 col-12 plr6 mb15 form_errormsg">
						<input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][nationality]" class="form-control inputtext" data-validation="required " placeholder="Nationality" data-validation-error-msg="Enter Nationality">
					</div>
					<div class="col-md-3 col-sm-6 col-12 plr6 mb15 form_errormsg">
						<input type="text"  name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][passport]" class="form-control inputtext" placeholder="Passport No" data-validation="length alphanumeric"  data-validation-help="passport no must be between 8-15 characters" data-validation-length="8-15" data-validation-error-msg="Enter Passport Number" maxlength="15">
					</div>
					<div class="col-md-3 col-sm-6 col-12   plr6 mb15 form_errormsg">
						<input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][passport_issue_date]" class="form-control inputtext raj_pr30 passport_issue" placeholder="Passport issue"  data-validation-error-msg="Passport issue date">
						<i class="fa fa-calendar dateicon"></i>
					</div> 
					<div class="col-lg-3 col-md-3 col-sm-6 col-12 datedv plr6  mb15 form_errormsg">
						<input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][passport_exp_date]" class="form-control inputtext raj_pr30 passport_expiry"  placeholder="Passport Expiry" data-validation-error-msg="Passport expiry date">
						<i class="fa fa-calendar dateicon"></i>
					</div>
				</div>
				</div>
				</div>
			</div>
			<?php } ?>
					<?php if ($SSROBArray) {
   if ($SSROBArray['Response']['Error']['ErrorCode'] == "0") { ?>
  <div class  =  "col-md-12"> 
  
<div class="row clearfix">
   <!-- Start  select meal preferences -->
   <?php if(isset($SSROBArray['Response']['Result']['Meal'])) { foreach ($SSROBArray['Response']['Result']['Meal'] as $supermealkey => $meal_details) {
      foreach($meal_details as $mealkey=>$meal_detail){
      
           ?>
   <div class="col-md-4 text-left mb15">
      <label> Meal Preferences :
      <b><?php if($mealkey) { echo str_replace("_", "-", $mealkey); } ?></b>
      </label>
      <select class="form-control inputtext"
         name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][meal][OB][<?php echo $supermealkey; ?>][<?php echo $mealkey; ?>]"
         onchange="meal_onward(this,'<?php echo $paxtype; ?><?php echo $i; ?>','<?php echo str_replace("_", "", $mealkey).$supermealkey; ?>')">
         <option value="" data-p="0"
            data-flighttype="LCC">Select
            Meal
         </option>
         <?php foreach ($meal_detail as $mealsubkey => $meal_details) { if($meal_details['Code']!="NoMeal") { ?>
         <option value="<?php echo $mealsubkey; ?>"
            data-p="<?php echo $meal_details['Price']; ?>"
            data-flighttype="LCC"> <?php echo $meal_details['AirlineDescription']; ?>
            ( <?php if($meal_details['Price'] ) {  ?>Price: <?php echo $meal_details['Price']; ?> <?php } ?>
             <?php if($meal_details['Quantity'] !="UNKNOWN" ) {  ?> Qty:<?php echo $meal_details['Quantity']; ?> <?php }  ?>
            )
         </option>
         <?php } } ?>
      </select>
   </div>
   <?php } }}
      ?>
   <!-- end select meal preferences -->
   <!-- start select baggage preferences -->
   <?php
   if(isset($SSROBArray['Response']['Result']['Baggage'])){
      foreach ($SSROBArray['Response']['Result']['Baggage'] as $superbaggaekey => $Baggagesdata) { 
      foreach($Baggagesdata as $baggaekey=>$Baggages){
      
      ?>
   <div class="col-md-4 mb15 text-left">
      <label> Select  Baggage :
      <b><?php echo str_replace("_", "-", $baggaekey); ?></b>
      </label>
      <select class="form-control inputtext"
         name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][baggage][OB][<?php echo $superbaggaekey; ?>][<?php echo $baggaekey; ?>]"
         onchange="baggage_onward(this,'<?php echo $paxtype; ?><?php echo $i; ?>','<?php echo str_replace("_", "", $baggaekey).$superbaggaekey; ?>')">
         <option value="" data-p="0"
            data-flighttype="LCC">Select
            Baggage
         </option>
         <?php foreach ($Baggages as $baggaesubkey => $baggaege_details) { ?>
         <option value="<?php echo $baggaesubkey; ?>"
            data-flighttype="LCC"
            data-p="<?php echo $baggaege_details['Price']; ?>">
            Weight: <?php echo $baggaege_details['Weight']; ?>
            kg &nbsp;
            Price:<?php echo $baggaege_details['Price']; ?> 
         </option>
         <?php } ?>
      </select>
   </div>
   <?php 
   } }}
      ?>
   <!-- end select baggage preferences -->
</div>
</div>
<?php }
   } ?>
   
   		<?php if ($SSRIBArray) {
   if ($SSRIBArray['Response']['Error']['ErrorCode'] == "0") {  ?>
  <div class  =  "col-md-12"> 
<div class="row clearfix">
   <!-- Start  select meal preferences -->
   <?php if(isset($SSRIBArray['Response']['Result']['Meal'])) { foreach ($SSRIBArray['Response']['Result']['Meal'] as $supermealkey => $meal_details) {
      foreach($meal_details as $mealkey=>$meal_detail){
      
           ?>
   <div class="col-md-4 text-left mb15">
      <label> Meal Preferences :
      <b><?php if($mealkey) { echo str_replace("_", "-", $mealkey); } ?></b>
      </label>
      <select class="form-control inputtext"
         name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][meal][IB][<?php echo $supermealkey; ?>][<?php echo $mealkey; ?>]"
         onchange="meal_return(this,'<?php echo $paxtype; ?><?php echo $i; ?>','<?php echo str_replace("_", "", $mealkey).$supermealkey; ?>')">
         <option value="" data-p="0"
            data-flighttype="LCC">Select
            Meal
         </option>
         <?php foreach ($meal_detail as $mealsubkey => $meal_details) { if($meal_details['Code']!="NoMeal") { ?>
         <option value="<?php echo $mealsubkey; ?>"
            data-p="<?php echo $meal_details['Price']; ?>"
            data-flighttype="LCC"> <?php echo $meal_details['AirlineDescription']; ?>
            ( <?php if($meal_details['Price'] ) {  ?>Price: <?php echo $meal_details['Price']; ?> <?php } ?>
           <?php if($meal_details['Quantity'] !="UNKNOWN" ) {  ?> Qty:<?php echo $meal_details['Quantity']; ?> <?php }  ?>
            )
         </option>
         <?php } } ?>
      </select>
   </div>
   <?php } }}
      ?>
   <!-- end select meal preferences -->
   <!-- start select baggage preferences -->
   <?php
   if(isset($SSRIBArray['Response']['Result']['Baggage'])){
      foreach ($SSRIBArray['Response']['Result']['Baggage'] as $superbaggaekey => $Baggagesdata) { 
      foreach($Baggagesdata as $baggaekey=>$Baggages){
      
      ?>
   <div class="col-md-4 mb15 text-left">
      <label> Select  Baggage :
      <b><?php echo str_replace("_", "-", $baggaekey); ?></b>
      </label>
      <select class="form-control inputtext"
         name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][baggage][IB][<?php echo $superbaggaekey; ?>][<?php echo $baggaekey; ?>]"
         onchange="baggage_return(this,'<?php echo $paxtype; ?><?php echo $i; ?>','<?php echo str_replace("_", "", $baggaekey).$superbaggaekey; ?>')">
         <option value="" data-p="0"
            data-flighttype="LCC">Select
            Baggage
         </option>
         <?php foreach ($Baggages as $baggaesubkey => $baggaege_details) { ?>
         <option value="<?php echo $baggaesubkey; ?>"
            data-flighttype="LCC"
            data-p="<?php echo $baggaege_details['Price']; ?>">
            Weight: <?php echo $baggaege_details['Weight']; ?>
            kg &nbsp;
            Price:<?php echo $baggaege_details['Price']; ?> 
         </option>
         <?php } ?>
      </select>
   </div>
   <?php 
   } }}
      ?>
   <!-- end select baggage preferences -->
</div>
</div>
<?php }
   } ?>
			
					 <?php  } ?>
					 
					 
					  <?php for($i=1;$i<=$infcount;$i++){  $paxtype="Infant";  ?>
                    <div class="col-lg-3 col-sm-2 col-12 form_errormsg inner_heading_details_page fw_5 ">Infant <?php echo $i; ?></div>
                    <div class="col-md-9">
                      <div class="row m-0">
                        <div class="col-4 col-md-2 mb_15 pl-0 pr-0">
                         <select  class="form-control inputtext text_validation " data-validation="required" data-validation-error-msg="Required" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][title]">
                         <option value="">Title</option>
                         <option value="Mr">Mr</option>
                         <option value="Ms">Ms</option>
                         <option value="Mrs">Mrs</option>
                         <option value="Miss">Miss</option>   
                         <option value="Mstr">Mstr</option> 
                         </select>
                        </div>
                        <div class="col-lg-4 plr6 mb15 col-8 mb15 pr-0 form_errormsg pl-0">
                       <input type="text"  class="form-control inputtext text_validation" data-validation="required" placeholder="First Name" data-validation-error-msg="Enter First Name" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][first_name]">
                      </div>
                        <div class="col-lg-4 form_errormsg plr6 mb15 col-12 pr-0 pl-0">
                          <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][last_name]" class="form-control inputtext text_validation" placeholder="Last Name" >
                        </div>
                         <div class="col-lg-2 plr6 mb15 col-12 pl-0 pr-0 dob_dateicon form_errormsg">
        <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][dob]" class="form-control inputtext text_validation infant_date" data-validation="required" placeholder="DOB" data-validation-error-msg="Enter DOB">
        <i class="fa fa-calendar dateicon"></i>
      </div> 
                      </div>
                    </div>
						

			
			<?php if($searchdata['isdomestic']=='false') { ?>
			
			<div class="col-12 row passportparent" attr-parent> 
				<div class="col-lg-12 row  p0">
				<p class="passport_title">Required (Passport ) </p>
				<div class="col-12 p0" attr-optionalshow="true">				
				<div class="row  gray_bg passfield">				
					<div class="col-12 text_pasp">
						 Passport Details 
					</div>
					<div class="col-md-3 col-sm-6 col-12 plr6 mb15 form_errormsg">
						<input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][nationality]" class="form-control inputtext" data-validation="required " placeholder="Nationality" data-validation-error-msg="Enter Nationality">
					</div>
					<div class="col-md-3 col-sm-6 col-12 plr6 mb15 form_errormsg">
						<input type="text"  name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][passport]" class="form-control inputtext" placeholder="Passport No" data-validation="length alphanumeric"  data-validation-help="passport no must be between 8-15 characters" data-validation-length="8-15" data-validation-error-msg="Enter Passport Number" maxlength="15">
					</div>
					<div class="col-md-3 col-sm-6 col-12   plr6 mb15 form_errormsg">
						<input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][passport_issue_date]" class="form-control inputtext raj_pr30 passport_issue" placeholder="Passport issue"  data-validation-error-msg="Passport issue date">
						<i class="fa fa-calendar dateicon"></i>
					</div> 
					<div class="col-lg-3 col-md-3 col-sm-6 col-12 datedv plr6  mb15 form_errormsg">
						<input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][passport_exp_date]" class="form-control inputtext raj_pr30 passport_expiry"  placeholder="Passport Expiry" data-validation-error-msg="Passport expiry date">
						<i class="fa fa-calendar dateicon"></i>
					</div>
				</div>
				</div>
				</div>
			</div>
			<?php } ?>
			
					 <?php  } ?>
					 
					 
					 </div>
                  </article>
                </div>
				 <div class="payment_option_show">

                                <div class="row">
</div> 
</div>
 <div class="col-lg-12  mb-3 text-center ">
                    <button type  =  "submit" class="button primary btn_redverify c_pay btn go_button btneffect pt-2 pb-2 pl-3 pr-3">Proceed to Payment</button>
                  </div>
             
			  
            </div>
 </form>


		
<!-- payment tab -->
	<div class="travellers dnone  mb-2" data-steptwo-show="true">
		<div class="col bdr_sdo p0 ">
			<h4 class="gray_bg tittle4 w100 d-flex align-items-center justify-content-between">Review Travelers Name   <span class="align-right"><button type  =  "button" class  =  "btn btn-info go_button btneffect" id  ="editdettail">Edit Detail</button></span>
         </h4>
			<div class="row paxreview scrollauto review_info"></div>
			<div class="justify-content-center row continutdv fixedbtn">
		    	<div class="col-12 col-lg-4 mb-3">
					<a href="<?php echo base_url(); ?>flight/proceed_pay" class="w-100 btn go_button btneffect fz17 h42   secondry_bg  secondry_color">Pay Now</a> 
		    	</div> 	      
		    </div>
			
		</div>
	</div>
<!-- payment tab End-->
</div>


    <div class="col-md-3 pb-5 pl-md-0">
        <div class="fare_details_title ">
         <div class="head_name1 fw_500"><span>Price Summary</span></div> 
 
        </div>
        <div class="flight_details_box pt-1 " faresummary = "true">
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
			  	<div class="fare aj_mealdatahideob">
                                    </div>
                                    <div class="fare aj_baggdatahideob">
                                    </div>
                                    <div class="fare aj_mealdatahideib">
                                        
                                    </div>
                                    <div class="fare aj_baggdatahideib">
                                        
                                    </div>	
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
			    <?php // if($fare_data_show['conveniencefee']) { ?>
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
			  
			  <?php  //}  ?>
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
										<td class="col lft"  style="border-color: #fff;  display: grid;   
    font-weight: 500; font-size: 13px;padding: 0px;"> Promo Discount  <a href="javascript:void(0);" class="remove_promocode">Remove </a>
										</td>
										
									
										
								
                                            
                          
                                          
                                            <td class="col rit"  style="border-color: #fff; font-size: 13px; width: 90px;     position: relative;top: -9px;font-size: 13px;padding: 0pc;text-align: end;">
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
        </div>
		 <div faresummarytwo="true" class="flight_details_box"></div>
        <div class="booking_details_title mt-3 promocouponcode">
              <div class="d-flex align-items-center"><i class="fa fa-percent ml-3 pr-3"></i> Promo Code</div>
            </div>
        <div class="flight_details_box pt-3 pb-3 promocouponcode"  >
          <div class="promo_code">
              <div class="row m-0 w100 pb-3">
            <div class="col-12 pt-2 pb-2">
             <span class="fs_15 nh_color"> Enter Your Promo Code</span>
            </div>
            
            <div class="col-9 col-lg-8 col-md-auto  form_errormsg pr-0">
              <input type="text" name="promo" id="promo" class="form-control inputtext radiusltb" placeholder="Apply Promo Code">
            </div>
            <div class="col-3 col-lg-4 pl-0">
              <a href="javascript:void(0);" class="btn go_button radiusrtb apply w100 promocode" title="apply">Apply</a>
            </div>
			<div class="col-12"><span id="promo_message" class="fs_13"></span></div>
			
			<div class="col-12  add_response_coupan  coupn_flyt">
						
						</div>
       
          </div>
          </div>
        </div>  
      </div>
    </div>	<?php  }  else { ?><div class="row m0 text-center">		<div class="col-12">		 		<img src="<?php echo base_url(); ?>webroot/images/oopsimage.png" alt="oops image" class="mw100">		  <br/>			<h2><?php echo  $air_result['Response']['Error']['ErrorMessage']; ?></h2>			<h4 class="text-danger">Sorry, Some technical problems occurred. We suggest you modify your search and try again.</h4>		</div>	</div><?php } ?>
</div>

</section>
<?php  } else { ?>
<div class="row m0 text-center">		<div class="col-12">		 		<img src="<?php echo base_url(); ?>webroot/images/oopsimage.png" alt="oops image" class="mw100">		  <br/>						<h4 class="text-danger">Sorry, Some technical problems occurred. We suggest you modify your search and try again.</h4>		</div>	</div>
<?php  }  ?>
<?php  $this->load->view("include/footer"); ?>
<script>


loads();

 $(".passport_expiry").datepicker({
	   dateFormat : "dd-mm-yy",
	   minDate: 0,
	   changeMonth: true,
       changeYear: true,
       numberOfMonths: 1,
	   beforeShow : function() {

					var newdate = new Date("2020-03-23");
					$(this).datepicker("option", "minDate",newdate);		
							
				}
	}); 

	$(".passport_issue").datepicker({
	   defaultDate : "",
	   dateFormat : "dd-mm-yy",
	   maxDate: 0,
	   changeMonth: true,
	   changeYear: true,
	   numberOfMonths: 1,
	   yearRange: '1990:' + new Date().getFullYear().toString()
	});



function loads(){
	
		var hiturl=$("#site_url").val();
	$.ajax({	
         type: "POST",
         url: hiturl+"flight/get_coupan_list", 
		 cache:false,
         success: 
		 function(data)
		 {
			 
			$('.add_response_coupan').html(data);
			 
		 }
		 });
}
var previvous_coupan_data = '';
	function apply_data(coupan_data){
		
		var hiturl=$("#site_url").val();
       	var basefare  =  "<?php echo  ($basefareonward+$basefareinward);?>";
	

$('#promo_message').html('');
$(".promocode").attr('disabled', true);
var checkbox = document.getElementsByClassName("remove_unchecked");
    var ln = 0;
    for (var i = 0; i < checkbox.length; i++) {
        if (checkbox[i].checked){
			if(checkbox[i].value==coupan_data){}
			else{
				$('[value= '+checkbox[i].value+']').removeAttr('checked');	
				
			}
             }
    }
	var ssrprice       = $("[ssr_price]").val(); 
         var ssrprice = 0; 
$.ajax({	
         type: "POST",
         url: hiturl+"flight/promocode", 
         data: {promocode:coupan_data,basefare:basefare,ssrprice:ssrprice},
         cache:false,
         success: 
		 function(data)
		 {
			 $(".promocode").attr('disabled', false);
			  var fdata = JSON.parse(data);
			 if (fdata.status_code == 1)
			 {
					$('#promo_message').html(fdata.error_message.promocode).css("color", "#de0000");
			 }
			 if (fdata.status_code == 0)
			 {   
					$("#promo").val('');
          		    $(".mycoupon_div").load(location.href + " .mycoupon_div");   
          		    $(".publish_ob").html(fdata.total_price);   
					$('#promo_message').html(fdata.message.promocode).css("color", "green");
			 }
		 }
	 });
		
		
		 var previvous_coupan_data  = coupan_data; 
		
		
	}
	
	
	

$(".promocode").click(function() {
	
	var basefare  =  "<?php echo  ($basefareonward+$basefareinward);?>";
	
	
var hiturl=$("#site_url").val();
var promo=$("#promo").val();
$('#promo_message').html('');
$(".promocode").attr('disabled', true);
 var ssrprice       = $("[ssr_price]").val(); 
         var ssrprice = 0; 
$.ajax({	
         type: "POST",
         url: hiturl+"flight/promocode", 
         data: {promocode:promo,basefare:basefare, ssrprice: ssrprice},
         cache:false,
         success: 
		 function(data)
		 {
			 $(".promocode").attr('disabled', false);
			  var fdata = JSON.parse(data);
			 if (fdata.status_code == 1)
			 {
					$('#promo_message').html(fdata.error_message.promocode).css("color", "#de0000");
			 }
			 if (fdata.status_code == 0)
			 {   
					$("#promo").val('');
          		    $(".mycoupon_div").load(location.href + " .mycoupon_div");   
          		    $(".publish_ob").html(fdata.total_price);   
          		    // $("#publish_obcm").html(fdata.total_price);   

					$('#promo_message').html(fdata.message.promocode).css("color", "green");
			 }
		 }
	 });
});
$(document).on("click", ".remove_promocode", function() {
	var hiturl=$("#site_url").val();
	var ssrprice = $("[ssr_price]").val();
        var ssrprice = 0; 
	$.ajax({	
         type: "GET",
         url: hiturl+"flight/remove_promocode", 
		  data: {ssrprice: ssrprice},
         cache:false,
         success: 
		 function(data)
		 {
			  var fdata = JSON.parse(data);
			  $(".mycoupon_div").load(location.href + " .mycoupon_div"); 
			  $(".publish_ob").html(fdata.total_price);
			  // $("#publish_obcm").html(fdata.total_price); 
              $('.remove_unchecked').prop('checked', false);;		  
			  $('#promo_message').html(fdata.message.promocode).css("color", "green");			  
			 
		 }
	 });
});	




$(document).on("click", ".remove_gst_details", function() {
	var hiturl=$("#site_url").val();
	$.ajax({	
         type: "GET",
         url: hiturl+"flight/remove_gst_details", 
         cache:false,
         success: 
		 function(data)
		 {
			  var fdata = JSON.parse(data);
			  $("#div_gst").load(location.href + " #div_gst"); 
			  $(".gst_message").html('<div class="alert alert-info text-center"> <strong>'+fdata.message+' </strong></div>');
			  $(".addgst").html("Add your GST Details <small>(Optional)</small>");
			  $(".add_gst").text("Add GST");
			  $(".gst_title").text("Add GST Details");
			  $('#gst_details')[0].reset();			  
		 }
	 });
});	


function gstdivshowhid(elemnt){
	
		var data  = '<div class="gst_form_fill "><div class="col-md-12"><article class="row gst_form_details  pt-3 pb-3 border-top mt-2"> <div class="col-md-12 pl-0"><div class="row mb-3"> <div class="col-lg-2 col-sm-2 col-12 align-self-center inner_heading_details_page fw_5 light_black_text fs_13 mt-2 pr-0">GST Number</div><div class="col-lg-4 col-sm-4 col-12  m_mb10  pr-0"> <input type="text" name  = "gst[gst_number]"  class="form-control inputtext text_validation " placeholder="GST Number"></div><div class="col-lg-2 col-sm-2 col-12 align-self-center inner_heading_details_page fw_5 light_black_text fs_13 mt-2  pr-0">Company Name</div> <div class="col-lg-4 col-sm-4 col-12  m_mb10  pr-0"> <input type="text" 	name  = "gst[gst_company_name]"  class="form-control inputtext text_validation " placeholder="Company Name"></div></div> <div class="row mb-3"><div class="col-lg-2 col-sm-2 col-12 align-self-center inner_heading_details_page fw_5 light_black_text fs_13 mt-2  pr-0">Email Id:</div><div class="col-lg-4 col-sm-4 col-12  m_mb10  pr-0"><input type="email" name  = "gst[gst_company_email]" class="form-control inputtext text_validation" placeholder="Your Email" value=""></div><div class="col-lg-2 col-sm-2 col-12 align-self-center inner_heading_details_page fw_5 light_black_text fs_13 mt-2 pr-0">Mobile Number:</div><div class="col-lg-4 col-sm-4 col-12  m_mb10  pr-0"><div class="row"><div class="col-md-12 col-7  mob_flight_mobnum"><input type="text" name  = "gst[gst_company_contact_no]"  class="w-100 form-control inputtext numtext text_validation rounded-right" placeholder="Mobile No"></div> </div></div></div><div class  =  "row mb-3"><div class="col-lg-2 col-sm-2 col-12 align-self-center inner_heading_details_page fw_5 light_black_text fs_13 mt-2 pr-0">Company Address:</div><div class="col-lg-4 col-sm-4 col-12  m_mb10  pr-0"><div class="row"><div class="col-md-12 col-7  mob_flight_mobnum"><input type="text" name  = "gst[gst_company_address]"  class="w-100 form-control inputtext numtext text_validation rounded-right" placeholder="Company Address"></div> </div></div></div></div></div></article></div></div>';
                    
                    
                var attrval  =  elemnt.getAttribute("gstattribute");
if(attrval== "add"){
	$("[addgstdata]").html(data);
	elemnt.setAttribute("gstattribute","remove");
	elemnt.innerHTML = "Remove GST" ;
}				
    else{
		$("[addgstdata]").html("");
	elemnt.setAttribute("gstattribute","add");
	elemnt.innerHTML = "Add";
		
	}                          
}

<?php if(isset($_SESSION["customer_login"])) { ?>
$.get("<?php echo site_url('flight/wallete_page');?>", function(data, status){
    $(".payment_option_show").html(data);
});
<?php } ?>
</script>

<?php 
if(isset($_SESSION["customer_login"]['member_info'])) {  ?>
<!-- The Modal -->
<div class="modal" id="seletottravellermodal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Traveller</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body p0">
        <div class="table-responsive">
             
  <table class="table table-striped mb-0">
   <thead>
      <tr  style="text-align: center;">
        <th style="    font-size: 14px;      border: none;  font-weight: 500;">Firstname</th>
        <th style="    font-size: 14px;     border: none; font-weight: 500;">Lastname</th>
        <th style="    font-size: 14px;     border: none;  font-weight: 500;">D.O.B</th>
        <th style="    font-size: 14px;      border: none; font-weight: 500;">Select Passenger</th>
      </tr>
    </thead>
  <tbody>
   <?php 
	if(count($_SESSION["customer_login"]['member_info']) !=0) { foreach($_SESSION["customer_login"]['member_info'] as $memberkey=>$menmber_inf) {

 $member   =  json_decode($menmber_inf['customer_info'],true); ?>

     
    
    
      <tr style="text-align: center;">
        <td style="    font-size: 14px; "><?php echo   ucfirst($member['first_name']);?></td>
        <td style="    font-size: 14px; "><?php echo   ucfirst($member['last_name']);?></td>
        <td style="    font-size: 14px; "><?php echo  $member['birthday'];?></td>
        <td style="    font-size: 14px; "><label class="checkboxlabel"><input type  =  "checkbox"  class  =  "form-control"   selectcheckboxpassenger  =  "true"  value  =  "<?php  echo $memberkey;?>"><i class="checkmark"></i></label></td>
       
		
      </tr>
   
	  <?php } }
					 
					 ?>
  
       
    </tbody>
  </table>
</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <!--  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
		 <button type="button" class="btn btn-danger" onclick  =  "selectpassengerssssss()">Select  Traveller</button>
      </div>
    </div>
  </div>
</div>


<?php } ?>
 <input type="hidden" value="0" ssr_price="true">
<input type="hidden" value="<?php echo round($_SESSION['flight']['totalprice']); ?>" totalssrprice="true">
<script>
function selectpassengerssssss(){
var checkbox = $("[selectcheckboxpassenger]");
var pax  = [];
var total_pax =  "<?php echo  $_SESSION['flight']['Search_data']['adults']+$_SESSION['flight']['Search_data']['child']+$_SESSION['flight']['Search_data']['infant'];?>";
var totalpaxjs   =  parseInt(total_pax);

    var ln = 0;
    for (var i = 0; i < checkbox.length; i++) {
        if (checkbox[i].checked){
			
		pax.push(checkbox[i].value);
            ln++;
    }}
		
    if (ln === 0)
    {
	
				        swal.fire({
  title: '<span style  =  "font-size:14px; color:red">Please select Traveller</span>',
  type: 'info',
  animation: true,
  customClass: {
    popup: 'animated tada'
  }
	  }); 
					
				 }
			
		
   
     else {
		if(ln>totalpaxjs){
			
			swal.fire({
  title: '<span style  =  "font-size:14px; color:red">Please Select Traveller Same as Search Passenger</span>',
  type: 'info',
  animation: true,
  customClass: {
    popup: 'animated tada'
  }
	  }); 
					
				

    }
else{
	
	
	var hiturl=$("#site_url").val();
	$.ajax({	
         type: "POST",
         url: hiturl+"flight/addtraveller", 
         cache:false,
         data:{pax:pax},
         success: 
		 function(data)
		 {
			    
			  var fdata = JSON.parse(data);
			 if (fdata.status_code == 1)
			 {
								swal.fire({
  title: '<span style  =  "font-size:14px; color:red">'+fdata.message+'</span>',
  type: 'info',
  animation: true,
  customClass: {
    popup: 'animated tada'
  }
	  }); 
			 }
			 if (fdata.status_code == 0)
			 {   
		 $("#seletottravellermodal").modal("hide");
					$("[travelinfo]").html(fdata.message);
					$(".infant_date" ).datepicker({
	  dateFormat : "dd-mm-yy",
	  minDate: "-2Y",
	  changeMonth: true,
      changeYear: true,
	  maxDate: "+0D",
      numberOfMonths: 1 ,
    });

	$( ".child_date" ).datepicker({
	  dateFormat : "dd-mm-yy",
	  minDate: "-12Y",
	  changeMonth: true,
      changeYear: true,
	  maxDate: "-2Y",
      numberOfMonths: 1,
    });

	$( ".adult_date" ).datepicker({
	  dateFormat : "dd-mm-yy",
	  changeMonth: true,
      changeYear: true,
	   yearRange: '-100y:c+nn',
	  maxDate: "-12Y",
	  numberOfMonths: 1,
    });
			 }
		 }
	 });
}

	}}
</script>
  <script>
    var onwardmealarray = new Array();
    var returnmealarray = new Array();
    var onwardbaggagearray = new Array();
    var returnbaggagearray = new Array();
    var ssrprice = 0;
    ;

    function meal_onward(thisval, pax, segment) {

        var mealtype = thisval.options[thisval.selectedIndex].getAttribute('data-flighttype');
        if (mealtype == "LCC") {
            var value = thisval.value;

            var price = thisval.options[thisval.selectedIndex].getAttribute('data-p');
            onwardmealarray[pax + segment + "OB"] = price;
            calculate_price("OB");
        }
    }

    function meal_return(thisval, pax, segment) {

        var mealtype = thisval.options[thisval.selectedIndex].getAttribute('data-flighttype');
        if (mealtype == "LCC") {
            var value = thisval.value;
            var price = thisval.options[thisval.selectedIndex].getAttribute('data-p');
            returnmealarray[pax + segment + "IB"] = price;
            calculate_price("IB");

        }
    }

    function baggage_onward(thisval, pax, segment) {

        var mealtype = thisval.options[thisval.selectedIndex].getAttribute('data-flighttype');
        if (mealtype == "LCC") {
            var value = thisval.value;
            var price = thisval.options[thisval.selectedIndex].getAttribute('data-p');
            onwardbaggagearray[pax + segment + "OBbaggage"] = price;
            calculate_price("OBbaggage");

        }
    }

    function baggage_return(thisval, pax, segment) {
        var mealtype = thisval.options[thisval.selectedIndex].getAttribute('data-flighttype');
        if (mealtype == "LCC") {
            var value = thisval.value;
            var price = thisval.options[thisval.selectedIndex].getAttribute('data-p');
            returnbaggagearray[pax + segment + "IBbaggage"] = price;
            calculate_price("IBbaggage");
        }
    }


    function calculate_price(type) {
		
        var hiturl = $("#site_url").val();
        var totalonwardprice = 0;
        var totalreturnprice = 0;
        var total_net_fareprice = $("[totalssrprice]").val();

        mealpriceonward = 0;
        mealpricereturn = 0;
        var ssrprice = 0;
        $("[ssr_price]").val(ssrprice);
        baggaegepriceonward = 0;
        baggaegepricereturn = 0;
        /*-----------StartFor meal -----------*/
        Object.keys(onwardmealarray).forEach(function (key) {
            mealpriceonward += parseFloat(onwardmealarray[key]);
        });
        Object.keys(returnmealarray).forEach(function (key) {
            mealpricereturn += parseFloat(returnmealarray[key]);
        });
        /*-----------EndFor meal -----------*/

        /*-----------StartFor Baggage -----------*/

        Object.keys(onwardbaggagearray).forEach(function (key) {
            baggaegepriceonward += parseFloat(onwardbaggagearray[key]);
        });
        Object.keys(returnbaggagearray).forEach(function (key) {
            baggaegepricereturn += parseFloat(returnbaggagearray[key]);
        });
        /*-----------EndFor Baggage -----------*/

        /*-----------starFor meal -----------*/
        if (type == "OB") {
            $(".aj_mealdatahideob").show();
            var obhtml = ' <div class="row m0"><div class="col lft">  Meal</div> <div class="col rit"><span><i class="fa fa-inr" aria-hidden="true"></i><span class = "">&nbsp; ' + mealpriceonward + '	</span></span>  </div> </div>';
            $(".aj_mealdatahideob").html(obhtml);
            $("#onward_meal_pr").val(mealpriceonward);
            if (mealpriceonward == 0) {
                $(".aj_mealdatahideob").hide();
            }

        }
        if (type == "IB") {

            $(".aj_mealdatahideib").show();
            var ibhtml = ' <div class="row m0"><div class="col lft"> Return Meal</div> <div class="col rit"><span><i class="fa fa-inr" aria-hidden="true"></i><span >&nbsp; ' + mealpricereturn + '	</span></span>  </div> </div>';
            $(".aj_mealdatahideib").html(ibhtml);
            $("#return_meal_pr").val(mealpricereturn);
            if (mealpricereturn == 0) {
                $(".aj_mealdatahideib").hide();
            }
        }

        /*-----------EndFor meal -----------*/


        if (type == "OBbaggage") {
            $(".aj_baggdatahideob").show();
            var obbaggagehtml = ' <div class="row m0"><div class="col lft"> Baggage</div> <div class="col rit"><span><i class="fa fa-inr" aria-hidden="true"></i><span>&nbsp; ' + baggaegepriceonward + '	</span></span>  </div> </div>';
            $(".aj_baggdatahideob").html(obbaggagehtml);
            $("#onward_baggage_pr").val(baggaegepriceonward);
            if (baggaegepriceonward == 0) {
                $(".aj_baggdatahideob").hide();
            }

        }

        var gobtotal = parseFloat(totalonwardprice) + parseFloat(mealpriceonward) + parseFloat(baggaegepriceonward);
        $(".totalonwardprice").html(gobtotal.toFixed(2));

        if (type == "IBbaggage") {

            $(".aj_baggdatahideib").show();
            var ibbaggagehtml = ' <div class="row m0"><div class="col lft"> Return Baggage</div> <div class="col rit"><span><i class="fa fa-inr" aria-hidden="true"></i><span>&nbsp; ' + baggaegepricereturn + '	</span></span>  </div> </div>';
            $(".aj_baggdatahideib").html(ibbaggagehtml);
            $("#return_baggage_pr").val(baggaegepricereturn);

        }

        var gibtotal = parseFloat(totalreturnprice) + parseFloat(mealpricereturn) + parseFloat(baggaegepricereturn);
        $(".totalreturnprice").html(gibtotal.toFixed(2));

        var totalmealvalue = parseFloat(mealpriceonward) + parseFloat(mealpricereturn);
        var totalbaggagevalue = parseFloat(baggaegepriceonward) + parseFloat(baggaegepricereturn);
        gtototalprice = parseFloat(total_net_fareprice) + parseFloat(totalmealvalue) + parseFloat(totalbaggagevalue);
        $(".publish_ob").html(gtototalprice);
        $(".show_publicfarebeforeconncefee").html(gtototalprice);
        ssrprice = totalmealvalue + totalbaggagevalue;
        $("[ssr_price]").val(ssrprice);

        $("#returnt_pr").val(gtototalprice.toFixed(2));
         $("#baggagepricemodal").modal('show');
        $.ajax({
            type: "POST",
            url: hiturl + "flight/getfareinfos",
            data: {
                mealpriceonward: mealpriceonward,
                mealpricereturn: mealpricereturn,
                baggaegepriceonward: baggaegepriceonward,
                baggaegepricereturn: baggaegepricereturn
            },
            cache: false,
            success:
                function (data) {
                    $("#baggagepricemodal").modal('hide');
                    $("[faresummary]").html(data);
                }
        }); 


    }

</script>
<script>

    <?php if(isset($_SESSION["customer_login"])) { ?>
    $.get("<?php echo site_url('flight/wallete_page');?>", function (data, status) {
        $(".payment_option_show").html(data);
    });
    <?php } ?>

</script>
  <div class="modal" id="baggagepricemodal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <!--<div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>-->

            <!-- Modal body -->
            <div class="modal-body text-center">
                <img src="<?php echo site_url(""); ?>webroot/images/lg-spinner.gif" style="width: 50%;display: block; margin: 0 auto;">
                <p class="text-center" style="font-size:18px">Processing Request </p>
            </div>

            <!-- Modal footer -->
            <!--<div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>-->

        </div>
    </div>
    </div>