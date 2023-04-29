const reqCopyGradeCheckBox = document.getElementById("reqCopyGrade");
const torReqCheckBox = document.getElementById("torReq");
const selectPurpose = document.getElementById("selectPurpose");
const inputPurpose = document.getElementById("inputPurpose");
const torCopies = document.getElementById("torCopies");
const schoolYearInput = document.getElementById("schoolYear");
const numCopiesGrade = document.getElementById("numCopiesGrade");
const semester = document.getElementById("semester");

reqCopyGradeCheckBox.addEventListener("change", function() {
  if (reqCopyGradeCheckBox.checked) {
    schoolYearInput.required = true;
    numCopiesGrade.required = true;
    semester.required = true;
  } else {
    schoolYearInput.required = false;
    numCopiesGrade.required = false;
    semester.required = false;
  }
});

torReqCheckBox.addEventListener("change", function(){
    if(torReqCheckBox.checked){
        torCopies.required = true;
        if(selectPurpose.value == ""){
          inputPurpose.required = true;
        }
    }else{
        torCopies.required = false;
        inputPurpose.required = false;
    }
});

selectPurpose.addEventListener("change", function (){
    if(torReqCheckBox.checked){
      if(selectPurpose.value != ""){
        inputPurpose.required = false;
      }else{
        inputPurpose.required = true;
      }
    }
});

function enableButton(){
    let checkBoxes = document.querySelectorAll('input[type="checkbox"]');
    let checkedOne = Array.prototype.slice.call(checkBoxes).some(x => x.checked);

    document.getElementById('submitSelected').disabled = true;

    if(checkedOne){
        document.getElementById('submitSelected').disabled = false;
    }
}