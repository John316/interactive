import React from 'react';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import Toggle from 'material-ui/Toggle';

const styles = {
    block: {
        maxWidth: 250,
    },
    toggle: {
        marginBottom: 16,
    }
};
var OnOffModule = React.createClass({

    getInitialState: function() {
        return {
            stateBtn: true
        };
    },

    render: function() {
        return (
            <MuiThemeProvider>
                <Toggle
                    label="Choose YES or NO"
                    defaultToggled={true}
                    style={styles.toggle}
                    onToggle={this.props.onSwitch}
                />
            </MuiThemeProvider>
        );
    }
});

export default OnOffModule;