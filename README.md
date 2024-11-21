# get-facebook-page-posts

**Details About the Plugin**
The Facebook Fetcher Plugin is a WordPress plugin that integrates your website with the Facebook Graph API. It allows you to fetch posts from a Facebook page and display them on your WordPress site using a simple shortcode.

**Features**
Fetch Facebook Posts:
Retrieves posts, including text, images, timestamps, and post links.

**Locate the Access Token Variable:** Open the plugin file (facebook-fetcher.php) and find this line:

**php Copy code**
$this->access_token = 'YOUR_ACCESS_TOKEN';
Replace the Placeholder: Replace 'YOUR_ACCESS_TOKEN' with your actual Facebook Access Token. For example:

**php Copy code**
$this->access_token = 'EAABsbCS1iHgBAKZCv6ZBzUuNpZBZClUoCqXzZCZA9EZBZAnOE1wXZBZB6dfxSNLZAZCHm3RQ1fzrBA77xoFZBZB56CZBzZAZBcZCZBZBvZBZAlG0WZD'; // Replace with your real token

**Save the File: ** Save the changes to the file and upload it back to your server if editing locally.

**How to Generate the Access Token**
Create a Facebook App on the Facebook Developer Dashboard.
Enable the Graph API product.
Grant permissions like pages_read_user_content and public_profile.
Generate a Page Access Token via the Access Token Tool or Graph Explorer.
Replace the placeholder in the plugin code with the token you generated.
Usage of the Plugin
Add the shortcode to any page, post, or widget:
plaintext
Copy code
[fetch_facebook_posts page_id="YOUR_PAGE_ID" limit="5"]
Replace YOUR_PAGE_ID with the actual Facebook Page ID.
Example:

To fetch 5 posts from a page with ID 123456789, use:
plaintext
Copy code
[fetch_facebook_posts page_id="123456789" limit="5"]
Styling and Customization
You can style the output by adding custom CSS to your theme. Here's an example:

**css Copy code**
.facebook-posts {
    font-family: Arial, sans-serif;
    margin: 20px 0;
    padding: 10px;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.facebook-post {
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ccc;
}

.facebook-post img {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
}

**Error Handling**
If there are any issues (e.g., invalid token or page ID), the plugin will display error messages in place of the posts. Ensure that:

The access token has the required permissions.
The page ID is valid and the page's posts are public.
