# 🌍 JSP & PostgreSQL: Şehir Rehberi ve Gezi Rotası

Bu proje, JavaServer Pages (JSP) teknolojisi ve PostgreSQL veritabanı kullanılarak geliştirilmiş dinamik bir web uygulamasıdır. Kullanıcıların şehirleri listelemesine, şehirlere ait mekanları ve rehberleri görüntülemesine ve yeni mekanlar eklemesine olanak tanır.

## 🚀 Teknolojiler
- **Backend:** Java, JSP (JavaServer Pages)
- **Veritabanı:** PostgreSQL
- **Sunucu:** Apache Tomcat
- **Frontend:** HTML5, CSS3 (Modern Travel Theme)
- **Bağlantı:** JDBC (PostgreSQL Driver)

## 📸 Ekran Görüntüleri

### 1. Ana Sayfa (Şehir Listesi)
Sistemdeki tüm şehirlerin bölge ve nüfus bilgileriyle birlikte listelendiği giriş ekranıdır.
![Ana Sayfa](.SehirRehberi/anasayfa.png)

### 2. Şehir Detay Sayfası
Seçilen şehre ait gezilecek mekanların ve o şehirde uzmanlaşmış rehberlerin listelendiği alandır.
![Şehir Detay](.SehirRehberi/detay.png)

### 3. Yeni Mekan Ekleme
Belirli bir şehre bağlı kalarak sisteme yeni turistik mekanların veya restoranların kaydedildiği form ekranıdır.
![Yeni Mekan Ekle](.SehirRehberi/new_event.png)

### 4. Veritabanı Yapısı
PostgreSQL üzerinde kurgulanan ilişkisel tablo yapısı (Cities, Places, Events, Guides, City_Guide).
![Veritabanı Yapısı](.SehirRehberi/veri_tabanı.png)

## 🛠️ Kurulum ve Çalıştırma

1. **Veritabanı Kurulumu:** - PostgreSQL üzerinde `sehir_rehberi` adında bir veritabanı oluşturun.
   - `database.sql` dosyasındaki sorguları çalıştırarak tabloları ve test verilerini oluşturun.

2. **Kütüphane Bağlantısı:**
   - `postgresql-42.x.x.jar` dosyasını projenin `Libraries` kısmına (NetBeans/IntelliJ) ekleyin.

3. **Sunucu Yapılandırması:**
   - Apache Tomcat sunucusunu projenize tanıtın.
   - `DBConnection.java` dosyasındaki veritabanı kullanıcı adı ve şifresini kendi bilgilerinizle güncelleyin.

4. **Çalıştırma:**
   - `index.jsp` dosyasını sağ tıklayıp "Run File" diyerek uygulamayı başlatın.
