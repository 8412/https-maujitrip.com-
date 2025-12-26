<?php $this->load->view('include/header'); ?>
<?php $search_data=json_decode($booking_data['search_data'],true); ?>
<main class="container ptb30 plr0 pt15m">
<div class="row m0">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->company_info['meta_title']; ?></title>
 <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>webroot/font/font-icon/font-awesome/css/font-awesome.css">
</head>
<style>
	table,tr,td,div,p,a{font-family: Calibri;}
	@media print {
body {-webkit-print-color-adjust: exact;}
}
</style>
<body>
<?php

$fare_data=$_SESSION['flight']['fare_breakup']['customer'];
 $meal =0;
        $baggage_price =0;
        if(isset($fare_data['OB_fare']['meal_price'])){
            $meal =  $meal+$fare_data['OB_fare']['meal_price'];
        }if(isset($fare_data['OB_fare']['baggage_price'])){
            $baggage_price =  $baggage_price+$fare_data['OB_fare']['baggage_price'];
        }if(isset($fare_data['IB_fare']['meal_price'])){
            $meal =  $meal+$fare_data['IB_fare']['meal_price'];
        }if(isset($fare_data['IB_fare']['baggage_price'])){
            $baggage_price =  $baggage_price+$fare_data['IB_fare']['baggage_price'];
        }
 $ticket_data=json_decode($_SESSION['flight']['responce']['booking_details_OB']); 
 
 ?> 
