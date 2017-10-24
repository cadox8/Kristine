<?php

class BBCodeParser {

    static function parse($msg) {
        $parts = explode(" ", $msg);
        $finalMSG;
        $id = 0;

        foreach ($parts as $s) {
            $id++;
            // URL
            if (startsWith($s, '[URL]') && endsWith($s, '[/URL]')) $s = '<a target="_blank" href="'.$s.'">'.$s.'</a>';
            // Bold
            if (startsWith($s, '[B]') && endsWith($s, '[/B]')) $s = '<strong>'.$s.'</strong>';

            $finalMSG += $s.' ';
        }
        unset($s);
        return $finalMSG;
    }


    function startsWith($string, $search) {
         $length = strlen($search);
         return (substr($string, 0, $length) === $search);
    }

    function endsWith($string, $search) {
        $length = strlen($search);
        return $length === 0 || (substr($string, -$length) === $search);
    }
}
