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
var json_data = '{"info":{"name":"各種認証設定","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":1800,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000860.jpg"}],"mouseActions":[{"x":277,"y":272,"w":814,"h":342,"layer":1,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"cce9cb5b-28ba-4e6d-b3bb-172991a975f8.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000647.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":286,"img":"mouseRoute1.png"},{"x":684,"y":443,"totalTime":1514}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616561524448747.png","showOrHide":[true,true,true,true]},{"x":72,"y":563,"layer":5,"startTime":0,"totalTime":-1,"img":"636616561524448748.png","showOrHide":[true,true,false,false]},{"x":21,"y":568,"layer":6,"startTime":0,"totalTime":-1,"img":"636616561524604747.png","showOrHide":[true,true,true,true]},{"x":790,"y":59,"layer":7,"startTime":300,"totalTime":-1,"img":"636616561525610747.png","showOrHide":[true,true,false,false]},{"x":270,"y":170,"layer":8,"startTime":0,"totalTime":-1,"img":"636616561525610748.png","showOrHide":[true,true,false,false]},{"x":321,"y":133,"layer":9,"startTime":0,"totalTime":-1,"img":"636616561525922747.png","showOrHide":[true,true,true,true]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":1800,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000869.jpg"}],"mouseActions":[{"x":271,"y":332,"w":989,"h":374,"layer":0,"strokeColor":"#ff0000","next":2,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"a9a42211-5dfb-4114-a274-441756d98d68.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":8,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000648.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":9,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000649.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":684,"y":443,"startTime":0,"totalTime":539,"img":"mouseRoute2.png"},{"x":765,"y":519,"totalTime":1261}]}],"notes":[{"x":-10,"y":701,"layer":2,"startTime":0,"totalTime":-1,"img":"636616561529896747.png","showOrHide":[true,true,true,true]},{"x":72,"y":563,"layer":3,"startTime":0,"totalTime":-1,"img":"636616561530052747.png","showOrHide":[true,true,false,false]},{"x":21,"y":568,"layer":4,"startTime":0,"totalTime":-1,"img":"636616561530052748.png","showOrHide":[true,true,true,true]},{"x":721,"y":82,"layer":7,"startTime":300,"totalTime":-1,"img":"636616561531300747.png","showOrHide":[true,true,false,false]},{"x":267,"y":52,"layer":5,"startTime":0,"totalTime":-1,"img":"636616561531612747.png","showOrHide":[true,true,false,false]},{"x":318,"y":15,"layer":6,"startTime":0,"totalTime":-1,"img":"636616561531768747.png","showOrHide":[true,true,true,true]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000896.jpg"}],"mouseActions":[{"x":673,"y":643,"w":186,"h":46,"layer":1,"strokeColor":"#ff0000","next":3,"startTime":1500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"d54c926c-394e-4d06-8f06-dd7566d96420.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000650.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000651.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":765,"y":519,"startTime":0,"totalTime":713,"img":"mouseRoute3.png"},{"x":766,"y":666,"totalTime":2287}]}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636616561535200747.png","showOrHide":[true,true,true,true]},{"x":781,"y":145,"layer":6,"startTime":200,"totalTime":-1,"img":"636616561535446747.png","showOrHide":[true,true,false,false]},{"x":265,"y":4,"layer":0,"startTime":200,"totalTime":-1,"img":"636616561535964747.png","showOrHide":[true,true,false,false]},{"x":749,"y":427,"layer":7,"startTime":1500,"totalTime":-1,"img":"636616561536286747.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":2500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000872.jpg"}],"mouseActions":[{"x":717,"y":430,"w":98,"h":43,"layer":2,"strokeColor":"#ff0000","next":4,"startTime":1000,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"62e9b8ee-1da4-40c0-aa83-86b5de13b565.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000652.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000653.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":766,"y":666,"startTime":0,"totalTime":1043,"img":"mouseRoute4.png"},{"y":451,"totalTime":1457}]}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636616561539562747.png","showOrHide":[true,true,true,true]},{"x":72,"y":563,"layer":6,"startTime":0,"totalTime":-1,"img":"636616561539562748.png","showOrHide":[true,true,false,false]},{"x":21,"y":568,"layer":7,"startTime":0,"totalTime":-1,"img":"636616561539718747.png","showOrHide":[true,true,true,true]},{"x":784,"y":177,"layer":8,"startTime":1000,"totalTime":-1,"img":"636616561540196747.png","showOrHide":[true,true,false,false]},{"x":268,"y":305,"layer":0,"startTime":200,"totalTime":-1,"img":"636616561540316747.png","showOrHide":[true,true,false,false]},{"x":549,"y":170,"layer":9,"startTime":0,"totalTime":-1,"img":"636616561540628747.png","showOrHide":[true,true,false,false]},{"x":588,"y":133,"layer":10,"startTime":0,"totalTime":-1,"img":"636616561540784747.png","showOrHide":[true,true,true,true]}]},{"num":"5","pro":3,"next":5,"bScore":true,"totalTime":3500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000873.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":1,"next":5,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000654.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":2,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000655.png"}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616561543904747.png","showOrHide":[true,true,true,true]},{"x":795,"y":63,"layer":6,"startTime":200,"totalTime":-1,"img":"636616561544684747.png","showOrHide":[true,true,false,false]},{"x":277,"y":194,"layer":4,"startTime":200,"totalTime":-1,"img":"636616561544840747.png","showOrHide":[true,true,false,false]},{"x":274,"y":511,"layer":5,"startTime":2000,"totalTime":-1,"img":"636616561544996747.png","showOrHide":[true,true,false,false]},{"x":796,"y":360,"layer":7,"startTime":2000,"totalTime":-1,"img":"636616561545620747.png","showOrHide":[true,true,false,false]}]},{"num":"6","pro":4,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000832.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000656.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616561550188747.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);