<?php
//特殊文字を文字として認識
function escape($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
