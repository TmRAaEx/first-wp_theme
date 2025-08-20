<?php
function mytheme_dynamic_template($post_type = null, $page_type = null)
{

    // Hämta plural config för att resolva mapp namn
    $plural_map = require __DIR__ . '/template-config.php';


    // Hämta automatiskt om ej angivet
    if (!$post_type) {
        $post_type = get_post_type();
    }
    if (!$page_type) {
        if (is_single()) {
            $page_type = 'single';
        } elseif (is_archive()) {
            $page_type = 'archive';
            // } elseif (is_page()) {
            //     $page_type = 'page';
            // } elseif (is_404()) {
            //     $page_type = '404';
        } else {
            $page_type = 'default';
        }
    }


    $folder_name = isset($plural_map[$post_type]) ? $plural_map[$post_type] : "{$post_type}s";

    // 1. Försök ladda från undermapp
    $template_path = "templates/{$folder_name}/{$page_type}-{$post_type}";
    if (locate_template($template_path . '.php')) {
        get_template_part($template_path);
        return;
    }

    // 2. Försök ladda direkt från templates/
    $flat_path = "templates/{$page_type}-{$post_type}";
    if (locate_template($flat_path . '.php')) {
        get_template_part($flat_path);
        return;
    }

    // 3. Försök ladda en generisk page_type-template
    $generic_path = "templates/{$page_type}-default";
    if (locate_template($generic_path . '.php')) {
        get_template_part($generic_path);
        return;
    }

    // 4. Sista fallback
    get_template_part('templates/default');
}
