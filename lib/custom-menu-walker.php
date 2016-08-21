<?php

/*
 * http://www.ordinarycoder.com/wordpress-bootstrap-3-with-wp_nav_menu/
 */


add_filter('nav_menu_link_attributes', 'nav_link_att', 10, 3);

function nav_link_att($atts, $item, $args) {
	if ( $args->has_children && $item->menu_item_parent == 0 )
	{
		$atts['data-toggle'] = 'dropdown';
		$atts['class'] = 'dropdown-toggle';
	}
	return $atts;
}

class BS3_Walker_Nav_Menu extends Walker_Nav_Menu {

	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		$id_field = $this->db_fields['id'];

		if ( isset( $args[0] ) && is_object( $args[0] ) )
		{
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );

		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( is_object($args) && !empty($args->has_children) && $item->menu_item_parent == 0 )
		{
			$link_after = $args->link_after;
			$args->link_after = ' <b class="caret"></b>';
		}

		parent::start_el($output, $item, $depth, $args, $id);

		if ( is_object($args) && !empty($args->has_children) )
			$args->link_after = $link_after;
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = '';
		$output .= "$indent<ul class=\"dropdown-menu list-unstyled\">";
	}
}
