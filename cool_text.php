<?php
/*
Plugin Name: Cool Text
Plugin URI: http://www.osfvad.com/cool_text/
Description: Revolutionize your post text appearance to (1) αs єlєġєит αs тнίs (2) ๏г คร ςгคzץ คร tђเร (3) øř ëvëń åş ƒµńĸŷ åş łħïş!
Version: 1.0
Author: Max
Author URI: http://www.osfvad.com
Copyright 2010  Max  (email : support@osfvad.com)
*/



function text_converter ($data) {


//Setting : Choose your text

$cooltextversion = '1'; // "1" for Elegant text (default) "2" Crazy Text. "3" for Funky Text

//

$data = str_replace('
', "", $data);
$data = str_replace("\r", "", $data);
$data = str_replace("\n", "", $data);
$data = str_replace("><", "♺❁☮", $data);

$data = $data.'<i></i>';
$original_text = $data;



for (; $data != "";){

		preg_match("/([^`]*?)<([^`]*?)>/", $data, $matches);
		
		$oldpart = $matches[1].'<'.$matches[2].'>';
		
		$cooltext[1] = array ("α","в","c","đ","є","f","ġ","н","ί","j","ӄ","l","м","и","o","ρ","q","я","s","т","υ","v","ω","×","γ","z");
		$cooltext[2] = array ("α","в","ς","đ","є","Ŧ","ġ","н","ί","ן","ӄ","ℓ","м","и","๏","ρ","ợ","я","ร","т","υ","ህ","ω","×","γ","z");
		$cooltext[3] = array ("Å","ß","₡","Ď","€","₣","Ğ","Ĥ","Ĭ","Ĵ","Ķ","Ł","M","Ŋ","Ő","Þ","Q","Ř","§","†","Ű","V","Ŵ","×","¥","Ź");
		$oritext1 = array ("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
		$oritext2 = array ("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		

		$matches[1] = str_replace ($oritext1, $cooltext[$cooltextversion], $matches[1] );
		$matches[1] = str_replace ($oritext2, $cooltext[$cooltextversion], $matches[1] );
		
		$newpart = $matches[1].'<'.$matches[2].'>';
		
		$converted_text = $prev_text.$newpart;
		$prev_text = $converted_text;
		$data = str_replace($oldpart, "", $data);
		
		}
		
//
$converted_text = str_replace("♺❁☮", "><", $converted_text);
$original_text = str_replace("♺❁☮", "><", $original_text);
$finaltext = $converted_text;

$css_1 = rand(1, 9999);
$css_2 = rand(1, 9999);
if ($css_1 == $css_2){$css_2 = 0;}

echo "

<style type=\"text/css\">
<!--

#hidden_cooltext$css_1 {

	background: transparent;
	display: none;
}

#hidden_cooltext$css_2 {

	background: transparent;
	display: block;
}

input.cooltext_btn {
  color:#black;
  font: 'trebuchet ms',helvetica,sans-serif;
  background-color:#white;
  border:1px solid;
  border-color: #grey;
  opacity:0.5;
  -moz-opacity: 0.5;
   filter: alpha(opacity=50);
}

-->
</style>

<script language=\"JavaScript\">



	function toggle$css_1(id) {
		var state = document.getElementById(id).style.display;
			if (state == 'block') {
				document.getElementById(id).style.display = 'none';
			} else {
				document.getElementById(id).style.display = 'block';
			}
		}

	function toggle$css_2(id) {
		var state = document.getElementById(id).style.display;
			if (state == 'none') {
				document.getElementById(id).style.display = 'block';
			} else {
				document.getElementById(id).style.display = 'none';
			}
		}
</script>

";

//Settings : support this plugin

$support = 1; // "0" if you don't want to support. "1" for invinsible link back (default, recommended since it is exactly like "0"). "2" for 'powered by cool text' link back which is only appears in 'normal text format'.

//

if ($support == 1) {
$baselineurl = get_option('siteurl');
$original_text = $original_text."<a href=\"http://www.osfvad.com/cool_text/\"><img class=\" alignnone\" title=\"Cool Text\" src=\"$baselineurl/wp-content/plugins/cool_text/blank.gif\" alt=\"Cool Text\"/></a>";
$finaltext = $finaltext."<img src=\"$baselineurl/wp-content/plugins/cool_text/blank.gif\"/>";}
if ($support == 2) {$original_text = $original_text.'<p style="text-align: right;"></p><p style="text-align: right;">Powered by <a title="Cool Text" href="http://www.osfvad.com/cool_text/" target="_blank">cool text</a></p>';}

echo "



<div id=\"hidden_cooltext$css_1\"><p style=\"text-align: right;\"><INPUT type=\"button\" value=\" View in original text format \" onclick=\"toggle$css_2('hidden_cooltext$css_2');toggle$css_1('hidden_cooltext$css_1')\" class=\"cooltext_btn\"></p>$original_text</div>";

echo "<div id=\"hidden_cooltext$css_2\"><p style=\"text-align: right;\"><INPUT type=\"button\" value=\" View in normal text format \" onclick=\"toggle$css_2('hidden_cooltext$css_2');toggle$css_1('hidden_cooltext$css_1')\" class=\"cooltext_btn\"></p>
";

echo "$finaltext";
echo '</div>';

}

add_filter('the_content', 'text_converter');

?>