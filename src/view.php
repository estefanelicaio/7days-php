<?php


function render_view(string $template): void
{
    $content = file_get_contents(VIEW_FOLDER.$template.'.view');
    echo $content;
}
