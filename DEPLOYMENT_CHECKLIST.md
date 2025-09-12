# قائمة فحص النشر - Hostinger

## ✅ ما تم إنجازه:

### 1. **الملفات المُنشأة**:
- [x] `env.production` - إعدادات الإنتاج
- [x] `config/hostinger.php` - إعدادات Hostinger
- [x] `config/testing.php` - إعدادات الاختبارات
- [x] `tests/Feature/HostingerTest.php` - اختبارات Hostinger
- [x] `phpunit.hostinger.xml` - تكوين PHPUnit
- [x] `setup_hostinger.sh` - سكريبت الإعداد

### 2. **الملفات المُحدثة**:
- [x] `config/database.php` - قاعدة البيانات
- [x] `config/mail.php` - البريد الإلكتروني
- [x] `config/session.php` - الجلسات
- [x] `config/app.php` - التطبيق
- [x] `tests/TestCase.php` - اختبارات

### 3. **الإعدادات المُحسنة**:
- [x] قاعدة البيانات (MySQL)
- [x] البريد الإلكتروني (SMTP)
- [x] SSL (HTTPS)
- [x] PHP (8.2.28)
- [x] OPcache (مفعل)
- [x] الأمان (Security Headers)

## 📋 خطوات النشر:

### 1. **رفع الملفات**:
```bash
# رفع جميع الملفات إلى public_html
# نسخ env.production إلى .env
# نسخ setup_hostinger.sh
```

### 2. **تشغيل سكريبت الإعداد**:
```bash
ssh -p 65002 u990109832@45.87.81.218
cd /home/u990109832/public_html
chmod +x setup_hostinger.sh
./setup_hostinger.sh
```

### 3. **إعداد Cron Jobs**:
- اذهب إلى لوحة تحكم Hostinger
- انتقل إلى "متقدم" > "وظائف كرون"
- أضف: `* * * * * cd /home/u990109832/public_html && php artisan schedule:run >> /dev/null 2>&1`

### 4. **إعداد GitHub Actions** (اختياري):
- أضف Secrets في GitHub
- أضف مفتاح SSH إلى Hostinger
- فعّل النشر التلقائي

### 5. **اختبار الموقع**:
- زيارة `https://coprra.com`
- اختبار جميع الوظائف
- اختبار API

## 🧪 اختبارات مطلوبة:

### 1. **اختبار قاعدة البيانات**:
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

### 2. **اختبار البريد الإلكتروني**:
```bash
php artisan tinker
>>> Mail::raw('Test email', function($msg) { $msg->to('contact@coprra.com')->subject('Test'); });
```

### 3. **اختبار SSL**:
```bash
curl -I https://coprra.com
```

### 4. **اختبار OPcache**:
```bash
php -r "var_dump(opcache_get_status());"
```

## 🔧 استكشاف الأخطاء:

### 1. **مشاكل قاعدة البيانات**:
- تحقق من إعدادات `.env`
- تحقق من اتصال قاعدة البيانات
- تحقق من الصلاحيات

### 2. **مشاكل البريد الإلكتروني**:
- تحقق من إعدادات SMTP
- تحقق من كلمة المرور
- تحقق من DNS

### 3. **مشاكل SSL**:
- تحقق من شهادة SSL
- تحقق من إعدادات HTTPS
- تحقق من Headers

## 📞 الدعم:

- **Hostinger Support**: لوحة التحكم
- **Laravel Documentation**: https://laravel.com/docs
- **GitHub Issues**: المستودع

## 🎯 النتيجة المتوقعة:

بعد اكتمال جميع الخطوات، ستحصل على:
- موقع Laravel يعمل على Hostinger
- قاعدة بيانات MySQL متصلة
- بريد إلكتروني يعمل
- SSL مفعل
- OPcache محسن
- اختبارات تعمل
- نشر تلقائي (اختياري)
