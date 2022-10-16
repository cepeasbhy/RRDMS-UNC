import React from 'react';
import ReactDOM from 'react-dom';

function Selection() {
    const [selected, setSelected] = React.useState('');

    const changeSelectOptionHandler = (event) => {
        setSelected(event.target.value);
    }

    let course = null;
    let courseOptions = null;

    const as =[
        {text: 'BS in Biology', value: '011'},
        {text: 'BA in Psychology', value: '012'},
        {text: 'BS in Political Science', value: '013'}
    ];

    const ba = [
        {text: 'BS in Accountancy', value: '021'},
        {text: 'BS in Business Administration', value: '022'},
        {text: 'BS in Entrepreneurship', value: '023'}
    ];

    const cs = [
        {text: 'BS in Information Technology', value: '031'},
        {text: 'BS in Computer Science', value: '032'},
        {text: 'BS in Library and Information Science', value: '033'},
        {text: 'Associate in Computer Technology', value: '034'}
    ];

    const cje = [
        {text: 'BS in Criminal Justice Education', value: '041'}
    ];

    const educ = [
        {text: 'Bachelor of Elementary Education', value: '051'},
        {text: 'Bachelor of Secondary Education', value: '052'},,
        {text: 'Bachelor of Physical Education', value: '053'},
    ];

    const ea = [
        {text: 'BS in Architecture', value: '061'},
        {text: 'BS in Civil Engineering', value: '062'},
        {text: 'BS in Computer Engineering', value: '063'},
        {text: 'BS in Electrical Engineering', value: '064'},,
        {text: 'BS in Electronics Engineering', value: '065'},,
        {text: 'BS in Mechanical Engineering', value: '066'},,
    ];

    const nurse = [
        {text: 'Caregiving NCII', value: '071'},
        {text: 'BS in Nursing', value: '072'},
    ];

    const doctorate = [
        {text: 'PhD, Major in Behavioral Management', value: '081'},
        {text: 'EdD, Major in Educational Management', value: '082'},
    ];

    const masters = [
        {text: 'Master in Business Administration', value: '091'},
        {text: 'Master of Arts in Education', value: '092'},
        {text: 'Master of Arts in English', value: '093'},
        {text: 'Master of Arts in Filipino', value: '094'},
        {text: 'Master of Arts in Teaching Mathematics', value: '095'},
        {text: 'Master in Library and Information Science', value: '096'},
        {text: 'Master of Science in Environmental Science', value: '097'},
        {text: 'Master in Public Administration', value: '098'},
    ];

    if(selected == '001'){
        course = as;
    }else if(selected == '002'){
        course = ba;
    }else if(selected == '003'){
        course = cs;
    }else if(selected == '004'){
        course = cje;
    }else if(selected == '005'){
        course = educ;
    }else if(selected == '006'){
        course = ea;
    }else if(selected == '007'){
        course = nurse;
    }else if(selected == '008'){
        course = doctorate;
    }else if(selected == '009'){
        course = masters;
    }

    if (course) {
        courseOptions = course.map((option, index) => <option key={index} value={option.value}>{option.text}</option>);
    }
    return (
        <div>
            <div className='form-group row mb-2'>
                <label className="col-sm-3 col-form-label col-form-label-sm">Department</label>
                <div className="col-sm-9">
                    <select className="form-select form-select-sm" name="department_id" onChange={changeSelectOptionHandler} required>
                        <option>Choose...</option>
                        <option value="001">Arts and Science</option>
                        <option value="002">Business and Accountancy</option>
                        <option value="003">Computer Studies</option>
                        <option value="004">Criminal Justice Education</option>
                        <option value="005">Education</option>
                        <option value="006">Engineering and Architecture</option>
                        <option value="007">Nursing</option>
                        <option value="008">Doctorate Degree</option>
                        <option value="009">Masters Degree</option>
                        <option value="010">Master of Laws</option>
                        <option value="011">Juris Doctor</option>
                    </select>
                </div>
            </div>
            <div className="form-group row mb-2">
                <label className="col-sm-3 col-form-label col-form-label-sm">Course</label>
                <div className="col-sm-9">
                  <select className="form-select form-select-sm" name="course_id">
                    {courseOptions}
                  </select>
                </div>
            </div>
        </div>
    );
}

export default Selection;

if (document.getElementById('selection')) {
    ReactDOM.render(<Selection />, document.getElementById('selection'));
}