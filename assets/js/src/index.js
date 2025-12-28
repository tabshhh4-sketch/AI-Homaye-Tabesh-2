import { createElement } from '@wordpress/element';
import { createRoot } from '@wordpress/element';
import App from './App';
import './styles.css';

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
  const rootElement = document.getElementById('homaye-tabesh-root');
  
  if (rootElement) {
    const root = createRoot(rootElement);
    const page = rootElement.getAttribute('data-page');
    
    root.render(createElement(App, { page }));
  }
});
