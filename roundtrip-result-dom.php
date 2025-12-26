<?php  $this->load->view("include/header"); ?>
<?php $this->load->view('modify_search');?>
<style>
div.flight_fare .ar_duration>span.stopshow{margin: 5px 7px;}
div.flight_details .detduration .text {
    white-space: nowrap;
    position: absolute;
    top: 0px;
    left: 0px;
}
.domactiveclass {
    background-color: #dbd8d8!important; 
}
div.flight_details .detduration1 .plain1{    top:4px;}
@media only screen and (min-width: 992px) and (max-width:1262px){div.sorting_tittle2 a{font-size:10px;}.timefnt1 {font-size: 11px;}.fz13{font-size:10px;}div.flight_fare .ar_inr samp {font-size: 13px;}
.detail_content .col-4.text-left samp,div.flight_fare .ar_time>samp{white-space:nowrap;} }

div.flight_fare .ar_inr span.inr_rupes {
    font-size: 14px !important;
}
div.flight_fare .ar_inr samp {
   font-size: 14px !important;
   line-height: 53px !important;
}
div.sorting_tittle2 a {
    font-size: 12px !important;
}
.tts_ft_dep {
    font-size: 14px !important;
}
.tts_ft_dest {
    font-size: 12px !important;
}
div.flight_fare .logo {
    object-fit: cover;
    width: 20px;
    height: 20px;
}
</style>
<main class="container-fluid pt-md-4 pb-md-4 plr0 mpt0 tts_bg_sky">
   <div class="container p_0">
      <div class="row">
         <?php $this->load->view('fliter');?>
         <section class="col-lg-9">
            <div class="row round-div-pre">
               <div class="col-md-6 col-6 flight_free pl-0">
                 
                  <div id="flightResult">
                     <div class="m-0 row sorting_tittle2 ">
                        <div class="col-lg-12 col-md-12 col-12">
                           <div class="row">
                              <div class="col-lg-2 col-2 p0 align-self-center">
                                 
                              </div>
                              <div class="col-lg2 col-2 ar_time p0 align-self-center">
                                 <a href="javascripe:void(0);" title="" id="OBSort_Departure">Depart <i class="fa fa-sort-up"></i></a>
                              </div>
                              <div class="col-lg-3 col-3 ar_duration p0 align-self-center text-center">
                                 <a href="javascript:void(0);" title="" id="OBSort_Arrival">Arrive <i class="fa fa-sort-up"></i></a>
                              </div>
                              <div class="col-lg-3 col-3 ar_time p0 text-center align-self-center mp0 mtright">
                                 <a href="javascript:void(0);" title="" id="OBSort_Duration">Duration <i class="fa fa-sort-up"></i></a>
                              </div>
                              <div class="col-lg-2  col-md-2  p0 text-right align-self-center">
                                 <a href="javascript:void(0);" title="" id="OBSort_PubPrice">Price <i class="fa fa-sort-up"></i></a>
                              </div>
                           </div>
                        </div>

                     </div>
					 	<?php 
		if($air_result['Response']['Error']['ErrorCode']==0)
		{
		$flight_reslut = $air_result['Response']['Result'][0];
		$TraceId=$air_result['Response']['TraceId'];
		if($flight_reslut) 
		{
		 foreach($flight_reslut as $key=>$flight_data){  
		 
		 $PublishedFare=$flight_data['Fare']['PublishedFare'];
		 ?>
                     <div class="row m-0 flight_fare aj_o_fare hover w-100 striperleft" air-sort="sorting" id="result_<?php echo $key; ?>" attr-obfare onclick="obfare(this.innerHTML,<?php echo $PublishedFare; ?>,<?php echo $key; ?>);">
                        	<div class="col-lg-9 col-md-8 col-12  pr-md-0" air-index="<?php echo $key; ?>">
									<?php 
			unset($totaltraveltime,$layovervalue,$layover_time,$segment_time,$layover,$air_AirlineCode,$air_Airline_name,$air_FlightNumber);
			foreach($flight_data['Segments'] as $flight_segment){ 
			
					foreach($flight_segment as $flight_segvia)
					{
						
						$air_AirlineCode[]=$flight_segvia['Airline']['AirlineCode'];
						$air_Airline_name[]=$flight_segvia['Airline']['AirlineName'];
						$air_FlightNumber[]=$flight_segvia['Airline']['FlightNumber'];
						
						$layover_time[]=$flight_segvia['Origin']['AirportCode']."_".$flight_segvia['Origin']['DepartTime'];
						$layover_time[]=$flight_segvia['Destination']['AirportCode']."_".$flight_segvia['Destination']['ArrivalTime'];
						 $middletime=journey_time($flight_segvia['Origin']['AirportCode'],$flight_segvia['Destination']['AirportCode'],$flight_segvia['Origin']['DepartTime'],$flight_segvia['Destination']['ArrivalTime']);
						$segment_time[]=hour_minute_format_remove($middletime);
					} 
					
						$final_AirlineCode=array_unique($air_AirlineCode);
						$final_air_Airline_name=array_unique($air_Airline_name);
						$final_air_FlightNumber=array_unique($air_FlightNumber);
						$final_AirlineCode_count=count($final_AirlineCode);
											
					
						$layover=layovertime($layover_time);
						$layovervalue[]=$layover;
					
					
					//	$totaltraveltime[]=total_travel_duration($layover,$segment_time); 
					

					
					
									
					$first_segment = reset($flight_segment); 
					$end_segment = end($flight_segment);  ?>
                           <div class="row ptb8 m0  w-100">
                              <div class="col-lg-2 col-2 p0">
							   <?php if($final_AirlineCode_count==1) { 
								 
										$airline_name=$final_air_Airline_name[0];	
										$airline_code=$final_AirlineCode[0];	
										$flight_code=$final_air_FlightNumber[0];
								 ?>
                                 <img src="<?php echo base_url(); ?>webroot/airline-images/<?php echo $airline_code;?>.png" alt="<?php echo $airline_name; ?>" air-airline-logo="<?php echo base_url(); ?>webroot/airline-images/<?php echo $airline_code;?>.png" class="logo">
                                 <label class="ar_name mt-1">
                                    <samp class="d-block" id="airlinename_<?php echo $key; ?>" air-airlinename="<?php echo $airline_name; ?>"><?php echo $airline_name; ?></samp>
                                    <samp><?php echo $airline_code.'-'.$flight_code ; ?></samp>
                                 </label>
								 	 <?php } else { 
								 $connection_airline_name="";
								 $carriercount=count($final_AirlineCode)-1;
								foreach($final_AirlineCode as $carrierkey=>$carriercodes)
								{
									if($carrierkey!==0)
										{
											
											$connection_airline_name.=$final_air_Airline_name[$carrierkey].", ";
										}
								}
								 $connection_airline_name=rtrim($connection_airline_name, ', ');
								 ?>
								  <img src="<?php echo base_url(); ?>assets/airline-images/<?php echo $final_AirlineCode[0];?>.png" alt="<?php echo $final_air_Airline_name[0]; ?>" air-airline-logo="<?php echo base_url(); ?>assets/airline-images/<?php echo $final_AirlineCode[0]; ?>.png" class="rtlogo" />
                                 <label class="ar_name">
                                    <samp class="d-block" id="airlinename_<?php echo $key; ?>" air-airlinename="<?php echo $final_air_Airline_name[0]; ?>"><?php echo $final_air_Airline_name[0]; ?></samp>
                                    <samp><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="<?php echo$connection_airline_name;?>"><?php echo $carriercount; ?> more</a></samp>
                                 </label>
								  <?php

								} ?>
                              </div>
                              <div class="col-lg-7 col-10">
                                 <div class="row m0">
                                    <h5 class="col-6 p0 arrpd  mb-0" id="departure_<?php echo $key; ?>" air-departtime="<?php $DepTime=tbo_flight_time($first_segment['Origin']['DepartTime']); 
							echo get_depart_time($DepTime); ?>"> <span class="tts_ft_dep"><?php echo $DepTime; ?></span>
                                       <br><label class="destlabel  mb-0"><samp class="tts_ft_dest"> <?php echo $first_segment['Origin']['CityName']; ?></samp> </label>
                                    </h5>
                                    <h5 class="col-6 arrpd  mb-0" id="arrival_<?php echo $key; ?>"> <span class="tts_ft_dep"><?php echo tbo_flight_time($end_segment['Destination']['ArrivalTime']); ?> </span> <br><label class="destlabel  mb-0"><samp class="tts_ft_dest"> <?php echo $end_segment['Destination']['CityName']; ?></samp>
                                       </label>
                                    </h5>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-12 ar_duration p0  fz13">
                                 <samp id="duration_<?php echo $key; ?>"><?php echo time_duration($first_segment['Origin']['DepartTime'],$end_segment['Destination']['ArrivalTime']); ?></samp>
                                 <span class="stopshow"> <b class="non stop"></b> </span>
								 <?php  
								$air_stop=count($flight_segment)-1; 
								if($air_stop==0){
									  $air_stops="Non Stop";
								}else{
									 $air_stops=$air_stop." Stop";
								} ?>
                                 <samp air-stops="<?php echo $air_stop; ?>"> <?php echo $air_stops; ?></samp>
                              </div>
                           </div>
						   <?php } ?> 	
                        </div>

                        <div class="col-lg-3 col-md-3 col-12 ar_inr text-md-right">

                        
		<?php 
					$fligth_commetion=$flight_data['Fare']['Discount']+$flight_data['Fare']['CommissionEarned']+$flight_data['Fare']['PLBEarned']+$flight_data['Fare']['IncentiveEarned'];
					
					$fare_type=faretype_status($flight_data['Source']);
					
					if($isdomestic=="true"){
						if($fare_type){
							$fare_type="Coupon";
						}else{
							$fare_type="Normal";
						}
					}else{
						if($fare_type)
						{
							$fare_type="Coupon";
					    }
						else if($fligth_commetion==null || $fligth_commetion==0){
							$fare_type="Soto";
						}else{
							$fare_type="Normal";
						}
					}
					
			
				/* Markup Calculation  */
				
					
				if(isset($air_markup_array[$airline_code]) || isset($air_markup_array["ALL"])){
			
					$flight_fare=$flight_data['Fare']['PublishedFare'];
					$markup_value=airline_markup_value($air_markup_array,$airline_code,$fare_type,$flight_fare); 
				 } else {
					$markup_value=0;
					}
				 /* Discount Amount */
						 
				 
				 
				 $discount_amount =round(get_discount_value($fligth_commetion,$air_discount_val));
				 
				 
				 /* publidh fare With Markup  */
				 $total_amount = round(($flight_data['Fare']['PublishedFare']+$markup_value)-$discount_amount);  ?>
                           <samp class="fz20 fw_4 tblue p_aj" id="PubPrice_<?php echo $key; ?>"><span class="inr_rupes" air-price="<?php echo round($total_amount); ?>"><i class="fa fa-inr"></i></span><?php echo change_money_format($total_amount);  ?></samp>
                              <!-- <label data-toggle-btn="true" attr-farecenter="" class="pointer link logo_color2 mb-0 hidden-md-up">Details</label> -->
  <label class="hidden-md-up mtright logo_color2" data-toggle="modal" data-flight-farerule="true" data-target="#farebreakup" tid="<?php echo $TraceId; ?>" rindex="<?php echo encode_url($flight_data['ResultIndex']); ?>"><span class="fs_13 fw_5 pointer link">Fare Rule</span></label>
                        </div>

                        <div class="row fare_title ">
                           <div class="col-lg-4 col-md-4 col-6 details fz13 d-none d-md-block p-0">
                              <label data-toggle-btn="true" class="pointer link" id="flight_data"><samp><i class="fa fa-plane pr-2"> </i></samp> flight
                                 details</label>
                           </div>
                           <div class="col-lg-4 col-md-4 col-6   details fz13">
                            <?php if($flight_data['IsRefundable']){ ?>
								<label class="refundable"  air-faretype="Refundable">Refundable</label>
							<?php }else{ ?>
								<label class="non_refundable"  air-faretype="Non Refundable">Non Refundable</label>
								<?php } ?>
                           </div>
                        </div>
                        <!-- flight details heading div -->
             
                        <!-- flight details heading div End-->
                        <!-- flight fare details show -->
                        <div class="row flight_details gray_bg dnone" data-toggle-show="true">

                           <!-- Tab panes -->
                           <div class="tab-content detail_content ptb15   ">
                              <div class="tab-pane active" id="flight_detail0" role="tabpanel" aria-expanded="true">
							  <?php  foreach($flight_data['Segments'] as $SegmentsKey=>$flight_segment){ 
							
							$first_segment = reset($flight_segment); 
							$end_segment = end($flight_segment); 
					?>	
                                 <div class="row m0">
                                    <h5 class="f_tittle f_tittle<?php echo $j; ?>">
                                       <samp class="fz20">✈</samp> <?php echo $first_segment['Origin']['CityName']; ?> - <?php echo $end_segment['Destination']['CityName']; ?>
                                    </h5>
									<?php foreach ($flight_segment as $SegmentDetailKey=>$flight_details){ ?>
                                    <div class="row m0 roundtrip_det">
                                       <div class="row m0 w100">
                                          <div class="col-lg-2 col-md-2 col-7 p0 onmbil">
                                             <img src="<?php echo base_url(); ?>/webroot/airline-images/<?php echo  $flight_details['Airline']['AirlineCode']; ?>.png" alt="<?php echo  $flight_details['Airline']['AirlineName']; ?> Airline " class="logo">
                                             <label class="ar_name mar_name">
                                                <samp><?php echo  $flight_details['Airline']['AirlineName']; ?> </samp>
                                                <samp><?php echo  $flight_details['Airline']['AirlineCode']; ?>-<?php echo  $flight_details['Airline']['FlightNumber']; ?></samp>
                                             </label>
                                          </div>
                                          <div class="col-lg-4 col-md-4 col-4 text-left">
                                             <samp class="fz11 mb5 t777"><?php echo tbo_flight_date($flight_details['Origin']['DepartTime']); ?></samp>
                                             <h3 class="fzbold tblue  timefnt1 pt-2"><span class=" upper1 "> <?php 	echo $flight_details['Origin']['AirportCode'];  ?>
                                                </span><?php echo tbo_flight_time($flight_details['Origin']['DepartTime']); ?></h3>
                                             
                                             <samp class="fz13 t777"><?php if($flight_details['Origin']['Terminal']!=="") { ?>
						Terminal - 
							<?php echo $flight_details['Origin']['Terminal'];  ?>
						<?php } ?></samp>
                                          </div>
                                          <div class="col-lg-3 col-md-2 col-4 ar_duration p0 align-self-center pr-2">
                                             <label class=" detduration  detduration1">
                                                <i class="dot"></i>
                                                <span class="text text1 "><?php echo time_duration($flight_details['Origin']['DepartTime'],$flight_details['Destination']['ArrivalTime']); ?></span>
                                                <i class="  plain1">✈</i>
                                             </label>
                                             <label class=" testdur1">Flight Duration</label>
                                          </div>
                                          <div class="col-lg-3 col-md-4 col-4 ar_time p0 det_lg3 text-right mpl15">
                                             <samp class="fz11 mb5 t777"><?php echo tbo_flight_date($flight_details['Destination']['ArrivalTime']); ?></samp>
                                             <h3 class="fzbold tblue  timefnt1 pt-2"><span class=" upper1  "><?php echo $flight_details['Destination']['AirportCode']; ?>
                                                </span> <?php   echo tbo_flight_time($flight_details['Destination']['ArrivalTime']); ?></h3>
                                             <!--   <samp class=" fz13">Mumbai India</samp>
                                       <samp class="fz13">Mumbai</samp> -->
                                             <samp class="fz13 t777"><?php if($flight_details['Destination']['Terminal']!=="") { ?>
						Terminal-<?php echo $flight_details['Destination']['Terminal'];  ?>
						<?php } ?></samp>
                                          </div>
                                       </div>

                                       <div class="row w100 m0 mt-3  fz13 lastdv">
                                          <div class="col-lg-2 col-md-3 col-4 p0"><b>Economy</b></div>
                                          <div class="col-lg-3 col-md-3 col-3 p0 refundable">
                                             <label class="seatleft"><?php if($first_segment['NoOfSeatAvailable']){ echo "<label class='seatleft'><i class='fa fa-user'></i> &nbsp;".$first_segment['NoOfSeatAvailable']; ?>  Seat Left <?php } ?></label>
                                          </div>
                                          <div class="col-lg-4 col-md-3 col-3 p0 refundable">
                                            <?php if($flight_data['IsRefundable']){ ?>
							<label class="refundable">Refundable</label>
						<?php }else{ ?>
							<label class="non_refundable">Non Refundable</label>
						<?php } ?>
                                          </div>
                                         <div class="col-lg-3 col-md-3 col-4 p0 mtright" data-toggle="modal" data-flight-farerule="true" data-target="#farebreakup" tid="<?php echo $TraceId; ?>" rindex="<?php echo encode_url($flight_data['ResultIndex']); ?>"><b class="mfz12 pointer link">Fare Rule</b></div>
                                       </div>
                                       <div class="layover w-100">
                                          <samp>
										  
										 
										 <?php if(isset($layovervalue[$SegmentsKey][$SegmentDetailKey]))
										{ 
										if($layovervalue[$SegmentsKey][$SegmentDetailKey]) { 
										echo $flight_details['Destination']['CityName'];
										    echo " | Layover: ".covertintoHM($layovervalue[$SegmentsKey][$SegmentDetailKey]);
										}
										} ?>
                                          </samp>
                                       </div>
                                    </div>
									
									<?php } ?>
                                 </div>
								 
							  <?php } ?>
                              </div>
                              <!-- flight details -->


                           </div>
                           <!-- flight fare details show End  -->
                        </div>
                     </div>
					 <?php } } } else {
		 
		 echo $air_result['Response']['Error']['ErrorMessage'];
		 	
	 } ?>
	 
	 <div class="noflighob text-center dnone">

	<p style="margin-top: 50px;">No Onward flight found that matches your filter criteria.</p>

	</div>	
                  </div>
               </div>

               <div class=" col-md-6 col-6 flight_free pl-0">
                  
                  <div id="flightResultib">
                     <div class="m-0 row sorting_tittle2 ">
                        <div class="col-lg-12 col-md-12 col-12">
                           <div class="row">
                              <div class="col-lg-2 col-2 p0 align-self-center">
                                
                              </div>
                              <div class="col-lg2 col-2 ar_time p0 pl5 align-self-center">
                                 <a href="javascript:void(0);" title=""  id="IBSort_Departureib">Depart <i class="fa fa-sort-up"></i></a>
                              </div>
                              <div class="col-lg-3 col-3 ar_duration p0 align-self-center text-center">
                                 <a href="javascript:void(0);" title=""  id="IBSort_Arrivalib">Arrive <i class="fa fa-sort-up"></i></a>
                              </div>
                              <div class="col-lg-3 col-3 ar_time p0 pl0 text-center align-self-center mp0 mtright">
                                 <a href="javascript:void(0);" title=""  id="IBSort_Durationib">Duration <i class="fa fa-sort-up"></i></a>
                              </div>
                              <div class="col-lg-2  col-md-2 p0 text-right align-self-center">
                                 <a href="javascript:void(0);" title="" id="IBSort_PubPriceib">Price <i class="fa fa-sort-up"></i></a>
                              </div>
                           </div>
                        </div>

                     </div>
					 
					 <?php 
					 	if($air_result['Response']['Error']['ErrorCode']==0)
		{
			
			
		$flight_reslutreturn = $air_result['Response']['Result'][1];
		if($flight_reslutreturn)
		{
			  foreach($flight_reslutreturn as $key_IB=>$flight_data){  
			   $PublishedFare_IB=$flight_data['Fare']['PublishedFare'];
			   $keyadd=$key_IB+1;
			  ?>
                     <div class="row m-0 flight_fare aj_o_fare striper  striperight" air-sort="sorting"  attr-obfare onclick="ibfare(this.innerHTML,<?php echo $PublishedFare_IB; ?>,<?php echo $key_IB; ?>);" id="result_<?php echo $key+$keyadd; ?>">
                        <div class="col-lg-9 col-md-8 col-12  pr-md-0" air-index="<?php echo $key+$keyadd; ?>">
										<?php  
			 unset($totaltraveltime_IB,$layovervalue_IB,$layover_time_IB,$segment_time_IB,$layover_IB,$air_AirlineCode_IB,$air_Airline_name_IB,$air_FlightNumber_IB);
				foreach($flight_data['Segments'] as $flight_segment){ 
				
				          
						  	foreach($flight_segment as $flight_segvia)
					{
						
						$air_AirlineCode_IB[]=$flight_segvia['Airline']['AirlineCode'];
						$air_Airline_name_IB[]=$flight_segvia['Airline']['AirlineName'];
						$air_FlightNumber_IB[]=$flight_segvia['Airline']['FlightNumber'];
						
						$layover_time_IB[]=$flight_segvia['Origin']['AirportCode']."_".$flight_segvia['Origin']['DepartTime'];
						$layover_time_IB[]=$flight_segvia['Destination']['AirportCode']."_".$flight_segvia['Destination']['ArrivalTime'];
						 $middletime=journey_time($flight_segvia['Origin']['AirportCode'],$flight_segvia['Destination']['AirportCode'],$flight_segvia['Origin']['DepartTime'],$flight_segvia['Destination']['ArrivalTime']);
						$segment_time_IB[]=hour_minute_format_remove($middletime);
					} 
					
						$final_AirlineCode_IB=array_unique($air_AirlineCode_IB);
						$final_air_Airline_name_IB=array_unique($air_Airline_name_IB);
						$final_air_FlightNumber_IB=array_unique($air_FlightNumber_IB);
						$final_AirlineCode_count_IB=count($final_AirlineCode_IB);
											
					
						$layover_IB=layovertime($layover_time_IB);
						$layovervalue_IB[]=$layover_IB;
						
						
						// $totaltraveltime_IB[]=total_travel_duration($layover_IB,$segment_time_IB); 
				
				
				
						$first_segment = reset($flight_segment); 
						$end_segment = end($flight_segment);  
						
						
						
						?>
                           <div class="row ptb8 m0  w-100">
                              <div class="col-lg-2 col-2 p0">
							  <?php if($final_AirlineCode_count_IB==1) { 
								 
										$airline_name=$final_air_Airline_name_IB[0];	
										$airline_code=$final_AirlineCode_IB[0];	
										$flight_code=$final_air_FlightNumber_IB[0];
								 ?>
                                 <img src="<?php echo base_url(); ?>webroot/airline-images/<?php echo $airline_code;?>.png" alt="<?php echo $airline_name; ?>" air-airline-logo="<?php echo base_url(); ?>webroot/airline-images/<?php echo $airline_code;?>.png" class="logo">
                                 <label class="ar_name mt-1">
                                    <samp class="" id="airlinenameib_<?php echo $key_IB; ?>" air-airlinename="<?php echo $airline_name; ?>"><?php echo $airline_name; ?></samp>
                                    <samp><?php echo $airline_code.'-'.$flight_code ; ?></samp>
                                 </label>
								 
							  <?php }  else { ?>
							       <img src="<?php echo base_url(); ?>webroot/airline-images/<?php echo $final_AirlineCode_IB[0];?>.png" alt="<?php echo $final_air_Airline_name_IB[0]; ?>" air-airline-logo="<?php echo base_url(); ?>webroot/airline-images/<?php echo $final_AirlineCode_IB[0];?>.png"  class="logo">
                                 <label class="ar_name mt-1">
                                    <samp class="" id="airlinenameib_<?php echo $key_IB; ?>" air-airlinename="<?php echo $final_air_Airline_name_IB[0]; ?>"><?php echo $final_air_Airline_name_IB[0]; ?></samp>
                                    <samp><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="<?php echo$connection_airline_name;?>"><?php echo $carriercount; ?> more</a></samp>
                                 </label>
							  <?php } ?>
                              </div>
                              <div class="col-lg-7 col-10">
                                 <div class="row m0">
                                    <h5 class="col-6 p0 arrpd  mb-0" id="departureib_<?php echo $key_IB; ?>" air-departtime_return="<?php $DepTimeib= tbo_flight_time($first_segment['Origin']['DepartTime']); echo get_depart_time($DepTimeib); ?>"><span class="tts_ft_dep"> <?php echo $DepTimeib; ?></span>
                                       <br><label class="destlabel  mb-0"><samp class="tts_ft_dest"> <?php echo $first_segment['Origin']['CityName']; ?></samp> </label>
                                    </h5>
                                    <h5 class="col-6 arrpd  mb-0" id="arrivalib_<?php echo $key_IB; ?>"> <span class="tts_ft_dep"><?php echo tbo_flight_time($end_segment['Destination']['ArrivalTime']); ?></span> <br><label class="destlabel  mb-0"><samp class="tts_ft_dest"> <?php echo $end_segment['Destination']['CityName']; ?></samp>
                                       </label>
                                    </h5>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-12 ar_duration p0  fz13">
                                 <samp id="durationib_<?php echo $key_IB; ?>" ><?php echo time_duration($first_segment['Origin']['DepartTime'],$end_segment['Destination']['ArrivalTime']); ?></samp>
                                 <span class="stopshow"> <b class="non stop"></b> </span>
								 <?php  
									$air_stop=count($flight_segment)-1; 
									if($air_stop==0){
										 $air_stops="Non Stop";
									}else{
										 $air_stops=$air_stop." Stop";
									} ?>
                                 <samp> <?php echo $air_stops; ?></samp>
                              </div>
                           </div>

				<?php } ?> 	
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 ar_inr text-md-right">

			<?php 
			
				$fligth_commetion=$flight_data['Fare']['Discount']+$flight_data['Fare']['CommissionEarned']+$flight_data['Fare']['PLBEarned']+$flight_data['Fare']['IncentiveEarned'];
				
				$fare_type=faretype_status($flight_data['Source']);
			
				if($isdomestic=="true"){
					if($fare_type){
						$fare_type="Coupon";
					}else{
						$fare_type="Normal";
					}
				}else{
					if($fare_type)
						{
							$fare_type="Coupon";
					    }
						elseif($fligth_commetion==null || $fligth_commetion==0){
						$fare_type="Soto";
					}else{
						$fare_type="Normal";
					}
				}
		
			   /* Markup Calculation  */
			   
		
				
			if(isset($air_markup_array[$airline_code]) || isset($air_markup_array["ALL"])){
				$flight_fare=$flight_data['Fare']['PublishedFare'];
				$markup_value=airline_markup_value($air_markup_array,$airline_code,$fare_type,$flight_fare); 
				
			 } else {
				 $markup_value=0;
			 }
			 
			 
			 /* Discount Amount */
			 
			 $discount_amount = round(get_discount_value($fligth_commetion,$air_discount_val));
			 
			 /* publidh fare With Markup  */
			 $total_amount = round(($flight_data['Fare']['PublishedFare']+$markup_value)-$discount_amount);  ?>
                           <samp class="fz20 fw_4 tblue p_aj" id="PubPriceib_<?php echo $key_IB; ?>"><span class="inr_rupes" air-price="<?php echo round($total_amount); ?>"><i class="fa fa-inr"></i></span><?php echo change_money_format($total_amount);  ?></samp>
                           
                          <!--  <label data-toggle-btn="true" attr-farecenter="" class="pointer link logo_color2 mb-0 hidden-md-up">Details</label> -->
                            <label class="hidden-md-up mtright logo_color2" data-toggle="modal" data-flight-farerule="true" data-target="#farebreakup" tid="<?php echo $TraceId; ?>" rindex="<?php echo encode_url($flight_data['ResultIndex']); ?>"><span class="fs_13 fw_5 pointer link">Fare Rule</span></label>
                        </div>


                        <!-- flight details heading div -->
                        <div class="row fare_title ">
                           <div class="col-lg-4 col-md-4 col-6 details fz13 d-none d-md-block p-0">
                              <label data-toggle-btn="true" class="pointer link" id="flight_data"><samp><i class="fa fa-plane pr-2"> </i></samp> flight
                                 details</label>
                           </div>
                           <div class="col-lg-4 col-md-4 col-6   details fz13 p-0">
                              <label class="refundable"><?php if($flight_data['IsRefundable']){ ?>
								<label class="refundable"  air-faretype="Refundable">Refundable</label>
							<?php }else{ ?>
								<label class="non_refundable"  air-faretype="Non Refundable">Non Refundable</label>
								<?php } ?></label>
                           </div>

                        </div>
                        <!-- flight details heading div End-->
                        <!-- flight fare details show -->
                        <div class="row flight_details gray_bg dnone" data-toggle-show="true">

                           <!-- Tab panes -->
                           <div class="tab-content detail_content ptb15   ">
                              <div class="tab-pane active" role="tabpanel" aria-expanded="true">
							  <?php  foreach($flight_data['Segments'] as $SegmentsKey_IB=>$flight_segment){ 
								
								$first_segment = reset($flight_segment); 
								
								
								$end_segment = end($flight_segment); 
								
						?>	
                                 <div class="row m0">
                                    <h5 class="f_tittle f_tittle<?php echo $j; ?>">
                                       <samp class="fz20">✈</samp><?php echo $first_segment['Origin']['CityName']; ?> - <?php echo $end_segment['Destination']['CityName']; ?>
                                    </h5>
									<?php foreach ($flight_segment as $SegmentDetailKey_IB=>$flight_details){ ?>
                                    <div class="row m0 roundtrip_det">
                                       <div class="row m0 w100">
                                          <div class="col-lg-2 col-md-2 col-7 p0 onmbil">
                                             <img src="<?php echo base_url(); ?>/webroot/airline-images/<?php echo  $flight_details['Airline']['AirlineCode']; ?>.png" alt="<?php echo  $flight_details['Airline']['AirlineName']; ?> Airline " class="logo">
                                             <label class="ar_name mar_name">
                                                <samp><?php echo  $flight_details['Airline']['AirlineName']; ?></samp>
                                                <samp><?php echo  $flight_details['Airline']['AirlineCode']; ?>-<?php echo  $flight_details['Airline']['FlightNumber']; ?></samp>
                                             </label>
                                          </div>
                                          <div class="col-lg-4 col-md-4 col-4 text-left">
                                             <samp class="fz11 mb5 t777"><?php echo tbo_flight_date($flight_details['Origin']['DepartTime']); ?></samp>
                                             <h3 class="fzbold tblue  timefnt1 pt-2"><span class=" upper1 "> <?php 	echo $flight_details['Origin']['AirportCode'];  ?>
                                                </span><?php echo tbo_flight_time($flight_details['Origin']['DepartTime']); ?></h3>
                                             <!--  <samp class=" fz13">Delhi India</samp>
                                       <samp class=" fz13">Indira Gandhi Airport</samp> -->
                                             <samp class="fz13 t777">Terminal - 	<?php echo $flight_details['Origin']['Terminal'];  ?></samp>
                                          </div>
                                          <div class="col-lg-3 col-md-2 col-4 ar_duration p0 align-self-center pr-2">
                                             <label class=" detduration  detduration1">
                                                <i class="dot"></i>
                                                <span class="text text1 "><?php echo time_duration($flight_details['Origin']['DepartTime'],$flight_details['Destination']['ArrivalTime']); ?></span>
                                                <i class="  plain1">✈</i>
                                             </label>
                                             <label class=" testdur1">Flight Duration</label>
                                          </div>
                                          <div class="col-lg-3 col-md-4 col-4 ar_time p0 det_lg3 text-right mpl15">
                                             <samp class="fz11 mb5 t777"><?php echo tbo_flight_date($flight_details['Destination']['ArrivalTime']); ?></samp>
                                             <h3 class="fzbold tblue  timefnt1 pt-2"><span class=" upper1  "><?php echo $flight_details['Destination']['AirportCode']; ?>
                                                </span><?php   echo tbo_flight_time($flight_details['Destination']['ArrivalTime']); ?> </h3>
                                             <!--   <samp class=" fz13">Mumbai India</samp>
                                       <samp class="fz13">Mumbai</samp> -->
                                             <samp class="fz13 t777">Terminal - <?php echo $flight_details['Destination']['Terminal'];  ?></samp>
                                          </div>
                                       </div>

                                       <div class="row w100 m0 mt-3  fz13 lastdv">
                                          <div class="col-lg-2 col-md-3 col-4 p0"><b>Economy</b></div>
                                          <div class="col-lg-3 col-md-3 col-3 p0 refundable">
                                             <label class="seatleft"><?php if($first_segment['NoOfSeatAvailable']){ echo "<label class='seatleft'><i class='fa fa-user'></i> &nbsp;".$first_segment['NoOfSeatAvailable']; ?>  Seat Left <?php } ?></label>
                                          </div>
                                          <div class="col-lg-4 col-md-3 col-3 p0 refundable">
                                            <?php if($flight_data['IsRefundable']){ ?>
								<label class="refundable">Refundable</label>
							<?php }else{ ?>
								<label class="non_refundable">Non Refundable</label>
							<?php } ?>
                                          </div>
                                         <div class="col-lg-3 col-md-3 col-4 p0 mtright" data-toggle="modal" data-flight-farerule="true" data-target="#farebreakup" tid="<?php echo $TraceId; ?>" rindex="<?php echo encode_url($flight_data['ResultIndex']); ?>"><b class="mfz12 pointer link">Fare Rule</b></div>
						
                                       </div>
                                       <div class="layover w-100">
                                          
										  <samp>
						
										 
										 <?php if(isset($layovervalue_IB[$SegmentsKey_IB][$SegmentDetailKey_IB]))
										{ 
										if($layovervalue_IB[$SegmentsKey_IB][$SegmentDetailKey_IB]) { 
										echo $flight_details['Destination']['CityName'];
										    echo " | Layover: ".covertintoHM($layovervalue_IB[$SegmentsKey_IB][$SegmentDetailKey_IB]);
										}
										} ?>
						
						</samp>
                                          
                                       </div>
                                    </div>
									
									<?php } ?>
                                 </div>
								 
			  <?php } ?>
                              </div>
                              <!-- flight details -->


                           </div>
                           <!-- flight fare details show End  -->
                        </div>
                     </div>
					 <?php }  }
		}  else { ?>
						 <div class="noflighib text-center dnone">

	<p style="margin-top: 50px;">No Return flight found that matches your filter criteria.</p>

	</div>	
	 
		<?php } ?>	 
                  </div>
               </div>



            </div>
         </section>
      </div>
   </div>
