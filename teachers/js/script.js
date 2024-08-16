
function showAddStudentForm() {
    document.getElementById("addStudentModal").style.display = "block";
}

function closeAddStudentForm() {
    document.getElementById("addStudentModal").style.display = "none";
}

function saveToDatabase(editableObj, column, id) {
    var value = editableObj.innerText.trim(); // Using innerText to avoid HTML tags like <br>
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "edit_student.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(this.responseText);
            if (response.success) {
                toastr.success('Update successful!');
            } else {
                toastr.error('Update failed: ' + response.message);
            }
        }
    };
    xhttp.send("column=" + column + "&value=" + encodeURIComponent(value) + "&id=" + id);
}
