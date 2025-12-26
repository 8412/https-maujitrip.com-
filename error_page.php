<?php $this->load->view('include/header'); ?>
<main class="container ptb30 plr0 pt15m">
	<div class="row m0 text-center">
		<div class="col-12">
		<img src="<?php echo base_url(); ?>webroot/images/oopsimage.png" alt="oops image" class="img-fluid">
		  <br/><br/>
			<h2><?php echo $error_message; ?></h2>			
			<!--<h2><?php pr($error_message); ?></h2>-->
			<br/>
			<?php 
			if($booking_id) { ?>
			 <h3>Booking ID : <?php echo $this->flight_prefix;?><?php echo $booking_id; ?></h3>
			 <br/>
			<?php } ?>
			<h4 class="text-danger">Contact your administrator for more information <a href="tel:<?php echo $this->company_info['support_no']; ?>"><i class="fa fa-phone"></i> <?php echo $this->company_info['support_no']; ?></a> and support email id <a href="mailto:<?php echo $this->company_info['support_email']; ?>"> <i class="fa fa-envelope-o"></i> <?php echo $this->company_info['support_email']; ?></a></h4>
		</div>
	</div>
</main>	
<?php $this->load->view('include/footer'); ?>