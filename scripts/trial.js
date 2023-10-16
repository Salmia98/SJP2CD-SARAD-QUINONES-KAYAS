
var displayedContainer="";

function onClickAdmission(){
    console.log("Admission");
    setDisplayFlex("id_ad_cont");
}

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

// function onClickNewsInfo(){
//     console.log("News Info");
//     setDisplayFlex("id_news_info_cont");

// }

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
    // document.getElementById("id_news_info_cont").style.display = "none";
    document.getElementById("id_about_us_cont").style.display = "none";
}