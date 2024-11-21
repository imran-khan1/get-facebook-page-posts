<?php
/*
Plugin Name: Facebook Fetcher
Description: Fetches Facebook posts and details using the Facebook Graph API.
Version: 1.0
Author: Imran Khan
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class FacebookFetcher {
    private $access_token;
    private $api_url = 'https://graph.facebook.com/v17.0/';

    public function __construct() {
        // Set your Access Token here
        $this->access_token = 'YOUR_ACCESS_TOKEN';

        add_shortcode('fetch_facebook_posts', [$this, 'display_facebook_posts']);
    }

    // Fetch posts from the Facebook Graph API
    private function fetch_posts($page_id, $limit = 5) {
        $endpoint = $this->api_url . "{$page_id}/posts?fields=message,created_time,full_picture,permalink_url&limit={$limit}&access_token={$this->access_token}";

        $response = wp_remote_get($endpoint);

        if (is_wp_error($response)) {
            return ['error' => 'Failed to fetch posts'];
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }

    // Fetch user details from the Facebook Graph API
    private function fetch_user($user_id) {
        $endpoint = $this->api_url . "{$user_id}?fields=name,picture&access_token={$this->access_token}";

        $response = wp_remote_get($endpoint);

        if (is_wp_error($response)) {
            return ['error' => 'Failed to fetch user details'];
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }

    // Shortcode handler to display Facebook posts
    public function display_facebook_posts($atts) {
        $atts = shortcode_atts([
            'page_id' => '', // Facebook Page ID
            'limit' => 5,    // Number of posts to fetch
        ], $atts);

        if (empty($atts['page_id'])) {
            return 'Page ID is required.';
        }

        $posts = $this->fetch_posts($atts['page_id'], $atts['limit']);

        if (isset($posts['error'])) {
            return $posts['error'];
        }

        $output = '<div class="facebook-posts">';
        foreach ($posts['data'] as $post) {
            $output .= '<div class="facebook-post">';
            $output .= '<p>' . esc_html($post['message'] ?? 'No message') . '</p>';
            $output .= '<a href="' . esc_url($post['permalink_url']) . '" target="_blank">View Post</a>';
            if (!empty($post['full_picture'])) {
                $output .= '<img src="' . esc_url($post['full_picture']) . '" alt="Post Image">';
            }
            $output .= '<small>Posted on: ' . esc_html($post['created_time']) . '</small>';
            $output .= '</div>';
        }
        $output .= '</div>';

        return $output;
    }
}

// Initialize the plugin
new FacebookFetcher();
