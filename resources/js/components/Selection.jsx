import React from 'react';
import ReactDOM from 'react-dom';

function Selection() {
    const [selected, setSelected] = React.useState('');

    const changeSelectOptionHandler = (event) => {
        setSelected(event.target.value);
    }

    let course = null;
    let courseOptions = null;

    const as = [
        { text: 'BS in Biology', value: '011' },
        { text: 'BA in Psychology', value: '012' },
        { text: 'BS in Political Science', value: '013' }
    ];

    const ba = [
        { text: 'BS in Accountancy', value: '021' },
        { text: 'BS in Business Administration', value: '022' },
        { text: 'BS in Entrepreneurship', value: '023' }
    ];

    const cs = [
        { text: 'BS in Information Technology', value: '031' },
        { text: 'BS in Computer Science', value: '032' },
        { text: 'BS in Library and Information Science', value: '033' },
        { text: 'Associate in Computer Technology', value: '034' }
    ];

    const cje = [
        { text: 'BS in Criminal Justice Education', value: '041' }
    ];

    const educ = [
        { text: 'Bachelor of Elementary Education', value: '051' },
        { text: 'Bachelor of Secondary Education', value: '052' }, ,
        { text: 'Bachelor of Physical Education', value: '053' },
    ];

    const ea = [
        { text: 'BS in Architecture', value: '061' },
        { text: 'BS in Civil Engineering', value: '062' },
        { text: 'BS in Computer Engineering', value: '063' },
        { text: 'BS in Electrical Engineering', value: '064' }, ,
        { text: 'BS in Electronics Engineering', value: '065' }, ,
        { text: 'BS in Mechanical Engineering', value: '066' }, ,
    ];

    const nurse = [
        { text: 'Caregiving NCII', value: '071' },
        { text: 'BS in Nursing', value: '072' },
    ];


    const gradStudies = [
        { text: 'Master in Business Administration', value: '081' },
        { text: 'Master of Arts in Education', value: '082' },
        { text: 'Master of Arts in English', value: '083' },
        { text: 'Master of Arts in Filipino', value: '084' },
        { text: 'Master of Arts in Teaching Mathematics', value: '085' },
        { text: 'Master in Library and Information Science', value: '086' },
        { text: 'Master of Science in Environmental Science', value: '087' },
        { text: 'Master in Public Administration', value: '088' },
        { text: 'PhD, Major in Behavioral Management', value: '089' },
        { text: 'EdD, Major in Educational Management', value: '090' },
    ]

    const lawOfSchool = [
        { text: 'Master of Laws', value: '091' },
        { text: 'Juris Doctor', value: '092' },
    ]

    if (selected == '001') {
        course = as;
    } else if (selected == '002') {
        course = ba;
    } else if (selected == '003') {
        course = cs;
    } else if (selected == '004') {
        course = cje;
    } else if (selected == '005') {
        course = educ;
    } else if (selected == '006') {
        course = ea;
    } else if (selected == '007') {
        course = nurse;
    } else if ( selected == '008') {
        course = gradStudies;
    } else if (selected == '009') {
        course = lawOfSchool;
    }

    if (course) {
        courseOptions = course.map((option, index) => <option key={index} value={option.value}>{option.text}</option>);
    }
    return (
        <div>
            <div className='form-group mb-2'>
                <label className="col-form-label col-form-label-sm">Program <span
                    class="text-danger">*</span></label>
                <select className="form-select form-select-sm " name="department_id" onChange={changeSelectOptionHandler} required>
                    <option disabled selected>Choose...</option>
                    <option value="001">Arts and Science</option>
                    <option value="002">Business and Accountancy</option>
                    <option value="003">Computer Studies</option>
                    <option value="004">Criminal Justice Education</option>
                    <option value="005">Education</option>
                    <option value="006">Engineering and Architecture</option>
                    <option value="007">Nursing</option>
                    <option value="008">Graduate Studies</option>
                    <option value="009">School of Law</option>
                </select>
            </div>
            <div className="form-group mb-2">
                <label className="col-form-label col-form-label-sm">Course</label>
                <select className="form-select form-select-sm" name="course_id">
                    {courseOptions}
                </select>
            </div>
        </div>
    );
}

export default Selection;

if (document.getElementById('selection')) {
    ReactDOM.render(<Selection />, document.getElementById('selection'));
}
