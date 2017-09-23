import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Example extends Component {
    render() {
        return (
            <div>
                <h1>Example React Component</h1>
            </div>
        );
    }
}

export default Example;

if (document.getElementById('react-example')) {
    ReactDOM.render(
        <Example />,
        document.getElementById('react-example')
    );
}
