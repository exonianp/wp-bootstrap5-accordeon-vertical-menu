# wp-bootstrap5-accordeon-vertical-menu
Create a wp function that will provide vertical accordeon menu using full bootstrap 5 best practices (i.e. without ```<ul>, <li>```  but only with ```<div>``` and ```<span>``` ) so that it can provide the functionality of Metronic theme as displayed here: https://preview.keenthemes.com/metronic8/demo1/pages/profile/projects.html

Add this code to your theme's functions.php file.

You also add the following code in the functions.php

```
function wpb_custom_new_menu()
{
    register_nav_menu('metronic-style-vertical-menu', __('Aside'));
}
add_action('init', 'wpb_custom_new_menu'); 
```

then call it in the part of the webpage that you want it to appear using:

```
create_bootstrap5_accordeon_vertical_menu('metronic-style-vertical-menu');
``` 

This initial file produces the functionality of displaying fully compatible with Metronic 8, bootstrap 5, vertical (accordeon) menu.
1. It goes to depth two (i.e. main item, submenu item  and children of the submenu).
2. It does contain SQL code to determine if a main menu item is a parent to a child
3. It does contain SQL code to determine if a submenu has a child

There are many walkers available but they are based on the core functionality of the WP menu (which is rather limited as it only goes to depth two by default) and add quite a lot of overhead, with limited control to the actual output of the code. Then the output has to be overwritten with various techniques.

Finding if a submenu item has a child and getting all the details is achieved with the following SQL:
```
  SELECT e.id, e.post_title, CASE WHEN c.meta_value='custom' THEN ( d.meta_value) ELSE concat ('/', e.post_name ,'/') END as linkurl, b.post_id 
  FROM wp_postmeta a FORCE INDEX (post_id) 
  JOIN wp_postmeta b FORCE INDEX (post_id) ON a.post_id=b.post_id
  JOIN wp_postmeta c FORCE INDEX (post_id) ON c.post_id=b.post_id
  JOIN wp_postmeta d FORCE INDEX (post_id) ON d.post_id=b.post_id
  JOIN wp_posts e ON e.id=b.meta_value
  WHERE d.meta_key='_menu_item_url' AND c.meta_key='_menu_item_object' AND b.meta_key='_menu_item_object_id' 
  AND a.meta_key='_menu_item_menu_item_parent' AND a.meta_value='" . $submenu->ID . "'"
```                                                
  Explanation: we are performing four JOINS in the wp_postmeta table in order to get the following information:
1. The list of the children of the parent via the _**_menu_item_menu_item_parent**_
2. The type of the link _**_menu_item_object**_ of each child
3. Determination of the  _**_menu_item_url**_ that provides the URL in a custom link (i.e. not page or post)
4. Determination of the  _**_menu_item_object_id**_ that provides the actual post id of the page/post referenced in the menu 

The final, fifth, JOIN provides us the required information from the wp_posts table for the referenced post.

The link, in the correct format, is produced in SQL in order to avoid creating if/else conditions in php:

```CASE WHEN c.meta_value='custom' THEN ( d.meta_value) ELSE concat ('/', e.post_name ,'/') END as linkurl```

This is because if the menu item has a custom link, the target url is saved  (as entered) in the _meta_value_ column of the  wp_postmeta table where _meta_key=_menu_item_url_, whereas the links to pages and posts are derived by the _post_name_ field in the **wp_posts** table.

The FORCE INDEX statements multiply the performance of the query (depending on the actual tuning of your MariaDB/mySQL server. Since most of us cannot control the tuning of the servers that host our applications is best practice to include the directive notwithstanding the fact that the post_id index comes with Wordpress installation. 

It will be great if the Wordpress community decides to include more than depth 2 in the _**wp_get_nav_menu_items**_ as well as provide methods to easily determine if a node has a child or belongs to a parent. 

Your contributions are most welcome.
