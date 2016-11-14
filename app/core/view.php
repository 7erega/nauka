<?php

/**
 * Class View
 * content_view - для відобрадження контенту, template_view - загальний шаблон, data - елементи контенту
 */

class View {
    function generate($content_view, $template_view, $data = null) {
        include ROOT_DIR."/app/views/templates/".$template_view; //завантажуємо загальний шаблон
    }
}