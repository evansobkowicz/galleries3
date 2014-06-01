# GallerieS3
==========

A PHP function that generates a Bootstrap Carousel Gallery from an S3 bucket or folder within it.

## Implementation

1. Put photos in an S3 bucket. Photos must be in .jpg format.
2. Include the galleries3.php file on your page.
	<?php include 'path_to/galleries3.php'; ?>
3. Edit galleries3.php to add your AWS Access Key, AWS Secret Key, and Bucket Name.
4. Include Bootstrap CSS and JS on your page. Available from [http://getbootstrap.com](http://getbootstrap.com)
5. Call the funciton on your page
	<?php galleries3($path, $captions, $echo); ?>
	$path (string) -- the folder within the bucket. (Example: "photos/")
	$captions (boolean) -- Create captions from the file names. (Example: "evening_sunset.jpg")
	$echo (boolean) -- echo or return the HTML for the gallery

## Open Source

This project is open source, and relies on other open source projects including Bootstrap and Donovan Schönknecht's S3 Class.

## Contributing 

- Feel free to submit issues or pull requests.
- Contact me with any questions: [@evansobkowicz](http://twitter.com/evansobkowicz)