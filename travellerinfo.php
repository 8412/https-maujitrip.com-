  
			<?php
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

?> 
			
		
   
   
   
   
   
   <?php for($i=1;$i<=$adtcount;$i++){  $paxtype="Adult"; 

$adultinfo  =  $adult[$i-1];
$firstname  =  "";
$lastname  =  "";
$dob =  "";
$gender =  "";
if($adultinfo)
{
$member  =  json_decode($adultinfo['customer_info'],true);

$firstname  =  ucfirst($member['first_name']);
$lastname  =  ucfirst($member['last_name']);
$dob =  $member['birthday'];
$gender =  $member['gender'];
	
}


   ?>
   
                    <div class="col-lg-2 pr-md-0 col-sm-2 col-12 form_errormsg inner_heading_details_page fw_5">Adult (<?php echo $i; ?>)</div>
                    <div class="col-md-10">
                      <div class="row">
                        <div class="col-4 col-md-2 mb_15">
                         <select  class="form-control inputtext text_validation " data-validation="required" data-validation-error-msg="Required" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][title]">
                         <option value="">Title</option>
                         <option value="Mr" <?php if($gender=="Male"){echo  "selected";}?>>Mr</option>
                         <option value="Ms"<?php if($gender=="Female"){echo  "selected";}?>>Ms</option>
                         
                         </select>
                        </div>
                        <div class="col-lg-4 plr6 mb15 col-8 form_errormsg ">
                       <input type="text"  class="form-control inputtext text_validation" data-validation="required" placeholder="First Name" data-validation-error-msg="Enter First Name" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][first_name]" value  =  "<?php echo $firstname; ?>">
                      </div>
                        <div class="col-lg-3 form_errormsg plr6 mb15 col-12">
                          <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][last_name]" class="form-control inputtext text_validation" placeholder="Last Name"  data-validation="required" value  =  "<?php echo $lastname; ?>">
                        </div>
            
            <?php  
            if($searchdata['isdomestic']=='false') { 
            $validation   =   "data-validation=required";
            } else{
              
                $validation  =  "";
            }
            
            ?>
            
                      <div class="col-lg-3 plr6 mb15 col-12 dob_dateicon form_errormsg has-error">
        <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][dob]" class="form-control inputtext text_validation adult_date"  placeholder="DOB"  data-validation-error-msg="Enter DOB"  <?php   echo   $validation;  ?>  value  =  "<?php echo $dob; ?>" >
        <i class="fa fa-calendar dateicon"></i>
      </div> 

       </div>
        </div>
			
			<?php if($searchdata['isdomestic']=='false') { ?>
			
			<div class="row passportparent" attr-parent> 
				<div class="col-lg-12  ">
				<p class="passport_title">Required (Passport ) </p>
				<div class="col-12 " attr-optionalshow="true">				
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
					  
					 	 <?php for($i=1;$i<=$chdcount;$i++){ 


$adultinfo  =  $child[$i-1];
$firstname  =  "";
$lastname  =  "";
$dob =  "";
$gender =  "";

if($adultinfo)
{
$member  =  json_decode($adultinfo['customer_info'],true);

$firstname  =  ucfirst($member['first_name']);
$lastname  =  ucfirst($member['last_name']);
$dob =  $member['birthday'];
$gender =  $member['gender'];
	
}

						 $paxtype="Child";  ?>
                    <div class="col-lg-2 pr-md-0 col-sm-2 col-12 form_errormsg inner_heading_details_page fw_5">Child (<?php echo $i; ?>)</div>
                    <div class="col-md-10">
                      <div class="row">
                        <div class="col-4 col-md-2  plr6 mb_15 form_errormsg">
                         <select  class="form-control inputtext text_validation " data-validation="required" data-validation-error-msg="Required" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][title]">
                         <option value="">Title</option>
                         <option value="Mr">Mr</option>
                         <option value="Ms">Ms</option>
                         <option value="Mrs">Mrs</option>
                         <option value="Miss" <?php if($gender=="Male"){echo  "selected";}?>>Miss</option>   
                         <option value="Mstr" <?php if($gender=="Female"){echo  "selected";}?>>Mstr</option> 
                         </select>
                        </div>
                        <div class="col-lg-4 plr6 mb15 col-8 mb15 form_errormsg">
                       <input type="text"  class="form-control inputtext text_validation" data-validation="required" placeholder="First Name" data-validation-error-msg="Enter First Name" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][first_name]" value  =  "<?php echo $firstname; ?>" >
                      </div>
                        <div class="col-lg-3 form_errormsg plr6 mb15 col-12">
                          <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][last_name]"  class="form-control inputtext text_validation" placeholder="Last Name"  value  =  "<?php echo $lastname; ?>" >
                        </div>
                         <div class="col-lg-3 plr6 mb15 col-12 dob_dateicon form_errormsg">
        <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][dob]" class="form-control inputtext text_validation child_date" data-validation="required" placeholder="DOB" data-validation-error-msg="Enter DOB" value  =  "<?php echo $dob; ?>" >
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
					 
					 				  <?php for($i=1;$i<=$infcount;$i++){ 


					 	  


$adultinfo  =  $infant[$i-1];
$firstname  =  "";
$lastname  =  "";
$dob =  "";
$gender =  "";

if($adultinfo)
{
$member  =  json_decode($adultinfo['customer_info'],true);

$firstname  =  ucfirst($member['first_name']);
$lastname  =  ucfirst($member['last_name']);
$dob =  $member['birthday'];
$gender =  $member['gender'];
	
}
									  $paxtype="Infant";  ?>
                    <div class="col-lg-2 pr-md-0 col-sm-2 col-12 form_errormsg inner_heading_details_page fw_5 ">Infant (<?php echo $i; ?>)</div>
                    <div class="col-md-10">
                      <div class="row">
                        <div class="col-4 col-md-2 mb_15">
                         <select  class="form-control inputtext text_validation " data-validation="required" data-validation-error-msg="Required" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][title]">
                         <option value="">Title</option>
                         <option value="Mr">Mr</option>
                         <option value="Ms">Ms</option>
                         <option value="Mrs">Mrs</option>
                         <option value="Miss" <?php if($gender=="Male"){echo  "selected";}?>>Miss</option>   
                         <option value="Mstr" <?php if($gender=="Female"){echo  "selected";}?>>Mstr</option> 
                         </select>
                        </div>
                        <div class="col-lg-4 plr6 mb15 col-8 mb15 pr-0 form_errormsg ">
                       <input type="text"  class="form-control inputtext text_validation" data-validation="required" placeholder="First Name" data-validation-error-msg="Enter First Name" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][first_name]" value  =  "<?php echo $firstname; ?>" >
                      </div>
                        <div class="col-lg-3 form_errormsg plr6 mb15 col-12">
                          <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][last_name]" class="form-control inputtext text_validation" placeholder="Last Name"  value  =  "<?php echo $lastname; ?>" >
                        </div>
                         <div class="col-lg-3 plr6 mb15 col-12 dob_dateicon form_errormsg">
        <input type="text" name="flight[pax_details][pax][<?php echo $paxtype; ?>][<?php echo $i; ?>][dob]" class="form-control inputtext text_validation infant_date" data-validation="required" placeholder="DOB" data-validation-error-msg="Enter DOB"value  =  "<?php echo $dob; ?>" >
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