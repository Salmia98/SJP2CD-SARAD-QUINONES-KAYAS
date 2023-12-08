// Display Container
var displayedContainer="";
// Student ID
var studentID = "";
// Clearance
var strJsonClearance = "";
// Student Clearance
var strJsonStudentClearance = "";
const periods = ["prelim","midterm","final"];
var prevPeriod = periods[0];

// Initialize
initialize();

function initialize(){
    // Get student id
    studentID = sessionStorage.getItem("student_id");
    console.log("Student ID: " + studentID);
    displayStudentInfo();
    // Display Grade
    onClicksubtextleft();
    // Get clearance
    getClearance();
    // Get student clearance
    getStudentClearance();
}

function displayStudentInfo(){
    // Display Student ID
    document.getElementById("student_info").innerHTML = "ID Number: " + studentID; 
}

function onClicksubtextleft(){
    // Display Grade Container
    setDisplay("id_grades_dis_cont");
}

function onClicksubtextleft1(){
    // Display Account Container
    setDisplay("id_acc_dis_cont");
    
}
function onClicksubtextleft2(){
    // Display Clearance Container
    setDisplay("id_clearance_cont");
    // Check if Clearance container still displayed
    if(displayedContainer == "id_clearance_cont")
        // Display Clearance
        displayClearance(prevPeriod);
    
}

function setDisplay(containerID){
    // Hide Containers
    hideContainers();
    // Check if same display
    if(displayedContainer == containerID) {
        // Clear container
        displayedContainer="";
    }else{
        // Set display as flex
        document.getElementById(containerID).style.display = "flex";
        // Set displayed container
        displayedContainer=containerID;
    }
}

function hideContainers(){
    // Hide Selection Containers
    document.getElementById("id_grades_dis_cont").style.display = "none";
    document.getElementById("id_acc_dis_cont").style.display = "none";
    document.getElementById("id_clearance_cont").style.display = "none";
}

function getClearance(){
    // HTTP Request
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            // Save Response as String JSON Clearance
            strJsonClearance = this.responseText;
        }else if(this.readyState==4){
            console.log("Fail");
        }
    }
    // Request
    xmlhttp.open("GET","http://localhost/api/getClearance.php",true);
    xmlhttp.send();
}

function onClickDisplayClearance(index){
    // Check if clearance still displayed
    if(displayedContainer == "id_clearance_cont"){
        // Display Clearance
        displayClearance(periods[index]);
    }
}

function displayClearance(period){
    // Convert to JSON
    let jsonClearance = JSON.parse(strJsonClearance);
    // Table text
    let tableText = "<table border='1'>";

    // Headers
    const clearanceHeaders = ["CLEARING OFFICE","CLEARED","REMARKS"];
    // Add Table row
    tableText += "<tr>";
    // Add headers
    for(let x in clearanceHeaders){
        tableText += "<th>" + clearanceHeaders[x] + "</th>";
    }
    // End table row
    tableText += "</tr>";

    
    
    // tableText += "<td>" + jsonClearance[x].semester_periods + "</td>";
    // Get Clearance Data
    for(let x in jsonClearance){
        // Check Period
        if(!jsonClearance[x].semester_periods.includes(period)){
            continue;
        }
        // Add Table row
        tableText += "<tr>";
        // Add Tablet Data
        tableText += "<td>" + jsonClearance[x].office_name.toUpperCase() + "</td>";
        // Get student clearance
        let studentClearance = checkStudentClearance(jsonClearance[x].id,period);
        // Check flag
        let isChecked = false;
        let remarks = "";
        // Check if not empty
        if(studentClearance != null){
            // Check if cleared
            isChecked = studentClearance[0] == 1?true:false;
            // Remarks
            remarks = studentClearance[1];
        }
        // Check table
        tableText += "<td><input type=\"checkbox\" " + (isChecked?"checked":"") +" onclick=\"return false\"></td>"
        tableText += "<td>" + remarks + "</td>";
        // End table row
        tableText += "</tr>";
    }
     

    // End table text
    tableText += "</table>"

    document.getElementById("clearance").innerHTML = tableText;
}

function getStudentClearance(){
    // Get Date
    let dateNow = new Date();
    let month = dateNow.getUTCMonth() +1;
    let year = dateNow.getFullYear();
    // Semester
    let semester;
    // 1st Sem (Aug-Dec)
    if(month >= 8 && month <= 12)
        semester = 1;
    // 2nd Sem (Jan-May)
    else if(month >= 1 && month <= 5)
        semester = 2;
    // Summer (Jun-July)
    else if(month >= 6 && month <= 7)
        semester = 3;
    
    // Semester Year
    let year1,year2;
    if (month >= 8 && month <= 12){
        year1 = year;
        year2 = year+1;
    }else{
        year1 = year-1;
        year2 = year;
    }
    let semesterYear = year1 + "-" + year2;

    // Initialize HTTP Request
    var xmlhttp=new XMLHttpRequest();
    // Response
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            // Store as JSON
            strJsonStudentClearance = this.responseText;
            console.log(strJsonStudentClearance);
        }else if(this.readyState==4){
            console.log("Fail: " + this.responseText);
        }
    }

    // Post form data request
    var postData="student_id="+ studentID + "&semester="+ semester +"&semester_year="+ semesterYear;

    // Request
    xmlhttp.open("POST","http://localhost/api/getStudentClearance.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(postData); 
}

function checkStudentClearance(clearanceID, period){
    // Convert to JSON
    let jsonClearance = JSON.parse(strJsonStudentClearance);

    // Clearance
    for(let x in jsonClearance){
        if(clearanceID == jsonClearance[x].clearance_id && period == jsonClearance[x].semester_period){
            return [jsonClearance[x].clearance_cleared, jsonClearance[x].remarks];
        }
    }

    // Return empty
    return null;
}