</main>


<div class="roundtrip_pricebottom price_bottom">
      <div class="container-fluid">
         <!--Round Trip desktop Buttom Blue div End-->
          		<div class="row ">
          			  <div class="col-md-4 bottom_result_price row m0  align-items-center justify-content-between " id =  "onword_push">
               <div class="row">
                  <div class="col-md-4 ">
                     <div class="section_book1 ">
                        <img src="<?php echo site_url('/'); ?>webroot/images/G8.png" class=" mr5">
                     </div>
                     <span class="fs_12">
                        <span class=" fight_catch">Indigo</span>
                        <span class="data_flight1 fight_catch">

                           <span>6E</span>
                           -<span> 171</span>
                        </span>
                     </span>
                  </div><!-- end ngIf: so !=null && so.segDTL !='' -->
                  <div class="col-md-2 col-sm-3">
                     <p class="filter_flight">04:50</p>
                     <p class="price_round1 ">DEL</p>
                  </div>
                  <div class="col-md-1">
                     <span class="price_arrow"></span>
                  </div>
                  <div class="col-md-2 col-sm-3">
                     <p class="filter_flight ">07:10</p>
                     <p class="price_round1 ">BOM</p>
                  </div>
                  <div class="col-md-3 col-sm-6 text-right">
                     <p class="price_round">
                        <span class=""></span>
                        <span>2,773</span>
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-sm-4 bottom_result_price row m0 align-items-center justify-content-between " id  =  "return_push">
               <div class="row">
                  <div class="col-md-4 ">
                     <div class="section_book1 ">
                        <img src="<?php echo site_url('/'); ?>webroot/images/G8.png" class=" mr5">
                     </div>
                     <span class=" fs_12">
                        <span class=" fight_catch">Indigo</span>
                        <span class="data_flight1 fight_catch">
                           <span>6E-171</span>
                        </span>
                     </span>
                  </div>
                  <div class="col-md-2 col-sm-3">
                     <p class="filter_flight">04:50</p>
                     <p class="price_round1 ">DEL</p>
                  </div>
                  <div class="col-md-1">
                     <span class="price_arrow"></span>
                  </div>
                  <div class="col-md-2 col-sm-3">
                     <p class="filter_flight ">07:10</p>
                     <p class="price_round1 ">BOM</p>
                  </div>
                  <div class="col-md-3 col-sm-6 text-right">
                     <p class="price_round">
                        <span class=""></span>
                        <span>2,773</span>
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-sm-4  d-flex align-items-center mo-price-detail p-0 ">
               <div class="row w-100">
                  <div class="col-7  d-flex align-items-center justify-content-end ">
                     <p class="price_round mb-0">Grand Total: <i class="fa fa-inr pr-1"></i>
                        <span  id  = "putprice" class="fz18"> 5,518</span>
                     </p>
                  </div>
                  <div class="col-5 d-flex align-items-center justify-content-end">
                     <button type="submit" class="btn secondry_bg w-100 fz13 secondry_color common_booking" id  =  "submitBooking"> Book Now</button>
                  </div>
               </div>
            </div>
          		</div>
      </div>
   </div>

