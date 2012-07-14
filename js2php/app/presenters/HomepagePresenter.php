<?php
require_once __DIR__ . '/../js/image.php';
class HomepagePresenter extends Nette\Application\UI\Presenter {
public function startup() {
parent::startup();
$call = '_90c6abdadd577794d0015ff1652ac9a5_9';
return JS::toNative($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['startup'], array()));
}

public function actionSomebody($name) {
$call = '_90c6abdadd577794d0015ff1652ac9a5_11';
return JS::toNative($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['actionSomebody'], array(JSObjectWrapper::wrapObject($name))));
}

public function actionFormSent($name) {
$call = '_90c6abdadd577794d0015ff1652ac9a5_13';
return JS::toNative($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['actionFormSent'], array(JSObjectWrapper::wrapObject($name))));
}

public function renderDefault() {
$call = '_90c6abdadd577794d0015ff1652ac9a5_14';
return JS::toNative($call(JS::$global, JSObjectWrapper::wrapObject($this), JS::$global->properties['Nette']->properties['_presenters']->properties['Homepage']->properties['renderDefault'], array()));
}

}
