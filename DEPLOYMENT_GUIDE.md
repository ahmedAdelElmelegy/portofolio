# دليل رفع ونشر مشروع Portfolio على استضافة InfinityFree

تهانينا! تم تجهيز جميع ملفات المشروع وقاعدة البيانات لتكون متوافقة 100% مع بيئة **InfinityFree** بدون الحاجة إلى SSH أو Composer على السيرفر.

---

## 📋 بيانات الاستضافة والربط التي تم ضبطها تلقائياً

- **رابط الموقع (APP_URL):** `https://ahmedadel.gt.tc`
- **سيرفر قاعدة البيانات (DB_HOST):** `sql201.infinityfree.com`
- **اسم قاعدة البيانات (DB_DATABASE):** `if0_43514780_portofolio`
- **اسم المستخدم (DB_USERNAME):** `if0_43514780`
- **كلمة مرور الداتابيز:** `zKtk8MLXzUnQ9`
- **رابط phpMyAdmin:** [اضغط هنا للدخول لقاعدة البيانات](https://php-myadmin.net/db_structure.php?db=if0_43514780_portofolio)

---

## 🔑 بيانات الدخول للوحة التحكم (Admin Dashboard)

- **الرابط:** `https://ahmedadel.gt.tc/admin`
- **البريد الإلكتروني:** `admin@portfolio.test`
- **كلمة المرور:** `password`

---

## 🗄️ الخطوة 1: استيراد قاعدة البيانات (phpMyAdmin)

تم تجهيز ملف `database.sql` وهو يحتوي على كافة الجداول الـ 22 (بما فيها `video_sections`, `video_content_items`, `users`, `profiles`, `projects`, `skills`, `experiences`) وبياناتها الكاملة بدون أي أخطاء:

1. افتح رابط phpMyAdmin: [https://php-myadmin.net/db_structure.php?db=if0_43514780_portofolio](https://php-myadmin.net/db_structure.php?db=if0_43514780_portofolio)
2. اضغط على اسم القاعدة `if0_43514780_portofolio` من القائمة اليسرى.
3. اضغط من الشريط العلوي على **Import**.
4. اضغط **Choose File** واختر ملف [database.sql](file:///D:/php/portfolio/database.sql).
5. انزل لأسفل واضغط **Import** (أو **Go**).
6. ستظهر لك رسالة نجاح باللون الأخضر تفيد باستيراد كافة الجداول والبيانات بنجاح.

---

## 🚀 الخطوة 2: رفع ملفات الموقع على InfinityFree

استضافة InfinityFree تفرض حداً أقصى للملف الواحد قدره **10MB** في الـ File Manager. لذلك قمنا بتجهيز طريقتين للرفع لتختار الأنسب لك:

### 🌟 الطريقة الأولى: الرفع عبر File Manager (مقسم لملفات أقل من 10MB - الأسهل والأضمن)

الملفات جاهزة داخل المجلد: [D:\php\portfolio\deploy](file:///D:/php/portfolio/deploy)

1. ادخل إلى لوحة تحكم InfinityFree وافتح **File Manager**.
2. ادخل إلى مجلد **`htdocs`** (تأكد أنك داخل `htdocs`).
3. اضغط زر **Upload** واختر **Upload Zip**:
   - ارفع ملف `htdocs-public.zip` ثم اختر **Upload & Extract**.
   - (سينتج عن هذا وجود `index.php` و `.htaccess` ومجلد `storage` بكامل الصور والفيديوهات مباشرة داخل `htdocs`).
4. أنشئ مجلداً جديداً داخل `htdocs` باسم **`laravel`**.
5. ادخل داخل مجلد **`htdocs/laravel`**:
   - ارفع ملف `laravel-core.zip` واختر **Upload & Extract**.
   - (سينتج عن هذا مجلدات `app`, `config`, `routes`, `resources`, `database`, `storage`, وملف `.env` المشفر والمحمي).
6. وأنت ما زلت داخل مجلد **`htdocs/laravel`**:
   - ارفع ملف `vendor.zip` واختر **Upload & Extract**.
   - (سينتج مجلد `vendor` الذي يحتوي على مكتبات Laravel المحسنة للإنتاج).

---

### ⚡ الطريقة الثانية: رفع الملف الشامل دفعة واحدة (عبر FileZilla / FTP)

إذا كنت تستخدم برنامج FTP مثل FileZilla:
- يمكنك رفع الملف الشامل [deploy.zip](file:///D:/php/portfolio/deploy.zip) مباشرة إلى داخل `htdocs` وفك الضغط عنه من الـ File Manager بنقرة واحدة (Zip & Extract).

---

## 🔒 التحسينات الأمنية والتقنية التي تمت إضافتها للمشروع

1. **حماية ملفات Laravel و .env:**
   - تم وضع قواعد حماية في كل من `htdocs/.htaccess` و `htdocs/laravel/.htaccess` تمنع المتصفحات نهائياً من الوصول إلى ملف `.env` أو ملفات الكود المصدري (ترجع 403 Forbidden).
2. **حل مشكلة مسارات التخزين والـ Symlinks:**
   - على الاستضافات المشتركة المجانية، دالة `symlink` معطلة. تم تعديل `config/filesystems.php` بحيث يتم حفظ وقراءة أي صور أو فيديوهات ترفعها من لوحة التحكم مباشرة داخل مجلد `htdocs/storage/` الفعلي.
3. **دعم كامل لـ HTTPS:**
   - تم إعداد Laravel ليثق في الـ Reverse Proxy الخاص بـ InfinityFree وإجبار جميع روابط الـ Assets والـ CSS والـ JS والفيديوهات لتكون عبر `https://` منعاً لحدوث أخطاء Mixed Content.
4. **تفعيل وضع الإنتاج (Production Mode):**
   - تم ضبط `APP_DEBUG=false` لحماية النظام من إظهار أي تفاصيل حساسة للزوار في حال حدوث أي خطأ، وضبط `SESSION_DRIVER=file` و `CACHE_STORE=file` لتعمل بسلاسة بدون الحاجة لسيرفرات Redis.

---

## ✅ التحقق بعد النشر

بعد إتمام الرفع واستيراد قاعدة البيانات:
1. افتح موقعك: [https://ahmedadel.gt.tc/](https://ahmedadel.gt.tc/)
   - ستجد الـ Portfolio يعمل بالكامل، والصور، وقسم الفيديو التفاعلي يعمل بكفاءة.
2. افتح لوحة التحكم: [https://ahmedadel.gt.tc/admin](https://ahmedadel.gt.tc/admin)
   - سجل دخول بالبيانات (`admin@portfolio.test` / `password`).
   - يمكنك الآن تعديل أي محتوى، مشاريع، مهارات، أو فيديوهات وسوف تظهر مباشرة على الموقع!

