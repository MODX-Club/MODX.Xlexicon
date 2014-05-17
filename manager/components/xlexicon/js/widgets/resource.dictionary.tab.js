Ext.onReady(function () {
  var tabPanel = Ext.getCmp('modx-resource-tabs');
  
  Ext.Ajax.request({
		url: Xlexicon.config.connectorsUrl + 'dictionaries.php'
		,params : {
			action: 'getList'
			,res: (Xlexicon.resource.id !== Xlexicon.resource.parent) ? Xlexicon.resource.id : ''
      ,context: Xlexicon.resource.wctx
		}
		,method: 'POST'
		,scope: this
		,success: function( response, request ){
	    var dataLang = Ext.util.JSON.decode( response.responseText );	
      if(!dataLang.results || !dataLang.results.lang.length) return;
  		tabPanel.add({
    		cls: 'container'
        ,renderTo: Ext.getBody()
        ,title: 'Dictionaries'
        ,header: false		        
        ,defaults: { collapsible: false ,autoHeight: true, labelAlign: 'top' }
        ,cls: 'x-tab-panel-header'
        ,id: 'xlexicon-tab-panel'
        ,items:[{
          xtype: 'modx-vtabs'
          ,id: 'xlexicon-panel-resource-tab'
          ,activeTab:-1
          ,defaults: {
            bodyCssClass: 'vertical-tabs'
            ,autoScroll: true
            ,autoHeight: true
            ,autoWidth: true
            ,layout: 'form'
            ,bodyStyle: 'padding: 10px'
          }
          ,items: getMultilanguageForms(dataLang.results)
        }]
  		});
		}
		,failure: function ( result, request) {
			Ext.MessageBox.alert('Failed', result.responseText);
		}
		,scope: this
	});
	
	function getMultilanguageForms(dataLang) {
		var items = [];
    var dicts = [];
		var langs = dataLang.lang;
		var data = dataLang.data;
    if(data.length > 0){
      for(var i in data){
        if( typeof data[i] === 'function' ) continue;  
        dicts[data[i].language] = data[i];
      }
    }
		for (var i in langs) {
      if( typeof langs[i] === 'function' ) continue;
	    var lang = langs[i];
      dict = dicts[lang.iso_code];
	    items.push(
			  {
          xtype:'xlexicon-panel-dictionary'
          ,lang: lang
          ,dict: dict
        }	
			);
		}	
		return items;
	}
	
});