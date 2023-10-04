    <!-- Men-Clothing -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">LENTES</h3>
                <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#The-New-Arrivals">lo mas nuevo</a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#product-not-found">mas vendido</a>
                    </li>
                    -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#the-best-selling">mas vendidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-featured-products">modelos promocionales</a>
                    </li>
                </ul>
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <?php 
                         /*New Arrivals*/
                        include("The-New-Arrivals.php");
                        /* Product Not Found*/
                        //include("Product-Not-Found.php");
                        /* best selling */
                        include("the-best-selling.php");
                        ?>
                        <div class="tab-pane fade" id="men-featured-products">
                            <!-- Product Not Found -->
                            <div class="product-not-found">
                                <div class="not-found">
                                    <h2>SORRY!</h2>
                                    <h6>There is not any product in specific catalogue.</h6>
                                </div>
                            </div>
                            <!-- Product Not Found /- -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Men-Clothing-Timing-Section -->