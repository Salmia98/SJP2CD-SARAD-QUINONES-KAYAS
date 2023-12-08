
var displayedContainer="";

var slideIndex=1;
showSlide(slideIndex);


function onClickCourses(){
    console.log("Courses");
    setDisplayFlex("id_course_cont");

}

function onClickScholarOffer(){
    console.log("ScholarOffer");
    hideContainers();
    setDisplayFlex("id_scholar_cont");

}

function onClickAchievements(){
    console.log("Achiv");
    setDisplayFlex("id_achive_cont");
}

function onClickAboutUs(){
    console.log("About Us");
    setDisplayFlex("id_about_us_cont");
}

function setDisplayFlex(containerID){
    // Hide Containers
    hideContainers();
    // Set Display Flex
    if(displayedContainer == containerID) {
        displayedContainer="";
    }else{
        document.getElementById(containerID).style.display = "flex";
        document.getElementById(containerID).style.zIndex = "2";
        document.getElementById(containerID).style.position = "absolute";
        document.getElementById(containerID).style.width = "100%";
        displayedContainer=containerID;
    }
}

function hideContainers(){
    document.getElementById("id_ad_cont").style.display = "none";
    document.getElementById("id_course_cont").style.display = "none";
    document.getElementById("id_scholar_cont").style.display = "none";
    document.getElementById("id_achive_cont").style.display = "none";
    document.getElementById("id_about_us_cont").style.display = "none";
}

function onClickMainArrow(n){
    showSlide(slideIndex += n);
}

function showSlide(index){
    console.log("Slide index",index)
    let i;
    let imgSlides=document.getElementsByClassName("image-slides");
    let dots = document.getElementsByClassName("dot");
    
    if(index > imgSlides.length) slideIndex = 1;
    else if(index < 1)slideIndex = imgSlides.length;

    for(i=0; i < imgSlides.length;i++)
        imgSlides[i].style.display = "none";

    for (i = 0; i < dots.length; i++) {
        dots[i].style.backgroundColor = "white";
    }
    
    imgSlides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].style.backgroundColor = "gray";
}

// console.log("test value");
function onClickDot(n){
    console.log("test value", n);
    showSlide(slideIndex=n);
}


