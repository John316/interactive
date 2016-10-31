import React from 'react';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import RaisedButton from 'material-ui/RaisedButton';

var AskForm = React.createClass({

    getInitialState: function() {
        return {
            text: ""
        };
    },

    handleTextChange: function (event) {
        this.setState( {text: event.target.value});
    },

    handleAddQuestion: function () {
        var newQuestion = {
            id: Date.now(),
            text: this.state.text
        };

        this.props.onQuestionAdd(newQuestion);
        this.setState({text: '' });
    },

    render: function() {
        return (
            <div className="panel panel-success">
                <div className="panel-heading">
                    <h3 className="panel-title">{this.props.titleText}</h3>
                </div>
                <div className="panel-body">
                    <p className="bg-primary info-sent">{this.props.thankYouText}</p>
                    <form className="form-inline" id="question_form">
                        <div className="form-group">
                            <input type="text"
                                   value={this.state.text}
                                   onChange={this.handleTextChange}
                                   className="form-control"
                                   placeholder="Enter question" />
                        </div>
                        <MuiThemeProvider>
                            <RaisedButton label={this.props.buttonText} onClick={this.handleAddQuestion} />
                        </MuiThemeProvider>
                    </form>
                </div>
            </div>
        );
    }
});

export default AskForm;