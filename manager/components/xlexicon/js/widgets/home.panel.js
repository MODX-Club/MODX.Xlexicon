Xlexicon.panel.Home = function(config) {
  config = config || {};
  this.id = config.id || 'xlexicon-panel-home-'+Ext.id()
  Ext.apply(config,{
    cls: 'container'
    ,unstyled: true
    ,renderTo: Ext.getBody()
    ,defaults: { collapsible: false ,autoHeight: true }
    ,id:this.id
    ,saveMsg: _('xlexicon.saver')
    ,items: [{
      html: '<h2>'+_('xlexicon.title_manager')+'</h2>'
      ,border: false
      ,cls: 'modx-page-header'
    },{
      xtype: 'modx-vtabs'
      ,id: 'xlexicon-tab-language-default'
      ,activeTab: 0
      ,autoWidth: true
      ,resizable: true
      ,monitorResize:true
      ,deferredRender: false
      ,cls: 'x-panel-bwrap'
      ,bodyStyle: 'padding: 10px'
      ,enableTabScroll : true
      ,defaults: {
        bodyCssClass: 'vertical-tabs'
        ,autoScroll: true
        ,autoHeight: true
        ,autoWidth: true
        ,layout: 'form'
      }
      ,items: [{
        title:  _('xlexicon.vtab_languages')
        ,defaults: { autoHeight: true }
        ,items: [{
          html: '<p>'+_('xlexicon.desc_management')+'</p>'
          ,border: false
          ,cls: 'xlexicon-desc'
          ,bodyCssClass: 'panel-desc'
        },{
          xtype: 'xlexicon-grid-languages'
          ,cls: 'main-wrapper'
          ,preventRender: true
          ,url: Xlexicon.config.connectorsUrl + 'languages.php'
        }]
      }]
    }]
  });    
  Xlexicon.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(Xlexicon.panel.Home,MODx.Panel);
Ext.reg('xlexicon-panel-home',Xlexicon.panel.Home);