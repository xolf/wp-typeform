<?php

/*
Plugin Name: Typeform Shortcode
Plugin URI: http://xolf.info/plugins/typeform
Description: Brings your awesome type forms to Wordpress. Implement your forms from http://typeform.com with 2 mouse clicks and use them on your website. This plugin is not affliated with Typeform.com!
Version: 0.1
Author: xolf
Author URI: http://xolf.info
License: GPL2
*/

function typeformtag_func( $atts ) {
    $a = shortcode_atts( array(
        'data' => '',
        'type' => 'frame',
        'text' => 'Launch me!',
    ), $atts );

    if($a['type'] == 'frame') return '
    <div class="typeform-widget" data-url="'.$a["data"].'" data-text="Contact Form" style="width:100%;height:500px;"></div>
    <script>(function(){var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id="typef_orm",b="https://s3-eu-west-1.amazonaws.com/share.typeform.com/";if(!gi.call(d,id)){js=ce.call(d,"script");js.id=id;js.src=b+"widget.js";q=gt.call(d,"script")[0];q.parentNode.insertBefore(js,q)}})()</script>
    <div style="font-family: Sans-Serif;font-size: 12px;color: #999;opacity: 0.5; padding-top: 5px;">Powered by <a href="http://www.typeform.com/?utm_campaign=typeform_yUPw0Q&amp;utm_source=website&amp;utm_medium=typeform&amp;utm_content=typeform-embedded&amp;utm_term=English" style="color: #999" target="_blank">Typeform</a></div>
    ';

    if($a['type'] == 'drawer') return '
    <style>#typeform-overlay{z-index: 100000;}#typeform-wrapper{z-index: 200000;}</style>
    <a class="typeform-share" href="'.$a["data"].'" data-mode="2" target="_blank">'.$a["text"].'</a>
<script>(function(){var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id="typef_orm",b="https://s3-eu-west-1.amazonaws.com/share.typeform.com/";if(!gi.call(d,id)){js=ce.call(d,"script");js.id=id;js.src=b+"share.js";q=gt.call(d,"script")[0];q.parentNode.insertBefore(js,q)}id=id+"_";if(!gi.call(d,id)){qs=ce.call(d,"link");qs.rel="stylesheet";qs.id=id;qs.href=b+"share-button.css";s=gt.call(d,"head")[0];s.appendChild(qs,s)}})()</script>
    ';

    if($a['type'] == 'classic') return '
    <style>#typeform-overlay{z-index: 100000;}#typeform-wrapper{z-index: 200000;}</style>
    <a class="typeform-share" href="'.$a["data"].'" data-mode="1" target="_blank">'.$a["text"].'</a>
    <script>(function(){var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id="typef_orm",b="https://s3-eu-west-1.amazonaws.com/share.typeform.com/";if(!gi.call(d,id)){js=ce.call(d,"script");js.id=id;js.src=b+"share.js";q=gt.call(d,"script")[0];q.parentNode.insertBefore(js,q)}id=id+"_";if(!gi.call(d,id)){qs=ce.call(d,"link");qs.rel="stylesheet";qs.id=id;qs.href=b+"share-button.css";s=gt.call(d,"head")[0];s.appendChild(qs,s)}})()</script>
    ';
}
function typeform_display_helper($data){

    echo '<div class="wrap">';

    echo '<h1>Typeform</h1>
<p><b>First of all!</b> A Typeform account is required. Sign up <a href"http://www.typeform.com/">here</a>.<br>
You have no idea how to create your Typeform shortcut?<br>
No problem, us this helper to get it in one minute.</p>
<form method="post">
<table class="form-table">
<tbody>
<tr>
<th scope="row"><label for="data">Your Typeform URL</label></th>
<td><input name="data" id="data" aria-describedby="data-description" class="regular-text code" type="url" value="'.$_POST['data'].'">
<p class="description" id="data-description">Distribute -> Link to your Typeform -> Your Typeform URL</p>
</td>
</tr>
<tr>
<th scope="row"><label for="description">Button label</label></th>
<td><input name="description" id="description" aria-describedby="tagline-description" placeholder="Launch me!" class="regular-text" type="text" value="'.$_POST['description'].'">
<p class="description" id="tagline-description">The label for the button, which launches the Typeform</p></td>
</tr>
<tr>
<th scope="row">Type</th>
<td>
    <fieldset>
        <legend class="screen-reader-text"><span>Mitgliedschaft</span></legend>
        <label for="typeform-helper-frame">
            <input name="type" value="frame" id="typeform-helper-frame" type="radio">
            Frame
        </label>
        <label for="typeform-helper-drawer">
            <input name="type" value="drawer" id="typeform-helper-drawer" type="radio">
            Drawer
        </label>
        <label for="typeform-helper-classic">
            <input name="type" value="classic" id="typeform-helper-classic" type="radio">
            Classic
        </label>
    </fieldset>
</td>
</tr>
</tbody>
</table>
<input name="submit" id="submit" class="button button-primary" value="Go ahead!" type="submit">
</form>';

    if(isset($_POST['data']) AND $_POST['data'] != '')
    {

        echo '<br><br><hr>
<textarea rows="1" cols="75">
[typeform data="'.$_POST['data'].'"';

        if(isset($_POST['description']) AND $_POST['description'] != '') echo ' text="'.$_POST['description'].'"';

        if(isset($_POST['type']) AND $_POST['type'] != '') echo ' type="'.$_POST['type'].'"';

echo ']</textarea>';

    }

    echo '</div>';

}

function typeform_add_upsell() {
    $page = add_plugins_page(
        'Typeform',
        'Typeform',
        2,
        'typeform-helper',
        'typeform_display_helper'
    );
}
add_action( 'admin_menu', 'typeform_add_upsell', 11 );


//add_management_page( 'Page Titel', 'Menu Titel', 'Capability', 'Menu Slug', 'typeform_setup_page');

add_shortcode( 'typeform', 'typeformtag_func' );
