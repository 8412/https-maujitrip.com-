<?php $this->load->view('include/header'); ?>
<?php $this->load->view('modify_search'); ?>
<style>
    .flight_detailsblock:last-child .layover{display:none;}
</style>

<?php $search_data = $_GET; ?>
<input type="hidden" id="get_jtype" value="<?php echo $search_data['journeytype']; ?>">
<main class="container-fluid top_padding_flight tts_bg_sky">
    <div class="container">
        <div class="row">
            <?php $this->load->view('fliter'); ?>
            <section class="col-lg-9 pl-0 mob_rit0">
                <div class="row m-0">
                    <div class="row w-100 sorting_tittle2 hidden-lg-down m-0  p-1">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="row">
                                <div class="col-lg-2 col-3 pl15 align-self-center p-0"> <b class="fs_13">Sorted By:</b> </div>
                                <div class="col-lg-2 col-3 ar_time pl5 align-self-center"> <a href="javascript:void(0);"
                                        title="" id="OBSort_Departure">Depart <i class="fa fa-sort-up"></i></a> </div>
                                <div class="col-lg-2 col-3 ar_duration p0 align-self-center "> <a
                                        href="javascript:void(0);" title="" id="OBSort_Arrival">Arrive <i
                                            class="fa fa-sort-up"></i></a> </div>
                                <div class="col-lg-2 col-3 ar_time pl0 text-center align-self-center mp0 mtright"> <a
                                        href="javascript:void(0);" title="" id="OBSort_Duration">Duration <i
                                            class="fa fa-sort-up"></i></a> </div>
                                <div class="col-lg-2 col-3 ar_time pl0 text-center align-self-center mp0 mtright"> <a
                                        href="javascript:void(0);" title="" id="OBSort_PubPrice">Price <i
                                            class="fa fa-sort-up"></i></a> </div>
                            </div>
                        </div>
                    </div>
                    <div id="flightResult" class="w-100">
                        <?php if ($air_result['Response']['Error']['ErrorCode'] == 0) {
    $TraceId = $air_result['Response']['Search_Token'];
    $flight_reslut = $air_result['Response']['Result'][0];
    if ($flight_reslut) {
        foreach ($flight_reslut as $key => $flight_data) {
            $baggagedetails = ''; ?>
                        <div class="row m-0 flight_fare aj_o_fare hover" air-sort="sorting"
                            id="result_<?php echo $key; ?>">
                            <div class="col-lg-8 col-md-8 col-9" air-index="<?php echo $key; ?>">
                                <?php unset($totaltraveltime, $layovervalue, $layover_time, $segment_time, $layover, $air_AirlineCode, $air_Airline_name, $air_FlightNumber);
            foreach ($flight_data['Segments'] as $SegmentsKey => $flight_segment) {
                foreach ($flight_segment as $flight_segvia) {
                    $air_AirlineCode[] = $flight_segvia['Airline']['AirlineCode'];
                    $air_Airline_name[] = $flight_segvia['Airline']['AirlineName'];
                    $air_FlightNumber[] = $flight_segvia['Airline']['FlightNumber'];
                    $layover_time[] = $flight_segvia['Origin']['AirportCode'].'_'.$flight_segvia['Origin']['DepartTime'];
                    $layover_time[] = $flight_segvia['Destination']['AirportCode'].'_'.$flight_segvia['Destination']['ArrivalTime'];
                    $middletime = journey_time($flight_segvia['Origin']['AirportCode'], $flight_segvia['Destination']['AirportCode'], $flight_segvia['Origin']['DepartTime'], $flight_segvia['Destination']['ArrivalTime']);
                    $segment_time[] = hour_minute_format_remove($middletime);
                }
                $final_AirlineCode = array_unique($air_AirlineCode);
                $final_air_Airline_name = array_unique($air_Airline_name);
                $final_air_FlightNumber = array_unique($air_FlightNumber);
                $final_AirlineCode_count = count($final_AirlineCode);
                $first_segment = reset($flight_segment);
                $end_segment = end($flight_segment);
                $layover = layovertime($layover_time);
                $layovervalue[] = $layover; // $totaltraveltime[]=total_travel_duration($layover,$segment_time);?>
                                <div class="row ptb8 m0">
                                    <div class="col-lg-3 col-2 p0">
                                        <?php if ($final_AirlineCode_count == 1) {
                    $airline_name = $final_air_Airline_name[0];
                    $airline_code = $final_AirlineCode[0];
                    $flight_code = $final_air_FlightNumber[0]; ?>
                                        <img src="<?php echo base_url(); ?>webroot/airline-images/<?php echo $airline_code; ?>.png"
                                            alt="<?php echo $airline_name; ?>"
                                            air-airline-logo="<?php echo base_url(); ?>webroot/airline-images/<?php echo $airline_code; ?>.png"
                                            class="logo">
                                        <label class="ar_name mt-1"> <samp class="" id="airlinename_<?php echo $key; ?>"
                                                air-airlinename="<?php echo $airline_name; ?>"><?php echo $airline_name; ?></samp>
                                            <samp><?php echo $airline_code.'-'.$flight_code; ?></samp> </label>
                                        <?php
                } else {
                    $connection_airline_name = '';
                    $carriercount = count($final_AirlineCode) - 1;
                    foreach ($final_AirlineCode as $carrierkey => $carriercodes) {
                        if ($carrierkey !== 0) {
                            $connection_airline_name .= $final_air_Airline_name[$carrierkey].', ';
                        }
                    }
                    $connection_airline_name = rtrim($connection_airline_name, ', '); ?>
                                        <img src="<?php echo base_url(); ?>webroot/airline-images/<?php echo $final_AirlineCode[0]; ?>.png"
                                            alt="<?php echo $final_air_Airline_name[0]; ?>"
                                            air-airline-logo="<?php echo base_url(); ?>assets/airline-images/<?php echo $final_AirlineCode[0]; ?>.png"
                                            class="logo" />
                                        <label class="ar_name mt-1"> <samp class="" id="airlinename_<?php echo $key; ?>"
                                                air-airlinename="<?php echo $final_air_Airline_name[0]; ?>"><?php echo $final_air_Airline_name[0]; ?></samp>
                                            <samp><a href="javascript:void(0)" data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="<?php echo $connection_airline_name; ?>"><?php echo $carriercount; ?>
                                                    more</a></samp> </label>
                                        <?php
                } ?>
                                    </div>
                                    <div class="col-lg-6 col-7">
                                        <div class="row align-items-center ">
                                            <h5 class="col-4 pr-0 pt-2 arrpd" air-departtime="<?php $DepTime = tbo_flight_time($first_segment['Origin']['DepartTime']);
                echo get_depart_time($DepTime); ?>" id="departure_<?php echo $key; ?>"> <span class="tts_ft_dep"><?php echo $DepTime; ?> </span>
                                                <br><label class="destlabel"><samp class="tts_ft_dest">
                                                        <?php echo $first_segment['Origin']['CityName']; ?></samp>
                                                </label> </h5>
                                            <h5 class="col-4 pr-0 pt-2 text-right arrpd" id="arrival_<?php echo $key; ?>">
                                            <span class="tts_ft_dep"><?php echo tbo_flight_time($end_segment['Destination']['ArrivalTime']); ?></span>
                                                <br><label class="destlabel"><samp class="tts_ft_dest">
                                                        <?php echo $end_segment['Destination']['CityName']; ?></samp>
                                                </label> </h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-3 ar_duration p0 align-self-center fz13"> <samp
                                            id="duration_<?php echo $key; ?>"><?php echo time_duration($first_segment['Origin']['DepartTime'], $end_segment['Destination']['ArrivalTime']); ?></samp>
                                        <?php $stop_html = '';
                $air_stop = count($flight_segment) - 1;
                if ($air_stop == 0) {
                    $air_stops = 'Non Stop';
                } else {
                    $air_stops = $air_stop.' Stop';
                }
                if ($air_stop == 0) {
                    $stop_html = "<b class='non stop'></b>";
                } elseif ($air_stop == 1) {
                    $stop_html = "<b class='stop1'></b>";
                } elseif ($air_stop == 2) {
                    $stop_html = "<b class='stop1' style='left: 34%;'></b> <b class='stop2'></b>";
                } elseif ($air_stop == 3) {
                    $stop_html = "<b class='stop1' style='left: 25%;'></b> <b class='stop2' style='left: 49%;'></b> <b class='stop3'></b>";
                } else {
                    $stop_html = "<b class='non stop'></b>";
                } ?>
                                        <span class="stopshow"> <?php echo $stop_html; ?> </span> <samp
                                            air-stops="<?php echo $air_stop; ?>"> <?php echo $air_stops; ?></samp>
                                    </div>
                                </div>
                                <div class="row divider"></div>
                                <?php
            } ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-3 align-self-center plr10">
                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-12 ar_inr p0 text-center">
                                        <?php $markup_value = 0;
            $fligth_commetion = $flight_data['Fare']['Discount'] + $flight_data['Fare']['CommissionEarned'] + $flight_data['Fare']['PLBEarned'] + $flight_data['Fare']['IncentiveEarned'];
            $fare_type = faretype_status($flight_data['Source']);
            if ($isdomestic == 'true') {
                if ($fare_type) {
                    $fare_type = 'Coupon';
                } else {
                    $fare_type = 'Normal';
                }
            } else {
                if ($fare_type) {
                    $fare_type = 'Coupon';
                } elseif ($fligth_commetion == null || $fligth_commetion == 0) {
                    $fare_type = 'Soto';
                } else {
                    $fare_type = 'Normal';
                }
            } /* Markup Calculation  */if (isset($air_markup_array[$airline_code]) || isset($air_markup_array['ALL'])) {
                $flight_fare = $flight_data['Fare']['PublishedFare'];
                $markup_value = airline_markup_value($air_markup_array, $airline_code, $fare_type, $flight_fare);
            } /* Discount Amount */$discount_amount = round(get_discount_value($fligth_commetion, $air_discount_val)); /* publidh fare With Markup  */
            $total_amount = round(($flight_data['Fare']['PublishedFare'] + $markup_value) - $discount_amount); ?>

                                        <samp class="fz20 fw_6 tblue" id="PubPrice_<?php echo $key; ?>"
                                            air-price="<?php echo round($total_amount); ?>">
                                            <span
                                                class="inr_rupes"><i class="fa fa-inr"></i></span><?php echo change_money_format($total_amount); ?></samp>
                                        </samp>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-4 ar_book text-right ">
                                        <a href="javascript:void(0);"
                                            class="btn go_button  btneffect radius4  secondry_color secondry_bg submitme"
                                            index="<?php echo encode_url($key); ?>">book now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- flight details heading div -->
                            <div class="col-12 p0">
                                 <div class="row fare_title ">
                                <div class="col-lg-3 col-md-3 col-4 fs_12 pl0 details ">
                                    <label data-toggle-btn="true" class="pointer link font-weight-bold" attr-farecenter> <i
                                            class="fa fa-plane pr-2"> </i>flight details</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-4 fs_12  details ">
                                    <?php if ($flight_data['IsRefundable']) {
                ?>
                                    <label class="refundable" air-faretype="Refundable">Refundable</label>
                                    <?php
            } else {
                ?>
                                    <label class="non_refundable" air-faretype="Non Refundable">Non Refundable</label>
                                    <?php
            } ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-4 fs_12 p0 details ">
                                    <?php if ($first_segment['NoOfSeatAvailable']) {?>
                                    <img src="<?php echo site_url('/'); ?>webroot/images/airline-seat-recline-extra.svg" width="20px" height="20px" style="object-fit: contain;">
                                   <label class='seatleft'> <?php  echo " &nbsp;".$first_segment['NoOfSeatAvailable']; ?>  Seat Left </label>
                                  
                                    <?php
            } ?>
                                </div>
                            </div>
                            </div>
                            <!-- flight details heading div End-->
                            <!-- flight fare details show -->
                            <div class="row flight_details gray_bg dnone" data-toggle-show="true">
                                <div class="col-12  p0 mob_xscroll">
                                    <ul class="nav nav-tabs  mobnav_wth" role="tablist">
                                        <li class="nav-item "> <a class="nav-link  active" data-toggle="tab"
                                                href="#flight_detail<?php echo $key; ?>" role="tab"
                                                aria-expanded="true">Flight Details </a> </li>
                                        <li class="nav-item "> <a class="nav-link" data-toggle="tab"
                                                href="#fbreakup<?php echo $key; ?>" role="tab" aria-expanded="true">fare
                                                breakup </a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab"
                                                href="#frule<?php echo $key; ?>" data-flight-farerule="true" role="tab"
                                                tid="<?php echo $TraceId; ?>"
                                                rindex="<?php echo encode_url($flight_data['ResultIndex']); ?>">fare
                                                Rule</a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab"
                                                href="#baggage<?php echo $key; ?>" role="tab">baggage</a> </li>
                                    </ul>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content detail_content ptb15">
                                    <div class="tab-pane active" id="flight_detail<?php echo $key; ?>" role="tabpanel"
                                        aria-expanded="true">
                                        <?php foreach ($flight_data['Segments'] as $SegmentsKey => $flight_segment) {
                $first_segment = reset($flight_segment);
                $end_segment = end($flight_segment); ?>
                                        <div class="row m0">
                                            <h5 class="f_tittle f_tittle<?php echo $SegmentsKey; ?>"> 
                                                <?php echo $first_segment['Origin']['CityName']; ?> -
                                                <?php echo $end_segment['Destination']['CityName']; ?>
                                                <?php echo Get_Date($first_segment['Origin']['DepartTime']); ?> </h5>
                                            <?php foreach ($flight_segment as $SegmentDetailKey => $flight_details) {
                    if (!empty($flight_details['Baggage'])) {
                        $Baggage = '<samp>'.$flight_details['Baggage'].' Check In Baggage Included</samp>';
                    } else {
                        $Baggage = '<samp>No Check In Baggage Included</samp>';
                    }
                    if (!empty($flight_details['CabinBaggage'])) {
                        $CabinBaggage = '<samp>'.$flight_details['CabinBaggage'].' Cabin Baggage Included</samp>';
                    } else {
                        $CabinBaggage = '<samp>No Cabin Baggage Included</samp>';
                    } /* ====== Baggage Details Start ====== */$baggagedetails .= '<div class="row baggage-heading2 mm0">											<div class="col-lg-2 col-md-2 col-4">												<img src="'.site_url().'webroot/airline-images/'.$flight_details['Airline']['AirlineCode'].'.png" alt="'.$flight_details['Airline']['AirlineName'].'" class="logo">													<label class="ar_name mar_name">													<samp>'.$flight_details['Airline']['AirlineName'].'</samp>													<samp>'.$flight_details['Airline']['AirlineCode'].'-'.$flight_details['Airline']['FlightNumber'].'</samp> 												</label>											</div>											<div class="col-lg-5 col-md-9 col-4 p0 fs_14"> 												'.$Baggage.' 																</div> 											<div class="col-lg-5 col-md-3 col-4 p0 fs_14"> 												'.$CabinBaggage.'					 											</div>										</div>'; /* ====== Baggage Details End ====== */?>
                                            <div class="row m0 flight_detailsblock">
                                                <div class="row m0 w100">
                                                    <div class="col-lg-2 col-md-2 col-7 "> <img
                                                            src="<?php echo base_url(); ?>/webroot/airline-images/<?php echo $flight_details['Airline']['AirlineCode']; ?>.png"
                                                            alt="<?php echo $flight_details['Airline']['AirlineName']; ?> Airline "
                                                            class="logo">
                                                        <label class="ar_name mar_name">
                                                            <samp><?php echo $flight_details['Airline']['AirlineName']; ?>
                                                                <b class="hidden-md-up">, </b></samp>
                                                            <samp><?php echo $flight_details['Airline']['AirlineCode']; ?>-<?php echo $flight_details['Airline']['FlightNumber']; ?><b
                                                                    class="hidden-md-up"> </b></samp>
                                                            <!--<samp class=""><?php $air_stop = count($flight_segment) - 1;
                    if ($air_stop == 0) {
                        echo $air_stops = 'Non Stop';
                    } else {
                        echo $air_stops = $air_stop.' Stop';
                    } ?></samp>--></label>
                                                    </div>
                                                     <div class="col-lg-1 col-md-1 col-3 p0 refundable hidden-md-up">
                                                        <?php if ($flight_data['IsRefundable']) {
                        ?>
                                                        <label class="refundable">Refundable</label>
                                                        <?php
                    } else {
                        ?>
                                                        <label class="nonrefundable">Non Refundable</label>
                                                        <?php
                    } ?>
                                                    </div>

                                                    <div class="col-lg-3 col-md-4 col-4 ar_time pl0  text-right pt-2 "> <samp
                                                            class="fz13  mb-1"><?php echo tbo_flight_date($flight_details['Origin']['DepartTime']); ?></samp>
                                                        <h3 class="fzbold tblue tts_ft_det_time">
                                                                <?php echo $flight_details['Origin']['AirportCode']; ?>
                                                            <?php echo tbo_flight_time($flight_details['Origin']['DepartTime']); ?>
                                                            </span></h3> <samp
                                                            class=" d-none d-lg-block fz13"><?php echo $flight_details['Origin']['CityName'].' '.$flight_details['Origin']['CountryName']; ?></samp>
                                                        <samp
                                                            class=" d-none d-lg-block fz13"><?php echo $flight_details['Origin']['AirportName']; ?></samp>
                                                        <samp><?php if ($flight_details['Origin']['Terminal'] != '') {
                        ?>
                                                            <samp class="text-center fz13">Terminal -
                                                                <?php echo $flight_details['Origin']['Terminal']; ?></samp>
                                                            <?php
                    } ?>
                                                        </samp>
                                                    </div>
                                                    <div
                                                        class="col-lg-3 col-md-2 col-4 ar_duration p0 align-self-center">
                                                        <label class="detduration "> <i class="dot"></i> 
                                                            <span class="text "><?php echo time_duration($flight_details['Origin']['DepartTime'], $flight_details['Destination']['ArrivalTime']); ?></span>
                                                            <i class="plain">✈</i> </label>
                                                        <label class=" d-none d-lg-block  testdur fz10">Flight Duration</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-4 ar_time p0  text-left pt-2"> <samp
                                                            class="fz13  mb-1"><?php echo tbo_flight_date($flight_details['Destination']['ArrivalTime']); ?></samp>
                                                        <h3 class="fzbold tblue tts_ft_det_time">
                                                                <?php echo $flight_details['Destination']['AirportCode']; ?>
                                                            <?php echo tbo_flight_time($flight_details['Destination']['ArrivalTime']); ?>
                                                        </h3> <samp
                                                            class=" d-none d-lg-block fz13"><?php echo $flight_details['Destination']['CityName'].' '.$flight_details['Destination']['CountryName']; ?></samp>
                                                        <samp
                                                            class="  d-none d-lg-block fz13"><?php echo $flight_details['Destination']['AirportName']; ?></samp>
                                                        <?php if ($flight_details['Destination']['Terminal'] != '') {
                        ?>
                                                        <samp class="fz13">Terminal -
                                                            <?php echo $flight_details['Destination']['Terminal']; ?></samp>
                                                        <?php
                    } ?>
                                                    </div>
                                                </div>
                                                <?php if (!empty($flight_data['AirlineRemark'])) {
                        ?>
                                                <div class="row w100 m0 mt-2 ml-3  fz13 text-capitalize"> <b class="mfz12">Airline Remark</b>:
                                                    <?php echo $flight_data['AirlineRemark']; ?>
                                                </div>
                                                <?php
                    } ?>
                                                <div class="row w100 m0 mt-3 ml-3  fz13 lastdv">
                                                    <div class="col-lg-3 col-md-3 col-4 p0"><b>Fare Class</b>:
                                                        <?php echo $flight_details['Airline']['FareClass']; ?>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-3 p0">
                                                        <label class="seatleft"><img src="<?php echo site_url('/'); ?>webroot/images/airline-seat-recline-extra.svg" width="18px" height="18px" style="object-fit: contain;">
                                                            <?php if ($flight_details['NoOfSeatAvailable']) {
                        echo $flight_details['NoOfSeatAvailable'];
                    } ?>
                                                            Seat left</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-3 p0 refundable d-none d-lg-block">
                                                        <?php if ($flight_data['IsRefundable']) {
                        ?>
                                                        <label class="refundable">Refundable</label>
                                                        <?php
                    } else {
                        ?>
                                                        <label class="nonrefundable">Non Refundable</label>
                                                        <?php
                    } ?>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-5 p0 mtright"><b>Craft Type</b> :
                                                        <?php echo getcrafttype($flight_details['Craft']); ?>
                                                    </div>
                                                </div>
                                              <div class="col-12 text-center">  <div class="layover"> <samp>
                                                        <?php if (isset($layovervalue[$SegmentsKey][$SegmentDetailKey])) {
                        if ($layovervalue[$SegmentsKey][$SegmentDetailKey]) {
                            echo $flight_details['Destination']['CityName'].' | Layover: '.covertintoHM($layovervalue[$SegmentsKey][$SegmentDetailKey]);
                        }
                    } ?>
                                                    </samp> </div></div>
                                            </div>
                                            <?php
                } ?>
                                        </div>
                                        <?php
            } ?>
                                    </div>
                                    <!-- flight details -->
                                    <div class="tab-pane" id="fbreakup<?php echo $key; ?>" role="tabpanel"
                                        aria-expanded="false">
                                        <div class="row">
                                            <div class="col-lg-12 p-md-0">
                                                <h5 class="f_tittle  m0">Fare breakup</h5>
                                                <table class="table ttstable fz13">
                                                    <thead>
                                                        <tr class="head">
                                                            <th>Type</th>
                                                            <th>Fare </th>
                                                            <th>Total </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $onward_basefare = 0;
            $Fare = $flight_data['Fare'];
            foreach ($flight_data['FareBreakdown'] as $key_pax => $fare_breakup) {
                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo adt_type_txt($key_pax); ?> (s)</td>
                                                            <td><span class="inr_rupes"><i class="fa fa-inr"></i></span>
															<?php $perpaxbasefare = $fare_breakup['BaseFare'] / $fare_breakup['PassengerCount'];
                echo change_money_format($perpaxbasefare); ?>x
                                                                <?php echo $fare_breakup['PassengerCount']; ?>
                                                               
                                                            </td>
                                                            <td><span class="inr_rupes"><i class="fa fa-inr"></i></span>
                                                                 <?php echo change_money_format($fare_breakup['BaseFare']);
                $onward_basefare += $fare_breakup['BaseFare']; ?>
                                                                
                                                            </td>
                                                        </tr>
                                                        <?php
            } ?>
                                                        <tr>
                                                            <td>Tax Amount</td>
                                                            <td><span class="inr_rupes"><i class="fa fa-inr"></i></span>
                                                                <?php $onward_tax = $Fare['Tax'] + $Fare['AdditionalTxnFeePub'] + $Fare['ServiceFee'];
            echo change_money_format($onward_tax); ?>
                                                            </td>
                                                            <td><span class="inr_rupes"><i class="fa fa-inr"></i></span>
                                                                <?php $onward_tax = $Fare['Tax'] + $Fare['AdditionalTxnFeePub'] + $Fare['ServiceFee'];
            echo change_money_format($onward_tax); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Other Amount</td>
                                                            <td><span class="inr_rupes"><i class="fa fa-inr"></i></span>
                                                                <?php $onword_othercharge = $Fare['OtherCharges'] + $markup_value;
            echo change_money_format($onword_othercharge); ?>
                                                            </td>
                                                            <td><span class="inr_rupes"><i class="fa fa-inr"></i></span>
                                                                <?php $onword_othercharge = $Fare['OtherCharges'] + $markup_value;
            echo change_money_format($onword_othercharge); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Discount</td>
                                                            <td><span class="inr_rupes"><i class="fa fa-inr"></i></span> -
                                                                <?php echo change_money_format($discount_amount); ?>
                                                            </td>
                                                            <td><span class="inr_rupes"><i class="fa fa-inr"></i></span> -
                                                                <?php echo change_money_format($discount_amount); ?>
                                                            </td>
                                                        </tr>
                                                        <tr class="total">
                                                            <td>Total Amount</td>
                                                            <td>&nbsp; </td>
                                                            <td class="tblue"><span class="inr_rupes"><i class="fa fa-inr"></i></span>
                                                                <?php $onward_totalfare = ($onward_basefare + $onward_tax + $onword_othercharge) - $discount_amount;
            echo change_money_format($onward_totalfare); ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- flight breakup -->
                                    <div class="tab-pane" id="frule<?php echo $key; ?>" role="tabpanel"
                                        aria-expanded="false">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="p15 fareruledata fs_13">Loading Detail</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- flight frule -->
                                    <div class="tab-pane" id="baggage<?php echo $key; ?>" role="tabpanel">
                                        <div class="row  baggage-heading">
                                            <div class="col-lg-2 col-md-2 col-2 ">
                                                <label class="ar_name mar_name"> <samp>Airline</samp> </label>
                                            </div>
                                            <div class="col-lg-5 col-md-4 col-5 "> <label  class="ar_name"><samp>Check In</samp></label> </div>
                                            <div class="col-lg-5 col-md-4 col-5 "> <label  class="ar_name"><samp>Cabin Baggage</samp></label> </div>
                                        </div>
                                        <?php echo $baggagedetails; ?>
                                    </div>
                                    <!-- flight Baggage -->
                                </div>
                                <!-- flight fare details show End  -->
                            </div>
                        </div>
                        <?php
        }
    }
} else {
    ?>
                        <div class="row bdr_sdo flight_fare hover  m-0" style="background-color: #eeeeee;">
                            <div class="mx-auto text-center"> <img
                                    src="<?php echo base_url('webroot/images/no_flight.png'); ?>" class="img-responsive"
                                    alt="flight-image">
                                <h3><?php echo check_error_isobject($air_result['Response']['Error']['ErrorMessage']); ?>
                                </h3>
                                <p>Sorry, There were no flights found for this route and date combination. We suggest
                                    you modify your search and try again.</p>
                            </div>
                        </div>
                        <?php
}?>
                    </div>
                </div>
            </section>
        </div>
    </div>






</main>

<div class="modal fade modal" id="pricechange" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog w450" role="document">
    <div class="modal-content">
      <div class="modal-header brb0">
        <h5 class="modal-title text-center w100" id="pricemyModalLabel">Confirming Your Flight(s)</h5> 
      </div>
      <div class="row middlehr m0"></div>
      <div class="modal-body session-text">
		<p id="pricechangeinfo"></p>
         
      </div> <!-- modal body end -->
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>