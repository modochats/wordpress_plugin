# Troubleshooting Guide - Modo Chatbot WordPress Plugin

## Plugin Settings Not Appearing in Admin

If you can't find the Modo Chatbot settings in your WordPress admin, follow these steps:

### Step 1: Check Plugin Activation

1. **Go to Plugins Page**
   - Navigate to `Plugins > Installed Plugins` in your WordPress admin
   - Look for "Modo Chatbot" in the list
   - Ensure it shows "Active" status
   - If not active, click "Activate"

2. **Check for Errors**
   - Look for any error messages on the plugins page
   - Check if the plugin shows any warnings or notices

### Step 2: Look for Settings in Multiple Locations

The plugin creates menu items in **TWO** locations:

#### Location 1: Top-Level Menu (Main Sidebar)
- Look for **"Modo Chatbot"** in the main admin sidebar
- It should appear with a chat icon (💬)
- Click on it to access settings

#### Location 2: Settings Submenu
- Go to **Settings** in the admin sidebar
- Look for **"Modo Chatbot"** in the Settings submenu
- Click on it to access settings

### Step 3: Check User Permissions

1. **Verify Admin Access**
   - Ensure you're logged in as an Administrator
   - The plugin requires `manage_options` capability
   - Only administrators can access the settings

2. **Check User Role**
   - Go to `Users > All Users`
   - Verify your user role is "Administrator"
   - If not, ask an admin to grant you access

### Step 4: Debug Mode (Advanced)

If you still can't find the settings, enable WordPress debug mode:

1. **Edit wp-config.php**
   ```php
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   ```

2. **Check Debug Log**
   - Look in `/wp-content/debug.log`
   - Search for "Modo Chatbot" entries
   - This will show if the plugin is loading correctly

### Step 5: Manual URL Access

If the menu isn't appearing, try accessing the settings directly:

1. **Direct URL Access**
   - Go to: `your-site.com/wp-admin/options-general.php?page=modo-chatbot`
   - Or: `your-site.com/wp-admin/admin.php?page=modo-chatbot-main`

2. **Check for Errors**
   - If you get a "You don't have permission" error, check user permissions
   - If you get a 404 error, the plugin may not be properly installed

### Step 6: Plugin File Verification

1. **Check File Structure**
   - Ensure the plugin folder is in `/wp-content/plugins/modo-chatbot-wp-plugin/`
   - Verify the main file is named `modo-chatbot-wp-plugin.php`
   - Check that all files are present

2. **File Permissions**
   - Ensure files have correct permissions (644 for files, 755 for folders)
   - Check that WordPress can read the plugin files

### Step 7: Theme/Plugin Conflicts

1. **Deactivate Other Plugins**
   - Temporarily deactivate all other plugins
   - Check if Modo Chatbot settings appear
   - If yes, reactivate plugins one by one to find conflicts

2. **Switch to Default Theme**
   - Temporarily switch to a default WordPress theme
   - Check if the settings appear
   - If yes, the issue is theme-related

### Step 8: Reinstall Plugin

If nothing else works:

1. **Deactivate and Delete**
   - Go to `Plugins > Installed Plugins`
   - Deactivate "Modo Chatbot"
   - Delete the plugin

2. **Reinstall**
   - Upload the plugin files again
   - Activate the plugin
   - Check for the settings menu

## Common Issues and Solutions

### Issue: "Plugin could not be activated because it triggered a fatal error"
**Solution:** Check for PHP syntax errors in the plugin files

### Issue: Settings page shows blank/white screen
**Solution:** Enable debug mode and check for PHP errors

### Issue: Menu appears but settings don't save
**Solution:** Check file permissions and database access

### Issue: Chatbot doesn't appear on frontend
**Solution:** Verify all required fields are filled and chatbot is enabled

## Getting Help

If you're still having issues:

1. **Check WordPress Version**
   - Ensure you're running WordPress 5.0 or higher
   - Update WordPress if needed

2. **Check PHP Version**
   - Ensure PHP 7.4 or higher
   - Update PHP if needed

3. **Contact Support**
   - Visit [Modo Dashboard](https://modochats.com)
   - Provide details about your WordPress version, PHP version, and error messages

## Quick Checklist

- [ ] Plugin is activated
- [ ] User has administrator privileges
- [ ] Checked both menu locations (top-level and Settings)
- [ ] No plugin conflicts
- [ ] WordPress and PHP versions are compatible
- [ ] Plugin files are properly uploaded
- [ ] File permissions are correct

---

**Still having issues?** Contact support at [Modo Dashboard](https://modochats.com) with your WordPress version, PHP version, and any error messages you see.
