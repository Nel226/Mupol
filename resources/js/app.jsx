// resources/js/app.jsx

import React from 'react';
import ReactDOM from 'react-dom';
import Analytics from './views/dashboard/Analytics'; // Assurez-vous du bon chemin

ReactDOM.render(
  <Analytics />,
  document.getElementById('root') // Point d'attache dans votre page Blade
);
