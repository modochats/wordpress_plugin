<?php
/**
 * Plugin Name: Modo Chatbot
 * Plugin URI: https://github.com/modochats/wordpress_plugin
 * Description: Add Modo AI chatbot to your WordPress website with easy configuration and customization options.
 * Version: 1.0.0
 * Author: Modo Chats
 * Author URI: https://modochats.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: modo-chatbot
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants (only if not already defined)
if (!defined('MODO_CHATBOT_VERSION')) {
    define('MODO_CHATBOT_VERSION', '1.0.0');
}
if (!defined('MODO_CHATBOT_PLUGIN_URL')) {
    define('MODO_CHATBOT_PLUGIN_URL', plugin_dir_url(__FILE__));
}
if (!defined('MODO_CHATBOT_PLUGIN_PATH')) {
    define('MODO_CHATBOT_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

if (!class_exists('ModoChatbot')) {
class ModoChatbot {
    
    public function __construct() {
        
        try {
            // Start output buffering to prevent header issues
            if (!headers_sent()) {
                ob_start();
            }
            
            add_action('init', array($this, 'init'));
            add_action('admin_menu', array($this, 'add_admin_menu'));
            add_action('admin_init', array($this, 'admin_init'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
            add_action('wp_footer', array($this, 'add_chatbot_widget'));
            add_action('wp_ajax_modo_save_settings', array($this, 'save_settings'));
            add_action('wp_ajax_modo_test_connection', array($this, 'test_connection'));
            add_action('wp_ajax_modo_test_js_file', array($this, 'test_js_file'));
            
            // Plugin activation/deactivation hooks
            register_activation_hook(__FILE__, array($this, 'activate'));
            register_deactivation_hook(__FILE__, array($this, 'deactivate'));
            
        } catch (Exception $e) {
            // Silent error handling
        }
    }
    
    public function init() {
        // Load RTL support for Persian
        if (is_rtl()) {
            add_action('wp_enqueue_scripts', array($this, 'enqueue_rtl_styles'));
        }
    }
    
    public function activate() {
        // Set default options
        $default_options = array(
            'chatbot_key' => '',
            'js_file_path' => 'https://cdn.jsdelivr.net/gh/modochats/webcomponent@latest/cdn-dist/modo-web-component.min.js',
            'position' => 'right',
            'theme' => 'dark',
            'primary_color' => '#667eea',
            'title' => 'Modo',
            'enabled' => false
        );
        
        add_option('modo_chatbot_options', $default_options);
    }
    
    public function deactivate() {
        // Clean up if needed
    }
    
    public function add_admin_menu() {
        
        add_options_page(
            __('Modo Chatbot Settings', 'modo-chatbot'),
            __('Modo Chatbot', 'modo-chatbot'),
            'manage_options',
            'modo-chatbot',
            array($this, 'admin_page')
        );
        
        // Also add a top-level menu for better visibility
        add_menu_page(
            __('Modo Chatbot', 'modo-chatbot'),
            __('Modo Chatbot', 'modo-chatbot'),
            'manage_options',
            'modo-chatbot-main',
            array($this, 'admin_page'),
            'dashicons-format-chat',
            30
        );
        
    }
    
    public function admin_init() {
        register_setting('modo_chatbot_options', 'modo_chatbot_options', array($this, 'validate_options'));
    }
    
    public function validate_options($input) {
        $output = array();
        
        // Unslash the input data
        $input = wp_unslash($input);
        
        $output['chatbot_key'] = sanitize_text_field($input['chatbot_key']);
        $output['js_file_path'] = esc_url_raw($input['js_file_path']);
        $output['position'] = in_array($input['position'], array('left', 'right')) ? $input['position'] : 'right';
        $output['theme'] = in_array($input['theme'], array('light', 'dark')) ? $input['theme'] : 'dark';
        $output['primary_color'] = sanitize_hex_color($input['primary_color']);
        $output['title'] = sanitize_text_field($input['title']);
        $output['enabled'] = isset($input['enabled']) ? (bool) $input['enabled'] : false;
        
        return $output;
    }
    
    public function enqueue_rtl_styles() {
        // Add RTL support for Persian language
        wp_add_inline_style('wp-admin', '
            .modo-admin-container {
                direction: rtl;
            }
            .modo-admin-main {
                text-align: right;
            }
            .form-table th {
                text-align: right;
            }
            .modo-widget-preview,
            .modo-help,
            .modo-debug {
                text-align: right;
            }
        ');
    }
    
    public function enqueue_scripts() {
        $options = get_option('modo_chatbot_options');
        
        
        if (!$options['enabled']) {
            return;
        }
        
        if (empty($options['chatbot_key'])) {
            return;
        }
        
        if (empty($options['js_file_path'])) {
            return;
        }
        
        // Enqueue the custom Modo widget script
        wp_enqueue_script(
            'modo-widget',
            $options['js_file_path'],
            array(),
            MODO_CHATBOT_VERSION,
            true
        );
        
        // Add inline script with configuration
        wp_add_inline_script('modo-widget', $this->get_widget_config_script($options), 'before');
        
    }
    
    private function get_widget_config_script($options) {
        
        try {
            $script = 'document.addEventListener("DOMContentLoaded", function() {';
            $script .= 'const chat = new ModoChat("' . esc_js($options['chatbot_key']) . '", {';
            $script .= 'position: "' . esc_js($options['position']) . '",';
            $script .= 'theme: "' . esc_js($options['theme']) . '",';
            $script .= 'primaryColor: "' . esc_js($options['primary_color']) . '",';
            $script .= 'title: "' . esc_js($options['title']) . '"';
            $script .= '});';
            $script .= '});';
            
            
            return $script;
        } catch (Exception $e) {
            return 'console.error("Modo Chatbot: Script generation failed");';
        }
    }
    
    public function add_chatbot_widget() {
        $options = get_option('modo_chatbot_options');
        
        if (!$options['enabled'] || empty($options['chatbot_key'])) {
            return;
        }
        
        // The widget will be automatically loaded by the modo-widget.js script
        // No additional HTML needed as the script creates the widget dynamically
    }
    
    public function admin_page() {
        $options = get_option('modo_chatbot_options');
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Modo Chatbot Settings', 'modo-chatbot'); ?></h1>
            
            <div class="modo-admin-container">
                <div class="modo-admin-main">
                    <form method="post" action="options.php" id="modo-settings-form">
                        <?php settings_fields('modo_chatbot_options'); ?>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="enabled"><?php esc_html_e('Enable Chatbot', 'modo-chatbot'); ?></label>
                                </th>
                                <td>
                                    <input type="checkbox" id="enabled" name="modo_chatbot_options[enabled]" value="1" <?php checked($options['enabled'], 1); ?> />
                                    <p class="description"><?php esc_html_e('Enable or disable the chatbot widget on your website.', 'modo-chatbot'); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="chatbot_key"><?php esc_html_e('Chatbot Key', 'modo-chatbot'); ?> <span class="required">*</span></label>
                                </th>
                                <td>
                                    <input type="text" id="chatbot_key" name="modo_chatbot_options[chatbot_key]" value="<?php echo esc_attr($options['chatbot_key']); ?>" class="regular-text" required />
                                    <p class="description"><?php esc_html_e('Your unique chatbot identifier from Modo dashboard.', 'modo-chatbot'); ?></p>
                                    <button type="button" id="test-connection" class="button button-secondary"><?php esc_html_e('Test Connection', 'modo-chatbot'); ?></button>
                                    <span id="connection-status"></span>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="js_file_path"><?php esc_html_e('JavaScript File Path', 'modo-chatbot'); ?> <span class="required">*</span></label>
                                </th>
                                <td>
                                    <input type="url" id="js_file_path" name="modo_chatbot_options[js_file_path]" value="<?php echo esc_attr($options['js_file_path']); ?>" class="regular-text" required />
                                    <p class="description"><?php esc_html_e('URL to your Modo widget JavaScript file (e.g., https://yoursite.com/modo-widget.js).', 'modo-chatbot'); ?></p>
                                    <button type="button" id="test-js-file" class="button button-secondary"><?php esc_html_e('Test JS File', 'modo-chatbot'); ?></button>
                                    <span id="js-file-status"></span>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="title"><?php esc_html_e('Chatbot Title', 'modo-chatbot'); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="title" name="modo_chatbot_options[title]" value="<?php echo esc_attr($options['title']); ?>" class="regular-text" />
                                    <p class="description"><?php esc_html_e('Title displayed in the chat header.', 'modo-chatbot'); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="position"><?php esc_html_e('Button Position', 'modo-chatbot'); ?></label>
                                </th>
                                <td>
                                    <select id="position" name="modo_chatbot_options[position]">
                                        <option value="right" <?php selected($options['position'], 'right'); ?>><?php esc_html_e('Right', 'modo-chatbot'); ?></option>
                                        <option value="left" <?php selected($options['position'], 'left'); ?>><?php esc_html_e('Left', 'modo-chatbot'); ?></option>
                                    </select>
                                    <p class="description"><?php esc_html_e('Position of the floating chat button.', 'modo-chatbot'); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="theme"><?php esc_html_e('Theme', 'modo-chatbot'); ?></label>
                                </th>
                                <td>
                                    <select id="theme" name="modo_chatbot_options[theme]">
                                        <option value="dark" <?php selected($options['theme'], 'dark'); ?>><?php esc_html_e('Dark', 'modo-chatbot'); ?></option>
                                        <option value="light" <?php selected($options['theme'], 'light'); ?>><?php esc_html_e('Light', 'modo-chatbot'); ?></option>
                                    </select>
                                    <p class="description"><?php esc_html_e('Color theme for the chat interface.', 'modo-chatbot'); ?></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="primary_color"><?php esc_html_e('Primary Color', 'modo-chatbot'); ?></label>
                                </th>
                                <td>
                                    <input type="color" id="primary_color" name="modo_chatbot_options[primary_color]" value="<?php echo esc_attr($options['primary_color']); ?>" />
                                    <p class="description"><?php esc_html_e('Primary color for the chat interface and floating button.', 'modo-chatbot'); ?></p>
                                </td>
                            </tr>
                        </table>
                        
                        <?php submit_button(); ?>
                    </form>
                </div>
                
                <div class="modo-admin-sidebar">
                    <div class="modo-widget-preview">
                        <h3><?php esc_html_e('Preview', 'modo-chatbot'); ?></h3>
                        <div id="preview-container">
                            <div class="preview-chatbot" id="preview-chatbot">
                                <div class="preview-button"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modo-help">
                        <h3><?php esc_html_e('Need Help?', 'modo-chatbot'); ?></h3>
                        <p><?php esc_html_e('Get your Chatbot Key from your Modo dashboard.', 'modo-chatbot'); ?></p>
                        <p><a href="https://modochats.com" target="_blank" class="button button-primary"><?php esc_html_e('Visit Modo Dashboard', 'modo-chatbot'); ?></a></p>
                    </div>
                    
                    <div class="modo-debug">
                        <h3><?php esc_html_e('Debug Information', 'modo-chatbot'); ?></h3>
                        <div class="debug-info">
                            <p><strong><?php esc_html_e('Plugin Status:', 'modo-chatbot'); ?></strong> 
                                <?php echo $options['enabled'] ? '<span style="color: green;">✓ Enabled</span>' : '<span style="color: red;">✗ Disabled</span>'; ?>
                            </p>
                            <p><strong><?php esc_html_e('Chatbot Key:', 'modo-chatbot'); ?></strong> 
                                <?php echo !empty($options['chatbot_key']) ? '<span style="color: green;">✓ Set</span>' : '<span style="color: red;">✗ Not Set</span>'; ?>
                            </p>
                            <p><strong><?php esc_html_e('JS File Path:', 'modo-chatbot'); ?></strong> 
                                <?php echo !empty($options['js_file_path']) ? '<span style="color: green;">✓ Set</span>' : '<span style="color: red;">✗ Not Set</span>'; ?>
                            </p>
                            <p><strong><?php esc_html_e('WordPress Version:', 'modo-chatbot'); ?></strong> <?php echo esc_html(get_bloginfo('version')); ?></p>
                            <p><strong><?php esc_html_e('PHP Version:', 'modo-chatbot'); ?></strong> <?php echo esc_html(PHP_VERSION); ?></p>
                            <p><strong><?php esc_html_e('Current Theme:', 'modo-chatbot'); ?></strong> <?php echo esc_html(wp_get_theme()->get('Name')); ?></p>
                            <p><strong><?php esc_html_e('Scripts Enqueued:', 'modo-chatbot'); ?></strong> 
                                <?php 
                                // Check if scripts would be enqueued based on current settings
                                $would_enqueue = $options['enabled'] && !empty($options['chatbot_key']) && !empty($options['js_file_path']);
                                echo $would_enqueue ? '<span style="color: green;">✓ Yes (will load on frontend)</span>' : '<span style="color: red;">✗ No (check configuration above)</span>'; 
                                ?>
                            </p>
                        </div>
                        <button type="button" id="refresh-debug" class="button button-secondary"><?php esc_html_e('Refresh Debug Info', 'modo-chatbot'); ?></button>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
        .modo-admin-container {
            display: flex;
            gap: 20px;
        }
        
        .modo-admin-main {
            flex: 2;
        }
        
        .modo-admin-sidebar {
            flex: 1;
        }
        
        .modo-widget-preview,
        .modo-help,
        .modo-debug {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .modo-debug {
            background: #f9f9f9;
            border-left: 4px solid #0073aa;
        }
        
        .debug-info p {
            margin: 8px 0;
            font-size: 13px;
        }
        
        .modo-widget-preview h3,
        .modo-help h3 {
            margin-top: 0;
        }
        
        #preview-container {
            position: relative;
            height: 200px;
            background: #f0f0f1;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .preview-chatbot {
            position: relative;
            width: 100%;
            height: 100%;
        }
        
        .preview-button {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .preview-button::after {
            content: '💬';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
        }
        
        .required {
            color: #d63638;
        }
        
        #connection-status {
            margin-left: 10px;
            font-weight: bold;
        }
        
        .connection-success {
            color: #00a32a;
        }
        
        .connection-error {
            color: #d63638;
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            // Update preview when settings change
            function updatePreview() {
                const position = $('#position').val();
                const color = $('#primary_color').val();
                const $button = $('.preview-button');
                
                $button.css({
                    [position]: '20px',
                    background: `linear-gradient(135deg, ${color} 0%, #764ba2 100%)`
                });
            }
            
            $('#position, #primary_color').on('change', updatePreview);
            updatePreview();
            
            // Test connection
            $('#test-connection').on('click', function() {
                const chatbotKey = $('#chatbot_key').val();
                const $status = $('#connection-status');
                const $button = $(this);
                
                if (!chatbotKey) {
                    $status.html('<span class="connection-error">Please enter a chatbot key</span>');
                    return;
                }
                
                $button.prop('disabled', true).text('Testing...');
                $status.html('<span>Testing connection...</span>');
                
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'modo_test_connection',
                        chatbot_key: chatbotKey,
                        nonce: '<?php echo esc_js(wp_create_nonce('modo_test_connection')); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            $status.html('<span class="connection-success">✓ Connection successful</span>');
                        } else {
                            $status.html('<span class="connection-error">✗ Connection failed: ' + response.data + '</span>');
                        }
                    },
                    error: function() {
                        $status.html('<span class="connection-error">✗ Connection failed</span>');
                    },
                    complete: function() {
                        $button.prop('disabled', false).text('Test Connection');
                    }
                });
            });
            
            // Test JS file
            $('#test-js-file').on('click', function() {
                const jsFilePath = $('#js_file_path').val();
                const $status = $('#js-file-status');
                const $button = $(this);
                
                if (!jsFilePath) {
                    $status.html('<span class="connection-error">Please enter a JS file path</span>');
                    return;
                }
                
                $button.prop('disabled', true).text('Testing...');
                $status.html('<span>Testing JS file...</span>');
                
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'modo_test_js_file',
                        js_file_path: jsFilePath,
                        nonce: '<?php echo esc_js(wp_create_nonce('modo_test_js_file')); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            $status.html('<span class="connection-success">✓ JS file accessible</span>');
                        } else {
                            $status.html('<span class="connection-error">✗ JS file not accessible: ' + response.data + '</span>');
                        }
                    },
                    error: function() {
                        $status.html('<span class="connection-error">✗ JS file test failed</span>');
                    },
                    complete: function() {
                        $button.prop('disabled', false).text('Test JS File');
                    }
                });
            });
            
            // Refresh debug info
            $('#refresh-debug').on('click', function() {
                location.reload();
            });
        });
        </script>
        <?php
    }
    
    public function save_settings() {
        check_ajax_referer('modo_save_settings', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        
        $options = $this->validate_options(isset($_POST['options']) ? $_POST['options'] : array());
        update_option('modo_chatbot_options', $options);
        
        wp_send_json_success('Settings saved successfully');
    }
    
    public function test_connection() {
        check_ajax_referer('modo_test_connection', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        
        $chatbot_key = sanitize_text_field(isset($_POST['chatbot_key']) ? wp_unslash($_POST['chatbot_key']) : '');
        
        if (empty($chatbot_key)) {
            wp_send_json_error('Chatbot key is required');
        }
        
        $url = 'https://api.modochats.com/v1/chatbot/public/' . $chatbot_key;
        $response = wp_remote_get($url);
        
        if (is_wp_error($response)) {
            wp_send_json_error('Failed to connect to Modo API');
        }
        
        $status_code = wp_remote_retrieve_response_code($response);
        
        if ($status_code === 200) {
            wp_send_json_success('Connection successful');
        } else {
            wp_send_json_error('Invalid chatbot key or API error');
        }
    }
    
    public function test_js_file() {
        check_ajax_referer('modo_test_js_file', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        
        $js_file_path = esc_url_raw(isset($_POST['js_file_path']) ? wp_unslash($_POST['js_file_path']) : '');
        
        if (empty($js_file_path)) {
            wp_send_json_error('JS file path is required');
        }
        
        // Validate URL format
        if (!filter_var($js_file_path, FILTER_VALIDATE_URL)) {
            wp_send_json_error('Invalid URL format');
        }
        
        // Test if the file is accessible
        $response = wp_remote_head($js_file_path);
        
        if (is_wp_error($response)) {
            wp_send_json_error('Failed to access JS file: ' . $response->get_error_message());
        }
        
        $status_code = wp_remote_retrieve_response_code($response);
        $content_type = wp_remote_retrieve_header($response, 'content-type');
        
        if ($status_code === 200) {
            // Check if it's a JavaScript file
            if (strpos($content_type, 'javascript') !== false || strpos($content_type, 'text/plain') !== false || substr($js_file_path, -3) === '.js') {
                wp_send_json_success('JS file is accessible');
            } else {
                wp_send_json_error('File does not appear to be a JavaScript file');
            }
        } else {
            wp_send_json_error('JS file not accessible (HTTP ' . $status_code . ')');
        }
    }
} // End of ModoChatbot class
} // End of if (!class_exists('ModoChatbot'))

// Initialize the plugin
if (class_exists('ModoChatbot')) {
    new ModoChatbot();
}
