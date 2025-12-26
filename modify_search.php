<?php $search_data = $_GET;?>
<section class="container-fluid modifysection blue_bg">
   <?php if ($search_data['journeytype'] == "oneway" or $search_data['journeytype'] == "roundtrip") {?>
   <div class="container">
      <div class="row multimodify pt-1 pb-1">
      <div class="col-md-1 col-1 d-md-none mob_arrow">
               <samp class="left-angal-di d-md-none"><i class="fa fa-angle-left"></i></samp>
               </div>
        <div class="col-md-4 col-6 d-flex align-items-center p_0">
           <div class="row  mobile_responce w-100">
               <div class="col-md-5  col-auto  d-flex align-items-center p_0 ">
            <label class="datee m-datte"><samp><?php echo $search_data['origin']; ?></samp></label>
         </div>
         <div class="col-md-2  d-flex align-items-center m-datte "><span class="flighticon">
         <i class="fa fa-exchange d-md-none"></i><i class="fa fa-plane d-none d-md-block"></i></span></div>
         <div class="col-md-5 p0 col-auto  d-flex align-items-center justify-content-md-end">
            <label class="datee text-right m-datte"><samp><?php echo $search_data['destination']; ?></samp></label>
         </div>
           </div>
        </div>
        <div class="col-md-3 col-10  d-flex  align-items-center">
           <div class="row w-100 ">
                     <div class="col-md-6 p0 col-auto pr-2 pl-1 ">
            <label class="datee text-center"><samp
                  class="w-100"><?php echo Get_Date_Search($search_data['departdate']); ?></samp> </label>
         </div>
         <?php if ($search_data['journeytype'] == "roundtrip") {?>
         <div class="col-md-6 p0 col-auto  d-flex align-items-center ">
            <label class="datee text-right"><samp
                  class="w-100"><?php echo Get_Date_Search($search_data['returndate']); ?></samp> </label>
         </div>
         <?php }?>
           </div>
        </div>
         <div class="col-md-4 col-12  d-flex align-items-center">
            <div class="row w-100">
               <div class=" col-md-12 p0 col-11">
                  <div class="d-flex">    <label class="datee tccc hidden-md-down"><samp>Passenger, Cabin Class</samp></label>
               <label class="datee text-center tccc hidden-md-down"><samp class="w-100">
                  <?php if ($search_data['adults'] <= 1) {echo $search_data['adults'] . " Adult";
                  } else {
                     echo $search_data['adults'] . " Adults";
                     }?>
                     <?php if ($search_data['child']) {
                        if ($search_data['child'] <= 1) {echo ", " . $search_data['child'] . " Child";} else {echo ", " . $search_data['child'] . " Childs";}}?>
                     <?php if ($search_data['infant']) {if ($search_data['infant'] <= 1) {echo ", " . $search_data['infant'] . " Infant";} else {echo ", " . $search_data['infant'] . " Infants";}}?>
                     <?php echo ", " . $search_data['cabinclass']; ?></samp>
                  </label></div>
               </div>
               <div class="col-md-1 col-1   pencil-modal-list" >
               <samp class="hedprice d-md-none"><i class="fa fa-filter" data-filter-btn="true"></i><i class="fa fa-pencil" data-modifybtn="true"></i></samp>
               <samp class="hedprice d-md-none"><i class="fa fa-pencil" data-modifybtn="true" data-toggle="modal" data-target=".bd-example-modal-xl" data-blurhitbtn></i></samp>
               </div>
            </div>
         </div>

         <div class="col-md-1 col-1   d-flex align-items-center justify-content-md-end">
            <div class="text-right">

               <button type="submit" class="btn modifybtn secondry_bg w-100  secondry_color  fz13 hidden-md-down" data-modifybtn="true" data-toggle="modal" data-target=".bd-example-modal-xl" data-blurhitbtn>
                  <i class="fa fa-toggle-off"></i> Modify</button>
            </div>
         </div>
      </div>
   </div>
   <?php }?>


   <?php if ($search_data['journeytype'] == "multicity") {?>
   <div class="container">
      <div class="row multimodify  d-flex justify-content-between">
         <?php
    if ($search_data['origin']) {
        foreach ($search_data['origin'] as $key => $location) {?>
         <div class="col-md-2  col-auto  d-flex align-items-center ">
            <label class="datee"><samp><?php $code = explode(',', $location);
            echo $code[1];?></samp><samp><?php $code = explode(',', $search_data['destination'][$key]);
            echo $code[1];?></samp></label>
            <label class="datee"> <i class="fa fa-calendar"></i>
               <samp><?php echo Get_Date_Search($search_data['departdate'][$key]); ?></samp></label>
         </div>
         <?php }}?>
         <div class=" d-flex align-items-center  col-md-4 p0 col-auto">
            <label class="datee tccc"><samp>Passenger, Cabin Class</samp></label>
            <label class="datee"><samp><?php if ($search_data['adults'] <= 1) {echo $search_data['adults'] . " Adult";} else {
        echo $search_data['adults'] . " Adults";}?>
                  <?php if ($search_data['child']) {if ($search_data['child'] <= 1) {echo ", " . $search_data['child'] . " Child";} else {echo ", " . $search_data['child'] . " Childs";}}?>
                  <?php if ($search_data['infant']) {if ($search_data['infant'] <= 1) {echo ", " . $search_data['infant'] . " Infant";} else {echo ", " . $search_data['infant'] . " Infants";}}?>
                  <?php echo ", " . $search_data['cabinclass']; ?></samp></label>
         </div>
         <div class="col-md-2 col-auto   d-flex align-items-center justify-content-md-end">
            <div class="text-right">
               <button type="submit" class="btn modifybtn secondry_bg w-100  secondry_color" data-modifybtn="true" data-toggle="modal" data-target=".bd-example-modal-xl" data-blurhitbtn> <i class="fa fa-toggle-off"></i> Modify</button>
            </div>
         </div>
      </div>
   </div>
   <?php }?>
