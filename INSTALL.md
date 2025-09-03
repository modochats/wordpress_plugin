# Installation Guide - Modo Chatbot WordPress Plugin

## Quick Installation

### Method 1: Upload Plugin Files (Recommended)

1. **Download the plugin files**
   - Download the `modo-chatbot-wp-plugin` folder
   - Ensure all files are included (main plugin file, etc.)

2. **Upload to WordPress**
   - Access your WordPress admin dashboard
   - Go to `Plugins > Add New > Upload Plugin`
   - Choose the `modo-chatbot-wp-plugin.zip` file
   - Click "Install Now"

3. **Activate the plugin**
   - After installation, click "Activate Plugin"
   - The plugin will be ready to configure

### Method 2: Manual Upload via FTP

1. **Upload files via FTP**
   - Connect to your website via FTP
   - Navigate to `/wp-content/plugins/`
   - Upload the entire `modo-chatbot-wp-plugin` folder

2. **Activate in WordPress**
   - Go to `Plugins > Installed Plugins`
   - Find "Modo Chatbot" and click "Activate"

## Configuration Steps

### Step 1: Get Your Chatbot Key

1. Visit [Modo Dashboard](https://modochats.com)
2. Sign in to your account
3. Create a new chatbot or select an existing one
4. Copy the unique chatbot key (UUID format)

### Step 2: Set Up Your JavaScript File

1. **Upload your modo-widget.js file**
   - Upload the `modo-widget.js` file to your website or CDN
   - Make sure it's publicly accessible
   - Note the full URL to the file

2. **Verify the file is accessible**
   - Test the URL in your browser
   - Ensure it returns the JavaScript content

### Step 3: Configure the Plugin

1. **Access Settings**
   - Go to `Settings > Modo Chatbot` in WordPress admin
   - You'll see the configuration panel

2. **Basic Configuration**
   - ✅ Check "Enable Chatbot"
   - 🔑 Enter your Chatbot Key
   - 📁 Enter your JavaScript File Path (URL to modo-widget.js)
   - 🎨 Choose your preferred settings:
     - Button Position: Left or Right
     - Theme: Light or Dark
     - Button Color: Custom color picker
     - Title: Custom chatbot name

3. **Test Configuration**
   - Click "Test Connection" to verify your chatbot key
   - Click "Test JS File" to verify your JavaScript file is accessible
   - You should see "✓ Connection successful" and "✓ JS file accessible"

4. **Save Settings**
   - Click "Save Changes"
   - The chatbot will now appear on your website

## Verification

### Check Frontend
1. Visit your website's frontend
2. Look for the floating chat button (bottom-right or bottom-left)
3. Click the button to open the chat interface
4. Verify starter messages appear
5. Test sending a message

### Check Admin Panel
1. Go to `Settings > Modo Chatbot`
2. Verify all settings are saved correctly
3. Use the preview to see how the button will look

## Troubleshooting

### Plugin Not Appearing
- Check if plugin is activated in `Plugins > Installed Plugins`
- Verify file permissions are correct (755 for folders, 644 for files)

### Chatbot Not Showing
- Ensure "Enable Chatbot" is checked
- Verify chatbot key is correct
- Verify JavaScript file path is correct and accessible
- Test connection using the "Test Connection" button
- Test JS file using the "Test JS File" button
- Check browser console for JavaScript errors

### Connection Issues
- Verify your domain is allowed in Modo dashboard
- Check if your hosting blocks external API calls
- Ensure chatbot key is valid and active

### JavaScript File Issues
- Verify the JS file URL is correct and accessible
- Check if the file is actually a JavaScript file
- Ensure the file is not blocked by CORS policies
- Test the URL directly in your browser

### Styling Issues
- Try switching between light/dark themes
- Check for CSS conflicts with your theme
- Clear any caching plugins

## Support

If you encounter issues:

1. **Check the FAQ** in the plugin settings
2. **Test Connection** to verify API connectivity
3. **Test JS File** to verify JavaScript file accessibility
4. **Review Browser Console** for JavaScript errors
5. **Contact Support** at [Modo Dashboard](https://modochats.com)

## Next Steps

After successful installation:

1. **Customize Appearance** - Adjust colors, position, and theme
2. **Configure Chatbot** - Set up responses and starter messages in Modo dashboard
3. **Monitor Usage** - Track conversations and user interactions
4. **Optimize Performance** - Ensure fast loading and smooth user experience

---

**Need Help?** Visit [Modo Dashboard](https://modochats.com) for comprehensive documentation and support.
