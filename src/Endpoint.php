<?php
namespace Paplauskas\ApiDocs;

class Endpoint
{
    public $method,
        $path,
        $group,
        $title,
        $description,
        $return,
        $param;

    static $prefixes = [];

    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setParam($param)
    {
        $this->param[] = $param;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function setReturn($return)
    {
        $this->return[] = $return;
    }

    public function getReturn()
    {
        return $this->return;
    }

    public function setGroup($group)
    {
        $this->group = $group;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setPath($path)
    {
        if (!empty(self::$prefixes)) {
            $this->path = '/' . implode('/', self::$prefixes) . '/' . $path;
        } else {
            $this->path = '/' . $path;
        }
    }

    public function getPath()
    {
        return $this->path;
    }

    static function isTag($tag)
    {
        return in_array($tag, [
            'method',
            'path',
            'group',
            'title',
            'description',
            'return',
            'param',
        ]);
    }

    static function pushPrefix($prefix)
    {
        return array_push(self::$prefixes, $prefix);
    }

    static function popPrefix()
    {
        return array_pop(self::$prefixes);
    }

}
