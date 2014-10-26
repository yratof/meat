<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class=" clearfix" role="main">

						<article id="post-not-found" class="hentry clearfix" >


							<section class="eightcol gutter-top marginauto entry-content">

								<h1><?php _e( 'Sorry, Article Not Found', 'bonestheme' ); ?></h1>
								<p><?php _e( 'The article or page you were looking for was not found. If you\'re looking for something in particular, you can use the search form here. Alternatively, you can use the navigation above.', 'bonestheme' ); ?></p>
								<p><?php get_search_form(); ?></p>
								
							</section> <!-- end article section -->

						</article> <!-- end article -->

					</div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
