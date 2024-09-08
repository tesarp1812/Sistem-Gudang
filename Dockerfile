# Menggunakan image dasar PHP 8.2
FROM php:8.2-fpm

# Install dependensi sistem yang diperlukan
RUN apt-get update -y && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zlib1g-dev \
    unzip \
    git \
    wget \
    build-essential \
    cmake \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install ekstensi PHP yang diperlukan
RUN docker-php-ext-install pdo pdo_mysql mysqli zip gd

# Setel direktori kerja
WORKDIR /app

# Salin file aplikasi ke dalam kontainer
COPY . /app

# Install dependensi PHP dengan Composer
RUN composer install --no-scripts --no-autoloader

# Expose port aplikasi
EXPOSE 8000

# Jalankan server PHP built-in
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
