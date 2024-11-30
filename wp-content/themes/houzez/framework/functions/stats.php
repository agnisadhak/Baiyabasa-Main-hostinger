<?php
if( !function_exists('houzez_get_realtor_tax_stats') ) {
    function houzez_get_realtor_tax_stats( $taxonomy_name, $meta_key, $listings_ids ) {

        $taxonomies = [];
        $total_count = [];
        $total_listings = 0;
        $others = 0;
        $other_percent = 0;

        // Collect property city taxonomies and calculate counts in a single loop
        foreach ($listings_ids as $listing_id) {
            $terms = get_the_terms($listing_id, $taxonomy_name);
            if ($terms && !is_wp_error($terms)) {
                $term = $terms[0];
                $slug = $term->slug;
                $name = $term->name;
                
                if (!isset($taxonomies[$slug])) {
                    $taxonomies[$slug] = $name;
                    $count = houzez_realtor_stats($taxonomy_name, $meta_key, get_the_ID(), $slug);
                    if ($count > 0) {
                        $total_count[$slug] = $count;
                        $total_listings += $count;
                    }
                }
            }
        }

        // Calculate percentages and sort taxonomies by count
        $stats_array = [];
        foreach ($total_count as $slug => $count) {
            $name = $taxonomies[$slug];
            $stats_array[$name] = ($count / $total_listings) * 100;
        }
        arsort($stats_array);

        // Prepare chart data
        $tax_chart_data = array_slice(array_values($stats_array), 0, 3);
        $taxs_list_data = array_slice(array_keys($stats_array), 0, 3);

        // Calculate others percentage if applicable
        $top_counts = array_slice($total_count, 0, 3);
        $total_top_count = array_sum($top_counts);

        if ($total_top_count < $total_listings) {
            $others = $total_listings - $total_top_count;
            $other_percent = ($others / $total_listings) * 100;
            if ($other_percent > 0) {
                $tax_chart_data[] = $other_percent;
            }
        }

        $return = array(
            'taxonomies' => $taxonomies,
            'taxs_list_data' => $taxs_list_data,
            'tax_chart_data' => $tax_chart_data,
            'total_count' => $total_count,
            'total_top_count' => $total_top_count,
            'others' => $others,
            'other_percent' => $other_percent
        );

        return $return;

    }
}

if(!function_exists('houzez_get_term_slugs_for_stats')) {
	function houzez_get_term_slugs_for_stats($taxonomy) {
		$terms = get_terms(array(
			'taxonomy' => $taxonomy,
			'hide_empty' => false,
			'orderby'    => 'count',
			'order'    => 'DESC',
		));

		$term_data = $slug = $name = array();

		$i = 0;
		foreach ($terms as $terms): 
			$i++;
		    $slug[] = $terms->slug; 
		    $name[] = $terms->name; 

		    if($i == 3) {
		    	//break;
		    }
		endforeach;

		$term_data['name'] = $name;
		$term_data['slug'] = $slug;
		return $term_data;
	}
}

if (!function_exists('houzez_realtor_stats')) {
    function houzez_realtor_stats($taxonomy, $meta_key, $meta_value, $term_slug) {
        global $wpdb, $author_id;

        // Create a unique cache key
        $cache_key = 'houzez_realtor_stats_' . md5($taxonomy . $meta_key . $meta_value . $term_slug . get_the_ID());
        $cached_result = get_transient($cache_key);

        if ($cached_result !== false) {
            return $cached_result;
        }

        // Base SQL query
        $sql = "
            SELECT COUNT(DISTINCT p.ID) 
            FROM {$wpdb->posts} p
            INNER JOIN {$wpdb->term_relationships} tr ON (p.ID = tr.object_id)
            INNER JOIN {$wpdb->term_taxonomy} tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
            INNER JOIN {$wpdb->terms} t ON (tt.term_id = t.term_id)
            LEFT JOIN {$wpdb->postmeta} pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = %s)
            LEFT JOIN {$wpdb->postmeta} pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = 'fave_agent_display_option')
            WHERE p.post_type = 'property' 
              AND p.post_status = 'publish'
              AND t.slug = %s
              AND tt.taxonomy = %s";

        // Additional conditions based on context
        $conditions = array($meta_key, $term_slug, $taxonomy);

        if (is_singular('houzez_agency')) {
            $agency_agents_ids = Houzez_Query::loop_agency_agents_ids(get_the_ID());
            if (!empty($agency_agents_ids)) {
                $sql .= " AND (pm1.meta_value IN (" . implode(',', array_fill(0, count($agency_agents_ids), '%d')) . ") OR (pm1.meta_value = %s AND pm2.meta_value = 'agency_info'))";
                $conditions = array_merge($conditions, $agency_agents_ids, array($meta_value));
            } else {
                $sql .= " AND pm1.meta_value = %s AND pm2.meta_value = 'agency_info'";
                $conditions[] = $meta_value;
            }
        } elseif (is_singular('houzez_agent')) {
            $sql .= " AND pm1.meta_value = %s AND pm2.meta_value = 'agent_info'";
            $conditions[] = $meta_value;
        } elseif (is_author()) {
            $sql .= " AND p.post_author = %d";
            $conditions[] = $author_id;
        }

        // Prepare and execute the query
        $query = $wpdb->prepare($sql, $conditions);
        $count = $wpdb->get_var($query);

        // Cache the result
        set_transient($cache_key, $count, 12 * HOUR_IN_SECONDS);

        return $count;
    }
}

if(!function_exists('houzez_realtor_stats_old')) {
	function houzez_realtor_stats_old($taxonomy, $meta_key, $meta_value, $term_slug) {
		global $author_id;

		$args = array(
			'post_type' => 'property',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'fields' => 'ids',
			'tax_query' => array(
		        array(
		            'taxonomy' => $taxonomy,
		            'field'    => 'slug',
		            'terms'    => $term_slug,
		            'include_children' => false
		        )
		    )
		);

		$args = apply_filters( 'houzez_sold_status_filter', $args );

		$meta_query = array();

        if(is_singular('houzez_agency')) {

        	$agents_array = array();
        	$agenyc_agents_ids = Houzez_Query::loop_agency_agents_ids(get_the_ID());

        	if( !empty($agenyc_agents_ids) ) {
	        	$agents_array = array(
		            'key' => 'fave_agents',
		            'value' => $agenyc_agents_ids,
		            'compare' => 'IN',
		        );
	        }

        	$args['meta_query'] = array(
                'relation' => 'OR',
                $agents_array,
                array(
                    'relation' => 'AND',
                    array(
			            'key'     => $meta_key,
			            'value'   => $meta_value,
			            'compare' => '='
			        ),
			        array(
			            'key'     => 'fave_agent_display_option',
			            'value'   => 'agency_info',
			            'compare' => '='
			        )
                ),
            );


        } elseif(is_singular('houzez_agent')) {

        	$args['meta_query'] = array(
                'relation' => 'AND',
                array(
		            'key'     => $meta_key,
		            'value'   => $meta_value,
		            'compare' => '='
		        ),
		        array(
		            'key'     => 'fave_agent_display_option',
		            'value'   => 'agent_info',
		            'compare' => '='
		        )
            );


        } elseif(is_author()) {
        	$args['author'] = $author_id;
        }

		$posts = get_posts($args); 

		return count($posts);
	}	
}