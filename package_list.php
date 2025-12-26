<?php $this->load->view('include/header'); ?>
<style>
	@media (max-width: 767.99px){
		.modifysection {padding-top: 20px!important;
    padding-bottom: 20px!important; }
   .mfilter {top: 0px;position: fixed; z-index: 99; }
	div.holidaylist{margin-bottom: -15px!important;}
	.bottomdata{position: fixed;}
	}
</style>
<!-- Include Modify search  -->
<?php  $this->load->view('holidays_modify_search'); ?>
<!-- Include Modify search  -->

<main class="container-fluid pb-3 pt-3 plr0 mpt0 h-100" >
<div class="container">		
	<div class="row">		
	<aside class="col-lg-3 col-12 dfsf"> 
		<?php  $this->load->view('holidays_filter'); ?>
</aside>
<!-- result fare list -->
<section class="col-lg-9 mbm4rm">
	
	<?php 
/* 	pr($package_detils); */
	if($package_detils){
	foreach($package_detils as $key=>$package_list){ ?>
				<div class="row bg_border hover hotel_fare holidaylist aj_shadow m-0 mb-3" holiday-sort="true" id="result_<?php echo $key; ?>">
					<div class="pbprice" data-price="<?php if($package_list['price_on_demand'] and $package_list['package_start_price']!=00){ echo round($package_list['package_start_price']); }  else {  echo '0' ;}?>" style="width: 100%;display: flex;"> 

					
					<div class="col-lg-10 col-md-10 col-12 max_80" data-index="<?php echo $key; ?>"> 	
						<div class="row">
							<div class="col-lg-5 p0 max33">
								<img src="<?php echo site_url('admin/webroot/img/uploads/holiday-package/thumbnail/').$package_list['package_image']; ?>" alt=""	class="image" />						 
							</div>
							<div class="col-lg-8 textmiddle">
								<h5 class="fw_5"><span class="fz14"><?php echo $package_list['package_name']; ?></span> 	<samp class="" data-star="<?php echo $package_list['package_star_rating']; ?>" style=" color: #fe4603">
									<?php for($i=1;$i<=$package_list['package_star_rating'];$i++){ ?>
										<i class="fa fa-star"></i>
									<?php } ?>
									</samp> </h5>
								<p ><samp class="holi_duration " data-duration="<?php echo $package_list['no_of_nights']; ?>  Nights / <?php echo $package_list['no_of_nights']+1; ?> Days"><?php echo $package_list['no_of_nights']; ?>  Nights / <?php echo $package_list['no_of_nights']+1; ?> Days</samp>
								
								<samp class="pull-left city_routes d-block"><?php $city_route  = explode(',',$package_list['city_routes']); ?></samp>                              <div class="d-flex mt-2 mb-2 holiday_place_loc">	         
									<?php  foreach($city_route as $key=>$city_routes) { 		 		 if($key==3){break;}		 		 ?>                          	  <div class="city_routes"><?php echo  $city_routes;?>	<i class="fa fa-long-arrow-right  pr-md-2 pl-md-2"></i></div>  	  	   	  	  	     <?php } ?>      
  									<?php if(count($city_route)>3) { ?>
										<div class="place_loc_extra">        	<span class="logo_blue place_loc_extra_items">        		<span class="fz18">All</span> <!-- <span class="fs_18">1 </span> -->        	</span>	
										<div class="destination_extra">		<p class="destination_extra_title fw_6 pl-3 mb-0 fz16">Destinations		</p>				
											<ul>				 <?php  foreach($city_route as $key=>$city_routes) { ?>						<li><?php echo  $city_routes;?></li>				 <?php } ?>											</ul>	</div>        
										</div>	  
									<?php } ?>
								</div>	  	
								</p>
								
								<!-- fastar-->
								
				
								
							
								<?php $inclusionslist = json_decode($package_list['package_inclusiondata']);
										if($inclusionslist){
								?>
							
								<div class="row raj-nomg meel-info align-self-end pt-md-4 m-0  pb-md-4">
									<?php foreach($inclusionslist as $inc_list_data){ ?>
										<div class="d-flex text-center flex-column pr-3" data-package="<?php echo inclu_list($inc_list_data); ?>"><?php echo inclu_list($inc_list_data); ?></div> 
									<?php } ?>	
								</div>
								<?php } ?>
							</div>					
						</div> 	
					</div>
					<div class="col-lg-3 col-md-3 col-12 max_20">
						<div class="row  ar_inr ar_book">
							<div class="col-12 text-center d-flex align-items-center justify-content-center flex-md-column justify_content_mb_between">
								<!-- <label>Per Person On Twin Sharing</label> -->
								<samp class="fz23 fzbold tblue" data-price="<?php if($package_list['price_on_demand'] and $package_list['package_start_price']!=00){ echo round($package_list['package_start_price']); } ?>"><span class="inr_rupes">&#8377;</span><?php if($package_list['price_on_demand'] and $package_list['package_start_price']!=00){ echo change_money_format($package_list['package_start_price']); }else{ echo "<span style='font-size:13px;'>Price on request</span>"; } ?> </samp> <br/>
								<a href="<?php  echo site_url('holiday/package_details/').$package_list['package_slug']; ?>" class="btn go_button btneffect">View Details</a>	
									  <!--  -->
							</div>
						</div>
					</div> 
				</div>
				</div>
	<?php }}else{ ?>
		
		<img src="<?php echo site_url('assets/images'); ?>/luna-null.jpg" alt=""	class="image"  style="margin-top: 16%;"/>
	<?php } ?>
		
		
		
		
	</section>
<!-- result fare list End -->


	</div>
</div>
</main> 

<?php $this->load->view('include/footer'); ?>
  