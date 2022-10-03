import React from 'react';
import ReactDOM from 'react-dom';

function Selection() {
    const [selected, setSelected] = React.useState('');

    const changeSelectOptionHandler = (event) => {
        setSelected(event.target.value);
    }

    let type = null;
    let options = null;

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

    if(selected == '001'){
        type = as;
    }else if(selected == '002'){
        type = ba;
    }else if(selected == '003'){
        type = cs;
    }else if(selected == '004'){
        type = cje;
    }else if(selected == '005'){
        type = educ;
    }else if(selected == '006'){
        type = ea;
    }else if(selected == '007'){
        type = nurse;
    }

    if (type) {
        options = type.map((option, index) => <option key={index} value={option.value}>{option.text}</option>);
    }
    return (
       <div id='example'>
            <select name="department" onChange={changeSelectOptionHandler}>
                <option>Choose...</option>
                <option value="001">Arts and Science</option>
                <option value="002">Business and Accountancy</option>
                <option value="003">Computer Studies</option>
                <option value="004">Criminal Justice Education</option>
                <option value="005">Education</option>
                <option value="006">Engineering and Architecture</option>
                <option value="007">Nursing</option>
            </select>
            <select name="course">
                {
                    options
                }
            </select>
       </div>
    );
}

export default Selection;

if (document.getElementById('example')) {
    ReactDOM.render(<Selection />, document.getElementById('example'));
}