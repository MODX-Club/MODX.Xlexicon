Xlexicon.columns.Languages = function (config) {
	return [
		this.sm, {
			header: _('id'),
			dataIndex: 'id',
			sortable: true,
			width: 5,
			hidden: true
		}, {
			header: _('name'),
			dataIndex: 'name',
			sortable: true,
			width: 35,
			editor: {
				xtype: 'textfield'
			}
		}, {
			header: _('xlexicon.field_iso'),
			dataIndex: 'iso_code',
			sortable: false,
			editable: false,
			width: 10,
			editor: {
				xtype: 'textfield'
			}
		}, {
			header: _('xlexicon.field_code'),
			dataIndex: 'language_code',
			sortable: false,
			editable: false,
			width: 10,
			editor: {
				xtype: 'textfield'
			}
		}, {
			header: _('xlexicon.field_contexts'),
			dataIndex: 'context',
			sortable: false,
			width: 10,
			editor: {
				xtype: 'textfield'
			}
		}, {
			header: _('xlexicon.field_status'),
			dataIndex: 'active',
			sortable: false,
			width: 10,
			renderer: function (value) {
				return value ? _('xlexicon.status_true') : _('xlexicon.status_false');
			}
		}
	];
};

Xlexicon.columns.LanguageSettings = function (config) {
	return [{
		header: _('id'),
		hidden: true,
		id: 'xlexicon-grid-lang-id-' + config.id,
		dataIndex: 'id',
		sortable: true,
		width: 5
	}, {
		hidden: true,
		id: 'xlexicon-grid-lang-context-' + config.id,
		hideable: false,
		dataIndex: 'context'
	}, {
		hidden: true,
		id: 'xlexicon-grid-lang-xtype-' + config.id,
		hideable: false,
		dataIndex: 'xtype'
	}, {
		hidden: true,
		id: 'xlexicon-grid-lang-area-' + config.id,
		hideable: false,
		dataIndex: 'area'
	}, {
		hidden: true,
		id: 'xlexicon-grid-lang-lang_key-' + config.id,
		hideable: false,
		dataIndex: 'lang_key'
	}, {
		header: _('name'),
		id: 'xlexicon-grid-lang-namespace-' + config.id,
		dataIndex: 'namespace',
		sortable: true,
		width: 30
	}, {
		header: _('key'),
		id: 'xlexicon-grid-lang-key-' + config.id,
		dataIndex: 'key',
		sortable: true,
		width: 10
	}, {
		header: _('value'),
		id: 'xlexicon-grid-lang-value-' + config.id,
		dataIndex: 'value',
		sortable: true,
		width: 10,
		editor: {
			xtype: 'textfield'
		}
	}, {
		header: _('xlexicon.field_edited'),
		id: 'xlexicon-grid-lang-editedon-' + config.id,
		dataIndex: 'editedon',
		sortable: true,
		width: 15
	}];
};
