<?php
/* ------------------------ _____search_by_title_only */
if ( ! function_exists('_____search_by_title_only') ) {

	function _____search_by_title_only($where) {
		global $wpdb, $typenow, $pagenow;
		$post_type = array( 'product' );
		if ( ! is_admin() ) {
			return $where;
		}
		if ( in_array($typenow, $post_type) && isset($_GET[ 's' ]) && 'edit.php' === $pagenow ) {
			$terms = explode(' ', $_GET[ 's' ]);
			foreach ( $terms as $term ) {
				$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql(like_escape($term)) . '%\'';
			}
			return $where;
		}
	}

	add_filter('posts_search', '_____search_by_title_only', 500, 1);
}
