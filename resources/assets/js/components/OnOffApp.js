import React from 'react';
import AppActions from '../actions/AppActions';
import OnOffModule from './OnOffModule';
import OnOffStore from '../stores/OnOffStore';

function getAppState(){
    return {
        btnState: OnOffStore.getState()
    };
}

var OnOffApp = React.createClass({

    getInitialState: function(){
        return getAppState();
    },

    handleSwitchOnOff: function (_, prop) {
        AppActions.switchOnOff(prop);
    },

    componentDidMount: function(){
        OnOffStore.addChangeListener(this._onChange);
    },

    componentUnmount: function(){
        OnOffStore.removeChangeListener(this._onChange);
    },

    render: function(){
        return (
            <div className="panel panel-info">
                <div className="panel-heading">
                    <h3 className="panel-title">Do you understand what you hear?</h3>
                </div>
                <div className="panel-body">
                    <OnOffModule onSwitch={this.handleSwitchOnOff}/>
                </div>
            </div>
        );
    },

    // Update view state when change is received
    _onChange: function(){
        this.setState(getAppState());
    }
});

export default OnOffApp;