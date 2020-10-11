<?php 
$result_template = <<<abcdedf
<div class="result" data-id={{weedid}}>
<img src={{weedimg}}>
<div class="col">
    <h2 class="weed_name">{{weedname}}</h2>
    <span class="weed_desc">{{weeddesc}}</span>
</div>
</div>
abcdedf;

$page_indicator_template = <<<a
<div class="page" onclick="next_page({{pagenum}})">
    <a>{{pagenum}}</a>
</div>
a;

$active_page_indicator_template = <<<a
<div class="page active" onclick="next_page({{pagenum}})">
    <a>{{pagenum}}</a>
</div>
a;
?>