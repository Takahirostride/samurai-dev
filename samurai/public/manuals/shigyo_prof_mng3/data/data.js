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
var json_data = '{"info":{"name":"プロフィール管理（士業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":1800,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001334.jpg"}],"mouseActions":[{"x":855,"y":518,"w":149,"h":46,"layer":1,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"b6708f09-2a78-45ec-934f-1aea19e22ef7.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":10,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000329.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":1416,"img":"mouseRoute1.png"},{"x":929,"y":541,"totalTime":384}]}],"notes":[{"x":465,"y":389,"layer":8,"startTime":0,"totalTime":-1,"img":"636616595022708747.png","showOrHide":[true,true,true,true]},{"x":-10,"y":701,"layer":9,"startTime":0,"totalTime":-1,"img":"636616595023176747.png","showOrHide":[true,true,true,true]},{"x":855,"y":184,"layer":5,"startTime":300,"totalTime":-1,"img":"636616595024892747.png","showOrHide":[true,true,false,false]},{"x":411,"y":426,"layer":6,"startTime":0,"totalTime":-1,"img":"636616595025048747.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001236.jpg"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":7,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000330.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":9,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000331.png"}],"notes":[{"x":-10,"y":701,"layer":8,"startTime":0,"totalTime":-1,"img":"636616595030236747.png","showOrHide":[true,true,true,true]},{"x":262,"y":287,"layer":2,"startTime":1200,"totalTime":-1,"img":"636616595030392747.png","showOrHide":[true,true,false,false]},{"x":261,"y":55,"layer":3,"startTime":200,"totalTime":-1,"img":"636616595030548747.png","showOrHide":[true,true,false,false]},{"x":863,"y":134,"layer":4,"startTime":200,"totalTime":-1,"img":"636616595030860747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":361,"layer":5,"startTime":2500,"totalTime":-1,"img":"636616595031016747.png","showOrHide":[true,true,false,false]},{"x":691,"y":357,"layer":6,"startTime":1200,"totalTime":-1,"img":"636616595031972747.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":5000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001316.jpg"}],"mouseActions":[{"x":593,"y":652,"w":149,"h":44,"layer":1,"strokeColor":"#ff0000","next":3,"startTime":3500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"caccf849-ba1e-40bc-9c2e-f065dc838ee3.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000332.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":5,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000333.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":929,"y":541,"startTime":0,"totalTime":1426,"img":"mouseRoute2.png"},{"x":667,"y":674,"totalTime":3574}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616595035882747.png","showOrHide":[true,true,true,true]},{"x":257,"y":216,"layer":2,"startTime":1200,"totalTime":-1,"img":"636616595035892747.png","showOrHide":[true,true,false,false]},{"x":861,"y":399,"layer":8,"startTime":2200,"totalTime":-1,"img":"636616595036252747.png","showOrHide":[true,true,false,false]},{"x":723,"y":530,"layer":10,"startTime":3500,"totalTime":-1,"img":"636616595036542747.png","showOrHide":[true,true,false,false]},{"x":257,"y":464,"layer":6,"startTime":2200,"totalTime":-1,"img":"636616595036702747.png","showOrHide":[true,true,false,false]},{"x":860,"y":0,"layer":9,"startTime":200,"totalTime":-1,"img":"636616595037708747.png","showOrHide":[true,true,false,false]},{"x":257,"y":-10,"layer":7,"startTime":200,"totalTime":-1,"img":"636616595037864747.png","showOrHide":[true,true,false,false]},{"x":858,"y":202,"layer":11,"startTime":1200,"totalTime":-1,"img":"636616595038488747.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001341.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000334.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000335.png"}],"notes":[{"x":-10,"y":701,"layer":10,"startTime":0,"totalTime":-1,"img":"636616595042104747.png","showOrHide":[true,true,true,true]},{"x":905,"y":494,"layer":11,"startTime":200,"totalTime":-1,"img":"636616595042260747.png","showOrHide":[true,true,false,false]},{"x":618,"y":300,"layer":12,"startTime":200,"totalTime":-1,"img":"636616595043040747.png","showOrHide":[true,true,false,false]}]},{"num":"5","pro":3,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001325.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000336.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616595046628747.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);