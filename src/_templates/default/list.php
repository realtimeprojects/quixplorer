	
    <?php
    /**
	// Sorting of items
	$_img = "&nbsp;<IMG width=\"10\" height=\"10\" border=\"0\" align=\"ABSMIDDLE\" src=\"_img/";
	if($GLOBALS["srt"]=="yes") {
		$_srt = "no";	$_img .= "_arrowup.gif\" ALT=\"^\">";
	} else {
		$_srt = "yes";	$_img .= "_arrowdown.gif\" ALT=\"v\">";
	}
    */
    ?>
	
<?php require qx_var_template_dir() . "/toolbar.php" ?>

    <?php
/**	
	
	// Begin Table + Form for checkboxes
	echo"<TABLE WIDTH=\"95%\"><FORM name=\"selform\" method=\"POST\" action=\"".make_link("post",$dir,NULL)."\">\n";
	echo "<INPUT type=\"hidden\" name=\"do_action\"><INPUT type=\"hidden\" name=\"first\" value=\"y\">\n";
	
	// Table Header
	echo "<TR><TD colspan=\"7\"><HR></TD></TR><TR><TD WIDTH=\"2%\" class=\"header\">\n";
	echo "<INPUT TYPE=\"checkbox\" name=\"toggleAllC\" onclick=\"javascript:ToggleAll(this);\"></TD>\n";
	echo "<TD WIDTH=\"44%\" class=\"header\"><B>\n";
	if($GLOBALS["order"]=="name") $new_srt = $_srt;	else $new_srt = "yes";
	echo "<A href=\"".make_link("list",$dir,NULL,"name",$new_srt)."\">".$GLOBALS["messages"]["nameheader"];
	if($GLOBALS["order"]=="name") echo $_img;
	echo "</A></B></TD>\n<TD WIDTH=\"10%\" class=\"header\"><B>";
	if($GLOBALS["order"]=="size") $new_srt = $_srt;	else $new_srt = "yes";
	echo "<A href=\"".make_link("list",$dir,NULL,"size",$new_srt)."\">".$GLOBALS["messages"]["sizeheader"];
	if($GLOBALS["order"]=="size") echo $_img;
	echo "</A></B></TD>\n<TD WIDTH=\"16%\" class=\"header\"><B>";
	if($GLOBALS["order"]=="type") $new_srt = $_srt;	else $new_srt = "yes";
	echo "<A href=\"".make_link("list",$dir,NULL,"type",$new_srt)."\">".$GLOBALS["messages"]["typeheader"];
	if($GLOBALS["order"]=="type") echo $_img;
	echo "</A></B></TD>\n<TD WIDTH=\"14%\" class=\"header\"><B>";
	if($GLOBALS["order"]=="mod") $new_srt = $_srt;	else $new_srt = "yes";
	echo "<A href=\"".make_link("list",$dir,NULL,"mod",$new_srt)."\">".$GLOBALS["messages"]["modifheader"];
	if($GLOBALS["order"]=="mod") echo $_img;
	echo "</A></B></TD><TD WIDTH=\"8%\" class=\"header\"><B>".$GLOBALS["messages"]["permheader"]."</B>\n";
	echo "</TD><TD WIDTH=\"6%\" class=\"header\"><B>".$GLOBALS["messages"]["actionheader"]."</B></TD></TR>\n";
	echo "<TR><TD colspan=\"7\"><HR></TD></TR>\n";
		
	// make & print Table using lists
	print_table($dir, make_list($dir_list, $file_list));

	// print number of items & total filesize
	echo "<TR><TD colspan=\"7\"><HR></TD></TR><TR>\n<TD class=\"header\"></TD>";
	echo "<TD class=\"header\">".$num_items." ".$GLOBALS["messages"]["miscitems"]." (";
    $free=parse_file_size(diskfreespace(get_abs_dir($dir)));
	echo $GLOBALS["messages"]["miscfree"].": ".$free.")</TD>\n";
	echo "<TD class=\"header\">".parse_file_size($tot_file_size)."</TD>\n";

    echo "<TD class=\"header\" colspan=4></TD>";

	echo "</TR>\n<TR><TD colspan=\"7\"><HR></TD></TR></FORM></TABLE>\n";
	
?><script language="JavaScript1.2" type="text/javascript">
<!--
	// Uncheck all items (to avoid problems with new items)
	var ml = document.selform;
	var len = ml.elements.length;
	for(var i=0; i<len; ++i) {
		var e = ml.elements[i];
		if(e.name == "selitems[]" && e.checked == true) {
			e.checked=false;
		}
	}
// -->
*/
?>
