<?php get_header();?>


<main class="section" id="main">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-9  <?php if ($layout == '3'):?>  col2-left  <?php endif?>   <?php if ($layout == '2'):?>  col2-right  <?php endif?>">
        <section role="main" class="main-content page-404">
          <h1 class="notfound_title">
            <?php _e('Page not found', 'PixTheme')?>
          </h1>
          <p class="notfound_description">
            <?php _e('The page you are looking for seems to be missing.Go back, or return to yourcompany.com to choose a new direction.Please report any broken links to our team.', 'PixTheme')?>
          </p>
          <a class="button notfound_button" href="javascript: history.go(-1)">
          <?php _e('Return to previous page', 'PixTheme')?>
          </a> </section>
      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>
