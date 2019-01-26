<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('ecobox_Redux_Framework_config')) {

    class ecobox_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'ecobox'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'ecobox'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'ecobox'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'ecobox'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'ecobox'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'ecobox') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'ecobox'), $this->theme->parent()->display('Name'));
            }
            ?>

              </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
              /** @global WP_Filesystem_Direct $wp_filesystem  */
              global $wp_filesystem;
              if (empty($wp_filesystem)) {
                  require_once(ABSPATH . '/wp-admin/includes/file.php');
                  WP_Filesystem();
              }
              $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS

            $this->sections[] = array(
              'title'     => __('General Settings', 'ecobox'),
              'icon'      => 'el-icon-cogs',
              'fields'    => array(
                array(
                  'id'        => 'favicon',
                  'type'      => 'media',
                  'url'       => true,
                  'title'     => __('Custom Favicon', 'ecobox'),
                  'compiler'  => 'true',
                  //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                  'desc'      => __('Default favicon.', 'ecobox'),
                  'subtitle'  => __('Format: ico, Size: 16x16', 'ecobox'),
                  'default'   => array('url' => get_template_directory_uri() . '/images/favicon.ico'),
                  'width'     => '',
                  'height'    => ''
                ),
                array(
                  'id'        => 'iphone_icon',
                  'type'      => 'media',
                  'url'       => true,
                  'title'     => __('iPhone Favicon', 'ecobox'),
                  'compiler'  => 'true',
                  //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                  'desc'      => __('For iPhone 2G/3G/3GS, 2011 iPod Touch and older Android devices', 'ecobox'),
                  'subtitle'  => __('Format: png, Size: 57x57', 'ecobox'),
                  'default'   => array(
                    'url'     => get_template_directory_uri() . '/images/apple-touch-icon.png'),
                  'width'     => '',
                  'height'    => ''
                ),
                array(
                  'id'        => 'ipad_icon',
                  'type'      => 'media',
                  'url'       => true,
                  'title'     => __('iPad Favicon', 'ecobox'),
                  'compiler'  => 'true',
                  //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                  'desc'      => __('For 1st generation iPad, iPad 2 and iPad mini.', 'ecobox'),
                  'subtitle'  => __('Format: png, Size: 72x72', 'ecobox'),
                  'default'   => array(
                    'url'     => get_template_directory_uri() . '/images/apple-touch-icon-72x72.png'),
                  'width'     => '',
                  'height'    => ''
                ),
                array(
                  'id'        => 'iphone_icon_retina',
                  'type'      => 'media',
                  'url'       => true,
                  'title'     => __('iPhone Retina Favicon', 'ecobox'),
                  'compiler'  => 'true',
                  //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                  'desc'      => __('For iPhone 4, 4S, 5, 5S and 2012 iPod Touch.', 'ecobox'),
                  'subtitle'  => __('Format: png, Size: 114x114', 'ecobox'),
                  'default'   => array(
                    'url'     => get_template_directory_uri() . '/images/apple-touch-icon-114x114.png'),
                  'width'     => '',
                  'height'    => ''
                ),
                array(
                  'id'        => 'ipad_icon_retina',
                  'type'      => 'media',
                  'url'       => true,
                  'title'     => __('iPad Retina Favicon', 'ecobox'),
                  'compiler'  => 'true',
                  //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                  'desc'      => __('For iPad Retina version.', 'ecobox'),
                  'subtitle'  => __('Format: png, Size: 144x144', 'ecobox'),
                  'default'   => array(
                    'url'     => get_template_directory_uri() . '/images/apple-touch-icon-144x144.png'),
                  'width'     => '',
                  'height'    => ''
                ),
                array(
                  'id'            => 'tracking_code',
                  'type'          => 'textarea',
                  'title'         => __('Tracking Code', 'ecobox'),
                  'subtitle'      => __('Google Analytics or similar', 'ecobox'),
                  'desc'          => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'ecobox'),
                  'validate'      => '',
                  'default'       => '',
                  'allowed_html'  => array('') //see http://codex.wordpress.org/Function_Reference/wp_kses
                ),
              )
            );


            // Header Options
            $this->sections[] = array(
              'title'     => __('Header', 'ecobox'),
              'icon'      => 'el-icon-home',
              'fields'    => array(
                array(
                  'id'        => 'logo-standard',
                  'type'      => 'media',
                  'url'       => true,
                  'title'     => __('Logo (Standard Version)', 'ecobox'),
                  'compiler'  => 'true',
                  //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                  'desc'      => __('Please choose an image file for your logo.', 'ecobox'),
                  'subtitle'  => __('This logo used for non-retina devices.', 'ecobox'),
                  'default'   => array(
                    'url'     => get_template_directory_uri() . '/images/logo.png'),
                  'width'     => '',
                  'height'    => '',
                ),
                array(
                  'id'        => 'logo-retina',
                  'type'      => 'media',
                  'url'       => true,
                  // 'width'     => true,
                  // 'height'    => true,
                  'title'     => __('Logo (Retina Version)', 'ecobox'),
                  'compiler'  => 'true',
                  //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                  'desc'      => __('Please choose an image file for the retina version of the logo. It should be 2x the size of main logo.', 'ecobox'),
                  'subtitle'  => __('This logo used for retina devices.', 'ecobox'),
                  'default'   => array(
                    'url'     => get_template_directory_uri() . '/images/retina/logo@2x.png'
                  )
                ),
                array(
                  'id'                => 'logo-dimensions',
                  'type'              => 'dimensions',
                  'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                  'units_extended'    => 'false',
                  'title'             => __('Logo Standard Width/Height', 'ecobox'),
                  'subtitle'          => __('Set width/height in px.', 'ecobox'),
                  'desc'              => __('You can set width/height of logo. Also if retina logo is uploaded, please enter the standard logo (1x) version width/height. Do not enter the retina logo width.', 'ecobox'),
                  'default'           => array(
                      'width'         => 140, 
                      'height'        => 80,
                  )
                ),
                array(
                  'id'        => 'navbar_sticky',
                  'type'      => 'switch',
                  'title'     => __('Navbar Sticky', 'ecobox'),
                  'desc'      => __('Sticky navbar is always visible while scrolling page and sticks and the top of the page.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Yes',
                  'off'       => 'No',
                ),
                array(
                  'id'        => 'breadcrumbs',
                  'type'      => 'switch',
                  'title'     => __('Breadcrumbs', 'ecobox'),
                  'subtitle'  => __('Breadcrumbs are displayed by default.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
              )
            );



            // Blog Options
            $this->sections[] = array(
              'title'     => __('Blog', 'ecobox'),
              'icon'      => 'el-icon-th-list',
              'fields'    => array(
                array(
                  'id'        => 'opt-blog-layout',
                  'type'      => 'image_select',
                  'compiler'  => true,
                  'title'     => __('Blog Layout', 'ecobox'),
                  'subtitle'  => __('Select blog layout (1 col, 2 cols and 3 cols).', 'ecobox'),
                  'options'   => array(
                    '1' => array(
                      'alt' => 'Default',
                      'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                    '2' => array(
                      'alt' => '1 Column',
                      'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'),
                    '3' => array(
                      'alt' => '2 Columns',
                      'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png')
                  ),
                  'default'   => '1',
                  'hint'      => array(
                    'content' => __('This option doesn\'t affect on sidebar position.', 'ecobox'),
                  )
                ),
                array(
                  'id'        => 'opt-blog-sidebar',
                  'type'      => 'image_select',
                  'compiler'  => true,
                  'title'     => __('Sidebar Position', 'ecobox'),
                  'subtitle'  => __('Select sidebar alignment or disable it.', 'ecobox'),
                  'options'   => array(
                      '1' => array(
                        'alt' => 'Right Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                      '2' => array(
                        'alt' => 'Left Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                      '3' => array(
                        'alt' => 'No Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png')
                  ),
                  'default'   => '1'
                ),
                array(
                  'id'        => 'opt-blog-title',
                  'type'      => 'text',
                  'title'     => __('Blog Page Title', 'ecobox'),
                  'subtitle'  => __('This title used on Blog Page', 'ecobox'),
                  'desc'      => __('Enter Your Blog Title used on Blog page.', 'ecobox'),
                  'validate'  => 'not_empty',
                  'msg'       => 'Fill Blog Page title',
                  'default'   => 'Blog'
                ),
                array(
                  'id'        => 'opt-post-image',
                  'type'      => 'switch',
                  'title'     => __('Featured Image on Single Post Page', 'ecobox'),
                  'subtitle'  => __('Show/hide featured images on single post pages.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-post-title',
                  'type'      => 'switch',
                  'title'     => __('Post Title', 'ecobox'),
                  'subtitle'  => __('Show/hide the post title that goes below the featured images.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-info-box',
                  'type'      => 'switch',
                  'title'     => __('Author Info Box', 'ecobox'),
                  'subtitle'  => __('Show/hide the author info box below posts.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-social-box',
                  'type'      => 'switch',
                  'title'     => __('Social Sharing Box', 'ecobox'),
                  'subtitle'  => __('Show/hide the social sharing box.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-related-posts',
                  'type'      => 'switch',
                  'title'     => __('Related Posts', 'ecobox'),
                  'subtitle'  => __('Show/hide related posts below the post content.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
              )
            );


            // Portfolio Options
            $this->sections[] = array(
              'title'     => __('Portfolio', 'ecobox'),
              'icon'      => 'el-icon-picture',
              'fields'    => array(
                array(
                  'id'        => 'opt-portfolio-num',
                  'type'      => 'text',
                  'title'     => __('Number of Portfolio Items', 'ecobox'),
                  'desc'      => __('How many items do you want to show on portfolio pages?', 'ecobox'),
                  'validate'  => 'numeric',
                  'default'   => '12',
                ),
                array(
                  'id'        => 'opt-portfolio-filter',
                  'type'      => 'switch',
                  'title'     => __('Portfolio Filter', 'ecobox'),
                  'desc'      => __('Filter by categories. Located above the portfolio items.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-portfolio-lightbox',
                  'type'      => 'switch',
                  'title'     => __('Portfolio Lightbox', 'ecobox'),
                  'desc'      => __('Magnifying icon appears when you hover on portfolio item.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-portfolio-meta',
                  'type'      => 'switch',
                  'title'     => __('Portfolio Meta Info', 'ecobox'),
                  'desc'      => __('Title and data for portfolio post.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-portfolio-layout',
                  'type'      => 'image_select',
                  'compiler'  => true,
                  'title'     => __('Single Portfolio Layout', 'ecobox'),
                  'options'   => array(
                      '1' => array(
                        'alt' => 'Right Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                      '2' => array(
                        'alt' => 'Left Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                      '3' => array(
                        'alt' => 'Small Image',
                        'img' => get_template_directory_uri() . '/images/admin/fullw-portfolio.png'),
                      '4' => array(
                        'alt' => 'Small Image',
                        'img' => get_template_directory_uri() . '/images/admin/sm-img-portfolio.png')
                  ),
                  'default'   => '1',
                  'desc'      => __('Single Portfolio Sidebar contains project info added via content editor.', 'ecobox'),
                ),
                array(
                  'id'        => 'opt-portfolio-nav',
                  'type'      => 'switch',
                  'title'     => __('Previous/Next Pagination', 'ecobox'),
                  'subtitle'  => __('Link to prev/next portfolio items.', 'ecobox'),
                  'desc'      => __('Located above the portfolio on the Single Portfolio page.', 'ecobox'),
                  'default'   => 0,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-portfolio-related',
                  'type'      => 'switch',
                  'title'     => __('Related Projects', 'ecobox'),
                  'desc'      => __('Located at the bottom of Single Portfolio Page.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-portfolio-related-title',
                  'type'      => 'text',
                  'title'     => __('Related Projects Title', 'ecobox'),
                  'desc'      => __('Enter Your Related Projects Title used on Single Portfolio Page.', 'ecobox'),
                  'validate'  => 'not_empty',
                  'msg'       => 'Fill Related Projects title',
                  'default'   => 'Related Projects',
                ),
              )
            );



            // Contact Options
            $this->sections[] = array(
              'title'     => __('Contact', 'ecobox'),
              'icon'      => 'el-icon-envelope',
              'fields'    => array(
                array(
                  'id'        => 'opt-contact-gmap',
                  'type'      => 'switch',
                  'title'     => __('Google Map', 'ecobox'),
                  'subtitle'  => __('Show/hide Google Map.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-contact-coordinates',
                  'type'      => 'text',
                  'title'     => __('Google Map Coordinates', 'ecobox'),
                  'subtitle'  => __('Put your address here.', 'ecobox'),
                  'desc'      => __('Go to <a href="https://www.google.com/maps/">Google Map</a>, copy and paste your coordinates.', 'ecobox'),
                  'default'   => '57.669645,11.926832',
                ),
                array(
                  'id'            => 'opt-contact-zoom',
                  'type'          => 'slider',
                  'title'         => __('Map Zoom Level', 'ecobox'),
                  'subtitle'      => __('Used in Google Map.', 'ecobox'),
                  'desc'          => __('Higher number will be more zoomed in.', 'ecobox'),
                  'default'       => 13,
                  'min'           => 1,
                  'step'          => 1,
                  'max'           => 19,
                  'display_value' => 'label'
                ),
                array(
                  'id'        => 'opt-contact-title',
                  'type'      => 'text',
                  'title'     => __('Contact Info Title', 'ecobox'),
                  'subtitle'  => __('Title used in Contact Info section.', 'ecobox'),
                  'default'   => 'Contact Information',
                ),
                array(
                  'id'        => 'opt-contact-desc',
                  'type'      => 'textarea',
                  'title'     => __('Contact Info Description', 'ecobox'),
                  'subtitle'  => __('Short text info.', 'ecobox'),
                  'desc'      => __('Description used in Contact Info section and goes under the Contact Title.', 'ecobox'),
                  'default'   => 'Praesent sed tristique massa. Aenean iaculis diam nec ligula ullamcorper eu tempus dolor ullamcorper. Morbi in nisi tincidunt neque gravida facilisis.',
                ),
                array(
                  'id'        => 'opt-contact-phone',
                  'type'      => 'multi_text',
                  'title'     => __('Phone(s)', 'ecobox'),
                  'subtitle'  => __('Phone numbers used in the Contact Info section.', 'ecobox'),
                  'desc'      => __('You can add as more numbers as you want.', 'ecobox'),
                  // 'validate'  => 'numeric',
                  'default'   => array(
                    1 => '+ 44 1225 324 980'
                  )
                ),
                array(
                  'id'        => 'opt-contact-email',
                  'type'      => 'multi_text',
                  'title'     => __('Email(s)', 'ecobox'),
                  'subtitle'  => __('Emails used in the Contact Info section.', 'ecobox'),
                  'desc'      => __('You can add as more emails as you want.', 'ecobox'),
                  'validate'  => 'email',
                  'default'   => array(
                    1 => 'ecobox@dan-fisher.com'
                  )
                ),
                array(
                  'id'        => 'opt-contact-address',
                  'type'      => 'text',
                  'title'     => __('Address', 'ecobox'),
                  'subtitle'  => __('Address used in the Contact Info section.', 'ecobox'),
                  'default'   => '101 West Street, New York, NY 12345',
                ),
                array(
                  'id'        => 'opt-contact-social-fb',
                  'type'      => 'text',
                  'title'     => __('Facebook', 'ecobox'),
                  'subtitle'  => __('Link to your Facebook account.', 'ecobox'),
                  'default'   => '#',
                ),
                array(
                  'id'        => 'opt-contact-social-twitter',
                  'type'      => 'text',
                  'title'     => __('Twitter', 'ecobox'),
                  'subtitle'  => __('Link to your Twitter account.', 'ecobox'),
                  'default'   => '#',
                ),
                array(
                  'id'        => 'opt-contact-social-linkedin',
                  'type'      => 'text',
                  'title'     => __('Linkedin', 'ecobox'),
                  'subtitle'  => __('Link to your Linkedin account.', 'ecobox'),
                  'default'   => '#',
                ),
                array(
                  'id'        => 'opt-contact-social-google-plus',
                  'type'      => 'text',
                  'title'     => __('Google+', 'ecobox'),
                  'subtitle'  => __('Link to your Google+ account.', 'ecobox'),
                  'default'   => '#',
                ),
                array(
                  'id'        => 'opt-contact-social-pinterest',
                  'type'      => 'text',
                  'title'     => __('Pinterest', 'ecobox'),
                  'subtitle'  => __('Link to your Pinterest account.', 'ecobox'),
                  'default'   => '#',
                ),
                array(
                  'id'        => 'opt-contact-social-youtube',
                  'type'      => 'text',
                  'title'     => __('YouTube', 'ecobox'),
                  'subtitle'  => __('Link to your YouTube account.', 'ecobox'),
                  'default'   => '#',
                ),
                array(
                  'id'        => 'opt-contact-social-instagram',
                  'type'      => 'text',
                  'title'     => __('Instagram', 'ecobox'),
                  'subtitle'  => __('Link to your Instagram account.', 'ecobox'),
                  'default'   => '#',
                ),
              )
          );



          // Footer Options
          $this->sections[] = array(
              'title'     => __('Footer', 'ecobox'),
              'icon'      => 'el-icon-align-center',
              'fields'    => array(
                array(
                  'id'        => 'opt-footer-twitter',
                  'type'      => 'switch',
                  'title'     => __('Twitter Feed', 'ecobox'),
                  'subtitle'  => __('Twitter Feed is displayed by default.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-footer-widgets',
                  'type'      => 'switch',
                  'title'     => __('Footer Widgets', 'ecobox'),
                  'subtitle'  => __('Footer Widgets are displayed by default.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-footer-copyright',
                  'type'      => 'switch',
                  'title'     => __('Copyright', 'ecobox'),
                  'subtitle'  => __('Footer Copyright is displayed by default.', 'ecobox'),
                  'default'   => 1,
                  'on'        => 'Show',
                  'off'       => 'Hide',
                ),
                array(
                  'id'        => 'opt-footer-text',
                  'type'      => 'editor',
                  'required'  => array('opt-footer-copyright', '=', '1'),
                  'title'     => __('Copyright Text', 'ecobox'),
                  'subtitle'  => __('Add copyright text here.', 'ecobox'),
                  'default'   => '&copy; Ecobox, 2014. All rights reserved. <a href="http://themeforest.net/user/dan_fisher/portfolio?ref=dan_fisher">Done by Dan Fisher</a>',
                  'compiler'  => true,
                  'args'      => array(
                    'teeny'         => true,
                    'media_buttons' => false,
                    'quicktags'     => true,
                    'textarea_rows' => 2,
                  )
                ),
              )
            );





            // Typography Options
            $this->sections[] = array(
              'title'     => __('Typography', 'ecobox'),
              'icon'      => 'el-icon-font',
              'fields'    => array(
                array(
                  'id'        => 'typography-body',
                  'type'      => 'typography',
                  'title'     => __('Body Font', 'ecobox'),
                  'subtitle'  => __('Specify the body font properties.', 'ecobox'),
                  'google'    => true,
                  'output'    => array('body'),
                  'units'     => 'px',
                  'default'   => array(
                    'color'         => '#3f5348',
                    'font-size'     => '13px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '400',
                    'line-height'   => '21px',
                    'text-align'    => 'left',
                  ),
                ),
                array(
                  'id'          => 'typography-nav',
                  'type'        => 'typography',
                  'title'       => __('Menu Font', 'ecobox'),
                  'subtitle'    => __('Specify the main navigation font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('.flexnav li a'),
                  'units'       => 'px',
                  'color'       => false,
                  'line-height' => false,
                  'text-align'  => false,
                  'default'     => array(
                    'font-size'     => '14px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '400',
                  ),
                ),
                array(
                  'id'          => 'typography-h1',
                  'type'        => 'typography',
                  'title'       => __('H1 Heading', 'ecobox'),
                  'subtitle'    => __('Specify the H1 heading font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('h1'),
                  'units'       => 'px',
                  'line-height' => false,
                  'text-align'  => false,
                  'default'     => array(
                    'color'         => '#3f5348',
                    'font-size'     => '30px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '400',
                  ),
                ),
                array(
                  'id'          => 'typography-h2',
                  'type'        => 'typography',
                  'title'       => __('H2 Heading', 'ecobox'),
                  'subtitle'    => __('Specify the H2 heading font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('h2'),
                  'units'       => 'px',
                  'line-height' => false,
                  'text-align'  => false,
                  'default'     => array(
                    'color'         => '#3f5348',
                    'font-size'     => '24px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '400',
                  ),
                ),
                array(
                  'id'          => 'typography-h3',
                  'type'        => 'typography',
                  'title'       => __('H3 Heading', 'ecobox'),
                  'subtitle'    => __('Specify the H3 heading font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('h3'),
                  'units'       => 'px',
                  'line-height' => false,
                  'text-align'  => false,
                  'default'     => array(
                    'color'         => '#3f5348',
                    'font-size'     => '18px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '400',
                  ),
                ),
                array(
                  'id'          => 'typography-h4',
                  'type'        => 'typography',
                  'title'       => __('H4 Heading', 'ecobox'),
                  'subtitle'    => __('Specify the H4 heading font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('h4'),
                  'units'       => 'px',
                  'line-height' => false,
                  'text-align'  => false,
                  'default'     => array(
                    'color'         => '#3f5348',
                    'font-size'     => '16px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '400',
                  ),
                ),
                array(
                  'id'          => 'typography-h5',
                  'type'        => 'typography',
                  'title'       => __('H5 Heading', 'ecobox'),
                  'subtitle'    => __('Specify the H5 heading font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('h5'),
                  'units'       => 'px',
                  'line-height' => false,
                  'text-align'  => false,
                  'default'     => array(
                    'color'         => '#3f5348',
                    'font-size'     => '14px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '400',
                  ),
                ),
                array(
                  'id'          => 'typography-h6',
                  'type'        => 'typography',
                  'title'       => __('H6 Heading', 'ecobox'),
                  'subtitle'    => __('Specify the H6 heading font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('h6'),
                  'units'       => 'px',
                  'line-height' => false,
                  'text-align'  => false,
                  'default'     => array(
                    'color'         => '#3f5348',
                    'font-size'     => '12px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '400',
                  ),
                ),
                array(
                  'id'          => 'typography-icobox',
                  'type'        => 'typography',
                  'title'       => __('Icobox Heading', 'ecobox'),
                  'subtitle'    => __('Specify the heading font properties for icoboxes.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('.icobox .icobox-desc h3'),
                  'units'       => 'px',
                  'line-height' => false,
                  'text-align'  => false,
                  'color'       => false,
                  'default'     => array(
                    'font-size'     => '26px',
                    'font-family'   => 'Bebas',
                    'font-weight'   => '400',
                  ),
                ),
                array(
                  'id'          => 'typography-title-bordered',
                  'type'        => 'typography',
                  'title'       => __('Title Bordered', 'ecobox'),
                  'subtitle'    => __('Specify the Title Bordered properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('.title-bordered h2'),
                  'units'       => 'px',
                  'text-align'  => false,
                  'color'       => false,
                  'default'     => array(
                    'font-size'     => '40px',
                    'font-family'   => 'Bebas',
                    'font-weight'   => '400',
                  ),
                ),
                array(
                  'id'          => 'typography-breadcrumbs',
                  'type'        => 'typography',
                  'title'       => __('Breadcrumbs Font', 'ecobox'),
                  'subtitle'    => __('Specify the breadcrumbs font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('.page-header .breadcrumb a'),
                  'line-height' => false,
                  'text-align'  => false,
                  'color'       => false,
                  'default'     => array(
                    'font-size'     => '13px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '400',
                  ),
                ),
                array(
                  'id'          => 'typography-page-heading',
                  'type'        => 'typography',
                  'title'       => __('Page Heading Font', 'ecobox'),
                  'subtitle'    => __('Specify the page heading font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('.page-header.page-header__standard h1'),
                  'units'       => 'px',
                  'line-height' => false,
                  'text-align'  => false,
                  'default'     => array(
                    'color'         => '#3a1504',
                    'font-size'     => '22px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '700'
                  ),
                ),
                array(
                  'id'          => 'typography-button',
                  'type'        => 'typography',
                  'title'       => __('Button Font', 'ecobox'),
                  'subtitle'    => __('Specify the button font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('.btn-default, .btn-primary, .btn-secondary, .btn-tertiary, .btn-success, .btn-info, .btn-warning, .btn-danger'),
                  'units'       => 'px',
                  'font-size'   => false,
                  'text-align'  => false,
                  'color'       => false,
                  'default'     => array(
                    'font-family'   => 'Bebas',
                    'font-weight'   => '400',
                    'line-height' => '',
                  ),
                ),
                array(
                  'id'          => 'typography-footer-heading',
                  'type'        => 'typography',
                  'title'       => __('Footer Widget Heading Font', 'ecobox'),
                  'subtitle'    => __('Specify the footer wiget title font properties.', 'ecobox'),
                  'google'      => true,
                  'output'      => array('.widget__footer .widget-title'),
                  'units'       => 'px',
                  'line-height' => false,
                  'default'     => array(
                    'color'         => '',
                    'font-size'     => '16px',
                    'font-family'   => 'Titillium Web',
                    'font-weight'   => '700',
                    'text-align'    => 'left'
                  ),
                ),
              )
            );


            // Styling Options
            $this->sections[] = array(
              'title'     => __('Styling', 'ecobox'),
              'icon'      => 'el-icon-tint',
              'fields'    => array(
                array(
                  'id'          => 'brand-primary',
                  'type'        => 'color',
                  'title'       => __('Brand Primary Color', 'ecobox'),
                  'subtitle'    => __('Pick a primary color.', 'ecobox'),
                  'default'     => '#77bb97',
                  'validate'    => 'color',
                  'transparent' => false
                ),
                array(
                  'id'          => 'brand-secondary',
                  'type'        => 'color',
                  'title'       => __('Brand Secondary Color', 'ecobox'),
                  'subtitle'    => __('Pick a secondary color.', 'ecobox'),
                  'default'     => '#f7764d',
                  'validate'    => 'color',
                  'transparent' => false
                ),
                array(
                  'id'          => 'brand-tertiary',
                  'type'        => 'color',
                  'title'       => __('Brand Tertiary Color', 'ecobox'),
                  'subtitle'    => __('Pick a tertiary color.', 'ecobox'),
                  'default'     => '#bf5a68',
                  'validate'    => 'color',
                  'transparent' => false
                ),
                array(
                  'id'          => 'brand-quaternary',
                  'type'        => 'color',
                  'title'       => __('Brand Quaternary Color', 'ecobox'),
                  'subtitle'    => __('Pick a quaternary color.', 'ecobox'),
                  'default'     => '#ecede6',
                  'validate'    => 'color',
                  'transparent' => false,
                  'hint'        => array(
                    'content'   => __('Used for borders, rules, timeline borders, tags etc', 'ecobox'),
                  )
                ),
                array(
                  'id'          => 'brand-quinary',
                  'type'        => 'color',
                  'title'       => __('Brand Quinary Color', 'ecobox'),
                  'subtitle'    => __('Pick a quinary color.', 'ecobox'),
                  'default'     => '#fdfdfa',
                  'validate'    => 'color',
                  'transparent' => false,
                  'hint'        => array(
                    'content'   => __('Used for portfolio items borders, some of pricing tables backgrounds (bg), blog post bg, comments bg ', 'ecobox'),
                  )
                ),
                array(
                  'id'          => 'brand-bg',
                  'type'        => 'color',
                  'title'       => __('Brand Background Color', 'ecobox'),
                  'subtitle'    => __('Pick a brand background color.', 'ecobox'),
                  'default'     => '#f0f1e6',
                  'validate'    => 'color',
                  'transparent' => false,
                  'hint'        => array(
                    'content'   => __('Used for item\'s background (table, pagination, intro section shortcode)', 'ecobox'),
                  )
                ),

                array(
                  'id'    => 'opt-divide0',
                  'type'  => 'divide'
                ),

                array(
                  'id'          => 'body-bg',
                  'type'        => 'background',
                  'output'      => array('body'),
                  'title'       => __('Body Background', 'ecobox'),
                  'subtitle'    => __('Main background.', 'ecobox'),
                  'desc'        => __('Pick a background color. Also you can upload and set up background image.', 'ecobox'),
                  'preview'     => true,
                  'transparent' => false,
                  'default'     => array(
                    'background-color' => '#fbfcf0'
                  ),
                ),

                array(
                  'id'    => 'opt-divide1',
                  'type'  => 'divide'
                ),

                array(
                  'id'          => 'header-bg',
                  'type'        => 'background',
                  'output'      => array('.top-wrapper'),
                  'title'       => __('Header Background', 'ecobox'),
                  'subtitle'    => __('Header background used for non-retina devices.', 'ecobox'),
                  'preview'     => true,
                  'transparent' => false,
                  'default'     => array(
                    'background-color'      => '#926341',
                    'background-image'      => get_template_directory_uri() . '/images/pattern.png',
                    'background-repeat'     => 'repeat',
                    'background-position'   => 'left top',
                    'background-attachment' => 'fixed',
                    'background-size'       => 'inherit'
                  ),
                ),
                array(
                  'id'                => 'header-bg-retina-img-dimensions',
                  'type'              => 'dimensions',
                  'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                  'units_extended'    => 'false',
                  'title'             => __('Header Background Image Width/Height', 'ecobox'),
                  'subtitle'          => __('Set width/height in px.', 'ecobox'),
                  'desc'              => __('Please specify width/height of the header background image. This parameter needed if you use \'Header Background Image (Retina)\' option or want to have more control over your Header Background Image.'),
                  'default'           => array(
                      'width'     => 512, 
                      'height'    => 512,
                  )
                ),
                array(
                  'id'        => 'header-bg-retina-img',
                  'type'      => 'media',
                  'url'       => true,
                  'title'     => __('Header Background Image (Retina)', 'ecobox'),
                  'compiler'  => 'true',
                  //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                  'desc'      => __('Please choose an image file for the retina version of the header background.', 'ecobox'),
                  'subtitle'  => __('This pattern used for retina devices.', 'ecobox'),
                  'default'   => array(
                      'url'   => get_template_directory_uri() . '/images/retina/pattern@2x.png'),
                ),


                array(
                  'id'    => 'opt-divide2',
                  'type'  => 'divide'
                ),


                array(
                  'id'          => 'navbar-bg',
                  'type'        => 'color',
                  'title'       => __('Navbar Background Color', 'ecobox'),
                  'desc'        => __('Background Color for Navigation Bar.', 'ecobox'),
                  'default'     => '#fdffe8',
                  'validate'    => 'color',
                  'transparent' => false
                ),
                array(
                  'id'        => 'navbar-link-bg',
                  'type'      => 'link_color',
                  'title'     => __('Navbar Links Background Color', 'ecobox'),
                  'default'   => array(
                    'regular' => '#fdffe8',
                    'hover'   => '#f1f3dc',
                    'active'  => '#fdffe8'
                  )
                ),
                array(
                  'id'          => 'nav-dropdown-bg',
                  'type'        => 'color',
                  'title'       => __('Dropdown Menu Background Color', 'ecobox'),
                  'desc'        => __('Dropdown Menu appears when you hover on item that has child menu items.', 'ecobox'),
                  'default'     => '#180902',
                  'validate'    => 'color',
                  'transparent' => false
                ),
                array(
                  'id'        => 'nav-dropdown-link-color',
                  'type'      => 'link_color',
                  'title'     => __('Dropdown Menu Link Color', 'ecobox'),
                  'active'    => false,
                  'default'   => array(
                    'regular' => '#a2948e',
                    'hover'   => '#fdffe8'
                  )
                ),

                array(
                  'id'    => 'opt-divide3',
                  'type'  => 'divide'
                ),


                array(
                  'id'        => 'page-header-link-color',
                  'type'      => 'link_color',
                  'title'     => __('Breadcrumbs Color', 'ecobox'),
                  'active'    => false, // Disable Active Color
                  'default'   => array(
                    'regular'   => '#b9957b',
                    'hover'     => '#fdffe8'
                  )
                ),


                array(
                  'id'    => 'opt-divide4',
                  'type'  => 'divide'
                ),

                array(
                  'id'          => 'footer-bg',
                  'type'        => 'color',
                  'title'       => __('Footer Background Color', 'ecobox'),
                  'subtitle'    => __('Pick a Footer background color.', 'ecobox'),
                  'default'     => '#243029',
                  'validate'    => 'color',
                  'transparent' => false
                ),
                array(
                  'id'          => 'footer-text-color',
                  'type'        => 'color',
                  'title'       => __('Footer Text Color', 'ecobox'),
                  'subtitle'    => __('Pick a Footer text color.', 'ecobox'),
                  'default'     => '#96a39c',
                  'validate'    => 'color',
                  'transparent' => false
                ),
                array(
                  'id'        => 'footer-link-color',
                  'type'      => 'link_color',
                  'title'     => __('Footer Link Color', 'ecobox'),
                  'subtitle'  => __('Pick a Footer link color', 'ecobox'),
                  'active'    => false, // Disable Active Color
                  'default'   => array(
                    'regular' => '#5d7568',
                    'hover'   => '#77bb97'
                  )
                ),
                array(
                  'id'        => 'footer-btn-bg',
                  'type'      => 'link_color',
                  'title'     => __('Footer Button Background', 'ecobox'),
                  'subtitle'  => __('Pick a Footer Button Background color', 'ecobox'),
                  'active'    => false, // Disable Active Color
                  'default'   => array(
                    'regular' => '#3f5247',
                    'hover'   => '#77bb97'
                  )
                ),
                array(
                  'id'        => 'footer-btn-color',
                  'type'      => 'link_color',
                  'title'     => __('Footer Button Text Color', 'ecobox'),
                  'subtitle'  => __('Pick a Footer Button Color', 'ecobox'),
                  'active'    => false, // Disable Active Color
                  'default'   => array(
                    'regular' => '#fdffe8',
                    'hover'   => '#fdffe8'
                  )
                ),
                array(
                  'id'          => 'footer-hr-color',
                  'type'        => 'color',
                  'title'       => __('Footer Horizontal Rule Color', 'ecobox'),
                  'subtitle'    => __('Pick a Horizontal Rule Color.', 'ecobox'),
                  'desc'        => __('This rule is divides twitter widget and other 4 footer widgets.', 'ecobox'),
                  'default'     => '#3f5348',
                  'validate'    => 'color',
                  'transparent' => false
                ),
                array(
                  'id'          => 'copyright-bg',
                  'type'        => 'color',
                  'title'       => __('Copyright Background Color', 'ecobox'),
                  'subtitle'    => __('Pick a Copyright Background Color.', 'ecobox'),
                  'default'     => '#1c2721',
                  'validate'    => 'color',
                  'transparent' => false
                ),
                array(
                  'id'          => 'copyright-color',
                  'type'        => 'color',
                  'title'       => __('Copyright Text Color', 'ecobox'),
                  'subtitle'    => __('Pick a Copyright Text Color.', 'ecobox'),
                  'default'     => '#39443e',
                  'validate'    => 'color',
                  'transparent' => false
                ),
              )
            );




            // Custom CSS
            $this->sections[] = array(
              'title'     => __('Custom CSS', 'ecobox'),
              'icon'      => 'el-icon-css',
              'fields'    => array(
                array(
                  'id'        => 'ace-editor-css',
                  'type'      => 'ace_editor',
                  'title'     => __('CSS Code', 'ecobox'),
                  'subtitle'  => __('Paste your CSS code here.', 'ecobox'),
                  'mode'      => 'css',
                  'theme'     => 'monokai',
                  'desc'      => 'Any custom CSS can be added here, it will override the theme CSS.',
                  'default'   => ""
                ),
              )
            );

            $this->sections[] = array(
              'title'     => __('Import / Export', 'ecobox'),
              'desc'      => __('Import and Export your theme settings from file, text or URL.', 'ecobox'),
              'icon'      => 'el-icon-refresh',
              'fields'    => array(
                array(
                  'id'            => 'opt-import-export',
                  'type'          => 'import_export',
                  'title'         => 'Import Export',
                  'subtitle'      => 'Save and restore your theme options',
                  'full_width'    => false,
                ),
              ),
            );
            

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'ecobox') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'ecobox') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'ecobox') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'ecobox') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
              $this->sections['theme_docs'] = array(
                'icon'      => 'el-icon-list-alt',
                'title'     => __('Documentation', 'ecobox'),
                'fields'    => array(
                  array(
                    'id'        => '17',
                    'type'      => 'raw',
                    'markdown'  => true,
                    'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
                  ),
                ),
              );
            }                    

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
              $tabs['docs'] = array(
                'icon'      => 'el-icon-book',
                'title'     => __('Documentation', 'ecobox'),
                'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
              );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            // $this->args['help_tabs'][] = array(
            //     'id'        => 'redux-help-tab-1',
            //     'title'     => __('Theme Information 1', 'ecobox'),
            //     'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'ecobox')
            // );

            // $this->args['help_tabs'][] = array(
            //     'id'        => 'redux-help-tab-2',
            //     'title'     => __('Theme Information 2', 'ecobox'),
            //     'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'ecobox')
            // );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'ecobox');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

          $theme = wp_get_theme(); // For use with some settings. Not necessary.

          $this->args = array(
            'opt_name'              => 'ecobox_data',
            'page_slug'             => '_options',
            'page_title'            => 'Theme Options',
            'dev_mode'              => '0',
            'update_notice'         => '1',
            // 'intro_text'         => '',
            // 'footer_text'        => '',
            'admin_bar'             => '1',
            'menu_type'             => 'menu',
            'menu_title'            => 'Theme Options',
            'allow_sub_menu'        => '1',
            'page_parent_post_type' => 'your_post_type',
            'customizer'            => '1',
            'hints'                 => 
              array(
                'icon'          => 'el-icon-question-sign',
                'icon_position' => 'right',
                'icon_size'     => 'normal',
                'tip_style'     => array(
                  'color' => 'dark',
                ),
                'tip_position'  => array(
                  'my' => 'top left',
                  'at' => 'bottom right',
                ),
                'tip_effect'    =>  array(
                  'show' =>  array(
                    'duration' => '500',
                    'event'    => 'mouseover',
                  ),
                  'hide' =>  array(
                    'duration' => '500',
                    'event'    => 'mouseleave unfocus',
                  ),
                ),
              ),
            'output'               => '1',
            'output_tag'           => '1',
            'compiler'             => '1',
            'page_icon'            => 'icon-themes',
            'page_permissions'     => 'manage_options',
            'save_defaults'        => '1',
            'show_import_export'   => '1',
            'transient_time'       => '3600',
            'network_sites'        => '1',
          );

          $theme = wp_get_theme(); // For use with some settings. Not necessary.
          $this->args["display_name"]    = $theme->get("Name");
          $this->args["display_version"] = $theme->get("Version");

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new ecobox_Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('ecobox_my_custom_field')):
    function ecobox_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('ecobox_validate_callback_function')):
    function ecobox_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
