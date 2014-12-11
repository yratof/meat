<?php get_header(); ?>

			<div id="content">

				<div id="masthead" class="relative text-center">
					<?php // Large header here ?>
					<img src="https://unsplash.it/1660/400?random&<?php echo rand(0,30); ?>" />
					<h1 class="vertical horizontal">This. Is. Meat.</h1>
				</div>


				<div id="inner-content" class="wrap clearfix">


					<div class="twelvecol first clearfix padding-1 columns">
						
						<div class="column-3">
							<img src="https://unsplash.it/420/300?random&<?php echo rand(0,30); ?>" />
							<h2>Cow drumstick tenderloin</h2>
							<p>Pork belly, brisket chicken capicola. Drumstick ball tip t-bone tenderloin kevin, corned beef ham hock kielbasa cow. Cupim ground round pancetta chuck pork loin. Leberkas meatloaf kevin, chicken ribeye brisket kielbasa ham shankle.</p>
							<a href="#" class="button brand">Click this!</a>
						</div>

						<div class="column-3">
							<img src="https://unsplash.it/420/300?random&<?php echo rand(0,30); ?>" />
							<h2>Cow drumstick tenderloin</h2>
							<p>Pork belly, brisket chicken capicola. Drumstick ball tip t-bone tenderloin kevin, corned beef ham hock kielbasa cow. Cupim ground round pancetta chuck pork loin. Leberkas meatloaf kevin, chicken ribeye brisket kielbasa ham shankle.</p>
							<a href="#" class="button brand">Action this!</a>
						</div>

						<div class="column-3 ">
							<img src="https://unsplash.it/420/300?random&<?php echo rand(0,30); ?>" />
							<h2>Cow drumstick tenderloin</h2>
							<p>Ham hock ground round tail beef shoulder, venison hamburger biltong spare ribs salami. Pig t-bone meatball jerky shank boudin tail shankle ham hock alcatra andouille short ribs. Alcatra brisket meatloaf kevin bresaola corned beef.</p>
							<a href="#" class="button brand">Ignore this...</a>
						</div>
						
					</div>


					<?php // Banner across the page ?>
					<div class="twelvecol first clearfix padding-2">
						<img src="https://unsplash.it/1660/200?random&<?php echo rand(0,30); ?>" />
					</div>








						<div id="main" class="twelvecol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<div id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

								</header> <!-- end article header -->

								<section class="entry-content clearfix">

									<?php the_content(); ?>

								</section> <!-- end article section -->

							</div> <!-- end article -->

							<?php endwhile; endif; ?>

						</div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
