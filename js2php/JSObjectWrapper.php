<?php
class JSObjectWrapper
{
	static $wrappedObjects = array();

	static function wrapObject($o)
	{
		if (!is_object($o)) {
			return JS::fromNative($o);
		}

		if (isset(self::$wrappedObjects[spl_object_hash($o)])) {
			return self::$wrappedObjects[spl_object_hash($o)];
		}

		$wrapped = clone JS::$objectTemplate;
		$wrapped->object = $o;

		$reflection = new ReflectionClass($o);

		$wrapped->class = $reflection->getName();

		foreach ($reflection->getMethods() as $method) {
			$name = $method->getName();

			if (substr($name, 0, 3) === 'get' && $method->getNumberOfParameters() === 0) {
				$pname = lcfirst(substr($name, 3));

				if (!isset($wrapped->attributes[$pname])) {
					$wrapped->attributes[$pname] = 0;
				}

				$wrapped->attributes[$pname] |= JS::HAS_GETTER;
				$wrapped->getters[$pname] = clone JS::$functionTemplate;
				$wrapped->getters[$pname]->call = 'wrappedMethod';
				$wrapped->getters[$pname]->name = $name;
				$wrapped->getters[$pname]->parameters = array();

			} else if (substr($name, 0, 3) === 'set' && $method->getNumberOfParameters() === 1) {
				$pname = lcfirst(substr($name, 3));

				if (!isset($wrapped->attributes[$pname])) {
					$wrapped->attributes[$pname] = 0;
				}

				$wrapped->attributes[$pname] |= JS::HAS_SETTER;
				$wrapped->setters[$pname] = clone JS::$functionTemplate;
				$wrapped->setters[$pname]->call = 'wrappedMethod';
				$wrapped->setters[$pname]->name = $name;
				$wrapped->setters[$pname]->parameters = array($pname);
			}

			$wrapped->properties[$name] = clone JS::$functionTemplate;
			$wrapped->attributes[$name] = 0;
			$wrapped->properties[$name]->call = 'wrappedMethod';
			$wrapped->properties[$name]->name = $name;
			$wrapped->properties[$name]->parameters =
				array_map(function ($param) { return $param->name; }, $method->getParameters());
		}

		return $wrapped;
	}

	static function unwrapObject($o)
	{
		if (is_object($o) && isset($o->object)) {
			return $o->object;
		}

		return JS::toNative($o);
	}
}

function wrappedMethod($global, $leThis, $fn, array $args)
{
	$ret = call_user_func_array(array($leThis->object, $fn->name),
		array_map(function ($arg) { return JSObjectWrapper::unwrapObject($arg); }, $args));

	if (is_object($ret)) {
		return JSObjectWrapper::wrapObject($ret);
	}

	return JS::fromNative($ret);
}
