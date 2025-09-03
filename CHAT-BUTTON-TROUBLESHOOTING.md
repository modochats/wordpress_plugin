# Chat Button Not Appearing - Troubleshooting Guide

## Quick Checklist

Before diving into detailed troubleshooting, check these common issues:

- [ ] Plugin is **enabled** in settings
- [ ] **Chatbot Key** is entered and valid
- [ ] **JavaScript File Path** is entered and accessible
- [ ] All settings are **saved** after configuration
- [ ] You're viewing the **frontend** (not admin) of your website
- [ ] **Cache is cleared** (if using caching plugins)

## Step-by-Step Troubleshooting

### Step 1: Check Plugin Configuration

1. **Go to Plugin Settings**
   - Navigate to `Modo Chatbot` in your WordPress admin
   - Or go to `Settings > Modo Chatbot`

2. **Verify All Required Fields**
   - ✅ **Enable Chatbot**: Must be checked
   - 🔑 **Chatbot Key**: Must be filled (test with "Test Connection")
   - 📁 **JavaScript File Path**: Must be filled (test with "Test JS File")
   - 🎨 **Other Settings**: Position, theme, color, title

3. **Use Debug Information**
   - Look at the "Debug Information" section in the plugin settings
   - All items should show green checkmarks (✓)
   - If any show red X (✗), fix those issues first

### Step 2: Test Your JavaScript File

1. **Verify JS File Accessibility**
   - Click "Test JS File" button in plugin settings
   - Should show "✓ JS file accessible"
   - If it fails, check the file URL and permissions

2. **Test JS File Directly**
   - Open your JavaScript file URL in a browser
   - Should show JavaScript code (not HTML error page)
   - File should end with `.js` extension

3. **Check File Content**
   - Ensure your `modo-widget.js` file contains the complete widget code
   - File should not be empty or corrupted

### Step 3: Check Browser Console

1. **Open Browser Developer Tools**
   - Press `F12` or right-click → "Inspect"
   - Go to "Console" tab

2. **Look for Errors**
   - Check for JavaScript errors (red text)
   - Look for "Modo" or "modo-widget" related errors
   - Check for 404 errors (file not found)

3. **Check Network Tab**
   - Go to "Network" tab
   - Refresh your website
   - Look for your JavaScript file loading
   - Should show status 200 (success)

### Step 4: Verify WordPress Script Loading

1. **Check if Scripts are Enqueued**
   - In plugin settings, look at "Debug Information"
   - "Scripts Enqueued" should show "✓ Yes"
   - If "✗ No", there's a configuration issue

2. **View Page Source**
   - Right-click on your website → "View Page Source"
   - Search for "modo-widget" or your JS file name
   - Should find the script tag loading your file

### Step 5: Check Theme Compatibility

1. **Switch to Default Theme**
   - Temporarily switch to a default WordPress theme (Twenty Twenty-Four)
   - Check if chat button appears
   - If yes, your theme might be interfering

2. **Check Theme Functions**
   - Some themes remove `wp_footer()` or `wp_head()`
   - Chat button needs these to load properly
   - Contact theme developer if missing

### Step 6: Check for Plugin Conflicts

1. **Deactivate Other Plugins**
   - Go to `Plugins > Installed Plugins`
   - Deactivate all plugins except Modo Chatbot
   - Check if chat button appears
   - If yes, reactivate plugins one by one to find conflict

2. **Common Conflicting Plugins**
   - Caching plugins (WP Rocket, W3 Total Cache)
   - Security plugins (Wordfence, Sucuri)
   - Minification plugins
   - CDN plugins

### Step 7: Check Caching Issues

1. **Clear All Caches**
   - Clear WordPress cache (if using caching plugin)
   - Clear browser cache (Ctrl+F5 or Cmd+Shift+R)
   - Clear CDN cache (if using CDN)

2. **Disable Caching Temporarily**
   - Temporarily disable caching plugins
   - Check if chat button appears
   - If yes, configure cache to exclude your JS file

### Step 8: Check File Permissions

1. **Verify JavaScript File Permissions**
   - Ensure your JS file is publicly accessible
   - Check file permissions (should be 644)
   - Test file URL in incognito/private browser window

2. **Check WordPress File Permissions**
   - Ensure WordPress can read plugin files
   - Check `/wp-content/plugins/` permissions

### Step 9: Enable WordPress Debug Mode

1. **Enable Debug Logging**
   - Edit `wp-config.php` file
   - Add these lines:
   ```php
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   ```

2. **Check Debug Log**
   - Look in `/wp-content/debug.log`
   - Search for "Modo Chatbot" entries
   - Look for any error messages

### Step 10: Manual Testing

1. **Test with Simple HTML**
   - Create a simple test page with just your JS file
   - Add the configuration script manually
   - See if chat button appears

2. **Test JavaScript File**
   - Open browser console
   - Type: `console.log(window.modoConfig)`
   - Should show your configuration object

## Common Error Messages and Solutions

### "Scripts Enqueued: ✗ No"
**Solution:** Check that all required fields are filled and plugin is enabled

### "JS file not accessible"
**Solution:** Verify the JavaScript file URL is correct and file exists

### "Connection failed"
**Solution:** Check your chatbot key and ensure it's valid

### JavaScript Errors in Console
**Solution:** Check your JavaScript file for syntax errors

### 404 Error for JS File
**Solution:** Verify the file path and ensure file is uploaded correctly

## Still Not Working?

If the chat button still doesn't appear:

1. **Check Debug Information** in plugin settings
2. **Enable WordPress Debug Mode** and check logs
3. **Test with Default Theme** and no other plugins
4. **Verify JavaScript File** is complete and error-free
5. **Contact Support** with:
   - WordPress version
   - PHP version
   - Theme name
   - List of active plugins
   - Debug information from plugin settings
   - Browser console errors (if any)

## Quick Fixes to Try

1. **Save Settings Again**: Go to plugin settings and click "Save Changes"
2. **Clear Cache**: Clear all caches (WordPress, browser, CDN)
3. **Test JS File**: Use "Test JS File" button to verify accessibility
4. **Check Frontend**: Make sure you're viewing the website frontend, not admin
5. **Refresh Page**: Hard refresh the page (Ctrl+F5 or Cmd+Shift+R)

---

**Need More Help?** Visit [Modo Dashboard](https://modochats.com) for additional support.
