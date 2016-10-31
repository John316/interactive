import AppConstants from '../constants/AppConstants';
import AppDispatcher from '../dispatcher/AppDispatcher';
import assign from 'object-assign';
import AppAPI from '../utils/AppAPI.js';
var EventEmitter = require('events').EventEmitter;

var _items = [
	{   id: 1,
		userId: 1,
		rate: 4,
		text: "Text of the question1"
	}, {
		id: 2,
		userId: 2,
		rate: 4,
		text: "Text of the question2"
	},{
		id: 3,
		userId: 2,
		rate: 2,
		text: "Text of the question3"
	},{
		id: 4,
		userId: 1,
		rate: 5,
		text: "Text of the question4"
	},{
		id: 5,
		userId: 1,
		rate: 2,
		text: "Text of the question5"
	}
];

var AppStore = assign({}, EventEmitter.prototype, {

	getTasks() {
		return _items;
	},

	emitChange: function () {
		this.emit(AppConstants.CHANGE_EVENT);
	},
	addChangeListener: function (callback) {
		this.on(AppConstants.CHANGE_EVENT, callback);
	},
	removeChangeListener: function (callback) {
		this.removeListener(AppConstants.CHANGE_EVENT, callback);
	}
});

AppDispatcher.register(function(payload){
	var action = payload.action;

	console.log(payload);

	switch(action.actionType){
		case AppConstants.ADD_ITEM: {
			_items.unshift(action.item);
			AppStore.emitChange();
			break;
		}

		case AppConstants.DELETE_ITEM:{
			var questionId = action.item.id;
			_items = _items.filter(function (question) {
				return question.id !== questionId;
			});
			AppStore.emitChange();
			break;
		}
	}

	return true;
});

export default AppStore;