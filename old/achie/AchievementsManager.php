<?php
require_once 'Achievement.php';
class AchievementsManager {

    private $achievements = array();

    public function loadAchievements() {
        $this->addAchievement(new Achievement(0, 'Developer', 'dev', 'Description'));
    }

    public function addAchievement($achievement) {
        $this->achievements[] = $achievement;
    }

    public function getAchievements() {
        return $this->achievements;
    }

    public function searchAchievement($id) {
        foreach ($this->getAchievements() as $a) {
            if ($a->getId() === $id) {
                return $a;
            }
        }
        return $this->achievements[0];
    }
}
?>