function create_bootstrap5_accordeon_vertical_menu($theme_location)
{
    if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {

        $menu = get_term($locations[$theme_location], 'nav_menu');
        $menu_items = wp_get_nav_menu_items($menu->term_id);
    
        $menu_html = '<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">' . "\n";
    
        foreach ($menu_items as $menu_item) {
            if ($menu_item->menu_item_parent == 0) {

                $menu_html .= '<div class="menu-item menu-accordion';
                //Condition 1:  if this is a parent to the link that it is active so that the accordeon here can be open
                $menu_html .= ' show ';
                //End of Condition 1  
                $menu_html .= '" data-kt-menu-trigger="click" >' . "\n";
                $menu_html .= '<span class="menu-link">' . "\n";
                $menu_html .= '<span class="menu-icon">' . "\n";
                //Modification 1: Make the icon to be dynamic - using Menu Icons Plugins such as: Menu Icons by ThemeIsle 
                $menu_html .= '<span class="svg-icon svg-icon-2">' . "\n";
                $menu_html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">' . "\n";
                $menu_html .= '<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />' . "\n";
                $menu_html .= '<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />' . "\n";
                $menu_html .= '</svg>' . "\n";
                $menu_html .= '</span>' . "\n";
                //End of Modification 1
                $menu_html .= '</span>' . "\n";
                $menu_html .= '<span class="menu-title">' . $menu_item->title . '</span>' . "\n";
                // Add condition 2: so that the arrow appears only when the parent has a child //
                $menu_html .= ' <span class="menu-arrow"></span>' . "\n";
                // End of condition 2 
                $menu_html .= ' </span>' . "\n";
                $menu_html .= '<!-- Collect the nav links, forms, and other content for toggling -->';
                $parent = $menu_item->ID;

                $menu_array = array();
                foreach ($menu_items as $submenu) {

                    // Suggested change of logic: Right now it only provide submenus that are of depth 1 (i.e. direct ascentantants of the main menu items. 
                    // Need to change this condition so that it accommodates and the children of the children                   
                    if ($submenu->menu_item_parent == $parent) {
                        $bool = true;
                        // Begin Generation of submenu items:
                        /*Modification 2 Part 1: Detect if each submenu option (is a parent to another option so that you can display it as an accordeon as well)
 Sample code to be added will have the form:
<div class="menu-sub menu-sub-accordion menu-active-bg">
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Microsoft</span>
												<span class="menu-arrow"></span>
											</span>
 End of Modification 2 Part 1*/
                        $menu_html_s = '<!-- Multiple Items  -->';
                        $menu_html_s .= '<div class="menu-sub menu-sub-accordion menu-active-bg">';
                        $menu_html_s .= '<div class="menu-item">';
                        $menu_html_s .= '<a class="menu-link';
                        //Condition 2:  if this link is the cureent page then mark is active
                        //$menu_html_s .= ' active ';
                        //End of Condition 2  
                        $menu_html_s .='"';
                        $menu_html_s .='href="' . $submenu->url . '">';
                        $menu_html_s .= '<span class="menu-bullet">';
                        $menu_html_s .= '<span class="bullet bullet-dot"></span>';
                        $menu_html_s .= '</span>';
                        $menu_html_s .= '<span class="menu-title">' . $submenu->title . '</span></a></div></div>';

                        /* Modification 2 Part 2: Add a div directive to end the div that open the accordeon of Modification 2 part 1 
$menu_html .= '</div' . "\n";
 End of Modification 2 Part 2*/
                        //End of Generation of submenu items
                        $menu_array[] =  $menu_html_s . "\n";
                    }
                }
                if ($bool == true && count($menu_array) > 0) {
                    $menu_html .= implode("\n", $menu_array);
                } else {
                    // Case when there is no submenu - we omly have header category with no children - it will be removed when Modification 1 is resolved
                    $menu_html .= '<!-- Single Item Only  -->' . "\n";
                    $menu_html .= '<div class="menu-item">' . "\n";
                    $menu_html .= '<a class="menu-link active" href="' . $menu_item->url . '">' . "\n";
                    $menu_html .= '<span class="menu-icon">' . "\n";
                    $menu_html .= '<!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->' . "\n";
                    $menu_html .= '<span class="svg-icon svg-icon-2">' . "\n";
                    $menu_html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">' . "\n";
                    $menu_html .= '<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />' . "\n";
                    $menu_html .= '<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />' . "\n";
                    $menu_html .= '</svg>' . "\n";
                    $menu_html .= '</span>' . "\n";
                    $menu_html .= '<!--end::Svg Icon-->' . "\n";
                    $menu_html .= '</span>' . "\n";
                    $menu_html .= '<span class="menu-title">' . $menu_item->title . '</span>' . "\n";
                    $menu_html .= '</a>' . "\n";
                    $menu_html .= '</div>' . "\n";
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

