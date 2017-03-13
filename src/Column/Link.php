<?php

namespace atk4\ui\Column;

/**
 * Implements Column helper for grid.
 */
class Link extends Generic
{
    public $page = null;

    public function __construct($page = [])
    {
        if (!is_array($page)) {
            $page = [$page];
        }
        $this->page = $page;
    }

    /**
     * kill me now for this code :!!
     */
    public function getCellTemplate(\atk4\data\Field $f)
    {
        foreach ($this->page as &$val) {
            $val = str_replace('{$', '___o', $val);
            $val = str_replace('}', 'c___', $val);
        }

        $href = $this->app->url($this->page);
        $output = $this->app->getTag('td', [], $this->app->getTag('a', ['href'=>$href], '{$'.$f->short_name.'}'));

        $output = str_replace('___o', '{$', $output);
        $output = str_replace('c___', '_urlencode}', $output);

        return $output;
    }

    public function getHTMLTags($row, $field)
    {
        return ['id_urlencode'=>$row->id];
    }
}
