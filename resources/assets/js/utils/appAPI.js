import $ from 'jquery';
import OnOffStore from '../stores/OnOffStore';

export default {

    sendOnOffState(state, callback) {

        var url = eventId +"/level/add";
        var _token = $('[name="_token"]').val();
        var level = state ? 5 : 1;
        var electionId = 1;

        var data = {_token: _token, level: level, user_id: userId, election_id: electionId};
        this.makePostRequest(url, data, callback);
    },

    sendAddQuestion(text, callback) {

        var url = eventId +"/question/add";
        var _token = $('[name="_token"]').val();
        var electionId = 1;

        var data = {
            _token: _token, 
            text : text,
            rate : 2,
            client_event_id : eventId,
            status : 1
        };

        this.makePostRequest(url, data, callback);
    },

    getQuestionForEvent(callback) {

        var url = eventId +"/questions";
        
        this.makeGetRequest(url, callback);
    },

    makePostRequest(url, data, callback){
        $.post(url, data)
            .done(function( data ) {
                if(callback){
                    callback(data);
                }
            })
            .fail(function(message) {
                console.log("api error: " + message);
            });
    },

    makeGetRequest(url, callback){
        $.get(url)
            .done(function( data ) {
                if(callback){
                    callback(data);
                }
            })
            .fail(function(message) {
                console.log("api error: " + message);
            });
    }
}