<?php
/**
 * Template Name: Contact
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <main class="page-content">
        <section class="feedback">
            <img src="<?php echo get_field('image')['url']?>" alt="<?php echo get_field('image')['alt']?>">
            <div class="container">
                <div class="feedback__body">
                    <div></div>
                    <div class="feedback__form">
                        <h1 class="page-caption"><?php echo get_field('title');?></h1>

                        <div class="section-text">
                            <p><?php echo get_field('text');?>
                            </p>
                        </div>
                        <!--[if lte IE 8]>
                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
                        <![endif]-->
                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                        <script>
                            hbspt.forms.create({
                                region: "na1",
                                portalId: "5244251",
                                formId: "4661a89b-7422-4d18-bb2b-a53ea14b8ade"
                            });
                        </script>
                    </div>

                </div>
            </div>
        </section>
        <section class="location">
            <div class="container">
                <div class="location__body">
                    <div class="location__content">
                        <h3 class="content__caption">
                            <?php echo get_field('title_contact');?>
                        </h3>
                        <div class="content__row">
                            <div class="row__caption">
                                <?php echo get_field('address_title');?>
                            </div>
                            <p class="row__text">
                                <?php echo get_field('address');?>
                            </p>
                        </div>
                        <div class="content__row">
                            <div class="row__caption">
                                <?php echo get_field('phones_title');?>
                            </div>
                            <?php if( have_rows('phones') ): ?>
                                <?php
                                $i=0;
                                while( have_rows('phones') ): the_row(); ?>
                                    <a href="tel:<?php echo get_sub_field('phone');?>"><?php echo get_sub_field('phone');?> <span><?php echo get_sub_field('location');?></span></a>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <div class="content__row">
                            <div class="row__caption">
                                <?php echo get_field('email_title');?>
                            </div>
                            <?php if( have_rows('emails') ): ?>
                                <?php
                                $i=0;
                                while( have_rows('emails') ): the_row(); ?>
                                    <a href="mailto:<?php echo get_sub_field('email');?>"><?php echo get_sub_field('email');?> <span><?php echo get_sub_field('location');?></span></a>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="location__map">
                        <?php echo get_field('map');?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>