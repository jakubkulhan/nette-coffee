<?php
require_once __DIR__ . '/../js/image.php';
class HomepagePresenter extends Nette\Application\UI\Presenter {
protected $who = 'world';
public function getWho() { return $this->who; }
public function setWho($newValue) { $this->who = $newValue; return $this; }
public function startup() {
parent::startup();
$call = '_a8eeae0fc8d46ced876f919fa2bd7ee1_9';
return JS::toNative($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['startup'], array()));
}

public function actionSomebody($name) {
$call = '_a8eeae0fc8d46ced876f919fa2bd7ee1_11';
return JS::toNative($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['actionSomebody'], array(JSObjectWrapper::wrapObject($name))));
}

public function actionFormSent() {
$call = '_a8eeae0fc8d46ced876f919fa2bd7ee1_12';
return JS::toNative($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['actionFormSent'], array()));
}

public function renderDefault() {
$call = '_a8eeae0fc8d46ced876f919fa2bd7ee1_13';
return JS::toNative($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['renderDefault'], array()));
}

}
