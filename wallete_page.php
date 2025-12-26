<?php if(isset($_SESSION["customer_login"])) { ?>
         <!---- Wallet payment Option ---->
         
         <div class="row">
         <div class="col-md-12 d-flex align-items-center mt-2 mb-2" style="background: #f8f6f6;padding: 12px;"> <span class="fs_16 fw_5">Payment Option </span></div>
             <div class="col-md-12 mb-2 mt-2">
              <div class="pt-2 pb-2 ">
                <div class="row m-0">
                  <div class="col-12 col-md-12 d-flex align-items-center">
                    <div class="row">
                      <div class="col-12">

                      <?php 
                      
                      if($_SESSION['flight']['totalprice'] <= $this->customer_wallete_balance) { ?>
                              <label class="radio-inline mr-5">
                                <input type="radio" name="ptype" value="<?php echo encode_url('wallet'); ?>"> Wallet
                              </label>

                      <?php } ?>
					   <label class="radio-inline ml-5">
                                  <input type="radio" name="ptype" value="<?php echo encode_url('online'); ?>" checked > Online
                              </label>

                       
                        <p class="fs_16 fw_5  mb-0">                        
                          <span class="font-weight-normal fs_12 p_color">Wallet Balance : <i class="fa fa-inr"></i> <?php echo $this->customer_wallete_balance;?></span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div> 
      <!---- Wallet payment Option ---->
<?php } ?>