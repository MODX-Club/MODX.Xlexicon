Xlexicon.window.LanguageCreate = function(config) {
  config = config || {};

  Ext.applyIf(config,{
    title: _('xlexicon.window_newLanguage')
    ,url: config.url || Xlexicon.config.connectorsUrl + 'languages.php'
    ,baseParams: {
      action: 'create'
    }
    ,fields: Xlexicon.fields.LanguageFields
  });
  Xlexicon.window.LanguageCreate.superclass.constructor.call(this,config);
};
Ext.extend(Xlexicon.window.LanguageCreate,MODx.Window);
Ext.reg('xlexicon-window-language-create',Xlexicon.window.LanguageCreate);

Xlexicon.window.LanguageUpdate = function(config) {
  config = config || {};
  Ext.applyIf(config,{
    title: _('xlexicon.window_updateLanguage')
    ,url: config.url || Xlexicon.config.connectorsUrl + 'languages.php'
    ,baseParams: {
      action: 'update'
    }
    ,fields: Xlexicon.fields.LanguageFields.concat(
      {
        xtype: 'hidden'
        ,name: 'id'
      }
    )
  });
  Xlexicon.window.LanguageUpdate.superclass.constructor.call(this,config);
};
Ext.extend(Xlexicon.window.LanguageUpdate,MODx.Window);
Ext.reg('xlexicon-window-language-update',Xlexicon.window.LanguageUpdate);

Xlexicon.window.PropertyCreate = function(config) {
  config = config || {};
  Ext.applyIf(config,{
    title: _('xlexicon.window_newProperty')
    ,url: config.url || Xlexicon.config.connectorsUrl + 'settings.php'
    ,baseParams: {
      action: 'create'
      ,langid: config.langid
    }
    ,fields: Xlexicon.fields.PropertyFields
  });
  Xlexicon.window.PropertyCreate.superclass.constructor.call(this,config);
};
Ext.extend(Xlexicon.window.PropertyCreate,MODx.Window);
Ext.reg('xlexicon-window-property-create',Xlexicon.window.PropertyCreate);

Xlexicon.window.PropertyUpdate = function(config) {
  config = config || {};
  this.id = config.id || 'xlexicon-window-property-update-'+config.record.id
  Ext.applyIf(config,{
    id:this.id
    ,title: _('xlexicon.window_updateProperty')
    ,url: config.url || Xlexicon.config.connectorsUrl + 'settings.php'
    ,baseParams: {
        action: 'update'
    }
    ,fields: Xlexicon.fields.PropertyFields.concat(
      {
        xtype: 'hidden'
        ,name: 'id'
      },{
        xtype: 'hidden'
        ,name: 'lang_key'
      }  
    )
  });
  Xlexicon.window.PropertyUpdate.superclass.constructor.call(this,config);
};
Ext.extend(Xlexicon.window.PropertyUpdate,MODx.Window);
Ext.reg('xlexicon-window-property-update',Xlexicon.window.PropertyUpdate);