<?php

/*
 *  coypright (c) baegjins@gmail.com
 *  
 * 
 */

namespace Page;

/**
 * Description of pageheader
 *
 * @author ask
 */
class PageHeader {

    private $str;
    public $title;
    public $contents;

    public function display() {
        $this->str = "<div class = 'page-header'>
                <h1>{$this->title}</h1>
                <p class = 'lead'>
                {$this->contents}
                </p>
                </div>" . PHP_EOL;
        echo $this->str;
    }

}
