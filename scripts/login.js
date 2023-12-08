// Create table
createTable();
// addDummyStudent();
checkboxPass();

function createTable(){
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            console.log("Success");
        }else{
            console.log("Fail");
        }
    }
    xmlhttp.open("GET","http://localhost/api/createTable.php",true);
    xmlhttp.send();
}

function login(){
    var inputId= document.getElementById('student_teacher_id').value;
    var inputPass= document.getElementById('passwrd').value;
                

    // Check Student and Teacher's ID from Database (Query Login)
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            if(this.responseText == "student" || this.responseText == "teacher"){
                var accountType = this.responseText;
                console.log("Account Type: " + accountType);
                window.location.href = "student.html";
                sessionStorage.setItem("student_id", inputId);
            }else{
                failedValidation(this.responseText);
            }
            console.log("Success: " + this.responseText);
        }else if(this.readyState==4){
            console.log("Fail: " + this.responseText);
        }
    }

    var postData="student_teacher_id="+ inputId + "&passwrd=" + inputPass;

    xmlhttp.open("POST","http://localhost/api/login.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(postData); 
}

function failedValidation(displayText){
    document.getElementById("login-failed").innerHTML = displayText;
}

function checkboxPass(){
    var cbPass = document.getElementById('passwrd');
    
    if (cbPass.type==="password"){
        cbPass.type = "text";
    }else{
        cbPass.type = "password";
    }
    console.log("test value: " + cbPass.type);

}

// function addDummyStudent(){
//     var studentID = "2018-1073";
//     var course = "BSIT";
//     var yearLevel = "3";
//     var firstName = "Salmia";
//     var middleInitial = "R";
//     var lastName = "Kayas";
//     var gender = "F";
//     var birthday = "1998-12-22";

//     var xmlhttp=new XMLHttpRequest();
//     xmlhttp.onreadystatechange=function() {
//         if (this.readyState==4 && this.status==200) {
//             console.log("Success: " + this.responseText);
//         }else if(this.readyState==4){
//             console.log("Fail: " + this.responseText);
//         }
//     }

//     var postData="student_id="+ studentID + "&student_course="+ course + "&year_level="+ yearLevel 
//         + "&first_name="+ firstName + "&middle_initial="+ middleInitial + "&last_name="+ lastName + "&gender="+ gender + "&birthday="+ birthday;

//     xmlhttp.open("POST","https://localhost/api/addStudent.php",true);
//     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xmlhttp.send(postData); 
// }
