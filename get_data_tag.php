<?php
class MarkupTag
{
    const DATE_FORMAT  = 'F m, Y';
    const TMP_MAP      = ['pre_formatted','tag','text','end_tag'];

    public static function get_formatted_data($text, $formatted)
    {
        $return 	 = [];
        foreach ($formatted as $t) {
            switch ($t['tag']) {
                case 'date':
                    $return[] = str_replace($t['pre_formatted'], date(self::DATE_FORMAT, strtotime($t['text'])), $text);
                    break;
                default:
            }
        }
        return implode(' ', $return);
    }
    

    public static function get_data_tag($input, $return = false, $start_tag = ['<<','>>'], $end_tag = ['<<-','->>'])
    {
        $regex = '~'.$start_tag[0].'(.*?)'.$start_tag[1].'(.*?)'.$end_tag[0].'(.*?)'.$end_tag[1].'~';
        preg_match_all($regex, $input, $output);
       
        $count_matches = count($output);
        $num_matches   = count($output[0]);
        $_tmp          = [];
        
       
        for ($i=0;$i<$count_matches;$i++) {
            for ($j=0;$j<$num_matches;$j++) {
                $_tmp[$j][self::TMP_MAP[$i]] = $output[$i][$j];
            }
        }
       
        if ($return) {
            return self::get_formatted_data($input, $_tmp);
        }
       
        return $_tmp;
    }
}
