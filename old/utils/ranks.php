<?php

class Ranks {

    public function getRank($rank, $withTag = true) {
        $tag = '<span class="tag is-small ';
        switch ($rank) {
            case 1:
                $tag = $tag.'is-light">';
                $rankName = getMessage('ranks', 'member');
                break;
            case 2:
                $tag = $tag.'is-success">';
                $rankName = getMessage('ranks', 'vip');
                break;
            case 3:
                $tag = $tag.'is-primary">';
                $rankName = getMessage('ranks', 'moderator');
                break;
            case 4:
                $tag = $tag.'is-purple">';
                $rankName = getMessage('ranks', 'developer');
                break;
            case 5:
                $tag = $tag.'is-danger">';
                echo $tag;
                $rankName = getMessage('ranks', 'administrator');
                break;
            default:
                $tag = '';
                $rankName = getMessage('ranks', 'guest');
                break;
        }
        if ($withTag) {
            echo $tag.$rankName.'</span>';
        } else {
            echo $rankName;
        }
    }
}
