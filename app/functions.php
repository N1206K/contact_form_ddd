<?php
//出力するデータをエスケープ
function h($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
