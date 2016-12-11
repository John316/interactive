import React from 'react';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import NavigationClose from 'material-ui/svg-icons/navigation/close';
import {Card, CardText} from 'material-ui/Card';

var Question = React.createClass({
    render: function() {
        return (
            <MuiThemeProvider>
                <Card className="message-body" >
                    <CardText>
                        <NavigationClose className="mess-cancel" onClick={this.props.onDelete} />
                        {this.props.text} Rate:<span className="rate">{this.props.rate}</span>
                    </CardText>
                </Card>
            </MuiThemeProvider>
        );
    }
});

export default Question;
