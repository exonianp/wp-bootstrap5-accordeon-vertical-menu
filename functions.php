

<?php 
function create_bootstrap5_accordeon_vertical_menu($theme_location)
{
    global $wpdb;

    if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {

        $menu = get_term($locations[$theme_location], 'nav_menu');
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $menu_html = '<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">' . "\n";

        foreach ($menu_items as $menu_item) {
            if ($menu_item->menu_item_parent == 0) {
                $has_children = $wpdb->get_var("SELECT COUNT(meta_id) FROM wp_postmeta WHERE meta_key='_menu_item_menu_item_parent' AND meta_value='" . $menu_item->ID . "'");


                if ($has_children > 0) {
                    $menu_html .= '<div class="menu-item menu-accordion';
                    $menu_html .= ' show ';
                    $menu_html .= '" data-kt-menu-trigger="click" >' . "\n";
                } else {
                    $menu_html .= '<div class="menu-item">' . "\n";
                }
                if ($has_children > 0) {
                    $menu_html .= '<span class="menu-link">' . "\n";
                } else {
                    $menu_html .= '<a class="menu-link active" href="' . $menu_item->url . '">' . "\n";
                }
                $menu_html .= '<span class="menu-icon">' . "\n";
		// change to the svg of your choice that you can also call via the CSS    
                $menu_html .= '<span class="svg-icon svg-icon-2">' . "\n";
                $menu_html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">' . "\n";
                $menu_html .= '<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />' . "\n";
                $menu_html .= '<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />' . "\n";
                $menu_html .= '</svg>' . "\n";
		// end of :: change  to the svg of your choice that you can also call via the CSS    
                $menu_html .= '</span>' . "\n";
                $menu_html .= '</span>' . "\n";
                $menu_html .= '<span class="menu-title">' . $menu_item->title . '</span>' . "\n";

                // Add condition 2: so that the arrow appears only when the parent has a child //
                if ($has_children > 0) {
                    $menu_html .= ' <span class="menu-arrow"></span>' . "\n";
                }
                // End of condition 2 
                $menu_html .= ' </span>' . "\n";
               
                $parent = $menu_item->ID;
                $menu_array = array();
                foreach ($menu_items as $submenu) {

                    if ($submenu->menu_item_parent == $parent) {
                        $bool = true;
                        // find if the current menu has children so that it can be displayed as an accordeon (with arrow) or not
			$has_sub_children = $wpdb->get_var("SELECT COUNT(meta_id) FROM wp_postmeta WHERE meta_key='_menu_item_menu_item_parent' AND meta_value='" . $submenu->ID . "'");

                        if ($has_sub_children == 0) {

                            $menu_html_s = '<!-- This option does not have children  -->';
                            $menu_html_s .= '<div class="menu-sub menu-sub-accordion menu-active-bg">';
                            $menu_html_s .= '<div class="menu-item">';
                            $menu_html_s .= '<a class="menu-link';
                            // Optional Condition 3:  if this link is the cureent page then mark is active
                            // $menu_html_s .= ' active ';
                            // End of Optional Condition 3  
                            $menu_html_s .= '"';
                            $menu_html_s .= 'href="' . $submenu->url . '">';
                            $menu_html_s .= '<span class="menu-bullet">';
                            $menu_html_s .= '<span class="bullet bullet-dot"></span>';
                            $menu_html_s .= '</span>';
                            $menu_html_s .= '<span class="menu-title">' .  $submenu->title . '</span></a></div></div>';
                        } else {
                            $menu_html_s = '<!-- This option has children  -->';
                            $menu_html_s .=   '<!-- Lets print the parent of the children  -->';
                            $menu_html_s .=   '<div class="menu-sub menu-sub-accordion menu-active-bg">';
                            $menu_html_s .=   '<div data-kt-menu-trigger="click" class="menu-item menu-accordion">';
                            $menu_html_s .=   '<span class="menu-link">';
                            $menu_html_s .=   '<span class="menu-bullet">';
                            $menu_html_s .=   '<span class="bullet bullet-dot"></span>';
                            $menu_html_s .=   '</span>';
                            $menu_html_s .=   '<span class="menu-title">' .  $submenu->title . '</span>';
                            $menu_html_s .=   '<span class="menu-arrow"></span>';
                            $menu_html_s .=   '</span>';

			    //this query produces all you need to have for the children at any depth. It is explained on the readme and will spare you the add on walkers.	
                            $query = "SELECT e.id, e.post_title, CASE WHEN c.meta_value='custom' THEN ( d.meta_value) ELSE concat ('/', e.post_name ,'/') END as linkurl, b.post_id 
                                                FROM wp_postmeta a FORCE INDEX (post_id)
                                                JOIN wp_postmeta b FORCE INDEX (post_id) ON a.post_id=b.post_id
                                                JOIN wp_postmeta c FORCE INDEX (post_id) ON c.post_id=b.post_id
                                                JOIN wp_postmeta d FORCE INDEX (post_id) ON d.post_id=b.post_id
                                                JOIN wp_posts e ON e.id=b.meta_value
                                                WHERE d.meta_key='_menu_item_url' AND c.meta_key='_menu_item_object' AND b.meta_key='_menu_item_object_id' 
                                                AND a.meta_key='_menu_item_menu_item_parent' AND a.meta_value='" . $submenu->ID . "'";

                            $resultsData = $wpdb->get_results($query);

                            foreach ($resultsData as $childrenData) {

                                $menu_html_s .=   '<!-- Lets print each of the children  -->';
                                $menu_html_s .=   '<div class="menu-sub menu-sub-accordion menu-active-bg">';
                                $menu_html_s .=   '<div class="menu-item">';
                                $menu_html_s .=   '<a class="menu-link" href="' . $childrenData->linkurl . '">';
                                $menu_html_s .=   '<span class="menu-bullet">';
                                $menu_html_s .=   '<span class="bullet bullet-dot"></span>';
                                $menu_html_s .=   '</span>';
                                $menu_html_s .=   '<span class="menu-title">' . $childrenData->post_title . '</span>';
                                $menu_html_s .=   '</a>';
                                $menu_html_s .=   '</div>';
                                $menu_html_s .=   '</div>';
                            }
                            $menu_html_s .=   '</div>';
                            $menu_html_s .=   '</div>';
                        }

                        $menu_array[] =  $menu_html_s . "\n";
                    }
                }
                if ($bool == true && count($menu_array) > 0) {
                    $menu_html .= implode("\n", $menu_array);
                } 
                $menu_html .= '</div>' . "\n";
            }
        }
        $menu_html .= '</div>' . "\n";
    } else {
        $menu_html = '<!-- no menu defined in location "' . $theme_location . '" -->';
    }
    echo $menu_html;
}

?>
