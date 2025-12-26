<?php $this->load->view("include/header"); ?>
<?php $this->load->view("include/slider"); ?>

    <style>
        @media (max-width: 1023px) and (min-width: 768px) {
            .flight_tab_content_mob_res {
                position: relative;
            }
        }
    </style>
<?php $this->load->view("include/search-form"); ?>

<section class="tts-infobar">
        <div class="container">
            <h4 style="font-size: 1.5rem;">Why Book With Us ?</h4>
            <div class="row pt-3">
            <div class="col-6 col-md-3 tts-infobar-boder-right"> 
                <div class="d-flex">
                    <div class="img">
                    <img src="<?php echo site_url('webroot/images/iata-logo.png');?>" style="width: 80%;">
                    </div>
                </div>    
            </div>

            <div class="col-6 col-md-3 tts-infobar-boder-right"> 
                <div class="d-flex">
                    <div class="img">
                    <img src="<?php echo site_url('webroot/images/plane.svg');?>">
                    </div>
                    <div class="left">
                      <p class="tts-infobar-heading">Lowest Price Deals</p>
                      <p class="tts-infobar-content">- Easy Cancellation <br/> - Attractive Offers</p>
                    </div>
                </div>  
            </div>

            <div class="col-6 col-md-3 tts-infobar-boder-right"> 
                <div class="d-flex">
                    <div class="img">
                      <img src="<?php echo site_url('webroot/images/discount.svg');?>">
                    </div>
                    <div class="left">
                         <p class="tts-infobar-heading">Discounted Deals</p>
                         <p class="tts-infobar-content">- Worldwide Hotels <br/> - Holiday Package</p>
                    </div>
                </div> 
               
            </div>
 
            <div class="col-6 col-md-3"> 
                <div class="d-flex">
                    <div class="img">
                      <img src="<?php echo site_url('webroot/images/customer-care.svg');?>">
                    </div>
                    <div class="left">
                     <p class="tts-infobar-heading">24X7 Customer Support</p>
                     <p class="tts-infobar-content">For all kind of travel related queries</p>
                    </div>
                </div> 
            </div>
          </div>
          
        </div>

    </section>

    
<?php if ($this->offers) { ?>
    <section class="top_postition_home">
        <div class="container ">
            <div class="home_heading">
                <h3 class="title "><span class="">Flights Offers &</span> Deals</h3>
            </div>
            <div class="row">
                <div class="owl-carousel owl-theme top_cat_carou  " id="holiday_carousel3">
                    <?php foreach ($this->offers as $offer)  { ?>
                    <?php
                    if ($offer['link'] != ''){

                    ?>
                    <a href="<?php echo $offer['link']; ?>" alt="<?php echo $this->company_name['company_name']; ?>"
                       title="<?php echo $this->company_name['company_name']; ?>">
                        <?php } ?>
                        <div class="item">
                            <div class="col-xs-12 col-sm-12 col-md-12 main_clss1 image_hotel  ">
                                <article class="hide_arrow hover_effect">
                                    <figure class="box-inner">
                                        <img src="<?php echo site_url('/'); ?>/admin/webroot/img/uploads/flight_offer/thumbnail/<?php echo $offer['offer_image']; ?>"
                                             alt="<?php echo $this->company_name['company_name']; ?>"
                                             title="<?php echo $this->company_name['company_name']; ?>"
                                             class="img-responsive">
                                        <div class="box_pricerate1">
                                            <div class="title_name">

                                                <h6 class="fs_14 tts_ft-w-600"><?php echo $offer['field1']; ?></h6>
                                                <div class="hotel_item pt-2">
                                                    <p class="card-text fs_12 mb-0 text-uppercase">
                                                        <?php echo $offer['field2'] . "<br/>" . $offer['field3']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <?php
                        if ($offer['link'] != '') {
                            echo "</a>";
                        }
                        ?>
                        <?php } ?>
                </div>
            </div>
    </section>
<?php } ?>

