<?php
require_once __DIR__ . '/../js/image.php';
class HomepagePresenter extends Nette\Application\UI\Presenter {
protected $who = 'world';
public function getWho() { return $this->who; }
public function setWho($newValue) { $this->who = $newValue; return $this; }
public function startup() {
parent::startup();
$call = '_4822db964cea9e5a953d9004e9c17abb_9';
return JS::toNative($call(JS::$global, JS::fromNative($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['startup'], array()));
}

public function actionSomebody($name) {
$call = '_4822db964cea9e5a953d9004e9c17abb_11';
return JS::toNative($call(JS::$global, JS::fromNative($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['actionSomebody'], array(JS::fromNative($name))));
}

public function actionFormSent() {
$call = '_4822db964cea9e5a953d9004e9c17abb_12';
return JS::toNative($call(JS::$global, JS::fromNative($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['actionFormSent'], array()));
}

public function renderDefault() {
$call = '_4822db964cea9e5a953d9004e9c17abb_13';
return JS::toNative($call(JS::$global, JS::fromNative($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['renderDefault'], array()));
}

}
