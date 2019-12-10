import React, {Component} from 'react';
import AppActions from '../actions/AppActions';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import RaisedButton from 'material-ui/RaisedButton';
//import injectTapEventPlugin from 'react-tap-event-plugin';
//injectTapEventPlugin();




class QuestionForm extends Component{

	state = {
		titleText : 'You can ask question',
		thankYouText : 'Thank You for your message!',
		buttonText : 'Send',
		text: ""
	}

	handleTextChange(event) {
		this.setState( {text: event.target.value});
	}

	handleAddQuestion () {
		var newQuestion = {
			id: Date.now(),
			text: this.state.text
		}
		
	
		AppActions.addItem(newQuestion);

		this.setState({text: '' });
	}

	render() {
		return (
			<div className="panel panel-success">
				<div className="panel-heading">
					<h3 className="panel-title">{this.state.titleText}</h3>
				</div>
				<div className="panel-body">
					<p className="bg-primary info-sent">{this.state.thankYouText}</p>
					<form className="form-inline" id="question_form">
						<div className="form-group">
							<input type="text"
								   value={this.state.text}
								   onChange={this.handleTextChange.bind(this)}
								   className="form-control"
								   placeholder="Enter question" />
						</div>
						<MuiThemeProvider>
							<RaisedButton label={this.state.buttonText} onClick={this.handleAddQuestion.bind(this)} />
						</MuiThemeProvider>
					</form>
				</div>
			</div>
		);
	}
};

export default QuestionForm;