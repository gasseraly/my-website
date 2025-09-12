# دليل الإعداد النهائي - Hostinger

## 🎯 الخطوات المطلوبة (يجب تنفيذها يدوياً):

### 1. **إعداد Cron Jobs** (5 دقائق):

#### في لوحة تحكم Hostinger:
1. اذهب إلى **"متقدم"** > **"وظائف كرون"**
2. اضغط **"إضافة Cron Job"**
3. أدخل:
   - **Command**: `cd /home/u990109832/public_html && php artisan schedule:run >> /dev/null 2>&1`
   - **Minute**: `*`
   - **Hour**: `*`
   - **Day**: `*`
   - **Month**: `*`
   - **Weekday**: `*`
4. اضغط **"حفظ"**

#### اختبار Cron Job:
```bash
# في SSH
ssh -p 65002 u990109832@45.87.81.218
cd /home/u990109832/public_html
php artisan schedule:list
```

### 2. **إعداد صلاحيات الملفات** (3 دقائق):

#### في SSH:
```bash
# الاتصال بالخادم
ssh -p 65002 u990109832@45.87.81.218

# الانتقال إلى مجلد الموقع
cd /home/u990109832/public_html

# تشغيل سكريبت الإعداد
chmod +x setup_hostinger.sh
./setup_hostiner.sh
```

#### أو يدوياً:
```bash
# إعداد الصلاحيات
chmod -R 755 .
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod 644 .env
chmod 644 .htaccess
chmod 644 artisan

# تشغيل أوامر Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 3. **إعداد GitHub Actions** (10 دقائق):

#### في GitHub:
1. اذهب إلى **Settings** > **Secrets and variables** > **Actions**
2. أضف Secrets:
   - `HOSTINGER_HOST` = `45.87.81.218`
   - `HOSTINGER_PORT` = `65002`
   - `HOSTINGER_USERNAME` = `u990109832`
   - `HOSTINGER_SSH_KEY` = `[مفتاح SSH الخاص]`

#### إنشاء مفتاح SSH:
```bash
# في الكمبيوتر المحلي
ssh-keygen -t rsa -b 4096 -C "github-actions@coprra.com"
cat ~/.ssh/id_rsa.pub  # نسخ المفتاح العام
cat ~/.ssh/id_rsa      # نسخ المفتاح الخاص
```

#### في Hostinger:
1. اذهب إلى **"SSH"** > **"مفاتيح SSH"**
2. أضف المفتاح العام

---

## 🚀 **الخطوات التلقائية** (جاهزة):

### 1. **رفع الملفات**:
- جميع الملفات جاهزة
- `env.production` → `.env`
- `setup_hostinger.sh` → الخادم

### 2. **اختبار الموقع**:
```bash
# اختبار الصفحة الرئيسية
curl -I https://coprra.com

# اختبار API
curl -I https://coprra.com/api/health
```

### 3. **مراقبة الأداء**:
- OPcache مفعل
- CDN مفعل
- SSL مفعل

---

## ⏱️ **الوقت المطلوب**:

- **Cron Jobs**: 5 دقائق
- **File Permissions**: 3 دقائق
- **GitHub Actions**: 10 دقائق
- **المجموع**: 18 دقيقة

---

## 🎯 **النتيجة النهائية**:

بعد تنفيذ هذه الخطوات ستحصل على:
- ✅ موقع Laravel يعمل على Hostinger
- ✅ قاعدة بيانات MySQL متصلة
- ✅ بريد إلكتروني يعمل
- ✅ SSL مفعل
- ✅ CDN مفعل
- ✅ OPcache محسن
- ✅ Cron Jobs يعمل
- ✅ نشر تلقائي (اختياري)
- ✅ اختبارات تعمل

---

## 📞 **الدعم**:

إذا واجهت أي مشاكل:
1. تحقق من السجلات
2. راجع الأدلة المُنشأة
3. استخدم أوامر الاختبار
4. تحقق من الصلاحيات

**جميع الملفات والأدلة جاهزة!** 🎉
