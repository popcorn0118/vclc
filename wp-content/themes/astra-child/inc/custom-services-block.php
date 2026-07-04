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

<section class="home-services" aria-label="服務項目">
    <div class="services__container">

        <div class="services__slider js-services-slider">
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>

                <?php
                $icon      = get_field( 'icon' );
                $title_sub = get_field( 'title-sub' );
                ?>

                <article class="services__card">

                    <div class="services__thumb">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', [
                                'class'    => 'services__img',
                                'loading'  => 'lazy',
                                'decoding' => 'async',
                            ] ); ?>
                        <?php else : ?>
                            <div class="services__img-placeholder" aria-hidden="true"></div>
                        <?php endif; ?>
                    </div>

                    <div class="services__body">

                        <?php if ( $icon || $title_sub ) : ?>
                            <div class="services__head">

                                <?php if ( $icon ) : ?>
                                    <div class="services__icon">
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
                                    <div class="services__sub-title">
                                        <?php echo esc_html( $title_sub ); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>

                        <div class="services__card-title"><?php the_title(); ?></div>

                        <div class="services__excerpt">
                            <?php
                            $excerpt = has_excerpt()
                                ? get_the_excerpt()
                                : wp_trim_words( wp_strip_all_tags( get_the_content() ), 200, '' );

                            echo esc_html( $excerpt );
                            ?>
                        </div>

                        <a class="services__link" href="<?php //the_permalink(); ?>">
                            詳細說明
                        </a>

                    </div>

                </article>

            <?php endwhile; ?>
        </div>

    </div>
</section>

<?php wp_reset_postdata(); ?>
