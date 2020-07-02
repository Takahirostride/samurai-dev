/*
 * Copyright (C) 2014 Tenda,Inc.All rights reserved.
*/


/*dojo lesson of json data structure

[Dojo Version 7.31]

[sets]:set values,include lesson;
-[bgSize]:lesson background value;
--[w]:width;
--[h]:height;
-[flickerTime]:The Action flicker of time. -1:none
//wanghaiyang
-[examInterval]: the interval of examination time(minutes).
-[level]: the hard level of examination. 0:easy,1:hard
-[requireLine]: the requirement of examination score.
-[mail]: the mail address of sending report.
-[scormVersion]:the version of SCORM 1-ver1.2;2-ver2004
-[completionMode]:the mode of SCORM completion :0-auto;1-lecture;2-exercise;3-examination
//wanghaiyang
[steps]:step array,include all step;
-[num]:the number of the step
-[totalTime]:step time;
-[img]:background image;
-[x]:bgimage x position,you may not add 0 value;
-[y]:bgimage y position,you may not add 0 value;
-[buttons]:button action array,include current step of all buttons;
--[img]:button image;
--[startTime]:start time,you may not add 0 value;
--[totalTime]:continue time,you may not add -1 value;
--[x]:button x position;
--[y]:button y position;
-[mouseRoutes]:mouseroute array,include current step of all mouseroutes;
--[mouseRoute]:one mouseroute of all notes;
---[images]:all cursor'image for one mouseroute;
---[startTime]:start time,you may not add 0 value;
---[totalTime]:continue time,you may not add -1 value;
---[sx]:Cut the x coordinate of the start position;
---[sy]:Cut the y coordinate of the start position;
---[sWidth]:The width of the image is cut;
---[sHeight]:The height of the image is cut;
---[x]:Place the image on the canvas x coordinate location;
---[y]:Place the image on the canvas y coordinate location;
-[notes]:note array,include current step of all notes;
--[img]:note image;
--[startTime]:start time,you may not add 0 value;
--[totalTime]:continue time,you may not add -1 value;
--[x]:note x position;
--[y]:note y position;
--[layer]:the index of the note layers;
--[showOrHide]:the flag of the note displaying in four modes;
--[hyperLinks]:the hyperlinks of the note;
---[linkUrl]:the url of the hyperlink;
---[linkAreas]:the effective areas of the hyperlink;
----[x]:the x position of the effective areas;
----[y]:the y position of the effective areas;
----[w]:the width of the effective areas;
----[h]:the height of the effective areas;
-[promptBoxes]:promptBox array,include current step of all promptBoxes;
--[img]:promptBox image;
--[imgInfo]:promptBox information image;
--[x]:promptBox x position;
--[y]:promptBox y position;
--[xInfo]:promptBox information x position;
--[yInfo]:promptBox information y position;
--[startTime]:start time,you may not add 0 value;
--[totalTime]:continue time,you may not add -1 value;
--[layer]:the index of the note layers;
--[showOrHide]:the flag of the note displaying in four modes;
--[hyperLinks]:the hyperlinks of the note;
---[linkUrl]:the url of the hyperlink;
---[linkAreas]:the effective areas of the hyperlink;
----[x]:the x position of the effective areas;
----[y]:the y position of the effective areas;
----[w]:the width of the effective areas;
----[h]:the height of the effective areas;
-[videos]:video array,include current step of all videos;
--[src]:video file name;
-[audios]:audio array,include current step of all audios;
--[type]:0-instruction audio，1-question audio;
--[src]:audio file name;
*/
var json_data = '{"info":{"name":"支払管理","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":1800,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000874.jpg"}],"mouseActions":[{"x":276,"y":176,"w":377,"h":57,"layer":1,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"01cf2d04-363b-4a1e-86f3-a690d70e02b9.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000645.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":1376,"img":"mouseRoute1.png"},{"x":464,"y":204,"totalTime":424}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616563714914747.png","showOrHide":[true,true,true,true]},{"x":72,"y":602,"layer":5,"startTime":0,"totalTime":-1,"img":"636616563715070747.png","showOrHide":[true,true,false,false]},{"x":21,"y":607,"layer":6,"startTime":0,"totalTime":-1,"img":"636616563715070748.png","showOrHide":[true,true,true,true]},{"x":441,"y":212,"layer":7,"startTime":300,"totalTime":-1,"img":"636616563716006747.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":1800,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000875.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":1,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000646.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":2,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000647.png"}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616563719604747.png","showOrHide":[true,true,true,true]},{"x":73,"y":603,"layer":4,"startTime":0,"totalTime":-1,"img":"636616563719760747.png","showOrHide":[true,true,false,false]},{"x":22,"y":608,"layer":5,"startTime":0,"totalTime":-1,"img":"636616563719916747.png","showOrHide":[true,true,true,true]},{"x":632,"y":351,"layer":7,"startTime":300,"totalTime":-1,"img":"636616563720540747.png","showOrHide":[true,true,false,false]},{"x":263,"y":270,"layer":6,"startTime":300,"totalTime":-1,"img":"636616563720696747.png","showOrHide":[true,true,false,false]},{"x":268,"y":170,"layer":8,"startTime":0,"totalTime":-1,"img":"636616563720696748.png","showOrHide":[true,true,false,false]},{"x":319,"y":133,"layer":9,"startTime":0,"totalTime":-1,"img":"636616563720852747.png","showOrHide":[true,true,true,true]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000877.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":1,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000648.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":2,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000649.png"}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616563723972747.png","showOrHide":[true,true,true,true]},{"x":164,"y":597,"layer":4,"startTime":0,"totalTime":-1,"img":"636616563723972748.png","showOrHide":[true,true,false,false]},{"x":113,"y":602,"layer":5,"startTime":0,"totalTime":-1,"img":"636616563724128747.png","showOrHide":[true,true,true,true]},{"x":697,"y":138,"layer":7,"startTime":200,"totalTime":-1,"img":"636616563724596747.png","showOrHide":[true,true,false,false]},{"x":350,"y":341,"layer":6,"startTime":200,"totalTime":-1,"img":"636616563724752747.png","showOrHide":[true,true,false,false]},{"x":793,"y":431,"layer":8,"startTime":1500,"totalTime":-1,"img":"636616563725064747.png","showOrHide":[true,true,false,false]},{"x":599,"y":600,"layer":9,"startTime":1500,"totalTime":-1,"img":"636616563725220747.png","showOrHide":[true,true,false,false]},{"x":473,"y":214,"layer":10,"startTime":0,"totalTime":-1,"img":"636616563725220748.png","showOrHide":[true,true,false,false]},{"x":524,"y":177,"layer":11,"startTime":0,"totalTime":-1,"img":"636616563725376747.png","showOrHide":[true,true,true,true]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":3500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000878.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000650.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000651.png"}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616563728480747.png","showOrHide":[true,true,true,true]},{"x":72,"y":485,"layer":5,"startTime":0,"totalTime":-1,"img":"636616563728480748.png","showOrHide":[true,true,false,false]},{"x":21,"y":490,"layer":6,"startTime":0,"totalTime":-1,"img":"636616563728636747.png","showOrHide":[true,true,true,true]},{"x":871,"y":1,"layer":8,"startTime":200,"totalTime":-1,"img":"636616563728948747.png","showOrHide":[true,true,false,false]},{"x":263,"y":105,"layer":7,"startTime":200,"totalTime":-1,"img":"636616563732088747.png","showOrHide":[true,true,false,false]},{"x":747,"y":298,"layer":9,"startTime":2000,"totalTime":-1,"img":"636616563732400747.png","showOrHide":[true,true,false,false]},{"x":469,"y":402,"layer":0,"startTime":2000,"totalTime":-1,"img":"636616563732712747.png","showOrHide":[true,true,false,false]},{"x":516,"y":49,"layer":10,"startTime":0,"totalTime":-1,"img":"636616563732712748.png","showOrHide":[true,true,false,false]},{"x":557,"y":12,"layer":11,"startTime":0,"totalTime":-1,"img":"636616563732868747.png","showOrHide":[true,true,true,true]}]},{"num":"5","pro":3,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000832.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000652.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616563740084747.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);