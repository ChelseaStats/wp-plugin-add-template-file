<?php
/*
Plugin Name: TCR  Add Template
Description: Add new page templates or css files into your current theme via tools option page.
Version: 1.0
Plugin URI: http://thecellarroom.net
Author:  TheCellarRoom
Author URI: http://thecellarroom.net
Copyright (c) 2013 TheCellarRoom
*/

function TCR_addTemplate(){ add_management_page('TCR Settings', 'TCR Add Template', 8, 'TCR-handle', 'TCR_Sweeper');}
add_action('admin_menu','TCR_addTemplate');

function TCR_Sweeper() {

//This first if statement checks whether the user has created a newfile by checking the hidden field 'newfile' and by checking if the newfilename is not empty.
 if ($_POST['newfile'] == 'yes' && $_POST['TCR_filename'] != ''){
	 $TCR_newfile = $_POST['TCR_filename'];
$ourFileName = get_stylesheet_directory()."/$TCR_newfile";

//Let's check if the file already exists

if (file_exists($ourFileName)){
	echo '<div id="message" id="replyerror" ><p>File already exists. <a href="'.$_SERVER['PHP_SELF'].'?page=TCR-handle" > Try a different filename</a></p></div>';

	return;
}

$ourFileHandle = fopen($ourFileName, 'w')  ;
$ourFileContent = fwrite($ourFileHandle, $_POST['TCR_file_content']);
if ($ourFileContent){
fclose($ourFileHandle);	
echo '<div id="message" class="updated"><p>New template file added successfully. You can now edit it in your <a href="theme-editor.php">theme editor</a>.</p></div>';
 }else die("Can't create file");
}

echo '<div class="wrap">

<h2>TCR Add Template</h2>
<br/>
<form action="'.$_SERVER['PHP_SELF'].'?page=TCR-handle" method="post" enctype="multipart/form-data" >
<input type="hidden" name="newfile" value="yes" /> 
<label>
<strong>File name:</strong>
</label><label><input type = "text" size="40" name="TCR_filename">
</label><label><input type="submit" value="Create new file/template" /></label><br/><br/>
<label>
<strong>File content:</strong><br/><br/>
<textarea name="TCR_file_content" rows="25" cols="70" id="newcontent" >
<?php
/* 
Template Name: 
*/
?>
</textarea></label>';

echo '</form>';
echo '</div>';
}
?>
