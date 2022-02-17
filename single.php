<?php
get_header(); ?>
<?php while ( have_posts() ) : the_post();
	$user_id = get_the_author_meta('ID');
	$user_ava = get_field('avatar', 'user_' . $user_id);
	$post_id = get_the_ID();
	$post_terms = wp_get_object_terms(get_the_ID(), 'category', ['fields' => 'all']);
	$main_cat = $post_terms && isset($post_terms['0']) ? $post_terms['0'] : '';
	$post_terms_ids = wp_get_object_terms(get_the_ID(), 'category', ['fields' => 'ids']);
	?>
	<main id="content" class="page-content single-post-page">
		<div class="container">
			<div class="breadcrumbs">
				<?php echo dimox_breadcrumbs(); ?>
			</div>
		</div>
		<article class="post-page-section">
			<div class="container">
				<div class="post-article-grid">
					<div class="post-content">
						<div class="post-top">
							<h1 class="post-caption"><?php the_title();?></h1>
							<div class="post__main-data">
								<div class="post__main-author">
									<?php if ($user_ava) : ?>
										<div class="user__img-wrap">
											<img src="<?= $user_ava['url']; ?>" alt="<?= $user_ava['alt']; ?>">
										</div>
									<?php endif; ?>
									<h4 class="author__basic-title author__position-title"><?= get_the_author_meta('display_name'); ?></h4>
								</div>
								<div class="post__card-data mb-0">
									<div class="post__sidebar-categories cat-items">
										<?php foreach ($post_terms as $category) : ?>
											<a class="tab-btn mb-0" href="<?= get_category_link($category); ?>">
												<svg class="btn-icon">
													<use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#<?php echo get_field('cat_icon', $category);?>"></use>
												</svg>
												<span class="btn-text"><?= $category->name; ?></span>
											</a>
										<?php endforeach; ?>
									</div>
									<div class="post__data-info">
										<p class="post__date-title">
											<?= get_the_date('M d, Y'); ?>
										</p>
										<p class="post__date-title reading-time">
											<?= estimated_reading_time(get_the_ID()); ?>
										</p>
									</div>
								</div>
							</div>
							<?php if (has_post_thumbnail()) : ?>
								<div class="post__img-wrap">
									<img src="<?= get_the_post_thumbnail_url(); ?>" alt="">
								</div>
							<?php endif; ?>
						</div>

						<div class="post-content-section">
							<div class="table-of-contents">
								<h3 class="table-of-contents__title">
									Table of contents
								</h3>
								<ul class="table-of-contents-list"></ul>
							</div>
							<div class="entry-content post-text-output entry-content-table">
								<?php the_content(); ?>
							</div>
							<div class="post-author-block">
								<p class="author__basic-title author__block-title upper-title">Author</p>
								<div class="author__block-body">
									<?php if ($user_ava) : ?>
										<div class="user__img-wrap">
											<img src="<?= $user_ava['url']; ?>" alt="<?= $user_ava['alt']; ?>">
										</div>
									<?php endif; ?>
									<div class="user__data-info">
										<h4 class="author__basic-title author__name-title"><?= get_the_author_meta('display_name'); ?></h4>
										<?php if ($position = get_field('position', 'user_'.$user_id)) : ?>
											<h5 class="author__basic-title author__position-title upper-title"><?php echo $position; ?></h5>
										<?php endif; ?>
										<p><?= get_the_author_meta('description');?></p>
									</div>
								</div>
							</div>
						</div>

						<div class="post__body-footer">
							<a class="more-link" href="<?= $main_cat? get_category_link($main_cat) : get_the_permalink('27989');?>">
								<span class="link-text">Back to all posts</span>
							</a>
							<div class="share__post-block">
								<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
									ADDTOANY_SHARE_SAVE_KIT( array(
										'buttons' => array( 'facebook', 'twitter', 'linkedin' ),
									) );
								} ?>
							</div>
						</div>

						<div class="sticky-table-of-contents-block" id="js-sticky-table-of-contents">
							<h3 class="block-caption">Table of contents</h3>
							<div class="block-field">
								<button class="block-opener"></button>
								<ul class="block-list"></ul>
							</div>
						</div>
					</div>
					<div class="sticky-sidebar">
						<div class="post-sidebar">
							<?php $samePosts = get_posts([
								'posts_per_page' => 3,
								'post_type' => 'post',
								'post_status' => 'any',
								'exclude' => $post_id,
								'tax_query' => [
									[
										'taxonomy' => 'category',
										'field' => 'term_id',
										'terms' => $post_terms_ids,
									],
								],
							]); if (!$samePosts) {
								$samePosts = get_posts([
									'posts_per_page' => 3,
									'post_type' => 'post',
									'post_status' => 'any',
									'exclude' => $post_id,
								]);
							}
							if ($samePosts) : ?>
								<div>
									<h4 class="post__sidebar-title">Recent Posts</h4>
									<?php foreach( $samePosts as $post ) {;

										setup_postdata($post);
										$title = get_the_title();
										?>
										<div class="post__item-small">
											<a href="<?php echo get_permalink(); ?>" class="post__item-small-card">
												<div class="post__small-card-image">
													<?php if (has_post_thumbnail()) : ?>
														<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?= $title ?>">
													<?php endif; ?>
												</div>
												<div class="post-card-content">
													<div class="post__card-data">
														<p class="post__date-title">
															<?= get_the_date('M d, Y'); ?>
														</p>
														<p class="post__date-title reading-time">
															<?= estimated_reading_time(get_the_ID()); ?>
														</p>
													</div>
													<h6 class="post__card-title">
														<?= $title ?>
													</h6>
												</div>
											</a>
										</div>
										<?php
									}
									wp_reset_postdata();
									?>
								</div>
							<?php endif;
							$categories = get_terms([
								'taxonomy'      => 'category',
								'exclude' => '1',
								'orderby' => 'term_id',
								'hide_empty'    => false,
								'parent'        => 0
							]); if ($categories) : ?>
								<div>
									<h4 class="post__sidebar-title">Main topics</h4>
									<div class="post__sidebar-categories cat-items">
										<?php foreach ($categories as $category) : ?>
											<a class="tab-btn" href="<?= get_category_link($category); ?>">
												<?php if ($icon_title = get_field('cat_icon', $category)) : ?>
													<svg class="btn-icon">
														<use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#<?php echo $icon_title; ?>"></use>
													</svg>
												<?php endif; ?>
												<span class="btn-text"><?= $category->name; ?></span>
											</a>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</article>
		<section class="email__subscribe-section">
			<div class="container">
				<div class="get-access-block">
					<div class="section-caption">
						<h2 class="sc-title small">
							Sentimate articles delivered straight to your inbox
						</h2>
					</div>

					<div class="block-footer single__block-subscribe">
						<!--[if lte IE 8]>
						<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
						<![endif]-->
						<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
						<script>
							hbspt.forms.create({
								region: "na1",
								portalId: "5244251",
								formId: "3f71886f-8991-4e22-8684-85254cf99e82"
							});
						</script>
					</div>
				</div>
			</div>
		</section>
	</main>
