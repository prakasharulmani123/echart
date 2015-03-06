<?php
class HttpRequest extends CHttpRequest
{
    public function validateCsrfToken($event)
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? $_SERVER["CONTENT_TYPE"] : null;
        if ($contentType !== 'application/json')
            parent::validateCsrfToken($event);
    }
}