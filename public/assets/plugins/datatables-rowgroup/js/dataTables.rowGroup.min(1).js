/*!
 RowGroup 1.1.2
 ©2017-2020 SpryMedia Ltd - datatables.net/license
*/
(function(c){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(i){return c(i,window,document)}):"object"===typeof exports?module.exports=function(i,d){i||(i=window);if(!d||!d.fn.dataTable)d=require("datatables.net")(i,d).$;return c(d,i,i.document)}:c(jQuery,window,document)})(function(c,i,d,k){var e=c.fn.dataTable,g=function(a,b){if(!e.versionCheck||!e.versionCheck("1.10.8"))throw"RowGroup requires DataTables 1.10.8 or newer";this.c=c.extend(!0,{},e.defaults.rowGroup,
g.defaults,b);this.s={dt:new e.Api(a)};this.dom={};var m=this.s.dt.settings()[0],f=m.rowGroup;if(f)return f;m.rowGroup=this;this._constructor()};c.extend(g.prototype,{dataSrc:function(a){if(a===k)return this.c.dataSrc;var b=this.s.dt;this.c.dataSrc=a;c(b.table().node()).triggerHandler("rowgroup-datasrc.dt",[b,a]);return this},disable:function(){this.c.enable=!1;return this},enable:function(a){if(!1===a)return this.disable();this.c.enable=!0;return this},enabled:function(){return this.c.enable},_constructor:function(){var a=
this,b=this.s.dt,c=b.settings()[0];b.on("draw.dtrg",function(b,e){a.c.enable&&c===e&&a._draw()});b.on("column-visibility.dt.dtrg responsive-resize.dt.dtrg",function(){a._adjustColspan()});b.on("destroy",function(){b.off(".dtrg")})},_adjustColspan:function(){c("tr."+this.c.className,this.s.dt.table().body()).find("td:visible").attr("colspan",this._colspan())},_colspan:function(){return this.s.dt.columns().visible().reduce(function(a,b){return a+b},0)},_draw:function(){var a=this._group(0,this.s.dt.rows({page:"current"}).indexes());
this._groupDisplay(0,a)},_group:function(a,b){for(var m=c.isArray(this.c.dataSrc)?this.c.dataSrc:[this.c.dataSrc],f=e.ext.oApi._fnGetObjectDataFn(m[a]),i=this.s.dt,j,g,l=[],h=0,d=b.length;h<d;h++){var n=b[h];j=i.row(n).data();j=f(j);if(null===j||j===k)j=this.c.emptyDataGroup;if(g===k||j!==g)l.push({dataPoint:j,rows:[]}),g=j;l[l.length-1].rows.push(n)}if(m[a+1]!==k){h=0;for(d=l.length;h<d;h++)l[h].children=this._group(a+1,l[h].rows)}return l},_groupDisplay:function(a,b){for(var c=this.s.dt,f,e=0,g=
b.length;e<g;e++){var d=b[e],i=d.dataPoint,h=d.rows;this.c.startRender&&(f=this.c.startRender.call(this,c.rows(h),i,a),(f=this._rowWrap(f,this.c.startClassName,a))&&f.insertBefore(c.row(h[0]).node()));this.c.endRender&&(f=this.c.endRender.call(this,c.rows(h),i,a),(f=this._rowWrap(f,this.c.endClassName,a))&&f.insertAfter(c.row(h[h.length-1]).node()));d.children&&this._groupDisplay(a+1,d.children)}},_rowWrap:function(a,b,e){if(null===a||""===a)a=this.c.emptyDataGroup;return a===k||null===a?null:("object"===
typeof a&&a.nodeName&&"tr"===a.nodeName.toLowerCase()?c(a):a instanceof c&&a.length&&"tr"===a[0].nodeName.toLowerCase()?a:c("<tr/>").append(c("<td/>").attr("colspan",this._colspan()).append(a))).addClass(this.c.className).addClass(b).addClass("dtrg-level-"+e)}});g.defaults={className:"dtrg-group",dataSrc:0,emptyDataGroup:"No group",enable:!0,endClassName:"dtrg-end",endRender:null,startClassName:"dtrg-start",startRender:function(a,b){return b}};g.version="1.1.2";c.fn.dataTable.RowGroup=g;c.fn.DataTable.RowGroup=
g;e.Api.register("rowGroup()",function(){return this});e.Api.register("rowGroup().disable()",function(){return this.iterator("table",function(a){a.rowGroup&&a.rowGroup.enable(!1)})});e.Api.register("rowGroup().enable()",function(a){return this.iterator("table",function(b){b.rowGroup&&b.rowGroup.enable(a===k?!0:a)})});e.Api.register("rowGroup().enabled()",function(){var a=this.context;return a.length&&a[0].rowGroup?a[0].rowGroup.enabled():!1});e.Api.register("rowGroup().dataSrc()",function(a){return a===
k?this.context[0].rowGroup.dataSrc():this.iterator("table",function(b){b.rowGroup&&b.rowGroup.dataSrc(a)})});c(d).on("preInit.dt.dtrg",function(a,b){if("dt"===a.namespace){var d=b.oInit.rowGroup,f=e.defaults.rowGroup;if(d||f)f=c.extend({},f,d),!1!==d&&new g(b,f)}});return g});