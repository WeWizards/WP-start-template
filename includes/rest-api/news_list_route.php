<?php

add_action( 'rest_api_init', 'wwzrds_news_list_route' );

function wwzrds_news_list_route() {
    register_rest_route( 'wwzrds/v1', '/news-list', [
        'methods'             => 'GET',
        'callback'            => 'wwzrds_news_list_route_callback',
        'permission_callback' => '__return_true',
    ] );
}

function wwzrds_news_list_route_callback( WP_REST_Request $request ) {
    $json_params = ! empty( $request['json'] ) ? $request['json'] : null;

    if ( ! $json_params ) {
        return new WP_REST_Response( [
            'error' => 'Params are empty',
        ], 400 );
    }

    $query_args = json_decode( $json_params, true );

    if ( ! $query_args ) {
        return new WP_REST_Response( [
            'error' => 'Params are empty',
        ], 400 );
    }

    $term = ! empty( $request['term'] ) ? $request['term'] : null;
    $page = ! empty( $request['page'] ) ? $request['page'] : null;
    $tax  = ! empty( $request['taxonomy'] ) ? $request['taxonomy'] : 'technology';

    $query_args['tax_query'] = [
        'relation' => 'AND',
    ];

    if ( $term && $term !== 'all' ) {
        $query_args['tax_query']['term'] = [
            'taxonomy' => $tax,
            'terms'    => [ $term ],
            'field'    => 'slug',
        ];
    }

    if ( $page ) {
        $query_args['paged'] = $page;
    }

    if ( $query_args['post_type'] !== 'post' || $query_args['post_status'] !== 'publish' ) {
        return new WP_REST_Response( [
            'error' => 'Invalid data',
        ], 400 );
    }

    $query     = new WP_Query( $query_args );
    $max_pages = $query->max_num_pages;
    $news      = $query->posts;
    wp_reset_query();

    $response = [];

    if ( ! empty( $news ) ) {
        $response['posts'] = [];
        foreach ( $news as $new ) {
            $response['posts'][] = wwzrds_get_template_string( 'template-parts/components/post-item', [
                'post_id'      => $new->ID,
                'attrs'        => [
                    'style'      => 'opacity:1; transform: translateY(0)',
                ],
                'taxonomy'     => $tax,
                'custom_class' => 'news-list__post',
            ] );
        }
        $response['pagination'] = wwzrds_generate_pagination( $page, $max_pages, false );
    } else {
        $response['empty'] = wwzrds_get_template_string( 'template-parts/blocks/block-news-list/empty-results' );
    }

    return new WP_REST_Response( $response, 200 );
}
