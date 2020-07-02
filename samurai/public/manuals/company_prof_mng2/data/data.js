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
var json_data = '{"info":{"name":"プロフィール管理（企業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000833.jpg"}],"mouseActions":[{"x":276,"y":476,"w":612,"h":59,"layer":1,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"c5e572af-0aa8-44c8-bb9a-947300b65041.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000613.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":765,"img":"mouseRoute1.png"},{"x":582,"y":505,"totalTime":935}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616582936442747.png","showOrHide":[true,true,true,true]},{"x":536,"y":297,"layer":5,"startTime":200,"totalTime":-1,"img":"636616582936910747.png","showOrHide":[true,true,false,false]},{"x":72,"y":441,"layer":6,"startTime":0,"totalTime":-1,"img":"636616582936910748.png","showOrHide":[true,true,false,false]},{"x":21,"y":446,"layer":7,"startTime":0,"totalTime":-1,"img":"636616582937066747.png","showOrHide":[true,true,true,true]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":1715,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000834.jpg"}],"mouseActions":[{"x":854,"y":559,"w":147,"h":47,"layer":1,"strokeColor":"#ff0000","next":2,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"1d93ea9c-eb06-40b3-9b11-620ff8bc4098.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000614.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000615.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":582,"y":505,"startTime":0,"totalTime":1715,"img":"mouseRoute2.png"},{"x":927,"y":582,"totalTime":0}]}],"notes":[{"x":446,"y":347,"layer":2,"startTime":200,"totalTime":-1,"img":"636616582940628747.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636616582940940747.png","showOrHide":[true,true,true,true]},{"x":72,"y":441,"layer":6,"startTime":0,"totalTime":-1,"img":"636616582941096747.png","showOrHide":[true,true,false,false]},{"x":21,"y":446,"layer":7,"startTime":0,"totalTime":-1,"img":"636616582941096748.png","showOrHide":[true,true,true,true]},{"x":268,"y":468,"layer":8,"startTime":0,"totalTime":-1,"img":"636616582941252747.png","showOrHide":[true,true,false,false]},{"x":324,"y":429,"layer":9,"startTime":0,"totalTime":-1,"img":"636616582941252748.png","showOrHide":[true,true,true,true]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":5200,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000843.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000616.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000617.png"}],"notes":[{"x":-10,"y":701,"layer":2,"startTime":0,"totalTime":-1,"img":"636616582944060747.png","showOrHide":[true,true,true,true]},{"x":304,"y":233,"layer":0,"startTime":200,"totalTime":-1,"img":"636616582944216747.png","showOrHide":[true,true,false,false]},{"x":304,"y":49,"layer":5,"startTime":200,"totalTime":-1,"img":"636616582944372747.png","showOrHide":[true,true,false,false]},{"x":762,"y":189,"layer":6,"startTime":200,"totalTime":-1,"img":"636616582944840747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":7,"startTime":3700,"totalTime":-1,"img":"636616582944996747.png","showOrHide":[true,true,false,false]},{"x":304,"y":629,"layer":8,"startTime":1700,"totalTime":-1,"img":"636616582945152747.png","showOrHide":[true,true,false,false]},{"x":800,"y":435,"layer":9,"startTime":1700,"totalTime":-1,"img":"636616582945952747.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000836.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000618.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000619.png"}],"notes":[{"x":-10,"y":701,"layer":1,"startTime":0,"totalTime":-1,"img":"636616582948362747.png","showOrHide":[true,true,true,true]},{"x":499,"y":-12,"layer":4,"startTime":200,"totalTime":-1,"img":"636616582948518747.png","showOrHide":[true,true,false,false]},{"x":322,"y":437,"layer":6,"startTime":200,"totalTime":-1,"img":"636616582949142747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":5,"startTime":2500,"totalTime":-1,"img":"636616582949142748.png","showOrHide":[true,true,false,false]}]},{"num":"5","pro":3,"next":5,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000837.jpg"}],"mouseActions":[{"x":607,"y":643,"w":121,"h":46,"layer":2,"strokeColor":"#ff0000","next":5,"startTime":2500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"86b39dc4-722e-4e26-bcda-3ad91b54526f.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":4,"next":5,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000620.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":5,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000621.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":927,"y":582,"startTime":0,"totalTime":1326,"img":"mouseRoute3.png"},{"x":667,"y":666,"totalTime":2674}]}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616582954602747.png","showOrHide":[true,true,true,true]},{"x":709,"y":495,"layer":6,"startTime":2500,"totalTime":-1,"img":"636616582955226747.png","showOrHide":[true,true,false,false]},{"x":304,"y":165,"layer":0,"startTime":200,"totalTime":-1,"img":"636616582955538747.png","showOrHide":[true,true,false,false]},{"x":864,"y":223,"layer":7,"startTime":200,"totalTime":-1,"img":"636616582956466747.png","showOrHide":[true,true,false,false]}]},{"num":"6","pro":4,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000831.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000622.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616582960544747.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);