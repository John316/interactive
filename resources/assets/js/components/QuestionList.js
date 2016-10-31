import React from 'react';
import Question from './Question.js';

var QuestionList = React.createClass({

    render: function() {

        var onQuestionDelete = this.props.onQuestionDelete;

        return (
            <div className="panel panel-default">
                <div className="panel-heading">
                    <h3 className="panel-title">{this.props.moduleTitle}</h3>
                </div>
                <div className="panel-body">

                    {
                        this.props.data.map(function(question) {
                            return <Question
                                key={question.id}
                                rate={question.rate}
                                text={question.text}
                                userId={question.userId}
                                onDelete={onQuestionDelete.bind(null, question)}
                            />;
                        })
                    }
                </div>
            </div>
        );
    }
});

export default QuestionList;