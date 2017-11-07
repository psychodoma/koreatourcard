<?php
error_reporting(E_ALL ^ E_NOTICE);

header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

date_default_timezone_set("Asia/Seoul");
// --
// 첨부 이미지 저장 디렉토리 
// --

/// $path = 'data';
$path = '../data/geditor';

// --

$obj   = $_POST[obj];
$token = $_POST[token];
$work  = $_POST[work];

if (!$token) exit;

if (!$obj) 
    alert('오브젝트 변수가 없습니다.');

if ($work == 'delete') {
    delete_image($token, $path.'/'.date('ym'));
    exit;
}

$file = $_FILES[image];
$size = getImageSize($file[tmp_name]);
$mime = array('image/png', 'image/jpeg', 'image/gif');

if (!is_uploaded_file($file[tmp_name]))
    alert("첨부파일이 업로드되지 않았습니다.\\n\\n$file[error]");

if (!in_array($size['mime'], $mime))
    alert("PNG, GIF, JPG 형식의 이미지 파일만 업로드 가능합니다.");

if (!is_dir($path))
    alert("$path 디렉토리가 존재하지 않습니다.");

if (!is_writable($path))
    alert("$path 디렉토리의 퍼미션을 707로 변경해주세요.");

add_index($path);

$path .= '/'.date('ym');

if (!is_dir($path)) 
{
    @mkdir($path, 0707);
    @chmod($path, 0707);

    if (!is_dir($path))
        alert('디렉토리 생성에 실패하였습니다.');

    add_index($path);
}

delete_image($token, $path);

$dest_file = $path.'/'.$file[name];
$count = 0;

while (file_exists($dest_file))
    $dest_file = $path.'/['.$count++.']'.$file[name];

move_uploaded_file($file[tmp_name], $dest_file);

chmod($dest_file, 0606);

/// $file = dirname($_SERVER["PHP_SELF"]).'/'.$dest_file;
$file = $dest_file;

setCookie('ge_token', $token);
setCookie('ge_file', $dest_file);

function add_index($path) {
    $indexfile = $path."/index.php";
    $f = @fopen($indexfile, "w");
    @fwrite($f, "");
    @fclose($f);
    @chmod($indexfile, 0606);
}

function delete_image($token, $path) {
    global $_COOKIE;
    if ($token==$_COOKIE[ge_token]) {
        if (substr($_COOKIE[ge_file], 0, strlen($path))==$path) {
            if (file_exists($_COOKIE[ge_file])) {
                @unlink($_COOKIE[ge_file]);
            }
        }
    }
}

function alert($msg='', $url='') {
    echo "<script language='javascript'>alert('$msg'); </script>";
    exit;
}

?>
<script language="javascript">
parent.<?php echo $obj?>.insert_image_preview("<?php echo $file?>");
</script>
