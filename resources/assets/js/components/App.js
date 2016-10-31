import React from 'react';
import AppActions from '../actions/AppActions';
import AppStore from'../stores/AppStore';

import QuestionList from './QuestionList.js';
import AskForm from './AskForm.js';

function getAppState(){
	return {
		moduleTitle : 'Title of module',
		titleText : 'You can ask question',
		thankYouText : 'Thank You for your message!',
		buttonText : 'Send',
		data: AppStore.getTasks()
	};
}

var App = React.createClass({

	getInitialState: function(){
		return getAppState();
	},

	handleQuestionAdd: function (newQuestion) {
		AppActions.addItem(newQuestion);
	},

	handleQuestionDelete: function (question) {
		AppActions.deleteItem(question);
	},

	componentDidMount: function(){
		AppStore.addChangeListener(this._onChange);
	},

	componentUnmount: function(){
		AppStore.removeChangeListener(this._onChange);
	},

	render: function(){
		return (
			<div>
				<AskForm
					onQuestionAdd={this.handleQuestionAdd}
					titleText={this.state.titleText}
					thankYouText={this.state.thankYouText}
					buttonText={this.state.buttonText}
				/>
				<QuestionList
					data={this.state.data}
					onQuestionDelete={this.handleQuestionDelete}
					moduleTitle={this.state.moduleTitle}
				/>
			</div>
		);
	},

	// Update view state when change is received
	_onChange: function(){
		this.setState(getAppState());
	}
});

module.exports = App;