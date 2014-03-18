<?php

class Button
{
    public function __construct (string $id, string $title = null, $link = null, boolean $enabled = null)
    {
        $this->id      = $id;
        $this->title   = $title;
        $this->link    = "" . $link;
        $this->enabled = $enabled;
    }
}
?>
