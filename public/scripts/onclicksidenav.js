function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("contents").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("contents").style.marginLeft= "0";
}

var clickCount = 0;

$('#togglebutton').click(function(){
      if(clickCount%2==0){
          openNav();
      }else{
          closeNav();
      }
      clickCount++;
});

$('#togglebuttonrequest').click(function(){
    if(clickCount%2==0){
        closeNav();
    }else{
        openNav();
    }
    clickCount++;
});