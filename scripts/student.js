// variable name
var isMyGradesShow= true;

function onClicksubtextleft(){
    console.log("text");
    // display container
    if (isMyGradesShow){
        document.getElementById("id_grades_dis_cont").style.display="flex";
        isMyGradesShow=false;
        // Hide container
    }else {
        document.getElementById("id_grades_dis_cont").style.display="none";
        isMyGradesShow=true;
    }

}

// variable name
var isMyStateAccShow= true; 
function onClicksubtextleft1(){
    console.log("state value");
    // display container
    if (isMyStateAccShow){
        document.getElementById("id_acc_dis_cont").style.display="flex";
        isMyStateAccShow=false;
        // Hide container
    }else {
        document.getElementById("id_acc_dis_cont").style.display="none";
        isMyStateAccShow=true;
    }
    
}

// variable name
var isMyClearanceShow=true;
function onClicksubtextleft2(){
    console.log("clearance value");
    // display container
    if (isMyClearanceShow){
        document.getElementById("id_clearance_cont").style.display="flex";
        isMyClearanceShow=false;
        // hide container
    }else {
        document.getElementById("id_clearance_cont").style.display="none";
        isMyClearanceShow=true;
    }
}



