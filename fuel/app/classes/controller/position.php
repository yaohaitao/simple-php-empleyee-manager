<?php


class Controller_Position extends Fuel\Core\Controller {

    public function action_show_positions() {
        return Response::forge(Presenter::forge('position'));
    }

}