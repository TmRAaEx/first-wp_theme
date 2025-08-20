<?php
/**
 * Dynamically loads the correct template from the templates directory
 * based on the post type and page type.
 *
 * Both $post_type and $page_type are automatically determined if not provided.
 *
 * Template loading order:
 * 1. templates/{plural_post_type}/{page_type}-{post_type}.php
 * 2. templates/{page_type}-{post_type}.php
 * 3. templates/{page_type}-default.php
 * 4. templates/default.php
 *
 * @param string|null $post_type The post type to load the template for. Defaults to current post type.
 * @param string|null $page_type The type of page (single, archive, etc.). Defaults to current page type.
 * @return void
 */
function mytheme_dynamic_template($post_type = null, $page_type = null)
{
    // Load plural folder configuration for custom post types
    $plural_map = require __DIR__ . '/template-config.php';

    // Automatically determine post_type if not provided
    if (!$post_type) {
        $post_type = get_post_type();
    }

    // Automatically determine page_type if not provided
    if (!$page_type) {
        if (is_single()) {
            $page_type = 'single';
        } elseif (is_archive()) {
            $page_type = 'archive';
        } else {
            $page_type = 'default';
        }
    }

    // Resolve the folder name from the config, defaulting to "{post_type}s"
    $folder_name = $plural_map[$post_type] ?? "{$post_type}s";

    // 1️⃣ Check for template inside the CPT-specific folder
    $template_path = "templates/{$folder_name}/{$page_type}-{$post_type}";
    if (locate_template($template_path . '.php')) {
        get_template_part($template_path);
        return;
    }

    // 2️⃣ Check for template in root of templates folder
    $flat_path = "templates/{$page_type}-{$post_type}";
    if (locate_template($flat_path . '.php')) {
        get_template_part($flat_path);
        return;
    }

    // 3️⃣ Check for generic template for the page_type
    $generic_path = "templates/{$page_type}-default";
    if (locate_template($generic_path . '.php')) {
        get_template_part($generic_path);
        return;
    }

    // 4️⃣ Final fallback
    get_template_part('templates/default');
}
