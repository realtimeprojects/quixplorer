<?php
//------------------------------------------------------------------------------
// editable files:
$GLOBALS["editable_ext"]=array(
	"\.txt$|\.php$|\.php3$|\.phtml$|\.inc$|\.sql$|\.pl$",
	"\.htm$|\.html$|\.shtml$|\.dhtml$|\.xml$",
	"\.js$|\.css$|\.cgi$|\.cpp$\.c$|\.cc$|\.cxx$|\.hpp$|\.h$",
	"\.pas$|\.p$|\.java$|\.py$|\.sh$\.tcl$|\.tk$"
);
//------------------------------------------------------------------------------
// image files:
$GLOBALS["images_ext"]="\.png$|\.bmp$|\.jpg$|\.jpeg$|\$";
//------------------------------------------------------------------------------
// mime types: (description,image,extension)
$GLOBALS["super_mimes"]=array(
	// dir, exe, file
	"dir"	=> array($GLOBALS["mimes"]["dir"],"dir"),
	"exe"	=> array($GLOBALS["mimes"]["exe"],"exe","\.exe$|\.com$|\.bin$"),
	"file"	=> array($GLOBALS["mimes"]["file"],"file")
);
$GLOBALS["used_mime_types"]=array(
	// text
	"text"	=> array($GLOBALS["mimes"]["text"],"txt","\.txt$"),
	
	// programming
	"php"	=> array($GLOBALS["mimes"]["php"],"php","\.php$|\.php3$|\.phtml$|\.inc$"),
	"sql"	=> array($GLOBALS["mimes"]["sql"],"src","\.sql$"),
	"perl"	=> array($GLOBALS["mimes"]["perl"],"pl","\.pl$"),
	"html"	=> array($GLOBALS["mimes"]["html"],"html","\.htm$|\.html$|\.shtml$|\.dhtml$|\.xml$"),
	"js"	=> array($GLOBALS["mimes"]["js"],"js","\.js$"),
	"css"	=> array($GLOBALS["mimes"]["css"],"src","\.css$"),
	"cgi"	=> array($GLOBALS["mimes"]["cgi"],"exe","\.cgi$"),
	//"py"	=> array($GLOBALS["mimes"]["py"],"py","\.py$"),
	//"sh"	=> array($GLOBALS["mimes"]["sh"],"sh","\.sh$"),
	// C++
	"cpps"	=> array($GLOBALS["mimes"]["cpps"],"cpp","\.cpp$|\.c$|\.cc$|\.cxx$"),
	"cpph"	=> array($GLOBALS["mimes"]["cpph"],"h","\.hpp$|\.h$"),
	// Java
	"javas"	=> array($GLOBALS["mimes"]["javas"],"java","\.java$"),
	"javac"	=> array($GLOBALS["mimes"]["javac"],"java","\.class$|\.jar$"),
	// Pascal
	"pas"	=> array($GLOBALS["mimes"]["pas"],"src","\.p$|\.pas$"),
	
	// images
	"gif"	=> array($GLOBALS["mimes"]["gif"],"image","\.gif$"),
	"jpg"	=> array($GLOBALS["mimes"]["jpg"],"image","\.jpg$|\.jpeg$"),
	"bmp"	=> array($GLOBALS["mimes"]["bmp"],"image","\.bmp$"),
	"png"	=> array($GLOBALS["mimes"]["png"],"image","\.png$"),
	
	// compressed
	"zip"	=> array($GLOBALS["mimes"]["zip"],"zip","\.zip$"),
	"tar"	=> array($GLOBALS["mimes"]["tar"],"tar","\.tar$"),
	"gzip"	=> array($GLOBALS["mimes"]["gzip"],"tgz","\.tgz$|\.gz$"),
	"bzip2"	=> array($GLOBALS["mimes"]["bzip2"],"tgz","\.bz2$"),
	"rar"	=> array($GLOBALS["mimes"]["rar"],"tgz","\.rar$"),
	//"deb"	=> array($GLOBALS["mimes"]["deb"],"package","\.deb$"),
	//"rpm"	=> array($GLOBALS["mimes"]["rpm"],"package","\.rpm$"),
	
	// music
	"mp3"	=> array($GLOBALS["mimes"]["mp3"],"mp3","\.mp3$"),
	"wav"	=> array($GLOBALS["mimes"]["wav"],"sound","\.wav$"),
	"midi"	=> array($GLOBALS["mimes"]["midi"],"midi","\.mid$"),
	"real"	=> array($GLOBALS["mimes"]["real"],"real","\.rm$|\.ra$|\.ram$"),
	//"play"	=> array($GLOBALS["mimes"]["play"],"mp3","\.pls$|\.m3u$"),
	
	// movie
	"mpg"	=> array($GLOBALS["mimes"]["mpg"],"video","\.mpg$|\.mpeg$"),
	"mov"	=> array($GLOBALS["mimes"]["mov"],"video","\.mov$"),
	"avi"	=> array($GLOBALS["mimes"]["avi"],"video","\.avi$"),
	"flash"	=> array($GLOBALS["mimes"]["flash"],"flash","\.swf$"),
	
	// Micosoft / Adobe
	"word"	=> array($GLOBALS["mimes"]["word"],"word","\.doc$"),
	"excel"	=> array($GLOBALS["mimes"]["excel"],"spread","\.xls$"),
	"pdf"	=> array($GLOBALS["mimes"]["pdf"],"pdf","\.pdf$")
);
//------------------------------------------------------------------------------
?>
