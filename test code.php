
<!-- For adding a background image which changes after few seconds -->
<script type='text/javascript'>
var imageID=0;
function changeimage(every_seconds){
    //change the image
    if(!imageID){
        document.getElementById("myimage").src="http://www.all-freeware.com/images/full/38943-nice_feathers_free_screensaver_desktop_screen_savers__nature.jpeg";
        imageID++;
    }
    else{if(imageID==1){
        document.getElementById("myimage").src="http://www.hickerphoto.com/data/media/186/flower-bouquet-nice_12128.jpg";
        imageID++;
    }else{if(imageID==2){
        document.getElementById("myimage").src="http://www.photos.a-vsp.com/fotodb/14_green_cones.jpg";
        imageID=0;
    }}}
    //call same function again for x of seconds
    setTimeout("changeimage("+every_seconds+")",((every_seconds)*1000));
}
</script>

<body style='background:black;' onload='changeimage(2)'>
<div style='position:absolute;width:100%;height:100%;left:0px;top:0px;' align='center'><img width='100%' height='100%' id='myimage' src='http://www.photos.a-vsp.com/fotodb/14_green_cones.jpg'/></div>