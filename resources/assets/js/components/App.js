import React from 'react';

import RaisedButton from 'material-ui/RaisedButton';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import NavigationClose from 'material-ui/svg-icons/navigation/close';
import {Card, CardActions, CardHeader, CardText} from 'material-ui/Card';


import AppActions from '../actions/AppActions';
var AppStore = require('../stores/AppStore');

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

	handleClick:function(){
		AppActions.addItem('this is the item');
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

var Question = React.createClass({
	render: function() {
		return (
			<div>
				<MuiThemeProvider>
					<Card className="message-body" >
						<CardText>
							<NavigationClose className="mess-cancel" onClick={this.props.onDelete} />
							{this.props.text} Rate:<span className="rate">{this.props.rate}</span>
						</CardText>
					</Card>
				</MuiThemeProvider>
			</div>
		);
	}
});

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

module.exports = App;