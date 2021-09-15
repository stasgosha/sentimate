<?php $baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/'; ?>

<div class="navigation navigation__box">
	<a href="#overview" class="navigation__item">
		<div class="item__img"><img src="<?= $baseAssetUrl; ?>img/icons/nav10.svg" alt="navigation_icon"></div>
		<span>Overview</span>
	</a>
    <?php if (get_page_template_slug() == 'product_template.php') { ?>
	<a href="#competitive_landscape" class="navigation__item">
		<div class="item__img"><img src="<?= $baseAssetUrl; ?>img/icons/cil_list.svg" alt="navigation_icon"></div>
		<span>Market Rank</span>
	</a>
    <?php } ?>

	<a href="#product_satisfaction" class="navigation__item">
		<div class="item__img"><img src="<?= $baseAssetUrl; ?>img/icons/satisfaction.svg" alt="navigation_icon"></div>
		<span>Customer Satisfaction</span>
	</a>

	<!--<a href="#star_rating" class="navigation__item">-->
	<!--	<div class="item__img"><img src="<?= $baseAssetUrl; ?>img/icons/star.svg" alt="navigation_icon"></div>-->
	<!--	<span>Star Rating</span>-->
	<!--</a>-->


	<!--<a href="#engagement" class="navigation__item">-->
	<!--	<div class="item__img"><img src="<?= $baseAssetUrl; ?>img/icons/engagement.svg" alt="navigation_icon"></div>-->
	<!--	<span>Engagement</span>-->
	<!--</a>-->
</div>
