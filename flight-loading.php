<html lang="en">
<head>
    <title><?php echo $this->company_info['meta_title']; ?></title>        
    <meta name="title" content="<?php echo $this->company_info['meta_title']; ?>" />        
    <meta name="keywords" content="<?php echo $this->company_info['meta_keyword']; ?>" />        
    <meta name="description" content="<?php echo $this->company_info['meta_description']; ?>">        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <link rel="icon" href="<?php echo base_url(); ?>admin/webroot/img/uploads/favicon/<?php echo $this->company_info['company_favicon']; ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo site_url('/'); ?>webroot/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo site_url('/'); ?>webroot/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo site_url('/'); ?>webroot/css/custom.css">
    <link rel="stylesheet" href="<?php echo site_url('/'); ?>webroot/css/common.css">
    <link rel="stylesheet" href="<?php echo site_url('/'); ?>webroot/css/style.css">
    <link rel="stylesheet" href="<?php echo site_url('/'); ?>webroot/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900&display=swap" rel="stylesheet">
    <!--Main Menu File-->
    <link id="effect" rel="stylesheet" type="text/css" href="<?php echo site_url('/'); ?>webroot/css/fade-down.css">
</head>
<body style="overflow: hidden;">
<style>
 @media only screen and (max-width: 1262px) and (min-width: 992px){ h5.short_tittle,h5.head_tittle  {
    font-size: 11px;
} 
}
h5.short_tittle,div.sorting_tittle2{  background: transparent;    text-transform: capitalize;
    border-bottom: 0px;
    margin: 0px;
    padding: 0px;}
div.sorting_tittle2 .col-lg-3{border-right: 0px;}    
#loadingid{position: fixed;
    z-index: 99;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background-color:#ffffffd6;
    text-align-last: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;}


.wrapper{
  width:100%;
  height:50px;
  position:fixed;
  top:50%;
  left:50%;
  margin-left:-50px;
  margin-top:-50px;
}
#preloader{
  width:50px;
  height:50px;
  border:2px solid #323465;
  border-radius:0px;
  -webkit-animation: preloader 4.5s infinite linear;
    -moz-animation: preloader 4.5s infinite linear;
    -ms-animation: preloader 4.5s infinite linear;
    animation: preloader 4.5s infinite linear;
}
#preloader:after{
  content:'';
  width:14px;
  height:14px;
  background:#323465;
  position:absolute;
  top:50%;
  left:50%;
  margin-left:-7px;
  margin-top:-7px;
  border-radius:20px;
    -webkit-animation: preloader_after 4.5s infinite linear;
  -moz-animation: preloader_after 4.5s infinite linear;
  -ms-animation: preloader_after 4.5s infinite linear;
  animation: preloader_after 4.5s infinite linear;
  -webkit-transform:scale(0);
}

@-webkit-keyframes preloader {
0%{ -webkit-transform:scale(0)}
10%{ -webkit-transform:scale(1.3)}
12%{ -webkit-transform:scale(1)}
15%{ -webkit-transform:scale(1.3)}
17%{ -webkit-transform:scale(1)}
25%{ -webkit-transform:scale(1)}
40%{ -webkit-transform:scale(1) rotate(180deg); border-radius:20px;}
42%{ -webkit-transform:scale(1) rotate(180deg); border-radius:0px;}
44%{ -webkit-transform:scale(1) rotate(180deg); border-radius:20px;}
  46%{ -webkit-transform:scale(1) rotate(180deg); border-radius:0px;}
    48%{ -webkit-transform:scale(1) rotate(180deg); border-radius:20px;}
      50%{ -webkit-transform:scale(1) rotate(180deg); border-radius:20px;}
  95%{ -webkit-transform:scale(1) rotate(180deg); border-radius:20px;}
        100%{ -webkit-transform:scale(0) rotate(180deg); border-radius:100px;}
}

