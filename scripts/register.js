checkboxPass(true);
checkboxPass(false);

// 
function onClickRegister(){
    var inputEmail= document.getElementById('email').value;
    console.log("email: " + inputEmail);
    var inputId= document.getElementById("student_teacher_id").value;
    console.log("ID: " + inputId);
    var inputPass= document.getElementById("password").value;
    console.log("Pass: "+ inputPass);
    var inputConPass= document.getElementById("confirm_password").value;
    console.log("Confirm Password: "+ inputConPass);

    // Checking email
    if(!inputEmail.includes("@sjp2cd.edu.ph")){
        failedValidation("Not school email.");
        return;
    }

    // Checking password
    if(!(inputPass.length >= 6 && inputPass==inputConPass)){
        if(inputPass.length < 6)
            failedValidation("Password must be at least 6 Characters");
        else
            failedValidation("Password do not match");
        return;
    }

    // Check Student and Teacher's ID from Database (Query)
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            if(this.responseText == "student" || this.responseText == "teacher"){
                var accountType = this.responseText;
                registerAccount(inputEmail, inputId, accountType, inputPass);
            }else{
                failedValidation(this.responseText);
            }
            console.log("Success: " + this.responseText);
        }else if(this.readyState==4){
            console.log("Fail: " + this.responseText);
        }
    }

    var postData="student_teacher_id="+ inputId;

    xmlhttp.open("POST","https://localhost/api/checkStudentTeacherID.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(postData); 
}

function failedValidation(displayText){
    document.getElementById("pass-validation").innerHTML = displayText;
    document.getElementById("pass-validation").style.color = "red";
}

function registerAccount(email,id,accountType,password){
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            console.log("Success: " + this.responseText);
            if(this.responseText.trim() == "success"){
                window.location.href = "login.html";
            }else{
                failedValidation("Couldn't Register");
            }
        }else if(this.readyState==4){
            console.log("Fail: " + this.responseText);
        }
    }

    var postData="email="+ email + "&id="+ id +"&password="+ password + "&acc_type=" + accountType;

    xmlhttp.open("POST","https://localhost/api/addAccount.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(postData); 
}


function checkboxPass(isPassword){
    var id = "password";
    if(!isPassword) id = "confirm_password";
    console.log("id: " + id);
    var cbPass = document.getElementById(id);
    
    if (cbPass.type==="password"){
        cbPass.type = "text";
    }else{
        cbPass.type = "password";
    }
    console.log("test value: " + cbPass.type);

}