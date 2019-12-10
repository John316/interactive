import AppConstants from '../constants/AppConstants';
import AppDispatcher from '../dispatcher/AppDispatcher';
import assign from 'object-assign';
import AppActions from '../actions/AppActions';
import AppAPI from '../utils/AppAPI.js';
var EventEmitter = require('events').EventEmitter;

var _items = [];

var QuestionStore = assign({}, EventEmitter.prototype, {

	getQuestions() {
		if(_items.length === 0){
			this.firstLoadQuestions();
		}
		return _items;
	},

	setQuestions(data){
		_items = data;
	},

	firstLoadQuestions: function () {
		var callback = QuestionStore.emitChange;
		AppAPI.getQuestionForEvent(callback);
	},

	emitChange: function () {
		console.log('emitChange');
		console.log(_items);
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
			QuestionStore.emitChange();

			AppAPI.sendAddQuestion(action.item.text);
			
			break;
		}

		case AppConstants.DELETE_ITEM:{
			var questionId = action.item.id;
			_items = _items.filter(function (question) {
				return question.id !== questionId;
			});
			QuestionStore.emitChange();
			break;
		}
	}

	return true;
});

export default QuestionStore;