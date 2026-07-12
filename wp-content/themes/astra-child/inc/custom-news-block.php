<?php 

/* =================================

   首頁最新消息區塊（最新三篇）

  "<?php require get_theme_file_path( 'inc/custom-news-block.php' ); ?>"
  "[astra_custom_layout id=4325]"

 * ================================== */

if ( ! defined( 'ABSPATH' ) ) exit;

$q = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
]);

if ( ! $q->have_posts() ) {
    wp_reset_postdata();
    return;
}
?>

<section class="home-news" aria-label="最新消息">
    <div class="news__container">

        <div class="news__slider js-news-slider">
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                <article class="news__card">
                    <a class="news__card-link" href="<?php the_permalink(); ?>">

                        <div class="news__thumb">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'large', [
                                    'class'    => 'news__img',
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                ] ); ?>
                            <?php else : ?>
                                <div class="news__img-placeholder" aria-hidden="true"></div>
                            <?php endif; ?>
                        </div>

                        <div class="news__body">
                            <div class="news__card-title"><?php the_title(); ?></div>

                            <div class="news__excerpt">
                                <?php
                                $excerpt = has_excerpt()
                                    ? get_the_excerpt()
                                    : wp_trim_words( wp_strip_all_tags( get_the_content() ), 200, '' );

                                echo esc_html( $excerpt );
                                ?>
                            </div>
                        </div>

                    </a>
                </article>
            <?php endwhile; ?>
        </div>

    </div>
</section>

<?php wp_reset_postdata(); ?>