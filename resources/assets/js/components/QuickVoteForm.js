import React from 'react';
import AppActions from '../actions/AppActions';

function getAppState(){
	return {
		id: 'User',
		titleText : 'You can vote here',
		thankYouText : 'Thank You for your vote!',
		voteOptions: [
			{value: 0, text: 'Bad'},
			{value: 1, text: 'Normal'},
			{value: 2, text: 'Good'}
		],
		infoSentStyle: {display: 'none'}
	};
}

var QuickVoteForm = React.createClass({

	getInitialState: function(){
		return getAppState();
	},

	handleSelectChange: function (event) {

		this.setState({infoSentStyle: {display: 'block'}});
	    setTimeout(function() {
			this.setState({infoSentStyle: {display: 'none'}});
	    }.bind(this), 3000);

		let vote = {
			id: this.state.id,
			date: Date.now(),
			value: event.target.value
		};
		console.log(vote);
		// AppActions.addItem(vote);
	},

	render: function() {
		return (
			<div className="panel panel-success">
				<div className="panel-heading">
					<h3 className="panel-title">{this.state.titleText}</h3>
				</div>
				<div className="panel-body">
					<p className="bg-primary info-sent" style={this.state.infoSentStyle}>{this.state.thankYouText}</p>
					<form className="form-inline" id="question_form">
						<div className="form-group">
							<select name="select" onChange={this.handleSelectChange}>
							  {this.state.voteOptions.map((opt, indx) => <option value={opt.value} key={indx}>{opt.text}</option>)}
							</select>
						</div>
					</form>
				</div>
			</div>
		);
	}
});

export default QuickVoteForm;