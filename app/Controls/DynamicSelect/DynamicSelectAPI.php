<?php

namespace AFEB\Controls\DynamicSelect;

if (!defined('ABSPATH')) {
	exit;
}

/**
 * "Vertex Addons for Elementor" DynamicSelectAPI Class
 * 
 * @class DynamicSelectAPI
 * @version 1.0.7
 */
class DynamicSelectAPI
{
	/**
	 * Initialize "Vertex Addons for Elementor" DynamicSelectAPI
	 * 
	 * @since 1.0.7
	 */
	public function init()
	{
		$this->actions();
	}

	/**
	 * DynamicSelectAPI Class Actions
	 * 
	 * @since 1.0.7
	 */
	public function actions()
	{
		add_action('rest_api_init', [$this, 'rest_api_init']);
	}

	/**
	 * Registers a REST API route
	 *
	 * @since 1.0.7
	 */
	public function rest_api_init()
	{
		register_rest_route(
			'afeb-api/v1/dynamic-select',
			'/(?P<action>\w+)/',
			[
				'methods' => 'GET',
				'callback' =>  [$this, 'callback'],
				'permission_callback' => '__return_true'
			]
		);
	}

	/**
	 * REST API Callback
	 *
	 * @since 1.0.7
	 * 
	 * @param array $request
	 */
	public function callback($request)
	{
		return $this->{$request['action']}($request);
	}

	/**
	 * Retrieves an array of the posts
	 *
	 * @since 1.0.7
	 * 
	 * @param array $request
	 */
	public function get_posts_by_post_type($request)
	{
		if (!current_user_can('edit_posts')) return;

		$post_type = isset($request['query_slug']) ? sanitize_text_field(explode(',', $request['query_slug'])) : '';
		return ['results' => $post_type];
		$args = [
			'post_type' => $post_type,
			'post_status' => 'publish',
			'posts_per_page' => 20
		];

		if (isset($request['ids'])) {
			$request['ids'] = map_deep($request['ids'], 'intval');
			$ids = explode(',', map_deep($request['ids'], 'intval'));
			$args['post__in'] = $ids;
		}
		if (isset($request['s'])) $args['s'] = sanitize_text_field($request['s']);
		if ('attachment' === $post_type) $args['post_status'] = 'any';

		$options = [];
		$query = new \WP_Query($args);

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				$options[] = ['id' => get_the_ID(), 'text' => html_entity_decode(get_the_title())];
			}
		}

		wp_reset_postdata();
		return ['results' => $post_type];
	}
}
