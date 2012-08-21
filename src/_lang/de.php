<?php

// German Language Module

$GLOBALS["charset"] = "iso-8859-1";
$GLOBALS["text_dir"] = "ltr"; // ('ltr' for left to right, 'rtl' for right to left)
$GLOBALS["date_fmt"] = "d.m.Y H:i";
$GLOBALS["error_msg"] = array(
	// error
	"error"			=> "FEHLER",
	"back"			=> "Zur?ck",
	
	// root
	"home"			=> "Das Home-Verzeichnis existiert nicht, kontrollieren sie ihre Einstellungen.",
	"abovehome"		=> "Das aktuelle Verzeichnis darf nicht h?her liegen als das Home-Verzeichnis.",
	"targetabovehome"	=> "Das Zielverzeichnis darf nicht h?her liegen als das Home-Verzeichnis.",
	
	// exist
	"direxist"		=> "Dieses Verzeichnis existiert nicht.",
	"fileexist"		=> "Diese Datei existiert nicht.",
	"itemdoesexist"		=> "Dieses Objekt existiert bereits.",
	"itemexist"		=> "Dieses Objekt existiert nicht.",
	"targetexist"		=> "Das Zielverzeichnis existiert nicht.",
	"targetdoesexist"	=> "Das Zielobjekt existiert bereits.",
	
	// open
	"opendir"		=> "Kann Verzeichnis nicht ?ffnen.",
	"readdir"		=> "Kann Verzeichnis nicht lesen",
	
	// access
	"accessdir"		=> "Zugriff auf dieses Verzeichnis verweigert.",
	"accessfile"		=> "Zugriff auf diese Datei verweigert.",
	"accessitem"		=> "Zugriff auf dieses Objekt verweigert.",
	"accessfunc"		=> "Zugriff auf diese Funktion verweigert.",
	"accesstarget"		=> "Zugriff auf das Zielverzeichnis verweigert.",
	
	// actions
	"permread"		=> "Rechte lesen fehlgeschlagen.",
	"permchange"		=> "Rechte ?ndern fehlgeschlagen.",
	"openfile"		=> "Datei ?ffnen fehlgeschlagen.",
	"savefile"		=> "Datei speichern fehlgeschlagen.",
	"createfile"		=> "Datei anlegen fehlgeschlagen.",
	"createdir"		=> "Verzeichnis anlegen fehlgeschlagen.",
	"uploadfile"		=> "Datei hochladen fehlgeschlagen.",
	"copyitem"		=> "Kopieren fehlgeschlagen.",
	"moveitem"		=> "Versetzen fehlgeschlagen.",
	"delitem"		=> "L?schen fehlgeschlagen.",
	"chpass"		=> "Passwort ?ndern fehlgeschlagen.",
	"deluser"		=> "Benutzer l?schen fehlgeschlagen.",
	"adduser"		=> "Benutzer hinzuf?gen fehlgeschlagen.",
	"saveuser"		=> "Benutzer speichern fehlgeschlagen.",
	"searchnothing"		=> "Sie m?ssen etwas zum suchen eintragen.",
	
	// misc
	"miscnofunc"		=> "Funktion nicht vorhanden.",
	"miscfilesize"		=> "Datei ist gr??er als die maximale Gr??e.",
	"miscfilepart"		=> "Datei wurde nur zum Teil hochgeladen.",
	"miscnoname"		=> "Sie m?ssen einen Namen eintragen",
	"miscselitems"		=> "Sie haben keine Objekt(e) ausgew?hlt.",
	"miscdelitems"		=> "Sollen die \"+num+\" markierten Objekt(e) gel?scht werden?",
	"miscdeluser"		=> "Soll der Benutzer '\"+user+\"' gel?scht werden?",
	"miscnopassdiff"	=> "Das neue und das heutige Passwort sind nicht verschieden.",
	"miscnopassmatch"	=> "Passw?rter sind nicht gleich.",
	"miscfieldmissed"	=> "Sie haben ein wichtiges Eingabefeld vergessen auszuf?llen",
	"miscnouserpass"	=> "Benutzer oder Passwort unbekannt.",
	"miscselfremove"	=> "Sie k?nnen sich selbst nicht l?schen.",
	"miscuserexist"		=> "Der Benutzer existiert bereits.",
	"miscnofinduser"	=> "Kann Benutzer nicht finden.",
);
$GLOBALS["messages"] = array(
	// links
	"permlink"		=> "RECHTE ?NDERN",
	"editlink"		=> "BEARBEITEN",
	"downlink"		=> "HERUNTERLADEN",
	"download_selected"		=> "MARKIERTE DATEIEN HERUNTERLADEN",
	"uplink"		=> "H?HER",
	"homelink"		=> "HOME",
	"reloadlink"		=> "ERNEUERN",
	"copylink"		=> "KOPIEREN",
	"movelink"		=> "VERSETZEN",
	"dellink"		=> "L?SCHEN",
	"comprlink"		=> "ARCHIVIEREN",
	"adminlink"		=> "ADMINISTRATION",
	"logoutlink"		=> "ABMELDEN",
	"uploadlink"		=> "HOCHLADEN",
	"searchlink"		=> "SUCHEN",
	"unziplink"				=> "ENTPACKEN",
	
	// list
	"nameheader"		=> "Name",
	"sizeheader"		=> "Gr??e",
	"typeheader"		=> "Typ",
	"modifheader"		=> "Ge?ndert",
	"permheader"		=> "Rechte",
	"actionheader"		=> "Aktionen",
	"pathheader"		=> "Pfad",
	
	// buttons
	"btncancel"		=> "Abbrechen",
	"btnsave"		=> "Speichern",
	"btnchange"		=> "?ndern",
	"btnreset"		=> "Zur?cksetzen",
	"btnclose"		=> "Schlie?en",
	"btncreate"		=> "Anlegen",
	"btnsearch"		=> "Suchen",
	"btnupload"		=> "Hochladen",
	"btncopy"		=> "Kopieren",
	"btnmove"		=> "Verschieben",
	"btnlogin"		=> "Anmelden",
	"btnlogout"		=> "Abmelden",
	"btnadd"		=> "Hinzuf?gen",
	"btnedit"		=> "?ndern",
	"btnremove"		=> "L?schen",
"btnunzip"		=> "Unzip",
	
	// actions
	"actdir"		=> "Verzeichnis",
	"actperms"		=> "Rechte ?ndern",
	"actedit"		=> "Datei bearbeiten",
	"actsearchresults"	=> "Suchergebnisse",
	"actcopyitems"		=> "Objekt(e) kopieren",
	"actcopyfrom"		=> "Kopiere von /%s nach /%s ",
	"actmoveitems"		=> "Objekt(e) verschieben",
	"actmovefrom"		=> "Versetze von /%s nach /%s ",
	"actlogin"		=> "Anmelden",
	"actloginheader"	=> "Melden sie sich an um QuiXplorer zu benutzen",
	"actadmin"		=> "Administration",
	"actchpwd"		=> "Passwort ?ndern",
	"actusers"		=> "Benutzer",
	"actarchive"		=> "Objekt(e) archivieren",
"actunzipitem"		=> "Unzipping",
	"actupload"		=> "Datei(en) hochladen",
	
	// misc
	"miscitems"		=> "Objekt(e)",
	"miscfree"		=> "Freier Speicher",
	"miscusername"		=> "Benutzername",
	"miscpassword"		=> "Passwort",
	"miscoldpass"		=> "Altes Passwort",
	"miscnewpass"		=> "Neues Passwort",
	"miscconfpass"		=> "Best?tige Passwort",
	"miscconfnewpass"	=> "Best?tige neues Passwort",
	"miscchpass"		=> "?ndere Passwort",
	"mischomedir"		=> "Home-Verzeichnis",
	"mischomeurl"		=> "Home URL",
	"miscshowhidden"	=> "Versteckte Objekte anzeigen",
	"mischidepattern"	=> "Versteck-Filter",
	"miscperms"		=> "Rechte",
	"miscuseritems"		=> "(Name, Home-Verzeichnis, versteckte Objekte anzeigen, Rechte, aktiviert)",
	"miscadduser"		=> "Benutzer hinzuf?gen",
	"miscedituser"		=> "Benutzer '%s' ?ndern",
	"miscactive"		=> "Aktiviert",
	"misclang"		=> "Sprache",
	"miscnoresult"		=> "Suche ergebnislos.",
	"miscsubdirs"		=> "Suche in Unterverzeichnisse",
	"miscpermnames"		=> array("Nur ansehen",
						"?ndern",
						"Passwort ?ndern",
						"?ndern & Passwort ?ndern",
						"Administrator",
						"Nur Download"),
	"miscyesno"		=> array("Ja","Nein","J","N"),
	"miscchmod"		=> array("Besitzer", "Gruppe", "Publik"),
);
?>
