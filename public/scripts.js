/**
 * Created by Maxim on 10.06.2016.
 */
/* Responsive video */
function fix_video(width){
    var elems = document.getElementsByTagName('iframe');
    var length = elems.length;
    for(var i=0; i < length; i++) {
        if (elems[i].id != "articleContent_ifr") {
            if(width <= 960){
                elems[i].parentNode.style = "height: 0; position: relative; padding-bottom: 56.25%";
                elems[i].style = "left: 0; position: absolute; top: 0; width: 100%; height: 100%";
            }
            else {
                elems[i].style = "";
                elems[i].parentNode.style = "text-align:center";
            }
        }
    }
}
$(window).resize(function() {
    fix_video($(window).width());
});
$(window).load(function() {
    fix_video($(window).width());
});

/* Showing modal window */
function show_modal(id){
    document.getElementById(id).style.display = 'block';

}

/* Hiding modal window */
function hide_modal(id) {
    document.getElementById(id).style.display = 'none';
}