<?php
class json_operations
{
//    Extracts data from a json file as an array of:
//    [0] = homepage link
//    [1] = links (index matches title index)
//    [2] = titles (index matches link index)
    static function get_data($filename){
        $json = file_get_contents($filename);
        $json = json_decode($json,true);
        $links = array();
        $titles = array();
        $home = '';
        foreach ($json as $k=>$v){
            if($k=="homepage"){
                $home = $v;
            }
            if ($k == "pages"){
                foreach ($v as $item){
                    $i= 0;
                    foreach ($item as $res){
                        if ($i == 0){
                            //echo "Link" . $res . "\n"; // etc.
                            array_push($links,$res);
                        }elseif ($i == 1){
                            //echo "Title" . $res . "\n\n"; // etc.
                            array_push($titles,$res);
                        }
                        $i++;
                    }
                }
            }
        }
        $result = array($home, $links, $titles);
        return $result;
    }
}