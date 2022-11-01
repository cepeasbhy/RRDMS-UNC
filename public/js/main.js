function enableButton(){
    let checkBoxes = document.querySelectorAll('input[type="checkbox"]');
    let checkedOne = Array.prototype.slice.call(checkBoxes).some(x => x.checked);

    document.getElementById('submitSelected').disabled = true;

    if(checkedOne){
        document.getElementById('submitSelected').disabled = false;
    }
}