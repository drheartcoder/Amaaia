@extends('front.layout.master')
@section('main_content')


<div class="bradcrum-inner">
    <div class="pul-left-title">
       Rings 
    </div>
    <div class="pul-right-sublink">
        <a href="{{url('/')}}">Home</a> / <a href="javascript:void(0)">Jewellery</a> / <span>Rings</span>
    </div>
    <div class="clearfix"></div>
</div>
<div class="min-hieght-class">
 <div class="ring-product-bg-pattern">
     <h1>Rings</h1>
     <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur"Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
 </div>   

<div class="container-fluid">
  <div class="col-md-12"><div class="title-product-likes tp-mrgin-bx">By Product Line Like</div></div>
   <div class="box-center">
    <div class="lisitng-box-twenty">
       <div class="lisitng-box-twentyinner">
        <a class="active" href="javascript:void(0)"> <!--Add Active class to the anchor tag "active"-->
            <span class="img-icon-list solitare-icns"></span>
            <span class="name-box-lisitng">Solitare Rings</span>
        </a>
        </div>
    </div>
    <div class="lisitng-box-twenty">
       <div class="lisitng-box-twentyinner">
        <a href="javascript:void(0)">
            <span class="img-icon-list bands-icns"></span>
            <span class="name-box-lisitng">Bands</span>
        </a>
        </div>
    </div>
    <div class="lisitng-box-twenty">
       <div class="lisitng-box-twentyinner">
        <a href="javascript:void(0)">
            <span class="img-icon-list accent-ring-icns"></span>
            <span class="name-box-lisitng">Accent Rings</span>
        </a>
        </div>
    </div>
    <div class="lisitng-box-twenty">
       <div class="lisitng-box-twentyinner">
        <a href="javascript:void(0)">
            <span class="img-icon-list stone-ring-icns"></span>
            <span class="name-box-lisitng">Three Store or Side Stone Rings</span>
        </a>
        </div>
    </div>
    <div class="lisitng-box-twenty">
       <div class="lisitng-box-twentyinner">
        <a href="javascript:void(0)">
            <span class="img-icon-list other-icns"></span>
            <span class="name-box-lisitng">Other</span>
        </a>
        </div>
    </div>
   </div> 
 <div class="col-md-12">
    <div  class="menu-filter-menu">
       <span class="municnons" onclick="openNavs()">Filters By &#9776;</span>
        <div id="filterID" class="sidenav show-menu">
        <ul class="min-menu">
            <li class="filtersbye">Filters By</li>
            <!-- Metal Start-->
            <li class="mega-menu sub-menu"><a href="javascript:void(0)">Metal (1) <span class="arrows-list"></span></a>  <!--Add Active class to the anchor tag "active"-->
                <ul class="su-menu">
                    <li>
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-left-su">
                                    Type
                                </div>
                                <div class="type-right-su">
                                    <div class="row">
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option" name="selector">
                                                <label for="f-option">Silver </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option2" name="selector">
                                                <label for="f-option2">Gold </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option3" name="selector">
                                                <label for="f-option3">Platinum</label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option4" name="selector">
                                                <label for="f-option4">Palladium</label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-left-su">
                                    Color
                                </div>
                                <div class="type-right-su">
                                    <div class="row">
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option5" name="selector">
                                                <label for="f-option5">
                                                             Yellow
                                                            </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option6" name="selector">
                                                <label for="f-option6">
                                                            White
                                                            </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option7" name="selector">
                                                <label for="f-option7">
                                                             Rose Gold
                                                            </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option8" name="selector">
                                                <label for="f-option8">
                                                             Two Tone
                                                            </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-left-su">
                                    Quality
                                </div>
                                <div class="type-right-su">
                                    <div class="row">
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option9" name="selector">
                                                <label for="f-option9">
                                                             14k
                                                            </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option11" name="selector">
                                                <label for="f-option11">
                                                            18k
                                                            </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option12" name="selector">
                                                <label for="f-option12">
                                                             22k
                                                            </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="radio-btn">
                                                <input type="radio" id="f-option13" name="selector">
                                                <label for="f-option13">
                                                             24k
                                                            </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Metal End-->
             <!-- Gemstone Start-->
            <li class="mega-menu sub-menu"><a href="javascript:void(0)">Gemstone <span class="arrows-list"></span></a>
                            <ul class="su-menu">
                            <li>
                                <div class="min-sublist">
                                    <div class="type-maib-su">
                                        <div class="type-left-su">
                                            Type
                                        </div>
                                        <div class="type-right-su">
                                            <div class="row">
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option" name="selector">
                                                        <label for="b-option">Diamond</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option2" name="selector">
                                                        <label for="b-option2">Pearls </label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option3" name="selector">
                                                        <label for="b-option3">Others</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option4" name="selector">
                                                        <label for="b-option4"> Without Accents  </label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="min-sublist">
                                    <div class="type-maib-su">
                                        <div class="type-left-su">
                                            Color
                                        </div>
                                        <div class="type-right-su">
                                            <div class="row">
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option5" name="selector">
                                                        <label for="b-option5"> Yellow</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option6" name="selector">
                                                        <label for="b-option6">White</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option7" name="selector">
                                                        <label for="b-option7">Rose Gold</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option8" name="selector">
                                                        <label for="b-option8">Two Tone</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="min-sublist">
                                    <div class="type-maib-su">
                                        <div class="type-left-su">
                                            Quality
                                        </div>
                                        <div class="type-right-su">
                                            <div class="row">
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option9" name="selector">
                                                        <label for="b-option9"> 14k</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option11" name="selector">
                                                        <label for="b-option11"> 18k</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option12" name="selector">
                                                        <label for="b-option12"> 22k</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option13" name="selector">
                                                        <label for="b-option13">24k</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="min-sublist">
                                    <div class="type-maib-su">
                                        <div class="type-left-su">
                                            Shape
                                        </div>
                                        <div class="type-right-su">
                                            <div class="row">
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option29" name="selector">
                                                        <label for="b-option29"> Round </label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option31" name="selector">
                                                        <label for="b-option31"> Oval</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option32" name="selector">
                                                        <label for="b-option32"> Marquise </label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="radio-btn">
                                                        <input type="radio" id="b-option33" name="selector">
                                                        <label for="b-option33">Pear Shaped</label>
                                                        <div class="check"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
            </li>
             <!-- Gemstone End-->
             
             
             <!-- Occasion Start-->
            <li class="mega-menu sub-menu"><a href="javascript:void(0)">Occasion <span class="arrows-list"></span></a>
                <ul class="su-menu">
                    <li>
                        <div class="min-sublist">
                                    <div class="type-maib-su">
                                        <div class="type-right-su">
                                            <div class="row">
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="check-box inline-checkboxs">
                                                        <input id="filled-in-box1" class="filled-in" checked="checked" type="checkbox" />
                                                        <label for="filled-in-box1">Casual</label>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="check-box inline-checkboxs">
                                                        <input id="filled-in-box2" class="filled-in" checked="" type="checkbox" />
                                                        <label for="filled-in-box2">Cocktail</label>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="check-box inline-checkboxs">
                                                        <input id="filled-in-box3" class="filled-in" checked="" type="checkbox" />
                                                        <label for="filled-in-box3">Engagement</label>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="check-box inline-checkboxs">
                                                        <input id="filled-in-box4" class="filled-in" checked="" type="checkbox" />
                                                        <label for="filled-in-box4">Formal - Wedding </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="min-sublist">
                                    <div class="type-maib-su">
                                        <div class="type-right-su">
                                            <div class="row">
                                            <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="check-box inline-checkboxs">
                                                        <input id="filled-in-box5" class="filled-in" checked="" type="checkbox" />
                                                        <label for="filled-in-box5">Formal - Work Wear </label>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="check-box inline-checkboxs">
                                                        <input id="filled-in-box6" class="filled-in" checked="" type="checkbox" />
                                                        <label for="filled-in-box6">Fun </label>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="check-box inline-checkboxs">
                                                        <input id="filled-in-box7" class="filled-in" checked="" type="checkbox" />
                                                        <label for="filled-in-box7">Destination</label>
                                                    </div>
                                                </div>
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="check-box inline-checkboxs">
                                                        <input id="filled-in-box8" class="filled-in" checked="" type="checkbox" />
                                                        <label for="filled-in-box8">Religious</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                                
                    </li>
                </ul>
            </li>
              <!-- Occasion End-->
              
              
               <!-- Occasion Start-->
            <li class="mega-menu sub-menu"><a href="javascript:void(0)">Collection <span class="arrows-list"></span></a>
                <ul class="su-menu">
                    <li>
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-right-su">
                                    <div class="row">
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-boxc" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-boxc">Versace</label>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-boxd" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-boxd">Armaani</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
              <!-- Occasion End-->
              
              
            <!-- Look Start-->
            <li class="mega-menu sub-menu"><a href="javascript:void(0)">Look <span class="arrows-list"></span></a>
                <ul class="su-menu">
                    <li>
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-right-su">
                                    <div class="row">
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-boxa" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-boxa">Traditional</label>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-boxb" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-boxb">Contemporary</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Look End-->
             
             <!-- Price Start-->
            <li class="mega-menu sub-menu"><a href="javascript:void(0)">Price <span class="arrows-list"></span></a>
                <ul class="su-menu">
                    <li>
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-right-su">
                                    <div class="row">
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-box-a" class="filled-in" checked="checked" type="checkbox" />
                                                <label for="filled-in-box-a">Rs. 25,000</label>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-box-a2" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-box-a2">Rs. 1,25,000</label>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-box-a3" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-box-a3">Rs. 4,25,000</label>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-box-a4" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-box-a4">Rs. 50,000</label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-right-su">
                                    <div class="row">
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-box-a5" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-box-a5">Rs. 85,000</label>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-box-a6" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-box-a6">Rs. 3,25,120</label>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-box-a7" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-box-a7">Rs. 15,000</label>
                                            </div>
                                        </div>
                                        <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="check-box inline-checkboxs">
                                                <input id="filled-in-box-a8" class="filled-in" checked="" type="checkbox" />
                                                <label for="filled-in-box-a8">Rs. 1,25,000</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Price End-->
             
              <!-- Additional Filter Start-->
            <li class="additional-filter"><a href="javascript:void(0)">Additional Filter</a>
               
            </li>
            <!-- Additional Filter End-->
              
              <li class="fzcleafilter"><a href="javascript:void(0)">Clear Filters</a></li>
                
                  
             
        </ul>
        </div>
    </div>
    </div>
    <div class="col-md-12">
    <div class="list-margin-bottm">
    <div class="more-popular-most">
        <span>100</span> Results for Most Popular
    </div>
    <div class="sortbye-txt">
        <div class="sorting-block">
            <span>Sort By </span>
            <div class="select-style select2">
                <select class="frm-select">
                    <option>Most Popular</option>
                    <option>Most Popular</option>
                    <option>Most Popular</option>
                    <option>Most Popular</option>
                </select>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>
    </div>
    </div>
    <div class="list-box-sectionstart">
       <div class="container-fluid">
        <div class="">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-one">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image.png" alt="" />
                        <img class="listmain-box-img-hover" src="images/listing-page-image2.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Promise Solitire Ring</div>
                        <div class="list-price-box">$ 250.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-two">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image2.png" alt="" />
                        <img class="listmain-box-img-hover" src="images/listing-page-image3.png" alt="" />
                        
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Silver Dimond Halo Ring</div>
                        <div class="list-price-box">$ 350.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-three">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image3.png" alt="" />
                        <img class="listmain-box-img-hover" src="images/listing-page-image4.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Brown Dimond Ring</div>
                        <div class="list-price-box">$ 450.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-four">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image4.png" alt="" />
                        <img class="listmain-box-img-hover" src="images/listing-page-image5.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Promise Solitire Ring</div>
                        <div class="list-price-box">$ 250.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-four">
                    <div class="listmain-box-img">
                         <img class="listmain-box-img-defualt" src="images/listing-page-image5.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image6.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Promise Solitire Ring</div>
                        <div class="list-price-box">$ 250.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-three">
                    <div class="listmain-box-img">
                         <img class="listmain-box-img-defualt" src="images/listing-page-image6.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image7.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Brown Dimond Ring</div>
                        <div class="list-price-box">$ 450.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
           <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-two">
                    <div class="listmain-box-img">
                          <img class="listmain-box-img-defualt" src="images/listing-page-image7.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image8.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Silver Dimond Halo Ring</div>
                        <div class="list-price-box">$ 350.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-one">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image8.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image9.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Promise Solitire Ring</div>
                        <div class="list-price-box">$ 250.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-one">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image9.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image10.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Promise Solitire Ring</div>
                        <div class="list-price-box">$ 250.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-two">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image10.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image11.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Silver Dimond Halo Ring</div>
                        <div class="list-price-box">$ 350.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-three">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image11.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image12.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Brown Dimond Ring</div>
                        <div class="list-price-box">$ 450.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-four">
                    <div class="listmain-box-img">
                         <img class="listmain-box-img-defualt" src="images/listing-page-image13.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image14.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Promise Solitire Ring</div>
                        <div class="list-price-box">$ 250.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-four">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image14.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image15.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Promise Solitire Ring</div>
                        <div class="list-price-box">$ 250.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-three">
                    <div class="listmain-box-img">
                       <img class="listmain-box-img-defualt" src="images/listing-page-image15.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image16.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Brown Dimond Ring</div>
                        <div class="list-price-box">$ 450.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
           <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-two">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image16.png" alt="" />
                         <img class="listmain-box-img-hover" src="images/listing-page-image17.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Silver Dimond Halo Ring</div>
                        <div class="list-price-box">$ 350.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-one">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image17.png" alt="" />
                        <img class="listmain-box-img-hover" src="images/listing-page-image18.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Promise Solitire Ring</div>
                        <div class="list-price-box">$ 250.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-one">
                    <div class="listmain-box-img">
                        <img class="listmain-box-img-defualt" src="images/listing-page-image18.png" alt="" />
                        <img class="listmain-box-img-hover" src="images/listing-page-image19.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Promise Solitire Ring</div>
                        <div class="list-price-box">$ 250.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-two">
                    <div class="listmain-box-img">
                       
                       <img class="listmain-box-img-defualt" src="images/listing-page-image19.png" alt="" />
                        <img class="listmain-box-img-hover" src="images/listing-page-image20.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Silver Dimond Halo Ring</div>
                        <div class="list-price-box">$ 350.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-three">
                    <div class="listmain-box-img">
                         <img class="listmain-box-img-defualt" src="images/listing-page-image20.png" alt="" />
                        <img class="listmain-box-img-hover" src="images/listing-page-image2.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Brown Dimond Ring</div>
                        <div class="list-price-box">$ 450.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="listmain-box color-box-four">
                    <div class="listmain-box-img">
                       <img class="listmain-box-img-defualt" src="images/listing-page-image2.png" alt="" />
                        <img class="listmain-box-img-hover" src="images/listing-page-image3.png" alt="" />
                    </div>
                    <div class="listmain-box-content">
                       <div class="subhover-cnts">
                        <div class="list-title-box">Promise Solitire Ring</div>
                        <div class="list-price-box">$ 250.00</div>
                        </div>
                        <div class="list-icons-box">
                            <a href="" class="cirlce-llist cart-list"></a>
                            <a href="" class="cirlce-llist heart-list"></a>
                            <a href="" class="cirlce-llist compare-list"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>
    
 <div class="paginations">
     <ul>
         <li class="previous-class"><a href="javascript:void(0)"><i class="fa fa-angle-left"></i> Previous</a></li>
         <li><a href="javascript:void(0)">1</a></li>
         <li><a href="javascript:void(0)" class="active">2</a></li>
         <li><a href="javascript:void(0)">3</a></li>
         <li><a href="javascript:void(0)">4</a></li>
         <li><a href="javascript:void(0)">5</a></li>
         <li class="next-class"><a href="javascript:void(0)">Next <i class="fa fa-angle-right"></i></a></li>
     </ul>
 </div>
    

</div>

<div class="clearfix"></div>

@endsection