</section>



<div class="modal modify_modal fade bd-example-modal-xl pr-0" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-xl m0">
      <div class="modal-content">
         <section class="" data-multimodify="true" style="">
            <div class="container-fluid">
               <div class="container" id="flight">
                  <div class="row">
                     <div class="col-12 bgwithshadow mt-4 mb-4">
                        <h3 class="modifyh3 row">Flight Modify search</h3>
                        <div class="tab-content flight_tab_content_mob_res show">
                           <div class="tab-pane  mradius0 radius4 active" id="flight" role="tabpanel">
                              <div class="col-12">
                                <div class="row  mtb10  typedv mar_00 ">
                                     <label class="typeradio_new flight_way pointer active mt15" data_flight_selected_way="oneway" id  =  "oneway">ONEWAY
                                      </label>
                                      <label class="typeradio_new flight_way pointer mt15" data_flight_selected_way="roundtrip"  id  =  "roundtrip"> ROUND TRIP
                                      </label>
                                        <label class="typeradio_new flight_way pointer mt15" data_flight_selected_way="multicity"   id  =  "multicity"> MULTI CITY
                                      </label>
                                </div>
                                 <div class="col-12 p0" data-oneway="true">
                                    <form action="<?php echo base_url(); ?>flight/search" name="flight-form"
                                       id="oneroundform" method="GET">
                                       <input type="hidden" value="oneway" name="journeytype">
                                       <div class="row m0 searchform">
                                          <div class=" ui-widget col-12 col-sm-6 col-md-2 flg-3 p0 mb15">
                                             <input type="text" class="form-control inputtext radiusltb auto_tags border-right-0"
                                                data-from-location="true" placeholder="From" data-validation="required" data-validation-error-msg="Please enter origin" name="origin"  value="<?php  if($search_data['journeytype']!="multicity") { echo $search_data['origin']; } ?>"/>
                                             <i class="swape-city hidden-md-down"></i>
                                          </div>
                                          <div class="col-12 col-sm-6 col-md-2 flg-3 p0 mb15">
                                             <input type="text" class="form-control inputtext auto_tags pl20 border-right-0"
                                                data-to-location="true" placeholder="To" data-validation="required"
                                                data-validation-error-msg="Please enter destination" name="destination" value="<?php  if($search_data['journeytype']!="multicity") { echo $search_data['destination']; } ?>"  />
                                          </div>
                                          <div class="col-sm-6 col-md-2 p0 mb15 fdate-3 ">
                                             <input type="text" class="form-control inputtext date_formate wbgi pl-4 border-right-0"
                                                id="datepicker1" data-depart-date="true" placeholder="Depart Date"
                                                data-validation="required" name="departdate" value="<?php  if($search_data['journeytype']!="multicity") { echo $search_data['departdate']; } ?>"  />
                                             <i class="fa fa-calendar dateicon"></i>
                                          </div>
                                          <div class="col-sm-6 col-md-2 p0 mb15 fdate-3">
                                             <input type="text" class="form-control inputtext date_formate pl-4 border-right-0"
                                                 data-return-date="true" placeholder="Return Date" name="returndate" readonly="" value="<?php  if($search_data['journeytype']!="multicity") { echo $search_data['returndate']; } ?>" />
                                             <i class="fa fa-calendar dateicon"></i>
                                          </div>
                                          <div class="col-sm-6 col-md-3 p0 mb15 pax_dv" data-parent="true">
                                             <div class="row pax-div" data-toggle-div="true">
                                                <div class="col plr10">
                                                   <label for="paxcount" class="clearfix" id="travel_count">
                                                      <span data-total-pax="true"><?php echo $search_data['adults']+$search_data['child']+$search_data['infant']; ?></span><span> Traveler(s)
                                                      </span>,
                                                      <samp class="flight_class get_class"><?php echo $search_data['cabinclass']; ?></samp>
                                                      <i class="fa fa-sort-desc faicon"></i>
                                                   </label>
                                                </div>
                                             </div>
                                             <div class="col-12 col-md-12 flightpax  pax_parent animated dnone"
                                                data-toggle-divshow="true">



                        <button type="button" class="close close_cross"  data-close-btn  =  "true">
            <span aria-hidden="true">×</span>
          </button>
                                                <div class="row  m0 mt-3 mb-3">
                                                   <div class="col-md-4 ">
                                                      <div class="main_innerdata">
                                                         <div class="col_datainner traveladd">
                                                            <label>Adult</label>
                                                            <div class="row  mb-2 radius4">
                                                               <a href="javascript:void(0);" data-adult-pre="true" class="col">−</a>
                                                               <samp data-adult-count="true" class="col"><?php echo $search_data['adults']; ?></samp>
                                                               <a href="javascript:void(0);" data-adult-next="true" class="col">+</a>
                                                               <input type="hidden" name="adults" value="<?php echo $search_data['adults']; ?>" class="adt_input">
                                                            </div>
                                                            <span>(12+ yrs)</span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-4 ">
                                                      <div class="main_innerdata">
                                                         <div class="col_datainner traveladd">
                                                            <label>Children</label>
                                                            <div class="row mb-2  radius4">
                                                               <a href="javascript:void(0);" data-child-pre="true" class="col">−</a>
                                                               <samp data-child-count="true" class="col"><?php echo $search_data['child']; ?></samp>
                                                               <a href="javascript:void(0);" data-child-next="true" class="col">+</a>
                                                               <input type="hidden" name="child" value="<?php echo $search_data['child']; ?>" class="child_input">
                                                            </div>
                                                            <span>(2+ 12 yrs)</span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-4">
                                                      <div class="main_innerdata">
                                                         <div class="col_datainner traveladd">
                                                            <label>Infant</label>
                                                            <div class="row mb-2 radius4">
                                                               <a href="javascript:void(0);" data-infant-pre="true" class="col">−</a>
                                                               <samp data-infant-count="true" class="col"><?php echo $search_data['infant']; ?></samp>
                                                               <a href="javascript:void(0);" data-infant-next="true" class="col">+</a>
                                                               <input type="hidden" name="infant" value="<?php echo $search_data['infant']; ?>" class="infent_input">
                                                            </div>
                                                            <span>(Below 2 Years)</span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>

                                        <div class="row">
                                       <div class="col-md-12">
									   <?php if($search_data['cabinclass']=="Economy") { ?>
                                          <label class="cls_pax1">
                                          Economy
                                          <input type="radio" value="Economy" name="cabinclass" checked="checked" cls="radio_type" onclick="changefareclass('Economy','get_class')">
                                          </label>
									   <?php } else { ?>
									    <label class="cls_pax1">
                                          Economy
                                          <input type="radio" value="Economy" name="cabinclass"  cls="radio_type" onclick="changefareclass('Economy','get_class')">
                                          </label>
									   <?php } ?>
                                       </div>
                                       <div class="col-md-12">
									     <?php if($search_data['cabinclass']=="Business") { ?>
                                          <label class="cls_pax1">
                                         Business
                                          <input type="radio" value="Business" name="cabinclass"  checked="checked"  cls="radio_type" onclick="changefareclass('Business','get_class')">
                                          </label>
										 <?php }  else  { ?>
										 <label class="cls_pax1">
                                         Business
                                          <input type="radio" value="Business" name="cabinclass"    cls="radio_type" onclick="changefareclass('Business','get_class')">
                                          </label>
										 <?php } ?>
                                       </div>
                                    </div>
                                        <div class="row mb-3">
                                       <div class="col-md-12">
									    <?php if($search_data['cabinclass']=="PremiumEconomy") { ?>
                                          <label class="cls_pax1">
                                          Premium Economy
                                          <input type="radio" value="PremiumEconomy"  name="cabinclass"  checked="checked" cls="radio_type" onclick="changefareclass('Premium Economy','get_class')">
                                          </label>
										<?php } else {  ?>
										 <label class="cls_pax1">
                                          Premium Economy
                                          <input type="radio" value="PremiumEconomy" name="cabinclass" cls="radio_type" onclick="changefareclass('Premium Economy','get_class')">
                                          </label>
										<?php } ?>
                                       </div>


									    <div class="col-md-12">
										 <?php if($search_data['cabinclass']=="PremiumBusiness") { ?>
                                          <label class="cls_pax1">
                                           Premium Business
                                          <input type="radio" value="PremiumBusiness" checked="checked" name="cabinclass" cls="radio_type" onclick="changefareclass('Premium Business','get_class')">
                                          </label>

										 <?php } else { ?>
										     <label class="cls_pax1">
                                           Premium Business
                                          <input type="radio" value="PremiumBusiness" name="cabinclass" cls="radio_type" onclick="changefareclass('Premium Business','get_class')">
                                          </label>
										 <?php  } ?>
                                       </div>

									   <div class="col-md-12">
									   <?php if($search_data['cabinclass']=="First") { ?>
                                          <label class="cls_pax1">
                                           First
                                          <input type="radio" value="First"  checked="checked" name="cabinclass" cls="radio_type" onclick="changefareclass('First','get_class')">
                                          </label>
									   <?php  } else { ?>
									    <label class="cls_pax1">
                                           First
                                          <input type="radio" value="First" name="cabinclass" cls="radio_type" onclick="changefareclass('First','get_class')">
                                          </label>
									   <?php  } ?>
                                       </div>
                                     <!--   <div class="col-md-6">
                                         <a href="javascript:void(0);" class="done radius4 mbtneffect" data-close-btn="true">Done</a>
                                         </div>  -->
                                    </div>
                                          </div>

                                       </div>
									               <div class="col-md-1 col-sm-6 col-12 serdv p0">
                                             <button type="submit" class="btn go_button btneffect fli radiusrtb">Search</button>
                                          </div>
                                    </form>
                                 </div>
                              </div>
							  	  <div class="col-12 p0 dnone" data-multicity="true"  >
                        <form action="<?php echo base_url(); ?>flight/search" name="flight-multiform" id="flight-multiform" method="GET">
                           <input type="hidden" value="multicity" name="journeytype">
                           <div class="row m0 searchform">
                              <div class=" ui-widget col-12 col-sm-6 col-md-3 flg-3 p0 mb15">
                                 <input type="text" class="form-control inputtext radiusltb auto_tags border-right-0" data-from-location-multi="true" placeholder="From" data-validation="required" data-validation-error-msg="Please enter origin" name="origin[]"  id="origin_1" />
                              </div>
                              <div class="col-12 col-sm-6 col-md-3 flg-3 p0 mb15">
                                 <input type="text" class="form-control inputtext auto_tags pl20 border-right-0" data-to-location-multi="true" placeholder="To" data-validation="required" data-validation-error-msg="Please enter destination" name="destination[]"  data-to-location-multi="true" placeholder="To" data-validation="required" data-validation-error-msg="Please enter destination" name="destination[]" data-key="1" id="destination_1"/>
                              </div>

                              <div class="col-sm-6 col-md-2 p0 mb15 fdate-3">
                                 <input type="text" class="form-control inputtext date_formate pl-4"  multisegdate1="true" placeholder="Depart date" data-validation="required" readonly data-validation-error-msg="Select departure date" name="departdate[]" id="departdate_1" />
                                 <i class="fa fa-calendar dateicon"></i>
                              </div>
                              <div class="col-sm-6 col-md-3 p0 mb15 pax_dv" data-parent="true">
                                 <div class="row pax-div" data-toggle-div="true">
                                    <div class="col plr10">
                                       <label for="paxcount" class="clearfix" id="travel_count" >
                                       <span  data-total-pax-m="true"><?php echo $search_data['adults']+$search_data['child']+$search_data['infant']; ?></span><span> Traveler(s) </span>,
                                       <samp class="flight_class mget_class"><?php echo $search_data['cabinclass']; ?></samp>
                                       <i class="fa fa-sort-desc faicon  "></i>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-12 col-md-12 flightpax  pax_parent animated dnone" data-toggle-divshow="true">

                        <button type="button" class="close close_cross"  data-close-btn  =  "true">
            <span aria-hidden="true">×</span>
          </button>
                                    <div class="row  m0 mt-3 pax_parent_m ">
                                             <div class="col-md-4 ">
                                          <div class="main_innerdata">
                                             <div class="col_datainner traveladd">
                                                <label>Adult</label>

                                              <div class="row  mb-2 radius4">
                                   <a href="javascript:void(0);" data-adult-pre-m="true" class="col">−</a>
                                  <samp data-adult-count-m="true" class="col"><?php echo $search_data['adults']; ?></samp>
                                  <a href="javascript:void(0);" data-adult-next-m="true" class="col">+</a>
                                   <input type="hidden" name="adults" value="<?php echo $search_data['adults']; ?>" class="adt_input_m">
                                 </div>
                                 <span>(12+ yrs)</span>
                                             </div>

                                          </div>
                                       </div>
                                           <div class="col-md-4 ">
                                          <div class="main_innerdata">
                                             <div class="col_datainner traveladd">
                                                 <label>Children</label>
                                              <div class="row mb-2  radius4">

                                   <a href="javascript:void(0);" data-child-pre-m="true" class="col">−</a>
                                  <samp data-child-count-m="true" class="col"><?php echo $search_data['child']; ?></samp>
                                  <a href="javascript:void(0);" data-child-next-m="true" class="col">+</a>
                                   <input type="hidden" name="child" value="<?php echo $search_data['child']; ?>" class="child_input_m">
                                 </div>
                                   <span>(2+ 12 yrs)</span>
                              </div>


                                          </div>
                                       </div>
                                        <div class="col-md-4">
                                          <div class="main_innerdata">
                                             <div class="col_datainner traveladd">
                                                 <label>Infant</label>

                                              <div class="row mb-2 radius4">
                                   <a href="javascript:void(0);" data-infant-pre-m="true" class="col">−</a>
                                  <samp data-infant-count-m="true" class="col"><?php echo $search_data['infant']; ?></samp>
                                  <a href="javascript:void(0);" data-infant-next-m="true" class="col">+</a>
                                   <input type="hidden" name="infant" value="<?php echo $search_data['infant']; ?>" class="infent_input_m">
                                 </div>
                                 <span>(Below 2 Years)</span>

                                             </div>

                                          </div>
                                       </div>

                                    </div>
                                    <div class="row">
                                       <div class="col-md-12">
									   <?php if($search_data['cabinclass']=="Economy") { ?>
                                          <label class="cls_pax1">
                                          Economy
                                          <input type="radio" value="Economy" name="cabinclass" checked="checked" cls="radio_type" onclick="changefareclass('Economy','mget_class')">
                                          </label>
									   <?php } else { ?>
									    <label class="cls_pax1">
                                          Economy
                                          <input type="radio" value="Economy" name="cabinclass"  cls="radio_type" onclick="changefareclass('Economy','mget_class')">
                                          </label>
									   <?php } ?>
                                       </div>
                                       <div class="col-md-12">
									     <?php if($search_data['cabinclass']=="Business") { ?>
                                          <label class="cls_pax1">
                                         Business
                                          <input type="radio" value="Business" name="cabinclass"  checked="checked"  cls="radio_type" onclick="changefareclass('Business','mget_class')">
                                          </label>
										 <?php }  else  { ?>
										 <label class="cls_pax1">
                                         Business
                                          <input type="radio" value="Business" name="cabinclass"    cls="radio_type" onclick="changefareclass('Business','mget_class')">
                                          </label>
										 <?php } ?>
                                       </div>
                                    </div>
                                        <div class="row">
                                       <div class="col-md-12">
									    <?php if($search_data['cabinclass']=="PremiumEconomy") { ?>
                                          <label class="cls_pax1">
                                          Premium Economy
                                          <input type="radio" value="PremiumEconomy"  name="cabinclass"  checked="checked" cls="radio_type" onclick="changefareclass('Premium Economy','mget_class')">
                                          </label>
										<?php } else {  ?>
										 <label class="cls_pax1">
                                           Prem.Economy
                                          <input type="radio" value="PremiumEconomy" name="cabinclass" cls="radio_type" onclick="changefareclass('Premium Economy','mget_class')">
                                          </label>
										<?php } ?>
                                       </div>


									    <div class="col-md-12">
										 <?php if($search_data['cabinclass']=="PremiumBusiness") { ?>
                                          <label class="cls_pax1">
                                           Premium Business
                                          <input type="radio" value="PremiumBusiness" checked="checked" name="cabinclass" cls="radio_type" onclick="changefareclass('Premium Business','mget_class')">
                                          </label>

										 <?php } else { ?>
										     <label class="cls_pax1">
                                           Premium Business
                                          <input type="radio" value="PremiumBusiness" name="cabinclass" cls="radio_type" onclick="changefareclass('Premium Business','mget_class')">
                                          </label>
										 <?php  } ?>
                                       </div>

									   <div class="col-md-12">
									   <?php if($search_data['cabinclass']=="First") { ?>
                                          <label class="cls_pax1">
                                           First
                                          <input type="radio" value="First"  checked="checked" name="cabinclass" cls="radio_type" onclick="changefareclass('First','mget_class')">
                                          </label>
									   <?php  } else { ?>
									    <label class="cls_pax1">
                                           First
                                          <input type="radio" value="First" name="cabinclass" cls="radio_type" onclick="changefareclass('First','mget_class')">
                                          </label>
									   <?php  } ?>
                                       </div>
                                     <!--   <div class="col-md-6">
                                         <a href="javascript:void(0);" class="done radius4 mbtneffect" data-close-btn="true">Done</a>
                                         </div>  -->
                                    </div>

                                 </div>
                              </div>


							     <div class="col-12  p0 multicity_add add_multy" raj-addmore-dv="true">
                              <div class="row multirow searchform add_multycit form_tab m0">
                                 <div class="col-12 col-sm-6 col-md-3 multilg-3 p0 mb15 formerrorshuli ">
                                    <input type="text" class="form-control inputtext radiusltb border-right-0" data-from-location-multi="true" placeholder="From" data-validation="required" data-validation-error-msg="Please enter origin" name="origin[]" id="origin_2" />
                                 </div>
                                 <div class="col-12 col-sm-6 col-md-3 multilg-3 p0 mb15 formerrorshuli ">
                                    <input type="text" class="form-control inputtext pl20 border-right-0" data-to-location-multi="true" placeholder="To" data-validation="required" data-validation-error-msg="Please enter destination" name="destination[]" data-key="2" id="destination_2"/>
                                 </div>
                                 <div class="col-sm-6 col-md-2 p0 mb15 fdate-3  heig_hotl   ">
                                    <input type="text" class="form-control inputtext date_formate formof_date  wbgi pl-4" multisegdate2="true" placeholder="Depart date" data-validation="required"  data-validation-error-msg="Select departure date" name="departdate[]"    id  =  "departdate_2" readonly />
                                    <i class="fa fa-calendar dateicon"></i>
                                 </div>
                                 <div class="col-md-2 add_dv align-self-center addcitym formerrorshu ">
                                    <a href="javascript:void(0);" onclick="addmulticity();"><i class="fa fa-plus pr-1" title="add city"></i> Add Up to 4 City</a>
                                 </div>
                              </div>
                           </div>


