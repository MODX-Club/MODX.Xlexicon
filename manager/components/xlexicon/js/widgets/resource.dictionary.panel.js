Xlexicon.panel.Dictionary = function (config) {
	config = config || {};
	this.id = config.id || 'xlexicon-panel-dictionary-' + Ext.id();
	var dict = config.dict;
	var lang = config.lang;
	var code = lang.iso_code;

	Ext.apply(config, {
		title: lang.name || "Unknown [" + code + "]",
		lang: code,
		cls: 'lang-' + config.code,
		listeners: {
			activate: {
				fn: this.activate,
				scope: this
			},
			deactivate: {
				fn: this.deactivate,
				scope: this
			}
		},
		items: [Xlexicon.fields.DictionaryFields.call(this, lang, dict)]
	});

	Xlexicon.panel.Dictionary.superclass.constructor.call(this, config);
	//this.fireEvent('setup');
};
Ext.extend(Xlexicon.panel.Dictionary, MODx.Panel, {

	activate: function () {
		var id = 'xlexicon-resource-content-' + this.lang;
		if (MODx.config.use_editor && MODx.loadRTE) {
			MODx.loadRTE(id);
		}
	},
	deactivate: function () {
		var id = 'xlexicon-resource-content-' + this.lang;
	}

});

Ext.reg('xlexicon-panel-dictionary', Xlexicon.panel.Dictionary);
