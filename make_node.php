<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
    }


function make_node  ($url, $id) {
	global $$url, $$id;
	echo ("
		const node = document.createElement('script');
		node.url = ' . $url . $id . ';
		node.async = true;

	");
	
};

?>