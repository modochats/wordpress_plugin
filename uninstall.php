<?php
/**
 * Uninstall script for Modo Chatbot WordPress Plugin
 * 
 * This file is executed when the plugin is uninstalled.
 * It removes all plugin data from the database.
 */

// Prevent direct access
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Remove plugin options
delete_option('modo_chatbot_options');

// Remove any transients
delete_transient('modo_chatbot_cache');

// Remove any custom database tables if they exist
// (Currently not needed, but here for future expansion)

// Clear any cached data
wp_cache_flush();
