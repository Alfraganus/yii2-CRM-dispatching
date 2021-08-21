<?php
// Get active languages
function admin_active_langs($hide_active = false)
{
    $output = array();
    $array = \base\Backend::language('list');

    if ($array) {
        $hide_id = 0;

        if ($hide_active) {
            $current_lang = admin_current_lang();
            $current_lexicon = admin_content_lexicon();

            if ($current_lexicon && $hide_active == 'content_lexicon') {
                $hide_id = $current_lexicon['id'];
            } elseif ($current_lang) {
                $hide_id = $current_lang['id'];
            }

            foreach ($array as $key => $value) {
                if ($value['id'] != $hide_id) {
                    $output[$key] = $value;
                }
            }
        } else {
            $output = $array;
        }
    }

    return $output ? $output : array();
}

// Get current language
function admin_current_lang($get = null)
{
    $array = \base\Backend::language('current');

    if (is_null($get)) {
        return $array;
    }

    return array_value($array, $get);
}

// Get current content language
function admin_content_lexicon($get = null)
{
    $array = \base\Backend::language('content');

    if (is_null($get)) {
        return $array;
    }

    return array_value($array, $get);
}

// Set log
function set_log($type, $args)
{
    if ($type == 'admin') {
        \common\models\Logs::setAdminLog($args);
    } elseif ($type == 'seller') {
        \common\models\Logs::setSellerLog($args);
    }
}

// Set trash
function set_trash($args)
{
    if (is_array($args) && $args) {
        \common\models\Trashbox::setItem($args);
    }
}

// Create temp for
function create_temp_for($type)
{
    $temp = new \base\libs\Temp();
    $temp->createFor($type);
}

// Media browser input
function media_browser_input($type = 'single')
{
    $template = '<div class="media-browser-frame-group">';
    $template .= '{label}';
    $template .= '<div class="input-group">';
    $template .= '{input}';
    $template .= '<div class="input-group-append">';
    $template .= '<button type="button" class="btn-image-clear">';
    $template .= '<i class="ri-close-fill"></i>';
    $template .= '</button>';
    $template .= '<button type="button" class="btn btn-secondary" media-browser-show="single">' . _e('Select') . '</button>';
    $template .= '</div>';
    $template .= '</div>';

    if ($type == 'image') {
        $template .= '<div class="media-browser-input-img"></div>';
    }

    $template .= '</div>';

    return $template;
}

// Field slug input
function field_slug_input($tooltip = null)
{
    if (is_null($tooltip)) {
        $tooltip = _e('Clear');
    }

    $template = '{label}';
    $template .= '<div class="input-group">';
    $template .= '{input}';
    $template .= '<div class="input-group-append input-on-slug-eraser c-pointer">';
    $template .= '<span class="input-group-text" data-toggle="tooltip" data-placement="top" title="' . $tooltip . '">';
    $template .= '<i class="ri-eraser-fill"></i>';
    $template .= '</span>';
    $template .= '</div>';
    $template .= '</div>';

    return $template;
}

// Field with tooltip label
function field_with_tooltip_label($tooltip, $place = 'right')
{
    $template = '<div class="label">
        <span data-toggle="tooltip" data-placement="' . $place . '" title="' . $tooltip . '">
            {label} <i class="ri-question-line" style="font-size: 12px;"></i>
        </span>
    </div>
    {input}';

    return $template;
}

// Field with append group
function field_with_append_group($text)
{
    $template = '{label}';
    $template .= '<div class="input-group">';
    $template .= '{input}';
    $template .= '<div class="input-group-append">';
    $template .= '<div class="input-group-text">' . $text . '</div>';
    $template .= '</div>';
    $template .= '</div>';

    return $template;
}

// Settings item form input field
function settings_item_form_input_field($item, $args = array())
{
    $active_lang = array_value($args, 'active_lang');
    $active_lang_key = array_value($active_lang, 'lang_code');

    if ($item->required == 1) {
        $required = 'required="required"';
    } else {
        $required = '';
    }

    if ($active_lang_key) {
        $label = $item->title . ' [' . $active_lang_key . ']';
        $input_name = 'name="settings_translation[' . $active_lang_key . '][' . $item->settings_key . ']"';
        $input_value = $item->translation ? $item->translation : $item->settings_value;
    } else {
        $label = $item->title;
        $input_name = 'name="settings[' . $item->settings_key . ']"';
        $input_value = $item->settings_value;
    }

    $output = '<label for="' . $item->settings_key . '">' . $label . '</label>';
    $output .= '<input type="' . $item->settings_type . '" class="form-control" ' . $input_name . ' id="' . $item->settings_key . '" value="' . $input_value . '" ' . $required . '>';

    return $output;
}

