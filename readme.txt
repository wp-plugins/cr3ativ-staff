=== Cr3ativ Staff ===
Contributors: Cr3ativ
Tags: careers, jobs
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Cr3ativ Staff plugin is taken from a custom post type we used to include in our themes, we now include this as a plugin so the functionality is not theme specific.


== Description ==

Easily add your staff members to your website using this special custom post type plugin. Features include the ability to upload a headshot and large profile image, set a staff title, staff name, full regular WordPress post content, and unlimited social icons and links per user. The plugin includes both an index page for the staff profiles to be displayed on one page, 3 columns wide that then link to the single page template per profile.

For your convenience, the plugin also comes complete with a special widget to enable you to display your staff profiles in any widget area. Options include Title, number of profiles to display, order ASC or DESC and display / do not display the headshot thumbnail. Headshot and staff members name automatically links to their single page profile.

Here is [the demo](http://mythemepreviews.com/plugins/staff-index/ "the demo").


== Required Files ==

Included in the templates directory are:
single-cr3ativstaff.php
template-cr3ativstaff.php

You will need to upload both of the above templates in to your theme's root directory. 


== Installation ==

1. Upload the `cr3ativ-staff` folder to your to the `/wp-content/plugins/` directory or alternatively upload the cr3ativ-staff.zip via the plugin page of WordPress by clicking 'Add New' and select the zip from your local computer.

2. Activate the plugin through the 'Plugins' menu in WordPress.

3. You will see a new post type on the left of the WP admin menu 'Job Listings'.

4. Inside the 'cr3ativ-staff' plugin folder, there is a directory called 'templates', upload the template(s) into your current theme directory (as mentioned above). Do not upload the actual template folder, just the files within it!

5. Under the ‘Staff’ menu option, you will see ‘Staff Options’.  This section enables you to alter the ‘slug’ name that appears in the address bar when visiting single staff page. The defaults would read as:

http://yourdomain.com//cr3ativstaff/yourstafftitle

With this option you can set the name of the slug to be whatever you wish (in accordance with WordPress slug naming conventions).


== Creating a Single Staff Profile Page ==

1. Look for the newly created ’Staff’ option in the WordPress admin area.
2. Click ‘Add New’ to create a new staff profile.
3. The post title will be the name of your staff member.
4. You may add any content as you normally would for a standard post. Please be aware that you should add a WordPress standard ‘Read More’ tag to break your content for using the widget provided, failure to add a ‘Read More’ tag will result in your full post displaying in the widget.
5. Below the regular content editor you should see a section named ’Staff Data’ (If you do not then please click ‘Screen Options’ and select Staff Data to reveal). This area contains the following sections:

Staff Title - an example would be CEO
Staff Head Shot Image - Upload a headshot image by clicking ‘Choose Image’ and uploading using the standard WP media library or by choosing an existing image.
Staff Single Page Full Width Image - this larger image is used exclusively on the single profile page as a top banner image. Again either upload or select a previously uploaded image from your library.
Social Follow - you may upload or use existing social icon images already within your media library. Be sure to set the full URL link to your social network profile page for each added image using the URL section.

You may add further social icons by clicking the ‘+’ sign to reveal another image upload / url box or remove ones no longer desired by clicking the ‘-‘ sign.

6. Once you have completed all sections and added your content simply click ‘Publish’ as normal.
7. You may add single profiles as menu items by adding an instance of a staff member from the left ’Staff’ box to your primary menu area via the Appearance > Menus in WordPress.


== Widget and Sidebar Area ==

1. Once the plugin is installed if you visit your ‘Appearance’ > ‘Widgets’ you will see a new widget named ‘Staff Loop’ - this can be dragged over and placed in any widget area of your theme.

2. Options include a title, the number of staff members to list, order via ascending, and whether to display the headshot thumbnail - set these options and save.


== Creating A Staff Index Page ==

1. Click Pages > Add New as normal in WordPress admin.
2. Name your page, for example ’Staff Index’, content is not required as staff information will be displayed dynamically.
3. Select the Cr3ativStaff template from the right side drop down - ‘Page Attributes > Template’.
4. Click Publish.
5. Add this page to your menu if your theme does not automatically add pages for you via Appearance > Menus in WordPress.



== Screenshots ==

1. Staff listing admin view
2. Adding a new staff member
3. Pretty permalink settings (remember to click save on Settings > Permalinks if you receive 404 page errors)
4. Staff loop widget


== Styling ==

Styling for these page templates are included in the includes directory under :

/includes/css/cr3ativstaff.css


== Changelog ==

= 1.0.3 =
* Updated admin view and language files.

= 1.0.2 =
* Updated the template files that do not use the filter to add pagination.  This setting is based on the WordPress Settings > Reading selection.

= 1.0.1 =
* Fixed a column issue to remove margin from 3rd nth child for better alignment.

= 1.0 =
* First release.