<?php if ($domestic_flight_deals) { ?>
    <div class="crous_section pt-3 pb-3">
        <div class="home_heading">
            <h1 class="title "><span>Popular Domestic </span> Flight Routes</h1>
        </div>
        <div class="container">
            <div class="row">
                <?php $city = count($domestic_flight_deals);
                $i = 0;
                $counts = 0; ?>
                <div class="owl-carousel owl-theme top_box_carousel  " id="box_carousel3">
                    <?php for ($j = $i; $j < $city; $j = $j + 2) { ?>
                        <?php $count = 0; ?>

                        <div class="item">
                            <?php foreach (array_slice($domestic_flight_deals, $counts) as $key => $domestic_flight_deal) {
                                //pr($domestic_flight_deal);
                                $date = str_replace("/", "-", ($domestic_flight_deal['depart_date']));
                                ?>
                                <div class="col-md-12 box_flight ">
                                    <a href="<?php echo base_url(); ?>flight/search?journeytype=oneway&origin=<?php echo $domestic_flight_deal['origin']; ?>&destination=<?php echo $domestic_flight_deal['destination']; ?>&departdate=<?php echo $date; ?>&returndate=&adults=1&child=0&infant=0&cabinclass=Economy"
                                       class="td_none d-inline-block w-100 nh_color" title="">
                                        <div class="destiniy_box">
                                            <div class="city_text1"><?php echo $domestic_flight_deal['origin']; ?></div>
                                            <div class="time"><?php echo $domestic_flight_deal['depart_date']; ?></div>
                                            <div class="city_text1"><?php echo $domestic_flight_deal['destination']; ?></div>
                                        </div>
                                        <div class="price_go ">
                                            <p class="lowest_price1 d-flex justify-content-between mb-0">
                                                <span class="price_fare mb-0">Starting From</span>
                                                <span class="rupees"> Rs. <?php echo $domestic_flight_deal['price']; ?></span>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                $counts = $counts + 1;
                                $count = $count + 1;
                                if ($count == 2) {
                                    break;
                                } else {
                                    continue;

                                }

                            } ?>
                        </div>
                        <?php
                        if ($j == 0) {
                            $i = $i + 1;
                        } else {
                            $i = $i + 2;
                        }

                    } ?>
                </div>

            </div>
        </div>
    </div>
<?php } ?>

