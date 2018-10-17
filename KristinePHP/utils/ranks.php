<?php

class Ranks {

    static function getRank($lang, $rank, $withTag = true) {
        $tag = '<span class="tag is-small ';
        switch ($rank) {
            case 0:
                $tag = '';
                $rankName = $lang['GUEST'];
                break;
            case 1:
                $tag = $tag.'is-light">';
                $rankName = $lang['MEMBER'];
                break;
            case 2:
                $tag = $tag.'is-success">';
                $rankName = $lang['VIP'];
                break;
            case 3:
                $tag = $tag.'is-primary">';
                $rankName = $lang['MODERATOR'];
                break;
            case 4:
                $tag = $tag.'is-purple">';
                $rankName = $lang['DEV'];
                break;
            case 5:
                $tag = $tag.'is-danger">';
                echo $tag;
                $rankName = $lang['ADMIN'];
                break;
            default:
                $tag = '';
                $rankName = $lang['GUEST'];
                break;
        }
        if ($withTag) {
            echo $tag.$rankName.'</span>';
        } else {
            echo $rankName;
        }
    }
}
