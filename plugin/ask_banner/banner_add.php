<?php
/*
 * Banner Add
 */
include_once './_common.php';
include_once './_lib/banner.lib.php';
include_once './_lib/config.php';
include_once './ask_header.php';

use Page\PageHeader;
use AskForm\FormBuilder;

$pageheader = new PageHeader;
$pageheader->title = '배너 등록';
$pageheader->contents = '최소 1개의 그룹이 등록되어 있어야 합니다.';
$pageheader->display();
$form = new FormBuilder;
$form->form_attr = array("action" => 'banner_add.update.php', 'class' => 'form-group'); // form attr
$form->required_list = array('ba_mb_id', 'ba_name', 'ba_gr_idx', 'ba_email'); //필수 체크

if ($w == 'u') {
    $form->mode = 'u';
}

if ($w == 'u' && $idx) {
    if (filter_var($idx, FILTER_VALIDATE_INT)) {
        $form->readonly_list = array('ba_mb_id'); //readonly 체크
        $sql = "select * from " . ASK_BANNER_TABLE . " where ba_idx = '{$idx}'";
        $row = sql_fetch($sql);
        $hidden = $form->input_hidden('ba_idx', $idx);
        $hidden .= $form->input_hidden('w', 'u');
    } else {
        alert('입력값이 올바르지 않습니다.');
        exit;
    }
}
//폼출력
echo $form->start('banner_add');
echo $hidden . PHP_EOL;
echo $form->input_text('ba_name', '배너제목', $row['ba_name'], '배너를 구분하기 위한 제목');
echo $form->input_select('ba_gr_idx', '그룹선택', $row['ba_name'], ask_group_list());
echo $form->input_radio_group('ba_type', '배너종류', $value, array('text' => '텍스트', 'image' => '이미지', 'html' => 'HTML'));
echo "<div class='dynamic_dom row'>" . PHP_EOL;
echo "<div class='col-xs-12 col-md-10 offset-md-2 hidden_row'>" . PHP_EOL;
echo $form->input_text('ba_url', 'URL', $row['ba_url'], 'http://www.myhomepage.com');
echo $form->input_text('ba_text', 'Text 배너', $row['ba_name'], '화면에 출력될 텍스트');
echo $form->input_file('ba_image', '이미지 배너', $row['ba_image'], '.jpg, .png, .gif');
echo $form->input_textarea('ba_html', 'HTML', $row['ba_html'], 'HTML, Adsense');
echo "</div>" . PHP_EOL;
echo "</div>" . PHP_EOL;
echo $form->input_checkbox('ba_use_time', '배너시작', 1, ' 시작, 종료일을 설정합니다.');
echo "<div class='dynamic_dom row'>" . PHP_EOL;
echo "<div class='col-xs-12 col-md-10 offset-md-2 hidden_row'>" . PHP_EOL;
echo $form->input_text('ba_startday', '시작일', $row['ba_startday'], '시작 날짜입력 YYYY-MM-DD');
echo $form->input_text('ba_endday', '종료일', $row['ba_endday'], '지정일까지 배너출력됩니다.');
echo "</div>" . PHP_EOL;
echo "</div>" . PHP_EOL;
echo $form->buttons('banner', $idx);
echo $form->end();
?>
<script type="text/javascript">
    $(function () {
        $('.delete_item').click(function () {
            if (confirm('삭제하시겠습니까?')) {
                return true;
            } else {
                return false;
            }
        });
<?php if ($w == 'u') { ?>
            setTimeout(function () {
                $('#<?php echo "ba_type_" . $row['ba_type']; ?>').trigger('click');
    <?php if ($row['ba_use_time'] == 1) { ?>
                    $('.ba_use_time').trigger('click');
    <?php } ?>
            }, 100);
            $('.ba_gr_idx').val('<?php echo $row['ba_gr_idx'] ?>');


<?php } ?>
        $('.ba_type').click(function () {
            if ($(this).val() === 'text') {
                $('.ba_text_group, .ba_url_group').show();
                $('.ba_image_group, .ba_html_group').hide();
            }
            if ($(this).val() === 'image') {
                $('.ba_image_group, .ba_url_group').show();
                $('.ba_text_group, .ba_html_group').hide();
            }
            if ($(this).val() === 'html') {
                $('.ba_html_group').show();
                $('.ba_text_group, .ba_image_group, .ba_url_group').hide();
            }

        });
        $('.ba_use_time').click(function () {
            if ($(this).is(':checked')) {
                $('.ba_startday_group, .ba_endday_group').show();
            } else {
                $('.ba_startday_group, .ba_endday_group').hide();
            }
        });
        //숫자만입력
        $(".gr_point, .gr_limit").keyup(function () {
            $(this).val($(this).val().replace(/[^0-9]/g, ""));
        });
        $('.form-group input, .form-group select').click(function () {
            $(this).removeClass('bg-danger');
        });
        $('.submit').click(function () {
            var ba_name = $('#ba_name').val().trim();
            if (ba_name.length < 2) {
                alert('배너제목은 2글자 이상 입력하세요.');
                $('.ba_name').addClass('bg-danger');
                return false;
            }

            //group
            var ba_group = $('.ba_gr_idx > option:selected').val();
            if (ba_group == 0) {
                alert('그룹을 선택하세요.');
                $('.ba_gr_idx').addClass('bg-danger');
                return false;
            }

            //Banner type
            var ba_type = $('.ba_type:checked').val();
            if (ba_type === undefined) {
                alert('배너종류를 선택하세요.');
                return false;
            }
            if (ba_type === 'text') {
                if (!$('.ba_url').val().trim()) {
                    alert('URL을 입력하세요.');
                    $('.ba_url').addClass('bg-danger');
                    return false;
                }
                if (!$('.ba_text').val().trim()) {
                    alert('Text배너를 입력하세요.');
                    $('.ba_text').addClass('bg-danger');
                    return false;
                }
            }
<?php if (!$w) { ?>
                if (ba_type === 'image') {
                    if (!$('.ba_url').val().trim()) {
                        alert('URL을 입력하세요.');
                        $('.ba_url').addClass('bg-danger');
                        return false;
                    }
                    if (!$('.ba_image').val().trim()) {
                        alert('배너 이미지를 첨부하세요.');
                        $('.ba_image').addClass('bg-danger');
                        return false;
                    }
                }
<?php } ?>
            if (ba_type === 'html') {
                if (!$('.ba_html').val().trim()) {
                    alert('HTML을 입력하세요.');
                    $('.ba_html').addClass('bg-danger');
                    return false;
                }
            }
            if ($('.ba_use_time:checked').val() === '1') {
                var startDay = $('.ba_startday').val();
                var endDay = $('.ba_endday').val();
                if (!startDay) {
                    alert('배너 시작날짜를 입력하세요.');
                    $('.ba_startday').addClass('bg-danger');
                    return false;
                }
                if (!endDay) {
                    alert('배너 종료날짜를 입력하세요.');
                    $('.ba_endday').addClass('bg-danger');
                    return false;
                }

                //날짜 비교 
                var toDay = '<?php echo G5_TIME_YMD; ?>';
                var toDayDateArr = toDay.split('-');

                var startDate = startDay;
                var startDateArr = startDate.split('-');

                var endDate = endDay;
                var endDateArr = endDate.split('-');

                var startDateCompare = new Date(startDateArr[0], startDateArr[1], startDateArr[2]);
                var endDateCompare = new Date(endDateArr[0], endDateArr[1], endDateArr[2]);
                var toDayCompare = new Date(toDayDateArr[0], toDayDateArr[1], toDayDateArr[2]);

                if (startDateCompare.getTime() >= endDateCompare.getTime()) {
                    alert("시작날짜와 종료날짜를 확인해 주세요.");
                    return false;
                }
                if (toDayCompare.getTime() > startDateCompare.getTime()) {
                    alert("시작날짜를 오늘보다 이전 날짜로 지정할 수 없습니다.");
                    return false;
                }
                if (toDayCompare.getTime() > endDateCompare.getTime()) {
                    alert("종료날짜를 오늘보다 이전 날짜로 지정할 수 없습니다.");
                    return false;
                }

            }
            return true;

        });
    });
</script>
<!-- Date Picker http://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="./js/moment-with-locales.min.js"></script>
<script src="./js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="./css/bootstrap-datetimepicker.min.css"/>
<script type="text/javascript">
    $(function () {
        $('.ba_startday, .ba_endday').datetimepicker({
            locale: 'ko',
            format: 'YYYY-MM-DD'
        });
    });
</script>
<?php
include_once './ask_footer.php';
