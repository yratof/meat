<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js gt-ie8"><!--<![endif]-->

  <head>
    <meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title(''); ?></title>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="robots" content="noindex, nofollow">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
    <!--[if lt IE 9]><script>document.createElement('header');document.createElement('nav');document.createElement('section');document.createElement('article');document.createElement('aside');document.createElement('footer');</script><style>header, nav, section, article, aside, footer { display:block;}</style><![endif]-->
  </head>

  <body <?php body_class(current_user_can('edit_others_posts') ? 'user-is-admin' : ''); ?>>

    <div id="container">

      <header class="header" role="banner">

        <div id="inner-header" class="wrap clearfix">

          <p id="logo" itemscope itemtype="http://schema.org/Organization">
	          <a itemprop="url" href="<?php echo home_url(); ?>" rel="nofollow">
		          <img itemprop="logo" src="<?php bloginfo('template_url'); ?>/library/images/logo.svg" alt="<?php bloginfo('name'); ?>">
	          </a>
          </p>

          <nav role="navigation">

      			<a class="clickable animated mobile-only">
      				<div class="menu-icon">
      					<div></div>
      					<div></div>
      					<div></div>
      				</div>
      			</a>

            <?php bones_main_nav(); ?>

          </nav>

        </div> <!-- end #inner-header -->

      </header> <!-- end header -->