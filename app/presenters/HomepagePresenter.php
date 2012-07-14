<?php
require_once __DIR__ . '/../js/image.php';
class HomepagePresenter extends Nette\Application\UI\Presenter {
protected $who = 'world';
public function getWho() { return $this->who; }
public function setWho($newValue) { $this->who = $newValue; return $this; }
public function startup() {
parent::startup();
$call = '_46f91fc542dceee1f691dd6daa6a4a0f_9';
return JSObjectWrapper::unwrapObject($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['startup'], array()));
}

public function actionSomebody($name) {
$call = '_46f91fc542dceee1f691dd6daa6a4a0f_11';
return JSObjectWrapper::unwrapObject($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['actionSomebody'], array(JSObjectWrapper::wrapObject($name))));
}

public function actionFormSent() {
$call = '_46f91fc542dceee1f691dd6daa6a4a0f_12';
return JSObjectWrapper::unwrapObject($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['actionFormSent'], array()));
}

public function renderDefault() {
$call = '_46f91fc542dceee1f691dd6daa6a4a0f_13';
return JSObjectWrapper::unwrapObject($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['renderDefault'], array()));
}

}
