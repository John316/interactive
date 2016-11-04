import React from 'react';
import ReactDOM from 'react-dom';
import OnOffApp from './components/OnOffApp';
import QuestionList from './components/QuestionsList';
import QuestionForm from './components/QuestionForm';

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

