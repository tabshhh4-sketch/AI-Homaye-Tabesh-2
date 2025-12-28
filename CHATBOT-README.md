# راهنمای نصب و استفاده از چتبات هما

## نصب افزونه

### 1. نصب وابستگی‌ها

```bash
# نصب وابستگی‌های PHP
composer install --no-dev --optimize-autoloader

# نصب وابستگی‌های NPM
npm install --legacy-peer-deps

# بیلد React
npm run build
```

### 2. فعال‌سازی در وردپرس

1. فایل‌های افزونه را در دایرکتوری `/wp-content/plugins/homaye-tabesh/` قرار دهید
2. از پنل مدیریت وردپرس، به بخش Plugins بروید
3. افزونه "همای تابش" را فعال کنید

## ویژگی‌های جدید چتبات

### چتبات فرانت‌اند (Homa Chatbot)

چتبات هما یک رابط کاربری مدرن و تعاملی است که به صورت خودکار در تمام صفحات سایت نمایش داده می‌شود.

#### ویژگی‌های اصلی:

1. **محیط Dual-Workspace**
   - کاربران می‌توانند همزمان با سایت و چتبات تعامل داشته باشند
   - بدنه سایت به صورت داینامیک فشرده می‌شود (Viewport Squeeze)
   - هیچ تداخلی در عملکرد سایت ایجاد نمی‌شود

2. **آیکن شناور**
   - آیکن شناور در گوشه صفحه برای باز کردن چتبات
   - قابل شخصی‌سازی از پنل تنظیمات
   - انیمیشن Pulse برای جلب توجه

3. **رابط کاربری ChatGPT-like**
   - طراحی مدرن و مینیمال
   - پیام‌های User و Assistant به صورت جداگانه
   - Auto-scroll به آخرین پیام
   - نمایش زمان ارسال پیام

4. **Responsive Design**
   - سازگار با موبایل و تبلت
   - در موبایل، سایدبار تمام صفحه را می‌پوشاند
   - تجربه کاربری یکپارچه در تمام دستگاه‌ها

## تنظیمات چتبات

برای دسترسی به تنظیمات چتبات:

1. در پنل مدیریت وردپرس، به **مرکز کنترل اطلس** بروید
2. از منوی کشویی، گزینه **تنظیمات چتبات** را انتخاب کنید

### تنظیمات قابل تغییر:

#### 1. فعال‌سازی چتبات
- فعال یا غیرفعال کردن نمایش چتبات در سایت

#### 2. موقعیت آیکن شناور
- پایین چپ (پیش‌فرض)
- پایین راست

#### 3. رنگ آیکن
- انتخاب رنگ دلخواه با Color Picker
- رنگ پیش‌فرض: `#4F46E5` (بنفش)

#### 4. عرض سایدبار
- تنظیم عرض سایدبار چتبات (300-600 پیکسل)
- عرض پیش‌فرض: 400 پیکسل

#### 5. پیام خوش‌آمدگویی
- متنی که در ابتدای باز شدن چتبات نمایش داده می‌شود
- پیش‌فرض: "به همای تابش خوش آمدید"

#### 6. متن Placeholder
- متن راهنمای input برای ورود پیام
- پیش‌فرض: "پیام خود را بنویسید..."

## معماری فنی

### Frontend Stack

- **React 18**: برای رندر رابط کاربری
- **Zustand**: برای مدیریت State
- **CSS Variables**: برای تغییرات داینامیک
- **Webpack 5**: برای بیلد و بسته‌بندی

### ساختار فایل‌ها

```
assets/js/src/frontend/
├── index.js                      # نقطه ورود
├── ChatbotApp.jsx                # کامپوننت اصلی
├── styles.css                    # استایل‌ها
├── store/
│   └── chatStore.js              # Zustand store
└── components/
    ├── FloatingIcon.jsx          # آیکن شناور
    ├── ChatSidebar.jsx           # سایدبار اصلی
    ├── ChatHeader.jsx            # هدر چتبات
    ├── ChatMessages.jsx          # لیست پیام‌ها
    └── ChatInput.jsx             # ورودی پیام
```

### PHP Classes

```
includes/
├── Frontend/
│   └── ChatbotHandler.php        # مدیریت فرانت‌اند
└── Admin/
    └── ChatbotSettings/
        └── SettingsHandler.php   # مدیریت تنظیمات
```

## Viewport Squeeze Logic

### نحوه کار:

1. وقتی چتبات باز می‌شود، کلاس `homa-sidebar-active` به body اضافه می‌شود
2. CSS از طریق `margin-left` محتوای سایت را به سمت چپ منتقل می‌کند
3. سایدبار از سمت راست با انیمیشن باز می‌شود
4. هر دو لایه (سایت و سایدبار) قابل تعامل هستند

### CSS Variables

```css
:root {
  --homa-sidebar-width: 400px;
  --homa-transition-duration: 0.3s;
  --homa-primary-color: #4F46E5;
  --homa-z-floating: 9999;
  --homa-z-sidebar: 10000;
}
```

## Parallel Interaction API

### Z-Index Layers:

- **Main Content**: `z-index: auto` (لایه پایه)
- **Floating Icon**: `z-index: 9999`
- **Sidebar**: `z-index: 10000`

### Pointer Events:

- تمام عناصر `pointer-events: auto` دارند
- کاربر می‌تواند همزمان با فرم‌های سایت و چتبات کار کند
- اسکرول هر کدام مستقل از دیگری است

## State Management (Zustand)

### State Structure:

```javascript
{
  isOpen: false,              // وضعیت باز/بسته سایدبار
  messages: [],               // لیست پیام‌ها
  inputValue: '',             // متن input
  isLoading: false            // وضعیت بارگذاری
}
```

### Actions:

- `toggleSidebar()`: باز/بسته کردن سایدبار
- `openSidebar()`: باز کردن سایدبار
- `closeSidebar()`: بستن سایدبار
- `addMessage(message)`: اضافه کردن پیام جدید
- `clearMessages()`: پاک کردن تمام پیام‌ها
- `setInputValue(value)`: تنظیم مقدار input
- `setIsLoading(loading)`: تنظیم وضعیت بارگذاری

## توسعه آینده

در نسخه‌های بعدی، قابلیت‌های زیر اضافه خواهند شد:

- [ ] اتصال به API هوش مصنوعی
- [ ] ذخیره تاریخچه مکالمات
- [ ] پشتیبانی از فایل و تصویر
- [ ] پیشنهادات سریع (Quick Replies)
- [ ] Theme سفارشی
- [ ] چند زبانه بودن
- [ ] آمار و گزارش‌گیری

## پشتیبانی

برای گزارش مشکلات یا پیشنهادات:
https://github.com/tabshhh4-sketch/AI-Homaye-Tabesh-2

---

© 2024 Homaye Tabesh Team
