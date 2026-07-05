<?php

/* =================================

   服務項目列表

  "<?php require get_theme_file_path( 'inc/custom-services-list.php' ); ?>"
  "[astra_custom_layout id=4937]"

 * ================================== */

if ( ! defined( 'ABSPATH' ) ) exit;

// 目前分類 slug 與頁碼（自訂 query 參數，避免跟其他頁面的查詢字串衝突）
$current_cat  = isset( $_GET['service_cat'] ) ? sanitize_title( wp_unslash( $_GET['service_cat'] ) ) : '';
$current_page = isset( $_GET['service_page'] ) ? max( 1, absint( $_GET['service_page'] ) ) : 1;

// 分類頁籤（service-type 分類法）
$service_terms = get_terms([
    'taxonomy'   => 'service-type',
    'hide_empty' => true,
]);

if ( is_wp_error( $service_terms ) ) {
    $service_terms = [];
}

// 切換分類時重設頁碼，並保留錨點讓切換後自動捲動回列表頂部
$tabs_base_url = remove_query_arg( [ 'service_cat', 'service_page' ] );

$query_args = [
    'post_type'           => 'service',
    'post_status'         => 'publish',
    'posts_per_page'      => 4,
    'paged'               => $current_page,
    'ignore_sticky_posts' => true,
];

if ( $current_cat ) {
    $query_args['tax_query'] = [[
        'taxonomy' => 'service-type',
        'field'    => 'slug',
        'terms'    => $current_cat,
    ]];
}

$q = new WP_Query( $query_args );
?>

<section class="services-list" id="services-list" aria-label="服務項目列表">
    <div class="services-list__container">

        <?php if ( $service_terms ) : ?>
            <div class="services-list__tabs" role="tablist">

                <a href="<?php echo esc_url( $tabs_base_url . '#services-list' ); ?>"
                   class="services-list__tab <?php echo ( '' === $current_cat ) ? 'is-active' : ''; ?>">
                    全部頁面
                </a>

                <?php foreach ( $service_terms as $term ) : ?>
                    <a href="<?php echo esc_url( add_query_arg( 'service_cat', $term->slug, $tabs_base_url ) . '#services-list' ); ?>"
                       class="services-list__tab <?php echo ( $current_cat === $term->slug ) ? 'is-active' : ''; ?>">
                        <?php echo esc_html( $term->name ); ?>
                    </a>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

        <?php if ( $q->have_posts() ) : ?>

            <div class="services-list__grid">
                <?php while ( $q->have_posts() ) : $q->the_post(); ?>

                    <?php
                    $icon      = get_field( 'icon' );
                    $title_sub = get_field( 'title-sub' );
                    ?>

                    <article class="services__card">
                        <div class="services__warp">
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

                                        <div class="services__card-title">
                                            <div class="services__icon">
                                                <?php
                                                    echo wp_get_attachment_image(
                                                        $icon['ID'],
                                                        'full',
                                                        false,
                                                        [
                                                            'loading'  => 'lazy',
                                                            'decoding' => 'async',
                                                        ]
                                                    );
                                                ?>
                                            </div>
                                            <?php the_title(); ?>
                                        </div>

                                        <?php if ( $title_sub ) : ?>
                                            <div class="services__sub-title">
                                                <?php echo esc_html( $title_sub ); ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                <?php endif; ?>

                                <div class="services__excerpt">
                                    <?php echo wp_kses_post( get_the_excerpt() ); ?>
                                </div>

                                <a class="services__link" href="<?php //the_permalink(); ?>">
                                    詳細說明
                                </a>

                            </div>
                        </div>
                    </article>

                <?php endwhile; ?>
            </div>

            <?php
            $pagination_links = paginate_links([
                'base'      => add_query_arg( 'service_page', '%#%' ) . '#services-list',
                'format'    => '',
                'current'   => $current_page,
                'total'     => $q->max_num_pages,
                'prev_text' => '←',
                'next_text' => '→',
                'type'      => 'array',
                'end_size'  => 1,
                'mid_size'  => 1,
            ]);
            ?>

            <?php if ( $pagination_links ) : ?>
                <nav class="services-list__pagination" aria-label="分頁導覽">
                    <?php foreach ( $pagination_links as $link ) : ?>
                        <?php echo $link; ?>
                    <?php endforeach; ?>
                </nav>
            <?php endif; ?>

        <?php else : ?>
            <p class="services-list__empty">目前尚無相關服務項目。</p>
        <?php endif; ?>

    </div>
</section>

<?php wp_reset_postdata(); ?>