<?php endwhile; // end of the loop. ?>
<?php //get_sidebar(); ?>
<script>
	const textToId = str => str.toLowerCase().replaceAll('-', '').replaceAll(' ', '-').replaceAll('?', '').replaceAll(':','').replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "").replace(new RegExp('[0-9]'), 'a');

	(function ($) {
		$('.entry-content-table h2, .entry-content-table h3').each(function(i, el) {
			const text = $(el).text();
			const handle = textToId( text );
			let addClass = '';

			console.log(i);
			if (i == 1) {
				$('#js-sticky-table-of-contents .block-opener').text(text);
			}

			if ($(el).is('h3')) {
				addClass = 'subitem';
			}

			const singleContent = `<li class="${addClass}"><a href="#${handle}">${text}</a></li>`;

			$("#js-sticky-table-of-contents .block-list").append(singleContent);
			$(el).attr('id', handle);
		});

		const setStickyTableSize = () => {
			$('#js-sticky-table-of-contents').each(function(i, el){
				$(el).css({
					left: $(el).parent().offset().left,
					width: $(el).parent().outerWidth()
				})
			});
		}

		setStickyTableSize();
		$(window).resize(setStickyTableSize);

		$(document).on('click', '#js-sticky-table-of-contents .block-list a', function (event) {
			event.preventDefault();
			event.stopImmediatePropagation();

			let offset = 66;

			if ($(window).width() < 992) {
				offset = 60;
			}

			$('#js-sticky-table-of-contents .block-opener').text($(event.target).text());

			console.log( $( $(event.target).attr('href') ).offset().top - offset );
			console.log( $( $(event.target).attr('href') ).offset().top - offset - 20 - 78 );

			$('html, body').animate({
				scrollTop: $( $(event.target).attr('href') ).offset().top - offset - 20 - 78
			}, 500);

			$(event.target).blur();
		});

		$(window).scroll(function(){
			if (
				// после статичной таблицы
				$(this).scrollTop() > $('.table-of-contents').offset().top + $('.table-of-contents').outerHeight()
				&&
				// Но до блока автора поста
				$(this).scrollTop() < $('.post-author-block').offset().top - 50
			) {
				$('.sticky-table-of-contents-block').addClass('visible');
			} else{
				$('.sticky-table-of-contents-block').removeClass('visible');
			}
		});
	})(jQuery);

	// Sticky Sidebar
	(function ($) {
		const nav = $('.post-article-grid .post-sidebar');
		const container = $('.post-article-grid .post-content');

		$(window).resize(function(){
			if ($(window).width() < 992){
				nav.css({
					'transform': `translateY(0px)`
				});
			}
		});

		$(window).scroll(function(){
			if ($(window).width() < 992) {
				return false;
			}

			const navParams = {
				top: nav.offset().top,
				height: nav.height()
			};

			const containerParams = {
				top: container.offset().top - $('.header').outerHeight() - 15,
				height: container.height(),
				bottom: (container.offset().top + container.outerHeight() - nav.outerHeight() - 100)
			}

			if ( $(window).scrollTop() < containerParams.top ) {
				nav.css({
					'transform': `translateY(0px)`
				});
			}

			else if ( $(window).scrollTop() > containerParams.bottom ) {
				nav.css({
					'transform': `translateY(${ containerParams.height - navParams.height - 100 }px)`
				});
			}

			else if ( $(window).scrollTop() > containerParams.top && $(window).scrollTop() < containerParams.bottom) {
				nav.css({
					'transform': `translateY(${ $(window).scrollTop() - containerParams.top }px)`
				});
			}
		});
	})(jQuery);

	(function ($) {
		const tableOfContents = $('.table-of-contents');
		const tableOfContentsList = $('.table-of-contents-list');

		$('.entry-content-table h2').each(function(i, el) {
			const textH2 = $(el).text();
			const handleH2 = textToId( textH2 );

			let isBreak = false;

			let subnavItemsHTML = '';
			console.log($(el).find('~ h2, ~ h3'));
			$(el).find('~ h2, ~h3').each(function(i, h){
				if ($(h).is('h2')) isBreak = true;
				if(isBreak) return;

				const textH3 = $(h).text();
				const handleH3 = textToId( textH3 );

				subnavItemsHTML += `<li><a href="#${handleH3}">${textH3}</a></li>`;
			});


			const subnavHTML = !!subnavItemsHTML ? `<ol>${ subnavItemsHTML }</ol>` : '';

			const singleContent = `<li><a href="#${handleH2}">${textH2}</a>${ subnavHTML }</li>`;

			$(tableOfContentsList).append(singleContent);
			$(el).attr('id', handleH2);
		});

		$(tableOfContents).append(tableOfContentsList);
		$('.entry-content-table p:first-child:not(blockquote p:first-child)').after(tableOfContents);
		// $('.entry-content').prepend(tableOfContents);

		$(document).on('click', '.table-of-contents a', function (event) {
			event.preventDefault();
			event.stopImmediatePropagation();

			let offset = 66;

			if ($(window).width() < 992) {
				offset = 60;
			}

			$('html, body').animate({
				scrollTop: $( $(event.target).attr('href') ).offset().top - offset - 20 - 78
			}, 500);
		});

		$(window).scroll(function() {
			var target_top = $(this).scrollTop() + $('.header').outerHeight() +  $('.table-of-contents').outerHeight();
			let anchors = $('.entry-content-table h2[id], .entry-content-table h3[id]');

			$(anchors).each(function(index ) {
				let activeText = $(this).text();
				if ($(anchors[index + 1]).offset() != undefined) {
					if (target_top > $(this).offset().top - $(this).outerHeight() && target_top < $(anchors[index + 1]).offset().top - $(this).outerHeight() ) {
						$('.table-of-contents li a[href="#' + $(this).attr('id') + '"]').addClass('active');
						$('.dropdown__inner-head').text(activeText);

					} else {
						$('.table-of-contents li a[href="#' + $(this).attr('id') + '"]').removeClass('active');
					}
				}

				if ( target_top > $(anchors[anchors.length - 1]).offset().top - $(this).outerHeight()) {
					$('.table-of-contents li a[href="#' + $(anchors[anchors.length - 1]).attr('id') + '"]').addClass('active');
					$('.dropdown__inner-head').text(activeText);
				} else {
					$('.table-of-contents li a[href="#' + $(anchors[anchors.length - 1]).attr('id') + '"]').removeClass('active');
				}
			})
		});
	})(jQuery);
</script>
<?php get_footer(); ?>