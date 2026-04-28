# استخدام نسخة PHP الرسمية مع Apache
FROM php:8.2-apache

# تثبيت الإضافات اللازمة لـ Laravel و MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# تثبيت إضافات PHP الخاصة بقواعد البيانات
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تفعيل موديل Rewrite في Apache (ضروري لروابط Laravel)
RUN a2enmod rewrite

# تحديد المجلد الرئيسي داخل الحاوية
WORKDIR /var/www/html

# نسخ ملفات المشروع بالكامل
COPY . .

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تشغيل Composer install لتثبيت المكتبات
RUN composer install --no-interaction --optimize-autoloader --no-dev

# ضبط الصلاحيات لمجلدات Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# تغيير الـ Document Root الخاص بـ Apache ليوجه إلى مجلد public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# فتح المنفذ 80
EXPOSE 80

# أمر التشغيل
CMD ["apache2-foreground"]