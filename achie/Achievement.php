<?php
class Achievement {

    private $id;
    private $name;
    private $icon;
    private $description;

    public function __construct($id, $name, $icon, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function getDescription() {
        return $this->description;
    }
}
?>