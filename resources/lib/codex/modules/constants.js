"use strict";function t(n){return e=>typeof e=="string"&&n.indexOf(e)!==-1}const s="cdx",o=["default","progressive","destructive"],i=["normal","primary","quiet"],a=["medium","large"],r=["x-small","small","medium"],l=["notice","warning","error","success"],c=t(l),d=["text","search","number","email","month","password","tel","url","week","date","datetime-local","time"],u=["default","warning","error","success"],y=120,m=500,p="cdx-menu-footer-item",b=Symbol("CdxTabs"),S=Symbol("CdxActiveTab"),I=Symbol("CdxFieldInputId"),T=Symbol("CdxFieldDescriptionId"),x=Symbol("CdxFieldStatus"),K=Symbol("CdxDisabled"),g="".concat(s,"-no-invert");exports.ActiveTabKey=S;exports.ButtonActions=o;exports.ButtonSizes=a;exports.ButtonWeights=i;exports.DebounceInterval=y;exports.DisabledKey=K;exports.FieldDescriptionIdKey=T;exports.FieldInputIdKey=I;exports.FieldStatusKey=x;exports.IconSizes=r;exports.LibraryPrefix=s;exports.MenuFooterValue=p;exports.NoInvertClass=g;exports.PendingDelay=m;exports.TabsKey=b;exports.TextInputTypes=d;exports.ValidationStatusTypes=u;exports.makeStringTypeValidator=t;exports.statusTypeValidator=c;