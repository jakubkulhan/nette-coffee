<?php
class JSClassDumper
{
	static function dumpStaticProperties($class)
	{
		$reflection = new ReflectionClass($class);

		return "foreach (unserialize(" . var_export(serialize($reflection->getStaticProperties()), TRUE) .
			") as \$k => \$v) $class::\$\$k = \$v;";
	}
}
