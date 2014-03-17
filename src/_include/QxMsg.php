<?php

class QxMsg
{
    public static function load($language)
    {
        QxMsg::$_msgs = parse_ini_file("_lang/en.lang", true);
        QxLog::debug("Loaded $language (fake)");
    }

    public static function get($message)
    {
        $parts = explode( ".", $message);
        switch (count($parts))
        {
            case 1: return QxMsg::getFromSection($message);
            case 2: return QxMsg::getFromSection($parts[1], $parts[0]);
            case 0:
            default: return $message;
        }
    }

    public static function getFromSection($msgid, $section = "global")
    {
        $msgs = QxMsg::$_msgs;
        if (! isset($msgs[$section]))
        {
            QxLog::error("QxMsg: no section '$section' found");
            return "$section.$msgid";
        }

        if (! isset($msgs[$section][$msgid]))
        {
            QxLog::error("QxMsg: no message '$msgid found in section '$section'");
            return "$section.$msgid";
        }
        
        return $msgs[$section][$msgid];
    }

    public static function translate($output)
    {
        $matches = array();
        preg_match_all('/@@([^@]+)@@/', $output, $matches);
        $translations = $matches[1];
        foreach ($translations as $translation)
        {
            QxLog::debug("found translation $translation");
            $translated = QxMsg::get($translation);
            $output = preg_replace('/@@' . $translation . '@@/', $translated, $output);
        }

        return $output;
    }

    private static $_msgs;
}
?>
