<?php
$KEY_PRESS = "KeyStrPress ";
$KEY_RELEASE = "KeyStrRelease ";
$DELAY = "Delay ";
$CTRL = "Control_L"; #좌측 컨트롤
$AL = "Alt_L"; #좌측 알트
$SPACE = "space"; #스페이스바
$ENTER = "Return"; #엔터
$SHIFT = "Shift_L"; #좌측 쉬프트
$COMMA = "comma"; #콤마
$PERIOD = "period"; #마침표
$BLEFT = "bracketleft"; #대괄호(좌)
$BRIGHT = "bracketright"; #대관호(우)
$SEMICOLON = "semicolon";
$APPA = "apostrophe";
$SLASH = "slash";
$BSLASH = "backslash";
$BACKSPACE = "BackSpace";
$past = '';
$sec_past = '';
$SPACE_CNT = 0;
function check_shift($input, $past_i, $sec_past_i){
    global $past;
    global $KEY_PRESS;
    global $KEY_RELEASE;
    global $SHIFT;
    global $COMMA;
    global $PERIOD;
    global $BLEFT;
    global $BRIGHT;
    global $SEMICOLON;
    global $APPA;
    global $SLASH;
    global $BSLASH;
    global $BACKSPACE;
    global $ENTER;
    if($past_i == "\n" and $sec_past_i == ";"){
        print $KEY_PRESS.$BACKSPACE."\n";
        print $KEY_RELEASE.$BACKSPACE."\n";
    }
    switch($input){
        case '!':
            print $KEY_PRESS.$SHIFT."\n";
            print $KEY_PRESS."1\n";
            print $KEY_RELEASE."1\n";
            print $KEY_RELEASE.$SHIFT."\n";
            break;
        case '#':
            print $KEY_PRESS.$SHIFT."\n";
            print $KEY_PRESS."3\n";
            print $KEY_RELEASE."3\n";
            print $KEY_RELEASE.$SHIFT."\n";
            break;
        case '(':
            print $KEY_PRESS.$SHIFT."\n";
            print $KEY_PRESS."9\n";
            print $KEY_RELEASE."9\n";
            print $KEY_RELEASE.$SHIFT."\n";
            break;
        case ')' :
            print $KEY_PRESS.$SHIFT."\n";
            print $KEY_PRESS."0\n";
            print $KEY_RELEASE."0\n";
            print $KEY_RELEASE.$SHIFT."\n";
            break;
        case '>':
            print $KEY_PRESS.$SHIFT."\n";
            print $KEY_PRESS.$PERIOD."\n";
            print $KEY_RELEASE.$PERIOD."\n";
            print $KEY_RELEASE.$SHIFT."\n";
            break;
        case '<':
            print $KEY_PRESS.$SHIFT."\n";
            print $KEY_PRESS.$COMMA."\n";
            print $KEY_RELEASE.$COMMA."\n";
            print $KEY_RELEASE.$SHIFT."\n";
            break;
        case '{':
            print $KEY_PRESS.$SHIFT."\n";
            print $KEY_PRESS.$BLEFT."\n";
            print $KEY_RELEASE.$BLEFT."\n";
            print $KEY_RELEASE.$SHIFT."\n";
            break;
        case '}':
            print $KEY_PRESS.$SHIFT."\n";
            print $KEY_PRESS.$BRIGHT."\n";
            print $KEY_RELEASE.$BRIGHT."\n";
            print $KEY_RELEASE.$SHIFT."\n";
            break;
        case '"':
            print $KEY_PRESS.$SHIFT."\n";
            print $KEY_PRESS.$APPA."\n";
            print $KEY_RELEASE.$APPA."\n";
            print $KEY_RELEASE.$SHIFT."\n";
            break;
        case ',':
            print $KEY_PRESS.$COMMA."\n";
            print $KEY_RELEASE.$COMMA."\n";
            break;
        case '.':
            print $KEY_PRESS.$PERIOD."\n";
            print $KEY_RELEASE.$PERIOD."\n";
            break;
        case ';':
            print $KEY_PRESS.$SEMICOLON."\n";
            print $KEY_RELEASE.$SEMICOLON."\n";
            break;
        default:
            if($input == '\0') break;
            print $KEY_PRESS.$input."\n";
            print $KEY_RELEASE.$input."\n";
            break;
    }
}
function input_start($file, $key, $chk_shell)
{
    global $DELAY;
    global $KEY_PRESS;
    global $KEY_RELEASE;
    global $CTRL;
    global $AL;
    global $SPACE;
    global $ENTER;
    global $past;
    global $sec_past;
    global $SPACE_CNT;
    $CUR_CNT = 0;
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
    print $KEY_PRESS.$ENTER."\n";
    print $KEY_RELEASE.$ENTER."\n";
#   print $DELAY."2\n";
    while(!feof($file)){
        $in = fgetc($file);
        if($in == "\0") break;
        if($in == " ") {
            print $KEY_PRESS.$SPACE."\n";
            print $KEY_RELEASE.$SPACE."\n";
        }
        elseif($in == "\n"){
            print $KEY_PRESS.$ENTER."\n";
            print $KEY_RELEASE.$ENTER."\n";
        }
        else {
            check_shift($in, $past, $sec_past);
        }
        $sec_past = $past;
        $past = $in;
    }
}

$new_shell = false; #쉘 실행여부
if($argv[1] == "-y") $new_shell = true; //실행을 바라면 시작
$input_file = fopen($argv[2], "r") or die("파일을 찾을 수 없습니다.");
$get_file_KEY = array();
$cnt = 0;
input_start($input_file, $get_file_KEY, $new_shell);
?>