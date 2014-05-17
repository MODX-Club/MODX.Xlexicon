Xlexicon.grid.LanguageSettings = function(config) {
  config = config || {};
  var arrayContext = config.data.contexts.split(",");
  var storeContextData = [];
  for (var k=0; k < arrayContext.length; k++) {
    storeContextData.push([arrayContext[k]]);
  }
  var storeContext = new Ext.data.ArrayStore({
      fields: ['context']
      ,data : storeContextData
  });
  Ext.applyIf(config,{
    url: config.url || Xlexicon.config.connectorsUrl + 'settings.php'
    ,baseParams: {
      action: 'getList'
      ,langid: config.data.id
      ,contextlm: arrayContext[0]
    }
    ,save_action: 'updateFromGrid'
    ,fields: Xlexicon.fields.LanguageSettings
    ,paging: true
    ,autosave: true
    ,remoteSort: false
    ,autoExpandColumn: 'lang_key'
    ,columns: Xlexicon.columns.LanguageSettings.call(this,config.data)
    ,tbar: [{
      text: _('xlexicon.button_newProperty')
      ,handler: { xtype: 'xlexicon-window-property-create' , langid: config.data.id, blankValues: true}
    },' ',{
      xtype: 'modx-combo'
      ,hiddenName: 'context'
      ,store: storeContext
      ,mode: 'local'
      ,editable: false
      ,displayField: 'context'
      ,valueField: 'context'
      ,value: arrayContext[0]
      ,id: 'mlc' + config.data.id
      ,listeners: {'select': {fn: this.filterByContext, scope:this}}
    }]
    
  });
  Xlexicon.grid.LanguageSettings.superclass.constructor.call(this,config);
};
Ext.extend(Xlexicon.grid.LanguageSettings,MODx.grid.Grid,{
  filterByContext: function(cb) {        
    this.getStore().baseParams['contextlm'] = cb.value;
    this.getBottomToolbar().changePage(1);
    this.refresh();
  }
  ,removeProperty: function() {
    MODx.msg.confirm({
      title: _('xlexicon.property_remove',{property:this.menu.record.namespace})
      ,text: _('xlexicon.property_remove_confirm')
      ,url: this.config.url
      ,params: {
        action: 'remove'
        ,id: this.menu.record.id
      }
      ,listeners: {
        'success': {fn:this.refresh,scope:this}
      }
    });
  }
  ,updateProperty: function(btn,e) {
    if (!this.propertyUpdate) {
      this.propertyUpdate = MODx.load({
        xtype: 'xlexicon-window-property-update'
        ,record: this.menu.record
        ,listeners: {
          'success': {fn:this.refresh,scope:this}
        }
      });
    }
    this.propertyUpdate.setValues(this.menu.record);
    this.propertyUpdate.show(e.target);
  }
});
Ext.reg('xlexicon-grid-language-properties',Xlexicon.grid.LanguageSettings);