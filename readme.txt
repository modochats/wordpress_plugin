=== Modo Chatbot ===
Contributors: modochats
Tags: chatbot, ai, chat, customer support, live chat
Requires at least: 5.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add Modo AI chatbot to your WordPress website with easy configuration and customization options.

== Description ==

A powerful WordPress plugin that integrates Modo AI chatbot into your website with easy configuration and customization options.

= Features =

* Easy Installation: Simple plugin installation and activation
* Admin Interface: User-friendly admin panel for configuration
* Customizable: Choose button position, colors, and themes
* Responsive: Works perfectly on desktop and mobile devices
* API Integration: Connects to Modo's powerful AI chatbot API
* Multi-language: Supports multiple languages and RTL layouts

= Installation =

1. Download the plugin files
2. Upload the `modo-chatbot-wp-plugin` folder to your `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Go to Settings > Modo Chatbot to configure your chatbot

= Configuration =

Getting Your Chatbot Key:

1. Visit [Modo Dashboard](https://modochats.com)
2. Create or select your chatbot
3. Copy your unique chatbot key from the dashboard
4. Paste it in the WordPress admin settings

Setting Up Your JavaScript File:

**Default CDN (Recommended):**
Use the official Modo CDN for the latest version:
`https://cdn.jsdelivr.net/gh/modochats/webcomponent@latest/cdn-dist/modo-web-component.min.js`

**Custom JavaScript File:**
1. Upload your `modo-widget.js` file to your website or CDN
2. Get the full URL to the JavaScript file
3. Enter the URL in the "JavaScript File Path" field
4. Use the "Test JS File" button to verify the file is accessible

= Settings Options =

* **Enable Chatbot**: Turn the chatbot on/off
* **Chatbot Key**: Your unique identifier from Modo dashboard
* **JavaScript File Path**: URL to your Modo widget JavaScript file
* **Chatbot Title**: Custom title displayed in chat header
* **Button Position**: Left or right side of the screen
* **Theme**: Light or dark theme for the chat interface
* **Primary Color**: Custom primary color for the chat interface and floating button

= Usage =

Once configured, the chatbot will automatically appear on all pages of your website as a floating button. Users can:

* Click the button to open the chat interface
* Send messages and receive AI responses
* Start new conversations
* View chat history

= Troubleshooting =

**Chatbot Not Appearing:**

1. Check if the plugin is activated
2. Verify the chatbot key is correct
3. Test the connection using the "Test Connection" button
4. Check browser console for JavaScript errors

**Connection Issues:**

1. Ensure your website domain is allowed in Modo dashboard
2. Check if your hosting provider blocks external API calls
3. Verify the chatbot key is valid and active

= Support =

For support and documentation:

* Visit [Modo Dashboard](https://modochats.com)
* Check the plugin settings page for connection testing
* Review browser console for error messages

= Changelog =

= 1.0.0 =
* Initial release
* Modern JavaScript component integration
* Admin configuration panel with live preview
* Support for left/right positioning
* Light/dark theme options
* Custom primary color configuration
* CDN integration for easy setup
* Conflict prevention and error handling

== Screenshots ==

1. Admin settings page with configuration options
2. Live preview of chatbot widget
3. Debug information panel
4. Frontend chatbot widget in action

== Upgrade Notice ==

= 1.0.0 =
Initial release of Modo Chatbot WordPress plugin.
