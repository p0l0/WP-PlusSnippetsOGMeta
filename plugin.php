<?php
/*
Plugin Name: Google+ Snippets and Facebook Open Graph Meta in WordPress
Version: 0.1
Plugin URI: http://p0l0.binware.org/
Description: Simple plugin that adds Google+ Snippets and Facebook Open Graph Meta information in WordPress themes to avoid no thumbnail issue, wrong title issue, and wrong description issue.
Author: Marco Neumann
Author URI: http://p0l0.binware.org/
*/
class PlusSnippetOGMeta {
    /**
     * @todo - Is this function used? fbogmeta_url()?
     * @param string $path
     * @return mixed
     */
    public function versionCheck($path = '')
    {
        global $wp_version;

        if (version_compare($wp_version, '2.8', '<')) {
            $folder = dirname(plugin_basename(__FILE__));
            if ($folder != '.') {
                $path = path_join(ltrim($folder, '/'), $path);
            }

            return plugins_url($path);
        }

        return plugins_url($path, __FILE__);
    }

    public function addDoctype($output)
    {
        // Open Graph Doctype
        $output .= ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';

        // +Snippets
        if (is_single()) {
            $output .= ' itemscope itemtype="http://schema.org/Article"';
        } else {
            $output .= ' itemscope itemtype="http://schema.org/Blog"';
        }

        return $output;
    }
}


//Adding the Open Graph in the Language Attributes
$plusSnippetOGMeta = new PlusSnippetOGMeta();

add_filter('language_attributes', array($plusSnippetOGMeta, 'addDoctype'));
