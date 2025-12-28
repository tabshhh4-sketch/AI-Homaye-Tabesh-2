import { createElement } from '@wordpress/element';
import AtlasControlCenter from './components/AtlasControlCenter';
import HomaSuperPanel from './components/HomaSuperPanel';

const App = ({ page }) => {
  // Determine which component to render based on the page
  const renderPage = () => {
    if (!page) {
      return createElement('div', { className: 'homaye-tabesh-error' }, 'صفحه مشخص نشده است.');
    }

    // Atlas Control Center pages
    if (page.startsWith('atlas-')) {
      return createElement(AtlasControlCenter, { page });
    }

    // Homa Super Panel pages
    if (page.startsWith('homa-')) {
      return createElement(HomaSuperPanel, { page });
    }

    return createElement('div', { className: 'homaye-tabesh-error' }, 'صفحه یافت نشد.');
  };

  return createElement('div', { className: 'homaye-tabesh-app' }, renderPage());
};

export default App;
