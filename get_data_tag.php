<?php
function get_formatted_data($text,$formatted)
{
    $return 	 = [];
    $date_format = 'F m, Y';
    foreach($formatted as $t)
    {
        switch($t['tag'])
        {
            case 'date':
                $return[] = str_replace($t['pre_formatted'], date($date_format,strtotime($t['text'])), $text);
                break;
            default:
        }
    }
    return implode(' ',$return);
}

function get_data_tag($input,$start_tag = ['<%','%>'],$end_tag = ['<%-','-%>'])
{
    $regex = '~'.$start_tag[0].'(.*?)'.$start_tag[1].'(.*?)'.$end_tag[0].'(.*?)'.$end_tag[1].'~';
    preg_match_all($regex, $input, $output);
    $count_matches = count($output);
    $num_matches   = count($output[0]);
    $_tmp          = [];
    $_tmp_map      = ['pre_formatted','tag','text','end_tag'];
    for($i=0;$i<$count_matches;$i++)
    {
          for($j=0;$j<$num_matches;$j++)
          {
                 $_tmp[$j][$_tmp_map[$i]] = $output[$i][$j];
          }
    }
 
    return $_tmp;
}