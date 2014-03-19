<?php

class QxLink
{
    public function __construct (string $action, string $directory = NULL, array $attributes = NULL, $description = NULL)
    {
        if (! QxLink::_isValidAction($action))
            show_error("QxLink: unknown action $action");
        $this->action      = $action;
        $this->directory   = $directory;
        $this->attributes  = $attributes;
        $this->description = $description;
    }

    public function __get($name)
    {
        if ($name == "string")
            return $this->__toString();
        return null;
    }

    public function __toString()
    {
        $link = "?action=$this->action";
        if ($this->directory != null)
        {
                $link .= "&directory=$this->directory";
        }

        if ($this->attributes != null)
        {
            foreach ($this->attributes as $name => $value)
            {
                $link .= "&$name=$value";
            }
        }

        return $link;
    }

    private function _isValidAction(string $action)
    {
        return preg_match("/^(login|list|authenticate|chmod|download|search|upload|admin|logout|mkitem)$/", $action) == 1;
    }
}

?>
