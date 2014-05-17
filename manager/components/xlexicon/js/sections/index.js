Ext.onReady(function() {
    MODx.load({ xtype: 'xlexicon-page-home'});
});

Xlexicon.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'xlexicon-panel-home'
            ,renderTo: 'xlexicon-panel-home-div'
        }]
    });
    Xlexicon.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(Xlexicon.page.Home,MODx.Component);
Ext.reg('xlexicon-page-home',Xlexicon.page.Home);