<?php if ($international_flight_deals) { ?>
    <div class="crous_section pt-3 pb-3">
        <div class="home_heading">
            <h3 class="title "><span>Popular International </span> Flight Routes</h3>
        </div>
        <div class="container">
            <div class="row">
                <?php $city = count($international_flight_deals);
                $i = 0;
                $counts = 0; ?>
                <div class="owl-carousel owl-theme top_box_carousel  " id="box_carousel4">
                    <?php for ($j = $i; $j < $city; $j = $j + 2) { ?>
                        <?php $count = 0; ?>

                        <div class="item">
                            <?php foreach (array_slice($international_flight_deals, $counts) as $key => $international_flight_deal) {
                                $date = str_replace("/", "-", ($international_flight_deal['depart_date']));
                                ?>
                                <div class="col-md-12 box_flight ">
                                    <a href="<?php echo base_url(); ?>flight/search?journeytype=oneway&origin=<?php echo $domestic_flight_deal['origin']; ?>&destination=<?php echo $domestic_flight_deal['destination']; ?>&departdate=<?php echo $date; ?>&returndate=&adults=1&child=0&infant=0&cabinclass=Economy"
                                       class="td_none d-inline-block w-100 nh_color" title="">
                                        <div class="destiniy_box">
                                            <div class="city_text1"><?php echo $international_flight_deal['origin']; ?></div>
                                            <div class="time"><?php echo $international_flight_deal['depart_date']; ?></div>
                                            <div class="city_text1"><?php echo $international_flight_deal['destination']; ?></div>
                                        </div>
                                        <div class="price_go ">
                                            <p class="lowest_price1 mb-0 d-flex justify-content-between">
                                                <span class="price_fare d-flex justify-content-between">Starting From</span>
                                                <span class="rupees"> Rs. <?php echo $international_flight_deal['price']; ?></span>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                $counts = $counts + 1;
                                $count = $count + 1;
                                if ($count == 2) {
                                    break;
                                } else {
                                    continue;

                                }

                            } ?>
                        </div>
                        <?php
                        if ($j == 0) {
                            $i = $i + 1;
                        } else {
                            $i = $i + 2;
                        }

                    } ?>
                </div>

            </div>
        </div>
    </div>
<?php } ?>


    <div class="home_heading">
        <h2 class="title"><span>Best Domestic Flight and International</span> Flight Deals</h2>
        <div class="container pt-3 pb-3">


                <p class="text-justify mb-1">
                    Maujitrip searches across hundreds of airlines and travel sites, from major booking sites to
                    individual company websites. That helps to provide you with as many low-cost flight alternatives
                    as possible for travelers. With the comparison of many sites, you get the best deals on a
                    Domestic flight and International flight bookings.
                    </p>
                    <p class="text-justify mb-1">
                    We provide completely free to use services with no hidden charges or fees, and the prices of the
                    flight tickets you see are never affected by your searches or the number of searches you
                    conduct.
                    </p>
                    <p class="text-justify mb-1">
                    We believe in traveling the world, where we can all travel and meet people from other cultures,
                    thus we're dedicated to giving you the best Domestic flight and International flight so that you
                    can explore more and more.
                </p>

        </div>
    </div>

    <section class="tts-infobar">
        <div class="container">
            <h4 class="tts-why-choose">Choose us to get</h4>
            <div class="row pt-3">
            <div class="col-6 col-md-3 tts-infobar-boder-right"> 
                <div class="d-flex">
                    <div class="left">
                      <p class="tts-infobar-heading">Easy Booking</p>
                      <p class="tts-infobar-content">Get a single portal to handle your travel deals and book flights, buses, vacations, and cruises with affordable deals.</p>
                    </div>
                </div>  
            </div>

            <div class="col-6 col-md-3 tts-infobar-boder-right"> 
                <div class="d-flex">
                    <div class="left">
                         <p class="tts-infobar-heading">Customized Tours</p>
                         <p class="tts-infobar-content">Customize your own tours which you want to accomplish during your holidays and make it affordable for you.</p>
                    </div>
                </div> 
               
            </div>
 
            <div class="col-6 col-md-3 tts-infobar-boder-right"> 
                <div class="d-flex">
                    <div class="left">
                     <p class="tts-infobar-heading">Lowest Price</p>
                     <p class="tts-infobar-content">Take advantage of never-before-seen deals and complete your trips at the most affordable prices.</p>
                    </div>
                </div> 
            </div>

            <div class="col-6 col-md-3"> 
                <div class="d-flex">
                    <div class="left">
                     <p class="tts-infobar-heading">Exciting Deals</p>
                     <p class="tts-infobar-content">Take advantage of exclusive offers and discounts on hotel reservations, flights, buses, and tour packages.</p>
                    </div>
                </div> 
            </div>



          </div>


          <div class="row pt-3">
              <div class="col-12">
                <p class="text-justify mb-1">Being the best travel agency, we believe in providing the easing booking method to our travelers.
                    With our portal, you can easily book your domestic flight and International flight without any
                    hassle. And for your assistance, our travel experts are available 24*7 to assist you so that you
                    have a pleasant journey.
                </p>
                <p class="text-justify mb-1">
                    We assure you that we will give you cost-saving flight deals that can help you save up some good
                    amount of money for your further journey.So book your holiday packages with the best Domestic flight and International flight to
                    complete your dream trip.
                </p>
              </div> 
            </div>

        </div>

    </section>

 

    <?php $this->load->view("include/applink"); ?>

<?php $this->load->view("include/footer"); ?>
