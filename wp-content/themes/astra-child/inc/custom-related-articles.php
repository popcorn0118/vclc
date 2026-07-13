<?php

/* =================================

   文章單頁 - 相關文章（最新三篇）

  "<?php require get_theme_file_path( 'inc/custom-related-articles.php' ); ?>"
  "[astra_custom_layout id=4325]"

 * ================================== */

if ( ! defined( 'ABSPATH' ) ) exit;

$current_id = get_the_ID();
if ( ! $current_id ) {
    return;
}

$categories = get_the_terms( $current_id, 'category' );
if ( is_wp_error( $categories ) || empty( $categories ) ) {
    return;
}

$related_query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'post__not_in'        => [ $current_id ],
    'category__in'        => wp_list_pluck( $categories, 'term_id' ),
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
]);

if ( ! $related_query->have_posts() ) {
    wp_reset_postdata();
    return;
}
?>

<section class="related-articles" aria-label="其他最新消息">
    <div class="related__container">
        <h3 class="related__title">其他最新消息</h3>

        <div class="related__grid">
            <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                <?php
                $r_cats  = get_the_terms( get_the_ID(), 'category' );
                $r_tags  = get_the_terms( get_the_ID(), 'post_tag' );
                $r_terms = [];
                if ( ! is_wp_error( $r_cats ) && ! empty( $r_cats ) ) {
                    foreach ( $r_cats as $t ) $r_terms[] = $t->name;
                }
                if ( ! is_wp_error( $r_tags ) && ! empty( $r_tags ) ) {
                    foreach ( $r_tags as $t ) $r_terms[] = $t->name;
                }

                $r_excerpt = get_post_field( 'post_excerpt', get_the_ID() );
                if ( ! $r_excerpt ) {
                    $r_excerpt = wp_strip_all_tags( strip_shortcodes( get_post_field( 'post_content', get_the_ID() ) ), true );
                }
                ?>
                <article class="related__card">
                    <a class="related__thumb" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                        <?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
                    </a>

                    <time class="related__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                        <?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?>
                    </time>

                    <div class="related__card-title h4">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>

                    <?php if ( ! empty( $r_terms ) ): ?>
                        <div class="related__terms"><?php echo esc_html( implode( ', ', $r_terms ) ); ?></div>
                    <?php endif; ?>

                    <p class="related__excerpt"><?php echo esc_html( $r_excerpt ); ?></p>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>
