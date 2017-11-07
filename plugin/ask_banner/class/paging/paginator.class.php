<?php

namespace Paging;

class Paginator {

    public $current_page;
    public $items_per_page;
    public $limit_end;
    public $limit_start;
    public $num_pages;
    public $total_items;
    protected $ipp_array;
    protected $limit;
    protected $mid_range;
    protected $querystring;
    protected $return;
    protected $get_ipp;

    public function __construct($total = 0, $mid_range = 7, $ipp_array = array(10, 25, 50, 100, "All")) {
        $this->total_items = (int) $total;
        if ($this->total_items <= 0) {
            exit("Unable to paginate: Invalid total value (must be an integer > 0)");
        }
        $this->mid_range = (int) $mid_range; // midrange must be an odd int >= 1
        if ($this->mid_range % 2 == 0 Or $this->mid_range < 1) {
            exit("Unable to paginate: Invalid mid_range value (must be an odd integer >= 1)");
        }
        if (!is_array($ipp_array)) {
            exit("Unable to paginate: Invalid ipp_array value");
        }
        $this->ipp_array = $ipp_array;
        $this->items_per_page = (isset($_GET["ipp"])) ? $_GET["ipp"] : $this->ipp_array[0];
        $this->default_ipp = $this->ipp_array[0];
        if ($this->items_per_page == "All") {
            $this->num_pages = 1;
        } else {
            if (!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) {
                $this->items_per_page = $this->ipp_array[0];
            }
            $this->num_pages = ceil($this->total_items / $this->items_per_page);
        }
        $this->current_page = (isset($_GET["page"])) ? (int) $_GET["page"] : 1; // must be numeric > 0
        if ($_GET) {
            $args = explode("&", $_SERVER["QUERY_STRING"]);
            foreach ($args as $arg) {
                $keyval = explode("=", $arg);
                if ($keyval[0] != "page" And $keyval[0] != "ipp") {
                    $this->querystring .= "&" . $arg;
                }
            }
        }
        if ($_POST) {
            foreach ($_POST as $key => $val) {
                if ($key != "page" And $key != "ipp") {
                    $this->querystring .= "&$key=$val";
                }
            }
        }
        if ($this->num_pages > 10) {
            $this->return = ($this->current_page > 1 And $this->total_items >= 10) ? "<li class='page-item'> <a class=\"paginate page-link\"aria-label='Previous' href=\"{$_SERVER['PHP_SELF']}?page=" . ($this->current_page - 1) . "&ipp=$this->items_per_page$this->querystring\"><i class='fa fa-angle-double-left' aria-hidden='true'></i><span class='sr-only'>Previous</span></a> </li>" : "<li class='page-item disabled'> <a href='#' class='page-link'><i class='fa fa-angle-double-left' aria-hidden='true'></i><span class='sr-only'>Previous</span></a> </li>";
            $this->start_range = $this->current_page - floor($this->mid_range / 2);
            $this->end_range = $this->current_page + floor($this->mid_range / 2);
            if ($this->start_range <= 0) {
                $this->end_range += abs($this->start_range) + 1;
                $this->start_range = 1;
            }
            if ($this->end_range > $this->num_pages) {
                $this->start_range -= $this->end_range - $this->num_pages;
                $this->end_range = $this->num_pages;
            }
            $this->range = range($this->start_range, $this->end_range);
            for ($i = 1; $i <= $this->num_pages; $i++) {
                if ($this->range[0] > 2 And $i == $this->range[0]) {
                    $this->return .= "<li class='page-item'> <a href='#' class='page-link'>...</a> </li>";
                }
                // loop through all pages. if first, last, or in range, display
                if ($i == 1 Or $i == $this->num_pages Or in_array($i, $this->range)) {
                    $this->return .= ($i == $this->current_page And $this->items_per_page != "All") ? "<li class='page-item active'><a title=\"Go to page $i of $this->num_pages\" class=\"current page-link\" href=\"#\">$i</a> </li>\n" : "<li class='page-item'><a class=\"paginate page-link\" title=\"Go to page $i of $this->num_pages\" href=\"{$_SERVER['PHP_SELF']}?page=$i&ipp=$this->items_per_page$this->querystring\">$i</a></li> \n";
                }
                if ($this->range[$this->mid_range - 1] < $this->num_pages - 1 And $i == $this->range[$this->mid_range - 1]) {
                    $this->return .= "<li class='page-item'> <a href='#' class='page-link'>...</a> </li>";
                }
            }
            $this->return .= (($this->current_page < $this->num_pages And $this->total_items >= 10) And ( $this->items_per_page != "All") And $this->current_page > 0) ? "<li class='page-item'><a class=\"paginate page-link\" href=\"{$_SERVER['PHP_SELF']}?page=" . ($this->current_page + 1) . "&ipp=$this->items_per_page$this->querystring\"><i class='fa fa-angle-double-right' aria-hidden='true'></i></a></li>\n" : "<li class='page-item disabled'> <a href='#' class='page-link'><i class='fa fa-angle-double-right' aria-hidden='true'></i></a></li>\n";
            $this->return .= ($this->items_per_page == "All") ? "<li class='page-item'><a class=\"current page-link\" href=\"#\">All</a></li> \n" : "<li class='page-item'><a class=\"paginate page-link\" href=\"{$_SERVER['PHP_SELF']}?page=1&ipp=All$this->querystring\">All</a> </li>\n";
        } else {
            for ($i = 1; $i <= $this->num_pages; $i++) {
                $this->return .= ($i == $this->current_page) ? "<li class='page-item active'><a class=\"current page-link\" href=\"#\">$i</a></li> " : "<li class='page-item'><a class=\"paginate page-link\" href=\"{$_SERVER['PHP_SELF']}?page=$i&ipp=$this->items_per_page$this->querystring\">$i</a> </li>";
            }
            $this->return .= "<li class='page-item'><a class=\"paginate page-link\" href=\"{$_SERVER['PHP_SELF']}?page=1&ipp=All$this->querystring\">All</a> </li>\n";
        }
        $this->return = str_replace("&", "&amp;", $this->return);
        $this->limit_start = ($this->current_page <= 0) ? 0 : ($this->current_page - 1) * $this->items_per_page;
        if ($this->current_page <= 0) {
            $this->items_per_page = 0;
        }
        $this->limit_end = ($this->items_per_page == "All") ? (int) $this->total_items : (int) $this->items_per_page;
    }

