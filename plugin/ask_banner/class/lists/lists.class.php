<?php

/*
 *  coypright (c) baegjins@gmail.com
 *  
 * 
 */

namespace Lists;

/**
 * array 목록화
 *
 * @author ask
 */
class Lists {

    public $header = array();
    public $body = array();
    public $field = array();
    public $class = '';
    private $table_header = '';
    private $table_body = '';
    private $table_footer = '';
    private $str = '';

    private function make_header() {
        $this->table_header = "<table class='table table-bordered table-hover list-table {$this->class}'>" . PHP_EOL;
        $this->table_header .= "<thead class='thead-inverse'>" . PHP_EOL;
        $this->table_header .= "<tr>" . PHP_EOL;
        foreach ($this->header as $value) {
            $this->table_header .= "<th>{$value}</th>" . PHP_EOL;
        }

        $this->table_header .= "</tr>" . PHP_EOL;
        $this->table_header .= "</thead>" . PHP_EOL;
        return $this->table_header;
    }

    private function make_body() {
        $this->table_body .= "<tbody>" . PHP_EOL;
        for ($x = 0; count($this->body) > $x; $x++) {
            $this->table_body .= "<tr>" . PHP_EOL;
            for ($i = 0; count($this->field) > $i; $i++) {
                $this->table_body .= "<td>{$this->body[$x][$this->field[$i]]}</td>" . PHP_EOL;
            }
            $this->table_body .= "</tr>" . PHP_EOL;
        }
        $this->table_body .= "</tbody>" . PHP_EOL;
        return $this->table_body;
    }

    private function make_footer() {
        $this->table_footer = "</table>" . PHP_EOL;
        return $this->table_footer;
    }

    public function display() {
        $this->str .= $this->make_header();
        $this->str .= $this->make_body();
        $this->str .= $this->make_footer();
        echo $this->str;
    }

}
