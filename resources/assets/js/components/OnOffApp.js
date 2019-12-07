import React, {Component} from 'react';
import AppActions from '../actions/AppActions';
import OnOffModule from './OnOffModule';
import OnOffStore from '../stores/OnOffStore';



class OnOffApp extends Component {

    state = {
        btnState: OnOffStore.getState()
    }

    handleSwitchOnOff (_, prop) {
        AppActions.switchOnOff(prop);
    }

    componentDidMount(){
        OnOffStore.addChangeListener(this._onChange);
    }

    componentUnmount (){
        OnOffStore.removeChangeListener(this._onChange);
    }

   // Update view state when change is received
    _onChange (){
        this.setState(()=> {btnState: OnOffStore.getState()} );
    }
	
    render (){
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
    }

    
}

export default OnOffApp;
