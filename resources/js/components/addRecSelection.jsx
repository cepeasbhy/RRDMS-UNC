import React from 'react';
import ReactDOM from 'react-dom';

function AddRec(){
    const [keyName, setSelected] = React.useState('');

    const changeSelectOptionHandler = (event) => {
        setSelected(event.target.value);
    }

    let fileName;

    switch(keyName){
        case "picture":
            fileName = "Picture";
            break;
        case "birthCertificate":
            fileName = "Birth Certificate";
            break;
        case "marriageCertificate":
            fileName = "Marriage Certificate";
            break;
        case "goodMoralCharacter":
            fileName = "Certificate of Good Moral Character";
            break;
        case "honorDismisal":
            fileName = "Honorable Dismisal";
            break;
        case "form9":
            fileName = "Form 9";
            break;
        case "form137":
            fileName = "Form 137";
            break;
        case "form138":
            fileName = "Form 138";
            break;
        case "copyGrade":
            fileName = "Copy of Grades";
            break;
        case "tor":
            fileName = "Transcript of Record";
            break;
        case "NbiClearance":
            fileName = "NBI Clearance";
            break;
        case "PoliceClearance":
            fileName = "Police Clearance"
            break;
        case "C1":
            fileName = "C1 Receipt";
            break;
        case "permitCrossEnroll":
            fileName = "Permit to Cross Enroll"
            break;
        default:
            fileName = "";
    }

    return(
        <div>
            <div className="form-group">
                {keyName != "others" && 
                    (<input type="hidden" name="fileName" value={fileName}/>)
                }

                <label className="col-form-label col-form-label-sm">Type of Record to add<span
                    className="text-danger">*</span></label>
                <select className="form-select form-select-sm" name="keyName" onChange={changeSelectOptionHandler} required>
                    <option value="">Choose...</option>
                    <option value="picture">Picture</option>
                    <option value="birthCertificate">Birth Certificate</option>
                    <option value="marriageCertificate">Marriage Certificate</option>
                    <option value="goodMoralCharacter">Certificate of Good Moral Character</option>
                    <option value="honorDismisal">Honorable Dismisal</option>
                    <option value="form9">Form 9</option>
                    <option value="form137">Form 137</option>
                    <option value="form138">Form 138</option>
                    <option value="copyGrade">Copy of Grades</option>
                    <option value="tor">Transcript of Record</option>
                    <option value="NbiClearance">NBI Clearance</option>
                    <option value="PoliceClearance">Police Clearance</option>
                    <option value="C1">C1 Receipt</option>
                    <option value="permitCrossEnroll">Permit to Cross Enroll</option>
                    <option value="others">Others</option>
                </select>
            </div>
            {keyName == "others" && (
                <div className="form-group mt-3">
                    <label className="col-form-label col-form-label-sm">Enter document name<span
                        className="text-danger">*</span></label>
                    <input className="form-control form-control-sm" type="text" name="fileName" required/>
                </div>
            )}
            <div className="form-group mt-3">
                <label className="col-form-label col-form-label-sm">Choose A File<span
                        className="text-danger">*</span></label>
                <input className="form-control form-control-sm" type="file" name={keyName} required/>
            </div>
        </div>
    );
}

export default AddRec;

if (document.getElementById('addSingleRec')) {
    ReactDOM.render(<AddRec />, document.getElementById('addSingleRec'));
}
