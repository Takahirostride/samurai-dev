var val = "";
var css = "";
if (document.currentScript) {
    val = "<script type='text/javascript' src='" + document.currentScript.src.split("CPToken.js")[0] + "CPTokenMain.js?ver=" + parseInt((new Date) / 1000) + "' async></script>";
    css = "<link href='" + document.currentScript.src.split("CPToken.js")[0].split("js")[0] + "css/tmodal_all.css?ver=" + parseInt((new Date) / 1000) + "' rel='stylesheet'>"
} else {
    var scripts = document.getElementsByTagName('script');
    for (var i = 0; i < scripts.length; i++) {
        var src = scripts[i].src;
        if (src.indexOf('CPToken.js') > 0) {
            val = "<script type='text/javascript' src='" + src.replace("CPToken.js", "CPTokenMain.js?ver=") + parseInt((new Date) / 1000) + "' async></script>";
            css = "<link href='" + src.replace("js/CPToken.js", "css/tmodal.css?ver=") + parseInt((new Date) / 1000) + "' rel='stylesheet'>";
            break;
        }
    }
}
document.write(val);
document.write(css);