<?php $ticket_dataib=json_decode($_SESSION['flight']['responce']['booking_details_IB']);  ?> 
<?php if(isset($_SESSION['flight'])){ 
  	if($ticket_data->Response->Error->ErrorCode==0){ ?>

<div style="width:850px; height: auto;margin: 0px auto;   padding: 15px;font-family: Calibri; background:white; box-shadow: 4px 24px 14px 4px #cccc;">
 <div id="divName"> 
 <h3 style="font-family: Calibri;margin: 0px; padding: 0px; text-align: center;"><b>Electronic Ticket Receipt</b></h3>
	<br/>
	<div style="float: left; width: 50%; height: auto;">
	<div style="float: left; width: 375px; height: auto">
		<p style="font-family: Calibri; text-align: left;  margin: 0px;  padding: 0px;  font-size: 19px;  font-weight: bold;  color: #9A2C7A;width: 360px; "><span style="text-decoration: none;color:#337AB7;font-size: 25px;font-family: Lucida Calligraphy;"> <a href="<?php echo base_url(); ?>"><img src="<?php echo site_url(); ?>/admin/webroot/img/uploads/logo/<?php echo $this->company_info['company_logo']; ?>" width="170px;" alt="<?php echo $this->company_info['meta_title']; ?> logo" /> </a> </span><br /><samp style="font-weight: normal; font-size: 14px; color: #333;  font-family: Calibri;"></samp></p>
	</div>
	</div>	
	<div style="float: left; width: 50%; height: auto;">
		<div style="float: left; width: 375px; height: auto">
			<p style="font-family: Calibri;  margin: 0px;  padding: 0px;  width: 360px;  font-size: 15px;  text-align: left;">
			
			<b> <?php echo $this->company_info['company_name']; ?> </b><br/>
			<?php echo $this->company_info['street']; ?>,<br/> <?php echo $this->company_info['city']; ?>,  <?php echo $this->company_info['state']; ?> ,<?php echo $this->company_info['country']; ?> <?php echo $this->company_info['pin_code']; ?>
			<br/>
			<?php echo $this->company_info['support_email']; ?>
			<br/>
			<?php echo $this->company_info['support_no']; ?>
			<br/><?php echo $this->company_info['landline_support_no']; ?>
			
			</p>
		</div>
	</div>	
	<br/>
	
	<table style="width: 100%; font-family: Calibri; font-size: 15px; border: 1px solid #C7C7C7;  border-collapse: collapse;margin-top: 10px;float: left; border-spacing: 0px;  color: #fff;">
		<tr>
			<th style="padding: 5px 5px; color: #000; width: 24%;">Booking Reference number : </th>
			<td style="padding: 5px 5px; color: #000; width: 27%;"><?php echo $this->flight_prefix.$_SESSION['flight']['booking_id']; ?> </td>
			
			<th style="padding: 5px 5px; color: #000;">Booking Date :</th>
			<td style="padding: 5px 5px; color: #000;"><?php echo date('l, F d, Y',strtotime($booking_data['booking_date_time'])) ; ?> </td>
		</tr>
		<tr style="border-top: 1px solid #C7C7C7;">
			<th style="padding: 5px 5px; color: #000; width: 24%;">GDS/Airline PNR : </th>
			<td style="padding: 5px 5px; color: #000; width: 27%;"><?php echo $ticket_data->Response->FlightItinerary->PNR; ?> 
			
			<?php if($ticket_dataib->Response->FlightItinerary->PNR) {
			echo ', '.$ticket_dataib->Response->FlightItinerary->PNR;
			} ?>
			</td>
			
			<th style="padding: 5px 5px; color: #000;">Booking Status :</th>
			<td style="padding: 5px 5px; color: #000;"><?Php echo $booking_data['booking_status']; ?></td>
		</tr>
		
		<tr style="border-top: 1px solid #C7C7C7;">
			<th style="padding: 5px 5px; color: #000; width: 24%;">Trip Type : </th>
			<td style="padding: 5px 5px; color: #000; width: 27%;"><?php echo $search_data['journeytype']; ?></td>
			
			<th style="padding: 5px 5px; color: #000;">Trip Name :</th>
			<td style="padding: 5px 5px; color: #000;"><?Php if($search_data['journeytype']=="multicity") {
			echo current($search_data['origin']).' to '.end($search_data['destination']);
 
			} else {
				echo $search_data['origin'].' to '.$search_data['destination'];
				
			} ?></td>
		</tr>
	</table>
	
	<h4 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Onward Passenger Details</h4>
	<table style="width: 100%; font-family: Calibri; font-size: 15px; border: 1px solid #C7C7C7;  border-collapse: collapse;margin-top: 10px;float: left; border-spacing: 0px;  color: #fff;">		
		<tr style="border: 1px solid #C7C7C7;">
			<th style="padding: 5px 5px; color: #000;">Passenger Name</th>
			<th style="padding: 5px 5px; color: #000;">Type</th>
			<th style="padding: 5px 5px; color: #000;">Ticket no.</th>
			<th style="padding: 5px 5px; color: #000;">Bag</th>
		</tr>		
		<?php 		
		$Passenger_details=$ticket_data->Response->FlightItinerary->Passenger; ?>
		<?php 
		if($Passenger_details) {
		foreach($Passenger_details as $pax_details){ 
		?>
		<tr>
			<td style="color: #333;  padding: 2px 10px;"><?php echo $pax_details->Title; ?> <?php echo $pax_details->FirstName; ?> <?php echo $pax_details->LastName; ?></td>
			
			<td style="color: #333;  padding: 2px 10px;"><?php echo adt_type_1($pax_details->PaxType); ?> </td>
			
			<td style="color: #333; padding: 2px 10px; padding: 1px 10px;"> <?php if($pax_details->Ticket->TicketNumber) { echo $pax_details->Ticket->TicketNumber; } else {
				echo "On Hold";
			} ?> </td>

			<td style="color: #333; padding: 2px 10px; padding: 1px 10px;"> 
			<?php if(isset($pax_details->SegmentAdditionalInfo[0]))
				{
					echo  $pax_details->SegmentAdditionalInfo[0]->Baggage;
				} else {
					echo  $pax_details->SegmentAdditionalInfo->Baggage;
				}
			?> 
			
			</td>

			
			
		</tr>
		<?php } } ?>
	</table>
	
	
	<?php if(!empty($ticket_dataib))  { ?>
	
	<h4 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Return Passenger Details</h4>
	<table style="width: 100%; font-family: Calibri; font-size: 15px; border: 1px solid #C7C7C7;  border-collapse: collapse;margin-top: 10px;float: left; border-spacing: 0px;  color: #fff;">
		
		<tr style="border: 1px solid #C7C7C7;">
			<th style="padding: 5px 5px; color: #000;">Passenger Name</th>
			<th style="padding: 5px 5px; color: #000;">Type</th>
			<th style="padding: 5px 5px; color: #000;">Ticket no.</th>
			<th style="padding: 5px 5px; color: #000;">Bag</th>
		</tr>
		
		<?php $Passenger_detailsib=$ticket_dataib->Response->FlightItinerary->Passenger; ?>
		<?php foreach($Passenger_detailsib as $pax_details){ ?>
		<tr>
			<td style="color: #333; padding: 2px 10px;"><?php echo $pax_details->Title; ?> <?php echo $pax_details->FirstName; ?> <?php echo $pax_details->LastName; ?></td>
			
		   <td style="color: #333;  padding: 2px 10px;"><?php echo adt_type_1($pax_details->PaxType); ?> </td>
			
			
			<td style="color: #333; padding: 2px 10px;"><?php if($pax_details->Ticket->TicketNumber) { echo $pax_details->Ticket->TicketNumber; } else {
				echo "On Hold";
			} ?></td>
			
			
		   <td style="color: #333; padding: 2px 10px; padding: 1px 10px;"> 
			<?php if(isset($pax_details->SegmentAdditionalInfo[0]))
					{
						echo  $pax_details->SegmentAdditionalInfo[0]->Baggage;
					} else {
						echo  $pax_details->SegmentAdditionalInfo->Baggage;
					}
			?> 
			</td>
			
		</tr>
		<?php } ?>
	</table>
			<?php } ?>
	    <h4 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Onward Flight Details</h4>
		<table style="width: 100%; font-family: Calibri; font-size: 15px; border: 1px solid #C7C7C7;  border-collapse: collapse;margin-top: 15px; float: left; border-spacing: 0px;  color: #fff;">
		
		<tr style="border: 1px solid #C7C7C7;">
			<th style="padding: 5px 5px; color: #000;">Flight</th>
			<th style="padding: 5px 5px; color: #000;">Departure</th>
			<th style="padding: 5px 5px; color: #000;">Arrival</th>
			<th style="padding: 5px 5px; color: #000;">Status</th>
		</tr>
		
	
		<?php
         if($ticket_data->Response->FlightItinerary->Segments) {
		foreach($ticket_data->Response->FlightItinerary->Segments as $segment_details){
		?>
	
		<tr>
			<td style="color: #333;  padding: 15px 10px 10px 10px;"><img src="<?php echo site_url();?>webroot/airline-images/<?php echo $segment_details->Airline->AirlineCode;  ?>.png" /> &nbsp; <?php echo $segment_details->Airline->AirlineName;  ?> <b><?php echo $segment_details->Airline->AirlineCode;  ?>-<?php echo $segment_details->Airline->FlightNumber;  ?> <br/> Fare Class - <?php echo $segment_details->Airline->FareClass;  ?></b><br/> Aircraft: <?php echo $segment_details->Craft;  ?> <br/>
			Class -<?php echo Cabinclass($_SESSION['flight']['Search_data']['cabinclass']);?>
			</td>
			
			<td style="color: #333; padding: 15px 10px 10px 10px;"><?php echo $segment_details->Origin->AirportCode;  ?> (<?php echo $segment_details->Origin->AirportName;  ?>, <?php echo $segment_details->Origin->CityName;  ?>) <br/><?php echo tbo_flight_time($segment_details->Origin->DepartTime);  ?>, <?php echo tbo_flight_date($segment_details->Origin->DepartTime);  ?> <br/>
			 <?php if(!empty($segment_details->Origin->Terminal)) { echo "Terminal - ".$segment_details->Origin->Terminal; } ?>
			<br/><br/>
			</td>
			
			
			
			<td style="color: #333; padding: 15px 10px 10px 10px;"><?php echo $segment_details->Destination->AirportCode;  ?> (<?php echo $segment_details->Destination->AirportName;  ?>, <?php echo $segment_details->Destination->CityName;  ?>) <br/><?php echo tbo_flight_time($segment_details->Destination->ArrivalTime);  ?>, <?php echo tbo_flight_date($segment_details->Destination->ArrivalTime);  ?> <br/>

			 <?php if(!empty($segment_details->Destination->Terminal)) { echo "Terminal - ".$segment_details->Destination->Terminal; } ?>
			<br/><br/></td>
			
		   <td style="color: #333; padding: 15px 10px 10px 10px;"><?php echo $segment_details->FlightStatus; ?><br/>
		   
		   
		   <?php if($segment_details->AirlinePNR) { ?>
		     Airline Ref : <?Php echo $segment_details->AirlinePNR; ?>
			 <br/>
			 
		   <?php } ?>
		   
		   <?php
		    $Origin_time=str_replace('T',' ', $segment_details->Origin->DepartTime); 
            $Destination_time=str_replace('T',' ', $segment_details->Destination->ArrivalTime); 
		    echo time_duration($Origin_time,$Destination_time);
		   ?>

		   </td>
		</tr>
		
	<?php }  } ?>
	</table>

<?php $ticket_dataib=json_decode($_SESSION['flight']['responce']['booking_details_IB']);  
if($ticket_dataib){ ?>
 <h4 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Return Flight Details</h4>
<table style="width: 100%; font-family: Calibri; font-size: 15px;
  border: 1px solid #C7C7C7;  border-collapse: collapse; margin-top: 15px; float: left;       border-spacing: 0px;  color: #fff;">
		
		<tr style="border: 1px solid #C7C7C7;">
			<th style="padding: 5px 5px; color: #000;">Flight</th>
			<th style="padding: 5px 5px; color: #000;">Departure</th>
			<th style="padding: 5px 5px; color: #000;">Arrival</th>
			<th style="padding: 5px 5px; color: #000;">Status</th>
		</tr>
<?php foreach($ticket_dataib->Response->FlightItinerary->Segments as $segment_details){	 ?>
		<tr>
			<td style="color: #333;  padding: 15px 10px 10px 10px;"><img src="<?php echo site_url();?>webroot/airline-images/<?php echo $segment_details->Airline->AirlineCode;  ?>.png" />&nbsp; <?php echo $segment_details->Airline->AirlineName;  ?> <b><?php echo $segment_details->Airline->AirlineCode;  ?>-<?php echo $segment_details->Airline->FlightNumber;  ?> <br/> Fare Class - <?php echo $segment_details->Airline->FareClass;  ?></b><br/> Aircraft: <?php echo $segment_details->Craft;  ?> <br/>
			Class -<?php echo Cabinclass($_SESSION['flight']['Search_data']['cabinclass']);?>
			</td>
			
			<td style="color: #333;  padding: 15px 10px 10px 10px;"><?php echo $segment_details->Origin->AirportCode;  ?> (<?php echo $segment_details->Origin->AirportName;  ?>, <?php echo $segment_details->Origin->CityName;  ?>) <br/><?php echo tbo_flight_time($segment_details->Origin->DepartTime);  ?>, <?php echo tbo_flight_date($segment_details->Origin->DepartTime);  ?> <br/>
			
			 <?php if(!empty($segment_details->Origin->Terminal)) { echo "Terminal - ".$segment_details->Origin->Terminal; } ?>
			<br/><br/></td>
			
			<td style="color: #333;  padding: 15px 10px 10px 10px;"><?php echo $segment_details->Destination->AirportCode;  ?> (<?php echo $segment_details->Destination->AirportName;  ?>, <?php echo $segment_details->Destination->CityName;  ?>) <br/><?php echo tbo_flight_time($segment_details->Destination->ArrivalTime);  ?>, <?php echo tbo_flight_date($segment_details->Destination->ArrivalTime);  ?> <br/>
			
			<?php if(!empty($segment_details->Destination->Terminal)) { echo "Terminal - ".$segment_details->Destination->Terminal; } ?>
			<br/><br/></td>
			
		   <td style="color: #333;  padding: 15px 10px 10px 10px;"><?php echo $segment_details->FlightStatus; ?><br/>
		   
		     <?php if($segment_details->AirlinePNR) { ?>
		     Airline Ref : <?Php echo $segment_details->AirlinePNR; ?>
			 <br/>
			 
		   <?php } ?>
		   <?php
		    $Origin_time=str_replace('T',' ', $segment_details->Origin->DepartTime); 
            $Destination_time=str_replace('T',' ', $segment_details->Destination->ArrivalTime); 
		    echo time_duration($Origin_time,$Destination_time);
		   ?>
		   </td>
		</tr>
<?php } ?> 
	</table>
<?php } ?>
<?php if((isset($fare_data['OB_fare']['baggage_array']) and !empty($fare_data['OB_fare']['baggage_array'])) || (isset($fare_data['OB_fare']['baggage_array']) and!empty($fare_data['OB_fare']['meal_array']))) {?>
                    <h4 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;"> Excess Baggage & Meal Details</h4>
					<?php if(!empty($fare_data['OB_fare']['meal_array'])) { ?>
					<!--<p style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Meal</p>-->
					
                    <table style="width: 100%;border: 1px solid #C7C7C7;  border-collapse: collapse; margin-top: 15px; float: left;       border-spacing: 0px;  color: #fff;">

                        <tr style="border: 1px solid #C7C7C7;">
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Name </th>
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Sector</th>
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Meal Name</th>
                            
                        </tr>
						<?php foreach($Passenger_details as $Passenger_info){
                             if(isset($Passenger_info->Meal) and $Passenger_info->Meal){  
							 foreach($Passenger_info->Meal as $MealDynamicKey=>$MealDynamic){
							?>
                        <tr>
						<td style="color: #333;  padding: 5px 12px;"><?php echo $Passenger_info->Title . ' '; ?><?php echo $Passenger_info->FirstName . ' '; ?><?php echo $Passenger_info->LastName; ?></td>
						<td style="color: #333;  padding: 5px 12px;"><?php echo $MealDynamic->Origin . '-'; ?><?php echo $MealDynamic->Destination ; ?></td>
							<td style="color: #333;  padding: 5px 12px;"><?php  if($MealDynamic->Quantity!="UNKNOWN") { echo $MealDynamic->AirlineDescription."  (Qty :".$MealDynamic->Quantity.")"; } else { echo  $MealDynamic->AirlineDescription; } ?></td>
                        </tr>
						<?php } }}?>
                    </table>
                    <?php }  ?>
					<?php if(!empty($fare_data['OB_fare']['baggage_array'])) { ?>
					<h6 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Excess Baggage</h6>
					
                    <table style="width: 100%;border: 1px solid #C7C7C7;  border-collapse: collapse; margin-top: 15px; float: left;       border-spacing: 0px;  color: #fff;">

                        <tr style="border: 1px solid #C7C7C7;">
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Name </th>
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Sector</th>
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Excess Baggage</th>
                            
                        </tr>
						<?php foreach($Passenger_details as $Passenger_info){
                             if(isset($Passenger_info->Baggage) and $Passenger_info->Baggage){  
							 foreach($Passenger_info->Baggage as $BaggageKey=>$Baggage){
							?>
                        <tr>
						<td style="color: #333;  padding: 5px 12px;"><?php echo $Passenger_info->Title . ' '; ?><?php echo $Passenger_info->FirstName . ' '; ?><?php echo $Passenger_info->LastName; ?></td>
						<td style="color: #333;  padding: 5px 12px;"><?php echo $Baggage->Origin . '-'; ?><?php echo $Baggage->Destination ; ?></td>
						<td style="color: #333;  padding: 5px 12px;"><?php echo $Baggage->Weight."(KG)"; ?></td>
                        </tr>
						<?php } }}?>
                    </table>
                    <?php }  ?>
					
					<?php }?>
                        		<?php if($ticket_dataib) {?>
							<?php  $Passenger_detailsib=$ticket_dataib->Response->FlightItinerary->Passenger; ?>
							
							<?php  if((isset($fare_data['IB_fare']['baggage_array']) and !empty($fare_data['IB_fare']['baggage_array'])) || (isset($fare_data['IB_fare']['baggage_array']) and!empty($fare_data['IB_fare']['meal_array']))) {?>
                    <h4 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Return Excess Baggage & Meal Details</h4>
					<?php if(!empty($fare_data['IB_fare']['meal_array'])) { ?>
					<!--<h6 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Meal</h6>-->
					
                    <table style="width: 100%;border: 1px solid #C7C7C7;  border-collapse: collapse; margin-top: 15px; float: left;       border-spacing: 0px;  color: #fff;">

                        <tr style="border: 1px solid #C7C7C7;">
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Name </th>
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Sector</th>
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Meal Name</th>
                            
                        </tr>
						<?php foreach($Passenger_detailsib as $Passenger_info){
                             if(isset($Passenger_info->Meal) and $Passenger_info->Meal){  
							 foreach($Passenger_info->Meal as $MealDynamicKey=>$MealDynamic){
							?>
                        <tr>
						<td style="color: #333;  padding: 5px 12px;"><?php echo $Passenger_info->Title . ' '; ?><?php echo $Passenger_info->FirstName . ' '; ?><?php echo $Passenger_info->LastName; ?></td>
						<td style="color: #333;  padding: 5px 12px;"><?php echo $MealDynamic->Origin . '-'; ?><?php echo $MealDynamic->Destination ; ?></td>
						<td style="color: #333;  padding: 5px 12px;"><?php  if($MealDynamic->Quantity!="UNKNOWN") { echo $MealDynamic->AirlineDescription."  (Qty :".$MealDynamic->Quantity.")"; } else { echo  $MealDynamic->AirlineDescription; } ?></td>
                        </tr>
						<?php } }}?>
                    </table>
                    <?php }  ?>
					<?php if(!empty($fare_data['IB_fare']['baggage_array'])) { ?>
					<h6 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Excess Baggage</h6>
					
                    <table style="width: 100%;border: 1px solid #C7C7C7;  border-collapse: collapse; margin-top: 15px; float: left;       border-spacing: 0px;  color: #fff;">

                        <tr style="border: 1px solid #C7C7C7;">
                                <th style="padding: 5px 12px; color: #000; text-align: left; ">Name </th>
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Sector</th>
                                <th style="padding: 5px 12px; color: #000; text-align: left;">Excess Baggage</th>
                            
                        </tr>
						<?php foreach($Passenger_detailsib as $Passenger_info){
                             if(isset($Passenger_info->Baggage) and $Passenger_info->Baggage){  
							 foreach($Passenger_info->Baggage as $BaggageKey=>$Baggage){
							?>
                        <tr>
						<td style="color: #333;  padding: 5px 12px;"><?php echo $Passenger_info->Title . ' '; ?><?php echo $Passenger_info->FirstName . ' '; ?><?php echo $Passenger_info->LastName; ?></td>
						<td style="color: #333;  padding: 5px 12px;"><?php echo $Baggage->Origin . '-'; ?><?php echo $Baggage->Destination ; ?></td>
						<td style="color: #333;  padding: 5px 12px;"><?php echo $Baggage->Weight."(KG)"; ?></td>
                        </tr>
						<?php } }}?>
                    </table>
                    <?php }  ?>
					
					<?php } }?>
	<?php $total_fare_details=$ticket_data->Response->FlightItinerary->Fare; 
	
	
	
	$basefareib=0;$taxib=0;$publishfareib=0;
       if(!empty($ticket_dataib)){
	     $total_fare_detailsIb=$ticket_dataib->Response->FlightItinerary->Fare; 
		 $basefareib=$total_fare_detailsIb->BaseFare;
		 $taxib=$total_fare_detailsIb->Tax+$total_fare_detailsIb->AdditionalTxnFeePub+$total_fare_detailsIb->OtherCharges+$total_fare_detailsIb->ServiceFee;
	     $publishfareib=$total_fare_detailsIb->PublishedFare;
	   }
	?>
	
	<?php  
	if(!empty($fare_data)){
		
		$total_fare_markup=0;
		$ib_discount=0;
		$coupon_amount=0;
		$ob_discount=0;
		$total_disc=0;
		if(!empty($fare_data['OB_fare'])){
			$ob_discount=$fare_data['OB_fare']['discount'];
			   $total_fare_markup= round($total_fare_markup+$fare_data['OB_fare']['markup']+$fare_data['OB_fare']['superadminmarkup']);
		}
		if(!empty($fare_data['IB_fare'])){
		
		$ib_discount=$fare_data['IB_fare']['discount'];
			 $total_fare_markup=round($total_fare_markup+$fare_data['IB_fare']['markup']+$fare_data['IB_fare']['superadminmarkup']);
		}
	} 
	if($_SESSION['flight']['coupon_info']){
		$coupon_amount=$_SESSION['flight']['coupon_info']['coupon_amount'];
	}
	
	
		if($_SESSION['flight']['convenience_fee']!=NULL){
			 $total_convenience_fee=round($_SESSION['flight']['convenience_fee']);
		} 
		
		$total_disc=$ib_discount+$ob_discount+$coupon_amount;
		
		
		?>
	
	<h4 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Payment Details</h4>
	<table style="width: 100%; font-family: Calibri; font-size: 15px;
  border: 1px solid #C7C7C7;  border-collapse: collapse;  float: left;    margin-top: 15px;   border-spacing: 0px;  color: #fff;">
	
	
		<tr>
			<td style=" color: #333;  padding: 2px 10px; border-right: 1px solid #C7C7C7; text-align: left;" rowspan='2' >This is an electronic ticket.<br/> Please carry a positive identification for check in.
			</td>
			<td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;">Air Fare: <span class="pull-right"><b>(+)</b><span></td>
			<td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 10px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;"><span class="inr_rupes">&#8377;</span> <?php echo change_money_format($total_fare_details->BaseFare+$basefareib); ?></td>
		</tr>
		
		<tr>
		
			<td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;">Fee & Surcharge: <span class="pull-right"><b>(+)</b><span></td>
			<td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 10px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;"><span class="inr_rupes">&#8377;</span> <?php echo change_money_format(round($total_fare_details->Tax+$total_fare_details->AdditionalTxnFeePub+$total_fare_details->OtherCharges+$total_fare_details->ServiceFee+$taxib+$total_fare_markup)); ?></td>
		</tr>
		   <?php if ($meal) { ?>
                                <tr>
                                    <td style="border-bottom: 0px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;"></td>
                                    <td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;">
                                        Meal Charge:  <span class="pull-right"><b>(+)</b><span></td>
                                    <td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 10px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;">
                                        <span class="inr_rupes">&#8377;</span> <?php echo round($meal); ?>
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php if ($baggage_price) { ?>
                                <tr>
                                    <td style="border-bottom: 0px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;"></td>
                                    <td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;">
                                        Excess Baggage Charge:  <span class="pull-right"><b>(+)</b><span></td>
                                    <td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 10px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;">
                                        <span class="inr_rupes">&#8377;</span> <?php echo round($baggage_price); ?>
                                    </td>
                                </tr>
                            <?php } ?>
		<tr>
			<td style="border-bottom: 0px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;"></td>
			<td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;">Convenience Fee: <span class="pull-right"><b>(+)</b><span> </td>
			<td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 10px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;"><span class="inr_rupes">&#8377;</span> <?php echo change_money_format(round($total_convenience_fee)); ?></td>
		</tr>
		
		<?php if($total_disc!=0){ ?>
		<tr>
			<td style="border-bottom: 0px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;"></td>
			<td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;">Discount: <span class="pull-right"><b>(-)</b><span></td>
			<td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 10px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;"><span class="inr_rupes">&#8377;</span> <?php echo change_money_format(round($total_disc)); ?></td>
		</tr>
		<?php } ?>
		
		<tr>
			<td> </td>
			<td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 0px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left;border-left: 1px solid #C7C7C7;"><b>Total Amount:</b></td>
			<td style="border-bottom: 1px solid #C7C7C7; color: #333; padding: 2px 10px; padding: 1px 10px; border-right: 1px solid #C7C7C7; text-align: left; font-weight: bold"><span class="inr_rupes">&#8377;</span> <?php echo change_money_format(round($total_fare_details->PublishedFare+$publishfareib+$total_fare_markup+$total_convenience_fee-$total_disc)); ?> </td>
		</tr>
		<p style="clear:both;display: block; margin: 0px;"></p>
	</table>
	
   <h4 style="margin-bottom: 0;float: left;margin-top: 10px;font-weight: bold;">Rules and Conditions / Flight Note</h4>
	<p style="clear:both;display: block; margin: 0px;"></p>
	<div style=" font-family: Calibri;  margin-top: 15px; display: block;  padding: 0px;  width: 100%;  font-size: 15px;
  border: 1px solid #ccc;  text-align: left;  padding: 7px;  margin: 11px 0px 0px 0px;"><?php echo $ticket_data->Response->FlightItinerary->FareRules[0]->FareRuleDetail; ?></div>
	
	<p style="font-family: Calibri;  font-size: 15px;  float: left;  width: 100%;  color: #337AB7;  font-weight: bold;"> This is Computer Generated E-Ticket does not required signature.</p>
</div>	

	<a href="javascript:void(0)" style="font-family: Calibri;  font-size: 15px;  background: #0278bc;  color: #fff;  text-decoration: none;  float: left;  padding: 2px 10px;  display: block;  font-size: 17px;  margin-left: 10px;" onclick="printDiv('divName')">print</a>
<div style="clear:both;"></div>
</div>
<?php }else{

	echo "<div style='text-align: center;padding: 130px 0px;font-family: cursive;'>".
	"<h2>".$ticket_data->Response->Error->ErrorMessage." <br/>if any Error occured Please  Contact To Our Support Contact No. </h2>".
	"</div>";
		
	echo "<div style=' text-align: center; padding:0px 0px; font-family:cursive; '><a href=".site_url('/')."><h3> Go to Home page  </h3></div>";
} 

}else{

	echo "<div style='text-align: center;padding: 130px 0px;font-family: cursive;'>".
	"<h2> <br/>Your Booking Session Expired. Please Contact To Support For More Details.  </h2>".
	"</div>";
		
	echo "<div style=' text-align: center; padding:0px 0px; font-family:cursive; '><a href=".site_url('/')."><h3> Go to Home page  </h3></div>";
} 


?>

<script>
 $(document).ready(function($) {
 if (window.history && window.history.pushState) {
   window.history.pushState('forward', null, '');
   $(window).on('popstate', function() {
	//var hostname = location.hostname;
	var hostname = "<?php echo site_url(); ?>";
   window.location.href=hostname;
   }); } }); 
</script>

 <script>
function printDiv(divName) {
	 var printContents = document.getElementById(divName).innerHTML;
	 var originalContents = document.body.innerHTML;

	 document.body.innerHTML = printContents;

	 window.print();

	 document.body.innerHTML = originalContents;
}
</script>


</body>
</html>

</div>
</main>
<?php $this->load->view('include/footer'); ?>