// Settings item form textarea field
function settings_item_form_textarea_field($item, $args = array())
{
    $active_lang = array_value($args, 'active_lang');
    $active_lang_key = array_value($active_lang, 'lang_code');
    $rows = array_value($args, 'rows', '3');

    if ($item->required == 1) {
        $required = 'required="required"';
    } else {
        $required = '';
    }

    if ($active_lang_key) {
        $label = $item->title . ' [' . $active_lang_key . ']';
        $input_name = 'name="settings_translation[' . $active_lang_key . '][' . $item->settings_key . ']"';
        $input_value = $item->translation ? $item->translation : $item->settings_value;
    } else {
        $label = $item->title;
        $input_name = 'name="settings[' . $item->settings_key . ']"';
        $input_value = $item->settings_value;
    }

    $output = '<label for="' . $item->settings_key . '">' . $label . '</label>';
    $output .= '<textarea class="form-control" ' . $input_name . ' id="' . $item->settings_key . '" rows="' . $rows . '" ' . $required . '>' . $input_value . '</textarea>';


    return $output;
}

// Settings item form select field
function settings_item_form_select_field($item, $array, $args = array())
{
    $active_lang = array_value($args, 'active_lang');
    $active_lang_key = array_value($active_lang, 'lang_code');

    $value_as_key = array_value($args, 'value_as_key');
    $class = array_value($args, 'class', 'form-control custom-select');


    if ($item->required == 1) {
        $required = 'required="required"';
    } else {
        $required = '';
    }

    if ($active_lang_key) {
        $label = $item->title . ' [' . $active_lang_key . ']';
        $sname = 'name="settings_translation[' . $active_lang_key . '][' . $item->settings_key . ']"';
    } else {
        $label = $item->title;
        $sname = 'name="settings[' . $item->settings_key . ']"';
    }

    $output = '<label for="' . $item->settings_key . '">' . $label . '</label>';

    if ($array) {
        $output .= '<select class="' . $class . '" ' . $sname . '] id="' . $item->settings_key . '" ' . $required . '>';

        foreach ($array as $key => $value) {
            if ($value_as_key) {
                $item_key = $value;
                $item_value = $key;
            } else {
                $item_key = $key;
                $item_value = $value;
            }

            if ($item_key == $item->settings_value) {
                $output .= '<option value="' . $item_key . '" selected>' . $item_value . '</option>';
            } else {
                $output .= '<option value="' . $item_key . '">' . $item_value . '</option>';
            }
        }

        $output .= '</select>';
    }

    return $output;
}

