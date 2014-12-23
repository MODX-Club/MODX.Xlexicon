Xlexicon.fields.Languages = ['id', 'menu', 'name', 'active', 'iso_code', 'language_code', 'context'];

Xlexicon.fields.LanguageFields = [{
	xtype: 'textfield',
	fieldLabel: _('xlexicon.field_name'),
	name: 'name',
	anchor: '100%'
}, {
	xtype: 'textfield',
	fieldLabel: _('xlexicon.field_iso'),
	description: _('xlexicon.field_iso_desc'),
	name: 'iso_code',
	anchor: '100%'
}, {
	xtype: 'textfield',
	fieldLabel: _('xlexicon.field_code'),
	description: _('xlexicon.field_code_desc'),
	name: 'language_code',
	anchor: '100%'
}, {
	xtype: 'textfield',
	fieldLabel: _('xlexicon.field_contexts'),
	description: _('xlexicon.field_contexts_desc'),
	name: 'context',
	anchor: '100%'
}, {
	xtype: 'xcheckbox',
	boxLabel: _('xlexicon.field_status'),
	description: _('xlexicon.field_status_desc'),
	hideLabel: true,
	name: 'active'
}];

Xlexicon.fields.LanguageSettings = ['id', 'menu', 'lang_key', 'key', 'value', 'xtype', 'namespace', 'area', 'editedon', 'context'];

Xlexicon.fields.PropertyFields = [{
	xtype: 'textfield',
	fieldLabel: _('name'),
	name: 'namespace',
	allowBlank: false,
	anchor: '99%'
}, {
	xtype: 'textfield',
	fieldLabel: _('key'),
	name: 'key',
	allowBlank: false,
	anchor: '99%'
}, {
	xtype: 'modx-combo-context',
	fieldLabel: _('context'),
	allowBlank: false,
	anchor: '99%'
}, {
	xtype: 'textfield',
	fieldLabel: _('value'),
	name: 'value',
	anchor: '99%'
}];

Xlexicon.fields.DictionaryFields = function (lang, data) {
	data = data || {};
	var key = lang.iso_code;
	var getid = function (val) {
		val = val || '';
		return 'xlexicon-resource-' + val + '-' + key;
	};
	return [{
			xtype: 'hidden',
			fieldLabel: '',
			description: '',
			name: 'xlexicon[' + key + '][id]',
			id: getid('id'),
			allowBlank: true,
			enableKeyEvents: false,
			value: data.id || ''
		}, {
			xtype: 'hidden',
			fieldLabel: '',
			description: '',
			name: 'xlexicon[' + key + '][res]',
			id: getid('res'),
			allowBlank: true,
			enableKeyEvents: false,
			value: data.res || ''
		},
		/* possible future feature
		    ,{
		      xtype: 'xcheckbox'
		      ,boxLabel: _('resource_published')
		      ,hideLabel: true
		      ,description: '<b>[[*published]]</b><br />'+_('resource_published_help')
		      ,name: 'xlexicon['+key+'][published]'
		      ,id: getid('published')
		      ,inputValue: 1
		      ,checked: data.published || 0
		      ,listeners: {'change': {fn:triggerDirtyField,scope:this}}
		    },*/
		{
			xtype: 'textfield',
			fieldLabel: _('resource_pagetitle'),
			description: '<b>[[*pagetitle]]</b><br />' + _('resource_pagetitle_help'),
			name: 'xlexicon[' + key + '][pagetitle]',
			id: getid('pagetitle'),
			maxLength: 255,
			anchor: '100%',
			allowBlank: true,
			enableKeyEvents: true,
			value: data.pagetitle || '',
			listeners: {
				'change': {
					fn: triggerDirtyField,
					scope: this
				}
			}
		}, {
			xtype: 'textfield',
			fieldLabel: _('resource_longtitle'),
			description: '<b>[[*longtitle]]</b><br />' + _('resource_longtitle_help'),
			name: 'xlexicon[' + key + '][longtitle]',
			id: getid('longtitle'),
			maxLength: 255,
			anchor: '100%',
			value: data.longtitle || '',
			listeners: {
				'change': {
					fn: triggerDirtyField,
					scope: this
				}
			}
		}, {
			xtype: 'textfield',
			fieldLabel: _('resource_menutitle'),
			description: '<b>[[*menutitle]]</b><br />' + _('resource_menutitle_help'),
			name: 'xlexicon[' + key + '][menutitle]',
			id: getid('menutitle'),
			maxLength: 255,
			anchor: '100%',
			value: data.menutitle || '',
			listeners: {
				'change': {
					fn: triggerDirtyField,
					scope: this
				}
			}
		}, {
			xtype: 'textarea',
			fieldLabel: _('resource_description'),
			description: '<b>[[*description]]</b><br />' + _('resource_description_help'),
			name: 'xlexicon[' + key + '][description]',
			id: getid('description'),
			maxLength: 255,
			anchor: '100%',
			value: data.description || '',
			listeners: {
				'change': {
					fn: triggerDirtyField,
					scope: this
				}
			}
		}, {
			xtype: 'textarea',
			fieldLabel: _('resource_summary'),
			description: '<b>[[*introtext]]</b><br />' + _('resource_summary_help'),
			name: 'xlexicon[' + key + '][introtext]',
			id: getid('introtext'),
			grow: true,
			anchor: '100%',
			value: data.introtext || '',
			listeners: {
				'change': {
					fn: triggerDirtyField,
					scope: this
				}
			}
		}, {
			xtype: 'textarea',
			fieldLabel: _('resource_content'),
			description: '<b>[[*content]]</b><br />',
			name: 'xlexicon[' + key + '][content]',
			id: getid('content'),
			anchor: '100%',
			height: 400,
			grow: false,
			value: data.content || '',
			listeners: {
				'change': {
					fn: triggerDirtyField,
					scope: this
				}
			}
		}
	];
};
