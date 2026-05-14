\# 🏥 ASP.NET Core \& MS SQL: Hastane Randevu ve Klinik Takip



Bu proje, ASP.NET Core MVC mimarisi ve Entity Framework Core (Code-First) kullanılarak geliştirilmiş kapsamlı bir hastane randevu ve yönetim simülasyonudur. Veri tutarlılığı ve ilişkisel veritabanı (Foreign Key) mantığı ön planda tutulmuştur.



\## 🚀 Teknolojiler

\* \*\*Backend:\*\* C#, ASP.NET Core MVC (.NET 10)

\* \*\*Veritabanı:\*\* MS SQL Server

\* \*\*ORM:\*\* Entity Framework Core (Code-First Migration)

\* \*\*Frontend:\*\* HTML5, Razor View Engine, Bootstrap 5



\## 📸 Ekran Görüntüleri



\### 1. Klinik Listesi (Ana Sayfa)

Hastanede bulunan kliniklerin listelendiği ve seçim yapıldığı giriş ekranı.

!\[Klinik Listesi](./anasayfa.png)



\### 2. Doktor Seçimi

Seçilen kliniğe (clinicId) bağlı olarak çalışan uzman doktorların filtrelenmiş listesi.

!\[Doktor Seçimi](./doktorlar.png)



\### 3. Randevu Oluşturma Formu

Seçili doktor için hasta bilgilerinin (patientId) ve şikayetin girilerek POST edildiği ekran.

!\[Randevu Formu](./randevu.png)



\### 4. Hasta Geçmişi ve Reçeteler

Entity Framework Include/ThenInclude metodları ile hastanın geçmiş randevularının, doktor/klinik bilgilerinin ve yazılan reçetelerin listelendiği detay ekranı.

!\[Hasta Geçmişi](./gecmis.png)



\### 5. Veritabanı Diyagramı (Code-First)

C# Modellerinden türetilen ve MS SQL üzerinde oluşan ilişkisel tablo yapısı.

!\[Veritabanı](./veritabani.png)



\## 🛠️ Kurulum ve Çalıştırma

\* Projeyi Visual Studio veya VS Code ile açın.

\* `appsettings.json` içerisindeki MS SQL `DefaultConnection` bağlantı cümlenizi kendi sunucunuza göre güncelleyin.

\* Terminal üzerinden `dotnet ef database update` komutunu çalıştırarak veritabanını ve tabloları otomatik olarak oluşturun.

\* `dotnet run` komutu ile veya F5'e basarak projeyi başlatın.