// Settings item form select field
function settings_item_form_file_field($item, $args = array())
{
    $active_lang = array_value($args, 'active_lang');
    $active_lang_key = array_value($active_lang, 'lang_code');

    if ($item->required == 1) {
        $required = 'required="required"';
    } else {
        $required = '';
    }

    if ($active_lang_key) {
        $label = $item->title . ' [' . $active_lang_key . ']';
        $sname = 'name="settings_translation[' . $active_lang_key . '][' . $item->settings_key . ']"';
    } else {
        $label = $item->title;
        $sname = 'name="settings[' . $item->settings_key . ']"';
    }

    $output = '<div class="media-browser-frame-group">';
    $output .= '<label for="' . $item->settings_key . '">' . $label . '</label>';
    $output .= '<div class="input-group">';
    $output .= '<input type="text" class="form-control media-browser-input" ' . $sname . ' id="' . $item->settings_key . '" value="' . $item->settings_value . '" ' . $required . '>';
    $output .= '<div class="input-group-append">';
    $output .= '<button type="button" class="btn-image-clear"><i class="ri-close-fill"></i></button>';
    $output .= '<button type="button" class="btn btn-secondary" media-browser-show="single">' . _e('Select') . '</button>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

// Init content settings
function init_content_settings($model)
{
    $output = $model;

    if ($model) {
        $settings = json_decode($model->settings, true);

        if ($settings) {
            foreach ($settings as $key => $value) {
                $output->$key = $value;
            }
        }
    }

    return $output;
}

// Init content meta
function init_content_meta($info)
{
    $output = $info;

    if ($info) {
        $settings = json_decode($info->meta, true);

        if ($settings) {
            foreach ($settings as $key => $value) {
                $output->$key = $value;
            }
        }
    }

    return $output;
}

// Count content childs
function count_content_childs($model, $field_key)
{
    $count = \common\models\ContentFields::find()
        ->where(['content_id' => $model->id, 'field_key' => $field_key])
        ->one();

    if ($count && is_numeric($count->field_value)) {
        return $count->field_value;
    }

    return '0';
}

// Count segment childs
function count_segment_childs($model, $field_key)
{
    $count = \common\models\SegmentFields::find()
        ->where(['segment_id' => $model->id, 'field_key' => $field_key])
        ->one();

    if ($count && is_numeric($count->field_value)) {
        return $count->field_value;
    }

    return '0';
}

// Backend sidebar items
function backend_sidebar_items()
{
    $array = array(
        array(
            'url' => '/',
            'name' => _e('Statistics'),
            'icon' => '<i class="ri-dashboard-line"></i>',
            'childs' => array(),
        ),
        array(
            'url' => '#',
            'name' => _e('Sales'),
            'icon' => '<i class="ri-line-chart-line"></i>',
            'childs' => array(
                array(
                    'url' => '/orders',
                    'name' => _e('All orders'),
                ),
                array(
                    'url' => '/orders/new',
                    'name' => _e('New orders'),
                ),
                array(
                    'url' => '/orders/processing',
                    'name' => _e('Processing orders'),
                ),
                array(
                    'url' => '/orders/completed',
                    'name' => _e('Completed orders'),
                ),
                array(
                    'url' => '/orders/cancelled',
                    'name' => _e('Cancelled orders'),
                ),
            )
        ),
        array(
            'url' => '#',
            'name' => _e('Products'),
            'icon' => '<i class="ri-shopping-cart-2-line"></i>',
            'childs' => array(
                array(
                    'url' => '/products/action/create',
                    'name' => _e('Add new'),
                ),
                array(
                    'url' => '/products/all',
                    'name' => _e('All products'),
                ),
                array(
                    'url' => '/products/recomended',
                    'name' => _e('Recommended products'),
                ),
                array(
                    'url' => '/orders/sponsored',
                    'name' => _e('Sponsored products'),
                ),
                array(
                    'url' => '/fields/brands',
                    'name' => _e('Trademarks'),
                ),
                array(
                    'url' => '/fields/category',
                    'name' => _e('Categories'),
                ),
            )
        ),
        array(
            'url' => '#',
            'name' => _e('Content'),
            'icon' => '<i class="ri-checkbox-multiple-blank-line"></i>',
            'childs' => array(
                array(
                    'url' => '/content/posts',
                    'name' => _e('Posts'),
                ),
                array(
                    'url' => '/content/pages',
                    'name' => _e('Pages'),
                ),
            )
        ),
        array(
            'url' => '#',
            'name' => _e('Design'),
            'icon' => '<i class="ri-brush-2-fill"></i>',
            'childs' => array(
                array(
                    'url' => '/appearance/menus',
                    'name' => _e('Menus'),
                ),
                array(
                    'url' => '/appearance/themes',
                    'name' => _e('Themes'),
                ),
                array(
                    'url' => '/appearance/widgets',
                    'name' => _e('Widgets'),
                ),
            )
        ),
        array(
            'url' => '#',
            'name' => _e('Storage'),
            'icon' => '<i class="ri-folder-3-line"></i>',
            'childs' => array(
                array(
                    'url' => '/storage/files',
                    'name' => _e('Files'),
                ),
                array(
                    'url' => '/storage/images?view=grid',
                    'name' => _e('Images'),
                ),
                array(
                    'url' => '/storage/uploads',
                    'name' => _e('Uploads'),
                ),
            )
        ),
        array(
            'url' => '#',
            'name' => _e('Suppliers'),
            'icon' => '<i class="ri-store-2-line"></i>',
            'childs' => array(
                array(
                    'url' => '/suppliers/users',
                    'name' => _e('All users'),
                ),
                array(
                    'url' => '/suppliers/company',
                    'name' => _e('All suppliers'),
                ),
                array(
                    'url' => '/suppliers/company/pending',
                    'name' => _e('Pending suppliers'),
                ),
                array(
                    'url' => '/suppliers/company/blocked',
                    'name' => _e('Blocked suppliers'),
                ),
            )
        ),
        array(
            'url' => '#',
            'name' => _e('Customers'),
            'icon' => '<i class="ri-group-line"></i>',
            'childs' => array(
                array(
                    'url' => '/customers/users',
                    'name' => _e('All customers'),
                ),
                array(
                    'url' => '/customers/company',
                    'name' => _e('All companies'),
                ),
                array(
                    'url' => '/customers/company/pending',
                    'name' => _e('Pending companies'),
                ),
                array(
                    'url' => '/customers/company/blocked',
                    'name' => _e('Blocked companies'),
                ),
            )
        ),
        array(
            'url' => '#',
            'name' => _e('System'),
            'icon' => '<i class="ri-settings-3-line"></i>',
            'childs' => array(
                array(
                    'url' => '/system/settings',
                    'name' => _e('Settings'),
                ),
                array(
                    'url' => '/system/languages',
                    'name' => _e('Languages'),
                ),
                array(
                    'url' => '/system/payments',
                    'name' => _e('Currency'),
                ),
                array(
                    'url' => '/system/roles',
                    'name' => _e('Roles & permissions'),
                ),
            )
        ),
    );

    return $array;
}
