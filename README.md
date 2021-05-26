# wp-bootstrap5-accordeon-vertical-menu
Create a wp function that will provide vertical accordeon menu using full bootstrap 5 best practices (i.e. without  but only with and ) so that it can provide the functionality of Metronic theme as displayed here: https://preview.keenthemes.com/metronic8/demo1/pages/profile/projects.html

Add this code to your theme's functions.php file.

then call it in the part of the webpage that you want it to appear using:
create_bootstrap5_accordeon_vertical_menu('Name of Menu Location'); 

This initial file produces the functionality of displaying fully compatible with Metronic 8, bootstrap 5, vertical (accordeon) menu, but with the following limitations.
1. It only goes to depth one.
2. It does not contain the code if the parent has a child so that it can display (or not) the arrow
3. It does not contain the code that detects if a node is currently active so that itself and its parents can be set to active/show.

I am still investigating the optimal way (performance wise) in order to do these calculations; thus I am looking for the input of those who have spent a great deal of time investigating Wordpress Menus.

Possibly the best approach will be to compute in the initial menu_items array this information (if an item is a parent to others and if itself or its children are active), extend this array and then used the results in the conditions set producing the menu_html. 

Your contributions are most welcome.
