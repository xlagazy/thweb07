function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

  var clickCount = 0;

  $('#togglebutton').click(function(){ //replace the id with the toggle button id
       if(clickCount%2==0){
           openNav();
       }else{
           closeNav();
       }
       clickCount++;
  });