@-moz-keyframes preloader {
0%{ -moz-transform:scale(0)}
10%{ -moz-transform:scale(1.3)}
12%{ -moz-transform:scale(1)}
15%{ -moz-transform:scale(1.3)}
17%{ -moz-transform:scale(1)}
25%{ -moz-transform:scale(1)}
40%{ -moz-transform:scale(1) rotate(180deg); border-radius:20px;}
42%{ -moz-transform:scale(1) rotate(180deg); border-radius:0px;}
44%{ -moz-transform:scale(1) rotate(180deg); border-radius:20px;}
  46%{ -moz-transform:scale(1) rotate(180deg); border-radius:0px;}
    48%{ -moz-transform:scale(1) rotate(180deg); border-radius:20px;}
      50%{ -moz-transform:scale(1) rotate(180deg); border-radius:20px;}
  95%{ -moz-transform:scale(1) rotate(180deg); border-radius:20px;}
        100%{ -moz-transform:scale(0) rotate(180deg); border-radius:100px;}
}

@-ms-keyframes preloader {
0%{ -ms-transform:scale(0)}
10%{ -ms-transform:scale(1.3)}
12%{ -ms-transform:scale(1)}
15%{ -ms-transform:scale(1.3)}
17%{ -ms-transform:scale(1)}
25%{ -ms-transform:scale(1)}
40%{ -ms-transform:scale(1) rotate(180deg); border-radius:20px;}
42%{ -ms-transform:scale(1) rotate(180deg); border-radius:0px;}
44%{ -ms-transform:scale(1) rotate(180deg); border-radius:20px;}
  46%{ -ms-transform:scale(1) rotate(180deg); border-radius:0px;}
    48%{ -ms-transform:scale(1) rotate(180deg); border-radius:20px;}
      50%{ -ms-transform:scale(1) rotate(180deg); border-radius:20px;}
  95%{ -ms-transform:scale(1) rotate(180deg); border-radius:20px;}
        100%{ -ms-transform:scale(0) rotate(180deg); border-radius:100px;}
}

@keyframes preloader {
0%{ transform:scale(0)}
10%{ transform:scale(1.3)}
12%{ transform:scale(1)}
15%{ transform:scale(1.3)}
17%{ transform:scale(1)}
25%{ transform:scale(1)}
40%{ transform:scale(1) rotate(180deg); border-radius:20px;}
42%{ transform:scale(1) rotate(180deg); border-radius:0px;}
44%{ transform:scale(1) rotate(180deg); border-radius:20px;}
  46%{ transform:scale(1) rotate(180deg); border-radius:0px;}
    48%{ transform:scale(1) rotate(180deg); border-radius:20px;}
      50%{ transform:scale(1) rotate(180deg); border-radius:20px;}
  95%{ transform:scale(1) rotate(180deg); border-radius:20px;}
        100%{ transform:scale(0) rotate(180deg); border-radius:100px;}
}
  
  
  
  
  @-webkit-keyframes preloader_after {
0%{ -webkit-transform:scale(0); }
45%{ -webkit-transform:scale(0); }
50%{ -webkit-transform:scale(1);}
55%{ -webkit-transform:scale(1) translateY(-20px) translateX(-14px);}
 60%{ -webkit-transform:scale(1) translateY(20px) translateX(14px);}
    65%{ -webkit-transform:scale(1) translateY(-20px) translateX(14px);}
 70%{ -webkit-transform:scale(1) translateY(20px) translateX(-14px);}
        75%{ -webkit-transform:scale(1) translateY(-20px) translateX(14px);}
 80%{ -webkit-transform:scale(1) translateY(20px) translateX(-14px);}
     85%{ -webkit-transform:scale(1) translateY(-20px) translateX(-14px);}
 90%{ -webkit-transform:scale(1) translateY(0px) translateX(0px);}
95%{ -webkit-transform:scale(1.5);}
100%{ -webkit-transform:scale(0);}
  }


  @-moz-keyframes preloader_after {
0%{ -moz-transform:scale(0); }
45%{ -moz-transform:scale(0); }
50%{ -moz-transform:scale(1);}
55%{ -moz-transform:scale(1) translateY(-20px) translateX(-14px);}
 60%{ -moz-transform:scale(1) translateY(20px) translateX(14px);}
    65%{ -moz-transform:scale(1) translateY(-20px) translateX(14px);}
 70%{ -moz-transform:scale(1) translateY(20px) translateX(-14px);}
        75%{ -moz-transform:scale(1) translateY(-20px) translateX(14px);}
 80%{ -moz-transform:scale(1) translateY(20px) translateX(-14px);}
     85%{ -moz-transform:scale(1) translateY(-20px) translateX(-14px);}
 90%{ -moz-transform:scale(1) translateY(0px) translateX(0px);}
95%{ -moz-transform:scale(1.5);}
100%{ -moz-transform:scale(0);}
  }

  @-ms-keyframes preloader_after {
0%{ -ms-transform:scale(0); }
45%{ -ms-transform:scale(0); }
50%{ -ms-transform:scale(1);}
55%{ -ms-transform:scale(1) translateY(-20px) translateX(-14px);}
 60%{ -ms-transform:scale(1) translateY(20px) translateX(14px);}
    65%{ -ms-transform:scale(1) translateY(-20px) translateX(14px);}
 70%{ -ms-transform:scale(1) translateY(20px) translateX(-14px);}
        75%{ -ms-transform:scale(1) translateY(-20px) translateX(14px);}
 80%{ -ms-transform:scale(1) translateY(20px) translateX(-14px);}
     85%{ -ms-transform:scale(1) translateY(-20px) translateX(-14px);}
 90%{ -ms-transform:scale(1) translateY(0px) translateX(0px);}
95%{ -ms-transform:scale(1.5);}
100%{ -ms-transform:scale(0);}
  }

  @keyframes preloader_after {
0%{ transform:scale(0); }
45%{ transform:scale(0); }
50%{ transform:scale(1);}
55%{ transform:scale(1) translateY(-20px) translateX(-14px);}
 60%{ transform:scale(1) translateY(20px) translateX(14px);}
    65%{ transform:scale(1) translateY(-20px) translateX(14px);}
 70%{ transform:scale(1) translateY(20px) translateX(-14px);}
        75%{ transform:scale(1) translateY(-20px) translateX(14px);}
 80%{ transform:scale(1) translateY(20px) translateX(-14px);}
     85%{ transform:scale(1) translateY(-20px) translateX(-14px);}
 90%{ transform:scale(1) translateY(0px) translateX(0px);}
95%{ transform:scale(1.5);}
100%{ transform:scale(0);}
  }
