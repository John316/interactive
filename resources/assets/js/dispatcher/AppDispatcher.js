var Dispatcher = require('flux').Dispatcher;
var assign = require('object-assign');
var AppConstants = require('../constants/AppConstants');

var AppDispatcher = assign(new Dispatcher(),{
	handleViewAction: function(action){
		var payload = {
			source: AppConstants.VIEW_ACTION,
			action: action
		};
		this.dispatch(payload);
	}
});


module.exports = AppDispatcher;