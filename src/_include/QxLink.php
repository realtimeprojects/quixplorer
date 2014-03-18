<?php

class QxLink
{
    public function __construct (string $action, string $directory = NULL, array $attributes = NULL)
    {
        if (! QxLink::_isValidAction($action))
            show_error("QxLink: unknown action $action");
        $this->_action     = $action;
        $this->_directory  = $directory;
        $this->_attributes = $attributes;
    }

    public function __toString()
    {
        $link = "?action=$this->_action";
        if ($this->_directory != null)
        {
                $link .= "&directory=$this->_directory";
        }

        if ($this->_attributes != null)
        {
            foreach ($this->_attributes as $name => $value)
            {
                $link .= "&$name=$value";
            }
        }

        return $link;
    }

    private function _isValidAction(string $action)
    {
        return preg_match("/^(login|list|authenticate|chmod|download|search|upload|admin|logout)$/", $action) == 1;
    }

    private $_action;
    private $_directory;
}

?>