div.flight_fare{width: auto;}
    
</style>

<style>
.quots_fix{position: absolute;
    margin: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    left: 0px;
    top: 38px;}
.or1{    position: absolute;
    top: 42px;
}
.dept1{    position: absolute;
    top: 286px;
}
.loaded #loader-wrapper {
    -webkit-transition: all 0.4s 0.6s ease-out;
    -ms-transition: all 0.4s 0.6s ease-out;
    transition: all 0.4s 0.6s ease-out;
}
.logo_blue {
    color: #00b8f4;
}
#loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
}
.loaded #loader {
    -webkit-transition: all 0.3s 0.6s ease-out;
    -ms-transition: all 0.3s 0.6s ease-out;
    transition: all 0.3s 0.6s ease-out;
}

#loader {
    border-top-color: #888!important;
}
#loader {
    display: block;
    position: relative;
    left: 50%;
    top: 407px;
    width: 115px;
    height: 115px;
    margin: -75px 0 0 -75px;
    border-radius: 50%;
    border: 3px solid transparent;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}

#loader:before {
    content: "";
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border-radius: 50%;
    border: 6px solid transparent;
    -webkit-animation: spin 3s linear infinite;
    animation: spin 3s linear infinite;
} #loader:before {
    border-top-color: #5381BA!important;
}#loader:after {
    border-top-color: #5381BA!important;
}#loader:after {
    content: "";
    position: absolute;
    top: 15px;
    left: 15px;
    right: 15px;
    bottom: 15px;
    border-radius: 50%;
    border: 3px solid transparent;
    -webkit-animation: spin 1.5s linear infinite;
            animation: spin 1.5s linear infinite;
}
@-webkit-keyframes spin {
    0% { 
        -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
                transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
                transform: rotate(360deg);
    }
}
@keyframes spin {
    0% { 
        -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
                transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
                transform: rotate(360deg);
    }
}
.loading {
    position: fixed;
    top:75px;
    left: 0;
    z-index: 999999;
    width: 100%;
    height: 100%;
    text-align: center;
    padding-top: 18%;
}
.site-preloader .spinner {
    width: 60px;
    height: 60px;
    margin: 21% auto;
    background-color: #fff;
    border-radius: 100%;
    -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
    animation: sk-scaleout 1.0s infinite ease-in-out;
}
.load_loc{    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    top: 19%;
    color: #00b8f4;}
#loadingid>img{top: 25%;width: auto;    border-radius: 1px;}
.wrapper{
  width:100%;
  height:50px;
  position:fixed;
  top:35%;
  margin-left:-50px;
  margin-top:-50px;
}
 .loading-bar {
  height: 1rem;
  width: 60vw;
  max-width: 220px;
  min-width: 200px;
     margin: 8px 3px 10px 10px;
  padding: .15rem .05rem .05rem .15rem;
  box-shadow:
    -.3em -.2em 1em #f4f4f4,
    inset .4em .5em .9em #E3E3E375,
    .3em .2em .5em #88888890,
    inset -.4em -.5em .9em #E3E3E390;
}
.loading-bar,
.loading-bar div {
  border-radius: 1000px;
    display: inline-grid;
}
.thin {
  padding: .35rem!important;
}
.solid {
  height: 100%;
    background-color: #ffee4f;
  animation: load 5s ease-out infinite;
}
.depar_pasenger {width: 100%;
       background: #f3f3f3;
    margin-left: 0px;
    padding: 10px 0px 10px 0px;}
@keyframes load {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
}
.wrapper_bg {background: white;
   box-shadow: 0px 0px 6px 0px #d6d6d6;}


</style>
<main class="container-fluid addblur ptb30 plr0 mpt0 pt-3 pb-3">
<div class="container">
  <div class="row">

   <aside class="col-lg-3 col-12 mt-md-5" >

        <div class=" filter  result_side_bar  " data-filter-sw="true">
          <h5 class="p10 mb-0 w100  hidden-md-down "><div class="p10 load_1d fs_13">Filter</div></h5>

          <i class="fa fa-times  filter_close" data-filter-trans="true"></i>
          <div class="col-12 p0 white_bg">
            <div class="row parentdv ">
              <h5 class="short_tittle" data-toggle-btnthree="true">price <i class="fa fa-caret-down"></i></h5>
              <div class="row m0 swim p10 load_1d" data-toggle-filter="true">

              </div>
            </div>
            <div class="row parentdv ">
              <h5 class="gray_bg short_tittle onfheadings" data-toggle-btnthree="true">fare type <i class="fa fa-caret-down"></i></h5>
              <div class="row  filterheight scrollauto swim p10 load_1d"></div><br><br>
              <div class="row  filterheight scrollauto swim p10 load_1d"></div><br><br>
              <div class="row  filterheight scrollauto swim p10 load_1d"></div>
            </div>
            <div class="row parentdv ">
              <h5 class="gray_bg short_tittle onfheadings" data-toggle-btnthree="true">Stop <i class="fa fa-caret-down"></i></h5>
               <div class="row  filterheight scrollauto swim p10 load_1d"></div><br><br>
              <div class="row  filterheight scrollauto swim p10 load_1d"></div><br><br>
              <div class="row  filterheight scrollauto swim p10 load_1d"></div>
            </div>

            <div class="row parentdv ">
              <h5 class="gray_bg short_tittle onfheadings" data-toggle-btnthree="true">  Departure Times <i class="fa fa-caret-down"></i></h5>
           <div class="col-lg-12 col-12">
            <div class="row">
              <h5 class="col  swim  load_1d "></h5>
              <h5 class="col  swim  load_1d "></h5>
            </div>
            <div class="row ">
              <h5 class="col  swim  load_1d "></h5>
              <h5 class="col  swim  load_1d "></h5>
            </div>
          </div>

            </div>

            <div class="row parentdv">
              <h5 class="gray_bg short_tittle onfheadings" data-toggle-btnthree="true">Airlines <i class="fa fa-caret-down"></i></h5>
              <div class="row  filterheight scrollauto swim p10 load_1d"></div><br><br>
              <div class="row  filterheight scrollauto swim p10 load_1d"></div><br><br>
              <div class="row  filterheight scrollauto swim p10 load_1d"></div><br><br>
              <div class="row  filterheight scrollauto swim p10 load_1d"></div><br><br>
              <div class="row  filterheight scrollauto swim p10 load_1d"></div>
            </div>
          </div>
        </div>



   </aside>
<!-- result fare list -->
  <section class="col-lg-9">
  <div class="row sorting_tittle2 hidden-lg-down" style="padding: 9px 0px 0px 0px;">
    <div class="col-lg-8 col-md-8 col-12">
      <div class="row ">

          <div class="col-lg-3 col-3 swim  ">   <h5 class=" head_tittle ">Airlines <i class="fa fa-caret-down"></i></h5></div>
          <div class="col-lg-3 col-3 swim  ">  <h5 class=" head_tittle ">Depart  <i class="fa fa-caret-down"></i></h5> </div>
          <div class="col-lg-3 col-3 swim  ">  <h5 class=" head_tittle ">Arrive  <i class="fa fa-caret-down"></i></h5> </div>

        </div>
    </div>
    <div class="col-lg-3 col-3 swim ">   <h5 class=" head_tittle ">Duration <i class="fa fa-caret-down"></i></h5> </div>

  </div>

<?php for ($i = 1; $i <= 15; $i++) {?>
        <div class="row bdr_sdo flight_fare hover">
      <div class="col-lg-8 col-md-8 col-9">
        <div class="row ptb8 align-items-center">
          <div class="col-lg-3 col-2   load_1d h50">
          </div>
          <div class="col-lg-6 col-7">
            <div class="row">
              <h5 class="col  swim  load_1d "></h5>
              <h5 class="col  swim  load_1d "></h5>
            </div>
            <div class="row ">
              <h5 class="col  swim  load_1d "></h5>
              <h5 class="col  swim  load_1d "></h5>
            </div>
          </div>
          <div class="col-lg-2 col-2 ar_duration p0 align-self-center">
              <h5 class="col  swim  load_1d "></h5>
              <h5 class="col  swim  load_1d "></h5>
          </div>
        </div>
        <div class="row divider"></div>
      </div>
      <div class="col-lg-4 col-md-4 col-3 align-self-center plr10">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-4 ar_book text-right pl0  "><h5 class="col  swim  load_1d "></h5>
              <h5 class="col  swim  load_1d "></h5> </div>
          <div class="col-lg-5 col-md-5 col-4 ar_book text-right pl0 align-items-center d-flex">
              <h5 class="col  swim  load_1d h42i"></h5> </div>
        </div>
      </div>
    <!-- flight details heading div -->
    <div class="row fare_title justify-content-center d-none d-md-block">
      <div class="col-lg-2 col-md-2 col-6 pl0 details  swim  load_1d"></div>
      <div class="col-lg-2 col-md-2 col-6 pl0 details swim  load_1d"></div>
      <div class="col-lg-2 col-md-2 col-6 details swim load_1d"></div>
      <div class="col-lg-2 col-md-2 col-6 p0 details swim  load_1d"></div>
    </div>
    <!-- flight details heading div End-->
    </div>
<?php }?>
      </section>
<!-- result fare list End -->

  </div>
</div>
<div id="loadingid"> <?php $data  =  $_GET; ?><div id="loader-wrapper"></div><!--<div class="wrapper">
<div id="preloader"></div>
  </div>-->
        <div class="row">

    <div class="offset-md-3 col-md-8 wrapper_bg">
      <div class="row">
    <div class="col-md-12">
      <img itemprop="image" src="<?php echo site_url('/'); ?>admin/webroot/img/uploads/logo/<?php echo $this->company_info['company_logo'];?>" alt="<?php echo $this->company_info['company_name'];?>" title=" <?php echo $this->company_info['company_name'];?>" class="img-fluid sec_img" style="margin-top: 15px;
    width: 130px;
    text-align: center;">
    <h5 style=" text-align: center; margin-bottom: 0px;"> Please Wait... </h5>
    <p style=" text-align: center; margin-bottom: 0px;">We are looking for all available flights for</p>
         <?php if($data['journeytype'] =='roundtrip') {?>
   <samp style=" text-align: center;font-size: 12px;    font-weight: 500;   color: #459947; " > <?php echo ucfirst ($data['origin']);?>&#8646;<?php echo ucfirst($data['destination']) ;?></samp> 
    
    <?php } elseif($data['journeytype'] =='multicity') {?>

      <samp style=" text-align: center;font-size: 12px;    font-weight: 500;   color: #459947; "> <?php echo ucfirst ($data['origin'][0]);?>&#8646;<?php echo ucfirst(array_values(array_slice($data['destination'], -1))[0]) ;?></samp> 
     
    <?php } else { ?>

        <samp style=" text-align: center;font-size: 12px;    font-weight: 500;   color: #459947;"> <?php echo ucfirst ($data['origin']);?>&#8594;<?php echo ucfirst ($data['destination']);?></samp> 
        
    <?php }?>
      </div>
  <div class="col-md-12 text-center">
<img src="<?php echo site_url('webroot/images/Flights-loading.gif');?>" style="width: 174px;">
</div>
<div class="row depar_pasenger">

<?php if($data['journeytype'] =='roundtrip') {?>
  <div class="col-md-4">
    <p class="mb-0"> <b> Departure </b> :<?php echo $data['departdate'];?></p>
  </div>
  
  <div class="col-md-4">
    <p class="mb-0"> <b> Return </b> :<?php echo $data['returndate'];?></p>
  </div>
  
  <div class="col-md-4">
  <p class="mb-0"><b> Passenger </b> :<?php echo $data['adults'] + $data['child'] + $data['infant'];?></p>
  </div>
  <?php } elseif($data['journeytype'] =='multicity') {?>
    <div class="col-md-5">
    <p class="mb-0"> <b> Departure </b> :<?php echo $data['departdate'][0];?></p>
  </div>
  
  <!--<div class="col-md-4">
    <p class="mb-0"> <b> Return </b> :<?php echo array_values(array_slice($data['departdate'], -1))[0] ;?></p>
  </div>-->
  
  <div class="col-md-4">
  <p class="mb-0"><b> Passenger </b> :<?php echo $data['adults'] + $data['child'] + $data['infant'];?></p>
  </div>
  <?php } else { ?>

    <div class="col-md-6">
    <p class="mb-0"> <b> Departure </b> :<?php echo $data['departdate'];?></p>
  </div>
  
  
  
  <div class="col-md-6">
  <p class="mb-0"><b> Passenger </b> :<?php echo $data['adults'] + $data['child'] + $data['infant'];?></p>
  </div>
  <?php }?>  
  
  
  
  </div>
</div>
</div>

  </div>
  
  
  </div>
</main>

<form action="<?php echo base_url('flight/result'); ?>" method="get" id="frm1" name="frm1">

<?php foreach ($_GET as $key => $value): ?>
<?php if ($_GET['journeytype'] == "multicity") {
    if (is_array($value)) {
        foreach ($value as $keyval => $values) {
            echo '<input type="hidden" name="' . $key . '[' . $keyval . ']" value="' . $values . '">';
        }
    } else {
        echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
    }
} else {
    echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';

}?>
          <?php endforeach;?>
          </form>

<input type="hidden" id="site_url" value="<?php echo site_url(); ?>">
<input type="hidden" id="fetch_class" value="<?php $this->router->fetch_class(); ?>"/>
<script type="text/javascript" src="<?php echo site_url('/'); ?>webroot/js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo site_url('/'); ?>webroot/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo site_url('/'); ?>webroot/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo site_url('/'); ?>webroot/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo site_url('/'); ?>webroot/js/jquery.form-validator.min.js"></script>
<!--Main Menu File-->

<script>
 $.validate({decimalSeparator : ','});  </script> 


<script>
  $(".li_click").click(function(){
  $(".sprt_num").hide(); 
   $(".raj_num").show();
}); 
 $(".lino_click").click(function(){
  $(".raj_num").hide(); 
   $(".sprt_num").show();
});
</script> 
<script>
  $(document).ready(function(){
       $("#frm1").submit(); 
       });
       </script>
</body>
</html>
