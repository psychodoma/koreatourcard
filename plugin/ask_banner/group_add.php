<?php
/*
 * Gropu Add
 */
include_once './_common.php';
include_once './_lib/banner.lib.php';
include_once './_lib/config.php';
include_once './ask_header.php';

use Page\PageHeader;
use AskForm\FormBuilder;

$pageheader = new PageHeader;
$pageheader->title = '그룹등록';
$pageheader->contents = '그룹은 배너가 등록될 위치를 지정하는 기능입니다. 최소 하나의 그룹이 등록되어야 합니다.';
$pageheader->display();

$form = new FormBuilder;
$form->form_attr = array("action" => 'group_add.update.php', 'class' => 'form-group'); // form attr
$form->required_list = array('gr_name', 'gr_type'); //필수 체크
if ($w == 'u') {
    $form->mode = 'u';
}

if ($w == 'u' && $idx) {
    if (filter_var($idx, FILTER_VALIDATE_INT)) {
        $form->readonly_list = array('gr_name'); //readonly 체크
        $sql = "select * from " . ASK_GROUP_TABLE . " where gr_idx = '{$idx}'";
        $row = sql_fetch($sql);
        $hidden = $form->input_hidden('gr_idx', $idx);
        $hidden .= $form->input_hidden('w', 'u');
    } else {
        alert('입력값이 올바르지 않습니다.');
        exit;
    }
}
//폼출력
echo $form->start('group_add');
echo $hidden;
echo $form->input_text('gr_name', '그룹명', $row['gr_name'], '광고게시 위치명을 입력하세요.');
echo $form->input_textarea('gr_memo', '메모', $row['gr_memo'], '그룹에 대한 메모사항이 있다면 입력하세요. ');
if ($w == 'u') {
    echo $form->input_textarea('bg-info', '배너출력코드', '<?php ' . PHP_EOL . '//아래의코드를 배너출력을 원하는 위치에 삽입하세요. ' . PHP_EOL . ' echo ask_banner_print(\'' . $row['gr_name'] . '\'); ' . PHP_EOL . '?>', '');
}
echo $form->buttons('group', $idx);
echo $form->end();
?>
<script type="text/javascript">
    new Clipboard('.copy-button');
    $(function () {
        $('.delete_item').click(function () {
            if (confirm('삭제하시겠습니까?')) {
                return true;
            } else {
                return false;
            }
        });
<?php if ($w == 'u') { ?>
    <?php if ($row['gr_open'] == 1) { ?>
                setTimeout(function () {
                    $('.gr_open').click();
                }, 100);
    <?php } ?>
            $('.gr_type').val('<?php echo $row['gr_type'] ?>');
<?php } ?>
        $('.gr_open').click(function () {
            if ($('.gr_open').is(":checked") == true) {
                $('.set').removeClass('invisible hidden-xs-up');
                $('.gr_point, .gr_limit').addClass('required');
            } else {
                $('.set').addClass('invisible hidden-xs-up');
                $('.gr_point, .gr_limit').removeClass('required');
            }
        });
        //숫자만입력
        $(".gr_point, .gr_limit").keyup(function () {
            $(this).val($(this).val().replace(/[^0-9]/g, ""));
        });
        $('.form-group input').click(function () {
            $(this).removeClass('bg-danger');
        });
        $('.submit').click(function () {
            var gr_name = $('#gr_name').val();
            if (gr_name.length < 2) {
                alert('이름은 2글자 이상 입력하세요.');
                $('.gr_name').addClass('bg-danger');
                return false;
            }
            //회원공개일경우
            /*
             if ($('.gr_open').is(":checked") == true) {
             var gr_point = $('.gr_point').val();
             var gr_limit = $('.gr_limit').val();
             if (!gr_point) {
             alert('1일당 배너 등록 포인트를 입력하세요.');
             $('.gr_point').addClass('bg-danger');
             return false;
             }
             if (!gr_limit) {
             alert('등록할 수 있는 배너 제한 개수를 입력하세요.');
             $('.gr_limit').addClass('bg-danger');
             return false;
             }
             }
             
             var gr_type = $('.gr_type>option:selected').val();
             if (gr_type == 0) {
             alert('등록 가능한 배너 종류를 선택하세요.');
             $('.gr_type').addClass('bg-danger');
             return false;
             }
             */
            return true;

        });
    });
</script>
<?php
include_once './ask_footer.php';
