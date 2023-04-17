import React, { useState } from "react";
import ReactDOM from 'react-dom';

const SetStateStudent = () => {
  const [selectedValue, setSelectedValue] = useState("");

  const handleSelectChange = (e) => {
    setSelectedValue(e.target.value);
    setInputValue(""); // Reset input value when select value changes
  };
  
  return (
    <div>
        <div className="form-group">
            <label className="col-form-label col-form-label-sm">Status<span
                    className="text-danger">*</span></label>
            <select className="form-select form-select-sm" name="status" value={selectedValue} onChange={handleSelectChange} required>
                <option value="">Select an option</option>
                <option value="1">ACTIVE</option>
                <option value="2">TRANSFERRED</option>
                <option value="3">DROPPED OUT</option>
                <option value="4">GRADUATED</option>
            </select>
        </div>
      
      {selectedValue === "4" && (
        <div className="form-group">
             <label className="col-form-label col-form-label-sm">Date Graduated<span
                    className="text-danger">*</span></label>
            <input className="form-control form-control-sm"
                name = "gradDate"
                type="date"
                required
            />
        </div>
      )}
    </div>
  );
};

export default SetStateStudent;

if (document.getElementById('SetState')) {
    ReactDOM.render(<SetStateStudent />, document.getElementById('SetState'));
}