    public function display_items_per_page() {
        $items = NULL;
        natsort($this->ipp_array); // This sorts the drop down menu options array in numeric order (with 'all' last after the default value is picked up from the first slot
        foreach ($this->ipp_array as $ipp_opt) {
            $items .= ($ipp_opt == $this->items_per_page) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n" : "<option value=\"$ipp_opt\">$ipp_opt</option>\n";
        }
        return "<span class=\"paginate\">Items per page:</span><select class=\"paginate form-control\" onchange=\"window.location='{$_SERVER['PHP_SELF']}?page=1&amp;ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select>\n";
    }

    public function display_jump_menu() {
        $option = NULL;
        for ($i = 1; $i <= $this->num_pages; $i++) {
            $option .= ($i == $this->current_page) ? "<option value=\"$i\" selected>$i</option>\n" : "<option value=\"$i\">$i</option>\n";
        }
        return "<span class=\"paginate\">Page:</span><select class=\"paginate form-control\" onchange=\"window.location='{$_SERVER['PHP_SELF']}?page='+this[this.selectedIndex].value+'&amp;ipp=$this->items_per_page$this->querystring';return false\">$option</select>\n";
    }

    public function display_pages() {
        $addstr = '<nav aria-label="Page navigation">';
        $addstr .= '<ul class="pagination">';
        $addstr .= $this->return;
        $addstr .= '</ul></nav>';
        return $addstr;
    }

}
