# Modo Chatbot WordPress Plugin

A powerful WordPress plugin that integrates Modo AI chatbot into your website with easy configuration and customization options.

## Features

- 🚀 **Easy Installation**: Simple plugin installation and activation
- ⚙️ **Admin Interface**: User-friendly admin panel for configuration
- 🎨 **Customizable**: Choose button position, colors, and themes
- 📱 **Responsive**: Works perfectly on desktop and mobile devices
- 🔗 **API Integration**: Connects to Modo's powerful AI chatbot API
- 💬 **Starter Messages**: Displays starter messages when chatbot loads
- 🌐 **Multi-language**: Supports multiple languages and RTL layouts

## Installation

1. Download the plugin files
2. Upload the `modo-chatbot-wp-plugin` folder to your `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Go to Settings > Modo Chatbot to configure your chatbot

## Configuration

### Getting Your Chatbot Key

1. Visit [Modo Dashboard](https://modochats.com)
2. Create or select your chatbot
3. Copy your unique chatbot key from the dashboard
4. Paste it in the WordPress admin settings

### Setting Up Your JavaScript File

1. Upload your `modo-widget.js` file to your website or CDN
2. Get the full URL to the JavaScript file
3. Enter the URL in the "JavaScript File Path" field
4. Use the "Test JS File" button to verify the file is accessible

### Settings Options

- **Enable Chatbot**: Turn the chatbot on/off
- **Chatbot Key**: Your unique identifier from Modo dashboard
- **JavaScript File Path**: URL to your Modo widget JavaScript file
- **Chatbot Title**: Custom title displayed in chat header
- **Button Position**: Left or right side of the screen
- **Theme**: Light or dark theme for the chat interface
- **Button Color**: Custom color for the floating chat button

## Usage

Once configured, the chatbot will automatically appear on all pages of your website as a floating button. Users can:

- Click the button to open the chat interface
- See starter messages when the chat loads
- Send messages and receive AI responses
- Start new conversations
- View chat history

## API Integration

The plugin integrates with Modo's API endpoints:

- `GET /chatbot/public/{unique_id}` - Fetches chatbot configuration
- `POST /conversations/webchat/send-message` - Sends messages
- `GET /conversations/webchat/{chatbot_id}/{conversation_id}/history` - Loads chat history

## Customization

### CSS Customization

You can customize the chatbot appearance by adding CSS to your theme:

```css
/* Customize button position */
#modo-widget .floating-chat-button {
    bottom: 30px !important;
    right: 30px !important;
}

/* Customize chat window size */
#modo-widget .chat-screen {
    width: 400px !important;
    height: 600px !important;
}
```

### JavaScript Hooks

The plugin provides JavaScript hooks for advanced customization:

```javascript
// Listen for chat events
document.addEventListener('modoChatOpened', function() {
    console.log('Chat opened');
});

document.addEventListener('modoChatClosed', function() {
    console.log('Chat closed');
});
```

## Troubleshooting

### Chatbot Not Appearing

1. Check if the plugin is activated
2. Verify the chatbot key is correct
3. Test the connection using the "Test Connection" button
4. Check browser console for JavaScript errors

### Connection Issues

1. Ensure your website domain is allowed in Modo dashboard
2. Check if your hosting provider blocks external API calls
3. Verify the chatbot key is valid and active

### Styling Issues

1. Check for CSS conflicts with your theme
2. Try switching between light and dark themes
3. Clear any caching plugins

## Support

For support and documentation:

- Visit [Modo Dashboard](https://modochats.com)
- Check the plugin settings page for connection testing
- Review browser console for error messages

## Changelog

### Version 1.0.0
- Initial release
- Basic chatbot integration
- Admin configuration panel
- Responsive design
- Starter messages support
- API integration

## License

This plugin is licensed under the GPL v2 or later.

## Credits

Developed by [Modo Chats](https://modochats.com) - AI-powered chatbot solutions.
