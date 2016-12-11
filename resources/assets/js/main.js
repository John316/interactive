import React from 'react';
import ReactDOM from 'react-dom';
import OnOffApp from './components/OnOffApp';
import QuestionList from './components/QuestionsList';
import QuestionForm from './components/QuestionForm';
import QuickVoteForm from './components/QuickVoteForm';

ReactDOM.render(
	<QuestionForm />,
	document.getElementById('question-form')
);

ReactDOM.render(
	<OnOffApp />,
	document.getElementById('switcher')
);

ReactDOM.render(
	<QuestionList />,
	document.getElementById('questions-list')
);

ReactDOM.render(
	<QuickVoteForm />,
	document.getElementById('quick-vote-form')
);
