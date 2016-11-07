var AppDispatcher = require('../dispatcher/AppDispatcher');
var AppConstants = require('../constants/AppConstants');

var AppActions = {
    addItem: function(item){
        AppDispatcher.handleViewAction({
            actionType: AppConstants.ADD_ITEM,
            item: item
        })
    },

    deleteItem: function(item){
        AppDispatcher.handleViewAction({
            actionType: AppConstants.DELETE_ITEM,
            item: item
        })
    },

    switchOnOff: function(state){
        AppDispatcher.handleSwitcherAction({
            actionType: AppConstants.SWITCH_ON_OFF,
            stateBtn: state
        })
    },

    switchOnOffDone: function(result){
        AppDispatcher.handleSwitcherAction({
            actionType: AppConstants.SWITCH_ON_OFF,
            stateBtn: result
        })
    }
};

module.exports = AppActions;