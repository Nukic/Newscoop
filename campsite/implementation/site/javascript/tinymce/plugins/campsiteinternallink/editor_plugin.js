(function(){tinymce.create('tinymce.plugins.CampsiteInternalLinkPlugin',{init:function(ed,url){this.editor=ed;ed.addCommand('mceCampsiteInternalLink',function(){var se=ed.selection;if(se.isCollapsed()&&!ed.dom.getParent(se.getNode(),'A'))return;ed.windowManager.open({file:url+'/link.php',width:480+parseInt(ed.getLang('campsiteinternallink.delta_width',0)),height:400+parseInt(ed.getLang('campsiteinternallink.delta_height',0)),inline:1},{plugin_url:url})});ed.addButton('campsiteinternallink',{title:'campsiteinternallink.link_desc',cmd:'mceCampsiteInternalLink',image:url+'/img/example.gif'});ed.addShortcut('ctrl+k','campsiteinternallink.campsiteinternallink_desc','mceCampsiteInternalLink');ed.onNodeChange.add(function(ed,cm,n,co){cm.setDisabled('link',co&&n.nodeName!='A');cm.setActive('link',n.nodeName=='A'&&!n.name)})},getInfo:function(){return{longname:'Campsite Internal Link',author:'Campware',authorurl:'http://www.campware.org',infourl:'http://code.campware.org/projects/campsite',version:'3.2'}}});tinymce.PluginManager.add('campsiteinternallink',tinymce.plugins.CampsiteInternalLinkPlugin)})();