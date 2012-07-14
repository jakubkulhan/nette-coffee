Nette.Presenter "Homepage", {
	who: "world"

	startup: ->
		presenter = this

		Nette.Form "Name", ->
			@setMethod "GET"
			@setAction presenter.link "formSent"
			@addText "name"
			@addSubmit "submit", "Say hello!"

	actionSomebody: (name) ->
		@who = name
		@setView("default")
	
	actionFormSent: ->
		@redirect "somebody", [(Nette.Form "Name").getComponent("name").value]

	renderDefault: ->
		@template.add "who", @who
		@template.add "form", Nette.Form "Name"
}
