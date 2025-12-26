<?php $search_data = $_GET;?>
<aside class="col-lg-3 col-12  ">
<div class=" ml0 filter result_side_bar " data-filter-sw="true">
   <h5 class="p10 mb0 w100 brlrt">Filter Results <a href="javascript:void(0)" class=" link pull-right  logo_color2"
         air-clearfilter="">Reset All</a></h5>
   <i class="fa fa-times filter_close dnone" data-filter-trans="true"></i>
   <div class="col-12 p0">
      <div class="row parentdv  ">
         <h5 class="short_tittle" data-toggle-btnthree="true">price <i class="fa fa-angle-down"></i></h5>
         <div class="row m0" data-toggle-filter="true">
            <p class="price_range">
               <input type="text" class="leftprice" readonly>
               <input type="text" class="rightprice text-right" readonly>
            </p>
            <div class="price-range col-12 price_filter"></div>
         </div>
      </div>
      <div class="row parentdv ">
         <h5 class="gray_bg short_tittle" data-toggle-btnthree="true">fare type <i
               class="fa fa-angle-down"></i></h5>
         <div class="row  filterheight " data-toggle-filter="true">
            <ul class="filterul" atr-faretype-html-data></ul>
         </div>
      </div>
      <div class="row parentdv ">
         <h5 class="gray_bg short_tittle" data-toggle-btnthree="true">Stop <i class="fa fa-angle-down"></i></h5>
         <div class="row  filterheight " data-toggle-filter="true">
            <ul class="filterul" atr-stop-html-data></ul>
         </div>
      </div>
      <div class="row parentdv ">
         <h5 class="gray_bg short_tittle" data-toggle-btnthree="true"> 
            <?php if ($search_data['journeytype'] == "oneway" || $search_data['journeytype'] == "multicity") {
} else {
echo "Onward";
}?>
            Departure Times <i class="fa fa-angle-down"></i></h5>


         <div class="pic_class " data-toggle-filter="true">
            <ul class="day_timeflight tabs filterul">
               <li>
                  <label class="checkboxlabel">
                     <input type="checkbox" atr-departtime-hit class="aj_filter" value="Morning">
                     <img src="<?php echo site_url('/'); ?>webroot/images/morning-icon.svg">
                     <spam class="fs_13">Morning</spam>
                  </label>
               </li>
               <li>
                  <label class="checkboxlabel">
                     <input type="checkbox" atr-departtime-hit class="aj_filter" value="Afternoon">
                     <img src="<?php echo site_url('/'); ?>webroot/images/afternoon-icon.svg">
                     <spam class="fs_13">Afternoon</spam>
                  </label>
               </li>
               <li>
                  <label class="checkboxlabel">
                     <input type="checkbox" atr-departtime-hit class="aj_filter" value="Evening">
                     <img src="<?php echo site_url('/'); ?>webroot/images/evening-icon.svg">
                     <spam class="fs_13">Evening</spam>
                  </label>
               </li>
               <li>
                  <label class="checkboxlabel">
                     <input type="checkbox" atr-departtime-hit class="aj_filter" value="Night">
                     <img src="<?php echo site_url('/'); ?>webroot/images/night-icon.svg">
                     <spam class="fs_13">Night</spam>
                  </label>
               </li>
            </ul>
         </div>

      </div>

      <?php if ($search_data['journeytype'] == "roundtrip") {?>

      <div class="row parentdv ">
         <h5 class="gray_bg short_tittle onfheadings" data-toggle-btnthree="true">Return Departure Times <i
               class="fa fa-angle-down"></i></h5>
         <div class="pic_class" data-toggle-filter="true">
            <ul class="day_timeflight tabs filterul">

                <li>
                  <label class="checkboxlabel">
                     <input type="checkbox" atr-departtimereturn-hit class="aj_filter" value="Morning">
                     <img src="<?php echo site_url('/'); ?>webroot/images/morning-icon.svg">
                     <spam class="filter-label full">Morning</spam>
                  </label>
               </li>
               <li>
                  <label class="checkboxlabel">
                     <input type="checkbox" atr-departtimereturn-hit class="aj_filter" value="Afternoon">
                     <img src="<?php echo site_url('/'); ?>webroot/images/afternoon-icon.svg">
                     <spam class="filter-label full">Afternoon</spam>
                  </label>
               </li>
               <li>
                  <label class="checkboxlabel">
                     <input type="checkbox" atr-departtimereturn-hit class="aj_filter" value="Evening">
                     <img src="<?php echo site_url('/'); ?>webroot/images/evening-icon.svg">
                     <spam class="filter-label full">Evening</spam>
                  </label>
               </li>
               <li>
                  <label class="checkboxlabel">
                     <input type="checkbox" atr-departtimereturn-hit class="aj_filter" value="Night">
                     <img src="<?php echo site_url('/'); ?>webroot/images/night-icon.svg">
                     <spam class="filter-label full">Night</spam>
                  </label>
               </li>
            </ul>
         </div>
      </div>

      <?php }?>

      <div class="row parentdv ">
         <h5 class="gray_bg short_tittle" data-toggle-btnthree="true">Airlines <i class="fa fa-angle-down"></i></h5>
         <div class="row filterheight" data-toggle-filter="true">
            <ul class="filterul" atr-airline-html-data>
            </ul>
         </div>
      </div>
   </div>
</div>
</aside>