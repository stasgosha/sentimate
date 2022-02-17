<?php
/**
 * Template Name: Blog
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<main class="page-content blog-page">
		<section class="first-screen-section">
			<div class="container">
				<h1 class="page-caption"><?php echo get_field('title_page_header');?></h1>

				<div class="section-text">
					<p><?php echo get_field('text_page_header');?></p>
				</div>
			</div>
		</section>

		<section class="blog-section">
			<div class="container">
				<?php
					$cats = get_terms([
						'taxonomy'      => 'category',
						'hide_empty'    => false,
					]);
				?>
				<div class="section-nav md-hidden">
					<div class="tabs-nav-wrapper">
						<div class="tabs-nav">
							<?php foreach ($cats as $category) : ?>
								<a class="tab-btn" href="<?php echo get_category_link($category); ?>">
									<svg class="btn-icon">
										<use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#<?php echo get_field('cat_icon', $category);?>"></use>
									</svg>
									<span class="btn-text"><?= $category->name; ?></span>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<div class="section-nav md-visible">
					<div class="nav-select-block">
						<div class="block-field">
							<button class="block-opener">All Articles</button>
							<ul class="block-list">
								<?php foreach ($cats as $category) : ?>
									<li><a href="<?php echo get_category_link($category); ?>"><?= $category->name; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>

				<div class="section-grid">
					<?php 
						$posts = get_posts( array(
							'numberposts' => 9,
							'category'    => 0,
							'orderby'     => 'date',
							'order'       => 'DESC',
							'include'     => array(),
							'exclude'     => array(),
							'meta_key'    => '',
							'meta_value'  =>'',
							'post_type'   => 'post',
							// 'tax_query' => array(
							// 	array(
							// 		'taxonomy' => 'category',
							// 		'field'    => 'term_id',
							// 		'terms'    => $query->term_id
							// 	)
							// ),
						));
					?>

					<?php foreach ($posts as $post): ?>
						<?php setup_postdata($post); ?>

						<article class="blog-card">
							<?php
								$user_id = get_the_author_meta('ID');
								$user_avatar = get_field('avatar', 'user_' . $user_id);
								$post_terms = wp_get_object_terms(get_the_ID(), 'category', ['fields' => 'all']);
							?>

							<div class="card-image">
								<?php if (has_post_thumbnail()) : ?>
									<img src="<?= get_the_post_thumbnail_url(); ?>" alt="">
								<?php endif; ?>

								<?php foreach ($post_terms as $category) : ?>
									<div class="card-category-block">
										<svg class="block-icon">
											<use xlink:href="<?php echo get_template_directory_uri() ?>/img/icons-sprite.svg#<?php echo get_field('cat_icon', $category);?>"></use>
										</svg>
										<div class="block-text"><?= $category->name; ?></div>
									</div>
								<?php endforeach; ?>
							</div>

							<div class="card-content">
								<div class="card-top">
									<time class="card-date"><?= get_the_date('M d, Y'); ?></time>
									<div class="card-time-to-read"><?= estimated_reading_time(get_the_ID()); ?></div>
								</div>

								<div class="card-inner">
									<h3 class="card-caption"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="card-excerpt">
										<p><?php echo get_the_excerpt(); ?></p>
									</div>
								</div>
							</div>

							<div class="card-footer">
								<div class="card-author-block">
									<?php if ($user_avatar) : ?>
										<div class="block-image">
											<img src="<?= $user_avatar['url']; ?>" alt="<?= $user_avatar['alt']; ?>">
										</div>
									<?php endif; ?>
									<author class="block-name"><?= get_the_author_meta('display_name'); ?></author>
								</div>
							</div>
						</article>

					<?php endforeach ?>

					<?php wp_reset_postdata(); ?>
				</div>

				<div class="section-footer">
					<button class="btn btn-stroke">Show more</button>
				</div>
			</div>
		</section>

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
<?php get_footer(); ?>