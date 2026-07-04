<?php 

/* =================================

   首頁服務項目區塊（最新六篇）

  "<?php require get_theme_file_path( 'inc/custom-services-block.php' ); ?>"
  "[astra_custom_layout id=4400]"

 * ================================== */

if ( ! defined( 'ABSPATH' ) ) exit;

$q = new WP_Query([
    'post_type'           => 'service',
    'post_status'         => 'publish',
    'posts_per_page'      => 6,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
]);

if ( ! $q->have_posts() ) {
    wp_reset_postdata();
    return;
}
?>

<section class="home-news" aria-label="服務項目">
    <div class="news__container">

        <div class="news__slider js-news-slider">
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>

                <?php
                $icon      = get_field( 'icon' );
                $title_sub = get_field( 'title-sub' );
                ?>

                <article class="news__card">

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

                        <?php if ( $icon || $title_sub ) : ?>
                            <div class="news__head">

                                <?php if ( $icon ) : ?>
                                    <div class="news__icon">
                                        <?php
                                        if ( is_array( $icon ) ) {
                                            echo wp_get_attachment_image(
                                                $icon['ID'],
                                                'full',
                                                false,
                                                [
                                                    'loading'  => 'lazy',
                                                    'decoding' => 'async',
                                                ]
                                            );
                                        } else {
                                            echo wp_get_attachment_image(
                                                $icon,
                                                'full',
                                                false,
                                                [
                                                    'loading'  => 'lazy',
                                                    'decoding' => 'async',
                                                ]
                                            );
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $title_sub ) : ?>
                                    <div class="news__sub-title">
                                        <?php echo esc_html( $title_sub ); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>

                        <div class="news__card-title"><?php the_title(); ?></div>

                        <div class="news__excerpt">
                            <?php
                            $excerpt = has_excerpt()
                                ? get_the_excerpt()
                                : wp_trim_words( wp_strip_all_tags( get_the_content() ), 200, '' );

                            echo esc_html( $excerpt );
                            ?>
                        </div>

                        <a class="news__link" href="<?php //the_permalink(); ?>">
                            詳細說明
                        </a>

                    </div>

                </article>

            <?php endwhile; ?>
        </div>

    </div>
</section>

<?php wp_reset_postdata(); ?>