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
var json_data = '{"info":{"name":"プロフィール管理（士業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":1800,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001338.jpg"}],"mouseActions":[{"x":854,"y":517,"w":149,"h":46,"layer":5,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"5df0a66b-33a1-4005-98fa-bbf54bb8aff8.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":8,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000333.png"}],"notes":[{"x":30,"y":428,"layer":2,"startTime":0,"totalTime":-1,"img":"636616602705772747.png","showOrHide":[true,true,true,true]},{"x":957,"y":389,"layer":4,"startTime":0,"totalTime":-1,"img":"636616602705928747.png","showOrHide":[true,true,true,true]},{"x":-10,"y":701,"layer":7,"startTime":0,"totalTime":-1,"img":"636616602706562747.png","showOrHide":[true,true,true,true]},{"x":72,"y":423,"layer":1,"startTime":0,"totalTime":-1,"img":"636616602706718747.png","showOrHide":[true,true,false,false]},{"x":929,"y":428,"layer":3,"startTime":0,"totalTime":-1,"img":"636616602706718748.png","showOrHide":[true,true,false,false]},{"x":400,"y":261,"layer":9,"startTime":300,"totalTime":-1,"img":"636616602707810747.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":2070,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001329.jpg"}],"mouseActions":[{"x":279,"y":95,"w":146,"h":40,"layer":1,"strokeColor":"#ff0000","next":2,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"9db27b1f-09bd-4237-8222-f7ff2bbca559.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000334.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":4,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000335.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":2070,"img":"mouseRoute1.png"},{"x":352,"y":115,"totalTime":0}]}],"notes":[{"x":-10,"y":701,"layer":2,"startTime":0,"totalTime":-1,"img":"636616602712206747.png","showOrHide":[true,true,true,true]},{"x":330,"y":112,"layer":5,"startTime":300,"totalTime":-1,"img":"636616602712830747.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001100.jpg"}],"mouseActions":[{"x":751,"y":577,"w":128,"h":43,"layer":1,"strokeColor":"#ff0000","next":3,"startTime":2500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"58192dab-cdc9-4fb5-83c4-f246e49006c2.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":5,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000336.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":6,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000337.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":352,"y":115,"startTime":0,"totalTime":3247,"img":"mouseRoute2.png"},{"x":815,"y":598,"totalTime":753}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616602717638747.png","showOrHide":[true,true,true,true]},{"x":432,"y":145,"layer":2,"startTime":200,"totalTime":-1,"img":"636616602717798747.png","showOrHide":[true,true,false,false]},{"x":868,"y":76,"layer":3,"startTime":200,"totalTime":-1,"img":"636616602718098747.png","showOrHide":[true,true,false,false]},{"x":437,"y":427,"layer":9,"startTime":2500,"totalTime":-1,"img":"636616602718838747.png","showOrHide":[true,true,false,false]},{"x":432,"y":303,"layer":7,"startTime":1200,"totalTime":-1,"img":"636616602719606747.png","showOrHide":[true,true,false,false]},{"x":975,"y":324,"layer":8,"startTime":1200,"totalTime":-1,"img":"636616602720230747.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001325.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000338.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616602724910747.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);