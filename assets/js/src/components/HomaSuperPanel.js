import { createElement } from '@wordpress/element';

const HomaSuperPanel = ({ page }) => {
  const getPageContent = () => {
    const pageName = page.replace('homa-', '');

    const pageInfo = {
      'executive-dashboard': {
        title: 'داشبورد اجرایی',
        description: 'داشبورد اجرایی با نمای کلی از عملکرد سیستم',
      },
      'user-management': {
        title: 'مدیریت کاربران',
        description: 'مدیریت و نظارت بر کاربران سیستم',
      },
      'health-diagnostics': {
        title: 'سلامت و عیب‌یابی',
        description: 'بررسی سلامت سیستم و شناسایی مشکلات',
      },
      'brain-development': {
        title: 'توسعه مغز',
        description: 'توسعه و بهبود قابلیت‌های هوش مصنوعی',
      },
      'security': {
        title: 'امنیت',
        description: 'مدیریت امنیت و کنترل دسترسی',
      },
      'master-observer': {
        title: 'ناظر کل',
        description: 'نظارت جامع بر تمام بخش‌ها و فعالیت‌ها',
      },
      'persona': {
        title: 'پرسونا',
        description: 'مدیریت شخصیت و رفتار هوش مصنوعی',
      },
    };

    const info = pageInfo[pageName] || { title: 'صفحه', description: '' };

    return createElement(
      'div',
      { className: 'homaye-tabesh-card' },
      createElement('h2', null, info.title),
      createElement('p', null, info.description),
      createElement('div', { className: 'homaye-tabesh-status active' }, 'فعال'),
      createElement(
        'p',
        { style: { marginTop: '20px', color: '#666' } },
        'این بخش در حال توسعه است و قابلیت‌های آن در نسخه‌های آینده اضافه خواهند شد.'
      )
    );
  };

  return createElement(
    'div',
    { className: 'homa-super-panel' },
    getPageContent(),
    createElement(
      'div',
      { className: 'homaye-tabesh-card', style: { marginTop: '20px' } },
      createElement('h3', null, 'درباره سوپرپنل هما'),
      createElement(
        'p',
        null,
        'سوپرپنل هما مرکز فرماندهی اصلی برای مدیریت تمامی جنبه‌های سیستم هوشمند است. این پنل ابزارهای قدرتمندی برای مدیریت، نظارت و توسعه سیستم فراهم می‌کند.'
      )
    )
  );
};

export default HomaSuperPanel;
