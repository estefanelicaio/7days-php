<?php


function render_view(string $template): void
{   
    $content = file_get_contents(VIEW_FOLDER.$template.'.view');
    $content = put_data($content);

    echo $content;
}


function put_data(string $content): string
{
    $messages = $_SESSION['messages'] ?? [];
    $content = bind_messages($content, $messages, 'success');
    $content = bind_messages($content, $messages, 'error');

    $values = $_SESSION['values'] ?? [];
    $content = bind_old_values($content, $values);
    
    return $content;
}

function bind_messages(string $content, array $messages, string $type): string
{
    $pattern= "/{{\s?$type"."_[\w-]*\s?}}/";
    preg_match_all($pattern, $content, $match);

    foreach($match[0] as $place) {
        
        $field = str_replace("{{ $type" . '_', '', $place);
        $field = str_replace(' }}', '', $field);
        
        if(array_key_exists($type, $messages) && array_key_exists($field, $messages[$type])) {
            $content = str_replace("{{ $type" . '_' . "$field }}", "<div class=\"$type-message\">" . $messages[$type][$field] . "</div>", $content);
        } else {
            $content = str_replace("{{ $type". '_' ."$field }}", "", $content);
        }

    }

    return $content;
}


function bind_old_values(string $content, array $values): string
{
    $pattern= "/{{\s?value_[\w-]*\s?}}/";
    preg_match_all($pattern, $content, $match);

    foreach($match[0] as $place) {
        
        $field = str_replace("{{ value_", '', $place);
        $field = str_replace(' }}', '', $field);
        
        if(array_key_exists($field, $values)) {
            $content = str_replace("{{ value_$field }}", $values[$field], $content);
        } else {
            $content = str_replace("{{ value_$field }}", "", $content);
        }

    }

    return $content;
}
