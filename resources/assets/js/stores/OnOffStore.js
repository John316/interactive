import AppConstants from '../constants/AppConstants';
import AppDispatcher from '../dispatcher/AppDispatcher';
import assign from 'object-assign';
import AppAPI from '../utils/appAPI.js';
var EventEmitter = require('events').EventEmitter;

var eventEmitter = new EventEmitter();
var _stateBtn = true;

var OnOffStore = assign({}, EventEmitter.prototype, {

	getState() {
		return _stateBtn;
	},

	emitChange: function () {
		eventEmitter.emit(AppConstants.CHANGE_ON_OFF);
	},

	addChangeListener: function (callback) {
		eventEmitter.on(AppConstants.CHANGE_ON_OFF, callback);
	},
	removeChangeListener: function (callback) {
		eventEmitter.removeListener(AppConstants.CHANGE_ON_OFF, callback);
	}
});

AppDispatcher.register(function(payload){
	var action = payload.action;

	switch(action.actionType){
		case AppConstants.SWITCH_ON_OFF :
			_stateBtn = action.stateBtn;
			AppAPI.sendOnOffState(_stateBtn);
			OnOffStore.emitChange();
			break;
	}

	return true;
});

export default OnOffStore;
