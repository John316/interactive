import React, {Component}from 'react';
import Question from './Question.js';
import AppActions from '../actions/AppActions';
import QuestionStore from'../stores/QuestionStore';



class QuestionsList extends Component {
   
  state = {
        moduleTitle : 'List of question',
        data: QuestionStore.getQuestions()
    }


    handleQuestionDelete (question) {
        AppActions.deleteItem(question);
    }

    componentDidMount (){
        QuestionStore.addChangeListener(this._onChange);
    }

    componentWillUnmount (){
        QuestionStore.removeChangeListener(this._onChange);
    }


   _onChange (){
        this.setState( () => {
		     data: QuestionStore.getQuestions()} );    
    }
	
    _renderQuestions ()
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
    }
    
    render () {
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
    }
    
}

export default QuestionsList;
