<?php 
$result_template = <<<abcdedf
<div class="result row full-width full-height align-flex-start justify-flex-start" data-id={{weedid}}>
    <div class="row tablet-col mobile-col full-width justify-flex-start">
        <div class="col result_left">
            <img src={{weedimg}}>
        </div>
        <div class="col result_center full-height justify-flex-start">
            <h2 class="weed_name">{{weedname}}</h2>
            <span class="weed_desc">{{weeddesc}}</span>
            <span class="common_names">Commonly known as: {{common_names}}</span>
        </div>
        <div class="col full-height result_right">
            <span class="bold">Control methods:</span>
            <span class="control_methods">{{control_methods}}</span>
        </div>
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