<?php
/**

||-> Shortcode: Aether Team
Author: Richard Leo

*/

function aether_team( $params, $content ) {
    extract( shortcode_atts(
        array(
            'category' => ''
        ), $params ));

    ob_start();

    $args = array(  
           'post_type' => 'aether-team',
           'post_status' => 'publish',
           'posts_per_page' => -1,
       );

    $loop = new WP_Query( $args );
    global $post;

    $term_list = get_terms( 'aether-team-category', 
                            array(
                              'hide_empty' => false,
                              'orderby' => 'ID'
                            ));
    ?>

    <div class="aether-team-category-filters container">
      <?php foreach($term_list as $term_single) { ?>
        <span class="aether-team-filter" data-filter="<?php echo $term_single->slug; ?>"><?php echo $term_single->name; ?></span>
        <span class="aether-team-filter-sep"> | </span>
      <?php } ?>
    </div>

    <div class="aether-slick container" id="scroll-here">
      <?php 
      if ( $loop->have_posts() ) : 
          while ( $loop->have_posts() ) : $loop->the_post();  ?>
              
            <?php $categories = get_the_terms($post->ID, 'aether-team-category'); ?>

              <div class="aether-team-member aether-team-filter-value" data-category="<?php echo $categories[0]->slug; ?>">
                <div class="aether-team-image"><div></div></div>
                <div class="aether-team-name"><?php the_title(); ?></div>
                <div class="aether-team-position"><?php echo get_post_meta($post->ID, 'aether_team_position', true); ?></div>
                <hr>
                <div class="aether-team-excerpt"><?php the_excerpt(); ?></div>
                <div class="aether-team-see-more">
                  <p>Ver más</p>
                  <i class='fa fa-chevron-down' aria-hidden='true'></i>
                </div>
                <div class="aether-team-content-hidden">
                  <div class="aether-team-name"><?php the_title(); ?></div>
                  <div class="aether-team-position-content"><?php echo get_post_meta($post->ID, 'aether_team_position', true); ?></div>
                  <?php the_content(); ?> 
                  <div class="aether-team-return-top">
                    <i class='fa fa-chevron-up' aria-hidden='true'></i>
                    <a href="#scroll-here" class="aether-team-scroll">Regresar</a>
                  </div> 
                </div>
              </div>

          <?php endwhile; 
      endif; 
      ?>
    </div>
    <hr style="padding-top: 15px; margin-bottom: 30px;" class="aether-hr-sep container">
    <?php $loop->rewind_posts(); ?>

    <div class="aether-slick-content container">

    <?php while ( $loop->have_posts() ) : $loop->the_post();  ?>

      <?php $categories = get_the_terms($post->ID, 'aether-team-category'); ?>

      <div class="aether-slick-team-member-content aether-team-filter-value" data-category="<?php echo $categories[0]->slug; ?>">
        <div class="aether-team-info-content">
          <span class="aether-team-name-content"><?php echo get_the_title();  ?></span>
          <span class="aether-team-position-content"> | <?php echo get_post_meta($post->ID, 'aether_team_position', true); ?></span>
          <?php the_content(); ?>   
        </div>     
      </div>
    <?php endwhile; ?>

    </div>



    <?php
    $html = ob_get_contents();
  	ob_end_clean();
  	return $html;
}

add_shortcode('aether_team', 'aether_team');

/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
add_action('init', 'aether_team_shortcode');
function aether_team_shortcode() {

    vc_map( array(
     "name" => esc_attr__("Aether Team", 'aether-team'),
     "base" => "aether_team",
     "category" => esc_attr__('Aether Plugins', 'aether-team'),
     "icon" => "",
     "params" => array(
        array(
          "group"       => "Options",
          "type"        => "textfield",
          "holder"      => "div",
          "class"       => "",
          "heading"     => esc_attr__( "HQ Form Action Link", 'aether-team' ),
          "param_name"  => "action_link",
          "value"       => "",
          "description" => esc_attr__( "Enter the contact form action link provided on tenant.", 'aether-team' )
        ),
        array(
          "group"       => "Options",
          'type'        => 'textfield',
          'heading'     => __( 'HQ Name Field ID', 'js_composer' ),
          'param_name'  => 'name_id',
          'value'       => ''
        ),
        array(
          "group"       => "Options",
          'type'        => 'textfield',
          'heading'     => __( 'HQ Email Field ID', 'js_composer' ),
          'param_name'  => 'email_id',
          'value'       => ''
        ),
        array(
          "group"       => "Options",
          'type'        => 'textfield',
          'heading'     => __( 'HQ Message Field ID', 'js_composer' ),
          'param_name'  => 'message_id',
          'value'       => ''
        ),
      )
  ));
}
