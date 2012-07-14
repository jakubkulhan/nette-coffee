#!/usr/bin/php
<?php
require __DIR__ . '/JSClassDumper.php';
require __DIR__ . '/JavascriptParser.php';
require __DIR__ . '/JavascriptCompiler.php';
require __DIR__ . '/JavascriptInterpreter.php';
require __DIR__ . '/image.php';

if (!isset($argv[1]) || $argv[1] === '-h' || $argv[1] === '--help' || !isset($argv[2])) {
	die("usage: {$argv[0]} <file to compile> <outdir>\n");
}

$code = `coffee --bare --print "{$argv[1]}"`;
$code = file_get_contents(__DIR__ . '/nette.js') . $code . "\nreturn Nette._codes;";

$definedFunctions = get_defined_functions();
$definedFunctions = $definedFunctions['user'];

$interpreter = new JavascriptInterpreter($code);
$lines = explode("\n", $interpreter->compile());
$codes = $interpreter->run();

$newDefinedFunctions = get_defined_functions();
$newDefinedFunctions = $newDefinedFunctions['user'];
$image = '';

foreach (array_diff($newDefinedFunctions, $definedFunctions) as $function) {
	if (substr($function, -2) === '_0') {
		// discard main function, not needed anymore
		continue;
	}

	$reflection = new ReflectionFunction($function);

	$image .= implode("\n", array_slice(
		$lines,
		$reflection->getStartLine() - 1,
		$reflection->getEndLine() - $reflection->getStartLine() + 1)) . "\n";
}

@mkdir("{$argv[2]}/presenters", 0755, TRUE);
foreach ((array) $codes as $presenter => $code) {
	$code = "<?php\n" .
		"require_once __DIR__ . '/../js/image.php';\n" .
		$code;

	file_put_contents("{$argv[2]}/presenters/{$presenter}Presenter.php", $code);
}

@mkdir("{$argv[2]}/js", 0755, TRUE);
file_put_contents("{$argv[2]}/js/image.php",
	"<?php\n" .
	substr(file_get_contents(__DIR__ . '/image.php'), 5) . // stripping <?php
	substr(file_get_contents(__DIR__ . '/JSObjectWrapper.php'), 5) .
	$image .
	JSClassDumper::dumpStaticProperties('JS'));
