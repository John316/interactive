import React from 'react';
import Question from './Question.js';
import AppActions from '../actions/AppActions';
import QuestionStore from'../stores/QuestionStore';

function getAppState(){
    return {
        moduleTitle : 'List of question',
        data: QuestionStore.getQuestions()
    };
}

var QuestionsList = React.createClass({
    
    getInitialState: function(){
        return getAppState();
    },

    handleQuestionDelete: function (question) {
        AppActions.deleteItem(question);
    },

    componentDidMount: function(){
        QuestionStore.addChangeListener(this._onChange);
    },

    componentWillUnmount: function(){
        QuestionStore.removeChangeListener(this._onChange);
    },


    _renderQuestions: function()
    {
        var handleQuestionDelete = this.handleQuestionDelete;
        return this.state.data.map(function(question) {
            return <Question
                key={question.id}
                rate={question.rate}
                text={question.text}
                userId={question.userId}
                onDelete={handleQuestionDelete.bind(null, question)}
            />;
        })
    },
    
    render: function() {
        return (
            <div className="panel panel-default">
                <div className="panel-heading">
                    <h3 className="panel-title">{this.state.moduleTitle}</h3>
                </div>
                <div className="panel-body">
                    {this._renderQuestions()}
                </div>
            </div>
        );
    },
    
    _onChange: function(){
        this.setState(getAppState());
    }
});

export default QuestionsList;