$(".frmcheck").on("click",".track",function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    var track = document.getElementById( "tracking" ).value;
    var error = false;

    if (form[0].checkValidity() === false) {
        document.getElementById("tracking").classList.add("is-invalid");

        return false;
    }
    else{

        for(let noti_repairs of noti_repair){
            if(noti_repairs.track == track){
                form.submit();
                error = true;
                break;
            }
        }

        if(error == false){
            message_invalid = "หมายเลขไม่ถูกต้องกรุณากรอกใหม่อีกครั้ง";
            document.getElementById( "invalid-data" ).innerHTML = message_invalid;
            document.getElementById("tracking").classList.add("is-invalid");
            document.getElementById("feedback").classList.remove("invalid-feedback");
            document.getElementById("feedback").innerHTML = "";
            return false;
        }
        else{
            document.getElementById("tracking").classList.add("is-valid");
            document.getElementById( "invalid-data" ).innerHTML = "";
        }
        }
        
        form.addClass('was-validated');
    });