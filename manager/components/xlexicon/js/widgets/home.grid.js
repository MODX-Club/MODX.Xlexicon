Xlexicon.grid.Languages = function (config) {
	config = config || {};
	this.sm = new Ext.grid.CheckboxSelectionModel();
	this.id = 'xlexicon-grid-languages-' + Ext.id();
	Ext.applyIf(config, {
		id: this.id,
		sm: this.sm,
		baseParams: {
			action: 'getList'
		},
		save_action: 'updateFromGrid',
		fields: Xlexicon.fields.Languages,
		paging: true,
		remoteSort: true,
		autosave: true,
		clicksToEdit: 1,
		autoExpandColumn: 'name',
		waitMsg: _('xlexicon.loader'),
		emptyText: _('xlexicon.grid_nodata'),
		columns: this.getColumnModel(),
		listeners: {
			success: {
				fn: this.refresh,
				scope: this
			}
		},
		tbar: [{
			text: _('xlexicon.button_newLanguage'),
			handler: {
				xtype: 'xlexicon-window-language-create',
				blankValues: true,
				url: this.url
			}
		}, '->', {
			xtype: 'textfield',
			id: 'xlexicon-search-filter' + Ext.id(),
			emptyText: _('xlexicon.search'),
			listeners: {
				'change': {
					fn: this.search,
					scope: this
				},
				'render': {
					fn: function (cmp) {
						new Ext.KeyMap(cmp.getEl(), {
							key: Ext.EventObject.ENTER,
							fn: function () {
								this.fireEvent('change', this);
								this.blur();
								return true;
							},
							scope: cmp
						});
					},
					scope: this
				}
			}
		}]
	});
	Xlexicon.grid.Languages.superclass.constructor.call(this, config);

	// reload grid after change
	var scope = this;
	this.store.on('update', function (store, r, op) {
		if (op == 'commit') {
			scope.refresh();
		}
	});
};
Ext.extend(Xlexicon.grid.Languages, MODx.grid.Grid, {
	search: function (tf, nv, ov) {
		var s = this.getStore();
		s.baseParams.query = tf.getValue();
		this.getBottomToolbar().changePage(1);
		this.refresh();
	},
	getColumnModel: function () {
		return new Ext.grid.ColumnModel({
			grid: this,
			defaults: {
				sortable: true
			},
			columns: Xlexicon.columns.Languages.call(this),
			getCellEditor: this.getCellEditor
		});
	},
	getCellEditor: function (colIndex, rowIndex) {
		var record = this.grid.store.getAt(rowIndex),
			fieldName = this.getDataIndex(colIndex),
			o;
		switch (fieldName) {
			default: o = MODx.load({
				xtype: 'textfield'
			});
			break;
		}
		return new Ext.grid.GridEditor(o);
	},
		// show special tab with options
	propLanguage: function (btn, e) {
		var r = this.menu.record;
		var tab = Ext.get('newtab');
		var xtype = 'xlexicon-grid-language-properties';
		if (!tab) {
			Ext.getCmp('xlexicon-tab-language-default').add({
				xtype: xtype,
				id: xtype + r.id,
				title: r.name,
				data: {
					id: r.id,
					contexts: r.context
				},
				closable: true,
				listeners: {
					'success': {
						fn: this.refresh,
						scope: this
					}
				}
			}).show();
		} else {
			Ext.getCmp('newtab').show();
		}
	},
		// update language
	updateLanguage: function (btn, e) {
		if (!this.languageUpdate) {
			this.languageUpdate = MODx.load({
				xtype: 'xlexicon-window-language-update',
				record: this.menu.record,
				listeners: {
					'success': {
						fn: this.refresh,
						scope: this
					}
				}
			});
		}
		this.languageUpdate.setValues(this.menu.record);
		this.languageUpdate.show(e.target);
	},
	// remove language
	removeLanguage: function () {
		MODx.msg.confirm({
			title: _('xlexicon.language_remove'),
			text: _('xlexicon.language_remove_confirm'),
			url: this.url,
			params: {
				action: 'remove',
				id: this.menu.record.id
			},
			listeners: {
				'success': {
					fn: this.refresh,
					scope: this
				}
			}
		});
	}
});
Ext.reg('xlexicon-grid-languages', Xlexicon.grid.Languages);