<br/>
                           <div class="col-md-1 col-sm-6 col-12 serdv p0">
                                 <button type="submit" class="btn go_button btneffect fli radiusrtb">Search</button>
                              </div>
                           </div>
                        </form>
                     </div>
                           </div>
                        </div>
                     </div>
                     <a href="javascript:void(0);" class="modifyclose close" data-dismiss="modal" aria-label="Close" data-mfdbtn="true" data-revblurbtn=""><i class="fa fa-close"> </i></a>
                  </div>
         </section>
      </div>
   </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>
$(function() {
	setTimeout(function(){
		var type="<?php echo $search_data['journeytype']; ?>";


			if(type=="oneway")
			{

				$("#oneway").click();
			} else if(type=="roundtrip") {

				$("#roundtrip").click();
			} else {
				$("#multicity").click();
				var i;
				var ulength=<?php echo count($search_data['origin'])-2; ?>;
				for (i =0; i < ulength; i++) {
					addmulticity();
				}
				var modify_info='<?php echo json_encode($search_data); ?>';
				form_fill('#flight-multiform',$.parseJSON(modify_info));

			}
	}, 2000);
});

function form_fill(frm, data) {
  $.each(data.origin, function(key, value){
	  var key1=key+1;
	  var destination=data.destination[key];
	  var departdate=data.departdate[key];
     $('[id=origin_'+key1+']', frm).val(value);
     $('[id=destination_'+key1+']', frm).val(destination);
     $('[id=departdate_'+key1+']', frm).val(departdate);
  });
}

</script>