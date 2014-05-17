var Xlexicon = function(config) {
  var config = config || {};
  Xlexicon.superclass.constructor.call(this,config);
};
Ext.extend(Xlexicon,Ext.Component,{
  page:{}
  ,window:{}
  ,grid:{}
  ,tree:{}
  ,panel:{}
  ,combo:{}
  ,config: {}
  ,columns: {}
  ,fields: {}
});
Ext.reg('xlexicon',Xlexicon);

Xlexicon = new Xlexicon();