<?php

use Fuel\Core\Presenter;

class Presenter_Position extends Presenter {

    public function view() {

        $this->positions = Model_Orm_Position::list_positions();

    }

}