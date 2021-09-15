<?php
/**
 * Template Name: Home
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <main class="page-content">
        <section class="first-screen-section">
            <div class="container">
                <h1 class="page-caption"><strong>Free</strong> statistics for all.</h1>

                <div class="section-text">
                    <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                </div>

                <div class="component-search-with-autocomplete">
                    <div class="cmp-field">
                        <svg class="field-icon">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#search"></use>
                        </svg>
                        <input type="text" placeholder="Example: Samsung Galaxy S21">
                    </div>
                    <div class="cmp-suggestions">
                        <ul>
                            <li>
                                <a href="#">
										<span class="item-image">
											<img src="" alt="">
										</span>
                                    <span class="item-text">TP-Link AC1750 Smart WiFi Router (Archer A7) Statistics</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
										<span class="item-image">
											<img src="" alt="">
										</span>
                                    <span class="item-text">TP-Link AC1750 Smart WiFi Router (Archer A7) Statistics</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
										<span class="item-image">
											<img src="" alt="">
										</span>
                                    <span class="item-text">TP-Link AC1750 Smart WiFi Router (Archer A7) Statistics</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="section-stats">
                    <div class="item">
                        <svg class="item-icon">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#grid"></use>
                        </svg>
                        <div class="item-text"><strong>25+</strong> Categories</div>
                    </div>
                    <div class="item">
                        <svg class="item-icon">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#article"></use>
                        </svg>
                        <div class="item-text"><strong>238,121</strong> Products</div>
                    </div>
                    <div class="item">
                        <svg class="item-icon">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#person"></use>
                        </svg>
                        <div class="item-text"><strong>18,213,123</strong> Reviews</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="clients-section">
            <div class="container">
                <h2 class="small-caption">Hundreds of leading companies use SentiMate</h2>

                <div class="clients-slider">
                    <div class="slider-inner">
                        <div class="slide">
                            <div class="client-logo">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/clients/Rexroth-1.png" alt="">
                            </div>
                        </div>
                        <div class="slide">
                            <div class="client-logo">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/clients/martinrea_logo-1.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="slider-inner">
                        <div class="slide">
                            <div class="client-logo">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/clients/Rexroth-1.png" alt="">
                            </div>
                        </div>
                        <div class="slide">
                            <div class="client-logo">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/clients/martinrea_logo-1.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="dashboard-preview-section">
            <div class="container">
                <div class="section-caption">
                    <h2 class="sc-title">Product Dashboard</h2>
                </div>

                <div class="tabs-nav-wrapper">
                    <div class="tabs-nav">
                        <button class="tab-btn" data-tab="#tab-overview">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#chart"></use>
                            </svg>
                            <span class="btn-text">Overview</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-landscape">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#list"></use>
                            </svg>
                            <span class="btn-text">Competitive Landscape</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-discussions">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#heart"></use>
                            </svg>
                            <span class="btn-text">Discussions</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-rating">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#star"></use>
                            </svg>
                            <span class="btn-text">Star Rating</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-coverage">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#coverage"></use>
                            </svg>
                            <span class="btn-text">Coverage</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-comparison">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#comparsion"></use>
                            </svg>
                            <span class="btn-text">Comparison</span>
                        </button>
                    </div>
                </div>

                <div class="tabs-container">
                    <div class="tab" id="tab-overview">
                        <!-- Тут будут видео вместо картинок -->
                        <img src="" alt="">
                    </div>
                    <div class="tab" id="tab-landscape">
                        <img src="" alt="">
                    </div>
                    <div class="tab" id="tab-discussions">
                        <img src="" alt="">
                    </div>
                    <div class="tab" id="tab-rating">
                        <img src="" alt="">
                    </div>
                    <div class="tab" id="tab-coverage">
                        <img src="" alt="">
                    </div>
                    <div class="tab" id="tab-comparison">
                        <img src="" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="big-stats-section">
            <div class="container">
                <div class="stats-grid">
                    <div class="stats-card">
                        <h3 class="card-caption"><strong>25+</strong> Categories</h3>

                        <div class="card-text">
                            <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                        </div>

                        <ul class="card-tags">
                            <li>CPG</li>
                            <li>Fashion</li>
                            <li>Sport</li>
                            <li>Personal Care</li>

                            <li class="pale">and much more</li>
                        </ul>
                    </div>

                    <div class="stats-card">
                        <h3 class="card-caption"><strong>238K+</strong> Products</h3>

                        <div class="card-text">
                            <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                        </div>

                        <ul class="card-tags">
                            <li>Headphones</li>
                            <li>Laptops</li>
                            <li>Mobile Phones</li>

                            <li class="pale">and much more</li>
                        </ul>
                    </div>

                    <div class="stats-card">
                        <h3 class="card-caption"><strong>18M+</strong> Reviews</h3>

                        <div class="card-text">
                            <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                        </div>

                        <ul class="card-tags">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>

                <div class="section-footer">
                    <a href="#" class="btn">Start for free</a>
                </div>
            </div>
        </section>

        <section class="use-cases-section">
            <div class="container">
                <div class="section-caption">
                    <h2 class="sc-title">Use Cases</h2>
                    <p class="sc-subtitle">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                </div>

                <div class="tabs-nav-wrapper">
                    <div class="tabs-nav">
                        <button class="tab-btn" data-tab="#tab-marketing">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#chart"></use>
                            </svg>
                            <span class="btn-text">Marketing</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-product-marketing">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#target"></use>
                            </svg>
                            <span class="btn-text">Product Marketing</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-product-development">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#gear"></use>
                            </svg>
                            <span class="btn-text">Product Development</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-innovation-management">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#bulb"></use>
                            </svg>
                            <span class="btn-text">Innovation Management</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-brand-marketing">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#megaphone"></use>
                            </svg>
                            <span class="btn-text">Brand Marketing</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-market-intelligence">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#magnifier"></use>
                            </svg>
                            <span class="btn-text">Market Intelligence</span>
                        </button>

                        <button class="tab-btn" data-tab="#tab-ecommerce">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#bag"></use>
                            </svg>
                            <span class="btn-text">eCommerce</span>
                        </button>
                    </div>
                </div>

                <div class="tabs-container">
                    <div class="tab" id="tab-marketing">
                        <div class="use-case-tab-card">
                            <div class="card-content">
                                <h3 class="card-caption">Be First In Your Industry</h3>
                                <div class="card-text">
                                    <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn-with-arrow">
                                        <span class="btn-text">Start for free</span>
                                    </a>
                                </div>
                            </div>
                            <picture class="card-image">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-1-mobile.jpg" media="(max-width: 767px)" />
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-1.jpg" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="tab" id="tab-product-marketing">
                        <div class="use-case-tab-card">
                            <div class="card-content">
                                <h3 class="card-caption">Boost Your Customer Satisfaction</h3>
                                <div class="card-text">
                                    <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn-with-arrow">
                                        <span class="btn-text">Start for free</span>
                                    </a>
                                </div>
                            </div>
                            <picture class="card-image">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-2-mobile.jpg" media="(max-width: 767px)" />
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-2.jpg" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="tab" id="tab-product-development">
                        <div class="use-case-tab-card">
                            <div class="card-content">
                                <h3 class="card-caption">Made Perfect Product For Your Clients</h3>
                                <div class="card-text">
                                    <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn-with-arrow">
                                        <span class="btn-text">Start for free</span>
                                    </a>
                                </div>
                            </div>
                            <picture class="card-image">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-3-mobile.jpg" media="(max-width: 767px)" />
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-3.jpg" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="tab" id="tab-innovation-management">
                        <div class="use-case-tab-card">
                            <div class="card-content">
                                <h3 class="card-caption">Build a Strong Brand Marketing Strategy</h3>
                                <div class="card-text">
                                    <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn-with-arrow">
                                        <span class="btn-text">Start for free</span>
                                    </a>
                                </div>
                            </div>
                            <picture class="card-image">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-4-mobile.jpg" media="(max-width: 767px)" />
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-4.jpg" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="tab" id="tab-brand-marketing">
                        <div class="use-case-tab-card">
                            <div class="card-content">
                                <h3 class="card-caption">Innovate Like Never Before</h3>
                                <div class="card-text">
                                    <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn-with-arrow">
                                        <span class="btn-text">Start for free</span>
                                    </a>
                                </div>
                            </div>
                            <picture class="card-image">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-5-mobile.jpg" media="(max-width: 767px)" />
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-5.jpg" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="tab" id="tab-market-intelligence">
                        <div class="use-case-tab-card">
                            <div class="card-content">
                                <h3 class="card-caption">Analyze Your Competitors Data</h3>
                                <div class="card-text">
                                    <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn-with-arrow">
                                        <span class="btn-text">Start for free</span>
                                    </a>
                                </div>
                            </div>
                            <picture class="card-image">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-6-mobile.jpg" media="(max-width: 767px)" />
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-6.jpg" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="tab" id="tab-ecommerce">
                        <div class="use-case-tab-card">
                            <div class="card-content">
                                <h3 class="card-caption">Take Your Sales to The Next Level</h3>
                                <div class="card-text">
                                    <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn-with-arrow">
                                        <span class="btn-text">Start for free</span>
                                    </a>
                                </div>
                            </div>
                            <picture class="card-image">
                                <source srcset="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-7-mobile.jpg" media="(max-width: 767px)" />
                                <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/use-cases/use-cases-7.jpg" alt="">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonials-section">
            <div class="container">
                <div class="testimonials-slider">
                    <div class="slide">
                        <div class="testimonial-card">
                            <div class="card-text">
                                <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                            </div>

                            <div class="card-author-block">
                                <div class="block-avatar">
                                    <img src="" alt="">
                                </div>
                                <div class="block-content">
                                    <h4 class="block-name">Albert Flores</h4>
                                    <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial-card">
                            <div class="card-text">
                                <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                            </div>

                            <div class="card-author-block">
                                <div class="block-avatar">
                                    <img src="" alt="">
                                </div>
                                <div class="block-content">
                                    <h4 class="block-name">Albert Flores</h4>
                                    <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="get-access-section">
            <div class="container">
                <div class="get-access-block">
                    <div class="section-caption">
                        <h2 class="sc-title">Get Access to Statistics of <strong>238K+</strong> Products</h2>
                        <p class="sc-subtitle">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                    </div>

                    <div class="block-footer">
                        <a href="#" class="btn">START FOR FREE</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>