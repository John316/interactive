var Dispatcher = require('flux').Dispatcher;
var assign = require('object-assign');
var AppConstants = require('../constants/AppConstants');

var AppDispatcher = assign(new Dispatcher(),{
	handleViewAction: function(action){
		var payload = {
			source: AppConstants.QUESTION_ACTION,
			action: action
		};
		this.dispatch(payload);
	},

	handleSwitcherAction: function(action){
		var payload = {
			source: AppConstants.SWITCHER_ACTION,
			action: action
		};
		this.dispatch(payload);
	}
});


module.exports = AppDispatcher;