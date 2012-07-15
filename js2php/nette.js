(function () {
	var Nette = {
		_presenters: {},
		_codes: {},
		_forms: {}
	};

	function Presenter(name, methods) {
		Nette._presenters[name] = methods;

		var s = "class " + name + "Presenter extends Nette\\Application\\UI\\Presenter {\n";

		for (var k in methods) {
			if (methods[k] instanceof Function) {
				var method = methods[k],
					parameters = @@ JS::fromNative(`method->parameters) @@,
					call = @@ JS::fromNative(`method->call) @@;
				s += 
					"public function " + k + "(" + parameters.map(function (p) { return "$" + p; }).join() +
						") {\n" + (k === "startup" ? "parent::startup();\n" : "") +
						"$call = " + @@ var_export(`call, TRUE) @@ + ";\n" +
						"return JS::toNative($call(JS::$global, JS::fromNative($this), " +
							"JS::$global->properties['Nette']->properties['_presenters']->properties[" +
							@@ var_export(`name, TRUE) @@ + "]->properties[" + @@ var_export(`k, TRUE) @@ +
							"], array(" + parameters.map(function (p) {
								return "JS::fromNative($" + p + ")";
							}).join() + ")));\n" +
					"}\n\n";

			} else {
				var v = methods[k];
				if (v === undefined) {
					v = null;
				}

				s += "protected $" + k + " = " + @@ var_export(JS::toNative(`v), TRUE) @@ + ";\n";
				s += "public function get" + k.charAt(0).toUpperCase() + k.substring(1) +
					"() { return $this->" + k + "; }\n";
				s += "public function set" + k.charAt(0).toUpperCase() + k.substring(1) +
					"($newValue) { $this->" + k + " = $newValue; return $this; }\n";
			}
		}

		s += "}\n";

		Nette._codes[name] = s;
	}

	function Form(name, callback) {
		if (callback === undefined) {
			return Nette._forms[name];
		}

		var f = @@ JS::fromNative(new Nette\Forms\Form) @@;
		callback.call(f);

		return Nette._forms[name] = f;
	}

	Nette.Presenter = Presenter;
	Nette.Form = Form;

	global.Nette = Nette;
})();
