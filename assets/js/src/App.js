import React from 'react';
import AtlasControlCenter from './components/AtlasControlCenter';
import HomaSuperPanel from './components/HomaSuperPanel';

const App = ({ page }) => {
  // Determine which component to render based on the page
  const renderPage = () => {
    if (!page) {
      return <div className="homaye-tabesh-error">صفحه مشخص نشده است.</div>;
    }

    // Atlas Control Center pages
    if (page.startsWith('atlas-')) {
      return <AtlasControlCenter page={page} />;
    }

    // Homa Super Panel pages
    if (page.startsWith('homa-')) {
      return <HomaSuperPanel page={page} />;
    }

    return <div className="homaye-tabesh-error">صفحه یافت نشد.</div>;
  };

  return (
    <div className="homaye-tabesh-app">
      {renderPage()}
    </div>
  );
};

export default App;
