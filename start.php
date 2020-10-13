<?php
$KEY_PRESS = "KeyStrPress ";
$KEY_RELEASE = "KeyStrRelease ";
$DELAY = "Delay ";
$CTRL = "Control_L"; #좌측 컨트롤
$AL = "Alt_L"; #좌측 알트
$SPACE = "space";
$ENTER = "Return";
function input_start($file, $key, $chk_shell)
{
    global $DELAY;
    global $KEY_PRESS;
    global $KEY_RELEASE;
    global $CTRL;
    global $AL;
    global $SPACE;
    global $ENTER;

    if($chk_shell) {
        print $KEY_PRESS.$CTRL."\n";
        print $KEY_PRESS.$AL."\n";
        print $KEY_PRESS."t\n";
        print $KEY_RELEASE."t\n";
        print $KEY_RELEASE.$AL."\n";
        print $KEY_RELEASE.$CTRL."\n";
    }
    #####################에디터 실행 부분###################
    print $KEY_PRESS."s\n"; # s
    print $KEY_RELEASE."s\n";
    print $KEY_PRESS."h\n"; # h
    print $KEY_RELEASE."h\n";
    print $KEY_PRESS.$SPACE."\n"; # SPACE
    print $KEY_RELEASE.$SPACE."\n";
    print $KEY_PRESS."t\n"; # t
    print $KEY_RELEASE."t\n";
    print $KEY_PRESS."h\n"; # h
    print $KEY_RELEASE."h\n";
    print $KEY_PRESS."a\n"; # a
    print $KEY_RELEASE."a\n";
    print $KEY_PRESS."t\n"; # t
    print $KEY_RELEASE."t\n";
    print $KEY_PRESS.$ENTER."\n";
    print $KEY_RELEASE.$ENTER."\n";
    ####################################################
}

$new_shell = false; #쉘 실행여부
if($argv[1] == "-y") $new_shell = true; //실행을 바라면 시작
$input_file = fopen($argv[2], "r") or die("파일을 찾을 수 없습니다.");
$get_file_KEY = array();
$cnt = 0;
input_start($input_file, $get_file_KEY, $new_shell);
?>