<div class="tts_modal fade modal" id="farebreakup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog w800" role="document">
    <div class="modal-content">
	 <div class="modal-header">
		 <h5 class="modal-title text-center w100">Fare Rules</h5> 
		 <button type="button" class="close fareclose model_close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>	
      <div class="modal-body pt0 ralative_hide">
      	
				<!-- flight fare details show -->
				<div class="detail_content ptb15  fare_rule_scroll scrollauto">
				  
				  <div class="row">
					<div class="col-lg-12 p0"> 
						<div class="p15 fareruledata"></div>
					</div>
				  </div><!-- flight frule -->
				 
				</div>
		</div>
		<!-- flight fare details show End  --> 
      </div> <!-- modal body end -->

    </div>
  </div>

<div class="modal fade modal" id="pricechange" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog w450" role="document">
    <div class="modal-content">
      <div class="modal-header brb0">
        <h5 class="modal-title text-center w100" id="pricemyModalLabel">Confirming Your Flight(s)</h5>	
      </div>
      <div class="row middlehr m0"></div>
	  
      <div class="modal-body session-text">
		<p id="pricechangeinfo"></p>
		
	   <div class="fucontinue">
	    <div class="row justify-content-center mb15 mlr0">
			<div class="col col-auto">
				<a href="javascript:void(0);" class="btn go_button   secondry_bg  secondry_color p-2" id="roundclosemodal" data-dismiss="modal">Select Another Flight</a>
			</div> 
			<div class="col col-auto">
				<a href="<?php echo base_url('flight/booking_details'); ?>" class="btn go_button   secondry_bg  secondry_color p-2">Continue</a> 
			</div>      
		</div>
      </div>
         
      </div> <!-- modal body end -->
    </div>
  </div>
</div>


<?php  $this->load->view("include/footer"); ?>