import React from 'react';

const AtlasControlCenter = ({ page }) => {
  const getPageContent = () => {
    const pageName = page.replace('atlas-', '');

    const pageInfo = {
      'macro-view': {
        title: 'نمای کلان',
        description: 'نمای کلی از وضعیت سیستم و عملکرد کلی',
      },
      'live-intervention': {
        title: 'مداخله زنده',
        description: 'مداخله و کنترل زنده در فرآیندهای جاری',
      },
      'behavior-analysis': {
        title: 'تحلیل رفتار',
        description: 'تحلیل و بررسی رفتار کاربران',
      },
      'recommendations': {
        title: 'پیشنهادات',
        description: 'پیشنهادات هوشمند برای بهبود عملکرد',
      },
      'decision-simulator': {
        title: 'شبیه‌ساز تصمیم',
        description: 'شبیه‌سازی و پیش‌بینی نتایج تصمیمات',
      },
      'core-settings': {
        title: 'تنظیمات هسته',
        description: 'تنظیمات اصلی و پیکربندی هسته سیستم',
      },
      'advanced-config': {
        title: 'پیکربندی پیشرفته',
        description: 'تنظیمات پیشرفته برای کاربران حرفه‌ای',
      },
    };

    const info = pageInfo[pageName] || { title: 'صفحه', description: '' };

    return (
      <div className="homaye-tabesh-card">
        <h2>{info.title}</h2>
        <p>{info.description}</p>
        <div className="homaye-tabesh-status active">فعال</div>
        <p style={{ marginTop: '20px', color: '#666' }}>
          این بخش در حال توسعه است و قابلیت‌های آن در نسخه‌های آینده اضافه خواهند شد.
        </p>
      </div>
    );
  };

  return (
    <div className="atlas-control-center">
      {getPageContent()}
      
      <div className="homaye-tabesh-card" style={{ marginTop: '20px' }}>
        <h3>درباره مرکز کنترل اطلس</h3>
        <p>
          مرکز کنترل اطلس هاب مرکزی برای نظارت، تحلیل و مدیریت تمامی فعالیت‌های سیستم است.
          این بخش با استفاده از هوش مصنوعی، تصمیم‌گیری‌های هوشمند را امکان‌پذیر می‌سازد.
        </p>
      </div>
    </div>
  );
};

export default AtlasControlCenter;
