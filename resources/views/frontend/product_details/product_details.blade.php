@extends('frontend.layouts.master')

@section('section')
<div id="page-content">
    <!--MainContent-->
    <div id="MainContent" class="main-content" role="main">
        <!--Breadcrumb-->
        <div class="bredcrumbWrap">
            <div class="container breadcrumbs">
                <a href="index.html" title="Back to the home page">Home</a><span aria-hidden="true">›</span><span>Short Description</span>
            </div>
        </div>
        <!--End Breadcrumb-->

        <div id="ProductSection-product-template" class="product-template__container prstyle1 container">
            <!--product-single-->
            <div class="product-single">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-details-img">
                            <div class="product-thumb">
                                <div id="gallery" class="product-dec-slider-2 product-tab-left">
                                    <a data-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-1.jpg" data-zoom-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-1.jpg" class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1">
                                        <img class="blur-up lazyload" src="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-1.jpg" alt="" />
                                    </a>
                                    <a data-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-2.jpg" data-zoom-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-2.jpg" class="slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" tabindex="-1">
                                        <img class="blur-up lazyload" src="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-2.jpg" alt="" />
                                    </a>
                                    <a data-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-3.jpg" data-zoom-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-3.jpg" class="slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1">
                                        <img class="blur-up lazyload" src="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-3.jpg" alt="" />
                                    </a>
                                    <a data-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-4.jpg" data-zoom-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-4.jpg" class="slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1">
                                        <img class="blur-up lazyload" src="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-4.jpg" alt="" />
                                    </a>
                                    <a data-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-5.jpg" data-zoom-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-5.jpg" class="slick-slide slick-cloned" data-slick-index="0" aria-hidden="true" tabindex="-1">
                                        <img class="blur-up lazyload" src="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-5.jpg" alt="" />
                                    </a>
                                    <a data-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-6.jpg" data-zoom-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-6.jpg" class="slick-slide slick-cloned" data-slick-index="1" aria-hidden="true" tabindex="-1">
                                        <img class="blur-up lazyload" src="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-6.jpg" alt="" />
                                    </a>
                                    <a data-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-7.jpg" data-zoom-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-7.jpg" class="slick-slide slick-cloned" data-slick-index="2" aria-hidden="true" tabindex="-1">
                                        <img class="blur-up lazyload" src="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-7.jpg" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div class="zoompro-wrap product-zoom-right pl-20">
                                <div class="zoompro-span">
                                    <img class="zoompro blur-up lazyload" data-zoom-image="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-1.jpg" alt="" src="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-1.jpg" />
                                </div>
                                <div class="product-labels"><span class="lbl on-sale">Sale</span><span class="lbl pr-label1">new</span></div>
                                <div class="product-buttons">
                                    <a href="https://www.youtube.com/watch?v=93A2jOW5Mog" class="btn popup-video" title="View Video"><i class="icon anm anm-play-r" aria-hidden="true"></i></a>
                                    <a href="#" class="btn prlightbox" title="Zoom"><i class="icon anm anm-expand-l-arrows" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="lightboximages">
                                <a href="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-1.jpg" data-size="1462x2048"></a>
                                <a href="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-2.jpg" data-size="1462x2048"></a>
                                <a href="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-3.jpg" data-size="1462x2048"></a>
                                <a href="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-4.jpg" data-size="1462x2048"></a>
                                <a href="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-5.jpg" data-size="1462x2048"></a>
                                <a href="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-6.jpg" data-size="1462x2048"></a>
                                <a href="{{ asset('frontend') }}/assets/images/product-detail-page/cape-dress-7.jpg" data-size="731x1024"></a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="product-single__meta">
                                <h1 class="product-single__title">Short Description</h1>
                                <div class="product-nav clearfix">
                                    <a href="#" class="next" title="Next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                </div>
                                <div class="prInfoRow">
                                    <div class="product-stock"> <span class="instock ">In Stock</span> <span class="outstock hide">Unavailable</span> </div>
                                    <div class="product-sku">SKU: <span class="variant-sku">19115-rdxs</span></div>
                                    <div class="product-review"><a class="reviewLink" href="#tab2"><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><span class="spr-badge-caption">6 reviews</span></a></div>
                                </div>
                                <p class="product-single__price product-single__price-product-template">
                                    <span class="visually-hidden">Regular price</span>
                                    <s id="ComparePrice-product-template"><span class="money">$600.00</span></s>
                                    <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                        <span id="ProductPrice-product-template"><span class="money">$500.00</span></span>
                                    </span>
                                    <span class="discount-badge"> <span class="devider">|</span>&nbsp;
                                        <span>You Save</span>
                                        <span id="SaveAmount-product-template" class="product-single__save-amount">
                                        <span class="money">$100.00</span>
                                        </span>
                                        <span class="off">(<span>16</span>%)</span>
                                    </span>
                                </p>
                                <div class="orderMsg" data-user="23" data-time="24">
                                    <img src="{{ asset('frontend') }}/assets/images/order-icon.jpg" alt="" /> <strong class="items">5</strong> sold in last <strong class="time">26</strong> hours</div>
                                </div>
                            <div class="product-single__description rte">
                                <ul>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                                    <li>Sed ut perspiciatis unde omnis iste natus error sit</li>
                                    <li>Neque porro quisquam est qui dolorem ipsum quia dolor</li>
                                    <li>Lorem Ipsum is not simply random text.</li>
                                </ul>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                            <form method="post" action="http://annimexweb.com/cart/add" id="product_form_10508262282" accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                                <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                    <div class="product-form__item">
                                      <label class="header">Color: <span class="slVariant">Red</span></label>
                                      <div data-value="Black" class="swatch-element color black available">
                                        <input class="swatchInput" id="swatch-0-black" type="radio" name="option-0" value="Black"><label class="swatchLbl color small" for="swatch-0-black" style="background-color:black;" title="Black"></label>
                                      </div>
                                      <div data-value="Maroon" class="swatch-element color maroon available">
                                        <input class="swatchInput" id="swatch-0-maroon" type="radio" name="option-0" value="Maroon"><label class="swatchLbl color small" for="swatch-0-maroon" style="background-color:maroon;" title="Maroon"></label>
                                      </div>
                                      <div data-value="Blue" class="swatch-element color blue available">
                                        <input class="swatchInput" id="swatch-0-blue" type="radio" name="option-0" value="Blue"><label class="swatchLbl color small" for="swatch-0-blue" style="background-color:blue;" title="Blue"></label>
                                      </div>
                                      <div data-value="Dark Green" class="swatch-element color dark-green available">
                                        <input class="swatchInput" id="swatch-0-dark-green" type="radio" name="option-0" value="Dark Green"><label class="swatchLbl color small" for="swatch-0-dark-green" style="background-color:darkgreen;" title="Dark Green"></label>
                                      </div>
                                    </div>
                                </div>
                                <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                    <div class="product-form__item">
                                      <label class="header">Size: <span class="slVariant">XS</span></label>
                                      <div data-value="XS" class="swatch-element xs available">
                                        <input class="swatchInput" id="swatch-1-xs" type="radio" name="option-1" value="XS">
                                        <label class="swatchLbl medium rectangle" for="swatch-1-xs" title="XS">XS</label>
                                      </div>
                                      <div data-value="S" class="swatch-element s available">
                                        <input class="swatchInput" id="swatch-1-s" type="radio" name="option-1" value="S">
                                        <label class="swatchLbl medium rectangle" for="swatch-1-s" title="S">S</label>
                                      </div>
                                      <div data-value="M" class="swatch-element m available">
                                        <input class="swatchInput" id="swatch-1-m" type="radio" name="option-1" value="M">
                                        <label class="swatchLbl medium rectangle" for="swatch-1-m" title="M">M</label>
                                      </div>
                                      <div data-value="L" class="swatch-element l available">
                                        <input class="swatchInput" id="swatch-1-l" type="radio" name="option-1" value="L">
                                        <label class="swatchLbl medium rectangle" for="swatch-1-l" title="L">L</label>
                                      </div>
                                    </div>
                                </div>
    
                                <!-- Product Action -->
                                <div class="product-action clearfix">
                                    <div class="product-form__item--quantity">
                                        <div class="wrapQtyBtn">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                <input type="text" id="Quantity" name="quantity" value="1" class="product-form__input qty">
                                                <a class="qtyBtn plus" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-form__item--submit">
                                        <button type="button" name="add" class="btn product-form__cart-submit">
                                            <span>Add to cart</span>
                                        </button>
                                    </div>
                                    <div class="shopify-payment-button" data-shopify="payment-button">
                                        <button type="button" class="shopify-payment-button__button shopify-payment-button__button--unbranded">Buy it now</button>
                                    </div>
                                </div>
                                <!-- End Product Action -->
                            </form>
                            <div class="display-table shareRow">
                                    <div class="display-table-cell medium-up--one-third">
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist"><i class="icon anm anm-heart-l" aria-hidden="true"></i> <span>Add to Wishlist</span></a>
                                        </div>
                                    </div>
                                    <div class="display-table-cell text-right">
                                        <div class="social-sharing">
                                            <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-facebook" title="Share on Facebook">
                                                <i class="fa fa-facebook-square" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Share</span>
                                            </a>
                                            <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-twitter" title="Tweet on Twitter">
                                                <i class="fa fa-twitter" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Tweet</span>
                                            </a>
                                            <a href="#" title="Share on google+" class="btn btn--small btn--secondary btn--share" >
                                                <i class="fa fa-google-plus" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Google+</span>
                                            </a>
                                            <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-pinterest" title="Pin on Pinterest">
                                                <i class="fa fa-pinterest" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Pin it</span>
                                            </a>
                                            <a href="#" class="btn btn--small btn--secondary btn--share share-pinterest" title="Share by Email" target="_blank">
                                                <i class="fa fa-envelope" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Email</span>
                                            </a>
                                         </div>
                                    </div>
                                </div>

                            <p id="freeShipMsg" class="freeShipMsg" data-price="199"><i class="fa fa-truck" aria-hidden="true"></i> GETTING CLOSER! ONLY <b class="freeShip"><span class="money" data-currency-usd="$199.00" data-currency="USD">$199.00</span></b> AWAY FROM <b>FREE SHIPPING!</b></p>
                            <p class="shippingMsg"><i class="fa fa-clock-o" aria-hidden="true"></i> ESTIMATED DELIVERY BETWEEN <b id="fromDate">Wed. May 1</b> and <b id="toDate">Tue. May 7</b>.</p>
                            <div class="userViewMsg" data-user="20" data-time="11000"><i class="fa fa-users" aria-hidden="true"></i> <strong class="uersView">14</strong> PEOPLE ARE LOOKING FOR THIS PRODUCT</div>
                        </div>
                </div>
            </div>
            <!--End-product-single-->
            <!--Product Fearure-->
            <div class="prFeatures">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                        <img src="{{ asset('frontend') }}/assets/images/credit-card.png" alt="Safe Payment" title="Safe Payment" />
                        <div class="details"><h3>Safe Payment</h3>Pay with the world's most payment methods.</div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                        <img src="{{ asset('frontend') }}/assets/images/shield.png" alt="Confidence" title="Confidence" />
                        <div class="details"><h3>Confidence</h3>Protection covers your purchase and personal data.</div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                        <img src="{{ asset('frontend') }}/assets/images/worldwide.png" alt="Worldwide Delivery" title="Worldwide Delivery" />
                        <div class="details"><h3>Worldwide Delivery</h3>FREE &amp; fast shipping to over 200+ countries &amp; regions.</div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                        <img src="{{ asset('frontend') }}/assets/images/phone-call.png" alt="Hotline" title="Hotline" />
                        <div class="details"><h3>Hotline</h3>Talk to help line for your question on 4141 456 789, 4125 666 888</div>
                    </div>
                </div>
            </div>
            <!--End Product Fearure-->


            <!--Related Product Slider-->
            <div class="related-product grid-products">
                <header class="section-header">
                    <h2 class="section-header__title text-center h2"><span>Related Products</span></h2>
                    <p class="sub-heading">You can stop autoplay, increase/decrease aniamtion speed and number of grid to show and products from store admin.</p>
                </header>
                <div class="productPageSlider">
                    <div class="col-12 item">
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="#">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image1.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image1.jpg" alt="image" title="product">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image1-1.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image1-1.jpg" alt="image" title="product">
                                <!-- End hover image -->
                                <!-- product label -->
                                <div class="product-labels rectangular"><span class="lbl on-sale">-16%</span> <span class="lbl pr-label1">new</span></div>
                                <!-- End product label -->
                            </a>
                            <!-- end product image -->

                            <!-- Start product button -->
                            <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                            </form>
                            <div class="button-set">
                                <a href="#" title="Quick View" class="quick-view" tabindex="0">
                                    <i class="icon anm anm-search-plus-r"></i>
                                </a>
                                <div class="wishlist-btn">
                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                        <i class="icon anm anm-heart-l"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- end product button -->
                        </div>
                        <!-- end product image -->
                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="#">Edna Dress</a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                <span class="old-price">$500.00</span>
                                <span class="price">$600.00</span>
                            </div>
                            <!-- End product price -->

                            <div class="product-review">
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star-o"></i>
                                <i class="font-13 fa fa-star-o"></i>
                            </div>
                            <!-- Variant -->
                            <ul class="swatches">
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant1.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant2.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant3.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant4.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant5.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant6.jpg" alt="image" /></li>
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!-- End product details -->
                    </div>
                    <div class="col-12 item">
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="#">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image2.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image2.jpg" alt="image" title="product">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image2-1.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image2-1.jpg" alt="image" title="product">
                                <!-- End hover image -->
                            </a>
                            <!-- end product image -->

                            <!-- Start product button -->
                            <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                            </form>
                            <div class="button-set">
                                <a href="#" title="Quick View" class="quick-view" tabindex="0">
                                    <i class="icon anm anm-search-plus-r"></i>
                                </a>
                                <div class="wishlist-btn">
                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                        <i class="icon anm anm-heart-l"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- end product button -->
                        </div>
                        <!-- end product image -->

                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="#">Elastic Waist Dress</a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                <span class="price">$748.00</span>
                            </div>
                            <!-- End product price -->
                            <div class="product-review">
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                            </div>
                            <!-- Variant -->
                            <ul class="swatches">
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant2-1.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant2-2.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant2-3.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant2-4.jpg" alt="image" /></li>
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!-- End product details -->
                    </div>
                    <div class="col-12 item">
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="#">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image3.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image3.jpg" alt="image" title="product">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image3-1.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image3-1.jpg" alt="image" title="product">
                                <!-- End hover image -->
                                <!-- product label -->
                                <div class="product-labels rectangular"><span class="lbl pr-label2">Hot</span></div>
                                <!-- End product label -->
                            </a>
                            <!-- end product image -->

                            <!-- Start product button -->
                            <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                            </form>
                            <div class="button-set">
                                <a href="#" title="Quick View" class="quick-view" tabindex="0">
                                    <i class="icon anm anm-search-plus-r"></i>
                                </a>
                                <div class="wishlist-btn">
                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                        <i class="icon anm anm-heart-l"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- end product button -->
                        </div>
                        <!-- end product image -->

                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="#">3/4 Sleeve Kimono Dress</a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                <span class="price">$550.00</span>
                            </div>
                            <!-- End product price -->

                            <div class="product-review">
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star-o"></i>
                            </div>
                            <!-- Variant -->
                            <ul class="swatches">
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant3-1.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant3-2.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant3-3.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant3-4.jpg" alt="image" /></li>
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!-- End product details -->
                    </div>
                    <div class="col-12 item">
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="#">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image4.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image4.jpg" alt="image" title="product" />
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image4-1.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image4-1.jpg" alt="image" title="product" />
                                <!-- End hover image -->
                                <!-- product label -->
                                <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                <!-- End product label -->
                            </a>
                            <!-- end product image -->

                            <!-- Start product button -->
                            <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                            </form>
                            <div class="button-set">
                                <a href="#" title="Quick View" class="quick-view" tabindex="0">
                                    <i class="icon anm anm-search-plus-r"></i>
                                </a>
                                <div class="wishlist-btn">
                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                        <i class="icon anm anm-heart-l"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- end product button -->
                        </div>
                        <!-- end product image -->

                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="#">Cape Dress</a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                <span class="old-price">$900.00</span>
                                <span class="price">$788.00</span>
                            </div>
                            <!-- End product price -->

                            <div class="product-review">
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star-o"></i>
                                <i class="font-13 fa fa-star-o"></i>
                            </div>
                            <!-- Variant -->
                            <ul class="swatches">
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant4-1.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant4-2.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant4-3.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant4-4.jpg" alt="image" /></li>
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!-- End product details -->
                    </div>
                    <div class="col-12 item">
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="#">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image5.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image5.jpg" alt="image" title="product" />
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image5-1.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image5-1.jpg" alt="image" title="product" />
                                <!-- End hover image -->
                                <!-- product label -->
                                <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                <!-- End product label -->
                            </a>
                            <!-- end product image -->

                            <!-- Start product button -->
                            <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                            </form>
                            <div class="button-set">
                                <a href="#" title="Quick View" class="quick-view" tabindex="0">
                                    <i class="icon anm anm-search-plus-r"></i>
                                </a>
                                <div class="wishlist-btn">
                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                        <i class="icon anm anm-heart-l"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- end product button -->
                        </div>
                        <!-- end product image -->

                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="#">Paper Dress</a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                <span class="price">$550.00</span>
                            </div>
                            <!-- End product price -->

                            <div class="product-review">
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                                <i class="font-13 fa fa-star"></i>
                            </div>
                            <!-- Variant -->
                            <ul class="swatches">
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant3-1.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant3-2.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant3-3.jpg" alt="image" /></li>
                                <li class="swatch medium rounded"><img src="{{ asset('frontend') }}/assets/images/product-images/variant3-4.jpg" alt="image" /></li>
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!-- End product details -->
                    </div>
                    <div class="col-12 item">
                                        <!-- start product image -->
                                        <div class="product-image">
                                            <!-- start product image -->
                                            <a href="#">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image6.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image6.jpg" alt="image" title="product">
                                                <!-- End image -->
                                                <!-- Hover image -->
                                                <img class="hover blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image6-1.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image6-1.jpg" alt="image" title="product">
                                                <!-- End hover image -->
                                                <!-- product label -->
                                                <div class="product-labels rectangular"><span class="lbl on-sale">-16%</span> <span class="lbl pr-label1">new</span></div>
                                                <!-- End product label -->
                                            </a>
                                            <!-- end product image -->

                                            <!-- Start product button -->
                                            <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                                <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                                            </form>
                                            <div class="button-set">
                                                <a href="#" title="Quick View" class="quick-view" tabindex="0">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                                <div class="wishlist-btn">
                                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                        <i class="icon anm anm-heart-l"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- end product button -->
                                        </div>
                                        <!-- end product image -->

                                        <!--start product details -->
                                        <div class="product-details text-center">
                                            <!-- product name -->
                                            <div class="product-name">
                                                <a href="#">Zipper Jacket</a>
                                            </div>
                                            <!-- End product name -->
                                            <!-- product price -->
                                            <div class="product-price">
                                                <span class="price">$788.00</span>
                                            </div>
                                            <!-- End product price -->

                                            <div class="product-review">
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star-o"></i>
                                                <i class="font-13 fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <!-- End product details -->
                                    </div>
                    <div class="col-12 item">
                                        <!-- start product image -->
                                        <div class="product-image">
                                            <!-- start product image -->
                                            <a href="#">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image7.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image7.jpg" alt="image" title="product">
                                                <!-- End image -->
                                                <!-- Hover image -->
                                                <img class="hover blur-up lazyload" data-src="{{ asset('frontend') }}/assets/images/product-images/product-image7-1.jpg" src="{{ asset('frontend') }}/assets/images/product-images/product-image7-1.jpg" alt="image" title="product">
                                                <!-- End hover image -->
                                            </a>
                                            <!-- end product image -->

                                            <!-- Start product button -->
                                            <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                                <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                                            </form>
                                            <div class="button-set">
                                                <a href="#" title="Quick View" class="quick-view" tabindex="0">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                                <div class="wishlist-btn">
                                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                        <i class="icon anm anm-heart-l"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- end product button -->
                                        </div>
                                        <!-- end product image -->

                                        <!--start product details -->
                                        <div class="product-details text-center">
                                            <!-- product name -->
                                            <div class="product-name">
                                                <a href="#">Zipper Jacket</a>
                                            </div>
                                            <!-- End product name -->
                                            <!-- product price -->
                                            <div class="product-price">
                                                <span class="price">$748.00</span>
                                            </div>
                                            <!-- End product price -->
                                            <div class="product-review">
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star"></i>
                                            </div>
                                        </div>
                                        <!-- End product details -->
                                    </div>
                </div>
                </div>
            <!--End Related Product Slider-->

            </div>
        <!--#ProductSection-product-template-->
    </div>
    <!--MainContent-->
</div>
@endsection
