<?php
/* This file is part of the SERIAL POSTS Wordpress Plugin Version 0.9
*********************************************************************
Copyright 2008  Ade WALKER  (email : info@studiograsshopper.ch)

Check that we are using 2.7+ before running
deleting options */
if ( !defined('WP_UNINSTALL_PLUGIN') ) {
    exit();
}
delete_option('serp_plugin_settings');
?>