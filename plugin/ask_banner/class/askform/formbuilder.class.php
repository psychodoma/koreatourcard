<?php

namespace AskForm;

/**
 * Description of formbuilder
 *
 * @author ask
 */
class FormBuilder {

    public $form_attr = array();
    public $required_list = array();
    public $readonly_list = array();
    public $mode = '';
    private $required = false;
    private $readonly = false;
    private $btn = '';

    public function start($class = '') {
        return "<div class='ask-form-wrap {$class}'><form class='{$this->form_attr['class']}' action='{$this->form_attr['action']}' method='post' enctype='multipart/form-data' autocomplete='on' >" . PHP_EOL;
    }

    public function end() {
        return "</form></div><!--//form-->" . PHP_EOL;
    }

    public function buttons($prefix, $qstr) {
        $this->btn = "<div class='form-action'>" . PHP_EOL;
        $this->btn .= "<div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>" . PHP_EOL;
        if ($this->mode == 'u') {
            $this->btn .= $this->btn_delete($prefix, $qstr);
        }
        $this->btn .= $this->btn_list($prefix);
        $this->btn .= $this->submit('submit') . PHP_EOL;
        $this->btn .= "</div>" . PHP_EOL;
        $this->btn .= "</div>" . PHP_EOL;
        return $this->btn;
    }

    private function btn_delete($prefix, $qstr) {
        $str = "<div class='btn-group' role='group' aria-label='Delete Group'>" . PHP_EOL;
        $str .= "<a href='{$prefix}_delete.php?idx={$qstr}' class='btn btn-danger delete_item'>삭제</a>" . PHP_EOL;
        $str .= "</div>" . PHP_EOL;
        return $str;
    }

    private function btn_list($prefix) {
        $str = "<div class='btn-group pull-right' role='group' aria-label='list group'>" . PHP_EOL;
        $str .= "</div>" . PHP_EOL;
        $str .= "<a href='{$prefix}_list.php' class='btn btn-secondary'>목록</a>" . PHP_EOL;
        return $str;
    }

    private function submit($class = '') {
        $str = "<div class='btn-group pull-right' role='group' aria-label='Submit group'>" . PHP_EOL;
        $str .= "<button type='submit' class='{$class} btn btn-primary'>확인</button>" . PHP_EOL;
        $str .= "</div>" . PHP_EOL;
        return $str;
    }

    private function make_form_group($id, $title, $input) {
        $frm = "<div class='form-group row {$id}_group'>" . PHP_EOL
                . "<label for='{$id}' class='col-xs-12 col-md-2 col-form-label'>{$title}</label>" . PHP_EOL
                . "<div class='col-xs-12 col-md-10'>" . PHP_EOL;
        $frm .= $input;
        $frm .= "</div></div>" . PHP_EOL;
        return $frm;
    }

    private function check_required($id) {
        if (in_array($id, $this->required_list)) {
            $this->required = 'required';
        } else {
            $this->required = false;
        }
        return $this->required;
    }

    private function check_readonly($id) {
        if (in_array($id, $this->readonly_list)) {
            $this->readonly = 'readonly';
        } else {
            $this->readonly = false;
        }
        return $this->readonly;
    }

    //select
    //checkbox
    public function input_select($id, $title, $value, $list, $label = '') {
        $use_required = $this->check_required($id);
        $use_readonly = $this->check_readonly($id);
        $select = "<select class='form-control custom-select {$id} {$use_required}' name='{$id}' $use_required $use_readonly> ";
        $select .= "<option value='0'> --  선택하세요  -- </option>";
        foreach ($list as $key => $opt) {
            if ($opt == $value) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $select .= "<option value='{$key}' {$selected}>{$opt}</option>";
        }
        $select .= "</select>";
        return $this->make_form_group($id, $title, $select);
    }

    //radio group
    public function input_radio_group($id, $title, $value, $list) {
        $radio = '';
        foreach ($list as $key => $value) {
            $radio .= "<label class='form-check-inline'>"
                    . "<input class='form-check-input {$id}' type='radio' name='{$id}' id='{$id}_{$key}' value='{$key}'> {$value}"
                    . "</label>";
        }
        return $this->make_form_group($id, $title, $radio);
    }

    //checkbox
    public function input_checkbox($id, $title, $value, $label = '') {
        $use_required = $this->check_required($id);
        $use_readonly = $this->check_readonly($id);
        $input = "<label class='form-check-label'><input name='{$id}' class='form-check-input {$id} {$use_required} {$use_readonly}' type='checkbox' value='{$value}' id='{$id}' {$use_required} {$use_readonly}>{$label}</label>" . PHP_EOL;
        return $this->make_form_group($id, $title, $input);
    }

    //input text
    public function input_text($id, $title, $value, $placehoder = '') {
        $use_required = $this->check_required($id);
        $use_readonly = $this->check_readonly($id);
        $input = "<input name='{$id}' class='form-control {$id} {$use_required} {$use_readonly}' type='text' value='{$value}' id='{$id}' placeholder='{$placehoder}' {$use_required} {$use_readonly}>" . PHP_EOL;
        return $this->make_form_group($id, $title, $input);
    }

    //input file
    public function input_file($id, $title, $value, $placehoder = '') {
        $use_required = $this->check_required($id);
        $use_readonly = $this->check_readonly($id);
        $input = "<input name='{$id}' class='form-control {$id} {$use_required} {$use_readonly}' type='file' value='{$value}' id='{$id}' placeholder='{$placehoder}' {$use_required} {$use_readonly} accept='image/x-png, image/gif, image/jpeg'>" . PHP_EOL;
        if ($_GET['w'] === 'u' && $value) {
            $input .= "<div class='attach_preview'><img src='";
            $input .= ASK_UPLOAD_URL . $value;
            $input .= "'></div>";
        }
        return $this->make_form_group($id, $title, $input);
    }

    //hidden
    public function input_hidden($name, $value) {
        $input = "<input name='{$name}' type='hidden' value='{$value}'>" . PHP_EOL;
        return $input;
    }

    //textarea
    public function input_textarea($id, $title, $value, $placehoder = '') {
        $use_required = $this->check_required($id);
        $use_readonly = $this->check_readonly($id);
        $textarea = "<textarea name='{$id}' class='form-control {$id} {$use_required} {$use_readonly}' id='{$id}' row='4' {$use_required} {$use_readonly} placeholder='{$placehoder}'>{$value}</textarea>" . PHP_EOL;
        if ($id == 'bg-info') {
            $textarea .= '<a class="btn btn-secondary copy-button" data-clipboard-action="copy" data-clipboard-target="#' . $id . '">복사</a>';
        }
        return $this->make_form_group($id, $title, $textarea);
    }

}
