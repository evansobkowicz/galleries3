<?php
	
/**
* GallerieS3
* 	Display a Bootstrap Carousel Gallery of photos from an S3 Bucket using a simple funciton.
*	This funtion requires Bootstrap CSS and JS. Available from http://getbootstrap.com
* 
* http://github.com/evansobkowicz/galleries3
* Version: 1.0
* 
* Evan Sobkowicz
* http://esobko.com
* 
* License: GPL2
*/

/*  Copyright 2014  Evan Sobkowicz  (email : evan@esobko.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// This function uses Donovan Schönknecht's S3 Class.
require_once('inc/S3.php');
	
function prettyName($name) {
	$parsed = basename($name, ".jpg");
	$pretty = ucwords(str_replace("_", " ", $parsed));
	return $pretty;
}

function galleries3($path, $captions = false, $echo = false){

	// Add your keys and bucket name here.
	$awsAccessKey = 'AWS_ACCESS_KEY';
	$awsSecretKey = 'AWS_SECRET_KEY';
	$bucket = 'BUCKET_NAME';
	
	
	$s3 = new S3($awsAccessKey, $awsSecretKey);
	
	$photos = $s3->getBucket($bucket, $path);
	
	$output = '<div class="galleries3"><div id="galleries3-carousel" class="carousel slide" data-ride="carousel"><ol class="carousel-indicators">';
	
	for ($i = 0; $i < count($photos)-1; $i++) {
		if ($i == 0) {
			$output .= '<li data-target="#galleries3-carousel" data-slide-to="' . $i . '" class="active"></li>';
		} else {
			$output .= '<li data-target="#galleries3-carousel" data-slide-to="' . $i . '"></li>';
		}
	}
	
	$output .= '</ol><div class="carousel-inner">';
	
	$j = 0;	
	foreach ($photos as $photo) {
		$name = $photo['name'];
		if (strpos($name,'.jpg') !== false) {
			$url = $s3->getAuthenticatedURL($bucket, $name, 9999999);
			if ($j == 0) {
				$output .= '<div class="item active">';
			} else {
				$output .= '<div class="item">';
			}
		    $output .= '<img src="' . $url . '" class="galleries3-image" />';
		    if ($captions) {
		    	$output .= '<div class="carousel-caption"><p>';
				$output .= prettyName($name);
				$output .= '</p></div>';
			}
			$output .= '</div>';
		    $j++;
		}
	}
			
	$output .= '</div><a class="left carousel-control" href="#galleries3-carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control" href="#galleries3-carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a></div></div>';
	
	if ($echo) {
		echo $output;
	} else {
		return $output;	
	}
}

?>